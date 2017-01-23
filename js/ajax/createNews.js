$(document).ready(function() {
   $.ajax({
    url:"/models/download_feed.inc.php",  
    success:function(data) {
      handleData(data); 
    }
  });
});