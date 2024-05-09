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

    public function goToLogin()
    {
        return view('pages.auth.login-page');
    }
    public function goToRegister()
    {
        return view('pages.auth.register-page');
    }

    public function login(Request $request)
    {
        $rules = [
            'username' => ['required'],
            'password' => ['required']
        ];
        $messages = [
            'required' => 'All fields must be filled'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            Controller::FailMessage($validator->errors()->first());
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $isLogin = Auth::attempt(['username' => $request->username, 'password' => $request->password]);
        if (!$isLogin) {
            Controller::FailMessage('Invalid Credential');
            return redirect()->back()->withErrors(['auth' => 'Invalid Credential'])->withInput();
        }
        Controller::SuccessMessage('Login Success');
        return redirect('/');
    }

    public function create(Request $request)
    {
        $rules = [
            'email' => ['required', 'unique:users', 'email'],
            'username' => ['required', 'unique:users', 'min:3', 'max:15'],
            'password' => ['required', 'min:3', 'max:15']
        ];
        $messages = [
            'required' => 'All fields must be filled',
            'unique.email' => 'Email has been taken',
            'unique.username' => 'Username has been taken',
            'email' => 'Email is in invalid format',
            'username.min' => 'Username length must be at least 3 characters',
            'username.max' => 'Username length must be less than 15 characters',
            'password.min' => 'Password length must be at least 3 characters',
            'password.max' => 'Password length must be less than 15 characters'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            Controller::FailMessage($validator->errors()->first());
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $user = new User();
        $user->id = getID();
        $user->email = $request->email;
        $user->username = $request->username;
        $user->password = bcrypt($request->password);
        $user->save();
        Controller::SuccessMessage('Register Success');
        return redirect('/login');
    }
    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect('/login');
    }
}
