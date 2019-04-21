@extends('layouts.layout')

@php
    $title = 'Store画面';
@endphp

@section('title', $title)

@section('content')
    <p>ツイート完了しました。</p>
    <p><a href="/tweet/{{ $user->id }}" class="btn btn-default active" role="button">自分の投稿はこちら</a></p>
    <p><a href="/tweet" class="btn btn-default active" role="button">ホームはこちら</a></p>
@endsection