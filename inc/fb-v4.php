<?php

/**
   * Duden Facebook-feed Facebookin php-sdk API-versiolle 4
   *
   * @link https://github.com/cosenary/Instagram-PHP-API
   * @author Roni Laukkarinen
   * @since 30.10.2014
   */


// Pakolliset: Alkusäädöt
// ----------------------

require_once $_SERVER["DOCUMENT_ROOT"]."/vendor/facebook/php-sdk-v4/autoload.php";
use Facebook\FacebookSession;
use Facebook\FacebookRequest;

// Pakolliset: Asetukset
// ---------------------

$pageid             = 'digitoimistodude';
$page_owner_name    = 'Digitoimisto Dude Oy';
$app_id             = 'XXXX'; //Facebook App ID
$app_secret         = 'XXXX'; //Facebook App Secret
$posturl            = 'https://www.facebook.com/'.$pageid.'/posts';
$sanarajoitus 		= '100'; // Montako sanaa saa olla päivityksessä
$statusrajoitus 	= '2'; // Montako päivitystä näytetään
$showmeta 			= true; // Näytetäänkö metatiedot
$showlikes 			= true; // Näytetäänkö tykkäykset
$showcomments 		= false; // Näytetäänkö kommenttien määrä
$showtime 			= true; // Näytetäänkö aika

// Time-since -moduuli
// -------------------

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

// Sessio alkaa
// ------------

FacebookSession::setDefaultApplication($app_id , $app_secret);

try {
 	$session = new FacebookSession('526300140759831|a1cb42fbac3644ce2118f3cdbbf48c95');
} catch(FacebookRequestException $ex) {
  	// When Facebook returns an error
	die(" Facebook-virhe! Ota yhteyttä sivuston ylläpitäjään, jos näet tämän ja kerro tämä : " . $ex->getMessage());
} catch(\Exception $ex) {
 	 // When validation fails or other local issues
	die(" Facebook-virhe! Ota yhteyttä sivuston ylläpitäjään, jos näet tämän ja kerro tämä : " . $ex->getMessage());
}

if ($session) {

$request = (new FacebookRequest($session, 'GET', '/'.$pageid.'/feed'))->execute()->getResponse();
$pagefeed = $request->data;


// Debuggaus:
// ----------

// echo '<pre>';
// print_r($pagefeed->getProperty('data'));
// echo '</pre>';


// Sanarajoitus:
// -------------

function limit_words($string, $word_limit)
{
$words = explode(" ",$string);
return implode(" ",array_splice($words,0,$word_limit));
}


// Loop alkaa:
// ----------

$laskuri = 0;
foreach ($pagefeed as $post) :

// Postauksen ID:
$postidexplode = explode('_', $post->id);
$postid = $postidexplode[1];

// Klikattavat linkit:
if(isset($post->story)) { $post->story = preg_replace('"\b(http://\S+)"', '<a href="$1">$1</a>', $post->story); }
if(isset($post->message)) { $post->message = preg_replace('"\b(http://\S+)"', '<a href="$1">$1</a>', $post->message); }


// Triggereitä

echo '<h1>Loopin silmukka nro #'.$laskuri.':</h1>';
echo '<pre>';
print_r($post);
echo '</pre>';


$laskuri++;

if($laskuri == $statusrajoitus){
break;
}


endforeach;

// ''''''''''''''''''''''''''''''''''''
// Sessio päättyy
// --------------

} else {

	echo 'Ei Facebook-sessiota. Ota yhteyttä sivuston ylläpitäjään, jos näet tämän.';

}