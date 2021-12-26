<?php
include("db.php");
session_start();
$login = false;
if (isset($_SESSION["login"])) {
    $login = true;
    $query_user = "select * from user where id_user=" . $_SESSION["login"];
    $sql = mysqli_query($conn, $query_user);
    if (mysqli_num_rows($sql) > 0) {
        $row_user = mysqli_fetch_assoc($sql);
        $nama_user = $row_user['nama'];
    } else {
        header("Location: logout.php");
    }
}
$query_kat = mysqli_query($conn, "select * from kategori");
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Ijo</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse container" id="navbarTogglerDemo01">
                <a class="navbar-brand" href="index.php">Ijo</a>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Kategori
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php while ($kat = mysqli_fetch_assoc($query_kat)) : ?>
                                <li><a class="dropdown-item" href="kategori.php?id=<?php echo $kat["id_kategori"] ?>"><?php echo $kat["nama_kategori"] ?></a></li>
                            <?php endwhile; ?>
                        </ul>
                    </li>
                    <?php if ($login) : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="koleksi.php">Koleksi</a>
                        </li>
                    <?php endif; ?>
                </ul>
                <ul class="navbar-nav me-2 mb-2 mb-lg-0">
                    <?php if ($login) : ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <?php echo $nama_user; ?>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="dashboard.php">Dashboard</a></li>
                                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                            </ul>
                        </li>
                    <?php else : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">Login</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>