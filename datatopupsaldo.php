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
$tanggal_pemasukan = "";
$saldo_pemasukan = "";
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
    $sql1 = "SELECT * FROM transaksi_mahasiswa where id = '$id'";
    $q1 = mysqli_query($koneksi, $sql1);
    $r1 = mysqli_fetch_array($q1);
    $nim = $r1['Nim'];
    $nama = $r1['Nama'];
    $tanggal_pemasukan = $r1['Tanggal_Pemasukan'];
    $saldo_pemasukan = $r1['Saldo_Pemasukan'];
    $bukti_transaksi = $r1['Bukti_Transaksi'];

    if ($nim == '') {
        $error = "Data tidak ditemukan";
    }
}


// PROSES CREATE & UPDATE DATA UNTUK MEMANGGIL DATA BARU DAN MENAMPILKAN DATA DI DALAM WEBSITE
if (isset($_POST['simpan'])) {
    $nim = $_POST['Nim'];
    $nama = $_POST['Nama'];
    $tanggal_pemasukan = $_POST['Tanggal_Pemasukan'];
    $saldo_pemasukan = $_POST['Saldo_Pemasukan'];
    $bukti_transaksi = $_POST['Bukti_Transaksi'];

    // Validasi: Cek jika ada field yang kosong
    if (empty($nim) || empty($nama) || empty($tanggal_pemasukan) || empty($saldo_pemasukan) || empty($bukti_transaksi)) {
        $error = "Semua field harus diisi!";
    } else {
        // Validasi: Cek apakah NIM sudah terdaftar di tabel mahasiswa
        $sqlCheckNim = "SELECT * FROM mahasiswa WHERE Nim='$nim'";
        $qCheckNim = mysqli_query($koneksi, $sqlCheckNim);

        if (mysqli_num_rows($qCheckNim) == 0) {
            $error = "NIM tidak ditemukan dalam database pengguna.";
        } else {

            if (isset($_GET['op']) && $_GET['op'] == 'edit') {
                $sql1 = "UPDATE transaksi_mahasiswa SET Nim='$nim', Nama='$nama', Tanggal_Pemasukan='$tanggal_pemasukan', Saldo_Pemasukan='$saldo_pemasukan', Bukti_Transaksi='$bukti_transaksi' WHERE id='$id'";
            } else {

                $sql1 = "INSERT INTO transaksi_mahasiswa(Nim, Nama, Tanggal_Pemasukan, Saldo_Pemasukan, Bukti_Transaksi) 
                VALUES ('$nim', '$nama', '$tanggal_pemasukan', '$saldo_pemasukan', '$bukti_transaksi')";
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

/*else {
        $error = "Silahkan Memasukkan Semua Data"; // APABILA DATA YANG DIMASUKKAN TIDAK ADA ISI MAKA AKAN MEMUNCULKAN PESAN ERROR MELALUI PANGGILAN VARIABEL ERROR */



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
                <div class="card-header" style="background-color: green; color: white;">
                    Data Pemasukan Tel-U Finance
                </div>
                <div class="card-body">
                    <?php                   // APABILA PROSES PENAMBAHAN DATA ERROR MAKA MEMANGGIL VARIABEL ERROR DI PHP
                    if ($error) {
                    ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $error; ?>
                        </div>
                    <?php
                    }
                    ?>

                    <?php                   // APABILA PROSES PENAMBAHAN DATA SUKSES MAKA MEMANGGIL VARIABEL SUKSES DI PHP
                    if ($sukses) {
                    ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo $sukses; ?>
                        </div>
                    <?php
                    }
                    ?>
                    <form action="" method="POST">
                        <div class="mb-3 row">
                            <label for="nim" class="col-sm-2 col-form-label">Nim</label> <!-- NIM -->
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="Nim" name="Nim" value="<?php echo $nim ?>">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="nama" class="col-sm-2 col-form-label">Nama</label> <!-- NAMA -->
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="Nama" name="Nama" value="<?php echo $nama ?>">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="tanggal_pemasukan" class="col-sm-2 col-form-label">Tanggal Pemasukan</label> <!-- Tanggal Pemasukan -->
                            <div class="col-sm-10">
                                <input type="date" class="form-control" id="Tanggal_Pemasukan" name="Tanggal_Pemasukan" value="<?php echo $tanggal_pemasukan ?>">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="saldo_pemasukan" class="col-sm-2 col-form-label">Saldo Pemasukan</label> <!-- SALDO PEMASUKAN -->
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="Saldo_Pemasukan" name="Saldo_Pemasukan" value="<?php echo $saldo_pemasukan ?>">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="bukti_transaksi" class="col-sm-2 col-form-label">Bukti Transaksi </label> <!-- BUKTI TRANSAKSI -->
                            <div class="col-sm-10">
                                <input type="file" class="form-control" id="Bukti_Transaksi" name="Bukti_Transaksi" value="<?php echo $bukti_transaksi ?>">
                            </div>
                        </div>

                        <div class="col-12"> <!-- TOMBOL SIMPAN DAN ULANGI -->
                            <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary">
                            <input type="reset" name="ulangi" class="btn btn-danger" value="Ulangi">
                        </div>
                    </form>
                </div>

            </div>
            <div class="card-footer d-flex justify-content-between mt-3">
                <!-- Tombol Kembali di kiri -->
                <a href="berandaKasir.php" class="btn btn-primary">Kembali</a>

                <!-- Tombol Cek Data Transaksi di kanan -->
                <a href="datatransaksi2.php" class="btn btn-secondary"> Cek Data Transaksi </a>
            </div>



            <!-- untuk mengeluarkan data
            <div class="card">
                <div class="card-header text-white bg-secondary">
                    Data Mahasiswa
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nim</th>
                                <th scope="col">Nama Mahasiswa</th>
                                <th scope="col">Tanggal Pemasukan</th>
                                <th scope="col">Saldo Pemasukan</th>
                                <th scope="col">Bukti Transaksi</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Query untuk mengambil data transaksi mahasiswa
                            $sql2 = "SELECT * FROM transaksi_mahasiswa ORDER BY nim DESC";
                            $q2 = mysqli_query($koneksi, $sql2);
                            $urut = 1;

                            if (!$q2) {
                                echo "Error: " . mysqli_error($koneksi);
                            } else {
                                // Loop untuk menampilkan data dari database
                                while ($r2 = mysqli_fetch_array($q2)) {
                                    $nim = $r2['Nim'] ?? '';
                                    $nama = $r2['Nama'] ?? '';
                                    $tanggal_pemasukan = $r2['Tanggal_Pemasukan'] ?? '';
                                    $saldo_pemasukan = $r2['Saldo_Pemasukan'] ?? '';
                                    $bukti_transaksi = $r2['Bukti_Transaksi'] ?? '';

                                    // Jika bukti transaksi ada dan berupa gambar, tampilkan gambar
                                    if ($bukti_transaksi) {
                                        $bukti_transaksi = "<img src='uploads/$bukti_transaksi' alt='Bukti Transaksi' width='100' />";
                                    }

                            ?>
                                    <tr>
                                        <th scope="row"><?php echo $urut++ ?></th>
                                        <td><?php echo $nim ?></td>
                                        <td><?php echo $nama ?></td>
                                        <td><?php echo $tanggal_pemasukan ?></td>
                                        <td><?php echo $saldo_pemasukan ?></td>
                                        <td><?php echo $bukti_transaksi ?></td>
                                        <td>
                                            <a href="edit_transaksi.php?edit=<?php echo $nim; ?>" class="btn btn-warning">Edit</a>
                                            <a href="delete_transaksi.php?delete=<?php echo $nim; ?>" class="btn btn-danger">Delete</a>
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

        </div> -->
</body>

</html>
<?php
include "footer.php";
?>