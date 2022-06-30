<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolePrivilegesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_privileges', function (Blueprint $table) {
            $table->id();
            $table->boolean('status')->default(true);
            $table->index('role_id');
            $table->foreignId('role_id')->constrained()->cascadeOnDelete()->references('id')->on('roles');
            $table->index('privilege_id');
            $table->foreignId('privilege_id')->constrained()->cascadeOnDelete()->references('id')->on('privileges');
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
        Schema::dropIfExists('role_privileges');
    }
}
