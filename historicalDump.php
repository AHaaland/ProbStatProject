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
        
        ini_set('display_errors', 1); error_reporting(-1);
        //c9 login
        $dbhost = 'localhost';
        $dbuser = 'n02762252';
        $dbpass = '12321';
        $dbDatabase = 'oldForecast';
        
        //myServ
        /*$dbhost = 'localhost';
        $dbuser = 'weatherWonderSaveUser';
        $dbpass = 'Password$12321*';
        $dbDatabase = 'weatherWonder';
        */
   
        /*$conn = mysqli_connect($dbhost, $dbuser, $dbpass);
   
        if(! $conn ) {
             die('Could not connect: ' . mysqli_error());
        }
   
        $sql = 'SELECT * FROM OldWeather';
        mysqli_select_db('oldForecast');
        $retval = mysqli_query( $sql, $conn );
   
        if(! $retval ) {
        die('Could not get data: ' . mysqli_error());
        }
   
        while($row = mysqli_fetch_array($retval, MYSQL_ASSOC)) {
            echo $row['OldWeatherTime'];
        }
   
        echo "Fetched data successfully\n";
   
        mysqli_close($conn);*/


        $mysqli = new mysqli($dbhost,$dbuser,$dbpass,$dbDatabase);
        
                if ($mysqli->connect_error) {
            die("Connection failed: " . $mysqli->connect_error);
        } 
        
        
        $result = $mysqli->query("SELECT * FROM OldWeather;");
        if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo $row['OldWeatherTime'];
            //echo $row['OldWeatherData']."<br><br><br>";
        }
        }
        
        else {
            echo "nope!";
                
        }
        
        
        
        
        $mysqli->close();
        
        ?>
        
        
        <?php require 'footer.php';?>
    </body>
</html>