@extends('layouts.main')

@section('title')
    @parent {{$title}}
@endsection

@include('layouts.includes.navbar')
@section('content')
    <div class="container">
        <h1>Профиль</h1>
        <div>
            <img style="width: 400px; height: 400px; border-radius: 50%;" src="{{asset('images/avatars/' . (empty($user->avatar) ? 'Default.jpg' : $user->avatar))}}">
            <form method="post" class="mb-3" action="{{route('update.avatar')}}" enctype="multipart/form-data">
                @csrf
                <input class="form-control-file" type="file" id="avatar" name="avatar">
                <button type="submit" class="btn btn-success">Загрузить</button>
            </form>
        </div>
        <h2>Привет, {{$user->username}}</h2>
        <span>Ваша роль {{$user->roles}}</span>
        <a href="{{route('logout')}}" class="btn btn-danger">Выход</a>
    </div>
    @if(auth() -> user() -> roles == 'admin')
        <a href="{{route('admin')}}" class="btn btn-success">Админка</a>
    @endif
@endsection
