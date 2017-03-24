<!DOCTYPE html>
<?php
    header("Locatoin weatherTest1.php");
?>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $(window).ready(function(){
        $.ajax({
  url : "https://api.wunderground.com/api/45bd656b25491a92/geolookup/forecast/q/12487.json",
  dataType : "jsonp",
  success : function(parsed_json) {
  //var location = parsed_json['location']['city'];
  //var temp_f = parsed_json['current_observation']['observation_time'];
  //alert("Current temperature in " + location + " is: " + temp_f);
  $("#pGraph").append(JSON.stringify(parsed_json,undefined,0));
  }
  });
  $.get("index.php", function(data){alert("Data Loaded:" + data);});
    });
});
</script>
</head>
<body>
<?php
    $var
    ?>
<p id = "pGraph"></p>
</body>
</html>