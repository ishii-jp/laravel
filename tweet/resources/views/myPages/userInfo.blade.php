@extends('layouts.layout')

@php
    $title = 'ユーザー情報画面';
@endphp

@section('title', $title)

@section('content')
    <span>最後にログインした日時　</span>{{ $user->last_login_at }}<br>
    @include('myPages.profileTable')
    <a href="/mypage/edit">ユーザー情報を変更する</a><br>
    <a href="/mypage/passwordEdit">パスワードを変更する</a><br>
    
@endsection

@section('footer')
    <br>copyright ishii 2018
@endsection