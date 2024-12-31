<?php
session_start();
?>

<?php
include "header.php";
?>

<?php
$host = "localhost";
$username = "root";
$password = "";
$db = "telufinance";

$koneksi = mysqli_connect($host, $username, $password, $db);
if (!$koneksi) {
    die("Tidak bisa terkoneksi ke database:" . mysqli_connect_error());
}

// INISIALISASI VARIABEL SUPAYA TIDAK UNDEFINE DI BROWSER
$nim = "";
$nama = "";
$tanggal_pengeluaran = "";
$saldo_pengeluaran = "";
$bukti_transaksi = "";
$error = "";
$sukses = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}

if ($op == 'edit') {
    $id = $_GET['id'];
    $sql1 = "SELECT * FROM transaksi_mahasiswa where nim = '$nim'";
    $q1 = mysqli_query($koneksi, $sql1);
    $r1 = mysqli_fetch_array($q1);
    $nim = $r1['Nim'];
    $nama = $r1['Nama'];
    $tanggal_pengeluaran = $r1['Tanggal_Pengeluaran'];
    $saldo_pengeluaran = $r1['Saldo_Pengeluaran'];
    $bukti_transaksi = $r1['Bukti_Transaksi'];

    if ($nim == '') {
        $error = "Data tidak ditemukan";
    }
}

// PROSES CREATE & UPDATE DATA UNTUK MEMANGGIL DATA BARU DAN MENAMPILKAN DATA DI DALAM WEBSITE
if (isset($_POST['simpan'])) {
    $nim = $_POST['Nim'];
    $nama = $_POST['Nama'];
    $tanggal_pengeluaran = $_POST['Tanggal_Pengeluaran'];
    $saldo_pengeluaran = $_POST['Saldo_Pengeluaran'];
    $bukti_transaksi = $_POST['Bukti_Transaksi'];

    // Validasi: Cek jika ada field yang kosong
    if (empty($nim) || empty($nama) || empty($tanggal_pengeluaran) || empty($saldo_pengeluaran) || empty($bukti_transaksi)) {
        $error = "Semua field harus diisi!";
    } else {
        // Validasi: Cek apakah NIM sudah terdaftar di tabel mahasiswa
        $sqlCheckNim = "SELECT * FROM mahasiswa WHERE Nim='$nim'";
        $qCheckNim = mysqli_query($koneksi, $sqlCheckNim);

        if (mysqli_num_rows($qCheckNim) == 0) {
            $error = "NIM tidak ditemukan dalam database pengguna.";
        } else {
            // Jika edit
            if (isset($_GET['op']) && $_GET['op'] == 'edit') {
                $sql1 = "UPDATE transaksi_mahasiswa SET Nim='$nim', Nama='$nama', Tanggal_Pengeluaran='$tanggal_pengeluaran', Saldo_Pengeluaran='$saldo_pengeluaran', Bukti_Transaksi='$bukti_transaksi' WHERE id='$id'";
            } else {
                // Menghilangkan id di sini, karena auto-increment akan menambahkannya otomatis
                $sql1 = "INSERT INTO transaksi_mahasiswa(Nim, Nama, Tanggal_Pengeluaran, Saldo_Pengeluaran, Bukti_Transaksi) 
                VALUES ('$nim', '$nama', '$tanggal_pengeluaran', '$saldo_pengeluaran', '$bukti_transaksi')";
            }

            $q1 = mysqli_query($koneksi, $sql1);

            if ($q1) {
                $sukses = "Data Berhasil Disimpan";
            } else {
                $error = "Gagal Memasukkan atau Memperbarui Data";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tel-U Finance</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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

        <!-- untuk memasukkan data -->
        <div class="mx-auto">
            <div class="card">
                <div class="card-header" style="background-color: darkred; color: white;">
                    Data Pengeluaran Tel-U Finance
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

                    <form action="" method="POST">
                        <div class="mb-3 row">
                            <label for="nim" class="col-sm-2 col-form-label">Nim</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="Nim" name="Nim" value="<?php echo $nim ?>">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="Nama" name="Nama" value="<?php echo $nama ?>">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="tanggal_pengeluaran" class="col-sm-2 col-form-label">Tanggal Pengeluaran</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" id="Tanggal_Pengeluaran" name="Tanggal_Pengeluaran" value="<?php echo $tanggal_pengeluaran ?>">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="saldo_pengeluaran" class="col-sm-2 col-form-label">Saldo Pengeluaran</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="Saldo_Pengeluaran" name="Saldo_Pengeluaran" value="<?php echo $saldo_pengeluaran ?>">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="bukti_transaksi" class="col-sm-2 col-form-label">Bukti Transaksi</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" id="Bukti_Transaksi" name="Bukti_Transaksi" value="<?php echo $bukti_transaksi ?>">
                            </div>
                        </div>

                        <div class="col-12">
                            <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary">
                            <input type="reset" name="ulangi" class="btn btn-danger" value="Ulangi">
                        </div>
                    </form>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-between mt-3">
                <a href="berandaKasir.php" class="btn btn-primary">Kembali</a>
                <a href="datatransaksi2.php" class="btn btn-secondary"> Cek Data Transaksi </a>
            </div>
        </div>
    </div>
</body>

</html>

<?php
include "footer.php";
?>
