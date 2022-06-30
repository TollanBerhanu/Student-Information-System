<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiagnosisDiseasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diagnosis_diseases', function (Blueprint $table) {
            $table->id();
            $table->index('diagnosis_id');
            $table->foreignId('diagnosis_id')->nullable()->constrained()->cascadeOnUpdate()->nullOnDelete()->references('id')->on('diagnoses');
            $table->index('disease_id');
            $table->foreignId('disease_id')->nullable()->constrained()->cascadeOnUpdate()->nullOnDelete()->references('id')->on('diseases');
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
        Schema::dropIfExists('diagnosis_diseases');
    }
}
