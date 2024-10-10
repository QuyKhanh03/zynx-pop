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
        Schema::create('funnel_devices', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('funnel_id')->unsigned();
            $table->bigInteger('device_id')->unsigned();
            $table->enum('targeting_type', ['include', 'exclude','none'])->default('none');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('funnel_devices');
    }
};
