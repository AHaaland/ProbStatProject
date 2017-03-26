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
                $weatherJSON = file_get_contents('http://api.wunderground.com/api/45bd656b25491a92/geolookup/forecast10day/q/'.$_GET['zipCode'].'.json');
                $weatherAry = json_decode($weatherJSON);
                $weekForecast = $weatherAry->{'forecast'}->{'txt_forecast'};
        ?>
        <div class="container" id="forecastCont">
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
                        echo "<div class = 'media-body'>".$dailyData ->{'title'}." <br>".$dailyData->{'fcttext'}." <br> Chance of percipitation: ".$dailyData->{'pop'}."%</div></div></div></div>";
                    }
                    else {
                        echo "<div class = 'panel panel-default wellEffect'><div class ='panel-body'><div class = 'media'><div class = 'media-left media-middle'><img class = 'media-object' src = '".$dailyData->{'icon_url'}."' alt = '".$dailyData->{'icon'}."'></div>" ;
                        echo "<div class = 'media-body'>".$dailyData ->{'title'}." <br>".$dailyData->{'fcttext'}." <br> Chance of percipitation: ".$dailyData->{'pop'}."%</div></div></div></div>";
                            
                    }
                }
            ?>
            </div>
            </div>

        </div>
    <?php require 'footer.php';?>
    </body>
</html>