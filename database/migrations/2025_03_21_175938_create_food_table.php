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
        Schema::create('food', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->date('date');
            $table->enum('time', ['1','2','3']);
            $table->string('food_title');
            $table->enum('size', ['1','2','3','4']);
            $table->enum('spice', ['1','2','3','4','5']);
            $table->enum('fat', ['1','2','3','4','5']);
            $table->boolean('gluten');
            $table->boolean('dairy');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food');
    }
};
