$(document).ready(function() {
    
    const RET_DATA = "";
    
    $("#add_feed_box").submit(function(){        
        var data = $('.url_box url_box_show').serialize(); // blank the input
    
        
        $.ajax({
            type: "POST",
            url:"/models/download_feed.inc.php",
            data: data,
            //dataType: 'json',
            success:function(data) { //ok
                RET_DATA = data;
                console.log(data); 
            },
            error: function (xhr, ajaxOptions, thrownError, url) { //error
                console.log(xhr.status);
                console.log(url);
                console.warn(thrownError);
            }
        }); 
    console.log(RET_DATA);
    });
});