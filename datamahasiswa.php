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

// Inisialisasi variabel
$nim = "";
$nama = "";
$fakultas = "";
$prodi = "";
$angkatan = "";
$error = "";
$sukses = "";

// Proses penyimpanan data jika form disubmit
if (isset($_POST['simpan'])) {
    $nim = $_POST['Nim'];
    $nama = $_POST['Nama'];
    $fakultas = $_POST['Fakultas'];
    $prodi = $_POST['Prodi'];
    $angkatan = $_POST['Angkatan'];

    // Cek jika semua data diisi
    if ($nim && $nama && $fakultas && $prodi && $angkatan) {
        $sql1 = "INSERT INTO mahasiswa (Nim, Nama, Fakultas, Prodi, Angkatan) 
                 VALUES ('$nim', '$nama', '$fakultas', '$prodi', '$angkatan')";
        $q1 = mysqli_query($koneksi, $sql1);

        if ($q1) {
            $sukses = "Data Baru Berhasil Ditambahkan";
        } else {
            $error = "Gagal Memasukkan Data Baru: " . mysqli_error($koneksi);
        }
    } else {
        $error = "Silahkan Memasukkan Semua Data";
    }
}

// Proses update data jika ada parameter edit
if (isset($_GET['edit'])) {
    $nim = $_GET['edit'];
    $sql = "SELECT * FROM mahasiswa WHERE Nim = '$nim'";
    $result = mysqli_query($koneksi, $sql);
    $row = mysqli_fetch_array($result);

    $nim = $row['Nim'];
    $nama = $row['Nama'];
    $fakultas = $row['Fakultas'];
    $prodi = $row['Prodi'];
    $angkatan = $row['Angkatan'];
}

// Proses update data jika form disubmit
if (isset($_POST['update'])) {
    $nim = $_POST['Nim'];
    $nama = $_POST['Nama'];
    $fakultas = $_POST['Fakultas'];
    $prodi = $_POST['Prodi'];
    $angkatan = $_POST['Angkatan'];

    // Query untuk update data
    $sql_update = "UPDATE mahasiswa SET Nama = '$nama', Fakultas = '$fakultas', Prodi = '$prodi', Angkatan = '$angkatan' WHERE Nim = '$nim'";
    $q_update = mysqli_query($koneksi, $sql_update);

    if ($q_update) {
        $sukses = "Data berhasil diperbarui.";
    } else {
        $error = "Gagal memperbarui data: " . mysqli_error($koneksi);
    }
}

// Proses delete data jika ada parameter delete
if (isset($_GET['delete'])) {
    $nim = $_GET['delete'];
    $sql_delete = "DELETE FROM mahasiswa WHERE Nim = '$nim'";
    $q_delete = mysqli_query($koneksi, $sql_delete);

    if ($q_delete) {
        $sukses = "Data berhasil dihapus.";
    } else {
        $error = "Gagal menghapus data: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        .mx-auto {
            width: 900px
        }

        .card {
            margin-top: 10px;
        }
    </style>
</head>
<body>
<div class="container mt-5">
        <!-- Tampilkan pesan jika ada -->
        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-info">
                <?php
                // Menampilkan pesan dan kemudian menghapusnya dari sesi
                echo $_SESSION['message'];
                unset($_SESSION['message']);
                ?>
            </div>
        <?php endif; ?>

        <div class="mx-auto">
            <!-- Form untuk menambahkan atau mengedit data mahasiswa -->
            <div class="card">
                <div class="card-header" style="background-color: darkred; color: white;">
                    Data Mahasiswa
                </div>
                <div class="card-body">
                    <?php if ($error): ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $error; ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($sukses): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo $sukses; ?>
                        </div>
                    <?php endif; ?>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nim</th>
                                <th scope="col">Nama Mahasiswa</th>
                                <th scope="col">Fakultas</th>
                                <th scope="col">Prodi</th>
                                <th scope="col">Angkatan</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Query untuk mengambil data mahasiswa
                            $sql2 = "SELECT * FROM mahasiswa ORDER BY Nim DESC";
                            $q2 = mysqli_query($koneksi, $sql2);
                            $urut = 1;

                            if (!$q2) {
                                echo "Error: " . mysqli_error($koneksi);
                            } else {
                                while ($r2 = mysqli_fetch_array($q2)) {
                                    $nim = $r2['Nim'];
                                    $nama = $r2['Nama'];
                                    $fakultas = $r2['Fakultas'];
                                    $prodi = $r2['Prodi'];
                                    $angkatan = $r2['Angkatan'];
                            ?>
                                    <tr>
                                        <th scope="row"><?php echo $urut++ ?></th>
                                        <td><?php echo $nim ?></td>
                                        <td><?php echo $nama ?></td>
                                        <td><?php echo $fakultas ?></td>
                                        <td><?php echo $prodi ?></td>
                                        <td><?php echo $angkatan ?></td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a href="edit.php?edit=<?php echo $nim; ?>" class="btn btn-warning">Edit</a>
                                                <a href="delete.php?delete=<?php echo $nim; ?>" class="btn btn-danger">Delete</a>
                                            </div>
                                        </td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-between mt-3">
                <!-- Tombol Kembali di kiri -->
                <a href="berandaAdmin.php" class="btn btn-primary">Kembali</a>

                <!-- Tombol Cek Data Transaksi di kanan -->
                <a href="datauser.php" class="btn btn-outline-danger"> Tambah Mahasiswa </a>
            </div>

        <!-- JS Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>