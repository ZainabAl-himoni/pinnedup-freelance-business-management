<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToExistingTables extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1) Add lead_id to clients
        Schema::table('clients', function (Blueprint $table) {
            $table->foreignId('lead_id')->nullable()->constrained('leads')->onDelete('set null'); // Foreign key to Lead table

        });

        // 2) Add task_id to invoices
        Schema::table('invoices', function (Blueprint $table) {
            $table->foreignId('task_id')->constrained()->onDelete('cascade'); // Foreign key to the tasks table

        });



    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the newly added constraints and columns in reverse order

        Schema::table('proposals', function (Blueprint $table) {
            $table->dropConstrainedForeignId('lead_id');
        });

        Schema::table('tasks', function (Blueprint $table) {
            $table->dropConstrainedForeignId('project_id');
        });

        Schema::table('projects', function (Blueprint $table) {
            $table->dropConstrainedForeignId('client_id');
        });

        Schema::table('invoices', function (Blueprint $table) {
            $table->dropConstrainedForeignId('task_id');
        });

        Schema::table('clients', function (Blueprint $table) {
            $table->dropConstrainedForeignId('lead_id');
        });
    }
}
