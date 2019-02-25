@extends('layouts.layout')

@php
    $title = 'マイページ画面';
@endphp

@section('title', $title)

@section('content')
    <p>{{ $user->name }}さんこんにちは。</p>
    <p><a href="/tweet/{{ $user->id }}">自分の投稿一覧</a></p>
    <p><a href="/mypage/userinfo/">ユーザー情報</a></p>
    
@endsection

@section('footer')
    <br>copyright ishii 2018
@endsection