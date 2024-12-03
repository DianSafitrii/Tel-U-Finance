<?php
define('HOST', "http://localhost/TFTUBES")
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            background-image: url(https://images.unsplash.com/photo-1582738411706-bfc8e691d1c2?crop=entropy&cs=srgb&fm=jpg&ixid=M3w3MjAxN3wwfDF8c2VhcmNofDI0fHx3aGl0ZXxlbnwwfHx8fDE3MzEzNjA2MTh8MA&ixlib=rb-4.0.3&q=85&q=85&fmt=jpg&crop=entropy&cs=tinysrgb&w=450);
            background-size: cover;
            /* Membuat gambar menutupi seluruh layar */
            background-position: center;
            /* Mengatur posisi tengah gambar */
            background-repeat: no-repeat;
            /* Menghindari pengulangan gambar */


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
            width: 50px;
            height: auto;
        }

        .logout {
            padding: 5px 10px;
            background-color: #800000;
            color: white;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
    <title>Tel-U Finance</title>
</head>

<body>
    <!-- BAGIAN HEADER -->
    <header class="header">
        <div class="logo">
            <img src="logo_telu_finance-removebg-preview.png" alt="Logo">
            <span class="app-name">Tel-U Finance</span>
        </div>
        <nav class="navigation">
            <a href="#beranda" class="active">BERANDA</a>
            <a href="#notifikasi">DATA ADMIN</a>

        </nav>
        <div class="right-section">
            <button class="logout">LOGOUT</button>
        </div>
    </header>