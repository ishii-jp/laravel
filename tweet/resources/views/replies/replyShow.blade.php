@extends('layouts.layout')


@php
    $title = '返信一覧画面';
@endphp

@section('title', $title)

@section('content')
    <div class="container">
        <table>
            <tr>
                <th>投稿者　</th><th>タイトル　</th><th>本文　</th><th>投稿日時</th>
            </tr>
            <tr>
                <td>{{ $tweets->user->name }}</td>
                <td>{{ $tweets->title }}</td>
                <td>{{ $tweets->text }}</td>
                <td>{{ $tweets->updated_at }}</td>
            </tr>
        </table>
        <table>
            <tr><th>{{ $tweets->user->name }}への返信↓</th></tr>
            @foreach($tweets->replies as $reply)
                @if(empty($reply))
                    <p>返信はありません。</p>
                @else
                <tr>
                    <td><a href="/mypage/profile/{{ $reply->user_id }}">{{ $reply->user->name }}</a></td>
                    <td>{{ $reply->title }}</td>
                    <td>{{ $reply->text }}</td>
                    <td>　{{ $reply->updated_at }}</td>
                </tr>
                @endif
            @endforeach
        </table>
    </div>
@endsection