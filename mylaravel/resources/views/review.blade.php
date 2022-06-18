@extends('layout')
@extends('layouts.app')
@section('title')
Reviews
@endsection

@section('main_content')
<h1>Форма добавления отзыва</h1>
@if($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
@auth
<form method="post" action="/review/check">
    @csrf
    <input type="text" name="subject" id="subject" placeholder="Введите отзыв" class="form-control"><br>
    <textarea name="message" id="message" class="form-control" placeholder="Введите сообщение"></textarea><br>
    <button type="submit" class="btn btn-success">Отправить</button>
</form>
@endauth
<br>
<h1>Все отзывы</h1>
@foreach($reviews as $el)
<div class="alert alert-warning">
    <h3>{{ $el->subject }}</h3>
    <p>{{ $el->message }}</p>
    <p>{{ date('d.m.Y H:i', strtotime($el->created_at)) }}</p>
    <p> {{$el->user}} </p>
</div>
@endforeach

@endsection