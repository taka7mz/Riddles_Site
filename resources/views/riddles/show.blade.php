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
        <link rel="stylesheet" href="/judge.css">
    </head>
    <body>
        <h2 class="title">
            {{ $riddle->title }}
        </h2>
        <div class="riddle">
            <div class="riddle_content">
                <h3>{{ $riddle->text }}</h3>
                @if($riddle->image !== NULL)
                    <img src='/storage/riddle_img/{{ $riddle->image }}'>
                @endif
            </div>
        </div>
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
                            <p class="text">正解</p>
                            <p class="text">解説：</p>
                            <p class="text"> {{$riddle->commentary}} </p>
                        @else
                            <p class="text">不正解</p>
                        @endif
                    </div>
                </div>
            @endif
        </div>
        <div class="hint">
            <button type="submit" onclick="return Hint();">ヒント</button>
        </div>
        <br><br>
        <div class="footer" align="center">
            <a href="/">戻る</a>
        </div>
        
        <script>
            function Hint(){
	            var hint = JSON.parse('<?php echo $hint_json; ?>');  //JSONデコード
	            alert(hint);
            }   
        </script>
    </body>
</html>