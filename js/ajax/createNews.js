$(document).ready(function() {
    
    $(".url_box url_box_show").onkeypress(function(event){
        console.log(event.type);
    });
    
   $.ajax({
    url:"/models/download_feed.inc.php",
    data: data,
    dataType: "json",
    success:function(data) { //ok
      console.log(data); 
    },
    error: function (xhr, ajaxOptions, thrownError) { //error
        alert(xhr.status);
        alert(thrownError);
      }
    });
  });