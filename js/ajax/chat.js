$(document).ready(function(e) {
    
    console.log("here m8");
    
    $("#container_table>tbody>tr").click(function(e){
        //e.preventDefault();
        console.log("here 2 m8");
        var data = new FormData();
        var newsCardId = $(this).attr("id");
        data.append("data",newsCardId);
        
        
        /*$.ajax({
            type: "POST",
            url:"models/instanceGroupchat.inc.php",
            data: data,
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
        });*/
    });
    
});