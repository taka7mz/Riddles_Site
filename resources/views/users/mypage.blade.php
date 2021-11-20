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
            <a href='/riddles/new/create'><input type="button" value="謎投稿"/></a>
        </div>
        <h3>ユーザーネーム：{{ Auth::user()->name }}</h3>
        <br>
        <h3>投稿謎一覧</h3>
        <br>
        
        @if(empty($own_riddle[0]->user))
            <p>投稿した謎はありません</p>
        @else
            <div class='own_riddles'>
                @foreach($own_riddle as $riddle)
                    <div class='riddle'>
                        <h4 class='title'>
                            <a href="/riddles/{{ $riddle->id }}">{{ $riddle->title }}</a>
                        </h4>
                        <p class='date'>投稿日：{{ $riddle->created_at }}</p>
                    </div>
                    <br>
                @endforeach
                <div class='paginate'>
                    {{ $own_riddle->links() }}
                </div>
            </div>
        @endif
        
        <br>
        <h3>正解した謎一覧</h3>
        @if(empty($answer_riddle[0]))
            <p>正解した謎はありません</p>
        @else
            <div class='answer_riddles'>
                @foreach($answer_riddle as $riddle)
                    <div class='riddle'>
                        <h4 class='title'>
                            <a href="/riddles/{{ $riddle->id }}">{{ $riddle->title }}</a>
                        </h4>
                        <p class='creator'>作成者：<a href="/users/{{ $riddle->user_id }}">{{ $riddle->user->name }}</a></p>
                        <p class='date'>正解日：{{ $riddle->pivot->answer_date }}</p>
                    </div>
                    <br>
                @endforeach
                <div class='paginate'>
                    {{ $answer_riddle->links() }}
                </div>
            </div>
        @endif
        
        <div class="footer" align="center">
            <a href="/">トップへ戻る</a>
        </div>
    </body>
</html>
@endsection