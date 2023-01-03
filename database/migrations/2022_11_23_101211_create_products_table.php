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
            $table->boolval('availability');
            $table->boolval('visability');
            $table->boolval('featured');
            $table->foreignId('vendor_id');
            $table->string('serial_number');
            $table->string('featured_cover_image');
            $table->json_encode('featured_cover_image');
            $table->json_encode('images');
            $table->json_encode('links');
            $table->json_encode('documents');
            $table->json_encode('properties');
            $table->string('prices');
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
