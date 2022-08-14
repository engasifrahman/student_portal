<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTutionFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tution_fees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('stud_id');
            $table->string('dept_code');
            $table->string('sem_code');
            $table->string('course_code');
            $table->string('section');
            $table->integer('total_fee')->default(0);
            $table->integer('total_fee')->nullable()->default(0);
            $table->integer('total_fee')->nullable()->default(0);
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
        Schema::dropIfExists('tution_fees');
    }
}
