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
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropColumn('is_completed');
            
            $table->enum('status', ['pending', 'in_progress', 'completed'])->default('pending');
            
            // Add due date column
            $table->date('due_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->boolean('is_completed')->default(false);
            $table->dropColumn(['status', 'due_date']);
        });
    }
};
