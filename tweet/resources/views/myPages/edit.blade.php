@extends('layouts.layout')

@php
    $title = 'ユーザー情報修正画面';
@endphp

@section('title', $title)

@section('content')
    <div>
        <div>
        <h3>編集する</h3>
        {{ Form::open(['url' => "mypage/store"]) }}
            {{ Form::label('name') }}
            {{ Form::text('name', old('name', $user->name)) }}<br>
            {{ Form::label('email') }}
            {{ Form::text('email', old('email', $user->email)) }}<br>
            {{ Form::submit() }}
        {{ Form::close() }}
        </div>
    </div>
@endsection

@section('footer')
    <br>copyright ishii 2018
@endsection