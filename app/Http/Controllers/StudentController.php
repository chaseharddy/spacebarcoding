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

class StudentController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getStudent(){
        return DB::Select("
          SELECT
            id,
            name
          FROM
            students
        ");
    }
    public function addStudent(Request $request){
      // Add ftp account
      FTPController::addUser($request->name, $request->password);

      DB::table('students')->insert([
        'name' => $request->name, 
        'password' => $request->password
        ]
      );
      return redirect('/admin');
    }
    public function removeStudent(Request $request){
      //Find student name from id
      $response = DB::Select('
        SELECT
          name
        FROM
          students
        WHERE id = ?
      ', [$request->id]);
      // Remove ftp account
      if(count($response) > 0)
        FTPController::removeUser($response[0]->name);

      // Remove student from DB
      return DB::Delete("
        DELETE
          FROM
        students
          WHERE id = ?
      ", [$request->id]);
    }
}
