<?php
session_start();
?>

<?php
include "header.php";

$host = "localhost";
$username = "root";
$password = "";
$db = "telufinance";

$koneksi = mysqli_connect($host, $username, $password, $db);
if (!$koneksi) {
    die("Tidak bisa terkoneksi ke database:" . mysqli_connect_error());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda Admin</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.2/dist/tailwind.min.css" rel="stylesheet">
</head>
<style>
    body {
        background-image: url("https://images.unsplash.com/photo-1582738411706-bfc8e691d1c2?crop=entropy&cs=srgb&fm=jpg&ixid=M3w3MjAxN3wwfDF8c2VhcmNofDI0fHx3aGl0ZXxlbnwwfHx8fDE3MzEzNjA2MTh8MA&ixlib=rb-4.0.3&q=85&q=85&fmt=jpg&crop=entropy&cs=tinysrgb&w=450");
        background-size: cover; 
        background-position: center; 
        height: 100vh;
        margin: 0; 
    }
</style>

<div class="flex">
    <!-- Sidebar -->
    <aside class="w-1/5 bg-red-700 text-white h-screen p-4">
        <nav>
            <h1 class="text-xl font-bold mb-4">Beranda</h1>
            <h2 class="text-xl font-regular mb-4">Selamat Datang Admin!</h2>
            
            <ul>
                <li class="mb-2"><a href="datauser.php" class="hover:text-blue-300 font-bold">Data Mahasiswa</a></li>
                <li class="mb-2"><a href="index.php" class="hover:text-blue-300 font-bold">Data Pemasukan</a></li>
                <li class="mb-2"><a href="pengeluaran.php" class="hover:text-blue-300 font-bold">Data Pengeluaran</a></li>
            </ul>
        </nav>
    </aside>

    <!-- Main Content -->
<main class="w-4/5 p-8">
    <!-- REGISTRASI MAHASISWA -->
    <div class="grid grid-cols-2 gap-6 mb-6 h-[340px]">
        <div class="bg-white text-black rounded-lg shadow-lg flex flex-col items-center justify-center h-full">
            <a href="datauser.php" class="block w-full h-full">
                <div class="flex flex-col items-center justify-center">
                    <img src="https://i.pinimg.com/236x/15/fc/ec/15fcec615b6b95f0b83e270281db4859.jpg" alt="Registrasi Mahasiswa" class="w-32 h-32 object-cover mb-4">
                    <h2 class="text-2xl mb-4 text-center">Registrasi Mahasiswa</h2>
                </div>
            </a>
        </div>

        <!-- Top-Up Saldo -->
        <div class="bg-white text-black rounded-lg shadow-lg flex flex-col items-center justify-center h-full">
            <a href="index.php" class="block w-full h-full">
                <div class="flex flex-col items-center justify-center">
                    <img src="TOPUP.jpeg" alt="Top-Up Saldo" class="w-32 h-32 object-cover mb-4">
                    <h2 class="text-2xl mb-4 text-center">Top-Up Saldo</h2>
                </div>
            </a>
        </div>
    </div>

    <!-- DATA MAHASISWA-->
    <div class="grid grid-cols-2 gap-6 mb-6 h-[340px]">
        <div class="bg-white text-black rounded-lg shadow-lg flex flex-col items-center justify-center h-full">
            <a href="datauser.php" class="block w-full h-full">
                <div class="flex flex-col items-center justify-center">
                    <img src="MAHASISWA.jpeg" alt="Data Mahasiswa" class="w-32 h-32 object-cover mb-4">
                    <h2 class="text-2xl mb-4 text-center">Data Mahasiswa</h2>
                </div>
            </a>
        </div>

        <!-- DATA TRANSAKSI-->
        <div class="bg-white text-black rounded-lg shadow-lg flex flex-col items-center justify-center h-full">
            <a href="datauser.php" class="block w-full h-full">
                <div class="flex flex-col items-center justify-center">
                    <img src="TRANSAKSI.jpeg" alt="Data Transaksi" class="w-32 h-32 object-cover mb-4">
                    <h2 class="text-2xl mb-4 text-center">Data Transaksi</h2>
                </div>
            </a>
        </div>
    </div>
</main>

</div>

</body>
</html>
