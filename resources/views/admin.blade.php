@extends('layouts.main')

@section('title')
    @parent {{'Админка'}}
@endsection

@include('layouts.includes.navbar')

@section('content')
    <h1 class="mb-5">Объявления для подтверждения</h1>
    @foreach($advertisements as $advertisement)
        <div class="card mt-5" style="width: 18rem;">
            <img class="card-img-top" alt="Карточка" src="{{asset('images/adimages/' . $advertisement->ad_photo)}}">
            <div class="card-body">
                <h5 class="card-title">{{$advertisement->title}}</h5>
                <p class="card-text">{{$advertisement->description}}</p>
            </div>
            <div class="buttons mb-2 d-flex justify-content-evenly">
                <a class="btn btn-success" href="{{route('admin.create', $advertisement->id)}}">Опубликовать</a>
                <a class="btn btn-danger" href="{{route('admin.destroy', $advertisement->id)}}">Удалить</a>
            </div>
        </div>
    @endforeach
    <h1 class="mt-5">Пользователи</h1>
    @foreach($users as $user)
        <ul class="list-group list-group-horizontal">
                <li class="list-group-item">{{$user->username}}</li>
            @if(!$user->is_banned)
            <li class="list-group-item">
                    <a class="btn btn-danger" href="{{route('admin.banned', $user->id)}}">Забанить</a>
            </li>
            @else
                <li class="list-group-item list-group-item-danger">
                    <a class="btn btn-success" href="{{route('admin.unbanned', $user->id)}}">Разбанить</a>
                </li>
            @endif
        </ul>
    @endforeach
@endsection
