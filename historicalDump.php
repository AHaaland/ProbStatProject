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
        <div class = 'container'> 
            <?php
                $historyXML = simplexml_load_file('http://api.wunderground.com/api/fb64d033ab87e1ee/history_20060405/q/12487.xml');
                echo('Observed weather on: '.$historyXML->history->dailysummary->summary->date->pretty);
                echo('<br>');
                echo('The observed mean temp on April 5, 2006 was: '.$historyXML->history->dailysummary->summary->meantempi." F");
                echo('<br>');
                echo('The observed high was: '.$historyXML->history->dailysummary->summary->maxtempi." F")
    
            ?>
        </div>    
        <?php 
        //MY SERVER LOGIN FOR MYSQL
        $mysqli = new mysqli("localhost", "WeatherWonderSaveUse", "Password$12321*", "weatherWonder");
        $query = "SELECT * FROM OldWeather";
        $result = mysqli_query($mysqli, $query);
        $row = mysqli_fetch_array($result);
        while($row = mysqli_fetch_array($result))
        {
            echo $row['OldWeatherTime'];
        }
        ?>
        
        
        <?php require 'footer.php';?>
    </body>
</html>