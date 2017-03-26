<!DOCTYPE html>
<html>
    <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
            <link rel="stylesheet" href="/Style/style.css">
    </head>
    <body>
        <?php require 'nav.php';?>
            
        <?php
                //gets JSON from WUndeground API, gets weather by ZIP from POST on index, decodes JSON for use later
                $forecastJSON = file_get_contents('http://api.wunderground.com/api/45bd656b25491a92/geolookup/forecast10day/q/'.$_GET['zipCode'].'.json');
                $weatherAry = json_decode($forecastJSON);
                $weekForecast = $weatherAry->{'forecast'}->{'txt_forecast'};
                $currentCondJSON = file_get_contents('http://api.wunderground.com/api/45bd656b25491a92/conditions/q/'.$_GET['zipCode'].'.json');
                $currentCondAry = json_decode($currentCondJSON);
        ?>
        

        
        <div class="weather-container container">
            
            <div id="currentConditions" class = "panel panel-default">
                <div class = "panel-heading">
                    <b>Current Conditions in:</b>
                    <h4><?php echo $currentCondAry->{'current_observation'}->{'display_location'}->{'full'}?></h4>
                </div>
                <div class = "panel-body">
                    <div class = "currentSummary ">
                        <!-- aligns image centered over text-->
                        <img style = "margin:auto; display:block;" src = "<?php echo $currentCondAry->{'current_observation'}->{'icon_url'}?>" alt = "<?php echo $currentCondAry->{'current_observation'}->{'icon'}?>">
                        <p style = "text-align:center;"><?php echo $currentCondAry->{'current_observation'}->{'weather'}?></p>
                    </div>
                    <div class="tempCurrent ">
                        <p style = "margin-bottom:0px;"><b>Temperature:</b></p>
                        <h2 style = "margin-top:0px;margin-bottom:0px;"><?php echo $currentCondAry->{'current_observation'}->{'temperature_string'}?></h2>
                        <p style = "margin-bottom:0px;"><b>Feels Like:</b></p>
                        <h3 style = "margin-top:0px;margin-bottom:0px"><?php echo $currentCondAry->{'current_observation'}->{'feelslike_string'}?></h3>
                    </div>
                    <div class="detailedCurrent ">
                        <p style = "margin-bottom:0px;"><b>Humidity: <?php echo $currentCondAry->{'current_observation'}->{'relative_humidity'}?></b></p>
                        <p style = "margin-bottom:0px;"><b>Wind: <?php echo $currentCondAry->{'current_observation'}->{'wind_string'}." ".$currentCondAry->{'current_observation'}->{'wind_dir'}." ".$currentCondAry->{'current_observation'}->{'wind_mph'}." mph"?></b></p>
                        <p style = "margin-bottom:0px;"><b>Barometer: <?php echo $currentCondAry->{'current_observation'}->{'pressure_in'}." in (".$currentCondAry->{'current_observation'}->{'pressure_mb'}." mb)" ?></b></p>
                        <p style = "margin-bottom:0px;"><b>Dew Point: <?php echo $currentCondAry->{'current_observation'}->{'dewpoint_string'}?></b></p>
                        <p style = "margin-bottom:0px;"><b>Visibility: <?php echo $currentCondAry->{'current_observation'}->{'visibility_mi'}." mi"?></b></p>
                        <p style = "margin-bottom:0px;"><b>Observation Time: <?php echo $currentCondAry->{'current_observation'}->{'observation_time'}?></b></p>
                        <p style = "margin-bottom:0px;"><b>Station of Observation: <?php echo $currentCondAry->{'current_observation'}->{'station_id'}?></b></p>
                    </div>
                </div>
            </div>
        
            
            
                <div id = "forecast" class="panel panel-default">
                <div class ="panel-heading">
                    <b>Forecast For:</b>
                    <h4><?php echo $weatherAry->{'location'}->{'city'}.", ".$weatherAry->{'location'}->{'state'}?></h4>
                    <?php echo "<a href =".$weatherAry->{'location'}->{'wuiurl'}.">WeatherUnderground.com forecast for ".$weatherAry->{'location'}->{'city'}.", ".$weatherAry->{'location'}->{'state'}."</a>" ?>
                </div>
            <div class = "panel-body">
            
            
            <?php
                //echo example: to get forecast for particular day
                 //echo ($weekForecast->{'forecastday'}[1]->{'fcttext_metric'});
    
                //loops through each day of the forecast, gets a primative forecast
                $countEven = 0;
                foreach($weekForecast->{'forecastday'} as $dailyData)
                {
                    if($countEven++ %2 != 1)
                    {
                        echo "<div class = 'panel panel-default'><div class ='panel-body'><div class = 'media'><div class = 'media-left media-middle'><img class = 'media-object' src = '".$dailyData->{'icon_url'}."' alt = '".$dailyData->{'icon'}."'></div>" ;
                        echo "<div class = 'media-body'><b>".$dailyData ->{'title'}."</b> <br>".$dailyData->{'fcttext'}." <br> Chance of percipitation: ".$dailyData->{'pop'}."%</div></div></div></div>";
                    }
                    else {
                        echo "<div class = 'panel panel-default wellEffect'><div class ='panel-body'><div class = 'media'><div class = 'media-left media-middle'><img class = 'media-object' src = '".$dailyData->{'icon_url'}."' alt = '".$dailyData->{'icon'}."'></div>" ;
                        echo "<div class = 'media-body'><b>".$dailyData ->{'title'}."</b> <br>".$dailyData->{'fcttext'}." <br> Chance of percipitation: ".$dailyData->{'pop'}."%</div></div></div></div>";
                            
                    }
                }
            ?>
            </div>
            </div>

        </div>
    <?php require 'footer.php';?>
    </body>
</html>