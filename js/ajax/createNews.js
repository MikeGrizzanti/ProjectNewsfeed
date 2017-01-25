$(document).ready(function() {
    
    const ret_data = "";
    
    $("#add_feed_box").submit(function(){        
        var data = $('.url_box').val(); // blank the input
    
        
        $.ajax({
            type: "POST",
            url:"/models/download_feed.inc.php",
            data: data,
            //dataType: 'json',
            success:function(data) { //ok
                ret_data = data;
                console.log(data); 
            },
            error: function (xhr, ajaxOptions, thrownError, url) { //error
                console.log(xhr.status);
                console.log(url);
                console.warn(thrownError);
            }
        }); 
    });
       console.log(ret_data);
});