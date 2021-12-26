<?php
include("head.php");
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
}
$warn = false;
if (isset($_POST) && !empty($_POST)) {
    // var_dump($_POST);
    // die();
    $array_warning = [];
    if (!cek_ada($_POST["judul"])) {
        array_push($array_warning, ["judul" => "Harap mengisi judul postingan!"]);
    }
    if (!cek_ada($_POST["kategori"])) {
        array_push($array_warning, ["kategori" => "Harap mengisi kategori postingan!"]);
    }
    if (!cek_ada($_POST["isi"])) {
        array_push($array_warning, ["isi" => "Harap mengisi isi postingan!"]);
    }
    if (isset($_POST["upload-thumb"]) && $_POST["upload-thumb"]) {
        $check = getimagesize($_FILES["upload-thumb"]["tmp_name"]);
        if ($check === false) {
            array_push($array_warning, ["prev-img" => "Hanya upload gambar saja!"]);
        }
    }
    if (count($array_warning) > 0) {
    } else {
        $judul = $_POST["judul"];
        $kategori = $_POST["kategori"];
        $isi = nl2br($_POST["isi"]);
        // echo $judul;
        // echo $kategori;
        // echo $isi;
        // var_dump($_POST);
        // echo $_FILES["upload-thumb"];
        // die();
        if (isset($_FILES["upload-thumb"]) && !empty($_FILES["upload-thumb"])) {
            $result = (new DateTime())->format('Y-m-d_H_i_s');
            $imageFileType = strtolower(pathinfo($_FILES["upload-thumb"]["name"], PATHINFO_EXTENSION));
            $target_dir = "img/";
            $target_file = $target_dir . $result . "." . $imageFileType;
            echo $target_file;
            move_uploaded_file($_FILES["upload-thumb"]["tmp_name"], $target_file);
        } else {
            $target_file = null;
        }
        // die();
        $query_addpost = mysqli_query($conn, "INSERT INTO `post`(`id_post`, `id_user`, `id_kategori`, `judul`, `thumbnail`, `isi`) VALUES (NULL,'" . $_SESSION["login"] . "','" . $kategori . "','" . $judul . "','" . $target_file . "','" . $isi . "')");
        if ($query_addpost) {
            header("Location: dashboard.php");
        }
    }
}
$query_kat = mysqli_query($conn, "select * from kategori");
// $query_post = mysqli_query($conn, "select * from post where id_user=" . $_SESSION["login"]);
?>
<div class="container my-5">
    <div class="clearfix">
        <h2 class="float-start">Tambah Postingan</h2>
    </div>
</div>
<div class="container mb-5">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="judul" class="mb-2 form-label">Judul</label>
            <input type="text" name="judul" id="judul" class="form-control">
        </div>
        <div class="mb-3">
            <label for="kategori" class="mb-2 form-label">Kategori</label>
            <select name="kategori" id="kategori" class="form-control">
                <option value="">Pilih salah satu kategori</option>
                <?php while ($kat = mysqli_fetch_assoc($query_kat)) : ?>
                    <option value="<?php echo $kat['id_kategori'] ?>"><?php echo $kat['nama_kategori'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="upload-thumb" class="mb-2 form-label">Upload Thumbnail</label>
            <input class="form-control" type="file" name="upload-thumb" id="upload-thumb" accept="image/*" class='mb-2'>
            <div class="mt-2">
                <img id="prev-img" class="mx-auto border rounded-3" style="max-width: 500px" />
            </div>
        </div>
        <div class="mb-3">
            <label for="isi" class="mb-2 form-label">Isi</label>
            <textarea name="isi" id="isi" rows="10" class="form-control"></textarea>
        </div>
        <div class="mb-3 clearfix">
            <button type="submit" class="btn btn-primary float-end">Upload</button>
        </div>
    </form>
</div>

<script>
    var imgUp = document.getElementById('upload-thumb')
    var prev_img = document.getElementById('prev-img')
    imgUp.onchange = function(evt) {
        const [file] = imgUp.files
        if (file) {
            prev_img.src = URL.createObjectURL(file)
        }
    }
</script>

<?php
include("footer.php")
?>