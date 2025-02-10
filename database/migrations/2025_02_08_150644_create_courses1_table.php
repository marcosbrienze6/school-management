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
        Schema::create('courses1', function (Blueprint $table) {
            $table->id();
            $table->string('Portuguese');
            $table->string('Math');
            $table->string('History');
            $table->string('Geography');
            $table->string('Science');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses1');
    }
};
