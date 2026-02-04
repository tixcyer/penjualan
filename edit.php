<?php
include "config.php";
$id = intval($_GET['id']);

$produk = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT * FROM produk WHERE id=$id")
);
?>
<link rel="stylesheet" href="style_tambah_edit.css">

<div class="container">
    <h2>Edit Produk</h2>

    <form method="POST" enctype="multipart/form-data">
        Nama
        <input type="text" name="nama" value="<?= $produk['nama']; ?>" required>

        Harga
        <input type="number" name="harga" value="<?= $produk['harga']; ?>" required>

        Deskripsi
        <textarea name="deskripsi"><?= $produk['deskripsi']; ?></textarea>

        Gambar Lama<br>
        <img src="uploads/<?= $produk['gambar']; ?>" width="100"><br><br>

        Gambar Baru (opsional)
        <input type="file" name="gambar">

        <button type="submit" name="update">Update</button>
    </form>

    <a href="index.php">← Kembali</a>
</div>

<?php
if (isset($_POST['update'])) {
    $nama  = $_POST['nama'];
    $harga = $_POST['harga'];
    $desk  = $_POST['deskripsi'];

    if ($_FILES['gambar']['name'] != "") {
        $new = time() . "_" . $_FILES['gambar']['name'];
        $tmp = $_FILES['gambar']['tmp_name'];

        move_uploaded_file($tmp, "uploads/" . $new);

        if (file_exists("uploads/" . $produk['gambar'])) {
            unlink("uploads/" . $produk['gambar']);
        }
    } else {
        $new = $produk['gambar'];
    }

    mysqli_query($conn, "
        UPDATE produk SET
        nama='$nama',
        harga='$harga',
        deskripsi='$desk',
        gambar='$new'
        WHERE id=$id
    ");

    echo "<script>alert('Produk diupdate'); location='index.php';</script>";
}
?>
