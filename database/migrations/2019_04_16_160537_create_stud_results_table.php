<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stud_results', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('stud_id');
            $table->string('fm_id');
            $table->string('dept_code');
            $table->string('sem_code');
            $table->string('course_code');
            $table->string('section');
            $table->integer('attendance')->nullable()->default(0);
            $table->integer('ct_1')->nullable()->default(0);
            $table->integer('ct_2')->nullable()->default(0);
            $table->integer('ct_3')->nullable()->default(0);
            $table->integer('avg_ct')->nullable()->default(0);
            $table->integer('presentation')->nullable()->default(0);
            $table->integer('assignment')->nullable()->default(0);
            $table->integer('midterm')->nullable()->default(0);
            $table->integer('final')->nullable()->default(0);
            $table->integer('total')->nullable()->default(0);
            $table->double('gpa')->nullable()->default(0);
            $table->string('grade')->nullable();
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
        Schema::dropIfExists('stud_results');
    }
}
