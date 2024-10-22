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
        Schema::create('offer_stats', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('offer_id')->unsigned();
            $table->bigInteger('impressions')->default(0);
            $table->bigInteger('clicks')->default(0);
            $table->bigInteger('cost')->default(0);
            $table->bigInteger('revenue')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offer_stats');
    }
};
