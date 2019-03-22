@extends('layouts.layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/errorMessage.css') }}">
@endsection

@php
    $title = 'マイページ画面';
@endphp

@section('title', $title)

@section('content')
    @if ($errors->has('exception_message'))
        <strong class="errorMessage">ツイート削除の工程でエラーが発生しました。<br>{{ $errors->first('exception_message') }}</strong><br>
    @endif
    <p>{{ $user->name }}さんこんにちは。</p>
    <p><a href="/tweet/{{ $user->id }}">自分の投稿一覧</a></p>
    <p><a href="/mypage/userinfo/">ユーザー情報</a></p>
    <!-- <p><a href="/mypage/profile/{{ $user->id }}">プロフィール</a></p> -->
    
@endsection

@section('footer')
    <br>copyright ishii 2018
@endsection