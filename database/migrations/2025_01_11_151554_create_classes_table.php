<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassesTable extends Migration
{
    public function up()
    {
        Schema::create('classes', function (Blueprint $table) {
            $table->id();
            $table->date('date'); 
            $table->string('groupe'); 
            $table->string('course_name'); 
            $table->text('details'); 
            $table->unsignedBigInteger('professor_id'); 
            $table->foreign('professor_id')->references('id')->on('professors')->onDelete('cascade');
            $table->timestamps(); 
        });
    }

    public function down()
    {
        Schema::dropIfExists('classes');
    }
}
