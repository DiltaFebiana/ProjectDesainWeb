<?php
include("head.php");
?>
<?php if (isset($_GET['id'])) : ?>
    <?php
    $id_post = $_GET['id'];
    $query_post = mysqli_query($conn, "select * from post inner join user on user.id_user = post.id_user inner join kategori on kategori.id_kategori = post.id_kategori where id_post=" . $id_post);
    if (mysqli_num_rows($query_post) > 0) {
        $post = mysqli_fetch_assoc($query_post);
    } else {
        http_response_code(404);
        die();
    }
    if (isset($_SESSION["login"])) {
        $query_koleksied = mysqli_query($conn, "select * from koleksi where id_post=" . $id_post . " and id_user=" . $_SESSION["login"]);
        if (mysqli_num_rows($query_koleksied) > 0) {
            $koleksied = true;
        } else {
            $koleksied = false;
        }
    }
    ?>
    <div class="container my-5">
        <h2 class="text-center mb-3"><?php echo $post['judul'] ?></h2>
        <h6 class="text-center mb-3">Oleh <strong><?php echo $post['nama'] ?></strong></h6>
        <h6 class="text-center mb-3"><a href="#">#<?php echo $post['nama_kategori'] ?></a></strong></h6>
        <img class="w-100 mb-5" src="<?php echo $post['thumbnail'] ?>" alt="">
        <p><?php echo $post['isi'] ?></p>
        <?php if (isset($_SESSION["login"])) : ?>
        <div class="clearfix mb-3">
            <?php if ($koleksied) : ?>
                <a href="hapus_koleksi.php?id=<?php echo $post['id_post'] ?>" class="btn btn-danger float-end">Hapus Koleksi</a>
            <?php else : ?>
                <a href="tambah_koleksi.php?id=<?php echo $post['id_post'] ?>" class="btn btn-success float-end">Tambah ke Koleksi</a>
            <?php endif; ?>
        </div>
        <?php endif; ?>
    </div>
<?php else : ?>
    <?php
    $query_post = mysqli_query($conn, "select * from post");
    ?>
    <div class="container my-5">
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