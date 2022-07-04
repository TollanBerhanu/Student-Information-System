<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_requests', function (Blueprint $table) {
            $table->id();
            $table->text('description')->nullable();
            $table->text('response')->nullable();
            $table->boolean('accepted')->default(false);
            $table->boolean('complete')->default(false);
            $table->index('diagnosis_id');
            $table->foreignId('diagnosis_id')->nullable()->constrained()->cascadeOnUpdate()->cascadeOnDelete()->references('id')->on('diagnoses');
            $table->index('room_id');
            $table->foreignId('room_id')->nullable()->constrained()->cascadeOnUpdate()->nullOnDelete()->references('id')->on('rooms');

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
        Schema::dropIfExists('service_requests');
    }
}
