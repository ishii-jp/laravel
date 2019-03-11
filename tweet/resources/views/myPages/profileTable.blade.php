<table>
    <tr><td><span>名前</span></td><td>{{ $user->name }}</td></tr>
    <tr><td><span>登録メールアドレス</span></td><td>{{ $user->email }}</td></tr>
    <tr><th>自己紹介</th><td>{{ isset($userInfo->profile)? $userInfo->profile : '' }}</td></tr>
    <tr>
    <th>生年月日</th>
        @isset($userInfo->year)
        <td>
            {{ isset($userInfo->year)? $userInfo->year : '' }}年
            {{ isset($userInfo->month)? $userInfo->month : '' }}月
            {{ isset($userInfo->day)? $userInfo->day : '' }}日
        </td>
        @endisset
    </tr>
    <tr><th>居住地</th><td>{{ isset($userInfo->residence)? $userInfo->residence : '' }}</td></tr>
    <tr><th>血液型</th><td>{{ isset($userInfo->blood_type)? $userInfo->blood_type : '' }}</td></tr>
    <tr><th>趣味</th><td>{{ isset($userInfo->hobby)? $userInfo->hobby : '' }}</td></tr>
</table>