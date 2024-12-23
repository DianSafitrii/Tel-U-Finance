<?php
// Konfigurasi database
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'telufinance';

// Koneksi ke database
$koneksi = new mysqli($host, $user, $password, $database);

// Periksa koneksi
if ($koneksi->connect_error) {
    die('Koneksi gagal: ' . $koneksi->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Validasi input
    if (empty($username) || empty($password)) {
        header("Location: registrasi.php?error=Harap isi semua kolom!");
        exit();
    }

    // Hash password
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Simpan ke database
    $stmt = $koneksi->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $hashedPassword);

    if ($stmt->execute()) {
        header("Location: registrasi.php?success=Registrasi berhasil!");
    } else {
        if ($koneksi->errno == 1062) {
            header("Location: registrasi.php?error=Username sudah digunakan!");
        } else {
            header("Location: registrasi.php?error=Terjadi kesalahan. Coba lagi!");
        }
    }

    $stmt->close();
}

$koneksi->close();
?>
