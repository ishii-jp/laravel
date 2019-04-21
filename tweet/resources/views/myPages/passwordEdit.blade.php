@extends('layouts.layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/errorMessage.css') }}">
@endsection

@php
    $title = 'ユーザーパスワード修正画面';
@endphp

@section('title', $title)

@section('content')
    <div class="container">
        <div>
        @if(Session::has('msg'))
            <p class="errorMessage">メッセージ：{{ session('msg') }}</p>
        @endif
        @if ($errors->has('exception_message'))
            <strong class="errorMessage">{{ $errors->first('exception_message') }}</strong><br>
        @endif
        {{ Form::open(['url' => "mypage/passwordStore"]) }}
            {{ Form::label('new_password', '現在のパスワード') }}
            {{ Form::password('new_password') }}<br>
            {{ Form::label('password', '新しいパスワード') }}
            {{ Form::password('password') }}<br>
            @if ($errors->has('password'))
                <strong class="errorMessage">{{ $errors->first('password') }}</strong><br>
            @endif
            {{ Form::label('password_confirmation', '新しいパスワード(確認用)') }}
            {{ Form::password('password_confirmation') }}<br>
            @if ($errors->has('password_confirmation'))
                <strong class="errorMessage">{{ $errors->first('password_confirmation') }}</strong><br>
            @endif
            {{ Form::submit('変更', ['class' => 'btn btn-success']) }}
        {{ Form::close() }}
        </div>
    </div>
@endsection