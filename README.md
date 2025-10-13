<h1 align="center">Rent Car Cylc - Final Project Website Rental Mobil</h1>

<p align="center">
  <b>Website Rental Mobil berbasis PHP Native dengan arsitektur MVC</b><br>
  Dibuat sebagai Final Project sistem penyewaan mobil modern dengan pembagian role: <b>User</b> & <b>Admin</b>.
</p>

<p align="center">
  <img src="https://img.shields.io/badge/PHP-Native-blue?logo=php" alt="PHP Badge"/>
  <img src="https://img.shields.io/badge/MySQL-Database-orange?logo=mysql" alt="MySQL Badge"/>
  <img src="https://img.shields.io/badge/TailwindCSS-Frontend-38BDF8?logo=tailwind-css" alt="Tailwind Badge"/>
  <img src="https://img.shields.io/badge/Chart.js-Statistics-red?logo=chartdotjs" alt="Chart.js Badge"/>
  <img src="https://img.shields.io/badge/License-MIT-green" alt="License Badge"/>
</p>

---

## Fitur Utama

### **User**
Pengguna dapat:
- Login & Registrasi akun.
- Melihat **daftar mobil tersedia** lengkap dengan harga & deskripsi.
- Melakukan **booking / transaksi penyewaan mobil**.
- Melihat **riwayat penyewaan** mobil yang sudah dilakukan.
- Mengirim **laporan bug, kendala, atau saran** kepada admin.
- Menghubungi admin melalui form kontak.

### **Admin**
Admin memiliki akses penuh untuk:
- **CRUD data mobil** (tambah, ubah, hapus, lihat daftar mobil).
- **CRUD data user** (kelola akun pengguna).
- **Mengontrol transaksi penyewaan mobil.**
- **Meninjau laporan bug / saran dari user.**
- **Melihat statistik sistem** dengan visualisasi **Chart.js** (jumlah mobil, user, transaksi, dll).

---

## Teknologi yang Digunakan

| Komponen | Teknologi |
|-----------|------------|
| **Frontend** | [Tailwind CSS](https://tailwindcss.com/) |
| **Backend** | PHP Native |
| **Database** | MySQL |
| **Arsitektur** | MVC (Model - View - Controller) |
| **Paradigma** | OOP (Object-Oriented Programming) |
| **Database Driver** | PDO (PHP Data Object) |
| **Chart Library** | [Chart.js](https://www.chartjs.org/) |

---

## Struktur Proyek

```
FINALPROJECT-RENTALMOBIL/
│
├── App/
│   ├── Controllers/
│   │   ├── login.php
│   │   └── signup.php
│   ├── Models/
│   │   ├── database.php
│   │   ├── index.php
│   │   ├── mobil.php
│   │   ├── transaksi.php
│   │   └── user.php
│   └── Views/
│       ├── data-mobil.php
│       ├── index.php
│       ├── kelola-user.php
│       ├── laporan.php
│       ├── pengembalian.php
│       └── transaksi.php
│
│
├── node_modules
│
├── src/
│   ├── assets/
│   │    ├── bmw.jpeg
│   │    ├── jesco.jpeg
│   │    ├── Jesko Absolut.jpeg
│   │    └──koenigsegg.jpeg
│   │
│   ├── fp_rentalmobil (1).sql
│   ├── input.cs
│   └── output.css
│
├── index.php
├── package-lock.json
├── package.json
└── README.md
```

---

## Cara Menjalankan Proyek

### Clone Repository
```bash
git clone https://github.com/username/FinalProject-RentalMobil.git
```

### **phpMyAdmin**
2. Buat database baru, misalnya `fp_rentalmobil`
3. Import file:
   ```
   fp_rentalmobil.sql
   ```

### Konfigurasi Database
Edit file:
```
App/Models/database.php
```
Ubah konfigurasi koneksi:
```php
$host = 'localhost';
$dbname = 'fp_rentalmobil';
$username = 'root';
$password = '';
```

### Jalankan Server Lokal
Pastikan proyek ada di folder server lokal (`htdocs` atau `www`), lalu akses melalui browser:
```
http://localhost/FINALPROJECT-RENTALMOBIL
```

---

## Dashboard Admin

Dashboard Admin menampilkan ringkasan data penting seperti:
- Jumlah pengguna aktif
- Jumlah transaksi sewa
- Jumlah mobil tersedia
- Daftar laporan bug / saran user  

Semua data divisualisasikan menggunakan **Chart.js** agar mudah dipahami secara visual dan interaktif.

---

## Tujuan Proyek

Membangun sistem **rental mobil online** yang:
- Modern dan efisien dengan **Tailwind CSS**.
- Memiliki struktur kode rapi dengan **MVC & OOP**.
- Aman dan mudah dikembangkan dengan **PDO**.
- Mempermudah admin mengelola data dan pengguna.

---

## Preview Tampilan

| Halaman | Screenshot |
|----------|-------------|
| Halaman Utama | ![Home](assets/bmw.jpeg) |
| Daftar Mobil | ![Daftar Mobil](assets/jesco.jpeg) |
| Dashboard Admin | ![Dashboard](assets/koenigsegg.jpeg) |
---

## Developer Information

**Developer Team:** Kelompok RENTAL MOBIL  

**Anggota Tim:**  
- Fadlan Firdaus
- Achmad Fattah Safaraz
- Fahri Noor Royyan
- Farrel Azam Kahupati
- Nathan Andika Dilma
- Razief Raftansyah

**Project:** Final Project – Website Rental Mobil  
**Tech Stack:** PHP Native · MySQL · TailwindCSS · Chart.js  
**Tahun:** 2025  


---

## Credits & Thanks

Terima kasih kepada:
- pembimbing yang telah memberikan arahan selama pengembangan.
- Tim & rekan yang membantu dalam testing dan ide pengembangan.
- [Tailwind CSS](https://tailwindcss.com/) & [Chart.js](https://www.chartjs.org/) atas teknologi yang luar biasa.

---

## License

Proyek ini dilisensikan di bawah lisensi **MIT License** — bebas digunakan, dimodifikasi, dan dikembangkan untuk tujuan edukatif.

```
MIT License © 2025 [Nama Kamu]
```

---

<h3 align="center">"Simple, Clean, and Functional — Built with Passion." </h3>
