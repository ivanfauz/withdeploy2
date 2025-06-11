<?php
session_start();
require 'koneksi.php'; // Sertakan file koneksi

// Cek apakah form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    try {
        // Query untuk mencari pengguna di tabel users
        $sqlUser = "SELECT id, email, password FROM users WHERE email = :email";
        $stmtUser = $pdo->prepare($sqlUser);
        $stmtUser->bindParam(':email', $email);
        $stmtUser->execute();
        $user = $stmtUser->fetch(PDO::FETCH_ASSOC);

        // Query untuk mencari admin di tabel admin
        $sqlAdmin = "SELECT id, username, email, password FROM admin WHERE email = :email";
        $stmtAdmin = $pdo->prepare($sqlAdmin);
        $stmtAdmin->bindParam(':email', $email);
        $stmtAdmin->execute();
        $admin = $stmtAdmin->fetch(PDO::FETCH_ASSOC);

        // Cek apakah pengguna ditemukan di tabel users
        if ($user && password_verify($password, $user['password'])) {
            // Simpan ID pengguna ke dalam sesi
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = 'user';

            // Redirect ke halaman barang lelang setelah login berhasil
            header("Location: barang_lelang.php");
            exit();
        } 
        // Cek apakah admin ditemukan di tabel admin
        elseif ($admin && $password === $admin['password']) {
            // Simpan ID admin ke dalam sesi
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['username'] = $admin['username'];
            $_SESSION['role'] = 'admin';

            // Redirect ke halaman dashboard admin setelah login berhasil
            header("Location: admin_dashboard.php");
            exit();
        } 
        else {
            // Jika login gagal, kembalikan ke halaman login dengan pesan error
            echo "<script>alert('Email atau password salah. Coba lagi!'); window.location.href='login.html';</script>";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    header("Location: login.html");
    exit();
}
?>
