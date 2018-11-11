@extends('layouts.layout')

@php
    $title = 'Store画面';
@endphp

@section('title', $title)

@section('content')
    <p>ツイート完了しました。</p>
    <p><a href="/tweet/{{ $user->id }}">自分の投稿はこちら</a></p>
    <p><a href="/tweet">ホームはこちら</a></p>
@endsection

@section('footer')
    <br>copyright ishii 2018
@endsection