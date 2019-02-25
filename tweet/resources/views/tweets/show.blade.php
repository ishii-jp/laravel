@extends('layouts.layout')

@php
    $title = 'ツイート一覧画面';
@endphp

@section('title', $title)

@section('content')
    <p>{{ $user->name }}さんの投稿一覧</p>
        <table>
            <tr>
                <th>投稿者</th><th>イメージ</th><th>本文</th><th>投稿日時</th>
            </tr>
            @foreach ($tweets as $tweet)
            <tr>
                <td>{{ $tweet->user->name }}</td>
                <td>{{ $tweet->image }}</td>
                <td>{{ $tweet->text }}</td>
                <td>{{ $tweet->updated_at }}</td>
                <td><span><a href="/tweet/{{ $tweet->id }}/edit">編集　</a></span></td>
                
                <!-- <form action="/tweet/{{ $tweet->id }}" method="post"> -->
                {{ Form::open(['url' => "/tweet/$tweet->id"]) }}
                    {{ method_field('delete') }}
                    <!-- <td><span><a href="/tweet/{{ $tweet->id }}/delete">削除　</a></span></td> -->
                    <td>{{ Form::submit('削除')}}</td>
                {{ Form::close() }}
                <!-- </form> -->
            </tr>
            @endforeach
        </table>
@endsection

@section('footer')
    <br>copyright ishii 2018
@endsection