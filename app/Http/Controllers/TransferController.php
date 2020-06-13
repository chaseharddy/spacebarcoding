<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\FTPController;
use DB;

class TransferController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function migrateStudentsToPublic(){
      // Get all students
      $response = DB::select('
        SELECT
          name
        FROM
          students
      ');
      // copy contents from home into public
      for($i = 0; $i < count($response); $i++){
        $name = strtolower($response[$i]->name);
        exec("rm -rf ./students/" . $name);
        exec("mkdir -p ./students/" . $name);
        exec("rsync -a --prune-empty-dirs --include '*/' --include '*.html' --include '*.css' --include '*.png' --include '*.jpeg' --include '*.jpg' --include '*.js' --include '*.gif' --include '*.svg' --exclude '*' /home/".$name." ./students/");
      }
    }
}
