@extends('layouts.layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/errorMessage.css') }}">
@endsection

@php
    $title = 'ツイート画面';
@endphp

@section('title', $title)

@section('content')
    @if ($errors->has('*'))
        <p class="errorMessage">※入力に不備がありますのでご確認ください。</p>
    @endif
    <div>
    @if ($errors->has('exception_message'))
        <strong class="errorMessage">{{ $errors->first('exception_message') }}</strong><br>
    @endif
        @if (Request::path() == 'tweet/create')
            {{ Form::open(['url' => '/tweet', 'method' => 'post', 'files' => true]) }}
        @else
            {{ Form::open(['url' => "/reply/store/$tweetId", 'method' => 'post']) }}
        @endif
            <table>
                <tr><th>{{ Form::label('title', 'タイトル') }}</th></tr>
                <tr><td>{{ Form::text('title', old('title'), ['placeholder' => 'タイトル']) }}</td></tr>
                @if ($errors->has('image.*'))
                    <tr><td class="errorMessage">{{ $errors->first('image.*') }}</tr></td>
                @endif
                @if(Request::path() == 'tweet/create')
                    <tr><th>{{ Form::label('image[]', ' 画像アップロード(複数選択できます)') }}</th></tr>
                    <tr><td>{{ Form::file('image[]', ['multiple']) }}</td></tr>
                @endif
                @if ($errors->has('text'))
                    <tr><td class="errorMessage">{{ $errors->first('text') }}</tr></td>
                @endif
                <tr><td>{{ Form::textarea('text', old('text'), ['placeholder' => '本文']) }}</td></tr>
            </table>
            {{ Form::submit('ツイート') }}
        {{ Form::close() }}
    </div>
@endsection

@section('footer')
    <br>copyright ishii 2018
@endsection