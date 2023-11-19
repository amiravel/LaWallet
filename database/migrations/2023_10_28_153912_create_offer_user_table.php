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
        Schema::create('offer_user', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained();
            $table->foreignId('offer_id')->constrained();
            $table->timestamps();

            $table->primary(['user_id', 'offer_id'], 'offer_user_primary');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offer_user');
    }
};
