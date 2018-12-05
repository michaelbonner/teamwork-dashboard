<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function show($user)
    {
        $teamwork = resolve('Teamwork');
        
        return $teamwork->getPerson($user);
    }
}
