<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGateEmpRecordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gate_emp_record', function (Blueprint $table) {
            $table->id();
            $table->string('shift');
            $table->date('date');
            $table->index('gate_id');
            $table->foreignId('gate_id')->nullable()->constrained()->cascadeOnUpdate()->cascadeOnDelete()->references('id')->on('gate');
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
        Schema::dropIfExists('gate_emp_record');
    }
}
