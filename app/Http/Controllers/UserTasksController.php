<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Teamwork;
use Illuminate\Support\Carbon;

class UserTasksController extends Controller
{
    public function show($user, Request $request)
    {
        $teamwork = resolve('Teamwork');
        $startDate = $request->has('start') ?
                Carbon::parse($request->start) :
                Carbon::now()->startOfWeek();
        $endDate = $request->has('end') ?
                Carbon::parse($request->end) :
                Carbon::now()->endOfWeek();

        return $teamwork->getTasksForPersonBetweenDates($user, $startDate, $endDate);
    }
}
