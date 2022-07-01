<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('description');
            $table->index('clinic_id');
            $table->foreignId('clinic_id')->nullable()->constrained()->cascadeOnUpdate()->onDelete("RESTRICT")->references('id')->on('clinics');
            $table->index('room_type_id');
            $table->foreignId('room_type_id')->nullable()->constrained()->cascadeOnUpdate()->onDelete("RESTRICT")->references('id')->on('room_types');
            $table->index('user_id');
            $table->foreignId('user_id')->nullable()->constrained()->cascadeOnUpdate()->nullOnDelete()->references('id')->on('users');
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
        Schema::dropIfExists('rooms');
    }
}
