<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePcTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pc', function (Blueprint $table) {
            $table->id();
            $table->index('stud_id');
            $table->foreignId('stud_id')->nullable()->constrained()->cascadeOnUpdate()->cascadeOnDelete()->references('id')->on('students');
            $table->string('t_mark');
            $table->string('serialNo');
            $table->string('color');
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
        Schema::dropIfExists('pc');
    }
}
