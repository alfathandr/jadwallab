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
        Schema::create('schedule_entries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('schedule_id')->constrained('schedules')->onDelete('cascade'); // Relasi ke tabel schedules
            $table->foreignId('lecturer_id')->constrained('lecturers')->onDelete('cascade'); // Relasi ke tabel lecturers
            $table->string('day'); // Hari
            $table->integer('session'); // Jam ke-
            $table->time('start_time'); // Waktu mulai
            $table->time('end_time');
            $table->string('grub'); // Nama kelas
            $table->string('course'); // Mata kuliah
            $table->string('room'); // Nama ruangan
            $table->integer('credits'); // SKS
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedule_entris');
    }
};
