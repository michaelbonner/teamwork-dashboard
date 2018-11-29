<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use Illuminate\Support\Carbon;

class TeamController extends Controller
{
    public function __construct()
    {
        $this->teamwork = resolve('Teamwork');
    }
    public function index()
    {
        $teams = Team::all()->sortBy('name');
        $unassigned = $this->getUnassignedPeople();
        return view(
            'team.index',
            compact(
                'teams',
                'unassigned'
            )
        );
    }

    public function show(Team $team)
    {
        $startDate = Carbon::now()->startOfWeek();
        $endDate = Carbon::now()->endOfWeek();

        $members = $team->teamMembers->map(function ($member) use ($startDate, $endDate) {
            $tasks = $this->teamwork->getTasksForPersonBetweenDates(
                $member->id,
                Carbon::now()->startOfWeek(),
                Carbon::now()->endOfWeek()
            );
            $member->estimatedMinutes = $tasks->sum('estimated-minutes');
            return $member;
        });
        return view(
            'team.show',
            compact(
                'team',
                'members',
                'startDate',
                'endDate'
            )
        );
    }

    protected function getUnassignedPeople()
    {
        $members = collect([]);
        foreach (Team::all() as $team) {
            $members = $members->merge(collect($team->members));
        }

        return resolve('Teamwork')->getPeople()->reject(function ($person) use ($members) {
            return $members->contains($person->id);
        });
    }
}
