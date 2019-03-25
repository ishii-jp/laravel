@extends('layouts.layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/errorMessage.css') }}">
@endsection

@php
    $title = 'ユーザー情報修正画面';
@endphp

@section('title', $title)

@section('content')
    <div>
        <div>
        @php $today = \Carbon\Carbon::now(); @endphp

        @if ($errors->has('exception_message'))
            <strong class="errorMessage">{{ $errors->first('exception_message') }}</strong><br>
        @endif
        
        @if ($errors->has('*'))
            <p class="errorMessage">※入力に不備がありますのでご確認ください。</p>
        @endif
        {{ Form::open(['url' => 'mypage/store']) }}
            <table>
                <tr>
                    <td>{{ Form::label('name','名前') }}</td>
                    <td>{{ Form::text('name', old('name', isset($user->name)? $user->name : '')) }}</td>
                    @if ($errors->has('name'))
                        <tr><td class="errorMessage">{{ $errors->first('name') }}</td></tr>
                    @endif
                </tr>
                <tr>
                    <td>{{ Form::label('email','メールアドレス') }}</td>
                    <td>{{ Form::text('email', old('email', isset($user->email)? $user->email : '')) }}</td>
                    @if ($errors->has('email'))
                    <tr><td class="errorMessage">{{ $errors->first('email') }}</td></tr>
                    @endif
                </tr>
                <tr>
                    <td>{{ Form::label('profile', '自己紹介') }}</td>
                    <td>{{ Form::textarea('profile', old('profile', isset($user->userInfo->profile)? $user->userInfo->profile : '', ['size' => '30x3'])) }}</td>
                </tr>
                <tr><td>生年月日</td></tr>
                <tr>
                    <td>{{ Form::label('year', '年') }}</td>
                    <td>{{ Form::selectRange('year', 1900, 2019, isset($user->userInfo->year)? $user->userInfo->year : $today->year) }}年</td>
                </tr>
                <tr>
                    <td>{{ Form::label('month', '月') }}</td>
                    <td>{{ Form::selectRange('month', 1, 12, isset($user->userInfo->month)? $user->userInfo->month : $today->month) }}月</td>
                </tr>
                <tr>
                    <td>{{ Form::label('day', '日') }}</td>
                    <td>{{ Form::selectRange('day', 1, 31, isset($user->userInfo->day)? $user->userInfo->day : $today->day) }}日</td>
                </tr>
                <tr>
                    <td>{{ Form::label('residence', '居住地') }}</td>
                    <td>{{ Form::text('residence', old('residence', isset($user->userInfo->residence)? $user->userInfo->residence : '')) }}</td>
                </tr>
                <tr>
                    <td>{{ Form::label('blood_type', '血液型') }}</td>
                    <td>{{ Form::text('blood_type', old('blood_type', isset($user->userInfo->blood_type)? $user->userInfo->blood_type : '')) }}</td>
                </tr>
                <tr>
                    <td>{{ Form::label('hobby', '趣味') }}</td>
                    <td>{{ Form::text('hobby', old('hobby', isset($user->userInfo->hobby)? $user->userInfo->hobby : '')) }}</td>
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