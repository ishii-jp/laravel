@extends('layouts.layout')

@php
    $title = 'トップ画面';
@endphp

@section('title', $title)

@section('content')
    <p>簡易的ツイッター</p>
    <div>
        <ul>
            @if (Auth::check())
                <li><a href="/logout">ログアウト</a></li> 
            @else
                <li><a href="/login">ログイン</a></li>
                <li><a href="/register">新規登録</a></li>
            @endif
        </ul>
    </div>
@endsection

@section('footer')
    copyright ishii 2018
@endsection