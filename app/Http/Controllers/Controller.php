<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function fakeData(){
        return [
            ["data", "data"],
            ["data2", "data2"],
            ["data", "data"],
            ["data2", "data2"],
            ["data", "data"],
            ["data2", "data2"],
            ["data", "data"],
            ["data2", "data2"]
        ];
    }
}
