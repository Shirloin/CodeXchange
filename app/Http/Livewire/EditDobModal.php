<?php

namespace App\Http\Livewire;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use LivewireUI\Modal\ModalComponent;

class EditDobModal extends ModalComponent
{

    public $dob;
    private $rules = [
        'dob' => 'required|date|after_or_equal:1980-01-01|before_or_equal:2010-12-31'
    ];
    private $message = [
        'required' => 'Date of Birth must be filled',
        'date' => 'Date of Birth type must be date',
        'after_or_equal' => 'Date of Birth must be after or equal to 1 January 1980',
        'before_or_equal' => 'Date of Birth must be before or equal to 31 December 2010'
    ];

    public function mount($dob){
        $this->dob = $dob;
    }

    public function render()
    {
        return view('livewire.edit-dob-modal');
    }

    public function update(){
        /** @var User $user */
        $user = Auth::user();
        if(!$user instanceof User){
            Controller::FailMessage('Update Date of Birth Failed');
        }
        $validator = Validator::make(
            ['dob' => $this->dob],
            $this->rules,
            $this->message
        );
        if($validator->fails()){
            Controller::FailMessage($validator->errors()->first());
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $user->dob = $this->dob;
        $user->save();
        Controller::SuccessMessage('Date of Birth Updated');
        $this->closeModal();
        return redirect()->to('/profile');
    }
    public static function modalMaxWidth(): string
    {
        return 'md';
    }
}
