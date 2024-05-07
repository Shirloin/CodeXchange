<?php

namespace App\Http\Livewire;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use LivewireUI\Modal\ModalComponent;

class EditGenderModal extends ModalComponent
{
    public $gender;
    private $rules = [
        'gender' => 'required'
    ];
    private $message = [
        'required' => 'Date of Birth must be filled',
    ];

    public function mount($gender){
        $this->gender = $gender;
    }

    public function render()
    {
        return view('livewire.edit-gender-modal');
    }
    public function update(){
        /** @var User $user */
        $user = Auth::user();
        if(!$user instanceof User){
            Controller::FailMessage('Update Gender Failed');
        }
        $validator = Validator::make(
            ['gender' => $this->gender],
            $this->rules,
            $this->message
        );
        if($validator->fails()){
            Controller::FailMessage($validator->errors()->first());
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $user->gender = $this->gender;
        $user->save();
        Controller::SuccessMessage('Gender Updated');
        $this->closeModal();
        return redirect()->to('/profile');
    }
    public function set($gender){
        $this->gender = $gender;
    }
    public static function modalMaxWidth(): string
    {
        return 'md';
    }
}
