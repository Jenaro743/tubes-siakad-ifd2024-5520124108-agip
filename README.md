# SIAKAD Laravel

SIAKAD adalah sistem informasi akademik sederhana yang dibangun dengan Laravel 12. Proyek ini mendukung tiga peran pengguna: `admin`, `dosen`, dan `mahasiswa`, dengan dashboard, navigasi menu, dan kontrol akses berbasis peran.

**Link Hosting : https://agipj.gt.tc/**

## Fitur Utama

- Role-based authentication untuk `admin`, `dosen`, dan `mahasiswa`
- Dashboard khusus setiap peran
- Admin dapat mengelola:
  - Dosen
  - Mahasiswa
  - Mata Kuliah
  - Jadwal
- Mahasiswa dapat mengambil KRS, melihat jadwal, dan mengubah profil
- Dosen dapat melihat profil dan jadwal mengajar
- Sidebar menyesuaikan menu berdasarkan role pengguna
- Password default seed semua user: `12345678`

## Halaman dan Fungsinya

### Login

- Alamat: `/login`
- Fungsi: masuk ke aplikasi menggunakan email dan password
- Contoh akun seed:
  - Admin: `admin@gmail.com` / `12345678`
  - Dosen: `dosen1@siakad.test` / `12345678`
  - Mahasiswa: `mhs1@siakad.test` / `12345678`

### Dashboard

- Alamat: `/dashboard`
- Fungsi: tampilan utama setelah login
- Konten berbeda untuk setiap role:
  - `admin`: ringkasan statistik data, chart, dan shortcut ke manajemen
  - `dosen`: profil dosen dan ringkasan jadwal mengajar
  - `mahasiswa`: jumlah SKS, jadwal hari ini, dan informasi KRS

### Admin

- `admin/dosen` - manajemen data dosen
- `admin/mahasiswa` - manajemen data mahasiswa
- `admin/mata-kuliah` - manajemen daftar mata kuliah
- `admin/jadwal` - manajemen jadwal perkuliahan

### Mahasiswa

- `mahasiswa/krs` - daftar KRS yang diambil dan tambah/hapus KRS
- `mahasiswa/jadwal` - melihat jadwal kuliah mahasiswa
- `mahasiswa/profile` - mengubah data profil mahasiswa

Sidebar mahasiswa juga menampilkan jumlah mata kuliah KRS yang sudah dipilih.

### Dosen

- `dosen/jadwal` - daftar jadwal mengajar dosen
- `dashboard` - halaman utama dosen dengan profil dan ringkasan jadwal

Sidebar dosen menampilkan:
- Dashboard
- Jadwal Mengajar

## Teknologi

- Laravel 12
- Blade Templates
- Bootstrap 5
- Eloquent ORM
- Migration dan Seeder


## Catatan Penting

- Semua user default menggunakan password `12345678`
- Role `dosen` dapat login langsung lewat halaman login
- Sidebar otomatis menyesuaikan menu berdasarkan role pengguna
- Fitur KRS untuk mahasiswa menampilkan jumlah mata kuliah yang sudah diambil di menu

