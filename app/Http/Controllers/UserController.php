<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(){
        $user = Auth::user();
        $achievements = Achievement::all();

        return view('pages.profile-page', ['user' => $user, 'achievements' => $achievements]);
    }
}
