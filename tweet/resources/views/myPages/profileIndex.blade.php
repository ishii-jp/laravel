@extends('layouts.layout')

@php
    $title = 'プロフィール画面';
@endphp

@section('title', $title)

@section('content')
    <p>{{ $userInfo->name }}</p>
    <!-- ユーザーネームの横にプロフィール画像を入れたい -->
    <table>
        <tr><th>自己紹介</th><td>{{ $userInfo->profile }}</td></tr>
        <tr><th>生年月日</th><td>本文が入るスペース</td></tr>
        <tr><th>居住地</th><td>{{ $userInfo->residence }}</td></tr>
        <tr><th>血液型</th><td>{{ $userInfo->blood_type }}</td></tr>
        <tr><th>趣味</th><td>{{ $userInfo->hobby }}</td></tr>
    </table>
@endsection

@section('footer')
    <br>copyright ishii 2018
@endsection