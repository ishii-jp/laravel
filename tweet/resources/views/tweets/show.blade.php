@extends('layouts.layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/mypage.css') }}">
@endsection

@php
    $title = 'ツイート一覧画面';
@endphp

@section('title', $title)

@section('content')
    <div class="container">
        <p>{{ $user->name }}さんの投稿一覧</p>
        <table class="table table-striped">
            <tr>
                <th>投稿者</th><th>タイトル</th><th>本文</th><th>投稿日時</th><th></th><th></th><th></th>
            </tr>
            @foreach ($tweets as $tweet)
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
                <td><span><a href="/tweet/{{ $tweet->id }}/edit" class="btn btn-default active" role="button">編集</a></span></td>
                {{ Form::open(['url' => "/tweet/$tweet->id"]) }}
                    {{ method_field('delete') }}
                    <td>{{ Form::submit('削除', ['class' => 'btn btn-success', 'onclick' => "return confirm('本当にツイートを削除しますか？')"])}}</td>
                {{ Form::close() }}
            </tr>
            @endforeach
        </table>
        {{ $tweets->links() }}
    </div>
@endsection