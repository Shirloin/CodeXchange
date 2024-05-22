<?php

namespace App\Helper;

use Alirezasedghi\LaravelImageFaker\ImageFaker;
use Alirezasedghi\LaravelImageFaker\Services\FakePeople;
use Illuminate\Support\Str;

function getImage()
{
    return (new ImageFaker(new FakePeople()))->imageUrl();
}
function getID()
{
    return Str::uuid(36);
}

