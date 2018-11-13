@extends('layouts.layout')

@php
    $title = 'ツイート編集画面';
@endphp

@section('title', $title)

@section('content')
    <div>
        <div>
        <h3>編集する</h3>
        {{ Form::open(['url' => "tweet/$tweet->id", 'method' => 'PATCH']) }}
            <input placeholder="Image Url" type="text" name="image" value="{{ $tweet->image }}">
            <textarea cols="30" name="text" placeholder="投稿本文" rows="10">{{ $tweet->text }}</textarea>
            <input type="submit" value="編集">
        {{ Form::close() }}
        </div>
    </div>
@endsection

@section('footer')
    <br>copyright ishii 2018
@endsection