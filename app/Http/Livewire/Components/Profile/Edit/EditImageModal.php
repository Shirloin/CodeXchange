<?php

namespace App\Http\Livewire\Components\Profile\Edit;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithFileUploads;

use function App\Helper\getID;

class EditImageModal extends Component
{
    use WithFileUploads;
    public $image;
    public $file;
    private $rules = [
        'file' => 'required|image|max:2048'
    ];
    private $message = [
        'required' => 'Image must not be empty',
        'image' => 'File must be an image',
        'max' => 'File size must be not more than 2048 bytes'
    ];

    public function mount($image)
    {
        $this->image = $image;
    }

    public function update()
    {
        /** @var User $user */
        $user = Auth::user();
        if (!$user instanceof User) {
            Controller::FailMessage('Update Profile Image Failed');
        }
        $validator = Validator::make(
            ['file' => $this->file],
            $this->rules,
            $this->message
        );
        if ($validator->fails()) {
            Controller::FailMessage($validator->errors()->first());
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if ($this->image) {
            $this->remove();
        }
        if ($this->file) {
            $this->upload($user);
        }
        Controller::SuccessMessage('Profile Image Updated');
        return redirect('/profile' . '/' . $user->id);
    }

    public function upload($user)
    {
        $fileName = time() . '-' . getID() . '.' . $this->file->getClientOriginalExtension();
        $filePath = $this->file->storeAs('profile-images', $fileName, 'public');
        $user->image = '/storage/' . $filePath;
        $user->save();
    }

    public function remove()
    {
        $existing_image_path = str_replace('/storage/', 'public/', $this->image);
        if (Storage::exists($existing_image_path)) {
            Storage::delete($existing_image_path);
        }
    }

    public function render()
    {
        return view('livewire.components.profile.edit.edit-image-modal');
    }
}
