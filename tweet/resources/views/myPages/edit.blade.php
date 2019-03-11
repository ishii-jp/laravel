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
                    <td>{{ Form::text('name', old('name', isset($userInfo->name)? $userInfo->name : '')) }}</td>
                </tr>
                <tr>
                    <td>{{ Form::label('email','メールアドレス') }}</td>
                    <td>{{ Form::text('email', old('email', isset($userInfo->email)? $userInfo->email : '')) }}</td>
                </tr>
                <tr>
                    <td>{{ Form::label('profile', '自己紹介') }}</td>
                    <td>{{ Form::textarea('profile', old('profile', isset($userInfo->profile)? $userInfo->profile : '', ['size' => '30x3'])) }}</td>
                </tr>
                <tr><td>生年月日</td></tr>
                <tr>
                    <td>{{ Form::label('year', '年') }}</td>
                    <td>{{ Form::selectRange('year', 1900, 2019) }}年</td>
                </tr>
                <tr>
                    <td>{{ Form::label('month', '月') }}</td>
                    <td>{{ Form::selectRange('month', 1, 12) }}月</td>
                </tr>
                <tr>
                    <td>{{ Form::label('day', '日') }}</td>
                    <td>{{ Form::selectRange('day', 1, 31) }}日</td>
                </tr>
                <tr>
                    <td>{{ Form::label('residence', '居住地') }}</td>
                    <td>{{ Form::text('residence', old('residence', isset($userInfo->residence)? $userInfo->residence : '')) }}</td>
                </tr>
                <tr>
                    <td>{{ Form::label('blood_type', '血液型') }}</td>
                    <td>{{ Form::text('blood_type', old('blood_type', isset($userInfo->blood_type)? $userInfo->blood_type : '')) }}</td>
                </tr>
                <tr>
                    <td>{{ Form::label('hobby', '趣味') }}</td>
                    <td>{{ Form::text('hobby', old('hobby', isset($userInfo->hobby)? $userInfo->hobby : '')) }}</td>
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