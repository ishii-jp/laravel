@extends('layouts.layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/mypage.css') }}">
@endsection

@php
    $title = 'いいねユーザー一覧画面';
@endphp

@section('title', $title)

@section('content')
    <div class="container">
        <div class="row">
            <p>いいねしたユーザー一覧</p>
        </div>
        @php $number = 1; @endphp
        <table class="table table-striped">
        <tr><th>No.</th><th>ユーザー名</th></tr>
            @foreach ($likeUsers->likes as $likeUser)
            <tr>
                <td>{{ $number }}</td>
                <td><a href="/mypage/profile/{{ $likeUser->user_id }}">{{ $likeUser->user->name }}</a></td>
            </tr>
            @php $number++; @endphp
            @endforeach
        </table>
    </div>
@endsection