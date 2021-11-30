@extends('layouts.app')

@section('content')

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
        <div class="review_average" style="margin-left:15px">
            @if($average === -1)
                <p>まだレビューはありません</p>
            @else
                <star-rating v-bind:star-size=25 v-bind:rating={{ $average }} v-bind:increment=0.01 v-bind:read-only="true"></star-rating>
            @endif
        </div>
        @if(Auth::id() === $riddle->user_id)
        <div class='delete' align='right'>
            <form action="/riddles/{{ $riddle->id }}/delete" id="form_delete" method="post" style="display:inline">
                @csrf
                @method('DELETE')
            </form>
            <button type='submit' onclick='return deleteRiddle();'>削除</button> 
        </div>
        @else
            <p class='creator' align='right'>作成者：{{ $riddle->user->name }}　　</p>
        @endif
        <div class='riddle' align='center'>
            <div class='riddle_content'>
                <h3>{{ $riddle->text }}</h3>
                @if($riddle->image)
                    <br><img src='{{ $riddle->image }}'>
                @endif
            </div>
            <br><br>
            <div class='answer'>
                <form action='/riddles/{{ $riddle->id }}/answer' method='POST'>
     		        @csrf
                    <input type='text' name='user_ans' autocomplete='off' placeholder='全角で入力'/>
                    <input type='submit' value='解答する'/>
                </form>
                @if($status)
                    <input type="checkbox" id="pop-up">
                    <div class="overlay">
                        <div class="window">
    	                    <label class="close" for="pop-up">×</label>
    	                    @if($status === 'correct')
                                <p class="correct">正解</p>
                                <p class="commentary">解説：{{$riddle->commentary}} </p>
                            @elseif($status === 'false')
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
    		        <p class="hint_text"> {{$riddle->hint}} </p>
    	        </div>
            </div>
        </div>
        <br>
        <div class="review" style="margin-left:15px">
            <h4>・最新のレビュー</h4>
            @if($latest_review)
                <h5>投稿者：{{ $latest_review->user->name }}</h5>
                <star-rating v-bind:star-size=20 v-bind:rating={{ $latest_review->star }} v-bind:increment=1 v-bind:read-only="true"></star-rating>
                <p>{{ $latest_review->comment }}</p>
                <p>{{ $latest_review->review_date }}</p>
                <a href="/riddles/{{ $riddle->id }}/review/index">全てのレビューを参照する</a>
            @else
                <p>まだレビューはありません</p>
            @endif
            <br><br>
            @if(Auth::Id() && Auth::Id() !== $riddle->user_id && $reviewer === false)
                <a href="/riddles/{{ $riddle->id }}/review">この謎をレビューする</a>
            @elseif(Auth::Id() !== $riddle->user_id && $reviewer)
                <p>あなたはこの謎をすでに評価済みです</p>
            @endif
        </div>
        <div class="footer" align="center">
            @if(Auth::Id() === $riddle->user_id)
                <a href="/users/mypage">マイページへ</a>
            @else
                <a href="/users/{{ $riddle->user_id }}">{{ $riddle->user->name }}の謎一覧へ</a>
            @endif
            <br><a href="/">ホームへ</a>
        </div>
    </body>
</html>
@endsection

<script>
    function deleteRiddle(){
        'use strict';
        if(confirm('削除すると元に戻せません。削除しますか？')){
           document.getElementById('form_delete').submit();
        }
    }   
</script>