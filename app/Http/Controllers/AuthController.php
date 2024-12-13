<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function create(){
        $title = 'Регистрация';
        return view('auth.register', compact('title'));
    }

    public function store(Request $request){
        $request -> validate([
            'username'=>'required',
            'email'=> 'required|email|unique:users',
            'password' => 'required|confirmed|min:8',
        ],
        [
            'username.required' => 'Введи имя, хуесос',

            'email.required' => 'Введи мыло, хуесос',
            'email.email' => 'Чмо, настоящую почту давай',
            'email.unique' => 'Ты тупой, такой уже есть',

            'password.required' => 'Пароль забыл, хуесос',
            'password.confirmed' => 'Ну ты и даун, в подтверждении пароль другой',
            'password.min' => 'пароль от 8 символов, думаешь нам нужно твое нытье что тебя взломали?'
        ]);

        $user = User::create([
           'username' => $request->username,
            'password' => Hash::make($request->password),
           'email' => $request -> email,
        ]);
        session()->flash('success', 'Вы зарегистрированы');
        Auth::login($user);
        return redirect()->route('home');

    }
    public function login_redirect(){
        $title = 'Вход';
        return view('auth.login', compact('title'));
    }
    public function login(Request $request){
        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
            'is_banned' => 0
        ])){
            return redirect()->route('home');
        }
        return redirect()->back()
            ->withInput()
            ->withErrors([
                'email' => "Пиздец, тебя нет... Может ",
                'password' => 'Очапятка в пароле, исправляй',
                'is_banned' => 'Ты забанен, гнида блять'
            ]);
    }
    public function logout(){
        Auth::logout();
        return redirect()-> route('home');
    }
}
