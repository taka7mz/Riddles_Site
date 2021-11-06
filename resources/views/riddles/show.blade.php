@extends('layouts.app')

@section('content')
<?php
    $hint = $riddle->hint;
    $hint_json = json_encode( $hint );
    $commentary = $riddle->commentary;
    $commentary_json = json_encode( $commentary );
?>
<!DOCTYPE HTML>
<html lang="{{ str_replace("_", "-", app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>謎解き投稿サイト</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="/css/app.css">
        <link rel="stylesheet" href="/css/judge.css">
    </head>
    <body>
        <h2 class="title">
            {{ $riddle->title }}
        </h2>
        <p class='creator' align='right'>作成者：{{ optional($riddle->user)->name }}</p>
        <div class="riddle">
            <div class="riddle_content">
                <h3>{{ $riddle->text }}</h3><br>
                @if($riddle->image !== NULL)
                    <img src='/storage/riddle_img/{{ $riddle->image }}'>
                @endif
            </div>
        </div>
        <br><br>
        <div class="answer">
            <form action="" method="POST">
 		        @csrf
                <input type="text" name="user_ans" autocomplete="off" placeholder="全角で入力"/>
                <input type="submit" value="解答する"/>
            </form>
            @if(!empty($_POST["user_ans"]))
                <input type="checkbox" id="pop-up">
                <div class="overlay">
                    <div class="window">
	                    <label class="close" for="pop-up">×</label>
	                    @if($riddle->answer === $_POST["user_ans"])
                            <p class="correct">正解</p>
                            <p class="text">解説：</p>
                            <p class="text"> {{$riddle->commentary}} </p>
                        @else
                            <p class="incorrect">不正解</p>
                        @endif
                    </div>
                </div>
            @endif
        </div>
        <br>

        <label class="hint" for="pop-up_hint">ヒントを見る</label>
        <input type="checkbox" id="pop-up_hint">
        <div class="overlay_hint">
        	<div class="window_hint">
		        <label class="close" for="pop-up_hint">×</label>
		        <p class="text"> {{$riddle->hint}} </p>
	        </div>
        </div>
        <br><br>
        <div class="footer" align="center">
            <a href="/">戻る</a>
        </div>
    </body>
</html>
@endsection