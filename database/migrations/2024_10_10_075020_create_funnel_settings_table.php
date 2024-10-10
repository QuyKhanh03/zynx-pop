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
        Schema::create('funnel_settings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('funnel_id')->unsigned();
            $table->integer('delay')->default(0);
            $table->bigInteger('delay_unit_id')->unsigned();
            $table->integer('frequency')->default(0);
            $table->bigInteger('frequency_unit_id')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('funnel_settings');
    }
};
