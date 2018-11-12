@extends('layouts.layout')

@php
    $title = 'ツイート画面';
@endphp

@section('title', $title)

@section('content')
    <div>
        <div>
        {{ Form::open(['url' => '/tweet', 'method' => 'post']) }}
            <h3>投稿する</h3>
            <!-- <input placeholder="nickname" type="text" name="name"> -->
            <input placeholder="Image Url" type="text" name="image" value="{{ old('image') }}">
            <textarea cols="30" name="text" placeholder="text" rows="10" value="{{ old('text') }}"></textarea>
            <input type="submit" value="SENT">
        {{ Form::close() }}
        </div>
    </div>
@endsection

@section('footer')
    <br>copyright ishii 2018
@endsection