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
        
                $UserAgent = "weather.andrewhaaland.com (webmaster@andrewhaland.com)";

                // HTTP stream options:
                $opts = array(
                 'http'=>array(
                 'method'=>"GET",
                 'header'=>"Accept: application/geo+json;version=1\r\n" .
                 "User-agent: $UserAgent\r\n"
                 )
                );
                $context = stream_context_create($opts);
        
                //gets JSON from WUndeground API, gets weather by ZIP from POST on index, decodes JSON for use later
                $coordGrab = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.$_GET['zipCode']);
                $coords = json_decode($coordGrab);
                $lat = $coords->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
                $lng = $coords->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
                $nwsURL = 'http://api.weather.gov/points/'.$lat.','.$lng;
                $nwsJSON = file_get_contents($nwsURL,false,$context);
                $nwsDecode = json_decode($nwsJSON);
                
                $forecastJSON = file_get_contents('http://api.wunderground.com/api/45bd656b25491a92/geolookup/forecast10day/conditions/alerts/q/'.$_GET['zipCode'].'.json');
                $weatherAry = json_decode($forecastJSON);
                
                $nwsForecastJ = file_get_contents($nwsDecode->{'properties'}->{'forecast'},false,$context);
                $nwsForecast = json_decode($nwsForecastJ);
                
                $nwsStationsJ =  file_get_contents($nwsDecode->{'properties'}->{'observationStations'},false,$context);
                $nwsStations= json_decode($nwsStationsJ);
                
                $nwsCurrentJ = file_get_contents($nwsStations->{'features'}[0]->{'id'}."/observations/current",false,$context);
                $nwsCurrent = json_decode($nwsCurrentJ);
                
                function tempConvertToF($degrees){
                    return $degrees * 1.8 + 32;
                }
                
                function getCardCoord($degree){
                    if ($degree >= 0 && $degree < 22)
                        return "N";
                    if($degree >= 22 && $degree < 45)
                        return "NNE";
                    if($degree >= 45 && $degree < 67)
                        return "NE";
                    if($degree >= 67 && $degree < 90)
                        return "ENE";
                    if($degree >= 90 && $degree < 112)
                        return "E";
                    if($degree >= 112 && $degree < 135)
                        return "ESE";
                    if($degree >= 135 && $degree < 157)
                        return "SE";
                    if($degree >= 157 && $degree < 180)
                        return "SSE";
                    if($degree >= 180 && $degree < 202)
                        return "S";
                    if($degree >= 202 && $degree < 225)
                        return "SSW";
                    if($degree >= 225 && $degree < 247)
                        return "SW";
                    if($degree >= 247 && $degree < 270)
                        return "WSW";
                    if($degree >= 270 && $degree < 292)
                        return "W";
                    if($degree >= 292 && $degree < 315)
                        return "WNW";
                    if($degree >= 315 && $degree < 337)
                        return "NW";
                    if($degree >=337 && $degree < 361)
                        return "NNW";
                }
                
                
                
                //$weekForecast = $weatherAry->{'forecast'}->{'txt_forecast'};
        ?>
        
        
        <div class="weather-container container">
            
            <?php /*  ***** ALERT FEATURE CODE BASE, NOT WORKING $alertType is array of alerts ******
                $alertType = $weatherAry->{'alerts'}->{'significance'};
                var_dump($alertType);
                if($alertType == 'W' || $alertType == 'Y' || $alertType == 'A' || $alertType == 'S')
                {
                    if ($alertType == 'Y' || $alertType == 'A')
                    {
                        echo "<div id='stormAlert' class = 'panel panel-warning'>";
                    }
                    else if($alertType == 'W')
                    {
                        echo "<div id='stormAlert' class = 'panel panel-danger'>";
                    }
                    else 
                    {
                        echo "<div id='stormAlert' class - 'panel panel-info'>";
                    }
                    
                        echo "<div class = 'panel-heading'>";
                        echo "<b>".$weatherAry->{'alerts'}->{'type'}."</b>";
                    
                    
                }
                 */   
                 
                 $hasAlert = false;
                 foreach ($weatherAry->{'alerts'} as $weatherAlerts)
                 {
                     if($weatherAlerts -> {'significance'} != null)
                     {
                         $hasAlert = true;
                         
                     }
                 }
                     if($hasAlert)
                     {
                         echo "<div id='stormAlert' class = 'panel panel-danger'>";
                            echo "<div class = 'panel-heading text-center'>";
                                echo "<b>Hazardous Weather Conditions</b>";
                            echo "</div>";
                            echo "<div class = 'panel-body'>";
                            foreach ($weatherAry->{'alerts'} as $weatherAlerts)
                            {
                                
                                echo "<ul>";
                                    echo "<li>".$weatherAlerts -> {'description'}." Unitl ".$weatherAlerts -> {'expires'}."</li>";
                                echo "</ul>";
                                
                            }
                            echo "</div>";
                            echo "</div>";
                     }
                 
            ?>
            
            <div id="currentConditions" class = "panel panel-default">
                <div class = "panel-heading">
                    <b>Current Conditions in:</b>
                    <h4><?php echo $nwsDecode->{'properties'}->{'relativeLocation'}->{'properties'}->{'city'}.",".$nwsDecode->{'properties'}->{'relativeLocation'}->{'properties'}->{'state'}?> </h4>
                </div>
                <div class = "panel-body">
                    <div class = "currentSummary ">
                        <!-- aligns image centered over text-->
                        <img style = "margin:auto; display:block;" src = "<?php echo $nwsCurrent->{'properties'}->{'icon'}?>" alt = "<?php echo $nwsCurrent->{'properties'}->{'textDescription'}?>">
                        <p style = "text-align:center;"><?php echo $nwsCurrent->{'properties'}->{'textDescription'}?></p>
                    </div>
                    <div class="tempCurrent ">
                        <p style = "margin-bottom:0px;"><b>Temperature:</b></p>
                        <h2 style = "margin-top:0px;margin-bottom:0px;"><?php echo round(tempConvertToF($nwsCurrent->{'properties'}->{'temperature'}->{'value'}))." &deg;F"?></h2>
                        <p style = "margin-bottom:0px;"><b>Feels Like:</b></p>
                        <h4 style = "margin-top:0px;margin-bottom:0px;"><?php echo round(tempConvertToF($nwsCurrent->{'properties'}->{'heatIndex'}->{'value'}))." &deg;F"?></h4>
                    </div>
                    <div class="detailedCurrent ">
                        <p style = "margin-bottom:0px;"><b>Humidity: <?php echo round($nwsCurrent->{'properties'}->{'relativeHumidity'}->{'value'})." %"?></b></p>
                        <p style = "margin-bottom:0px;"><b>Wind: <?php echo getCardCoord($nwsCurrent->{'properties'}->{'windDirection'}->{'value'})." at ". round(($nwsCurrent->{'properties'}->{'windSpeed'}->{'value'}) , 2)." mph"?></b></p>
                        <p style = "margin-bottom:0px;"><b>Barometer: <?php echo (($nwsCurrent->{'properties'}->{'barometricPressure'}->{'value'})*0.01)." mb "?></b></p>
                        <p style = "margin-bottom:0px;"><b>Dew Point: <?php echo round(tempConvertToF($nwsCurrent->{'properties'}->{'dewpoint'}->{'value'}))." &deg;F"?></b></p>
                        <p style = "margin-bottom:0px;"><b>Visibility: <?php echo round($nwsCurrent->{'properties'}->{'visibility'}->{'value'}*0.000621371192) ." mi"?></b></p>
                        <p style = "margin-bottom:0px;"><b>Observation Time: <?php echo $nwsCurrent->{'properties'}->{'timestamp'}?></b></p>
                        <p style = "margin-bottom:0px;"><b>Station of Observation: <?php echo $nwsStations->{'features'}[0]->{'properties'}->{'name'} ?></b></p>
                    </div>
                </div>
            </div>
        
            
            
                <div id = "forecast" class="panel panel-default">
                <div class ="panel-heading">
                    <b>Forecast For:</b>
                    <h4><?php echo $nwsDecode->{'properties'}->{'relativeLocation'}->{'properties'}->{'city'}.", ".$nwsDecode->{'properties'}->{'relativeLocation'}->{'properties'}->{'state'}?></h4>
                    
                </div>
            <div class = "panel-body">
            
            
            <?php
                //echo example: to get forecast for particular day
                 //echo ($weekForecast->{'forecastday'}[1]->{'fcttext_metric'});
    
                //loops through each day of the forecast, gets a primative forecast
                $countEven = 0;
                $highTempArray = [];
                foreach($nwsForecast->{'properties'}->{'periods'} as $dailyData)
                {   
                    if($countEven++ %2 != 1)
                    {
                        echo "<div class = 'panel panel-default'><div class ='panel-body'><div class = 'media'><div class = 'media-left media-middle'><img class = 'media-object' src = '".$dailyData->{'icon'}."' alt = '".$dailyData->{'shortForecast'}."'></div>" ;
                        echo "<div class = 'media-body'><b>".$dailyData ->{'name'}."</b> <br>"."<b style = 'color:red'>High: ".$dailyData->{'temperature'}." &deg;".$dailyData->{'temperatureUnit'}."</b><br>".$dailyData->{'detailedForecast'}."</div></div></div></div>";
                        
                        if($countEven != 0) // In current test, first entry is not useful
                        {
                            $highTempArray[$countEven] = $dailyData ->{'fcttext'};
                        }
                    }
                    else {
                        echo "<div class = 'panel panel-default wellEffect'><div class ='panel-body'><div class = 'media'><div class = 'media-left media-middle'><img class = 'media-object' src = '".$dailyData->{'icon'}."' alt = '".$dailyData->{'shortForecast'}."'></div>" ;
                        echo "<div class = 'media-body'><b>".$dailyData ->{'name'}."</b> <br>"."<b style = 'color:blue'>Low: ".$dailyData->{'temperature'}." &deg;".$dailyData->{'temperatureUnit'}."</b><br>".$dailyData->{'detailedForecast'}."</div></div></div></div>";
                            
                    }
                }
            ?>
            </div>
            
            
            
            </div>

        </div>
        
        <script type = "text/javascript">
            
        </script>
    <?php require 'footer.php';?>
    </body>
</html>