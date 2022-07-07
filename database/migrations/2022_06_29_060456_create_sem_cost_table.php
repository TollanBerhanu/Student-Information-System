<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSemCostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sem_cost', function (Blueprint $table) {
            $table->id();
            $table->index('dept_id');
            $table->foreignId('dept_id')->nullable()->constrained()->cascadeOnDelete()->cascadeOnUpdate()->references('id')->on('departments');
            $table->decimal('costper_sem');
            $table->index('program_id');
            $table->foreignId('program_id')->nullable()->constrained()->cascadeOnDelete()->cascadeOnUpdate()->references('id')->on('programs');
            $table->date('batch');
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
        Schema::dropIfExists('sem_cost');
    }
}
