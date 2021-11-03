@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>謎解き投稿サイト</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <h1 align="center">マイページ</h1>
        <a href='/riddles/create'><input type="button" value="謎投稿"/></a>
        <h3>ユーザーネーム：{{Auth::user()->name}}</h3>
        <h3>投稿謎一覧</h3>
    </body>
</html>
@endsection