@extends('layouts.main')

@section('title')
    @parent {{$title}}
@endsection

@section('content')
    <h1 class="mt-5">Вход</h1>
    <form class="mt-5" method="post" action="{{route('login')}}">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Электронная почта</label>
            <input style="{{$errors -> has('email') ? 'border-color: red;' : ''}}" type="email" class="form-control" id="email" name="email" value="{{old('email')}}" placeholder="example@gmail.com">
            @error('email')
                <span style="color: red">{{$message}} <a style="color: red" href="{{route('register.create')}}">зарегистрируешься?)</a></span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Пароль</label>
            <input style="{{$errors -> has('email') ? 'border-color: red;' : ''}}" type="password" class="form-control" id="password" name="password">
            @error('password')
                <span style="color: red">{{$message}}</span>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">Вход</button>
        <span>Уже еще нет аккаунта? <a href="{{route('register.create')}}">Зарегистрироваться</a></span>
    </form>
@endsection
