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
            ・{{ $riddle->title }}
        </h2>
        @if(Auth::id() === $riddle->user_id)
        <div class='delete' align='right'>
                <form action="/riddles/{{ $riddle->id }}/delete" id="form_delete" method="post" style="display:inline">
                    @csrf
                    @method('DELETE')
                </form>
                <button type="submit" onclick="return deletePost();">削除</button> 
        </div>
        @else
            <p class='creator' align='right'>作成者：{{ optional($riddle->user)->name }}　　</p>
        @endif
        <div class="riddle" align='center'>
            <div class="riddle_content">
                <h3>{{ $riddle->text }}</h3>
                @if($riddle->image !== NULL)
                    <br><img src='/storage/riddle_img/{{ $riddle->image }}'>
                @endif
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
         </div>
        <br><br>
        <div class="footer" align="center">
            <a href="javascript:history.back()">戻る</a>
        </div>
        
        <script>
            function deletePost(){
                'use strict';
                if(confirm('削除すると元に戻せません。削除しますか？')){
                   document.getElementById('form_delete').submit();
                }
            }   
        </script>
    </body>
</html>
@endsection