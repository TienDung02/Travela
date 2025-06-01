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
        Schema::create('tours', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('name'); // Tour name
            $table->text('desc')->nullable(); // Description of the tour
            $table->string('location'); // Location of the tour
            $table->date('start_date'); // Start date of the tour
            $table->date('end_date'); // End date of the tour
            $table->decimal('price', 10, 2); // Price of the tour
            $table->boolean('is_featured'); // Tour nổi bật
            $table->json('types')->nullable(); // Type of tour, e.g., adventure, cultural, etc.
            $table->float('avg_rating')->default(0); // Average rating of the tour
            $table->timestamps(); // Created and updated timestamps
            $table->softDeletes(); // Deleted at timestamp for soft deletes
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tours');
    }
};