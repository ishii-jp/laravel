@extends('layouts.layout')

@php
    $title = 'ツイート編集画面';
@endphp

@section('title', $title)

@section('content')
    <div>
        <div>
        {{ Form::open(['url' => '/tweet/$tweet->id', 'method' => 'PATCH', 'files' => true]) }}
            {{ Form::label('title', 'タイトル') }}
            {{ Form::text('title', old('title', $tweet->title), ['placeholder' => 'タイトル']) }}
            {{ Form::label('image', ' 画像アップロード') }}
            {{Form::file('image')}}
            {{ Form::textarea('text', old('text', $tweet->text), ['placeholder' => '本文']) }}
            {{ Form::submit('ツイート') }}
        {{ Form::close() }}
        </div>
    </div>
@endsection

@section('footer')
    <br>copyright ishii 2018
@endsection