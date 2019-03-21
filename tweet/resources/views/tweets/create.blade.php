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
        {{ Form::open(['url' => '/tweet', 'method' => 'post', 'files' => true]) }}
            <table>
                <tr><th>{{ Form::label('title', 'タイトル') }}</th></tr>
                <tr><td>{{ Form::text('title', old('title'), ['placeholder' => 'タイトル']) }}</td></tr>
                @if ($errors->has('image.*'))
                    <tr><td class="errorMessage">{{ $errors->first('image.*') }}</tr></td>
                @endif
                <tr><th>{{ Form::label('image[]', ' 画像アップロード(複数選択できます)') }}</th></tr>
                <tr><td>{{ Form::file('image[]', ['multiple']) }}</td></tr>
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


<!-- {{ Form::open(['url' => '/tweet', 'method' => 'post', 'files' => true]) }}
            <table>
                <tr><th>{{ Form::label('title', 'タイトル') }}</th></tr>
                <tr><td>{{ Form::text('title', old('title'), ['placeholder' => 'タイトル']) }}</td></tr>
                <tr><th>{{ Form::label('image', ' 画像アップロード') }}</th></tr>
                <tr><td>{{Form::file('image')}}</td></tr>
                <tr><td>{{ Form::textarea('text', old('text'), ['placeholder' => '本文']) }}</td></tr>
            </table>
            {{ Form::submit('ツイート') }}
        {{ Form::close() }} -->