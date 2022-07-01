<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gate', function (Blueprint $table) {
            $table->id();
            $table->string('gate_name');
            $table->index('college_id');
            $table->foreignId('college_id')->nullable()->constrained()->cascadeOnUpdate()->cascadeOnDelete()->references('id')->on('colleges');
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
        Schema::dropIfExists('gate');
    }
}
