<!DOCTYPE html>
<html>
    <head>
            <?php
                require_once("functions.php");
                
    
                    /** php has:
                        -   rand($min, $max) function,
                        -   stats_standard_deviation($arr) function ==> just kidding, don't use it
                        
                        ** Come back to Google Charts integration if there is extra time, it would likely make a nice
                        *   visual demonstation of the approximately Normal curve
                    */
                    
                    // Associated arrays could (and perhaps should be used to associate temperatures with days)
                    $highTemps = generateDataSet(10000, 50, 90); // For best results definitely work with large numbers
                    
                    $sortedHighs = sortedDup($highTemps);
                    $highAvg = avgArray($highTemps);
                    $highStandardDev = stdArray($highTemps, $highAvg);
                    
                    $highSim = simulateHighs($highTemps, $highStandardDev);
                    $highOccurrences = tempOccursThisManyTimes($highSim, 50);
                    
                    //$highWP = printFirstNTemps($highTemps, $highStandardDev, 50, "High"); // SHOULD: create 2 separate functions: 1 to create, 1 to print and give the option to print within create.
                    
                    //$lowTemps = generateDataSet(1000, 25, 50); This seems like a bad method for generating low temperatures, ie: it's possible to have a high 50 and low 50 for the same day
                    
                    $lowTemps = generateLowsFromHighs($highTemps, $highStandardDev);
                    $lowAvg = avgArray($lowTemps);
                    $lowStandardDev = stdArray($lowTemps, $lowAvg);
                    //$lowWP = printFirstNTemps($lowTemps, $lowStandardDev, 50, "Low");

            ?>
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
            

        
        
        <div class="weather-container container">
            
        
            
            
                <div id = "forecast" class="panel panel-default">
                <div class ="panel-heading">
                    <b>Forecast:</b>
                </div>
            <div class = "panel-body">
            
            
            <?php
                //echo example: to get forecast for particular day
                 //echo ($weekForecast->{'forecastday'}[1]->{'fcttext_metric'});
    
                //loops through each day of the forecast, gets a primative forecast
                $countEven = 0;
                $highTempArray = [];
                $ntemps = printFirstNTemps($highTemps, $highStandardDev, 50, "High");
                $twoDTemps = measuredPredicted2DArray($highTemps, $highStandardDev);
                $ad = avgD($twoDTemps); //average difference array
                $sdd = stdevD($twoDTemps, $ad); // standard deviation of differences array

        
                for ($x = 1; $x < count($twoDTemps[0]); $x++) {
                    echo "<div class = 'panel panel-default'> <div class ='panel-body'> Day $x Prediction: ".$twoDTemps[0][$x]."&deg; F Accuracy: ".round(((erf((($ad[$x]+1 / $x) - $ad[$x]) / $sdd[$x]))*100),3)."%</div></div>";
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