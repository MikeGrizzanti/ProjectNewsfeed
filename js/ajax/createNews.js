$(document).ready(function() {
   
    
    $("#add_feed_box").submit(function(e){        
        e.preventDefault(); // don't submit multiple times
        //this.submit(); // use the native submit method of the form element
        var data = $('.url_box').val(''); // blank the input
    
        
        $.ajax({
        type: "POST",
        url:"/models/download_feed.inc.php",
        data: data,
        //dataType: 'json',
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