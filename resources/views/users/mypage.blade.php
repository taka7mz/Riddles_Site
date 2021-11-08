@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>謎解き投稿サイト</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <h1 align="center">マイページ</h1>
        <div class='create_button' align='right'>
            <a href='/riddles/create'><input type="button" value="謎投稿"/></a>
        </div>
        <h3>ユーザーネーム：{{ Auth::user()->name }}</h3>
        <br>
        <h3>投稿謎一覧</h3>
        <br>
        <div class='own_riddles'>
            @foreach($own_riddles as $riddle)
                <div class='riddle'>
                    <h4 class='title'>
                        <a href="/riddles/{{ $riddle->id }}">{{ $riddle->title }}</a>
                    </h4>
                    <p class='date'>投稿日：{{ $riddle->created_at }}</p>
                </div>
                <br>
            @endforeach
            <div class='paginate'>
                {{ $own_riddles->links() }}
            </div>
        </div>
    </body>
</html>
@endsection