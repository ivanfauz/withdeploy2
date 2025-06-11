<?php
// Mulai sesi dan koneksi ke database
session_start();
$host = "localhost";
$username = "root";
$password = "";
$database = "lelang_vga";
$conn = new mysqli($host, $username, $password, $database);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data pengguna yang sedang login berdasarkan user_id
$user_id = $_SESSION['user_id']; // Pastikan user_id sudah disimpan saat login
$query = "SELECT nama_lengkap, email FROM users WHERE id = ?";
$stmt = $conn->prepare($query);

if (!$stmt) {
    die("Error pada prepare statement: " . $conn->error);
}

$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($nama_lengkap, $email);
$stmt->fetch();
$stmt->close();

// Jika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_nama_lengkap = $_POST['nama_lengkap'];
    $new_email = $_POST['email'];
    $new_password = $_POST['password'];

    // Hash password jika diubah
    if (!empty($new_password)) {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
    } else {
        $query = "SELECT password FROM users WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $stmt->bind_result($hashed_password);
        $stmt->fetch();
        $stmt->close();
    }

    // Update data ke database
    $update_query = "UPDATE users SET nama_lengkap = ?, email = ?, password = ? WHERE id = ?";
    $stmt = $conn->prepare($update_query);

    if (!$stmt) {
        die("Error pada prepare statement: " . $conn->error);
    }

    $stmt->bind_param("sssi", $new_nama_lengkap, $new_email, $hashed_password, $user_id);

    if ($stmt->execute()) {
        echo "Profil berhasil diperbarui.";
        header("Location: edit_profile_admin.php");
        exit();
    } else {
        echo "Gagal memperbarui profil: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil Admin</title>
    <link rel="icon" type="img/logo.png" href="img/logo.png">
    <link rel="stylesheet" href="style.css">
    <style>
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

        /* Saat sidebar di hover, content bergeser */
        .sidebar:hover ~ .main-content {
            margin-left: 200px;
        }

        /* Main Content */
        .main-content {
            margin-left: 60px;
            padding: 20px;
            width: 100%;
            transition: margin-left 0.3s ease;
        }

        .sidebar:hover ~ .main-content {
            margin-left: 200px;
        }

        .edit-profile-container {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .edit-profile-container h2 {
            text-align: center;
            color: #343a40;
        }

        .edit-profile-container label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
            color: #343a40;
        }

        .edit-profile-container input[type="text"],
        .edit-profile-container input[type="email"],
        .edit-profile-container input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ced4da;
            border-radius: 5px;
        }

        .edit-profile-container button {
            width: 100%;
            padding: 10px;
            margin-top: 20px;
            background-color: #495057;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }

        .edit-profile-container button:hover {
            background-color: #6c757d;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h2><span class="short-vga">Qzy Act</span><span class="full-text"> Qizzy Auction</h2>
        <ul>
            <li><a href="admin_dashboard.php"><span class="short-vga">Home</span><span class="full-text"> Home</span></a>
            </li>
            <li><a href="vga_second_admin.html"><span class="short-vga">Scd</span><span class="full-text"> Second</span></a>
            </li>
            <li><a href="vga_ex_mining_admin.html"><span class="short-vga">Ex</span><span class="full-text">
                        Ex-Mining</span></a></li>
            <li><a href="vga_baru_admin.html"><span class="short-vga">Baru</span><span class="full-text"> Baru</span></a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="edit-profile-container">
            <h2>Edit Profil Admin</h2>
            <form method="POST" action="edit_profile_admin.php">
                <label for="nama_lengkap">Nama Lengkap</label>
                <input type="text" id="nama_lengkap" name="nama_lengkap" value="<?php echo $nama_lengkap; ?>" required>

                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?php echo $email; ?>" required>

                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Kosongkan jika tidak ingin mengganti">

                <button type="submit">Simpan Perubahan</button>
            </form>
        </div>
    </div>
</body>
</html>
