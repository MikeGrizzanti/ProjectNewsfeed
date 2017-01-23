$.ajax({
  url: "\models\download_feed.inc.php",
  context: document.body
}).done(function(data) {
    $a = JSON.parse(data);
    console.log($a);
});