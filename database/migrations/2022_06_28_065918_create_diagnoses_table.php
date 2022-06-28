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
            $table->string('name');
            $table->string('code');
            $table->text('description');
            $table->text('diagnosis');
            $table->boolean('diagnose')->default(false);
            $table->boolean('pending_request')->default(false);
            $table->boolean('complete')->default(false);
            $table->index('student_id');
            $table->foreignId('student_id')->nullable()->constrained()->cascadeOnUpdate()->cascadeOnDelete()->references('id')->on('students');
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
