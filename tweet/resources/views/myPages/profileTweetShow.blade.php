@extends('layouts.layout')

@php
    $title = "ツイート一覧";
@endphp

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/mypage.css') }}">
@endsection

@section('title', $title)

@section('content')
    <div class="container">
        <p>{{ $user->name }}さんの投稿一覧</p>
        <table class="table table-striped">
            <tr>
                <th>投稿者</th><th>タイトル</th><th>本文</th><th>投稿日時</th><th></th>
            </tr>
            @foreach ($user->tweets as $tweet)
                <tr>
                    <td>{{ $tweet->user->name }}</td>
                    <td>{{ isset($tweet->title)? $tweet->title : '' }}</td>
                    <td>{{ $tweet->text }}</td>
                    <td>
                        @foreach ($tweet->tweetImages as $tweetImage)
                            @isset($tweetImage->image)
                                <img id="profile_img" src="{{ asset('storage/avatar/'. $tweetImage->image) }}" alt="avatar" />
                            @endisset
                        @endforeach
                    </td>
                    <td>{{ $tweet->updated_at }}</td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection

@section('footer')
    <br>copyright ishii 2018
@endsection