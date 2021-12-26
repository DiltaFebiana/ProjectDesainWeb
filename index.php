<?php
include("head.php");
// $posts = mysqli_fetch_assoc(mysqli_query($conn, "select * from post"));
$query_post = mysqli_query($conn, "select * from post");
?>
<div class="container my-5">
    <div class="p-5 mb-3 bg-light rounded-3">
        <div class="container-fluid py-5">
            <h1 class="display-5 fw-bold">Selamat Datang di IJO INFORMATION!</h1>
            <p class="col-md-8 fs-4">Ijo Information merupakan kumpulan sebuah informasi mengenai ilmu di bidang pertanian, dimana Indonesia merupakan negara agraris yang memiliki iklim tropis dengan curah hujan tinggi, serta lahan pertanian yang subur. Begitu juga banyak masyarakat yang bertani di sawah, sekitar perumahannya, sampai budidaya macam-macam jenis tanaman. Disinilah IJO INFORMATION menyediakan berbagai informasi mengenai pertanian.</p>
            <!-- <button class="btn btn-primary btn-lg" type="button">Example button</button> -->
        </div>
    </div>
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