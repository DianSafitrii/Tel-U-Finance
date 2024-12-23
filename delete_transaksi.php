<?php
// Koneksi ke database
include "header.php";
$host = "localhost";
$username = "root";
$password = "";
$db = "telufinance";

// Memulai sesi
session_start();

$koneksi = mysqli_connect($host, $username, $password, $db);
if (!$koneksi) {
    die("Tidak bisa terkoneksi ke database:" . mysqli_connect_error());
}

if (isset($_GET['delete'])) {
    $nim = $_GET['delete'];

    // Query untuk menghapus data berdasarkan NIM
    $sql_delete = "DELETE FROM transaksi_mahasiswa WHERE Nim = '$nim'";
    $q_delete = mysqli_query($koneksi, $sql_delete);

    // Jika berhasil menghapus data
    if ($q_delete) {
        // Menyimpan pesan ke sesi untuk ditampilkan di halaman
        $_SESSION['message'] = "Data berhasil dihapus";

        // Redirect ke halaman index.php (tapi tetap membawa pesan dalam sesi)
        header("Location: index.php");
        exit();
    } else {
        // Jika gagal menghapus data, tampilkan pesan error
        $_SESSION['message'] = "Gagal menghapus data: " . mysqli_error($koneksi);
        header("Location: index.php");
        exit();
    }
} else {
    $_SESSION['message'] = "NIM tidak ditemukan.";
    header("Location: index.php");
    exit();
}
?>
