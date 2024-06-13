<?php

namespace App\Http\Livewire\Pages\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Faker;
use Smknstd\FakerPicsumImages\FakerPicsumImagesProvider;

use function App\Helper\getID;

class Register extends Component
{
    public $username;
    public $email;
    public $password;

    public function register()
    {
        $data = [
            'username' => $this->username,
            'email' => $this->email,
            'password' => $this->password,
        ];
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
        $validator = Validator::make($data, $rules, $messages);
        if ($validator->fails()) {
            Controller::FailMessage($validator->errors()->first());
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $faker = Faker\Factory::create();
        $faker->addProvider(new FakerPicsumImagesProvider($faker));
        $user = new User();
        $user->id = getID();
        $user->email = $this->email;
        $user->username = $this->username;
        $user->password = bcrypt($this->password);
        $user->image = $faker->imageUrl(800,600);
        $user->save();
        Controller::SuccessMessage('Register Success');
        return redirect('/login');
    }

    public function render()
    {
        return view('livewire.pages.auth.register')->layout('components.layouts.auth-template');
    }
}
