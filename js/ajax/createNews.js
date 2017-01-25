$(document).ready(function() {
   
    var data = $('.url_box url_box_show').serialize();
    $("#add_feed_box").submit(function(){
       $.ajax({
        type: "POST",
        url:"/models/download_feed.inc.php",
        data: data,
        dataType: 'json',
        success:function(data) { //ok
          console.log(data); 
        },
        error: function (xhr, ajaxOptions, thrownError, url) { //error
            console.log(xhr.status);
            console.log(url);
            console.warn(thrownError);
          }
        }); 
    });
  });