<?php
$host = "localhost";
$username = "root";
$password = "";
$db = "telufinance";

$koneksi = mysqli_connect($host, $username, $password, $db);

if (!$koneksi) {
    die("Tidak bisa terkoneksi ke database:" . mysqli_connect_error());
}