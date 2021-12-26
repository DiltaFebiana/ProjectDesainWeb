<?php
require("db.php");
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
}
if (isset($_GET["id"])) {
    $id_post = $_GET["id"];
    $id_user = $_SESSION["login"];
    $query_kols = mysqli_query($conn, "INSERT INTO `koleksi` (`id_koleksi`, `id_user`, `id_post`) VALUES (NULL, '" . $id_user . "', '" . $id_post . "')");
    if ($query_kols) {
        header("Location: koleksi.php");
    }
} else {
    header("Location: koleksi.php");
}
