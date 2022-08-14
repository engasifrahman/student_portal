<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudAttendencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stud_attendences', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date');
            $table->string('stud_id');
            $table->string('fm_id');
            $table->string('dept_code');
            $table->string('sem_code');
            $table->string('course_code');
            $table->string('section');
            $table->string('attendance')->default('true');
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
        Schema::dropIfExists('stud_attendences');
    }
}
