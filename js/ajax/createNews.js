$(document).ready(function() {
    $.ajax({
      type : 'GET',
      url : '../models/download_feed.inc.php',
      //data: {'json':json},
    }).done(function(data) {
        $a = JSON.parse(data);
        console.log($a);
    });
});