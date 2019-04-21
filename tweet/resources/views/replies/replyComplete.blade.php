@extends('layouts.layout')


@php
    $title = '返信完了画面';
@endphp

@section('title', $title)

@section('content')
    <div class="container">
        <h4>返信が完了しました。</h4>
        <a href="/" class="btn btn-default btn-lg active" role="button">トップページ</a>
    </div>
@endsection