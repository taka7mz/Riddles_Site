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
        <link rel="stylesheet" href="/css/top.css">
    </head>
    <body>
        <div class="site_title" align="center">謎解き投稿サイト</div><br>
        <div class="row" align="center">
             <!--投稿日が新しい謎を５件表示-->
            <div class="col-6">
                <h2 align="center">
                    <span style="color:red">?</span> 最新の謎 <span style="color:red">?</span>
                </h2>
                <div class="riddle_index">
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
                    @endforeach
                    <a href="/riddles/index/least"><br><h5>最新の謎一覧へ</h5></a>
                </div>
            </div>
             <!--星評価平均が高い上位５位の謎を表示-->
            <div class="col-6">
                <h2 align="center">👑 評価の高い謎ランキング　TOP5 👑</h2>
                <div class="ranking_index">
                    @foreach($rankings as $ranking)
                        <br><div class='ranking_riddle'>
                            <br><h3 class='rank_rid_title'>
                                {{ $loop->iteration }}位　<a href="/riddles/{{ $ranking->riddle_id }}">{{ $ranking->title }}</a>
                            </h3>
                            <span class='rank_rid_reator'>作成者：
                                @if($ranking->user_id  === Auth::id())
                                    <a href="/users/mypage">{{ $ranking->name }}</a>
                                @else
                                    <a href="/users/{{ $ranking->user_id }}">{{ $ranking->name }}</a>
                                @endif
                            </span>
                            <p class="review_average" style="margin-left:200px">
                                <star-rating v-bind:star-size=25 v-bind:rating={{ $ranking->star_avg }} v-bind:increment=0.01 v-bind:read-only="true"></star-rating>
                            </p>
                            <p class='rank_rid_date'>投稿日：{{ $ranking->riddle_date }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </body>
</html>
@endsection