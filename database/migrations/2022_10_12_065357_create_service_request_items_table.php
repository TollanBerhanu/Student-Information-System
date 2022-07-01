<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceRequestItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_request_items', function (Blueprint $table) {
            $table->id();
            $table->index('service_request_id');
            $table->foreignId('service_request_id')->nullable()->constrained()->cascadeOnUpdate()->cascadeOnDelete()->references('id')->on('service_requests');
            $table->string('name');
            $table->text('description');
            $table->boolean('status')->default(false);
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
        Schema::dropIfExists('service_request_items');
    }
}
