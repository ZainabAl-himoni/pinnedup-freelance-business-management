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
             Schema::create('proposals', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->json('features')->nullable();  // or text if you want to store serialized
                $table->string('status')->default('pending');
                $table->text('description')->nullable();
                $table->unsignedBigInteger('lead_id');
                $table->decimal('discount', 8, 2)->nullable();
                $table->decimal('price', 12, 2)->nullable();
                $table->decimal('total_price', 12, 2)->nullable();
                $table->decimal('budget', 12, 2)->nullable();
                $table->date('start_date')->nullable();
                $table->date('deadline')->nullable();

                // standard timestamps
                $table->timestamps();
            });

        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proposals');
    }
};
