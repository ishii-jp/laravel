function like_button(tweet_number){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // いいねする処理
    $.ajax({
        method: 'POST',
        dataType: "json",
        url: "/like",
        data: {'tweet_id': tweet_number, 'like': 1},
    }).done(function(){
        var likeClass = 'like' + tweet_number;
        // document.getElementById(likeClass).innerHTML = '<button class="btn btn-success" id="liked{{ $tweet->id }}" data-tweet_number="{{ $tweet->id }}" onClick=\'like_button($("#liked{{ $tweet->id}}").data("tweet_number"), "true")\'>いいね済</button>';
        document.getElementById(likeClass).innerHTML =  "いいね済";
        // $('.like').css('color', 'blue').css('font-weight', 'bold');
    }).fail(function (error){
        console.log(error);
        console.log($('#like').data("tweet_number"));
    });
}