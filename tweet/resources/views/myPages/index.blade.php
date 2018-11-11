@extends('layouts.layout')

@php
    $title = 'マイページ画面';
@endphp

@section('title', $title)

@section('content')
    <p>{{ $user->name }}さんこんにちは。</p>
    <p><a href="/tweet/{{ $user->id }}">自分の投稿一覧</a></p>
    <!-- まだ機能実装してません -->
    <p><a href="">ユーザー情報</a></p>
    
@endsection

@section('footer')
    <br>copyright ishii 2018
@endsection