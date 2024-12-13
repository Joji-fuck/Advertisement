@extends('layouts.main')

@section('title')
    @parent{{'Новое объявление'}}
@endsection

@include('layouts.includes.navbar')

@section('content')
    <h1 class="mt-5">Новое объявление</h1>

    <form method="post" action="{{route('adv.create')}}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            @error('category')
                <p class="alert alert-danger">{{$message}}</p>
            @enderror
            <label for="category" class="form-label">Категория товара</label>
            <select id="category" class="form-select" name="category">
                @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category -> category_name}}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="title" class="form-label">Заголовок</label>
            <input type="text" class="form-control" id="title" name="title" value="{{old('title')}}" style="{{$errors -> has('title') ? 'border-color: red;' : ''}}">
            @error('title')
                <p class="alert alert-danger mt-1">{{$message}}</p>
            @enderror
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Описание</label>
            <textarea class="form-control" id="description" rows="3" name="description" style="{{$errors -> has('description') ? 'border-color: red;' : ''}}"></textarea>
            @error('description')
                <p class="alert alert-danger mt-1">{{$message}}</p>
            @enderror
        </div>
        <div class="mb-3">
            <input class="form-control-file" type="file" id="ad_photo" name="ad_photo">
        </div>
            @error('ad_photo')
                <p class="alert alert-danger mt-1">{{$message}}</p>
            @enderror
        <button type="submit" class="btn btn-primary">Отправить</button>
    </form>
@endsection
