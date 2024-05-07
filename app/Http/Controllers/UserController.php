<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(Request $request){
        $id = $request->id;
        $user = User::find($id);

        return view('pages.profile-page', ['user' => $user]);
    }
}
