@extends('layouts.layout')

@php
    $title = 'ツイート画面';
@endphp

@section('title', $title)

@section('content')
    <div>
        {{ Form::open(['url' => '/tweet', 'method' => 'post', 'files' => true]) }}
            <table>
                <tr><th>{{ Form::label('title', 'タイトル') }}</th></tr>
                <tr><td>{{ Form::text('title', old('title'), ['placeholder' => 'タイトル']) }}</td></tr>
                <tr><th>{{ Form::label('image', ' 画像アップロード') }}</th></tr>
                <tr><td>{{Form::file('image')}}</td></tr>
                <tr><td>{{ Form::textarea('text', old('text'), ['placeholder' => '本文']) }}</td></tr>
            </table>
            {{ Form::submit('ツイート') }}
        {{ Form::close() }}
    </div>
@endsection

@section('footer')
    <br>copyright ishii 2018
@endsection