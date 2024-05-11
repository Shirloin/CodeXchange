<?php

namespace App\Helper;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

function getImage()
{
    $response = Http::get('https://source.unsplash.com/random');
    return $response->effectiveUri();
}

function getID()
{
    return Str::uuid(36);
}
