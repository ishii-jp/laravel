<p>いいね数ランキング</p>
@php $number = 1; @endphp
<table>
    @foreach ($likesRanking as $likeRanking)
        <tr>
            <td>{{ $number }}位</td>
            <td>{{ $likeRanking->user->name }}</td>
            <td>{{ $likeRanking->text }}<td>
        </tr>
        @php $number++; @endphp
    @endforeach
</table>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="{{ asset('js/like.js') }}"></script>