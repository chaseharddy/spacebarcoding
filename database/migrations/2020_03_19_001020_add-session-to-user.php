<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSessionToUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('users', function ($table) {
            $table->string('api_token', 80)->after('password')
                                ->unique()
                                ->nullable()
                                ->default(null);
        });
        /* create default admin account */
        DB::table('users')->insert(
            array(
                'name' => "admin",
                'email' => "admin@spacebarcoding.com",
                'password' => Hash::make(env("ADMIN_DEFAULT_PASSWORD")),
                'api_token' => Str::random(60),
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
