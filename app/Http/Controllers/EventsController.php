<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\DB;

class EventsController extends Controller
{
    public function load_events() {
        $currentDate = DB::select("SELECT CURRENT_DATE AS current_date")[0]->current_date;
        // $events = Event::where('Дата', '>=', $currentDate)->get();
        $events = Event::all();
        return view('events', compact('events'));
    }
}
