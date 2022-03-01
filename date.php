<?php

 $date_now = new DateTime();
 $date2    = new DateTime("01/01/2019");

if ($date_now > $date2) {
        echo 'greater than';
    }else{
        echo 'Less than';
    }
?>