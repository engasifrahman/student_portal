<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->string('faculty_code');
            $table->string('dept_code');
            $table->string('type');
            $table->string('pic_dir');
            $table->string('name');
            $table->string('abbreviation', 20)->unique()->nullable();
            $table->string('designation');
            $table->string('sem_code');
            $table->string('gender');
            $table->string('marital_status');
            $table->string('dob');
            $table->string('nationality');
            $table->string('nid')->nullable();
            $table->string('birth_certificate')->nullable();
            $table->string('father_name');
            $table->string('mother_name');
            $table->string('email', 100)->unique();
            $table->string('altr_email')->nullable();
            $table->string('phone');
            $table->string('altr_phone')->nullable();
            $table->string('present_addr');
            $table->string('permanent_addr');
            $table->string('password');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
