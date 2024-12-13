<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function profile(){
        $user = Auth::user();
        $title = 'Профиль';
        if (empty($user)){
            return redirect('login');
        }
        return view('profile', compact('title', 'user'));
    }
    public function update_avatar(Request $request){
        $request -> validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ],
        [
            'avatar.required' => 'Ты нахуй мне пустую форму дал',
            'avatar.image' => 'порнуху со своей бабкой сам смотри',
            'avatar.mimes' => 'ты где такое расширение нашел?',
            'avatar.max' => 'он такой огромный, семпай... >.<'
        ]);
        $image_name = time().'.'. $request->avatar->extension();
        $request -> avatar -> move(public_path('images/avatars'), $image_name);
        $user = Auth::user();
        User::where("email", $user->email) -> update(['avatar' => $image_name]);

        return back()
            ->with('avatar', $image_name);
    }
}
