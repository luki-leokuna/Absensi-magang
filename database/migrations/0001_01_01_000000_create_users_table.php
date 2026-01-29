<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            // Role: pembeda hak akses
            $table->enum('role', ['admin', 'mentor', 'peserta'])->default('peserta');

            // Divisi: sesuai struktur organisasi Permenkum no 2 tahun 2024
            $table->enum('divisi', [
                'PIMPINAN_TINGGI',  //kakanwil & kadiv
                'PELAYANAN_HUKUM',  //divisi pelayanan hukum
                'PP_PEMBINAAN_HUKUM', // divisi peraturan perundang-undang
                'TATA_USAHA',  //bagian tata usaha dan umum
                'LAINNYA' //untuk tamu
            ])->nullable;

            // data identitas pegawai / peserta magang
            $table->string('nip')->nullable(); // NIP buat mentor
            $table->string('jabatan')->nullable(); //Contoh (Kepala Bidang AHU)
            $table->string('institusi')->nullable(); //asal kampus/sekolah (untuk peserta magang/PKL)

            //Relasi Mentor
            // untuk mencatat siapa mentor dari peserta magang
            $table->foreignId('mentor_id')->nullable()->constrained('users')->onDelete('set null');

            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
