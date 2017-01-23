$(document).ready(function() {
   $.ajax({
    url:"/models/download_feed.inc.php",  
    success:function(data) {
      console.log(data); 
    }
    error: function (xhr, ajaxOptions, thrownError) {
        alert(xhr.status);
        alert(thrownError);
      }
    });
  });