@extends('layouts.layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/mypage.css') }}">
@endsection

@php
    $title = 'いいね一覧画面';
@endphp

@section('title', $title)

@section('content')
    <div class="container">
        <div class="row">
            <p>いいねした投稿一覧</p>
        </div>
        @php $number = 1; @endphp
        <table class="table table-striped">
        <tr><th>No.</th><th>投稿ユーザー</th><th>ツイート</th></tr>
            @foreach ($likes as $like)
            <tr>
                <td>{{ $number }}</td>
                <td><a href="/mypage/profile/{{ $like->user_id }}">{{ $like->tweet->user->name }}</a></td>
                <td>{{ $like->tweet->text }}</td>
            </tr>
            @php $number++; @endphp
            @endforeach
        </table>
        <a href="/mypage">前へ戻る</a>
    </div>
@endsection