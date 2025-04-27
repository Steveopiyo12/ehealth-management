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
        if (!Schema::hasTable('enrollments')) {
            Schema::create('enrollments', function (Blueprint $table) {
                $table->id();
                $table->foreignId('client_id')->constrained()->onDelete('cascade');
                $table->foreignId('program_id')->constrained()->onDelete('cascade');
                $table->date('enrollment_date');
                $table->enum('status', ['active', 'pending', 'completed', 'cancelled'])->default('active');
                $table->text('notes')->nullable();
                $table->timestamps();
                
                // Ensure a client can only be enrolled once in a specific program
                $table->unique(['client_id', 'program_id']);
            });
        } else {
            // Make sure all required columns exist
            Schema::table('enrollments', function (Blueprint $table) {
                if (!Schema::hasColumn('enrollments', 'client_id')) {
                    $table->foreignId('client_id')->constrained()->onDelete('cascade');
                }
                if (!Schema::hasColumn('enrollments', 'program_id')) {
                    $table->foreignId('program_id')->constrained()->onDelete('cascade');
                }
                if (!Schema::hasColumn('enrollments', 'enrollment_date')) {
                    $table->date('enrollment_date');
                }
                if (!Schema::hasColumn('enrollments', 'status')) {
                    $table->enum('status', ['active', 'pending', 'completed', 'cancelled'])->default('active');
                }
                if (!Schema::hasColumn('enrollments', 'notes')) {
                    $table->text('notes')->nullable();
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('enrollments', function (Blueprint $table) {
            //
        });
    }
};
