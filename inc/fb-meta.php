<?php

// Aika
if($showtime == true) :
                echo aika(abs(strtotime($post['created_time'] . " GMT")), time()) . " sitten. ";
endif;

// Tykkäykset
if($showlikes == true) :
            
            if(isset($post['likes'])) :
                echo count($post['likes']['data']).' ';
                if( count($post['likes']['data']) == "1" ) :
                    echo 'tykkäys';
                else :
                    echo 'tykkäystä';
                endif;
                    echo '.';
            else :
                echo 'Ei tykkäyksiä.';
            endif;
endif;

// Kommentit
if($showcomments == true) :
            
            if(isset($post->comments)) :
               
            $kommenttilaskuri = 0;

                foreach($post['comments']['data'] as $comment) :
                    $kommenttilaskuri++;
                    $kommenttilaskuri += $comment->message; 
                endforeach;

                echo $kommenttilaskuri.' kommentti';
                if($kommenttilaskuri > "1") : echo 'a'; endif;
                echo '.';

            else :
                echo 'Ei yhtään kommenttia.'; 
            endif;
endif;