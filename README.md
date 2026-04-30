# uas_pemograman_web2

Nama: Bagus Sanjaya

Kelas: I241E

Nim: 312410505

## SQL Injection Experiment (PHP & MySQL)

Proyek ini merupakan eksperimen sederhana untuk memahami bagaimana **SQL Injection** bekerja pada sistem login berbasis PHP dan MySQL, serta bagaimana cara mencegahnya.


### Deskripsi

Pada proyek ini dibuat dua kondisi:
1. **Login rentan (vulnerable)** → bisa ditembus menggunakan SQL Injection  
2. **Login aman (secure)** → menggunakan prepared statement  

Eksperimen ini bertujuan untuk menunjukkan bahwa kesalahan kecil dalam penulisan query dapat menyebabkan celah keamanan yang serius.


### Hasil Eksperimen

Pada versi rentan, login dapat ditembus tanpa password menggunakan input:

`admin' #`


Hal ini terjadi karena karakter `#` berfungsi sebagai komentar di MySQL, sehingga query berubah dan bagian password diabaikan.

### Teknologi yang Digunakan

- PHP
- MySQL
- XAMPP (Apache & phpMyAdmin)
- HTML & CSS (UI sederhana)

### Struktur Project

sql_injection_test/
│
├── index.html # Halaman login (UI)
├── login.php # Proses login (rentan / aman)
└── README.md # Dokumentasi project


### Cara Kerja SQL Injection

Query login yang digunakan:

```sql
SELECT * FROM users WHERE username='$username' AND password='$password';
```
Jika user memasukkan:

`admin' #`

Maka query berubah menjadi:

`SELECT * FROM users WHERE username='admin' # ' AND password='...';`

Bagian setelah # diabaikan, sehingga login berhasil tanpa password.

Versi Rentan

Contoh kode yang rentan:

$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";

Masalah:

Input langsung dimasukkan ke query

Tidak ada validasi atau proteksi

Versi Aman

Menggunakan Prepared Statement:

```
$stmt = $conn->prepare("SELECT * FROM users WHERE username=? AND password=?");

$stmt->bind_param("ss", $username, $password);

$stmt->execute();
```

Keuntungan:

Input tidak bisa memanipulasi query

Mencegah SQL Injection

Cara Menjalankan Project

1. Install XAMPP

2. Jalankan Apache & MySQL

3. Pindahkan folder ke:

`C:\xampp\htdocs\`

4. Buat database di phpMyAdmin:

- Nama: test_db

Jalankan SQL berikut:

```
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50),
    password VARCHAR(50)
);

INSERT INTO users (username, password) VALUES ('admin', '12345');
```

Buka di browser:

`http://localhost/sql_injection_test`

Tampilan UI

UI dibuat sederhana dan elegan untuk memudahkan pengujian login.

Tujuan Pembelajaran

Memahami konsep SQL Injection

Mengetahui dampak keamanan pada aplikasi web

Menerapkan teknik pencegahan yang benar

Catatan

Proyek ini dibuat hanya untuk tujuan pembelajaran.

Tidak disarankan digunakan untuk aktivitas yang melanggar hukum.

Referensi

https://owasp.org/www-community/attacks/SQL_Injection

https://www.w3schools.com/sql/sql_injection.asp
