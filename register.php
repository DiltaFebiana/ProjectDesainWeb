<?php
include("head.php");
$array_warning = [];
if (isset($_SESSION["login"])) {
    header("Location: dashboard.php");
}
if (isset($_POST) && !empty($_POST)) {
    if (!cek_ada($_POST["nama"])) {
        array_push($array_warning, ["nama" => "Nama tidak ada!"]);
    }
    if (!cek_ada($_POST["username"])) {
        array_push($array_warning, ["username" => "Username tidak ada!"]);
    }
    if (!cek_ada($_POST["password"])) {
        array_push($array_warning, ["password" => "Password tidak ada!"]);
    }
    if (count($array_warning) == 0) {
        $nama = mysqli_real_escape_string($conn, $_POST["nama"]);
        $username = mysqli_real_escape_string($conn, $_POST["username"]);
        $password = mysqli_real_escape_string($conn, $_POST["password"]);
        $query_register = "INSERT INTO `user`(`id_user`, `username`, `password`, `nama`) VALUES (NULL,'" . $username . "','" . md5($password) . "','" . $nama . "')";
        $sql = mysqli_query($conn, $query_register);
        if ($sql) {
            // $rows = mysqli_fetch_assoc($sql);
            $_SESSION["login"] = mysqli_insert_id($conn);
            header("Location: dashboard.php");
        } else {
            array_push($array_warning, ["fail" => "Pendaftaran gagal"]);
        }
    }
}
$warn = (count($array_warning) > 0) ? true : false;
?>
<div class="container my-5">
    <div class="row gy-3">
        <div class="col-sm-8 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="container-fluid py-5">
                        <h1 class="display-5 fw-bold">Selamat Datang di Ijo!</h1>
                        <p class="col-md-8 fs-4">Jika Anda belum memiliki akun maka lakukanlah Register terlebih dahulu!!</p>
                        <!-- <button class="btn btn-primary btn-lg" type="button">Example button</button> -->
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4 col-12">
            <div class="rounded-3">
                <div class="bg-light rounded-3 border clearfix p-3">
                    <h4>Register</h4>
                    <form action="" method="post" class="mt-3">
                        <div class="mb-3">
                            <label for="nama" class="mb-2">Nama</label>
                            <input type="text" name="nama" id="nama" class="form-control <?php echo (isset($warn["nama"])) ? 'is-invalid' : '' ?>">
                            <?php if (isset($warn["nama"])) : ?>
                                <div class="invalid-feedback">
                                    <?php echo ($warn["nama"]) ? 'Nama tidak ada!' : '' ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="mb-3">
                            <label for="username" class="mb-2">Username</label>
                            <input type="text" name="username" id="username" class="form-control <?php echo (isset($warn["username"])) ? 'is-invalid' : '' ?>">
                            <?php if (isset($warn["username"])) : ?>
                                <div class="invalid-feedback">
                                    <?php echo (isset($warn["username"])) ? 'Username atau password tidak ada!' : '' ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="mb-2">Password</label>
                            <input type="password" name="password" id="password" class="form-control <?php echo (isset($warn["password"])) ? 'is-invalid' : '' ?>">
                            <?php if (isset($warn["password"])) : ?>
                                <div class="invalid-feedback">
                                    <?php echo (isset($warn["password"])) ? 'Username atau password tidak ada' : '' ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="mb-3">
                            <div class="d-block">
                                <a href="login.php">Login</a>
                                <button type="submit" class="btn btn-primary float-end">Login</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include("footer.php")
?>