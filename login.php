<?php
include "Landing Page/mainheader.php";
?>
<div class="container mt-5 mb-3">
    <div class="row justify-content-center align-items-center">
        <div class="col-md-6 text-center text-md-start">
            <img src="../images/Desain_tanpa_judul-removebg-preview.png" alt="logo" style="width: 300px; height: auto;">
            <img src="../images/Desain_tanpa_judul__2_-removebg-preview.png" alt="text-logo"
                style="width: 350px; height: auto;">
        </div>
        <div class="col-md-6">
            <h4 class="text-center mb-5">LOGIN PENGGUNA</h4>

            <?php
if (isset($_GET['errorMsg'])) {
?> <div class="alert alert-danger" role="alert">
                <?= $_GET['errorMsg'] ?>
            </div>
            <?php
}
?>
            <form method="post" action="autentikasi.php">
                <div class="container-center d-flex align-items-center flex-column max-width: 700px; margin-top: 10px;">
                    <div class=" col-md-6 row">
                        <div class="mb-1">
                            <label for="username" class="col-form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" size="20"
                                placeholder="Username" required>
                        </div>
                        <div class="mb-1">
                            <label for="password" class="col-form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" size="20"
                                placeholder="Password" required>
                        </div>
                        <div class="mb-2 text-center justify-content-end">
                            <input type="submit" class="btn btn-danger" id="btnSubmit" name="btnSubmit" size="20"
                                value="Login">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
include "Landing Page/mainfooter.php";
?>