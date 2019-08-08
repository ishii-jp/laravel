@extends('layouts.layout')

@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/mypage.css') }}">
@endsection

@php
    $title = 'トップ画面';
@endphp

@section('title', $title)

@section('content')
    <div class="container">
        <div class="row">
            <p>タイムライン</p>
        </div>
        {{ Form::open(['url' => "/tweet", 'method' => 'post']) }}
            {{ Form::label('searchText', 'ツイート検索') }}
            {{ Form::text('searchText', old('title')) }}
            {{ Form::submit('検索') }}
        {{ Form::close() }}

        <p><a href="/tweet/create" class="btn btn-default active" role="button">ツイートする</a></p>
        @isset ($searchText)
            <h4><strong>{{ $searchText }}</strong>の検索結果です。</h4>
        @endisset

        @if ($tweets->isEmpty())
            <p>検索結果はありませんでした。</p>
        @else
            <table class="table table-striped">
                <tr>
                    <th>投稿者</th><th>タイトル</th><th>本文</th><th>投稿日時</th><th></th><th></th><th></th><th></th>
                </tr>
                @foreach ($tweets as $tweet)
                    <tr>
                        <td><a href="/mypage/profile/{{ $tweet->user->id }}">{{ $tweet->user->name }}</a></td>
                        <td>{{ isset($tweet->title)? nl2br(e($tweet->title)) : '' }}</td>
                        <td>
                            {!! nl2br(e( $tweet->text )) !!}
                            @foreach ($tweet->tweetImages as $tweetImage)
                                @isset($tweetImage->image)
                                    <img id="profile_img" src="{{ asset('storage/avatar/'. $tweetImage->image) }}" alt="avatar" />
                                @endisset
                            @endforeach
                        </td>

                        <td>{{ $tweet->updated_at }}</td>
                        <td><a href="/reply/{{ $tweet->id }}" class="btn btn-default active" role="button">返信</a></td>
                        <td><a href="/reply/show/{{ $tweet->id }}" class="btn btn-default active" role="button">この投稿への返信</a></td>
                        {{--                ここにこのツイートに対する返信があった場合はリンクを出力して、リンク先の画面で親ツイートと返信ツイートを全て出力します。--}}
                        {{--                @php var_dump($tweet->user); @endphp--}}
                        @if ($tweet->likes->isEmpty())
                            <td>
                                <button class="btn btn-success" id="like{{ $tweet->id }}" data-tweet_number="{{ $tweet->id }}">いいね！</button>
                            </td>
                        @else
                            <td>
                                <button class="btn btn-success" id="liked{{ $tweet->id }}" data-tweet_number="{{ $tweet->id }}">いいね済</button>
                            </td>
                        @endif
                        <td>
                            <a href="/like/userShow/{{ $tweet->id }}"><p class="text-success" id="likeCount{{ $tweet->id }}">いいね数{{ $tweet->likes_count }}</p></a>
                        </td>
                    </tr>
                @endforeach
            </table>
            {{ $tweets->links() }}
        @endif
        @include('likeRanking')
    </div>
@endsection