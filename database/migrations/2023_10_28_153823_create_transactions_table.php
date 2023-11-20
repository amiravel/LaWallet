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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('from_id')->constrained('wallets');
            $table->foreignId('to_id')->constrained('wallets');
            $table->unsignedInteger('amount');
            $table->string('hash', 250)->index()->unique();
            $table->enum('type', \App\Enums\TransactionTypesEnum::names());
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
