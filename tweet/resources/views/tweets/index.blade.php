@extends('layouts.layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/mypage.css') }}">
@endsection

@php
    $title = 'トップ画面';
@endphp

@section('title', $title)

@section('content')
    <p>タイムライン</p>
    <p><a href="/tweet/create">ツイートする</a></p>
    <table>
            <tr>
                <th>投稿者　</th><th>タイトル　</th><th>本文　</th><th>投稿日時</th>
            </tr>
            @foreach ($tweets as $tweet)
            <tr>
                <td><a href="/mypage/profile/{{ $tweet->user->id }}">{{ $tweet->user->name }}</a></td>
                <td>{{ isset($tweet->title)? $tweet->title : '' }}</td>
                <td>
                    {{ $tweet->text }}
                    @isset($tweet->image)
                        <img id="profile_img" src="{{ asset('storage/avatar/'. $tweet->image) }}" alt="avatar" />
                    @endisset
                </td>
                
                <td>{{ $tweet->updated_at }}</td>
            </tr>
            @endforeach
    </table>
@endsection

@section('footer')
    <br>copyright ishii 2018
@endsection