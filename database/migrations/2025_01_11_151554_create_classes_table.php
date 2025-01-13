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
            $table->date('date'); // Date of the class
            $table->string('groupe'); // Group
            $table->string('course_name'); // Course name
            $table->text('details'); // Lesson details
            $table->unsignedBigInteger('professor_id'); // Foreign key referencing the professor
            $table->foreign('professor_id')->references('id')->on('professors')->onDelete('cascade');
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    public function down()
    {
        Schema::dropIfExists('classes');
    }
}
