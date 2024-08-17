<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Carbon\Carbon;

class CalendarController extends Controller
{
    public function index($month = null, $year = null)
    {
        $currentMonth = $month ? $month : now()->month;
        $currentYear = $year ? $year : now()->year;
        $startOfMonth = Carbon::createFromDate($currentYear, $currentMonth, 1)->startOfWeek();
        $endOfMonth = Carbon::createFromDate($currentYear, $currentMonth, 1)->endOfMonth()->endOfWeek();
        $weeks = [];

        for ($date = $startOfMonth; $date->lte($endOfMonth); $date->addDay()) {
            $weeks[$date->weekOfYear][] = $date->copy();
        }

        $events = Event::whereBetween('start_time', [$startOfMonth, $endOfMonth])->get();

        return view('calendar.index', compact('weeks', 'events', 'currentMonth', 'currentYear'));
    }
}
