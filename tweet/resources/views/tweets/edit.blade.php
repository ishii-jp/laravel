@extends('layouts.layout')

@php
    $title = 'ツイート編集画面';
@endphp

@section('title', $title)

@section('content')
    <div class="container">
        @if ($errors->has('exception_message'))
            <strong class="errorMessage">{{ $errors->first('exception_message') }}</strong><br>
        @endif
        {{ Form::open(['url' => "/tweet/$tweet->id", 'method' => 'PATCH', 'files' => true]) }}
            <table class="table table-striped">
                <tr><th>{{ Form::label('title', 'タイトル') }}</th></tr>
                <tr><td>{{ Form::text('title', old('title', isset($tweet->title)? $tweet->title : ''), ['placeholder' => 'タイトル']) }}</td></tr>
                <tr><th>{{ Form::label('image[]', ' 画像アップロード(複数選択できます)') }}</th></tr>
                <tr><td>{{ Form::file('image[]', ['multiple']) }}</td></tr>
                <tr><td>{{ Form::textarea('text', old('text', isset($tweet->text)? $tweet->text : ''), ['placeholder' => '本文']) }}</td></tr>
            </table>
            {{ Form::submit('修正', ['class' => 'btn btn-success']) }}
        {{ Form::close() }}
    </div>
@endsection