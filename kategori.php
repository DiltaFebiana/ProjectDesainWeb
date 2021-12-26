<?php
include("head.php");
?>
<?php if (isset($_GET["id"])) : ?>
    <?php
    $query_post = mysqli_query($conn, "select * from post where id_kategori=" . $_GET["id"]);
    $query_kat = mysqli_query($conn, "select * from kategori where id_kategori=" . $_GET["id"]);
    $kat = mysqli_fetch_assoc($query_kat);
    $nama_kat = $kat["nama_kategori"];
    ?>
    <div class="container my-5">
        <h3 class="text-center my-4"><?php echo $nama_kat; ?></h3>
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
<?php endif; ?>
<?php
include("footer.php")
?>