<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('sex');
            $table->string('profile');
            $table->boolean('status')->default(true);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('phone_number')->unique();
            $table->string('password');

            $table->index('role_id');
            $table->foreignId('role_id')->nullable()->constrained()->cascadeOnUpdate()->nullOnDelete()->references('id')->on('roles');
            $table->index('college_id');
            $table->foreignId('college_id')->nullable()->constrained()->cascadeOnUpdate()->nullOnDelete()->references('id')->on('colleges');

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
