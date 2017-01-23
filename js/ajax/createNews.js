$(document).ready(function() {
    $.ajax({
      type : 'GET',
      url : '../models/download_feed.inc.php',
      data: {'index.php?action=main':json},
    }).done(function(data) {
        $a = JSON.parse(data);
        console.log($a);
    });
});