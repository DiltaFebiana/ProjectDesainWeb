<?php
include("head.php");
$array_warning = [];
if (isset($_SESSION["login"])) {
    header("Location: dashboard.php");
}
if (isset($_POST) && !empty($_POST)) {
    if (cek_ada($_POST['username']) && cek_ada($_POST['password'])) {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $query_login = "select * from user where username='" . $username . "' and password='" . md5($password) . "'";
        $sql = mysqli_query($conn, $query_login);
        if (mysqli_num_rows($sql) > 0) {
            $rows = mysqli_fetch_assoc($sql);
            $_SESSION["login"] = $rows['id_user'];
            header("Location: dashboard.php");
        } else {
            array_push($array_warning, "Login Gagal");
        }
    } else {
        array_push($array_warning, "Username dan Password tidak ada!");
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
                        <p class="col-md-8 fs-4">Ijo Information merupakan kumpulan sebuah informasi mengenai ilmu di bidang pertanian. Jika ingin melihat info selengkapnya harap login terlebih dahulu!!</p>
                        <!-- <button class="btn btn-primary btn-lg" type="button">Example button</button> -->
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4 col-12">
            <div class="rounded-3">
                <div class="bg-light rounded-3 border clearfix p-3">
                    <h4>Login</h4>
                    <form action="" method="post" class="mt-3">
                        <div class="mb-3">
                            <label for="username" class="mb-2">Username</label>
                            <input type="text" name="username" id="username" class="form-control <?php echo ($warn) ? 'is-invalid' : '' ?>">
                            <?php if ($warn) : ?>
                                <div class="invalid-feedback">
                                    <?php echo ($warn) ? 'Username atau password tidak ada!' : '' ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="mb-2">Password</label>
                            <input type="password" name="password" id="password" class="form-control <?php echo ($warn) ? 'is-invalid' : '' ?>">
                            <?php if ($warn) : ?>
                                <div class="invalid-feedback">
                                    <?php echo ($warn) ? 'Username atau password tidak ada' : '' ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="mb-3">
                            <div class="d-block">
                                <a href="register.php">Register</a>
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