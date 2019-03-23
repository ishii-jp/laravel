@extends('layouts.layout')

@php
    $title = 'プロフィール画面';
@endphp

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/mypage.css') }}">
@ensection

@section('title', $title)

@section('content')
    @isset($user->userInfo->avatar_filename)
        <img id="profile_img" src="{{ asset('storage/avatar/'. $user->userInfo->avatar_filename) }}" alt="avatar" />
    @endisset
    @include('myPages.profileTable')
@endsection

@section('footer')
    <br>copyright ishii 2018
@endsection