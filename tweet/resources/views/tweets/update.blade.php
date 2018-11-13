@extends('layouts.layout')

@php
    $title = 'ツイート編集完了画面';
@endphp

@section('title', $title)

@section('content')
    <div>
       <p>ツイートの編集が完了しました。</p>
       <a href="/tweet">ホームはこちら</a>
    </div>
@endsection

@section('footer')
    <br>copyright ishii 2018
@endsection