<?php

namespace App\Http\Livewire\Components\Profile\Edit;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class EditDobModal extends Component
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

    public function mount($dob)
    {
        $this->dob = $dob;
    }
    public function update()
    {
        /** @var User $user */
        $user = Auth::user();
        if (!$user instanceof User) {
            Controller::FailMessage('Update Date of Birth Failed');
            return;
        }
        $validator = Validator::make(
            ['dob' => $this->dob],
            $this->rules,
            $this->message
        );
        if ($validator->fails()) {
            Controller::FailMessage($validator->errors()->first());
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $user->dob = $this->dob;
        $user->save();
        Controller::SuccessMessage('Date of Birth Updated');
        return redirect('/profile' . '/' . $user->id);
    }
    public function render()
    {
        return view('livewire.components.profile.edit.edit-dob-modal');
    }
}
