<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDiagnosesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_diagnoses', function (Blueprint $table) {
            $table->id();
            $table->index('diagnosis_id');
            $table->foreignId('diagnosis_id')->nullable()->constrained()->cascadeOnUpdate()->nullOnDelete()->references('id')->on('diagnoses');
            $table->index('user_id');
            $table->foreignId('user_id')->nullable()->constrained()->cascadeOnUpdate()->cascadeOnDelete()->references('id')->on('users');
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
        Schema::dropIfExists('user_diagnoses');
    }
}
