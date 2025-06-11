<?php
// Pengaturan koneksi ke database Lelang VGA di phpMyAdmin
$host = "localhost";    // Server lokal
$db = "lelang_vga";     // Nama database yang digunakan
$user = "root";         // Username default phpMyAdmin
$pass = "";             // Kosongkan jika tanpa password

// Mengatur mode pelaporan kesalahan MySQLi untuk debugging (opsional)
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    // Membuat koneksi menggunakan PDO
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    // Mengatur mode error PDO
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Pesan sukses untuk debugging
    // echo "Koneksi ke database berhasil!";
} catch (PDOException $e) {
    // Tampilkan pesan kesalahan jika koneksi gagal
    die("Koneksi gagal: " . $e->getMessage());
}
?>
