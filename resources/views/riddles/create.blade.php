@extends('layouts.app')

@section('content')
<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>謎解き投稿サイト</title>
    </head>
    <body>
        <h4 style="color:red">〜謎を投稿する際の注意事項〜</h4>
        <h5>・書籍や他の人が制作した謎を投稿するのではなく、<span style="color:red">必ず自分のオリジナリティ</span>を加えた謎を投稿してください</h5>
        <h5>・<span style="color:red">*</span>は必須項目です</h5>
        <h5>・謎本文に解答記入方法の記入もお願いいたします</h5>
        <h5>（謎本文の例）「？に入る言葉はなんでしょう。（解答は漢字で入力）」</h5><br>
        <div class="write">
            <form action="/riddles" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="title">
                    <h4>・謎タイトル<span style="color:red">*</span></h4>
                    <input type="text" name="riddle[title]" placeholder="ここに入力" value="{{ old('riddle.title') }}"/>
                    <p class="title__error" style="color:red">{{ $errors->first('riddle.title') }}</p>
                </div>
                <div class="text">
                    <h4>・謎本文<span style="color:red">*</span></h4>
                    <textarea name="riddle[text]" size="100px" placeholder="ここに入力">{{ old('riddle.text') }}</textarea>
                    <p class="text__error" style="color:red">{{ $errors->first('riddle.text') }}</p>
                </div>
                <div class="riddle_image">
                    <h4>・謎画像</h4>
                    <input type="file" name="riddle[image]" accept="riddle[image]/png, riddle[image]/jpeg" value="{{ old('riddle.image') }}">
                    <p class="text__error" style="color:red">{{ $errors->first('riddle.image') }}</p>
                </div>
                <div class="hint">
                    <h4>・謎ヒント<span style="color:red">*</span></h4>
                    <textarea name="riddle[hint]" placeholder="ここに入力">{{ old('riddle.hint') }}</textarea>
                    <p class="hint__error" style="color:red">{{ $errors->first('riddle.hint') }}</p>
                </div>
                <div class="answer">
                    <h4>・解答<span style="color:red">*</span></h4>
                    <input type="text" name="riddle[answer]" placeholder="全角で入力" value="{{ old('riddle.answer') }}"/>
                    <p class="answer__error" style="color:red">{{ $errors->first('riddle.answer') }}</p>
                </div>
                <div class="commentary">
                    <h4>・解説<span style="color:red">*</span></h4>
                    <textarea name="riddle[commentary]" placeholder="ここに入力">{{ old('riddle.commentary') }}</textarea>
                    <p class="commentary__error" style="color:red">{{ $errors->first('riddle.commentary') }}</p>
                </div>
                <input type="submit" value="投稿する"/>
            </form>
            <div class="back"><a href="/users/mypage"><input type="button" value="キャンセル"/></a></div>
        </div>
    </body>
</html>
@endsection