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
                $forecastJSON = file_get_contents('http://api.wunderground.com/api/45bd656b25491a92/geolookup/forecast10day/conditions/alerts/q/'.$_GET['zipCode'].'.json');
                $weatherAry = json_decode($forecastJSON);
                $weekForecast = $weatherAry->{'forecast'}->{'txt_forecast'};
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
                    <h4><?php echo $weatherAry->{'current_observation'}->{'display_location'}->{'full'}?></h4>
                </div>
                <div class = "panel-body">
                    <div class = "currentSummary ">
                        <!-- aligns image centered over text-->
                        <img style = "margin:auto; display:block;" src = "<?php echo $weatherAry->{'current_observation'}->{'icon_url'}?>" alt = "<?php echo $weatherAry->{'current_observation'}->{'icon'}?>">
                        <p style = "text-align:center;"><?php echo $weatherAry->{'current_observation'}->{'weather'}?></p>
                    </div>
                    <div class="tempCurrent ">
                        <p style = "margin-bottom:0px;"><b>Temperature:</b></p>
                        <h2 style = "margin-top:0px;margin-bottom:0px;"><?php echo $weatherAry->{'current_observation'}->{'temperature_string'}?></h2>
                        <p style = "margin-bottom:0px;"><b>Feels Like:</b></p>
                        <h3 style = "margin-top:0px;margin-bottom:0px"><?php echo $weatherAry->{'current_observation'}->{'feelslike_string'}?></h3>
                    </div>
                    <div class="detailedCurrent ">
                        <p style = "margin-bottom:0px;"><b>Humidity: <?php echo $weatherAry->{'current_observation'}->{'relative_humidity'}?></b></p>
                        <p style = "margin-bottom:0px;"><b>Wind: <?php echo $weatherAry->{'current_observation'}->{'wind_string'}." ".$weatherAry->{'current_observation'}->{'wind_dir'}." ".$weatherAry->{'current_observation'}->{'wind_mph'}." mph"?></b></p>
                        <p style = "margin-bottom:0px;"><b>Barometer: <?php echo $weatherAry->{'current_observation'}->{'pressure_in'}." in (".$weatherAry->{'current_observation'}->{'pressure_mb'}." mb)" ?></b></p>
                        <p style = "margin-bottom:0px;"><b>Dew Point: <?php echo $weatherAry->{'current_observation'}->{'dewpoint_string'}?></b></p>
                        <p style = "margin-bottom:0px;"><b>Visibility: <?php echo $weatherAry->{'current_observation'}->{'visibility_mi'}." mi"?></b></p>
                        <p style = "margin-bottom:0px;"><b>Observation Time: <?php echo $weatherAry->{'current_observation'}->{'observation_time'}?></b></p>
                        <p style = "margin-bottom:0px;"><b>Station of Observation: <?php echo $weatherAry->{'current_observation'}->{'station_id'}?></b></p>
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
                $highTempArray = [];
                foreach($weekForecast->{'forecastday'} as $dailyData)
                {   
                    if($countEven++ %2 != 1)
                    {
                        echo "<div class = 'panel panel-default'><div class ='panel-body'><div class = 'media'><div class = 'media-left media-middle'><img class = 'media-object' src = '".$dailyData->{'icon_url'}."' alt = '".$dailyData->{'icon'}."'></div>" ;
                        echo "<div class = 'media-body'><b>".$dailyData ->{'title'}."</b> <br>".$dailyData->{'fcttext'}." <br> Chance of percipitation: ".$dailyData->{'pop'}."%</div></div></div></div>";
                        
                        if($countEven != 0) // In current test, first entry is not useful
                        {
                            $highTempArray[$countEven] = $dailyData ->{'fcttext'};
                        }
                    }
                    else {
                        echo "<div class = 'panel panel-default wellEffect'><div class ='panel-body'><div class = 'media'><div class = 'media-left media-middle'><img class = 'media-object' src = '".$dailyData->{'icon_url'}."' alt = '".$dailyData->{'icon'}."'></div>" ;
                        echo "<div class = 'media-body'><b>".$dailyData ->{'title'}."</b> <br>".$dailyData->{'fcttext'}." <br> Chance of percipitation: ".$dailyData->{'pop'}."%</div></div></div></div>";
                            
                    }
                }
            ?>
            </div>
            
            <div class="panel-body">
                <?php //TEST: extraction of High temperature from string for each day
                
                //print_r($weatherAry->{'forecast'}->{'simpleforecast'}->{'forecastday'}[0]->{'high'}->{'fahrenheit'});
                //echo "TODAYS HIGH". $weatherAry->{'forecast'}->{'simpleforecast'}->{'forecastday'}[9]->{'high'}->{'fahrenheit'};
                
                
                
                // Database setup
                ini_set('display_errors', 1); error_reporting(-1);
                //c9 login
                $dbhost = 'localhost';
                $dbuser = 'n02762252';
                $dbpass = '12321';
                $dbDatabase = 'oldForecast';
                //My Server
                /*$dbhost = 'localhost';
                $dbuser = 'weatherWonderSaveUser';
                $dbpass = 'Password$12321*';
                $dbDatabase = 'weatherWonder';
                */
                
                $mysqli = new mysqli($dbhost,$dbuser,$dbpass,$dbDatabase);
        
                if ($mysqli->connect_error) {
                    die("Connection failed: " . $mysqli->connect_error);
                }
                
                // This requires no string manipulation so it's more reliable.
                for ($daysOut = 0; $daysOut < 10; $daysOut++) {
                    
                    // Get high temperature for x days out
                    $loopHighTemp =  $weatherAry->{'forecast'}->{'simpleforecast'}->{'forecastday'}[$daysOut]->{'high'}->{'fahrenheit'};
                    echo "HIGH TEMP: ".$loopHighTemp."<br>";
                    
                    // Store high temperature into propper table
                    $loopDate = date('Y-m-d', strtotime('+'.$daysOut.' days', strtotime( date('Y-m-d') )));
                    $highTempSQL = "INSERT INTO ".$daysOut."dayOutHighTemps (date, temperature, comments) VALUES ('".$loopDate."', '".$loopHighTemp."', '' );";
                    echo "HIGH TEMP SQL: ".$highTempSQL."<br>";
                    $tableWrite = $mysqli->query($highTempSQL);
                    
                }
                
                
                // Trying to rework this, make it more efficient and intuitive:
                /*
                
                    // Loop will iterate through the strings containing high temperatures for each day and write them to their corresponding tables
                    $daysOut = 0;
                    foreach ($highTempArray as $highTemp)
                    {
                        if ($daysOut == 0) {
                            $todaysTemp = $weatherAry->{'current_observation'}->{'temperature_string'};
                            //echo "RIGHT--HERE: ".intval(substr($todaysTemp, 0, strpos($todaysTemp, "F")));
                            $todaysTemp = intval(substr($todaysTemp, 0, strpos($todaysTemp, "F")));
                        }
                        
                        $loopDate = date('Y-m-d', strtotime('+'.$daysOut.' days', strtotime( date('Y-m-d') )));
                        $leftString = substr( $highTemp, strpos( $highTemp, "High") + 4 );
                        $isolatedTemp = substr( $leftString , 0, strpos( $leftString, "F") + 1 );
                        $isolatedTemp = preg_replace( '/[^0-9]/', '', $isolatedTemp);
                        echo "Isolated temp: ". $isolatedTemp .",  ##Num only: ". preg_replace( '/[^0-9]/', '', $isolatedTemp) .",  ##Days out: ". $daysOut .",  ##Date: ". $loopDate ."<br>"; // WILL WRITE INTEGER VALUE TO DATABASE for average calculation
                        
                        // Write to corresponding table for high temperature prediction
                        if ($daysOut != 0) {
                            $tableWrite = $mysqli->query("INSERT INTO ".$daysOut."dayOutHighTemps (date, temperature, comments) VALUES ('".$loopDate."', '".$isolatedTemp."', '' );");
                        } else { // 0 days out is a special case because the formatting is a little different of the string that the temperature is located within
                            $tableWrite = $mysqli->query("INSERT INTO ".$daysOut."dayOutHighTemps (date, temperature, comments) VALUES ('".$loopDate."', '".$todaysTemp."', '' );");
                        }
                        $daysOut++;
                    }
                    
                */
                    
                    // Now that the data has been inserted into the tables, a new average and standard deviation can be calculated for each day range category.
                    
                    ///*
                    for ($daysOut = 0; $daysOut < 10; $daysOut++) {
                    
                        // Calculate average difference for $daysOut amount of days out: WANT to sum up all instances of measured vs actual temperature
                        // try and use $todaysTemp instead of having to retrieve it from the database
                        
                        // get prediction from $daysOut amount of days ago about today's temperature
                        //$predictionSQL = "SELECT temperature FROM ".$daysOut."dayOutHighTemps WHERE date = ".date('Y-m-d', strtotime('-'.$daysOut.' days', strtotime( date('Y-m-d') ))).";";
                        $predictionSQL = "SELECT temperature FROM ".$daysOut."dayOutHighTemps WHERE date = '".date('Y-m-d')."';";
                        
                        
                        if ($predictionQuery = $mysqli->query($predictionSQL)) {
                            
                            while ($prow = $predictionQuery->fetch_assoc()) {
                                //echo "<br>".$predictionSQL."<br>Query ##".$daysOut.":   ".$prow["temperature"];
                                $predictionTemp = $prow["temperature"];
                                break;
                            }
                            
                        }
                        
                        echo "<br>".$predictionSQL."<br>Query ##".$daysOut.":   ".$predictionTemp; // Testing
                        
                        
                        $newavgSQL = "SELECT datacount, runningsum FROM DaysOutStats WHERE name = ".$daysOut."days;";
                        if ($avgQuery = $mysqli->query($newavgSQL)) {
                            
                            while ($avgrow = $avgQuery->fetch_assoc()) {
                                $dbcount = $avgrow["datacount"];
                                $dbsum = $avgrow["runningsum"];
                                echo "<br>".$newavgSQL."<br>Query ##".$daysOut.":   count:".$avgrow["datacount"]."  sum: ".$avgrow["runningsum"];
                                //$predictionTemp = $prow["temperature"];
                                break;
                            }
                            
                        } else {
                            echo "ELSE REACHED!";
                            $dbcount = 1; // No divide by 0's
                            $dbsum = 0;
                        }
                        
                        $dbavg = $dbsum / $dbcount;
                        echo "<br>Average: ".$dbavg;
                        $newavg = abs(($dbsum - $predictionTemp) / ++$dbcount);
                        echo "<br>NEW Average: ".$newavg;
                        
                        
                        $predictionTemp = -5000; // impossible value will flag when tests are no longer producing useful results
                        
                    
                        
                        // Calculate Average and Standard Deviation from each table
                        //$tempsQuery = $mysqli->query("SELECT AVG(temperature), STDEV(temperature) AS AvgTemp, StdevTemp FROM ".$daysOut."dayOutHighTemps");
                        //$row = mysql_fetch_assoc($tempsQuery); 
                        //$avg = $row['AvgTemp'];
                        //$stdev = $row['StdevTemp'];
                        // MAY NEED TO HAVE A SPECIAL CASE FOR WHEN THE TABLE IS EMPTY (first time may not allow update if nothing has been inserted yet)
                        //$tableWrite = $mysqli->query("UPDATE DaysOutStats SET average = ".$avg." standarddeviation = ".$stdev." WHERE name = ".$daysOut."days;");// Update current values of Avg and Stdev
                    }
                    //*/
                    
                $mysqli->close();
                
                
                ?>
            </div>
            
            </div>

        </div>
        
        <script type = "text/javascript">
            
        </script>
    <?php require 'footer.php';?>
    </body>
</html>