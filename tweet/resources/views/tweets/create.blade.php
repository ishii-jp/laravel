@extends('layouts.layout')

@php
    $title = 'ツイート画面';
@endphp

@section('title', $title)

@section('content')
    <div>
        <div>
        {{ Form::open(['url' => '/tweet', 'method' => 'post', 'files' => true]) }}
            <h3>投稿する</h3>
            <!-- <input placeholder="nickname" type="text" name="name"> -->
            {{ Form::text('image', old('image'), ['placeholder' => 'image']) }}
            <!-- 画像をアップロードするタグ -->
            <!-- {{Form::file('Image')}} -->
            {{ Form::textarea('text', old('text'), ['placeholder' => 'text']) }}
            {{ Form::submit() }}
        {{ Form::close() }}
        </div>
    </div>
@endsection

@section('footer')
    <br>copyright ishii 2018
@endsection