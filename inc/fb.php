<?php
if(getenv('WP_ENV') == "development") :
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
endif;

// CACHE ===============================================

    $url = $_SERVER["SCRIPT_NAME"];
    $break = Explode('/', $url);
    $path = realpath(dirname(__FILE__));
    $file = $break[count($break) - 1];
    $cachefile = $path.'/cached-facebook.html';
    $cachetime = 1800; // 1800 = puoli tuntia, 3600 = 1h, 7200 = 2h

    date_default_timezone_set('Europe/Helsinki');
    setlocale(LC_ALL, 'fi_FI.UTF-8');

    // Serve from the cache if it is younger than $cachetime
    if (getenv('WP_ENV') != "development" && file_exists($cachefile) && time() - $cachetime < filemtime($cachefile)) {
        echo "<!-- Cachetettu HTML-kopio, generoitu klo ".date('H:i', filemtime($cachefile))." -->\n";
        include($cachefile);
    } else {
    ob_start(); // Start the output buffer

// CACHE ===============================================


/**
   * Duden Facebook-feed Facebookin php-sdk API-versiolle 3.2.3
   *
   * @author Roni Laukkarinen
   * @since 30.10.2014
   * @version 26.10.2015
   */


// Alkusäädöt
// Facebookin SDK tulee composerista (wp-configissa vendor/autoload.php)

include('fb-time-since.php');

// Asetukset

$config                 = array();
$config['appId']        = 'XXXXXXXX'; //Facebook App ID
$config['secret']       = 'XXXXXXXX'; //Facebook App Secret
$config['fileUpload']   = false;
$pageid                 = 'digitoimistodude';
$page_owner_name        = 'Digitoimisto Dude Oy';
$posturl                = 'https://www.facebook.com/'.$pageid.'/posts';
$sanarajoitus           = '20'; // Montako sanaa saa olla päivityksessä
$statusrajoitus         = '2'; // Montako päivitystä näytetään
$showlikes              = true; // Näytetäänkö tykkäykset
$showcomments           = false; // Näytetäänkö kommenttien määrä
$showtime               = true; // Näytetäänkö aika

// Sessio alkaa

$facebook = new Facebook($config);
$pagefeed = $facebook->api("/" . $pageid . "/posts");
$photos = $facebook->api("/" . $pageid . "/photos");
$albums = $facebook->api("/" . $pageid . "/albums");

$data = $pagefeed['data'];

// Sanarajoitus

function limit_words($string, $word_limit)
{
    $words = explode(" ",$string);
    return implode(" ",array_splice($words,0,$word_limit));
}

// Loop alkaa

$laskuri = 0;
foreach($data as $post) :
    $laskuri++;

// Postauksen ID

$postidexplode = explode('_', $post['id']);
$postid = $postidexplode[1];

// Määritetään oletuspäivitys

if( isset($post['story']) ) :
    $tarina = $post['story'];
else :
    $tarina = $post['message'];
endif;

// Klikattavat linkit

if( isset($tarina) ) :
    $tarina = preg_replace('"\b(http://\S+)"', '<a href="$1">$1</a>', $tarina);
endif;

// Debug

// echo '<h3>Loopin silmukka nro #'.$laskuri.':</h3>';
// echo '<pre>';
// // print_r($tarina);
// print_r($post);
// echo '</pre>';

// Karsitaan tykkäykset ym. turhat pois mitä ei haluta näyttää

if(
    !strpos($tarina,'likes') !== false
    && !strpos($tarina,'commented') !== false
    && !strpos($tarina,'updated their cover photo') !== false

    // Päivityksen pitää tulla sivun omistajalta
    && !strpos($tarina, $page_owner_name)
    ) :

    if ( empty($tarina) === false ) :

            if (str_word_count($tarina) > $sanarajoitus) :
                $tarina = limit_words($tarina,$sanarajoitus) . "...";
            endif;


            // Käydään läpi erityyppisiä päivitys-skenaarioita ja haetaan oikeat tekstit päivitykseen

            if(isset($post['story'])) :
                if( strpos($post['story'],'event') || strpos($post['story'],'shared') ) :
                    $tarina = $post['description'];
                elseif( strpos($post['story'],'photos') || strpos($post['story'],'photo') || strpos($post['story'],'updated their status') || !isset($post['story']) ) :
                    $tarina = $post['message'];
                else :
                    $tarina = $post['story'];
                endif;
            endif;

            ?>

            <div class="tarina">
                <a href="<?php echo $posturl .  '/' . $postid; ?>">

                    <p><?php echo $tarina; ?></p>
                    <p class="fb-meta"><?php include('fb-meta.php'); ?></p>

                </a>
            </div>

        <?php

    endif;

    if($laskuri == $statusrajoitus) :
        break;
    endif;

endif;

endforeach;

// CACHE ===============================================

    // Save / cache the contents to a file
    $cached = fopen($cachefile, 'w');
    fwrite($cached, ob_get_contents());
    fclose($cached);
    ob_end_flush(); // Send the output to the browser
    }
