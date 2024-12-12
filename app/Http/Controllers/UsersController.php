<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\City;
use App\Models\Event;
use App\Models\Request as TableRequest;
use App\Http\Controllers\EventsController;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;

class UsersController extends Controller
{
    public function load_user_data() {
        $user = Auth::user();;
        $level = 1;
        $curProgress = 0;
        $cities = City::all();
        $curCity = City::find(Auth::user()->City_ID)->Наименование;


        $curUserID = Auth::user()->User_ID;
        $activeEvents = null;
        $previousEvents = null;

        if ($user->Role_ID == 0) {
            $activeEvents = $user->events()->where('Завершено', 0)->get();
            $previousEvents = $user->events()->where('Завершено', 1)->get();
        } else if ($user->Role_ID == 1) {
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
        }
        

        if ($user) {
            // Рассчитываем уровень
            $level = intdiv($user->getAttribute('Рейтинг'), 1000) + 1;
            // Рассчитываем текущий прогресс
            if ($level > 1) {
                $curProgress = $user->getAttribute('Рейтинг') % 1000; // Оставшийся прогресс
            } else {
                $curProgress = $user->getAttribute('Рейтинг'); // Для уровня 1 прогресс равен рейтингу
            }
        }
        
        
        return view('profile', compact('user', 'level', 'curProgress', 'cities', 'curCity', 'activeEvents', 'previousEvents'));
    }

    public function load_other_user_data($userid) {
        $user = User::where('User_ID', '=', $userid)->first();
        $level = 1;
        $curProgress = 0;

        $activeEvents = null;
        $previousEvents = null;

        if ($user->Role_ID == 0) {
            $activeEvents = $user->events()->where('Завершено', 0)->get();
            $previousEvents = $user->events()->where('Завершено', 1)->get();
        } else if ($user->Role_ID == 1) {
            $activeEvents = Event::where('Завершено', 0)
                ->whereHas('requests', function ($query) use ($userid) {
                    $query->where('User_ID', $userid)->where('Status_ID', 0);
                })
                ->with(['requests' => function ($query) use ($userid) {
                    $query->where('User_ID', $userid)->where('Status_ID', 0);
                }])
                ->get();
            $previousEvents = Event::where('Завершено', 1)
                ->whereHas('requests', function ($query) use ($userid) {
                    $query->where('User_ID', $userid)->where('Status_ID', 0);
                })
                ->with(['requests' => function ($query) use ($userid) {
                    $query->where('User_ID', $userid)->where('Status_ID', 0);
                }])
                ->get();
        }
        

        if ($user) {
            // Рассчитываем уровень
            $level = intdiv($user->getAttribute('Рейтинг'), 1000) + 1;
            // Рассчитываем текущий прогресс
            if ($level > 1) {
                $curProgress = $user->getAttribute('Рейтинг') % 1000; // Оставшийся прогресс
            } else {
                $curProgress = $user->getAttribute('Рейтинг'); // Для уровня 1 прогресс равен рейтингу
            }
        }
        
        return view('other_user', compact('user', 'level', 'curProgress', 'activeEvents', 'previousEvents'));
    }

    public function upload_avatar(Request $request) {
        try {
            $request->validate([
                'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:8192'
            ]);
    
            $user = Auth::user();
            $path = '/storage/' . $request->file('avatar')->store('avatars', 'public');

            $user->update(['Фото профиля' => $path]);
    
            return response()->json([
                'success' => true,
                'avatarUrl' => $path,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Ошибка на сервере: ' . $e->getMessage()
            ], 500);
        }
    }

    private function getLevel($progress)
    {
        return intdiv($progress, 1000); // Уровень 0, если прогресс меньше 1000
    }

    public function registration_view() {
        $cities = City::All();
        $currentDate = DB::select("SELECT CURRENT_DATE AS current_date")[0]->current_date;
        return view('registration', compact('cities', 'currentDate'));
    }

    public function registration(Request $request) {

            // Валидация данных
            $validatedData = $request->validate([
                'firstName' => 'required|string',
                'lastName'=> 'required|string', 
                'patronymic'=> 'required|string', 
                'birthDate' => 'required|date', 
                'phone' => 'required|string', 
                'email' => 'required|string', 
                'password' => 'required|string',
                'role' => 'required|integer', 
                'city' => 'required|string',
            ]);

            $cityId = City::where('Наименование', '=', $validatedData['city'])->first()?->City_ID;

            // Сохранение данных в базу
            User::create([
                'Имя' => $validatedData['firstName'],
                'Фамилия' => $validatedData['lastName'],
                'Отчество' => $validatedData['patronymic'], 
                'E-Mail' => $validatedData['email'], 
                'Телефон' => $validatedData['phone'], 
                'Пароль' =>  $validatedData['password'],
                'Дата рождения' => $validatedData['birthDate'],
                'Role_ID' => $validatedData['role'],
                'City_ID' => $cityId, 
            ]);

            $user = User::where('E-Mail', $validatedData['email'])
                    ->where('Пароль', $validatedData['password'])
                    ->first(); // Берем первого найденного

            // Если пользователь найден и пароль совпадает
            if ($user) {
                Auth::login($user); // Логиним пользователя
            }

            return redirect('/')->with('success', 'Успешная регистрация!');
    }


    public function updateRow(Request $request, $id)
    {
        $user = User::find($id);

        if ($user) {
            // Переключаем состояние блокировки
            $user->blocked = $request->blocked;
            $user->save();

            return response()->json([
                'success' => true,
                'message' => $user->blocked ? 'Пользователь заблокирован' : 'Пользователь разблокирован',
                'blocked' => $user->blocked  // Отправляем текущее состояние блокировки
            ]);
        }

        return response()->json(['success' => false, 'message' => 'Пользователь не найден']);
    }

    public function authorizationView()
    {
        return view('authorization');
    }

}
