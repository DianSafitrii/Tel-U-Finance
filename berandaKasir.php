<?php
define('HOST', "http://localhost/TFTUBES");
$base_url = "https://" . $_SERVER['HTTP_HOST'] . "/TFTUBES";
session_start();

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
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda Kasir</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 20px;
            background-color: white;
            border-bottom: 1px solid #e0e0e0;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo img {
            width: 55px;
            height: auto;
        }

        .button {
            padding: 5px 10px;
            color: white;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }



        .logout {
            background-color: #800000;
        }

        .profile {
            display: flex;
            align-items: center;
            gap: 5px;
            font-weight: bold;
        }

        .profile img {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            object-fit: cover;
        }

        .right-section {
            display: flex;
            align-items: center;
            gap: 20px;
        }



        body {
            background-size: cover;
            background-position: center;
            height: 100vh;
            margin: 0;
        }
    </style>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.2/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>
    <!-- BAGIAN HEADER -->
    <header class="header">
        <div class="logo">
            <img src="logo.png" alt="Logo">
            <span class="app-name">Tel-U Finance</span>
        </div>
        <!-- <nav class="navigation">
            <a href="index.php">DATA PEMASUKAN</a>
            <a href="pengeluaran.php">DATA PENGELUARAN</a>
            <a href="datauser.php">DATA USER</a>
        </nav> -->

        <div class="right-section">
            <div class="profile">
                <img src="kasir.jpeg" alt="Profile">
                <span>Halo, Kasir!</span>
            </div>
            <a href="logout.php"><button class="button logout">LOGOUT</button></a>
        </div>
    </header>


    <!-- Wrapper untuk Pusatkan Main -->
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <!-- Main Content -->
        <main class="w-4/5 p-8 mt-6">
            <!-- REGISTRASI MAHASISWA -->
            <div class="grid grid-cols-2 gap-6 mb-6 h-[360px]">
                <!-- Pengeluaran Mahasiswa -->
                <div class="bg-[#8B0000] text-white rounded-lg shadow-lg flex items-center justify-center h-full">
                    <a href="datapengeluaran.php" class="block w-full h-full">
                        <div class="flex flex-col items-center justify-center h-full">
                            <img src="PENGELUARAN.png"
                                alt="Registrasi Mahasiswa"
                                class="w-40 h-40 object-cover mb-4">
                            <h2 class="text-2xl text-center">Pengeluaran Mahasiswa</h2>
                        </div>
                    </a>
                </div>

                <!-- Top-Up Saldo -->
                <div class="bg-[#D3D3D3] text-black rounded-lg shadow-lg flex items-center justify-center h-full">
                    <a href="datatopupsaldo.php" class="block w-full h-full">
                        <div class="flex flex-col items-center justify-center h-full">
                            <img src="TOPUP-baru.png"
                                alt="Top-Up Saldo"
                                class="w-36 h-36 object-cover mb-4">
                            <h2 class="text-2xl text-center">Pemasukan Mahasiswa</h2>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Data Transaksi -->
            <div class="grid grid-cols-1 gap-6 h-[360px]">
                <div class="bg-[#8B0000] text-white rounded-lg shadow-lg flex items-center justify-center h-full w-full">
                    <a href="datatransaksi2.php" class="block w-full h-full">
                        <div class="flex flex-col items-center justify-center h-full">
                            <img src="TRANSAKSI-baru.png" alt="Data Transaksi" class="w-36 h-36 object-cover mb-4">
                            <h2 class="text-2xl text-center">Data Transaksi</h2>
                        </div>
                    </a>
                </div>
            </div>
        </main>
    </div>



    </div>

</body>

</html>