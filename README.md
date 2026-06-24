# Sistem Informasi Manajemen Jemaat (SIMJ)

SIMJ adalah aplikasi berbasis web *open-source* (gratis) yang dirancang khusus untuk mempermudah operasional, pencatatan database jemaat, pengelolaan keuangan donasi, serta absensi Sekolah Minggu/ibadah di gereja secara digital, transparan, dan akuntabel.

---

## 🚀 Fitur Utama & Modul Sistem

Sistem ini memiliki **7 Modul Utama** dengan **lebih dari 25 Fitur Unggulan** yang siap melayani kebutuhan administrasi gereja Anda:

### 1. Modul Database Jemaat & Keluarga
* **Profil Jemaat Lengkap:** Menyimpan biodata mendalam (nama lengkap, kontak, riwayat baptis, sidi, status keanggotaan, foto) yang dapat dicari dalam 3 detik menggunakan *Fuzzy Search*.
* **Manajemen Kartu Keluarga:** Mengelompokkan jemaat berdasarkan keluarga dengan satu alamat utama. Dilengkapi fitur *Address Inheritance* (jika alamat keluarga berubah, alamat semua anggota di dalamnya otomatis ikut diperbarui).
* **Kolom Data Kustom (Custom Fields):** Fleksibilitas menambahkan kolom isian data baru sesuai kebutuhan gereja lokal (misal: nama baptis, sektor/wilayah, klan/marga).
* **Riwayat Catatan Gembala (Pastoral Notes):** Catatan riwayat bimbingan pastoral yang dienkripsi dan hanya dapat diakses secara rahasia oleh Pendeta/Konselor yang berwenang.

### 2. Modul Grup & Struktur Pelayanan
* **Pengelompokan Pelayanan (Group Manager):** Mengatur grup pelayanan seperti Paduan Suara, Komisi Wanita, Kepanitiaan, atau Persekutuan Doa secara dinamis.
* **Manajemen Peran Grup:** Mengatur jabatan pengurus di dalam grup (Ketua, Sekretaris, Bendahara, Anggota).
* **Modul Sekolah Minggu Khusus:** Pemisahan kelas otomatis untuk anak-anak (murid) dan guru/pengajar berdasarkan jenjang umur lengkap dengan daftar kontak darurat orang tua.
* **Properti Khusus Grup:** Kolom data tambahan khusus anggota grup tertentu (misal: kolom "Tipe Suara" khusus untuk anggota grup paduan suara).

### 3. Modul Absensi Digital & Acara (Presensi)
* **Manajemen Acara & Ibadah:** Membuat jadwal ibadah mingguan atau rapat majelis dengan sistem perulangan otomatis.
* **Sistem Kios Absensi Mandiri (Check-in Kiosk):** Jemaat atau anak Sekolah Minggu cukup mengetik sebagian nama keluarga pada tablet layar sentuh untuk mencatat absen masuk (*Check-in*) dan keluar (*Check-out*).
* **Absensi Pengajar:** Guru Sekolah Minggu dapat mencatat kehadiran murid secara massal dari kelas masing-masing menggunakan HP.
* **Grafik Tren Kehadiran:** Menyajikan laporan statistik persentase kehadiran ibadah mingguan untuk bahan evaluasi majelis.

### 4. Modul Keuangan & Donasi Terpadu
* **Pencatatan Transaksi Donasi:** Menginput persembahan kolekte umum, persepuluhan, diakonia, dan donasi khusus baik secara personal maupun anonim.
* **Slip Setoran Bank (Deposit Slip):** Mengelompokkan persembahan masuk secara digital dan memvalidasinya dengan jumlah fisik uang kertas/koin sebelum disetor ke bank.
* **Lacak Komitmen Janji Iman (Pledge Ledger):** Memantau target dana terkumpul vs sisa saldo janji iman jemaat (misal untuk pembangunan gedung gereja) secara otomatis.
* **Laporan Pajak Tahunan (Tax Statements):** Menghasilkan laporan PDF ringkasan seluruh donasi jemaat dalam 1 tahun sebagai bukti pengurang pajak resmi.
* **Pos Dana Donasi (Fund Management):** Memisahkan alokasi dana masuk (misal: dana pembangunan, dana diakonia) agar tidak tercampur dengan kas operasional umum.

### 5. Modul Komunikasi & Broadcast
* **Kirim Email Massal:** Menyebarkan warta jemaat elektronik atau pengumuman penting langsung dari sistem secara massal ke kotak masuk jemaat.
* **Broadcast SMS Massal:** Integrasi gateway SMS untuk mengirim pesan singkat pengingat rapat atau ucapan ulang tahun otomatis.
* **Peta GPS Jemaat (Mapping):** Menerjemahkan alamat fisik jemaat secara otomatis menjadi titik koordinat Latitude/Longitude pada peta digital untuk mempermudah perencanaan rute kunjungan gembala.

### 6. Modul Keranjang Cepat (Cart Utility)
* **Penyaringan Lanjutan:** Memilih beberapa jemaat secara acak atau berdasarkan kriteria khusus (misal: pasangan menikah di bulan berjalan) untuk dimasukkan ke penampungan sementara (Keranjang).
* **Aksi Massal Sekali Klik:** Mengirim email undangan rapat, membuat grup baru, memasukkan ke acara, atau mencetak label alamat amplop untuk seluruh jemaat yang ada di dalam keranjang sekaligus.

### 7. Keamanan Data & Administrasi Sistem
* **Hak Akses Multi-Level:** Membatasi akses menu sistem per pengguna (staf administrasi hanya melihat biodata, bendahara hanya melihat modul keuangan, dsb.).
* **Autentikasi Dua Faktor (2FA):** Pengamanan ekstra akun admin menggunakan kode OTP 6 digit dari aplikasi autentikator di HP.
* **Pencadangan Cloud Otomatis (Auto-Backup):** Membackup seluruh database secara otomatis berkala ke penyimpanan eksternal (Dropbox/Nextcloud/WebDAV).
* **Reset Sandi Darurat:** Fitur pemulihan cepat menggunakan kunci rahasia unik untuk mereset dan memulihkan akses administrator jika terjadi kasus darurat kehilangan seluruh akses login.

---

## 🛠️ Panduan Menjalankan Aplikasi

Aplikasi ini dapat dijalankan dengan mudah menggunakan Docker.

### 1. Prasyarat
Pastikan server Anda sudah terinstal:
* Docker & Docker Compose

### 2. Cara Menjalankan
1. Clone atau unduh repositori ini.
2. Jalankan perintah berikut di terminal:
   ```bash
   docker-compose up -d
   ```
3. Buka browser Anda dan akses:
   `http://localhost:8080` (atau port yang Anda sesuaikan).

### 3. Kredensial Masuk Pertama Kali (Default)
* **Username:** `Admin`
* **Password:** `changeme`

*Catatan: Anda akan diminta mengganti kata sandi default ini segera setelah login pertama kali demi keamanan.*

### 4. Pemulihan Sandi Darurat
Jika Anda kehilangan akses login administrator:
1. Akses halaman: `https://domain-anda.com/reset-password.php`
2. Masukkan **Kunci Rahasia** pemulihan Anda.
3. Klik tombol reset. Seluruh akun lama akan dihapus dan akun admin baru (`Admin` / `changeme`) akan dibuat ulang secara otomatis.
4. *Secara otomatis, file `reset-password.php` akan menghapus dirinya sendiri dari server demi keamanan setelah berhasil dijalankan.*
