@extends('layouts.app')

@section('content')
<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>謎解き投稿サイト</title>
    </head>
    <body>
        <h4 style="color:red">〜コメントする際の注意事項〜</h4>
        <h5>投稿者に対しての誹謗中傷や否定的なコメントはしないでください</h5><br>
        <form action="/riddles/{{ $riddle->id }}/review" method="POST">
            @csrf
            <input name="review[star]" type="hidden" id="stars">
            <div id="star">
                <star-rating v-bind:star-size=35 @rating-selected="setRating"></star-rating>
            </div><br>
            <div class="text">
                <h3>コメント</h3>
                <textarea name="review[comment]" placeholder="ここに入力">{{ old('review.comment') }}</textarea>
                <p class="text__error" style="color:red">{{ $errors->first('review.comment') }}</p>
            </div>
            <input type="submit" value="コメントする"/>
        </form>
        <div class="back"><a href="/riddles/{{ $riddle->id }}"><input type="button" value="キャンセル"/></a></div>
    </body>
</html>
@endsection