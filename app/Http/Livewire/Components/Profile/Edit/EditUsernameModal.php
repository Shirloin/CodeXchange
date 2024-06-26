<?php

namespace App\Http\Livewire\Components\Profile\Edit;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use Livewire\Component;

class EditUsernameModal extends Component
{
    public $username;
    private $rules = [
        'username' => 'required|min:3|max:15|unique:users'
    ];
    private $message = [
        'required' => 'Username must be filled',
        'min' => 'Username length must be at least 3 characters',
        'max' => 'Username length must be less than 15 characters',
        'unique' => 'Username has already taken'
    ];

    public function update()
    {
        /** @var User $user */
        $user = Auth::user();
        if (!$user instanceof User) {
            Controller::FailMessage('Update Username Failed');
            return;
        }
        $validator = Validator::make(
            ['username' => $this->username],
            $this->rules,
            $this->message
        );
        if ($validator->fails()) {
            Controller::FailMessage($validator->errors()->first());
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $user->username = $this->username;
        $user->save();
        Controller::SuccessMessage('Username Updated');
        return redirect('/profile' . '/' . $user->id);
    }

    public function mount($username)
    {
        $this->username = $username;
    }
    public function render()
    {
        return view('livewire.components.profile.edit.edit-username-modal');
    }
}
