$(document).ready(function() {
    $.ajax({
      url: "models/download_feed.inc.php",
    }).done(function(data) {
        $a = JSON.parse(data);
        console.log("HI!");
    });
});