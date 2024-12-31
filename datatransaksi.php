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
    if (empty($nim) || empty($nama) || empty($tanggal_pemasukan) || empty($saldo_pemasukan) ||empty($bukti_transaksi)) {
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Transaksi</title>
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
        <?php endif; 
        ?>

        <div class="mx-auto">
            <!-- untuk mengeluarkan data pemasukan -->
            <div class="card">
            <div class="card-header" style="background-color: green; color: white;">
                    Data Pemasukan
                </div>
                <div class="card-body">
                    <table class="table table-striped">
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
                                            <a href="edit_transaksi.php?edit=<?php echo $nim; ?>" class="btn btn-warning btn-sm">Edit</a>
                                            <a href="delete_transaksi.php?delete=<?php echo $nim; ?>" class="btn btn-danger btn-sm">Delete</a>
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
        
        
        <!-- Untuk data pengeluaran -->
        <div class="card">
        <div class="card-header" style="background-color: darkred; color: white;">
                    Data Pengeluaran
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nim</th>
                                <th scope="col">Nama Mahasiswa</th>
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
                                        <td><?php echo $tanggal_pengeluaran ?></td>
                                        <td><?php echo $saldo_pengeluaran ?></td>
                                        <td><?php echo $bukti_transaksi ?></td>
                                        <td>
                                            <a href="edit_transaksi.php?edit=<?php echo $nim; ?>" class="btn btn-warning btn-sm">Edit</a>
                                            <a href="delete_transaksi.php?delete=<?php echo $nim; ?>" class="btn btn-danger btn-sm">Delete</a>
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
            <div class="card-footer d-flex justify-content-between mt-3">
                <!-- Tombol Kembali di kiri -->
                <a href="berandaAdmin.php" class="btn btn-primary">Kembali</a>
                </div>
        </div>
        
    </div>
    


    <!-- Link ke JavaScript Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq0Rkw3rE4vZ85shg0o3vFJbY9BQk0c6mY7fgBqEv6WylkZ2zD" crossorigin="anonymous"></script>
</body>
</html>


    
</body>
</html>