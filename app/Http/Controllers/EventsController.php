<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\User;
use App\Models\Report;
use App\Models\Request as TableRequest; 
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EventsController extends Controller
{
    public function load_events() {

        Carbon::setLocale('ru');

        $currentDate = DB::select("SELECT CURRENT_DATE AS current_date")[0]->current_date;
        $events = Event::where('Завершено', '=', 0)->orderBy('Дата', 'desc')->paginate(16);
        $user = null;

        // Извлечение и преобразование дат
        $dates = $events->pluck('Дата')->map(function ($date) {
            return Carbon::parse($date)->translatedFormat('d F Y');
        });

        if (Auth::id()) {
            $user = User::where('User_ID', '=', Auth::id())->first();
        }
        return view('events', compact('events', 'user', 'dates'));
    }

    public function load_archive_events() {
        
        Carbon::setLocale('ru');

        $currentDate = DB::select("SELECT CURRENT_DATE AS current_date")[0]->current_date;
        $events = Event::where('Завершено', '=', 1)->orderBy('Дата', 'desc')->get();
        $user = null;

        // Извлечение и преобразование дат
        $dates = $events->pluck('Дата')->map(function ($date) {
            return Carbon::parse($date)->translatedFormat('d F Y');
        });

        if (Auth::id()) {
            $user = User::where('User_ID', '=', Auth::id())->first();
        }
        return view('archive_events', compact('events', 'user', 'dates'));
    }

    public function load_organizer_page() {
        Carbon::setLocale('ru');

        $currentDate = DB::select("SELECT CURRENT_DATE AS current_date")[0]->current_date;
        $events = Event::where('Организатор', '=', Auth::id())->orderBy('Дата', 'desc')->get();

        $user = Auth::user();
        $activeEvents = $user->events()->where('Завершено', 0)->get();
        $previousEvents = $user->events()->where('Завершено', 1)->get();
        
        $activeDates = $activeEvents->pluck('Дата')->map(fn($date) => Carbon::parse($date)->translatedFormat('d F Y'));
        $previousDates = $previousEvents->pluck('Дата')->map(fn($date) => Carbon::parse($date)->translatedFormat('d F Y'));
        
        return view('for_organizer', compact('events', 'user', 'activeDates', 'previousDates' , 'activeEvents', 'previousEvents'));
    }

    public function load_volunteer_page() {
        Carbon::setLocale('ru');

        $currentDate = DB::select("SELECT CURRENT_DATE AS current_date")[0]->current_date;
        $events = Event::where('Организатор', '=', Auth::id())->orderBy('Дата', 'desc')->get();

        $user = Auth::user();

        $curUserID = Auth::user()->User_ID;

        $activeEvents = Event::where('Завершено', 0)
            ->whereHas('requests', function ($query) use ($curUserID) {
                $query->where('User_ID', $curUserID)->where('Status_ID', 0);
            })
            ->with(['requests' => function ($query) use ($curUserID) {
                $query->where('User_ID', $curUserID)->where('Status_ID', 0);
            }])
            ->get();
        $previousEvents = Event::where('Завершено', 1)
            ->whereHas('requests', function ($query) use ($curUserID) {
                $query->where('User_ID', $curUserID)->where('Status_ID', 0);
            })
            ->with(['requests' => function ($query) use ($curUserID) {
                $query->where('User_ID', $curUserID)->where('Status_ID', 0);
            }])
            ->get();

        $activeDates = $activeEvents->pluck('Дата')->map(fn($date) => Carbon::parse($date)->translatedFormat('d F Y'));
        $previousDates = $previousEvents->pluck('Дата')->map(fn($date) => Carbon::parse($date)->translatedFormat('d F Y'));
        
        return view('for_volunteer', compact('events', 'user', 'activeDates', 'previousDates', 'activeEvents', 'previousEvents'));
    }

    public function load_requests() {
        $user = Auth::user();
        $statuses = TableRequest::where('User_ID', Auth::id())
        ->join('События', 'Запросы.Event_ID', '=', 'События.Event_ID')
        ->orderBy('События.Дата', 'desc')
        ->get(['Запросы.*', 'События.*']);
        
        return view('my_requests', compact('statuses', 'user'));
    }


    public function events_details($eventid) {

        Carbon::setLocale('ru');

        $event = Event::where('Event_ID', '=', $eventid)->first();
        $users = User::all();
        $currentUser = null;
        $requestStatus = null;

        // Извлечение и преобразование даты
        $date = Carbon::createFromFormat('Y-m-d', $event->Дата)->translatedFormat('d F Y');

        if (Auth::id()) {
            $currentUser = User::where('User_ID', '=', Auth::id())->first();
            $requestStatus = TableRequest::where('User_ID', '=', Auth::id())->where('Event_ID', '=', $eventid)->first();
        }

        $currentDate = DB::select("SELECT CURRENT_DATE AS current_date")[0]->current_date;

        return view('eventsdetail', compact('event', 'users', 'currentUser', 'requestStatus', 'currentDate', 'date'));
    }

    public function events_details_list($eventid) {
        $requesters = User::whereIn('User_ID', function ($query) use ($eventid) {
            $query->select('User_ID')
                  ->from('Запросы')
                  ->where('Event_ID', $eventid)
                  ->where('Status_ID', 1);
        })->get();

        $participants = User::whereIn('User_ID', function ($query) use ($eventid) {
            $query->select('User_ID')
                  ->from('Запросы')
                  ->where('Event_ID', $eventid)
                  ->where('Status_ID', 0);
        })->get();

        $user = Auth::user();

        return view('requests', compact('requesters', 'participants', 'eventid', 'user'));
    }

    public function create_event(Request $request) {
        // Валидация данных
        $validatedData = $request->validate([
            'name' => 'required|string|max:200',
            'description'=> 'required|string|max:800', 
            'date'=> 'required|date', 
            'max_participants' => 'required|integer', 
            'city' => 'required|string|max:110', 
            'street' => 'required|string|max:110', 
            'house' => 'required|string|max:30',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:8192', 
        ]);

        $path = null;
        // Загрузка файла
        if ($request->hasFile('image')) {
            // Генерация пути файла
            $path = '/storage/' . $request->file('image')->store('events_images', 'public');
        }  

         // Объединение данных адреса
        $address =  'г. ' . $validatedData['city'] . ', ул. ' . $validatedData['street']  . ', д. ' . $validatedData['house'] ;

        if ($path != null) {
            // Сохранение данных в базу
            Event::create([
                'Название' => $validatedData['name'],
                'Описание' => $validatedData['description'],
                'Организатор' => Auth::id(), 
                'Дата' => $validatedData['date'], 
                'Максимум участников' => $validatedData['max_participants'], 
                'Адрес' =>  $address,
                'Изображение' => $path, 
            ]);
        } else {
            // Сохранение данных в базу
            Event::create([
                'Название' => $validatedData['name'],
                'Описание' => $validatedData['description'],
                'Организатор' => Auth::id(), 
                'Дата' => $validatedData['date'], 
                'Максимум участников' => $validatedData['max_participants'], 
                'Адрес' =>  $address,
            ]);
        }
        

        // Перенаправление с сообщением
        return redirect('/')->with('success', 'Данные успешно сохранены!');
    }

    public function pullRequest(Request $request, $id) {
        TableRequest::create([
            'User_ID' => Auth::id(), // Берем только ID текущего пользователя
            'Event_ID' => $id,      // ID события передается через маршрут
        ]);
    
        return redirect()->back()->with('success', 'Заявка подана успешно.');
    }

    public function acceptUser(Request $request, $event, $user) {
        $requestTable = TableRequest::where("Event_ID", "=", $event)->where("User_ID", "=", $user)->first();

        $requestTable->update(['Status_ID' => 0]);

        return redirect()->back()->with('success', 'Успешно.');
    }

    public function rejectUser(Request $request, $event, $user) {
        $requestTable = TableRequest::where("Event_ID", "=", $event)->where("User_ID", "=", $user)->first();

        $requestTable->update(['Status_ID' => 2]);

        return redirect()->back()->with('success', 'Успешно.');
    }

    public function eventFinishView($eventid) {
        return view('end_event', compact('eventid'));
    }

    public function eventFinish(Request $request, $eventid) {
        $validatedData = $request->validate([
            'event_text' => 'required|string|max:500',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:8192', 
        ]);


        if ($request->hasFile('images')) {
            $paths = [];
            foreach ($request->file('images') as $image) {
                // Сохраняем каждое изображение
                $path = '/storage/' . $image->store('events_images', 'public');
                // Генерация URL файла
                $paths[] = $path;
            }

            $photosArray = '{' . implode(',', array_map(function ($item) {
                return '"' . addslashes($item) . '"';
            }, $paths)) . '}';

        
            Report::create([
                'Event_ID' => $eventid,
                'text' => $validatedData['event_text'],
                'Отчёт_Фото' => $photosArray, // Сохраняем массив в формате PostgreSQL
            ]);
        } else {
            Report::create([
                'Event_ID' => $eventid,
                'text' => $validatedData['event_text'],
            ]);
        }

        $users = User::whereIn('User_ID', function ($query) use ($eventid) {
            $query->select('User_ID')
                  ->from('Запросы')
                  ->where('Event_ID', $eventid);
        })->get();

        foreach ($users as $user) {
            $user->Рейтинг += 50;
            $user->save();
        }

        $event = Event::where('Event_ID', '=', $eventid)->first();
        $event->Завершено = 1;
        $event->save();

        return redirect('/')->with('success', 'Данные успешно сохранены.');
    }

    public function eventReportView($eventid) {
        $event = Event::where("Event_ID", "=", $eventid)->first();

        $user = User::where("User_ID", "=", $event->Организатор)->first();
        $report = Report::where('Event_ID', '=', $eventid)->first();
        $images = str_getcsv(trim($report->Отчёт_Фото, '{}'));

        return view('see_end', compact('report', 'images', 'user'));
    }

    public function eventCreateView() {
        return view('create_event');
    }
}
