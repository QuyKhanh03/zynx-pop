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
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->float('budget')->default(0);
            $table->text('description')->nullable();
            $table->text('content')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            //delay
            $table->integer('delay')->default(0);
            $table->string('delay_unit')->default('s');
            //number of popups
            $table->integer('number_of_popups')->default(0);
            $table->integer('every')->default(0);
            $table->string('every_unit')->default('h');

            //popups interval
            $table->integer('pop_interval')->default(0);
            $table->string('interval_unit')->default('s');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaigns');
    }
};
