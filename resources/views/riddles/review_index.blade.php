@extends('layouts.app')

@section('content')
<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>謎解き投稿サイト</title>
    </head>
    <body>
        @foreach($reviews as $review)
            <div class='review'>
                <h5>投稿者：{{ $review->user->name }}</h5>
                <star-rating v-bind:star-size=20 v-bind:rating={{ $review->star }} v-bind:increment=0.01 v-bind:read-only="true"></star-rating>
                <p>{{ $review->comment }}</p>
                <p>{{ $review->review_date }}</p>
            </div>
            <br>
        @endforeach
        <div class='paginate'>
            {{ $reviews->links() }}
        </div>
        <div class="footer" align="center">
            <a href="/riddles/{{ $riddle->id }}">謎へ戻る</a>
        </div>
    </body>
</html>
@endsection