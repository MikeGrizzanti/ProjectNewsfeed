
$(document).ready(function() {
    var data_irr = $(".url_box url_box_show").val();
    
    $("#add_feed_box").submit(function(){        
        //var data_irr = 'irrelevant';
        
        $.ajax({
            type: "POST",
            url:"/models/download_feed.inc.php",
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
               var objArr = JSON.stringify(data);
               console.log('complete');
               alert(objArr); // It should now, worky!
            }
        }); 
    });
    
    console.log();
});