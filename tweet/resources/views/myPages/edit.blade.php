@extends('layouts.layout')

@php
    $title = 'ユーザー情報修正画面';
@endphp

@section('title', $title)

@section('content')
    <div>
        <div>
        {{ Form::open(['url' => 'mypage/store']) }}
            <table>
                <tr>
                    <td>{{ Form::label('name','名前') }}</td>
                    <td>{{ Form::text('name', old('name', $userInfo->name)) }}</td>
                </tr>
                <tr>
                    <td>{{ Form::label('email','メールアドレス') }}</td>
                    <td>{{ Form::text('email', old('email', $userInfo->email)) }}</td>
                </tr>
                <tr>
                    <td>{{ Form::label('profile', '自己紹介') }}</td>
                    <td>{{ Form::textarea('profile', old('profile', $userInfo->profile, ['size' => '30x3'])) }}</td>
                </tr>
                <tr>
                <!-- 生年月日、月、日を別々のプルダウンメニューで選択式にする。 -->
               
                </tr>
                <tr>
                    <td>{{ Form::label('residence', '居住地') }}</td>
                    <td>{{ Form::text('residence', old('residence', $userInfo->residence)) }}</td>
                </tr>
                <tr>
                    <td>{{ Form::label('blood_type', '血液型') }}</td>
                    <td>{{ Form::text('blood_type', old('blood_type', $userInfo->blood_type)) }}</td>
                </tr>
                <tr>
                    <td>{{ Form::label('hobby', '趣味') }}</td>
                    <td>{{ Form::text('hobby', old('hobby', $userInfo->hobby)) }}</td>
                </tr>
            </table>
            {{ Form::hidden('user_id', "$user->id") }}
            {{ Form::submit('編集する') }}
        {{ Form::close() }}
        </div>
    </div>
@endsection

@section('footer')
    <br>copyright ishii 2018
@endsection