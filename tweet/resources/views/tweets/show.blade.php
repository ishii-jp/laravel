@extends('layouts.layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/mypage.css') }}">
@endsection

@php
    $title = 'ツイート一覧画面';
@endphp

@section('title', $title)

@section('content')
    <p>{{ $user->name }}さんの投稿一覧</p>
        <table>
            <tr>
                <th>投稿者　</th><th>タイトル　</th><th>本文　</th><th>投稿日時　</th>
            </tr>
            @foreach ($tweets as $tweet)
            <tr>
                <td>{{ $tweet->user->name }}</td>
                <td>{{ isset($tweet->title)? $tweet->title : '' }}</td>
                <td>{{ $tweet->text }}</td>
                <td>
                    @isset($tweet->image)
                        <img id="profile_img" src="{{ asset('storage/avatar/'. $tweet->image) }}" alt="avatar" /">
                    @endisset
                </td>
                <td>{{ $tweet->updated_at }}</td>
                <td><span><a href="/tweet/{{ $tweet->id }}/edit">編集　</a></span></td>
                {{ Form::open(['url' => "/tweet/$tweet->id"]) }}
                    {{ method_field('delete') }}
                    <td>{{ Form::submit('削除', ['onclick' => "return confirm('本当にツイートを削除しますか？')"])}}</td>
                {{ Form::close() }}
            </tr>
            @endforeach
        </table>
@endsection

@section('footer')
    <br>copyright ishii 2018
@endsection