@extends('layouts.layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/mypage.css') }}">
@ensection

@php
    $title = 'プロフィール画像登録画面';
@endphp

@section('title', $title)

@section('content')
    @if (session('success'))
        {{ session('success') }}
    @endif
    @if(isset($success))
        {{ $success }}
    @endif

    @if ($errors->has('file'))
        {{ $errors->first('file') }}
    @endif

    @isset($userInfo->avatar_filename)
        <img id="profile_edit_img" src="{{ asset('storage/avatar/'. $userInfo->avatar_filename) }}" alt="avatar" />
    @endisset
    {{ Form::open(['url' => '/mypage/profile/image', 'files' => true])}}
        {{ Form::label('file', '画像アップロード', ['class' => 'control-label']) }}
        {{ Form::file('file') }}
        {{ Form::submit('アップロード') }}
    {{ Form::close() }}
@endsection

@section('footer')
    <br>copyright ishii 2018
@endsection