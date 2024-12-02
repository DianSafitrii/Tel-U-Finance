<?php
session_start();


define('ADMIN', "http://localhost/WebPro/TeluFinance/")


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tel-U Finance</title>
    <!-- <link rel="stylesheet" href="header.css"> -->
    <link href="<?= ADMIN ?>/assets/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg" style="background-color: #F1F0E8; height:60px;">
        <div class="container">
            <img src=" ../images/Desain_tanpa_judul-removebg-preview.png"
                style="width: 40px; height: auto; margin-right: 10px;" alt="Logo Tel-U Finace">
            <a class="navbar-brand" style="color: #E34968; font-size:30px;" href="#">TEL-U FINANCE</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ms-auto font-size-20" style="font-size:20px;">
                    <a class="nav-link" href="#Landing Page (Beranda)" style="margin-right: 10px;">BERANDA</a>
                    <a class=" nav-link" href="#Landing Page (Panduan)">PANDUAN</a>
                    <a class="nav-link" href="#Landing Page (Tentang)">TENTANG KAMI</a>
                    <button type="button" onclick="window.location.href='<?= ADMIN ?>/login.php'" class="btn btn-danger"
                        style="margin-left: 10px;">LOGIN</button>
                </div>
            </div>
        </div>

    </nav>

</body>

</html>