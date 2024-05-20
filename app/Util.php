<?php

use Carbon\Carbon;

if(!function_exists('getTime')){
    function getTime($time){
        return Carbon::parse($time)->diffForHumans();
    }
}