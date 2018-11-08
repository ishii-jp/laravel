@extends('layouts.layout')

@php
    $title = 'Store画面';
@endphp

@section('title', $title)

@section('content')
    <p>ツイート完了しました。</p>
    <p><a href="/tweet">ホームはこちら</a></p>
@endsection

@section('footer')
    copyright ishii 2018
@endsection