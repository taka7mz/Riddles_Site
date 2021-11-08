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
        <h3 align='center'>{{ $user_riddle[0]->user->name }}の謎一覧</h3>
        <br>
        <div class='user_riddles' align='center'>
            @foreach($user_riddle as $riddle)
                <div class='riddle'>
                    <h4 class='title'>
                        <a href="/riddles/{{ $riddle->id }}">{{ $riddle->title }}</a>
                    </h4>
                    <p class='date'>投稿日：{{ $riddle->created_at }}</p>
                </div>
                <br>
            @endforeach
            <div class='paginate'>
                {{ $user_riddle->links() }}
            </div>
        </div>
    </body>
</html>
@endsection