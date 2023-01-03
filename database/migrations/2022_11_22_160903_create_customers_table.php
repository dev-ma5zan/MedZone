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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('full_name');
            $table->string('business_name');
            $table->string('mobile');
            $table->string('land_phone');
            $table->foreignId('customer_speciality_id');
            $table->foreignId('activity_id');
            $table->foreignId('area_id');
            $table->foreignId('sector_id');
            $table->foreignId('sub_address_id');
            $table->foreignId('street_id');
            $table->foreignId('business_hours_id');
            $table->foreignId('vendor_id');
            $table->foreignId('preferred_buying_method_id');
            $table->foreignId('insurance_id');
            $table->foreignId('location_type_id');
            $table->string('detailed_address');
            $table->foreignId('staff_id');
            $table->foreignId('size_id');
            $table->foreignId('decor_id');
            $table->foreignId('power_id');
            $table->string('behavior');
            $table->string('notes');
            $table->json('documents');
            $table->string('rating');
            $table->string('secretary_name');
            $table->timestamp('deleted_at')->nullable();
            $table->string('secretary_mobile');
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
        Schema::dropIfExists('customers');
    }
};
