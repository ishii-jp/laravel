@extends('layouts.layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/mypage.css') }}">
@endsection

@php
    $title = 'ユーザー情報画面';
@endphp

@section('title', $title)

@section('content')
    <div class="container">
        @isset($user->userInfo->avatar_filename)
            <img id="profile_img" src="{{ asset('storage/avatar/'. $user->userInfo->avatar_filename) }}" alt="avatar" />
        @endisset
        <span>最後にログインした日時　</span>{{ $user->last_login_at }}<br>
        @include('myPages.profileTable')

        <a href="/mypage/edit" class="btn btn-default btn-sm active" role="button">ユーザー情報を変更</a><br>
        <a href="/mypage/profile/image" class="btn btn-default btn-sm active" role="button">プロフィール画像の登録/変更</a><br>
        <a href="/mypage/passwordEdit" class="btn btn-default btn-sm active" role="button">パスワードを変更</a><br>
    </div>
@endsection