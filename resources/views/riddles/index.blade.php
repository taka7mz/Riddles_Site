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
        <h1 align="center">謎解き投稿サイト</h1>
        <br>
        <h2 align="center">最新の謎一覧</h2>
        <br>
        <div class='riddles'>
            @foreach($riddles as $riddle)
                <div class='riddle' align="center">
                    <h3 class='title'>
                        <a href="/riddles/{{ $riddle->id }}">{{ $riddle->title }}</a>
                    </h3>
                    <p class='creator'>作成者：
                        @if( optional($riddle->user)->id  === Auth::id())
                            <a href="/users/mypage">{{ optional($riddle->user)->name }}</a>
                        @else
                            <a href="/users/{{ $riddle->user_id }}">{{ optional($riddle->user)->name }}</a>
                        @endif
                    </p>
                    <p class='date'>投稿日：{{ $riddle->created_at }}</p>
                </div>
                <br>
            @endforeach
        </div>
        <div class='paginate'>
            {{ $riddles->links() }}
        </div>
    </body>
</html>
@endsection