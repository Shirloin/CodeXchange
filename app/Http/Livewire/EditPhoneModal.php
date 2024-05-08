<?php

namespace App\Http\Livewire;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class EditPhoneModal extends Component
{
    public $phone;
    private $rules = [
        'phone' => 'required|digits:12|numeric'
    ];
    private $message = [
        'required' => 'Phone Number must be filled',
        'digits' => 'Phone Number length must be 12 characters',
        'numeric' => 'Phone Number must be numeric'
    ];

    public function mount($phone)
    {
        $this->phone = $phone;
    }

    public function update()
    {
        /** @var User $user */
        $user = Auth::user();
        if (!$user instanceof User) {
            Controller::FailMessage('Update Phone Number Failed');
        }
        $validator = Validator::make(
            ['phone' => $this->phone],
            $this->rules,
            $this->message
        );
        if ($validator->fails()) {
            Controller::FailMessage($validator->errors()->first());
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $user->phone = $this->phone;
        $user->save();
        Controller::SuccessMessage('Phone Number Updated');
        return redirect('/profile' . '/' . $user->id);
    }
    public static function modalMaxWidth(): string
    {
        return 'md';
    }
    public function render()
    {
        return view('livewire.profile.edit-phone-modal');
    }
}
