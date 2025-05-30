<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::dropIfExists('tour_places');
        Schema::create('tour_places', function (Blueprint $table) {
            $table->id();
            $table->string('tour_id')->constrained('tours')->onDelete('cascade');
            $table->string('place_id')->constrained('places')->onDelete('cascade');
            $table->string('day_number');
            $table->string('duration_days');
            $table->text('note')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */

};
