<?php

namespace App\Http\Livewire\Pages\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class Login extends Component
{
    public $username;
    public $password;

    public function login()
    {
        $data = [
            'username' => $this->username,
            'password' => $this->password,
        ];
        $rules = [
            'username' => ['required'],
            'password' => ['required']
        ];
        $messages = [
            'required' => 'All fields must be filled'
        ];
        $validator = Validator::make($data, $rules, $messages);
        if ($validator->fails()) {
            Controller::FailMessage($validator->errors()->first());
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $isLogin = Auth::attempt(['username' => $this->username, 'password' => $this->password]);
        if (!$isLogin) {
            Controller::FailMessage('Invalid Credential');
            return redirect()->back()->withErrors(['auth' => 'Invalid Credential'])->withInput();
        }
        Controller::SuccessMessage('Login Success');
        return redirect('/');
    }

    public function render()
    {
        return view('livewire.pages.auth.login')->layout('components.layouts.auth-template');
    }
}
