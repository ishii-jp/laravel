@extends('layouts.layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/errorMessage.css') }}">
@endsection

@php
    $title = 'マイページ画面';
@endphp

@section('title', $title)

@section('content')
    <div class="container">
        @if ($errors->has('exception_message'))
            <strong class="errorMessage">ツイート削除の工程でエラーが発生しました。<br>{{ $errors->first('exception_message') }}</strong><br>
        @endif
        <div class="row">
            <p>{{ $user->name }}さんこんにちは。</p>
        </div>
        <p><a href="/tweet/{{ $user->id }}" class="btn btn-default active" role="button">自分の投稿一覧</a></p>
        <p><a href="/like/show" class="btn btn-default active" role="button">いいねした投稿</a></p>
        <p><a href="/mypage/userinfo/" class="btn btn-default active" role="button">ユーザー情報</a></p>
    </div>
@endsection