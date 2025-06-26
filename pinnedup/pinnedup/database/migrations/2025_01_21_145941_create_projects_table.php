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
        Schema::create('projects', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('name'); // Project Name
            $table->text('description')->nullable(); // Project Description
            $table->foreignId('client_id') // Foreign key to the clients table
            ->constrained('clients')
                ->onDelete('cascade'); // Cascade delete if the client is deleted
            $table->date('start_date'); // Project Start Date
            $table->date('deadline'); // Project Deadline
            $table->enum('status', ['Pending', 'In Progress', 'Completed', 'On Hold', 'Canceled']) // Status options
            ->default('Pending');
            $table->enum('priority', ['Low', 'Medium', 'High']) // Priority Level
            ->default('Medium');
            $table->json('tags')->nullable(); // Tags stored as JSON
            $table->timestamps(); // Created at and Updated at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
