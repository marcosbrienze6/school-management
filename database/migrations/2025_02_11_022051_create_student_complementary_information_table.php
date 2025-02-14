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
        if (Schema::hasTable('subject')) {
            Schema::create('student_complementary_information', function (Blueprint $table) {
                $table->id();
                $table->foreignId('student_id')->constrained('student');
                $table->foreignId('subject_id')->constrained('subject');
                // $table->integer('year');
                // $table->integer('semester');
                $table->float('attendance');
                $table->float('avarege_grade');
                $table->timestamps();
            });
        } 
        throw new Exception("bolsonaro da silva");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_complementary_information');
    }
};
