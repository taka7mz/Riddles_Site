@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>謎解き投稿サイト</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="/css/riddle_box.css">
    </head>
    <body>
        <h2 align="center">最新の謎一覧</h2>
        <br>
        <div class='riddles' align='center'>
            @foreach($riddles as $riddle)
                <br><div class='riddle'>
                    <br><h3 class='title'>
                        <a href="/riddles/{{ $riddle->id }}">{{ $riddle->title }}</a>
                    </h3>
                    <span class='creator'>作成者：
                        @if( $riddle->user->id  === Auth::id())
                            <a href="/users/mypage">{{ $riddle->user->name }}</a>
                        @else
                            <a href="/users/{{ $riddle->user_id }}">{{ $riddle->user->name }}</a>
                        @endif
                    </span>
                    <p class='date'>投稿日：{{ $riddle->created_at }}</p>
                </div>
                <br>
            @endforeach
            <div class='paginate' style="margin-left:650px">
                {{ $riddles->links() }}
            </div><br>
            <a href="/">ホームへ</a>
        </div>
    </body>
</html>
@endsection