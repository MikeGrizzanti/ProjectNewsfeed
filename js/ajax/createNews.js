$(document).ready(function(e) {
    
    $("#add_feed_box").on("submit",function(e){        
 
        e.preventDefault();
        var data = new FormData();
        var member1 = document.getElementById("member1");
        var member2 = document.getElementById("member2");
        var feed = document.getElementById("add_feed_url");
        data.append("member1",member1.value);
        data.append("member2",member2.value);
        data.append("add_feed",feed.value);
                    

        $.ajax({
            type: "POST",
            url:"models/download_feed.inc.php",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data){
               console.log('worky');
               console.log(data); // It should now, worky!
            },
            error: function (xhr, ajaxOptions, thrownError, url) { //error
                console.log(xhr.status);
                console.log(url);
                console.warn(thrownError);
            },
            complete: function(data){
                alert(data);
               var objStr = $.parseJSON(data);
               console.log('complete' + objStr);
               alert(objStr); // It should now, worky!
            }
        }); 
    });
    
});

 