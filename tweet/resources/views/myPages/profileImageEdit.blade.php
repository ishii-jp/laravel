@extends('layouts.layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/mypage.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/errorMessage.css') }}">
@endsection

@php
    $title = 'プロフィール画像登録画面';
@endphp

@section('title', $title)

@section('content')
    <div class="container">
        @if (session('success'))
            <p>{{ session('success') }}</p>
        @endif

        @if ($errors->has('exception_message'))
            <strong class="errorMessage">{{ $errors->first('exception_message') }}</strong><br>
        @endif

        @if ($errors->has('file'))
            <strong class="errorMessage">{{ $errors->first('file') }}</strong><br>
        @endif

        @isset($user->userInfo->avatar_filename)
            <img id="profile_edit_img" src="{{ asset('storage/avatar/'. $user->userInfo->avatar_filename) }}" alt="avatar" />
            <p>アバターを削除するには下記削除ボタンを押してください。</p>
            {{ Form::open(['url' => '/mypage/profile/imageDelete']) }}
                {{ method_field('DELETE') }}
                {{ Form::submit('削除', ['class' => 'btn btn-default btn-sm', 'onclick' => "return confirm('本当にアバターを削除しますか？')"]) }}
            {{ Form::close() }}
        @endisset
        {{ Form::open(['url' => '/mypage/profile/image', 'files' => true]) }}
            {{ Form::label('file', '画像アップロード', ['class' => 'control-label']) }}
            {{ Form::file('file') }}
            {{ Form::submit('アップロード',['class' => 'btn btn-default btn-sm']) }}
        {{ Form::close() }}
    </div>
@endsection

@section('footer')
    <br>copyright ishii 2018
@endsection