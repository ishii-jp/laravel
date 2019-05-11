<table class="table table-striped">
    <tr><td><span>名前</span></td><td>{{ $user->name }}</td></tr>
    <tr><td><span>登録メールアドレス</span></td><td>{{ $user->email }}</td></tr>
    <tr><th>自己紹介</th><td>{!! isset($user->userInfo->profile)? nl2br(e($user->userInfo->profile)) : '' !!}</td></tr>
    <tr>
    <th>生年月日</th>
        @isset($user->userInfo->year)
        <td>
            {{ isset($user->userInfo->year)? $user->userInfo->year : '' }}年
            {{ isset($user->userInfo->month)? $user->userInfo->month : '' }}月
            {{ isset($user->userInfo->day)? $user->userInfo->day : '' }}日
        </td>
        @endisset
    </tr>
    <tr><th>居住地</th><td>{{ isset($user->userInfo->residence)? $user->userInfo->residence : '' }}</td></tr>
    <tr><th>血液型</th><td>{{ isset($user->userInfo->blood_type)? $user->userInfo->blood_type : '' }}</td></tr>
    <tr><th>趣味</th><td>{{ isset($user->userInfo->hobby)? $user->userInfo->hobby : '' }}</td></tr>
</table>