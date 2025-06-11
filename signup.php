<?php
// Sertakan file koneksi
require 'koneksi.php';

// Cek apakah form sudah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $nama_lengkap = isset($_POST['nama_lengkap']) ? $_POST['nama_lengkap'] : '';
    $tanggal_lahir = isset($_POST['tanggal_lahir']) ? $_POST['tanggal_lahir'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $confirm_password = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : '';

    // Cek apakah semua field sudah diisi
    if (!empty($nama_lengkap) && !empty($tanggal_lahir) && !empty($email) && !empty($password) && !empty($confirm_password)) {
        // Cek apakah password dan konfirmasi password cocok
        if ($password === $confirm_password) {
            // Enkripsi password menggunakan password_hash
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            try {
                // Query untuk memasukkan data pengguna baru
                $sql = "INSERT INTO users (nama_lengkap, tanggal_lahir, email, password) VALUES (:nama_lengkap, :tanggal_lahir, :email, :password)";
                $stmt = $pdo->prepare($sql);

                // Bind parameter
                $stmt->bindParam(':nama_lengkap', $nama_lengkap);
                $stmt->bindParam(':tanggal_lahir', $tanggal_lahir);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':password', $hashed_password);

                // Eksekusi query
                $stmt->execute();

                // Jika berhasil, tampilkan pesan sukses dan arahkan ke halaman login
                echo "<script>alert('Akun berhasil dibuat!'); window.location.href='login.html';</script>";
            } catch (PDOException $e) {
                // Tampilkan pesan error jika terjadi masalah
                echo "Error: " . $e->getMessage();
            }
        } else {
            // Jika password tidak cocok, tampilkan pesan error
            echo "<h2>Gagal mendaftar!</h2>";
            echo "<p>Password dan konfirmasi password tidak cocok. <a href='signup.html'>Coba lagi</a></p>";
        }
    } else {
        echo "<h2>Gagal mendaftar!</h2>";
        echo "<p>Harap isi semua field. <a href='signup.html'>Coba lagi</a></p>";
    }
} else {
    // Jika form tidak diakses dengan metode POST, arahkan kembali ke halaman registrasi
    header("Location: signup.html");
    exit();
}
?>
