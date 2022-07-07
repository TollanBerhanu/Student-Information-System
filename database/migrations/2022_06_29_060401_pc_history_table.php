<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PcHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pc_history', function (Blueprint $table) {
            $table->id();
            $table->index('student_id');
            $table->foreignId('student_id')->nullable()->constrained()->cascadeOnDelete()->cascadeOnUpdate()->references('id')->on("students");
           $table->date('date')->nullable();
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
        Schema::dropIfExists('pc_history');
    }
}
