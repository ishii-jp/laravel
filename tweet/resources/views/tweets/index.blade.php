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
                    @foreach ($tweet->tweetImages as $tweetImage)
                        @isset($tweetImage->image)
                            <img id="profile_img" src="{{ asset('storage/avatar/'. $tweetImage->image) }}" alt="avatar" />
                        @endisset
                    @endforeach
                </td>
                
                <td>{{ $tweet->updated_at }}</td>
                <td><a href="/reply/{{ $tweet->id }}">返信</a></td>
                <td><a href="/reply/show/{{ $tweet->id }}">　この投稿への返信</a></td>
{{--                ここにこのツイートに対する返信があった場合はリンクを出力して、リンク先の画面で親ツイートと返信ツイートを全て出力します。--}}
{{--                @php var_dump($tweet->user); @endphp--}}
            </tr>
            @endforeach
    </table>
    {{ $tweets->links() }}
@endsection

@section('footer')
    <br>copyright ishii 2018
@endsection