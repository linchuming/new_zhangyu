<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;

class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        //设置为中国时区
        date_default_timezone_set('PRC');
    }

    public function validatorCheck($input, $rules) {
        $validator = \Validator::make($input, $rules);
        if(!$validator->passes()) {
            throw new \Exception($validator->errors());
        }
    }

    public function getParam($param, $defulat='') {
        return isset($param)? $param : $defulat;
    }
}
