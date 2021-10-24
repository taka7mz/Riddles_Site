<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>謎解き投稿サイト</title>
    </head>
    <body>
        <form action="/riddles" method="POST">
            @csrf
            <div class="title">
                <h2>謎タイトル</h2>
                <input type="text" name="riddle[title]" placeholder="ここに入力"/>
                <p class="title__error" style="color:red">{{ $errors->first('タイトル') }}</p>
            </div>
            <div class="text">
                <h2>謎本文</h2>
                <textarea name="riddle[text]" placeholder="ここに入力"></textarea>
                <p class="text__error" style="color:red">{{ $errors->first('本文') }}</p>
            </div>
            <div class="hint">
                <h2>謎ヒント</h2>
                <textarea name="riddle[hint]" placeholder="ここに入力"></textarea>
                <p class="hint__error" style="color:red">{{ $errors->first('ヒント') }}</p>
            </div>
            <div class="answer">
                <h2>解答</h2>
                <input type="text" name="riddle[answer]" placeholder="ここに入力"/>
                <p class="answer__error" style="color:red">{{ $errors->first('解答') }}</p>
            </div>
            <div class="commentary">
                <h2>解説</h2>
                <textarea name="riddle[commentary]" placeholder="ここに入力"></textarea>
                <p class="commentary__error" style="color:red">{{ $errors->first('解説') }}</p>
            </div>
            <input type="submit" value="投稿する"/>
        </form>
        <div class="back"><a href="/"><input type="button" value="キャンセル"/></a></div>
    </body>
</html>