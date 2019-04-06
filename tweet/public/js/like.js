function like_button(tweet_number){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        method: 'POST',
        dataType: "json",
        url: "/like",
        data: {'tweet_id': tweet_number, 'like': 1},
    }).done(function(){
        var likeClass = 'like' + tweet_number;
        document.getElementById(likeClass).innerHTML = "いいね済み";
        // $('.like').css('color', 'blue').css('font-weight', 'bold');
    }).fail(function (error){
        console.log(error);
        console.log($('#like').data("tweet_number"));
    });
}
