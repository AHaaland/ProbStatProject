<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
</head>
<body>
<?php
    $weatherJSON = file_get_contents('http://api.wunderground.com/api/45bd656b25491a92/geolookup/forecast/q/'.$_GET['zipCode'].'.json');
   $weatherAry = json_decode($weatherJSON, TRUE);
   var_dump($weatherAry);
?>
<p id = "pGraph"></p>
</body>
</html>