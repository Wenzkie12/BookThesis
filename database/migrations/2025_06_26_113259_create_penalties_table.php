<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenaltiesTable extends Migration
{
    public function up(): void
    {
        Schema::create('penalties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profile_id')->constrained()->onDelete('cascade');
            $table->foreignId('book_id')->constrained()->onDelete('cascade');
            $table->decimal('amount', 8, 2);
            $table->foreignId('penalty_type_id')->nullable()->constrained()->onDelete('set null');
            $table->timestamp('applied_at');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penalties');
    }
}
