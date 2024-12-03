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
    $sql1 = "SELECT * FROM transaksi_mahasiswa where id = '$id'";
    $q1 = mysqli_query($koneksi, $sql1);
    $r1 = mysqli_fetch_array($q1);
    $nim = $r1['Nim'];
    $nama = $r1['Nama'];
    $tanggal_pemasukan = $r1['Tanggal_Pemasukan'];
    $saldo_pemasukan = $r1['Saldo_Pemasukan'];
    $tanggal_pengeluaran = $r1['Tanggal_Pengeluaran'];
    $saldo_pengeluaran = $r1['Saldo_Pengeluaran'];
    $bukti_transaksi = $r1['Bukti_Transaksi'];

    if ($nim == '') {
        $error = "Data tidak ditemukan";
    }
}


// PROSES CREATE DATA UNTUK MEMANGGIL DATA BARU DAN MENAMPILKAN DATA DIDALAM WEBSITE
if (isset($_POST['simpan'])) {
    $nim = $_POST['Nim'];
    $nama = $_POST['Nama'];
    $tanggal_pemasukan = $_POST['Tanggal_Pemasukan'];
    $saldo_pemasukan = $_POST['Saldo_Pemasukan'];
    $tanggal_pengeluaran = $_POST['Tanggal_Pengeluaran'];
    $saldo_pengeluaran = $_POST['Saldo_Pengeluaran'];
    $bukti_transaksi = $_POST['Bukti_Transaksi'];

    // MASUKKAN DENGAN FUNGSI QUERY
    if ($nim && $nama && $tanggal_pemasukan && $saldo_pemasukan && $tanggal_pengeluaran && $saldo_pengeluaran && $bukti_transaksi) {
        $sql1 = "INSERT INTO transaksi_mahasiswa(Nim, Nama, Tanggal_Pemasukan, Saldo_Pemasukan, Tanggal_Pengeluaran, Saldo_Pengeluaran, Bukti_Transaksi) values 
        ('$nim', '$nama', '$tanggal_pemasukan', '$saldo_pemasukan', '$tanggal_pengeluaran', '$saldo_pengeluaran', '$bukti_transaksi')";

        $q1 = mysqli_query($koneksi, $sql1);

        // MEMBUAT KONDISIONAL JIKA DATA BERHASIL DIMASUKKAN ATAU TIDAK
        if ($q1) {
            $sukses =  "Data Baru Berhasil Ditambahkan";
        } else {
            $error = "Gagal Memasukkan Data Baru";
        }
    } /*else {
        $error = "Silahkan Memasukkan Semua Data"; // APABILA DATA YANG DIMASUKKAN TIDAK ADA ISI MAKA AKAN MEMUNCULKAN PESAN ERROR MELALUI PANGGILAN VARIABEL ERROR */
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
    <!-- untuk memasukkan data -->
    <div class="mx-auto">
        <div class="card">
            <div class="card-header">
                Data Admin Tel-U Finance
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
                            <input type="text" class="form-control" id="Nim" name="nim" value="<?php echo $nim ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama</label> <!-- NAMA -->
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="Nama" name="nama" value="<?php echo $nama ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="tanggal_pemasukan" class="col-sm-2 col-form-label">Tanggal Pemasukan</label> <!-- Tanggal Pemasukan -->
                        <div class="col-sm-10">
                            <input type="date" class="form-control" id="Tanggal_Pemasukan" name="tanggal_pemasukan" value="<?php echo $tanggal_pemasukan ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="saldo_pemasukan" class="col-sm-2 col-form-label">Saldo Pemasukan</label> <!-- SALDO PEMASUKAN -->
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="Saldo_Pemasukan" name="saldo_pemasukan" value="<?php echo $saldo_pemasukan ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="tanggal_pengeluaran" class="col-sm-2 col-form-label">Tanggal Pengeluaran</label> <!-- TANGGAL PENGELUARAN -->
                        <div class="col-sm-10">
                            <input type="date" class="form-control" id="Tanggal_Pengeluaran" name="tanggal_pengeluaran" value="<?php echo $tanggal_pengeluaran ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="saldo_pengeluaran" class="col-sm-2 col-form-label">Saldo Pengeluaran</label> <!-- SALDO PENGELUARAN -->
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="Saldo_Pengeluaran" name="saldo_pengeluaran" value="<?php echo $saldo_pengeluaran ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="bukti_transaksi" class="col-sm-2 col-form-label">Bukti Transaksi </label> <!-- BUKTI TRANSAKSI -->
                        <div class="col-sm-10">
                            <input type="file" class="form-control" id="Bukti_Transaksi" name="foto" value="<?php echo $bukti_transaksi ?>">
                        </div>
                    </div>

                    <div class="col-12"> <!-- TOMBOL SIMPAN DAN ULANGI -->
                        <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary">
                        <input type="reset" name="ulangi" class="btn btn-danger" value="Ulangi">
                    </div>
                </form>
            </div>
        </div>

        <!-- untuk mengeluarkan data -->
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
                            <th scope="col">Tanggal Pengeluaran</th>
                            <th scope="col">Saldo Pengeluaran</th>
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
                                $tanggal_pengeluaran = $r2['Tanggal_Pengeluaran'] ?? '';
                                $saldo_pengeluaran = $r2['Saldo_Pengeluaran'] ?? '';
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
                                    <td><?php echo $tanggal_pengeluaran ?></td>
                                    <td><?php echo $saldo_pengeluaran ?></td>
                                    <td><?php echo $bukti_transaksi ?></td>
                                    <td>
                                    <button type="button" class="btn btn-warning" >Update</button>
                                    <button type="button" class="btn btn-danger style=margin-top: 10px">Delete</button>
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
</body>

</html>
<?php
include "footer.php";
?>