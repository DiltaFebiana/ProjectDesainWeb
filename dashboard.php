<?php
include("head.php");
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
}
$query_post = mysqli_query($conn, "select * from post where id_user=" . $_SESSION["login"]);
?>
<div class="container my-5">
    <div class="clearfix">
        <h2 class="float-start">Postingan</h2>
        <a href="tambah_post.php" class="btn btn-success float-end">Tambah</a>
    </div>
</div>
<div class="container mb-5">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 gy-3">
        <?php while ($post = mysqli_fetch_assoc($query_post)) : ?>
            <div class="col">
                <div class="card">
                    <img src="<?php echo $post['thumbnail']; ?>" alt="" class="card-img-top h-50">
                    <div class="card-body">
                        <a href="post.php?id=<?php echo $post['id_post']; ?>">
                            <h5 class="card-title"><?php echo $post['judul']; ?></h5>
                        </a>
                        <div class="w-75 text-truncate">
                        <?php custom_echo($post['isi'], 200); ?>

                        </div>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<?php
include("footer.php")
?>