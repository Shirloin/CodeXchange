<?php

namespace App\Helper;

use Alirezasedghi\LaravelImageFaker\ImageFaker;
use Alirezasedghi\LaravelImageFaker\Services\FakePeople;
use Illuminate\Support\Str;
function getID()
{
    return Str::uuid(36);
}

