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
        Schema::create('tours', function (Blueprint $table) {
            $table->id();
            $table->integer('tour_id');
            $table->integer('country_id');
            $table->integer('city_id');
            $table->integer('city_tour_type_id');
            $table->integer('contract_id');
            $table->string('name');
            $table->integer('reviewCount');
            $table->decimal('rating',64,2);
            $table->string('duration');
            $table->string('image_path');
            $table->string('tour_image_caption');
            $table->string('city_tour_type');
            $table->text('tour_short_description');
            $table->text('cancellation_policy_name');
            $table->boolean('isSlot')->default(0);
            $table->boolean('onlyChild')->default(0);
            $table->string('slug');
            $table->string('id_slug');
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
        Schema::dropIfExists('tours');
    }
};
