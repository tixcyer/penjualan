<?php include "config.php"; ?>
<link rel="stylesheet" href="style_tambah_edit.css">

<div class="container">
    <h2>Tambah Produk</h2>

    <form method="POST" enctype="multipart/form-data">
        Nama Produk
        <input type="text" name="nama" required>

        Harga
        <input type="number" name="harga" required>

        Deskripsi
        <textarea name="deskripsi"></textarea>

        Upload Gambar
        <input type="file" name="gambar" required>

        <button type="submit" name="simpan">Simpan</button>
    </form>

    <a href="index.php">← Kembali</a>
</div>

<?php
if (isset($_POST['simpan'])) {
    $nama  = $_POST['nama'];
    $harga = $_POST['harga'];
    $desk  = $_POST['deskripsi'];

    $gambar = $_FILES['gambar']['name'];
    $tmp    = $_FILES['gambar']['tmp_name'];

    // nama aman
    $gambarBaru = time() . "_" . $gambar;

    move_uploaded_file($tmp, "uploads/" . $gambarBaru);

    mysqli_query($conn, "
        INSERT INTO produk (nama, harga, deskripsi, gambar)
        VALUES ('$nama','$harga','$desk','$gambarBaru')
    ");

    echo "<script>alert('Produk ditambahkan'); location='index.php';</script>";
}
?>
