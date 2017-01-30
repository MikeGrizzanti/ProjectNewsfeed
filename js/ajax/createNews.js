
        

$(document).ready(function() {
    var data_irr = 'irrelevant';
    
    //$("#add_feed_box").submit(function(){        
        //var data_irr = 'irrelevant';
        
        $.ajax({
            type: "POST",
            url:"/models/download_feed.inc.php",
            data: {mydata: data_irr},
            //dataType: 'json',
            success: function(data){
               console.log('worky');
               alert(data); // It should now, worky!
            },
            error: function (xhr, ajaxOptions, thrownError, url) { //error
                console.log(xhr.status);
                console.log(url);
                console.warn(thrownError);
            }
        }); 
    //});
});