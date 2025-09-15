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
        Schema::create('profiles', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained();
            $table->string('phone')->nullable();
            $table->integer('age')->nullable();
            $table->text('bio')->nullable();
            $table->string('avatar')->nullable();
            $table->date('birthdate')->nullable();
            $table->string('province')->nullable();
            $table->string('city')->nullable();
            $table->string('barangay')->nullable();
            $table->decimal('penalty')->nullable();
            $table->string('qr_code')->nullable();
            $table->id();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
