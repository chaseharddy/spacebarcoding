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

    public function migrateStudentsToPublicDIS(){
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
        exec("cp -a /home/".$name." ./students/");
      }
    }
    public function migrateStudentsToPublic(Request $request){

        $name = strtolower($request->data);
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://localhost:9000/migrate.php?name=$name",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
        ));     
        $output = curl_exec($curl);
        curl_close($curl);
          
        return;
    }
}
