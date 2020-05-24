<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use DB;

class ComputerController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function checkComputer(Request $request){
      $pass = "12345678";
      if($request->pass != $pass)
        return "[]";
      /* Authenticated */
      $response = DB::Select('
        SELECT
          *
        FROM
          computers
        WHERE name = ?
      ', [$request->name]);
      // see if computer is registed 
      if(count($response) > 0){
        // registered
        return $this->updateComputer($request->name);
      }
      else{
        // not registered
        return $this->registerComputer($request->name);
      }

    }
    /* get all registered computers */
    public function getComputers(){
      $response = DB::Select('
        SELECT
          *
        FROM
          computers
      ');
      return json_encode($response);
    }
    /* assign student to computer */
    public function addStudentToComputer(Request $request){
      /* check if assignment already exists */
      $response = DB::Select('
      SELECT
        id
      FROM
        studenttocomputer
      WHERE student_id = ?
      AND computer_id = ?
          ', [$request->student_id, $request->computer_id]);
      if(count($response) > 0)
        return redirect('/admin?message="Assignment already exists"');
      /* add new assignment */
      DB::Insert('
        INSERT INTO
          studenttocomputer
        (student_id, computer_id)
          VALUES (?,?)
      ', [$request->student_id, $request->computer_id]);
      return redirect('/admin');
    }
    /* remove student from computer */
    public function removeStudentFromComputer(Request $request){
      DB::Delete('
        DELETE FROM
          studenttocomputer
        WHERE id = ?
      ', [$request->id]);
    }
    /* get students to computers */
    public function getStudentComputer(){
      $response = DB::Select('
        SELECT
          studenttocomputer.id,
          students.name as studentName,
          computers.name as computerName
        FROM
          studenttocomputer
        INNER JOIN students
          ON students.id = studenttocomputer.student_id
        INNER JOIN computers
          ON computers.id = studenttocomputer.computer_id
      ');
      return json_encode($response);
    }

    /* adds computer to DB */
    private function registerComputer($name){
      DB::table('computers')->insert([
        'name' => $name
        ]
      );
      // return empty array
      return "[]";
    }
    /* removes computer from DB */
    public function removeComputer(Request $request){
      $response = DB::Delete('
        DELETE FROM
          computers
        WHERE id = ?
      ', [$request->id]);
    }
    /* returns currently registered students for computer */
    private function updateComputer($name){
      $response = DB::Select('
        SELECT
          students.name,
          students.password
        FROM
          students
        INNER JOIN computers
          ON computers.name = ?
        INNER JOIN studenttocomputer
          ON computers.id = studenttocomputer.computer_id
          AND students.id = studenttocomputer.student_id
      ', [$name]);
      return json_encode($response);
    }
   
}
