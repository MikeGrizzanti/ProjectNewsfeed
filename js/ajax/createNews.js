$(document).ready(function() {
   $.ajax({
    url:"/models/download_feed.inc.php",  
    success:function(data) { //ok
      console.log(data); 
    },
    error: function (xhr, ajaxOptions, thrownError) { //error
        alert(xhr.status);
        alert(thrownError);
      }
    });
  });