<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

use function App\Helper\getID;

class AuthController extends Controller
{
    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect('/login');
    }
}
