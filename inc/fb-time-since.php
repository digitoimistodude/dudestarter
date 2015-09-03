<?php
    function aika($older_date, $newer_date = false)  {

    // Array of time period chunks
    $chunks = array(
    array(60 * 60 * 24 * 365 , 'vuosi'),
    array(60 * 60 * 24 * 30 , 'kuukausi'),
    array(60 * 60 * 24 * 7, 'viikko'),
    array(60 * 60 * 24 , 'päivä'),
    array(60 * 60 , 'tunti'),
    array(60 , 'minuutti'),
    );

    $i = 0;
    $since = $newer_date - $older_date;
    for ($iik = 0, $j = count($chunks); $i < $j; $iik++)
        {
        $seconds = $chunks[$iik][0];
        $name = $chunks[$iik][1];
        if (($count = floor($since / $seconds)) != 0)
            {
            break;
            }
        }
    if ($count > 1 & $name == "päivä") {
    $output = ($count == 1) ? '1 '.$name : "$count {$name}ä";
    } elseif ($count > 1 & $name == "vuosi") {
    $output = ($count == 1) ? '1 '.$name : "$count vuotta";
        } elseif ($count > 1 & $name == "kuukausi") {
        $output = ($count == 1) ? '1 '.$name : "$count kuukautta";
    } else {
    $output = ($count == 1) ? '1 '.$name : "$count {$name}a";
    }
    if ($i + 1 < $j)
        {
        $seconds2 = $chunks[$i + 1][0];
        $name2 = $chunks[$i + 1][1];
        
        if (($count2 = floor(($since - ($seconds * $count)) / $seconds2)) != 0)
            {
    if ($count2 > 1 & $name2 == "päivä") {
    $output .= ($count2 == 1) ? ', 1 '.$name2 : ", $count2 {$name2}ä";
    } elseif ($count2 > 1 & $name2 == "kuukausi") {
    $output .= ($count2 == 1) ? ', 1 '.$name2 : ", $count2 kuukautta";
    } else {
     $output .= ($count2 == 1) ? ', 1 '.$name2 : ", $count2 {$name2}a";
    }
             
            }

    return $output;
        }
    }