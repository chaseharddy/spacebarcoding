<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveStudentFromStudenttocomputer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
            CREATE TRIGGER remove_student_from_studenttocomputer
            AFTER DELETE on students
            FOR EACH ROW
        
            DELETE FROM studenttocomputer
            WHERE studenttocomputer.student_id = old.id;
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER `remove_student_from_studenttocomputer`');
    }
}
