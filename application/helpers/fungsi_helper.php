<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
function timeAgo($timestamp){
        $time = time() - $timestamp;

        if ($time < 60)
        return ( $time > 1 ) ? $time . ' Second ago' : '1 detik';
        elseif ($time < 3600) {
        $tmp = floor($time / 60);
        return ($tmp > 1) ? $tmp . ' Minutes ago' : ' One minutes ago';
        }
        elseif ($time < 86400) {
        $tmp = floor($time / 3600);
        return ($tmp > 1) ? $tmp . ' Hour ago' : ' an Hour ago';
        }
        elseif ($time < 2592000) {
        $tmp = floor($time / 86400);
        return ($tmp > 1) ? $tmp . ' Day before' : ' 1 days before';
        }
        elseif ($time < 946080000) {
        $tmp = floor($time / 2592000);
        return ($tmp > 1) ? $tmp . ' Month ago' : ' One month ago';
        }
        else {
        $tmp = floor($time / 946080000);
        return ($tmp > 1) ? $tmp . ' years' : ' a year';
        }
    }
