// function like_button(tweet_number){
//     $.ajaxSetup({
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         }
//     });

//     // いいねする処理
//     $.ajax({
//         method: 'POST',
//         dataType: "json",
//         url: "/like",
//         data: {'tweet_id': tweet_number, 'like': 1},
//     }).done(function(){
//         var likeClass = 'like' + tweet_number;
//         // document.getElementById(likeClass).innerHTML = '<button class="btn btn-success" id="liked{{ $tweet->id }}" data-tweet_number="{{ $tweet->id }}" onClick=\'like_button($("#liked{{ $tweet->id}}").data("tweet_number"), "true")\'>いいね済</button>';
//         document.getElementById(likeClass).innerHTML =  "いいね済";
//         // $('.like').css('color', 'blue').css('font-weight', 'bold');
//     }).fail(function (error){
//         console.log(error);
//         console.log($('#like').data("tweet_number"));
//     });
// }

$(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var $like = $('.btn-success'), like_id;
    $like.on('click', function (e){
        e.stopPropagation();
        var $this = $(this);
        //カスタム属性に格納されたID取得
        like_id = $this.data('tweet_number');
        $.ajax({
            method: "POST",
            dataType: "json",
            url: "/like",
            data: {'tweet_id': like_id, 'like': 1},
        }).done(function(data){
            // console.log(data);
            if (data['result'] == 'create'){
                var value = 'いいね済';
            } else {
                var value = 'いいね!';
            }
            // ボタンのhtmlを修正
            document.getElementById($this.attr('id')).innerHTML = value;
            // いいねの総数を表示
            document.getElementById('likeCount' + like_id).innerHTML = 'いいね数' + data['likeCount'];
        }).fail(function(error){
            console.log(error);
        });
    });
});