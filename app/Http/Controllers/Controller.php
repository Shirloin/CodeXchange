<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public static function SuccessMessage($msg){
        toastr()->success($msg, '', ['positionClass' => 'toast-top-right', 'timeOut' => 2000, ]);
    }
    public static function FailMessage($msg){
        toastr()->error($msg, '', ['positionClass' => 'toast-top-right', 'timeOut' => 2000, ]);
    }
    
}
