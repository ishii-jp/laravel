@extends('layouts.layout')

@php
    $title = 'ツイート編集画面';
@endphp

@section('title', $title)

@section('content')
    <div>
        <div>
        <h3>編集する</h3>
        <form action="/tweet/{tweet}" method="put">
            <input placeholder="Image Url" type="text" name="image" value="{{ $tweet->image }}">
            <textarea cols="30" name="text" placeholder="text" rows="10" value="{{ $tweet->text }}"></textarea>
            <input type="submit" value="編集">
        </form>
        </div>
    </div>
@endsection

@section('footer')
    <br>copyright ishii 2018
@endsection