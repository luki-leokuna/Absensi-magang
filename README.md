 # Sistem Absensi & Jurnal Harian Magang
 Kantor Wilayah Kementerian Hukum Nusa Tenggara Barat

 # Teknologi yang Digunakan
 -Framework : Laravel 12
 -Starter Kit : None
 -Styling : Tailwind CSS
 -Database : SQLite
 -Environment : Laravel Herd
 #Fitur Khusus: 
    - Native HTML5 Camera: untuk capture wajah
    - HTML5 Geolocation API: untuk validasi titik koordinat peserta
    - Leaflet.js: untuk menampilkan peta lokasi absen

 # Fitur Utama
 Web ini memfasilitasi tiga role :

 1. Peserta Magang / PKL
   - Absen Masuk (Check-in): Mencatat waktu kedatangan
     - Wajib ada dalam radius kantor (Geofencing)
     - Wajib mengambil foto selfie secara real-time 
   - Absen Pulang (Check-Out): Mencatat waktu pulang (wajib mengisi jurnal harian)
   - Jurnal Harian : Menginput kegiatan hari ini dan tugas dari mentor/pembimbing

2. Mentor/Pembimbing
  - Dashboard Mentoring: Melihat daftar anak magang dibawah bimbingannya sesuai divisi
  - Validasi Jurnal/laporan: Menyetujui atau menolak laporan harian peserta magang/PKL
  - Melihat bukti foto dan lokasi absen peserta di peta
  - Feedback: Memberikan catatan/komentar pada jurnal/laporan peserta 

3. Admin
 - Manajemen User: Tambah, Edit, Hapus akun mentor & peserta
 - Maping Divisi: Mengatur Penempatan peserta sesuai struktur organisasi yang ada di dokumen permenkum
 - Pengaturan Lokasi: Mengatur titik koordinat dan radius toleransi (meter)
 - Rekap Laporan: Ekspor data kehadiran untuk laporan akhir magang/PKL
