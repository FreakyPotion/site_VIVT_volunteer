<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventStat;
use App\Models\UserStat;
use App\Models\RequestStat;
use App\Models\ReportStat;
use App\Models\City;
use App\Models\User;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PanelController extends Controller
{
    public function getView() {
        $chartData = $this->getStats();
        $cities = City::all()->sortBy('City_ID');
        $users = User::all()->sortBy('User_ID');
        $events = Event::all()->sortBy('Event_ID');
        $tablesInfo = $this->getTablesInfo();

        return view('admin_panel', compact('chartData', 'cities', 'users', 'events', 'tablesInfo'));
    }

    public function getTablesInfo() {
        // Список конкретных таблиц, для которых нужно получить количество записей
        $tables = ['Города', 'Пользователи', 'События'];
    
        // Массив для хранения информации о таблицах и их количестве записей
        $tablesInfo = [];
    
        // Перебираем указанные таблицы и получаем количество записей для каждой
        foreach ($tables as $tableName) {
            // Получаем количество записей в таблице
            $count = DB::table($tableName)->count();
    
            // Добавляем в массив
            $tablesInfo[] = [
                'tableName' => $tableName,
                'count' => $count
            ];
        }
    
        return $tablesInfo;
    }

    public function changeData(Request $request) {
        $validatedData = $request->validate([
            'login' => 'required|string',
            'password'=> 'required|string' 
        ]);

        $user = Auth::user();
        $user->{'E-Mail'} = $validatedData['login'];
        $user->Пароль = $validatedData['password'];
        $user->save();
        
        return response()->json(['message' => 'Данные успешно обновлены'], 200);
    }

    public function updateStats()
    {
        try {
            $chartData = $this->getStats();  // Получаем данные для графиков
            return response()->json($chartData);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Ошибка сервера'], 500);
        }
    }

    private function getStats()
    {
        // Периоды, которые нас интересуют
        $periods = ['day', 'week', 'month', 'year'];

        // Категории данных (события, пользователи, запросы, отчёты)
        $categories = ['Events', 'Users', 'Requests', 'Reports'];

        // Массив для хранения всех данных
        $data = [];

        // Заполняем массив данными для каждого периода и категории
        foreach ($categories as $category) {
            foreach ($periods as $period) {
                // Получаем данные для каждой категории и периода
                $method = "get" . $category . "StatsByPeriod";  // Формируем название метода
                $data[$category][$period] = $this->$method($period);
            }
        }

        // Получаем метки и значения для графиков
        $chartData = [];
        foreach ($categories as $category) {
            foreach ($periods as $period) {
                $chartData[$category][$period] = [
                    'labels' => $data[$category][$period]->pluck('labels')->toArray(),  // Даты
                    'values' => $data[$category][$period]->pluck('vals')->toArray()   // Значения
                ];
            }
        }
        return $chartData;
    }

    private function getEventsStatsByPeriod($period) {
        $groupBy = 'labels';
        $selectRaw = 'DATE(time_create) as labels, COUNT(*) as vals';
        switch ($period) {
            case 'day':
                $dateFilter = Carbon::today();  // Текущий день
                $selectRaw = 'EXTRACT(HOUR FROM time_create) as hour, EXTRACT(HOUR FROM time_create)::TEXT || \':00\' as labels, COUNT(*) as vals';
                $groupBy = 'hour';
                break;
            case 'week':
                $dateFilter = Carbon::now()->subDays(7);  // Последние 7 дней
                break;
            case 'month':
                $dateFilter = Carbon::now()->subDays(30);  // Последние 30 дней
                break;
            case 'year':
                $dateFilter = Carbon::now()->subDays(365);
                break;
            default:
                throw new Exception("Invalid period type");
        }
    
        // Выполняем запрос
        return EventStat::selectRaw($selectRaw)
            ->where('time_create', '>=', $dateFilter)
            ->groupBy($groupBy)
            ->orderBy($groupBy, 'asc')
            ->get();
    }

    private function getUsersStatsByPeriod($period) {
        $groupBy = 'labels';
        $selectRaw = 'DATE(time_create) as labels, COUNT(*) as vals';
        switch ($period) {
            case 'day':
                $dateFilter = Carbon::today();  // Текущий день
                $selectRaw = 'EXTRACT(HOUR FROM time_create) as hour, EXTRACT(HOUR FROM time_create)::TEXT || \':00\' as labels, COUNT(*) as vals';
                $groupBy = 'hour';
                break;
            case 'week':
                $dateFilter = Carbon::now()->subDays(7);  // Последние 7 дней
                break;
            case 'month':
                $dateFilter = Carbon::now()->subDays(30);  // Последние 30 дней
                break;
            case 'year':
                $dateFilter = Carbon::now()->subDays(365);  // Последние 365 дней
                break;
            default:
                throw new Exception("Invalid period type");
        }
    
        // Выполняем запрос
        return UserStat::selectRaw($selectRaw)
            ->where('time_create', '>=', $dateFilter)
            ->groupBy($groupBy)
            ->orderBy($groupBy, 'asc')
            ->get();
    }

    private function getRequestsStatsByPeriod($period) {
        $groupBy = 'labels';
        $selectRaw = 'DATE(time_create) as labels, COUNT(*) as vals';
        switch ($period) {
            case 'day':
                $dateFilter = Carbon::today();  // Текущий день
                $selectRaw = 'EXTRACT(HOUR FROM time_create) as hour, EXTRACT(HOUR FROM time_create)::TEXT || \':00\' as labels, COUNT(*) as vals';
                $groupBy = 'hour';
                break;
            case 'week':
                $dateFilter = Carbon::now()->subDays(7);  // Последние 7 дней
                break;
            case 'month':
                $dateFilter = Carbon::now()->subDays(30);  // Последние 30 дней
                break;
            case 'year':
                $dateFilter = Carbon::now()->subDays(365);  // Последние 365 дней
                break;
            default:
                throw new Exception("Invalid period type");
        }
    
        // Выполняем запрос
        return RequestStat::selectRaw($selectRaw)
            ->where('time_create', '>=', $dateFilter)
            ->groupBy($groupBy)
            ->orderBy($groupBy, 'asc')
            ->get();
    }

    private function getReportsStatsByPeriod($period) {
        $groupBy = 'labels';
        $selectRaw = 'DATE(time_create) as labels, COUNT(*) as vals';
        switch ($period) {
            case 'day':
                $dateFilter = Carbon::today();  // Текущий день
                $selectRaw = 'EXTRACT(HOUR FROM time_create) as hour, EXTRACT(HOUR FROM time_create)::TEXT || \':00\' as labels, COUNT(*) as vals';
                $groupBy = 'hour';
                break;
            case 'week':
                $dateFilter = Carbon::now()->subDays(7);  // Последние 7 дней
                break;
            case 'month':
                $dateFilter = Carbon::now()->subDays(30);  // Последние 30 дней
                break;
            case 'year':
                $dateFilter = Carbon::now()->subDays(365);  // Последние 365 дней
                break;
            default:
                throw new Exception("Invalid period type");
        }
    
        // Выполняем запрос
        return ReportStat::selectRaw($selectRaw)
            ->where('time_create', '>=', $dateFilter)
            ->groupBy($groupBy)
            ->orderBy($groupBy, 'asc')
            ->get();
    }
}
