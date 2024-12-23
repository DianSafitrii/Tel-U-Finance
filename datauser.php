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
    <title>Tel-U Finance</title>
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
                <div class="card-header">
                    Data User Tel-U Finance
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
                            <label for="fakultas" class="col-sm-2 col-form-label">Fakultas</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="Fakultas" name="Fakultas">
                                    <option value="FAKULTAS TEKNIK ELEKTRO" <?php if ($fakultas == 'FAKULTAS TEKNIK ELEKTRO') echo 'selected'; ?>>FAKULTAS TEKNIK ELEKTRO</option>
                                    <option value="FAKULTAS INFORMATIKA" <?php if ($fakultas == 'FAKULTAS INFORMATIKA') echo 'selected'; ?>>FAKULTAS INFORMATIKA</option>
                                    <option value="FAKULTAS REKAYASA INDUSTRI" <?php if ($fakultas == 'FAKULTAS REKAYASA INDUSTRI') echo 'selected'; ?>>FAKULTAS REKAYASA INDUSTRI</option>
                                    <option value="FAKULTAS EKONOMI BISNIS" <?php if ($fakultas == 'FAKULTAS EKONOMI BISNIS') echo 'selected'; ?>>FAKULTAS EKONOMI BISNIS</option>
                                    <option value="FAKULTAS KOMUNIKASI DAN ILMU SOSIAL" <?php if ($fakultas == 'FAKULTAS KOMUNIKASI DAN ILMU SOSIAL') echo 'selected'; ?>>FAKULTAS KOMUNIKASI DAN ILMU SOSIAL</option>
                                    <option value="FAKULTAS INDUSTRI KREATIF" <?php if ($fakultas == 'FAKULTAS INDUSTRI KREATIF') echo 'selected'; ?>>FAKULTAS INDUSTRI KREATIF</option>
                                    <option value="FAKULTAS ILMU TERAPAN" <?php if ($fakultas == 'FAKULTAS ILMU TERAPAN') echo 'selected'; ?>>FAKULTAS ILMU TERAPAN</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="prodi" class="col-sm-2 col-form-label">Prodi</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="Prodi" name="Prodi" value="<?php echo $prodi ?>">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="angkatan" class="col-sm-2 col-form-label">Angkatan</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="Angkatan" name="Angkatan">
                                    <option value="2021" <?php if ($angkatan == '2021') echo 'selected'; ?>>2021</option>
                                    <option value="2022" <?php if ($angkatan == '2022') echo 'selected'; ?>>2022</option>
                                    <option value="2023" <?php if ($angkatan == '2023') echo 'selected'; ?>>2023</option>
                                    <option value="2024" <?php if ($angkatan == '2024') echo 'selected'; ?>>2024</option>
                                    <option value="2025" <?php if ($angkatan == '2025') echo 'selected'; ?>>2025</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12">
                            <?php if (isset($_GET['edit'])): ?>
                                <input type="submit" name="update" value="Update Data" class="btn btn-primary">
                            <?php else: ?>
                                <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary">
                            <?php endif; ?>
                            <input type="reset" name="ulangi" class="btn btn-danger" value="Ulangi">
                        </div>
                    </form>
                </div>
            </div>

            <!-- Menampilkan data mahasiswa -->
            <div class="card">
                <div class="card-header text-white bg-secondary">
                    Data Pengguna
                </div>
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
                                            <a href="edit.php?edit=<?php echo $nim; ?>" class="btn btn-warning">Edit</a>
                                            <a href="delete.php?delete=<?php echo $nim; ?>" class="btn btn-danger">Delete</a>
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

        <!-- JS Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>