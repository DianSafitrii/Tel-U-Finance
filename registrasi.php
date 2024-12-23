<?php
session_start();
?>

<?php
include 'header.php'; // Pastikan file header.php valid

// Koneksi ke database
$host = "localhost";
$username = "root";
$password = "";
$db = "telufinance";

$koneksi = mysqli_connect($host, $username, $password, $db);
if (!$koneksi) {
    die("Tidak bisa terkoneksi ke database: " . mysqli_connect_error());
}

// Proses jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Validasi sederhana
    if (!empty($username) && !empty($password)) {
        // Cek apakah username sudah digunakan
        $query_check = "SELECT id FROM users WHERE username = ?";
        $stmt_check = mysqli_prepare($koneksi, $query_check);
        mysqli_stmt_bind_param($stmt_check, "s", $username);
        mysqli_stmt_execute($stmt_check);
        mysqli_stmt_store_result($stmt_check);

        if (mysqli_stmt_num_rows($stmt_check) > 0) {
            $error_message = "Username sudah digunakan. Silakan pilih username lain.";
        } else {
            // Hash password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Simpan data ke database
            $query_insert = "INSERT INTO users (username, password) VALUES (?, ?)";
            $stmt_insert = mysqli_prepare($koneksi, $query_insert);
            mysqli_stmt_bind_param($stmt_insert, "ss", $username, $hashed_password);

            if (mysqli_stmt_execute($stmt_insert)) {
                // Redirect ke halaman login tanpa pesan sukses di URL
                header("Location: Login.php");
                exit(); // Pastikan untuk keluar setelah redirect
            } else {
                // Pesan error jika gagal menyimpan data
                $error_message = "Registrasi gagal. Silakan coba lagi.";
            }
            mysqli_stmt_close($stmt_insert);
        }
        mysqli_stmt_close($stmt_check);
    } else {
        $error_message = "Semua field wajib diisi.";
    }
}

// Tutup koneksi
mysqli_close($koneksi);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi - Tel-U Finance</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5 mb-5 d-flex justify-content-center align-items-center">
        <div class="col-md-6">
            <h4 class="text-center mb-3">Registrasi Pengguna</h4>

            <?php if (isset($error_message)): ?>
                <div class="alert alert-danger text-center" role="alert">
                    <?= htmlspecialchars($error_message); ?>
                </div>
            <?php endif; ?>

            <form method="post" action="">
                <div class="mb-3">
                    <label for="username" class="col-form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="col-form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                </div>
                <div class="text-center">
                    <input type="submit" class="btn btn-primary" value="Daftar"></a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
