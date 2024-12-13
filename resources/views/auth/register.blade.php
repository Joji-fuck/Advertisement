@extends('layouts.main')

@section('title')
    @parent {{$title}}
@endsection

@section('content')
    <h1 class="mt-5">Регистрация</h1>
    <form method="post" action="{{route('register.store')}}">
        @csrf
        <div class="mb-3">
            <label for="username" class="form-label">Имя пользователя</label>
            <input style="{{$errors -> has('username') ? 'border-color: red;' : ''}}" type="text" class="form-control" id="username" name="username" placeholder="Введите имя" value="{{old('username')}}">
            <span style="color: red">{{$errors->first('username')}}</span>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Электронная почта</label>
            <input style="{{$errors -> has('email') ? 'border-color: red;' : ''}}" type="email" class="form-control" name="email" id="email" placeholder="expamle@gmail.com" value="{{old('email')}}">
            <span style="color: red">{{$errors->first('email')}}</span>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Пароль</label>
            <input style="{{$errors -> has('password') ? 'border-color: red;' : ''}}" type="password" class="form-control" id="password" name="password">
            <span style="color: red">{{$errors->first('password')}}</span>
        </div>
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Подтверждение пароля</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
        </div>
        <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
        <span>Уже есть аккаунт? <a href="{{route('login')}}">Войти</a></span>
    </form>
@endsection
