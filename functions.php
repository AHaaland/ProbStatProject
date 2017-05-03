<?php


// Following the trend of getRandomInt(), allow a max and min value for all elements of the dataset
function generateDataSet($size, $min, $max) {
    $dataArray = array();
    
    for ($i = 0; $i < $size; $i++) {
        $dataArray[$i] = rand($min, $max); // Might want to attempt to make the average more likely
    }
    
    return $dataArray;
}

function avg2($n1, $n2) {
    return ($n1 + $n2) / 2;
}

function simulateHighs($datapool, $stdev) {
    
    $highs = array();
    $e = 2.7182818284590452353602874713527;
    $pi = 3.1415926535897932384626433832795;
    
    for ($i = 0; $i < count($datapool); $i++) {
        
        
        $normalC = mt_rand(0,100);
        if ($normalC < 67) {
            $highs[$i] = avg2(70, avg2(70 + rand((-1) * $stdev, $stdev), 70));
        } elseif ($normalC < 94) {
            $highs[$i] = 70 + rand((-2) * $stdev, 2 * $stdev) + rand(-1,1) * ($i % 10);
        } else {
            $highs[$i] = 70 + rand((-3) * $stdev, 3 * $stdev);
        }
        
        
        
        //$highs[$i] = (1 / ($stdev * sqrt(2 * $pi)  )) * pow($e, -0.5 * pow( ($datapool[$i] - 70 / $stdev), 2 ) );
        
        
        //$highs[$i] = (int) (((70 + $datapool[$i]) / 2) + (rand(0,1) * rand(-3,3) * ($stdev/2) )); // This is not creating an approximately normal dataset
    }
    
    /** Let's try and create the 68-95-99 phenomenon
     * $normalC = rand(0,100);
     * if ($normalC < 67) {
            something
            $highs[$i] = 70 + rand((-1) * $stdev, $stdev);
        } elseif ($normalC < 94) {
            something
            $highs[$i] = 70 + rand((-2) * $stdev, 2 * $stdev);
        } else {
            something
            $highs[$i] = 70 + rand((-3) * $stdev, 3 * $stdev);
        }
     * 
    **/
    
    return $highs;
    
    //$lows[$i] = (int) ($highs[$i] - (2*$stdev) + ( rand(-3,3) * ($stdev/2) ));
}

function sortedDup($arr) {
    $dup = array();
    
    for ($i = 0; $i < count($arr); $i++) {
        $dup[$i] = $arr[$i];
    }
    
    asort($dup);
    return $dup;
}


function avgArray($arr) {
    return array_sum($arr) / count($arr);
}

function stdArray($arr, $avg) {
    $sum = 0;
    
    for ($i = 0; $i < count($arr); $i++) {
        $sum += pow($arr[$i] - $avg, 2);
    }
    
    $sum /= count($arr);
    return sqrt($sum);
}

function generateLowsFromHighs($highs, $stdev) {
    $lows = array();
    
    for ($i = 0; $i < count($highs); $i++) {
        $lows[$i] = (int) ($highs[$i] - (2*$stdev) + ( rand(-3,3) * ($stdev/2) ));
    }
    
    return $lows;
}

function printFirstNTemps($temps, $stdev, $n, $type) {
    
    $tempsWithPredictions = array();
    $t = 0;
    
    for ($i = 0; $i < $n; $i++) {
    //for ($i = 0; $i < 1000; $i++) {
        
        //echo "Date: [".$i."] : {";
        
        for ($j = 0; $j < 10; $j++) {
            
            if ($j != 1) {
                //echo $j." days ".$type.": ";
            } else {
                //echo $j." day ".$type.": ";
            }
            
            
            // concatenate calculated predicted temperature to the string
            if ($j == 0) {
                //echo $temps[$i];
                $tempsWithPredictions[$t++] = $temps[$i];
            } else {
                $prediction = rand( $temps[$i] - ($stdev/2) - (2*$j), $temps[$i] + ($stdev/2) + (2*$j) ); // This is giving quite the range of values (variance is very high)
                //echo $prediction;
                $tempsWithPredictions[$t++] = $prediction; // Every 10th index will start the next day
                //bigString += getRandomInt(springHighTemps[i] - (hiStandardDev/2) - (2*j), springHighTemps[i] + (hiStandardDev/2) + (2*j)); // *** BASIC CALCULATION for simulating predicted temperatures
            }
            
            
            if ($j != 9) { // don't want comma on the last one
                //echo ", ";
            }
            
        }
        
        //echo "<br>";
    }
    
    return $tempsWithPredictions;
    
}

function printFirstNTemps2($temps2D, $type) {
    
    $t = 0;
    
    for ($i = 0; $i < count($temps2D); $i++) {
        echo "Date: [".$i."] : {";
        
        for ($j = 0; $j < count($temps2D[$i]); $j++) {
            
            if ($j != 1) {
                echo $j." days ".$type.": ";
            } else {
                echo $j." day ".$type.": ";
            }
            
            if ($j == 0) {
                echo $temps[$i];
            } else {
                echo $prediction;
            }
            
            
            if ($j != 9) { // don't want comma on the last one
                echo ", ";
            }
        }
        
        echo "<br>";
    }
    
}

function tempOccursThisManyTimes($temps, $min) { // every value in temps will be between (50 and 90)
    $timesArray = array();
    
    for ($i = 0; $i < count($temps); $i++) { // NOT SURE ABOUT THIS
        $timesArray[ $temps[$i] - $min ]++; // The integer at the index of a given temperature will increment by 1
    }
    
    return $timesArray;
}

// second test of average difference
function avgD($twoD) {
    
    $Ds = array();
    
    for ($i = 0; $i < count($twoD[0]); $i++) { // should give 10
        $sum = 0;
        $count = 0;
        
        for ($j = 10; $j < count($twoD); $j++) { // 
            $sum += abs($twoD[$j][0] - $twoD[$j - $i][$i]);
            $count++;
        }
        
       $Ds[$i]  = $sum / $count;
    }
    
    return $Ds;
    
}

function stdevD($twoD, $avgDs) {
    
    $SDs = array();
    
    for ($i = 0; $i < count($twoD[0]); $i++) { // should give 10
        $sum = 0;
        $count = 0;
        
        for ($j = 10; $j < count($twoD); $j++) { // 
            $sum += pow(abs($twoD[$j][0] - $twoD[$j - $i][$i] ) - $avgDs[$i], 2);
            $count++;
        }
        
       $SDs[$i] = $sum / $count;
       $SDs[$i] = sqrt($SDs[$i]);
    }
    
    return $SDs;
    
}

function erf($x) 
{ 
        $pi = 3.1415927; 
        $a = (8*($pi - 3))/(3*$pi*(4 - $pi)); 
        $x2 = $x * $x; 

        $ax2 = $a * $x2; 
        $num = (4/$pi) + $ax2; 
        $denom = 1 + $ax2; 

        $inner = (-$x2)*$num/$denom; 
        $erf2 = 1 - exp($inner); 

        return sqrt($erf2); 
}

// input is an array of measured temperatures
// calculates predicted temperatures d days out and stores them in an array within j indicies of the measured temperature for that day
function measuredPredicted2DArray($measuredTemps, $stdev) {
    $twoD = array( array() );
    
    for ($i = 0; $i < count($measuredTemps); $i++) {
        $twoD[$i][0] = $measuredTemps[$i]; // set measured temperature to proper index
        
        for ($j = 1; $j < 10; $j++) {
            //This line is used to generate all of the predicted temperatures for each day
            $twoD[$i][$j] = rand( $measuredTemps[$i+$j] - ($stdev/3) - (($j*$j+$j)/2), $measuredTemps[$i+$j] + ($stdev/3) + (($j*$j+$j)/2) );
        }
    }
    
    return $twoD;
}

function averageDifference($predictedIn) { // parameter is a 2d array
    $tempOutput = array();
    //for($i = 0; $i < count($measuredIn)-10; $i++) Should only cound in 1st Dimension
    for ($i = 0; $i < count($predictedIn); $i++) {
        for ($l = 0; $l < count($predictedIn[$i]); $l++) {
        //for($j = 0; $j < count($predictedIn, COUNT_RECURSIVE) - count($predictedIn); $j+=$i)  //Counts in Dimension 2 !!!WILL THIS CAUSE ERROR DIMENSION 1 > DIMENSION 2 ??
            for($j = 0; j< $predictedIn[$i][$l];$j++)
            {
                $tempOutput[$j] += abs($predictedIn[$i][$l] - $predictedIn[$l][$i]);
            }
        }
    }
    return $tempOutput;   
}


?>