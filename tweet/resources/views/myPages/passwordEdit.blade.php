@extends('layouts.layout')

@php
    $title = 'ユーザーパスワード修正画面';
@endphp

@section('title', $title)

@section('content')
    <div>
        <div>
        @isset($msg)
            {{ $msg }}
        @endisset
        <h3>編集する</h3>
        {{ Form::open(['url' => "mypage/passwordStore"]) }}
            {{ Form::label('new_password', '現在のパスワード') }}
            {{ Form::password('new_password') }}<br>
            {{ Form::label('password', '新しいパスワード') }}
            {{ Form::password('password') }}<br>
            @if ($errors->has('password'))
                <strong>{{ $errors->first('password') }}</strong><br>
            @endif
            {{ Form::label('password_confirmation', '確認用パスワード') }}
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