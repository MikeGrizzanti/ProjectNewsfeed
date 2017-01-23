$.ajax({
  url: "\models\download_feed.inc.php",
}).done(function(data) {
    console.log(data);
    $a = JSON.parse(data);
    console.log($a);
});