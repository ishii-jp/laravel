$(function(){

         $('.letsVote').on('click' , function(){
              
              $this = $(this);
              var id = $this.data("id"); //識別用ID（重複NG）
              var numHtml = "." + $this.data("numhtml"); //カウント数を表示するHTML
              var nowCount = Number($(numHtml).html()); //現在のカウント数
              var newCount = nowCount + 1;
    
              $.ajax({
                   type : "POST",
                   url : "vote.php",
                   data: {
                        "file_id" : id,
                        "count" : newCount
                   }
              }).done(function(data , datatype){
                        //送信先のvote.phpから、Completeが返ってきたらカウント更新
                        if(data == "Complete"){
                             $(numHtml).html(newCount);
                        }else{
                             alert("押しすぎ(´・ω・｀)");
                        }
                   }).fail(function(XMLHttpRequest, textStatus, errorThrown) {
                          $("#XMLHttpRequest").html("XMLHttpRequest : " + XMLHttpRequest.status);
                          $("#textStatus").html("textStatus : " + textStatus);
                          $("#errorThrown").html("errorThrown : " + errorThrown.message);
                      });
    　　　　});
    });