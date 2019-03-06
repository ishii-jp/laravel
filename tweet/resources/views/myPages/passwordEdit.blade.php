@extends('layouts.layout')

@php
    $title = 'ユーザーパスワード修正画面';
@endphp

@section('title', $title)

@section('content')
    <div>
        <div>
        @if(Session::has('msg'))
            メッセージ：{{ session('msg') }}
        @endif
        @if ($errors->has('exception_message'))
            <strong>{{ $errors->first('exception_message') }}</strong><br>
        @endif
        <h3>編集する</h3>
        {{ Form::open(['url' => "mypage/passwordStore"]) }}
            {{ Form::label('new_password', '現在のパスワード') }}
            {{ Form::password('new_password') }}<br>
            {{ Form::label('password', '新しいパスワード') }}
            {{ Form::password('password') }}<br>
            @if ($errors->has('password'))
                <strong>{{ $errors->first('password') }}</strong><br>
            @endif
            {{ Form::label('password_confirmation', '新しいパスワード(確認用)') }}
            {{ Form::password('password_confirmation') }}<br>
            @if ($errors->has('password_confirmation'))
                <strong>{{ $errors->first('password_confirmation') }}</strong><br>
            @endif
            {{ Form::submit() }}
        {{ Form::close() }}
        </div>
    </div>
@endsection

@section('footer')
    <br>copyright ishii 2018
@endsection