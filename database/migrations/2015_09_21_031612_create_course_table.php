<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('inst_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->string('name');
            $table->text('description');
            $table->text('image');
            $table->timestamps();
            
            $table->foreign('inst_id')->references('id')->on('institutions')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('course_category')->onDelete('cascade');
            
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('courses');
    }
}
