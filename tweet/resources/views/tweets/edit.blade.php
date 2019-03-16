@extends('layouts.layout')

@php
    $title = 'ツイート編集画面';
@endphp

@section('title', $title)

@section('content')
    {{ Form::open(['url' => "/tweet/$tweet->id", 'method' => 'PATCH', 'files' => true]) }}
        <table>
            <tr><th>{{ Form::label('title', 'タイトル') }}</th></tr>
            <tr><td>{{ Form::text('title', old('title', isset($tweet->title)? $tweet->title : ''), ['placeholder' => 'タイトル']) }}</td></tr>
            <tr><th>{{ Form::label('image', ' 画像アップロード') }}</th></tr>
            <tr><td>{{Form::file('image')}}</td></tr>
            <tr><td>{{ Form::textarea('text', old('text', isset($tweet->text)? $tweet->text : ''), ['placeholder' => '本文']) }}</td></tr>
        </table>
        {{ Form::submit('修正') }}
    {{ Form::close() }}
@endsection

@section('footer')
    <br>copyright ishii 2018
@endsection