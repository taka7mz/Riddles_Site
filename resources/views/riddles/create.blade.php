<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>謎解き投稿サイト</title>
    </head>
    <body>
        <form action="/riddles" method="POST" enctype="multipart/form-data">
            @csrf
            {{ $errors }}
            <div class="title">
                <h2>謎タイトル</h2>
                <input type="text" name="riddle[title]" placeholder="ここに入力" value="{{ old('riddle.title') }}"/>
                <p class="title__error" style="color:red">{{ $errors->first('riddle.title') }}</p>
            </div>
            <div class="text">
                <h2>謎本文</h2>
                <textarea name="riddle[text]" placeholder="ここに入力">{{ old('riddle.text') }}</textarea>
                <p class="text__error" style="color:red">{{ $errors->first('riddle.text') }}</p>
            </div>
            <div class="riddle_image">
                <h2>謎画像</h2>
                <input type="file" name="imgpath">
            </div>
            <div class="hint">
                <h2>謎ヒント</h2>
                <textarea name="riddle[hint]" placeholder="ここに入力">{{ old('riddle.hint') }}</textarea>
                <p class="hint__error" style="color:red">{{ $errors->first('riddle.hint') }}</p>
            </div>
            <div class="answer">
                <h2>解答</h2>
                <input type="text" name="riddle[answer]" placeholder="全角で入力" value="{{ old('riddle.answer') }}"/>
                <p class="answer__error" style="color:red">{{ $errors->first('riddle.answer') }}</p>
            </div>
            <div class="commentary">
                <h2>解説</h2>
                <textarea name="riddle[commentary]" placeholder="ここに入力">{{ old('riddle.commentary') }}</textarea>
                <p class="commentary__error" style="color:red">{{ $errors->first('riddle.commentary') }}</p>
            </div>
            <input type="submit" value="投稿する"/>
        </form>
        <div class="back"><a href="/"><input type="button" value="キャンセル"/></a></div>
    </body>
</html>