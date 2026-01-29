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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();

            //relasi ke user
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // waktu & tanggal
            $table->date('date')->index(); // pake index untuk pencarian cepat
            $table->time('check_in_time');
            $table->time('check_out_time')->nullable;

            //validasi lokasi & foto
            $table->string('photo_path')->nullable();
            $table->decimal('latitude', 10, 8)->nullable();

            // jurnal harian
            $table->text('activity')->nullable(); // kegiatan hari inii
            $table->text('assignment')->nullable(); // tugas dari mentor

            // status kehadiran
            $table->enum('status',
            ['hadir',
            'izin',
            'sakit',
            'alpha',
            'wfh'])->default('hadir');

            //validasi mentor
            $table->enum('verification_status',[
                'pendding',
                'approved',
                'rejected'
            ])->default('pending');
            $table->string('mentor_note')->nullable(); //catatan revisi dari mentor
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
