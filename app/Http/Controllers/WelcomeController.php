<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;

class WelcomeController extends Controller
{
    public function index()
    {
        $teams = Team::all();
        return view(
            'welcome',
            compact('teams')
        );
    }
}
