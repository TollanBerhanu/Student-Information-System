<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiagnosisSymptomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diagnosis_symptoms', function (Blueprint $table) {
            $table->id();
            $table->index('diagnosis_id');
            $table->foreignId('diagnosis_id')->nullable()->constrained()->cascadeOnUpdate()->cascadeOnDelete()->references('id')->on('diagnoses');
            $table->index('symptom_id');
            $table->foreignId('symptom_id')->nullable()->constrained()->cascadeOnUpdate()->nullOnDelete()->references('id')->on('symptoms');
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
        Schema::dropIfExists('diagnosis_symptoms');
    }
}
