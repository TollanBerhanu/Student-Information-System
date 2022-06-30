<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StudCostSharing extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stud_cost_sharing', function (Blueprint $table) {
            $table->id();
            $table->index('stud_id');
            $table->foreignId('stud_id')->nullable()->constrained()->cascadeOnDelete()->cascadeOnUpdate()->references('id')->on('students');
            $table->decimal('totalCost');
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
        Schema::dropIfExists('stud_cost_sharing');
    }
}
