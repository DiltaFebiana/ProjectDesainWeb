<?php
require("db.php");
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
}
if (isset($_GET["id"])) {
    $id_post = $_GET["id"];
    $id_user = $_SESSION["login"];
    $query_kols = mysqli_query($conn, "DELETE FROM `koleksi` WHERE id_user=" . $id_user . " AND id_post='" . $id_post . "'");
    if ($query_kols) {
        header("Location: koleksi.php");
    } else {
        var_dump($query_kols);
    }
} else {
    header("Location: koleksi.php");
}
