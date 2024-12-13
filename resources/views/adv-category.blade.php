@extends('layouts.main')

@section('title')
    @parent{{'Главная'}}
@endsection
@include('layouts.includes.navbar')
@section('content')
    <h1>Главная</h1>
    @auth()
        <a class="btn btn-success mt-3" href="{{route('adv.form')}}">Добавить объявление</a>
    @endauth
    <div class="cards d-flex gap-lg-5 flex-wrap">
        <div class="container d-flex justify-content-evenly mt-5">
            <a href="{{route('home')}}" class="btn btn-primary">Все объявления</a>
            @foreach($categories as $category)
                <a href="{{route('home.category', $category->id)}}" class="btn btn-primary">{{$category->category_name}}</a>
            @endforeach
        </div>
        @if(empty($advertisements))
            <h1>Тут пусто</h1>
        @else
            @foreach($advertisements as $advertisement)
                <div class="card mt-5" style="width: 20rem;">
                    <img style="height: 20rem" class="card-img-top" alt="Карточка" src="{{asset('images/adimages/' . $advertisement->ad_photo)}}">
                    <div class="card-body">
                        <h5 class="card-title">{{$advertisement->title}}</h5>
                        <p class="card-text">{{$advertisement->description}}</p>
                        <p class="card-text">Создатель: {{$advertisement->user->username}}</p>
                        <p class="card-text"> Категория: {{$advertisement->category->category_name}}</p>
                        @if(auth()->check())
                            @if(auth()->check() && auth() -> user() -> roles == 'admin')
                                <a class="btn btn-danger" href='{{route('adv.destroy', $advertisement->id)}}'>Убить.</a>
                            @endif
                        @endif
                    </div>
                </div>
            @endforeach
        @endif
    </div>

@endsection


