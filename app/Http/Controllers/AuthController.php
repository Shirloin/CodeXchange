<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

use function App\Helper\getID;

class AuthController extends Controller
{
    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect('/login');
    }
    public function updateImage(Request $request){
        /** @var User $user */
       $user = Auth::user();
       if (!$user instanceof User) {
           Controller::FailMessage('Update Profile Image Failed');
           return;
       }
       $messages = [
           'required' => 'Image is required',
           'max' => 'File size must be not more than 2048 bytes'
       ];
       $validator = Validator::make($request->all(), [
           'file' => 'required|file|max:1024',
       ], $messages);
       if ($validator->fails()) {
           Controller::FailMessage($validator->errors()->first());
           return redirect()->back()->withErrors($validator);
       }
       $file = $request->file;
       if ($user->image) {
           $existing_image_path = str_replace('/storage/', 'public/', $user->image);
           if (Storage::exists($existing_image_path)) {
               Storage::delete($existing_image_path);  
           }
       }
       if ($file) {
           $fileName = time() . '-' . getID() . '.' . $file->getClientOriginalExtension();
           $filePath = $file->storeAs('profile-images', $fileName, 'public');
           $user->image = '/storage/' . $filePath;
           $user->save();
       }
       Controller::SuccessMessage('Profile Image Updated');
       return redirect('/profile' . '/' . $user->id);
   }
}
