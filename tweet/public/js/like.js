function like_button(tweet_number, liked = false){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    if (liked == false){
        // いいねする処理
        $.ajax({
            method: 'POST',
            dataType: "json",
            url: "/like",
            data: {'tweet_id': tweet_number, 'like': 1},
        }).done(function(){
            var likeClass = 'like' + tweet_number;
            document.getElementById(likeClass).innerHTML = '<button class="btn btn-success" id="liked{{ $tweet->id }}" data-tweet_number="{{ $tweet->id }}" onClick=\'like_button($("#liked{{ $tweet->id}}").data("tweet_number"), "true")\'>いいね済</button>';
            // $('.like').css('color', 'blue').css('font-weight', 'bold');
        }).fail(function (error){
            console.log(error);
            console.log($('#like').data("tweet_number"));
        });
    } else {
        // いいねを解除する処理
        $.ajax({
            method: 'POST',
            dataType: "json",
            url: "/like/delete",
            data: {'tweet_id': tweet_number},
        }).done(function(){
            var likeClass = 'liked' + tweet_number;
            document.getElementById(likeClass).innerHTML = "いいね!";
            // $('.like').css('color', 'blue').css('font-weight', 'bold');
        }).fail(function (error){
            console.log(error);
            console.log($('#liked').data("tweet_number"));
        });
    }
    
}
