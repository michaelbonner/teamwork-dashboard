<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;

class WelcomeController extends Controller
{
    public function index()
    {
        $teamwork = resolve('Teamwork');
        
        $teams = Team::all()->sortBy('name');
        $unassigned = $this->getUnassignedPeople();
        return view(
            'welcome',
            compact(
                'teams',
                'unassigned'
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
