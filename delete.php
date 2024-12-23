<?php
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

// Cek apakah ada parameter 'delete' di URL
if (isset($_GET['delete'])) {
    $nim = $_GET['delete'];

    // Query untuk menghapus data mahasiswa berdasarkan NIM
    $sql_delete = "DELETE FROM mahasiswa WHERE Nim = '$nim'";
    $q_delete = mysqli_query($koneksi, $sql_delete);

    if ($q_delete) {
        $_SESSION['message'] = "Data berhasil dihapus";
        
        header("Location: datauser.php");
        exit();
    } else {
        $_SESSION['message'] = "Gagal menghapus data: " . mysqli_error($koneksi);
        header("Location: datauser.php");
        exit();
    }
} else {
    $_SESSION['message'] = "NIM tidak ditemukan.";
    header("Location: datauser.php");
    exit();
}
?>
