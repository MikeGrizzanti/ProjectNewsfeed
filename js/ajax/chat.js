$(document).ready(function(e) {
    
    $(".active_chats_container").on("click", function(e){
        var newsCardId = $(this).attr("id");
        
        $.ajax({
            type: "POST",
            url:"models/instanceGroupchat.inc.php",
            data: newsCardId,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function() {
                $(".loader").show();
            },   
            success: function(data){
                $(".loader").hide();
            },
            error: function (xhr, ajaxOptions, thrownError, url) { //error
                console.log(xhr.status);
                console.log(url);
                alert("There has been a problem while parsing the feed: " + thrownError);
            },
            complete: function(data){
                console.log(data.responseText);

            }
        }); 
    });
    
});