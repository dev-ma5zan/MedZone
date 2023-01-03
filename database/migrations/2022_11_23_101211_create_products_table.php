<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->foreignId('category_id');
            $table->string('tags');
            $table->boolean('availability');
            $table->boolean('visability');
            $table->boolean('featured');
            $table->foreignId('vendor_id');
            $table->string('serial_number');
            $table->json('featured_cover_image');
            $table->json('images');
            $table->json('links');
            $table->json('documents');
            $table->json('properties');
            $table->json('prices');
            $table->string('description');
            $table->timestamp('deleted_at')->nullable();
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
        Schema::dropIfExists('products');
    }
};
