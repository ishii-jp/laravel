@extends('layouts.layout')

@php
    $title = 'プロフィール画面';
@endphp

@section('title', $title)

@section('content')
    <!-- ユーザーネームの横にプロフィール画像を入れたい -->
    @include('myPages.profileTable')
@endsection

@section('footer')
    <br>copyright ishii 2018
@endsection