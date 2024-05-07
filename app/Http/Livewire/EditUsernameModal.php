<?php

namespace App\Http\Livewire;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use LivewireUI\Modal\ModalComponent;

class EditUsernameModal extends ModalComponent
{
    public $username;
    private $rules = [
        'username' => 'required|min:3|max:15'
    ];
    private $message = [
        'required' => 'Username must be filled',
        'min' => 'Username length must be at least 3 characters',
        'max' => 'Username length must be less than 15 characters'  
    ];

    public function mount($username){
        $this->username = $username;
    }

    public function render()
    {
        return view('livewire.edit-username-modal');
    }

    public function update(){
        /** @var User $user */
        $user = Auth::user();
        if(!$user instanceof User){
            Controller::FailMessage('Update Username Failed');
        }
        $validator = Validator::make(
            ['username' => $this->username],
            $this->rules,
            $this->message
        );
        if($validator->fails()){
            Controller::FailMessage($validator->errors()->first());
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $user->username = $this->username;
        $user->save();
        Controller::SuccessMessage('Username Updated');
        $this->closeModal();
        return redirect()->to('/profile');
    }
    public static function modalMaxWidth(): string
    {
        return 'md';
    }
}
