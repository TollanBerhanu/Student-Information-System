<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiagnosesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diagnoses', function (Blueprint $table) {
            $table->id();
            $table->text('description')->nullable();
            $table->text('diagnosis')->nullable();
            $table->boolean('accepted')->default(false);
            $table->boolean('pending_request')->default(false);
            $table->boolean('complete')->default(false);
            $table->boolean('discarded')->default(false);
            $table->index('student_id');
            $table->foreignId('student_id')->nullable()->constrained()->cascadeOnUpdate()->cascadeOnDelete()->references('id')->on('students');
            $table->index('room_id');
            $table->foreignId('room_id')->nullable()->constrained()->cascadeOnUpdate()->onDelete('RESTRICT')->references('id')->on('rooms');
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
        Schema::dropIfExists('diagnoses');
    }
}
