-- Buat database jika belum ada
CREATE DATABASE IF NOT EXISTS lelang_vga;
USE lelang_vga;

-- Tabel users
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_lengkap VARCHAR(100) NOT NULL,
    tanggal_lahir DATE NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabel barang_baru
CREATE TABLE IF NOT EXISTS barang_baru (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_barang VARCHAR(255) NOT NULL,
    deskripsi TEXT,
    harga_awal INT NOT NULL,
    harga_terakhir INT DEFAULT 0,
    waktu_habis DATETIME NOT NULL,
    stok INT NOT NULL
);

-- Tabel barang_second
CREATE TABLE IF NOT EXISTS barang_second (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_barang VARCHAR(255) NOT NULL,
    deskripsi TEXT,
    harga_awal INT NOT NULL,
    harga_terakhir INT DEFAULT 0,
    waktu_habis DATETIME NOT NULL
);

-- Tabel barang_ex_mining
CREATE TABLE IF NOT EXISTS barang_ex_mining (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_barang VARCHAR(255) NOT NULL,
    deskripsi TEXT,
    harga_terakhir INT DEFAULT 0,
    stok INT NOT NULL
);

-- Tabel bids
CREATE TABLE IF NOT EXISTS bids (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    kategori ENUM('baru', 'second', 'ex_mining') NOT NULL,
    bid_amount INT NOT NULL,
    item_id INT NOT NULL,
    bid_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Tabel admin
CREATE TABLE IF NOT EXISTS admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Masukkan data dummy ke tabel users
INSERT INTO users (nama_lengkap, tanggal_lahir, email, password) VALUES
('Ivan Fauzan', '2002-03-15', 'qizzy15@example.com', MD5('123')),
('Ahmad Sutanto', '1995-06-20', 'ahmad@example.com', MD5('456')),
('Siti Rahma', '1998-09-10', 'siti@example.com', MD5('789'));

-- Masukkan data dummy ke tabel barang_baru
INSERT INTO barang_baru (nama_barang, deskripsi, harga_awal, harga_terakhir, waktu_habis, stok) VALUES
('GPU RTX 4090', 'GPU terbaru dengan performa tinggi.', 15000000, 0, '2024-12-23 23:59:59', 10),
('GPU RTX 4080', 'GPU terbaru dengan performa tinggi.', 13000000, 0, '2024-12-20 23:59:59', 5);

-- Masukkan data dummy ke tabel barang_second
INSERT INTO barang_second (nama_barang, deskripsi, harga_awal, harga_terakhir, waktu_habis) VALUES
('SAPPHIRE NITRO+ RX580 4GB', 'GPU second berkualitas.', 40000000, 0, '2024-12-16 23:59:59'),
('AMD RADEON HD 7700 2GB', 'GPU second murah.', 2800000, 0, '2024-12-14 23:59:59'),
('NVIDIA ATI 128bit 2GB', 'GPU second performa baik.', 7800000, 0, '2024-12-13 23:59:59'),
('SAPPHIRE HD 6950 256bit 2GB', 'GPU second terbaik.', 12000000, 0, '2024-12-23 23:59:59');

-- Masukkan data dummy ke tabel barang_ex_mining
INSERT INTO barang_ex_mining (nama_barang, deskripsi, harga_terakhir, stok) VALUES
('GPU RX 580', 'GPU ex-mining dengan harga terjangkau.', 2000000, 3),
('GPU GTX 1060', 'GPU ex-mining performa tinggi.', 2500000, 5);

-- Masukkan data dummy ke tabel bids
-- Pastikan user_id merujuk ke data yang valid di tabel users
INSERT INTO bids (user_id, kategori, bid_amount, item_id) VALUES
(1, 'baru', 500000, 1),
(2, 'second', 2000000, 1),
(3, 'ex_mining', 3000000, 1);

-- Masukkan data dummy ke tabel admin
INSERT INTO admin (username, email, password) VALUES
('admin', 'admin@example.com', MD5('123')),
('superadmin', 'superadmin@example.com', MD5('456'));

-- Menampilkan data dari tabel users
SELECT * FROM users;

-- Menampilkan data dari tabel barang_baru
SELECT * FROM barang_baru;

-- Menampilkan data dari tabel barang_second
SELECT * FROM barang_second;

-- Menampilkan data dari tabel barang_ex_mining
SELECT * FROM barang_ex_mining;

-- Menampilkan data dari tabel bids
SELECT * FROM bids;

-- Menampilkan data dari tabel admin
SELECT * FROM admin;