<?php

namespace App\Http\Livewire;

use LivewireUI\Modal\ModalComponent;

class EditPhoneNumberModal extends ModalComponent
{
    public function render()
    {
        return view('livewire.edit-phone-number-modal');
    }
}
