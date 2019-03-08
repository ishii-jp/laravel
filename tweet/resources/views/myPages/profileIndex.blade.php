@extends('layouts.layout')

@php
    $title = 'プロフィール画面';
@endphp

@section('title', $title)

@section('content')
    <p>{{ $user->name }}</p>
    <!-- ユーザーネームの横にプロフィール画像を入れたい -->
    <table>
        <tr><th>自己紹介</th><td>本文が入るスペース</td></tr>
        <tr><th>生年月日</th><td>本文が入るスペース</td></tr>
        <tr><th>居住地</th><td>本文が入るスペース</td></tr>
        <tr><th>血液型</th><td>本文が入るスペース</td></tr>
        <tr><th>趣味</th><td>本文が入るスペース</td></tr>
    </table>
@endsection

@section('footer')
    <br>copyright ishii 2018
@endsection