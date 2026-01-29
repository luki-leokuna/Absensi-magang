<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $password = Hash::make('password123');  //pass default

       // akun admin
       User::create([
        'name' => 'Administrator Sistem',
        'email' => 'admin@kemenkumham.go.id',
        'password'=> $password,
        'role'=> 'admin',
        'divisi'=> 'TATA_USAHA',
        'nip'=> '199001012020121001',
        'jabatan'=> 'Pranata Komputer Ahli Pertama',
       ]);

       // akun mentor (sesuai 3 divisi utama)
       // 1. Mentor Divisi Pelayanan Hukum
       $mentorYankum = User::create([
        'name'=>'Budi Santoso, S.H',
        'email'=> 'mentor.yankum@kemenkumham.go.id',
        'password'=> $password,
        'role'=>'mentor',
        'divisi'=> 'PELAYANAN_HUKUM',
        'nip'=> '198505052010011001',
        'jabatan' => 'Kepala Bagian Pelayanan AHU',
       ]);

       //2. Mentor Divisi Peraturan Perundang-undangan (PP) & Pembinaan Hukum
       $mentorPP = User::create([
        'name'=> 'Siti Aminah, S.H., M.H',
        'email'=> 'mentor.pp@kemenkumham.go.id',
        'password'=> $password,
        'role'=> 'mentor',
        'divisi'=> 'PP_PEMBINAAN_HUKUM',
        "nip"=> '198808082012122002',
        'jabatan'=> 'Perancang Peraturan Perundang-undangan', //jabatan fungsional
       ]);

       // 3. Mentor Bagian Tata Usaha
       $mentorTU = User::create([
        'name'=>'Rahmat Hidayat, S.Kom',
        'email'=> 'mentor.tu@kemenkumham.go.id',
        'password'=>$password,
        'role'=> 'mentor',
        'divisi' =>'TATA_USAHA',
        'nip'=>'198202022005051003',
        'jabatan'=> 'Kepala Bagian Tata Usaha dan Umum',
       ]);

       // akun peserta magang

       // 1. peserta yang magang dibawah Mentor TU
       User::create([
        'name'=> 'Ghina Rahma Hidayah',
        'email'=> 'ghina@gmail.com',
        'password'=>$password,
        'role'=>'peserta',
        'divisi'=> 'TATA_USAHA',
        'institusi' => 'Universitas Bumigora',
        'mentor_id'=> $mentorTU->id,  //relasi otomatis ke mentor TU
       ]);

       //2. peserta magang dibawah Mentor Yankum
       User::create([
        'name'=> 'Anita',
        'email'=> 'anita12@gmail.com',
        'password'=> $password,
        'role'=> 'peserta',
        'divisi'=> 'PELAYANAN_HUKUM',
        'institusi'=> 'Universitas Mataram',
        'mentor_id'=> $mentorYankum->id, //relasi ke mentor Yankum
       ]);
    }
}
