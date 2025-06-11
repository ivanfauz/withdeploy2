<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Qizzy Auction</title>
    <link rel="icon" type="img/logo.png" href="img/logo.png">
    <link rel="stylesheet" href="style.css"> <!-- Pastikan file CSS sesuai -->
    <style>
        /* Style untuk layout utama */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
        }

        /* Style untuk sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            background-color: #343a40;
            padding: 20px;
            width: 60px; /* Width default saat minimize */
            transition: width 0.3s ease;
            overflow: hidden;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            color: #fff;
        }

        /* Hover untuk memperbesar sidebar */
        .sidebar:hover {
            width: 200px; /* Width saat dihover */
        }

        /* Teks "VGA" yang selalu terlihat */
        .sidebar h2 {
            font-size: 18px;
            margin-bottom: 20px;
            text-align: center;
        }

        /* Hanya tampil penuh saat di hover */
        .sidebar ul {
            list-style-type: none;
            padding: 0;
        }

        .sidebar ul li {
            margin: 15px 0;
        }

        .sidebar ul li a {
            text-decoration: none;
            color: #fff;
            font-weight: bold;
            padding: 10px;
            display: flex;
            align-items: center;
            background-color: #495057;
            border-radius: 5px;
            white-space: nowrap;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .sidebar ul li a:hover {
            background-color: #6c757d;
        }

        .short-vga {
            display: inline; /* Tampil saat minimize */
        }

        .full-text {
            display: none; /* Disembunyikan saat minimize */
        }

        /* Saat sidebar diperbesar */
        .sidebar:hover .full-text {
            display: inline; /* Muncul saat hover */
        }

        .sidebar:hover .short-vga {
            display: none; /* Disembunyikan saat hover */
        }

        /* Style untuk konten utama */
        .main-content {
            flex-grow: 1;
            padding: 20px;
            background-color: #f8f9fa;
            margin-left: 60px; /* Default space untuk sidebar yang kecil */
            transition: margin-left 0.3s ease;
            text-align: center;

             /* Tambahan untuk memusatkan konten */
             display: flex;
             justify-content: center;
             align-items: center;
             height: 100vh; /* Pastikan memenuhi tinggi viewport */
             text-align: center; /* Untuk teks yang lebih rapi */
        }

        .about-content {
            max-width: 600px; /* Membatasi lebar maksimal konten agar tidak terlalu melebar */
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        /* Saat sidebar di hover, content bergeser */
        .sidebar:hover ~ .main-content {
            margin-left: 200px;
        }

        /* Responsive styling */
        @media (max-width: 768px) {
            .card {
                width: calc(50% - 40px);
            }
        }

        @media (max-width: 480px) {
            .card {
                width: 100%;
            }
        }

        /* Profil pengguna di kanan atas */
        .user-profile {
            position: fixed;
            top: 20px;
            right: 20px;
            display: flex;
            align-items: center;
        }

        /* Gaya untuk ikon profil */
        #profile-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            cursor: pointer;
        }

        /* Dropdown menu */
        .user-menu {
            display: none;
            position: absolute;
            top: 60px;
            right: 0;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            overflow: hidden;
            width: 150px;
            z-index: 10;
        }

        .user-menu a {
            display: block;
            padding: 10px;
            text-decoration: none;
            color: #343a40;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .user-menu a:hover {
            background-color: #f1f1f1;
        }

        /* Responsiveness untuk profil */
        @media (max-width: 480px) {
            .user-profile {
                right: 10px;
            }
            .user-menu {
                width: 130px;
            }
        }

    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h2><span class="short-vga">Qzy Act</span><span class="full-text"> Qizzy Auction</h2>
   <ul>
        <li><a href="vga_second.html"><span class="short-vga">Scd</span><span class="full-text"> Second</span></a></li>
        <li><a href="vga_ex_mining.html"><span class="short-vga">Ex</span><span class="full-text"> Ex-Mining</span></a></li>
        <li><a href="vga_baru.html"><span class="short-vga">Baru</span><span class="full-text"> Baru</span></a></li>
    </ul>   
    </div>

    <!-- Konten Utama -->
    <div class="main-content">
<div class="about-content">
        <h1>INTRODUCTION</h1>
        <p>Selamat datang di Qizzy Auction! Kami menyediakan platform lelang untuk berbagai kategori produk, 
           khususnya kartu grafis (VGA) yang terbagi menjadi beberapa tipe, seperti second, ex-mining, dan baru. 
           Website ini dirancang untuk memudahkan pengguna dalam melelang atau membeli VGA dengan proses yang aman dan transparan.</p>
        <p>Fitur utama dari website ini meliputi:</p>
        <ul>
            <li>Lelang secara real-time dengan sistem penawaran yang transparan.</li>
            <li>Data pengguna dan transaksi yang aman.</li>
            <li>Kategori produk yang terorganisir dengan baik.</li>
        </ul>
        <p>Terima kasih telah menggunakan Qizzy Auction!</p>
    </div>
    </div>

<!-- Profil Pengguna -->
<div class="user-profile">
    <img src="img/user.png" alt="Profile" id="profile-icon">
    <div class="user-menu" id="user-menu">
        <a href="edit_profile.php">Edit Profil</a> <!-- Pengalihan ke halaman edit_profile.php -->
        <a href="#" id="logout-btn">Logout</a>
    </div>
</div>


    <script>
        // Script untuk menampilkan dan menyembunyikan menu pengguna
        const profileIcon = document.getElementById('profile-icon');
        const userMenu = document.getElementById('user-menu');
        const logoutBtn = document.getElementById('logout-btn');

        profileIcon.addEventListener('click', function() {
            userMenu.style.display = userMenu.style.display === 'block' ? 'none' : 'block';
        });

        // Menyembunyikan menu jika klik di luar area menu
        document.addEventListener('click', function(event) {
            if (!profileIcon.contains(event.target) && !userMenu.contains(event.target)) {
                userMenu.style.display = 'none';
            }
        });

        // Fungsi logout
        logoutBtn.addEventListener('click', function() {
            alert("Kamu telah logout.");
            window.location.href = 'home.html'; // Pengalihan ke halaman home
        });
    </script>
</body>
</html>
