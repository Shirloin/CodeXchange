<?php

namespace App\Http\Livewire\Components\Profile\Edit;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class EditEmailModal extends Component
{
    public $email;
    private $rules = [
        'email' => 'required|email|unique:users'
    ];
    private $message = [
        'required' => 'Email must be filled',
        'email' => 'Email is invalid',
        'unique' => 'Email has been taken'
    ];
    public function update()
    {
        /** @var User $user */
        $user = Auth::user();
        if (!$user instanceof User) {
            Controller::FailMessage('Update Email Failed');
        }
        $validator = Validator::make(
            ['email' => $this->email],
            $this->rules,
            $this->message
        );
        if ($validator->fails()) {
            Controller::FailMessage($validator->errors()->first());
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $user->email = $this->email;
        $user->save();
        Controller::SuccessMessage('Email Updated');
        return redirect('/profile' . '/' . $user->id);
    }
    public function mount($email)
    {
        $this->email = $email;
    }
    public function render()
    {
        return view('livewire.components.profile.edit.edit-email-modal');
    }
}
