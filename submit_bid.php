<?php
// Konfigurasi database
$host = "localhost";
$username = "root";
$password = "";
$database = "lelang_vga";

// Koneksi ke database
$conn = new mysqli($host, $username, $password, $database);

// Periksa apakah koneksi ke database berhasil
if ($conn->connect_error) {
    die("Koneksi ke database gagal: " . $conn->connect_error);
}

// Mulai session
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['user_id']) || !isset($_SESSION['role'])) {
    echo "Anda belum login!";
    exit;
}

// Ambil data pengguna dari session
$user_id = $_SESSION['user_id'];
$role = $_SESSION['role'];

// Cek jika admin mencoba fitur user
if ($role === 'admin') {
    echo "<script>alert('Admin tidak diizinkan untuk melakukan bid!');</script>";
    echo "<script>window.history.back();</script>";
    exit;
}

// Ambil data dari form
$kategori = isset($_POST['kategori']) ? $_POST['kategori'] : '';
$item_id = isset($_POST['item_id']) ? $_POST['item_id'] : '';
$bid_amount = isset($_POST['bid_amount']) ? $_POST['bid_amount'] : '';

// Validasi input
if (empty($kategori) || empty($item_id) || empty($bid_amount)) {
    echo "Data belum lengkap!";
    exit;
}

// Validasi nilai bid_amount sebagai angka
if (!is_numeric($bid_amount) || $bid_amount <= 0) {
    echo "Nilai bid harus berupa angka positif!";
    exit;
}

// Validasi kategori
$valid_categories = ['baru', 'second', 'ex_mining'];
if (!in_array($kategori, $valid_categories)) {
    echo "Kategori tidak valid!";
    exit;
}

// Validasi apakah user_id ada di tabel users
$user_check_query = $conn->prepare("SELECT id FROM users WHERE id = ?");
$user_check_query->bind_param("i", $user_id);
$user_check_query->execute();
$user_check_query->store_result();
if ($user_check_query->num_rows === 0) {
    echo "User tidak ditemukan!";
    exit;
}
$user_check_query->close();

// Validasi apakah item_id ada di tabel barang sesuai kategori
$item_check_query = $conn->prepare("SELECT id FROM barang_$kategori WHERE id = ?");
$item_check_query->bind_param("i", $item_id);
$item_check_query->execute();
$item_check_query->store_result();
if ($item_check_query->num_rows === 0) {
    echo "Item tidak ditemukan dalam kategori $kategori!";
    exit;
}
$item_check_query->close();

// Query untuk memasukkan data bid ke tabel bids
$stmt = $conn->prepare("INSERT INTO bids (user_id, kategori, bid_amount, item_id) VALUES (?, ?, ?, ?)");
$stmt->bind_param("issi", $user_id, $kategori, $bid_amount, $item_id);

// Eksekusi query
if ($stmt->execute()) {
    // Query untuk mendapatkan penawaran terakhir (bid tertinggi)
    $last_bid_query = $conn->prepare("SELECT MAX(bid_amount) AS penawaran_terakhir FROM bids WHERE item_id = ? AND kategori = ?");
    $last_bid_query->bind_param("is", $item_id, $kategori);
    $last_bid_query->execute();
    $last_bid_result = $last_bid_query->get_result();

    // Ambil hasil query
    $penawaran_terakhir = 0;
    if ($row = $last_bid_result->fetch_assoc()) {
        $penawaran_terakhir = $row['penawaran_terakhir'];
    }

    $penawaran_terakhir_formatted = number_format($penawaran_terakhir, 0, ',', '.');

    // Tampilkan notifikasi bid berhasil dengan penawaran terakhir
    echo "<script>alert('Bid berhasil! Penawaran terakhir adalah Rp. $penawaran_terakhir_formatted');</script>";
    echo "<script>window.location.href = 'vga_$kategori.html';</script>";

    $last_bid_query->close();
} else {
    // Tampilkan pesan error jika query gagal
    echo "Gagal melakukan bid: " . $stmt->error;
}

// Tutup koneksi ke database
$stmt->close();
$conn->close();
?>
