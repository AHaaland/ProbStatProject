<!DOCTYPE html>
<html>
<head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link rel="stylesheet" href="/Style/style.css">
</head>
<body>
<?php
    
    $weatherJSON = file_get_contents('http://api.wunderground.com/api/45bd656b25491a92/geolookup/forecast/q/'.$_GET['zipCode'].'.json');
    $weatherAry = json_decode($weatherJSON);
    echo "<div class = 'forecastHead'>Weather for: ".$weatherAry->{'location'}->{'city'}.", ".$weatherAry->{'location'}->{'state'}."<br>"."Full Weatherunderground.com forecast: <a href =".$weatherAry->{'location'}->{'wuiurl'}.">Forecast</a><br></div>";
    $weekForecast = $weatherAry->{'forecast'}->{'txt_forecast'};
    foreach($weekForecast->{'forecastday'} as $dailyData)
    {
        echo "<div class = 'forecastDiv'>Time: ".$dailyData ->{'title'}." <br> Forecast: ".$dailyData->{'fcttext'}." <br> Chance of percipitation: ".$dailyData->{'pop'}."%</div>";
    }
?>
<p id = "pGraph"></p>
</body>
</html>