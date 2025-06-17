<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::dropIfExists('discount_conditions');

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        Schema::create('discount_conditions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('discount_id');
            $table->DECIMAL('min_quantity',10, 2);
            $table->DECIMAL('min_price',10, 2);
        });

    }


    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('email_verified_at');
            $table->dropColumn('remember_token');
        });
    }
};
