
$(document).ready(function() {
    var data_irr = "";
    
    $("#add_feed_box").submit(function(e){        
        
        e.preventDefault();
        
        $.ajax({
            type: "POST",
            url:"/models/download_feed.inc.php",
            chache: false,
            data: {mydata: data_irr},
            //dataType: 'json',
            success: function(data){
               console.log('worky');
               alert(data.mydata); // It should now, worky!
            },
            error: function (xhr, ajaxOptions, thrownError, url) { //error
                console.log(xhr.status);
                console.log(url);
                console.warn(thrownError);
            },
            complete: function(data){
               var objStr = JSON.stringify(data);
               console.log('complete');
               alert(objStr); // It should now, worky!
            }
        }); 
    });
    
    //console.log(data_irr);
});