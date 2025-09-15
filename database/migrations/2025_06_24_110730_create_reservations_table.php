<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('book_id')->constrained()->onDelete('cascade');
            $table->enum('status', ['to_claim', 'to_return', 'completed', 'cancelled', 'lost'])->default('to_claim');
            $table->timestamp('pickup_date');
            $table->timestamp('due_date')->nullable();
            $table->timestamp('initial_duedate')->nullable();
            $table->timestamp('claimed_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamp('cancelled_at')->nullable();
            $table->boolean('pickup_date_edited')->default(false);
            $table->foreignId('claimed_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('returned_by')->nullable()->constrained('users')->nullOnDelete();
            $table->boolean('lost_declared')->default(false);
            $table->enum('lost_status', ['pending', 'accepted', 'denied'])->nullable();
            $table->timestamp('last_penalized_at')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
