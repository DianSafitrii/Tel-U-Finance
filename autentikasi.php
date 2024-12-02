<?php
include "dbconfig.php";

$username = $_POST['username'];
$password = $_POST['password'];

$sqlStatement = "SELECT * FROM user WHERE username='$username'";
$query = mysqli_query($koneksi, $sqlStatement);
$row = mysqli_fetch_assoc($query);
// print_r($row);

if ($row == "") { //username tidak ditemukan
    $errorMsg = "Username tidak terdaftar!";
    header("location:login.php?errorMsg=$errorMsg");
} else { //username ditemukan
    if (md5($password) == $row['password']) { //username dan password match
        session_start();
        $_SESSION['username'] = $row['username'];
        $_SESSION['role'] = $row['role'];
    } else {
        $errorMsg = "Password salah!";
        header("location:login.php?errorMsg=$errorMsg");
    }
}