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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
			$table->integer('activated');
			$table->string('title');
			$table->text('description');
			$table->foreignId('city_id')->constrained()->cascadeOnDelete();
			$table->string('location');
			$table->foreignId('user_id')->constrained()->cascadeOnDelete();
			$table->integer('price_per_day');
			$table->integer('number_of_beds');

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
};
