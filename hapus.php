<?php
include "config.php";

$id = $_GET['id'];

// 1️⃣ Ambil nama gambar dari database
$query = mysqli_query($conn, "SELECT gambar FROM produk WHERE id='$id'");
$data  = mysqli_fetch_assoc($query);

$gambar = $data['gambar'];

// 2️⃣ Hapus file gambar dari folder uploads
if ($gambar != "" && file_exists("uploads/".$gambar)) {
    unlink("uploads/".$gambar);
}

// 3️⃣ Hapus data dari database
mysqli_query($conn, "DELETE FROM produk WHERE id='$id'");

// 4️⃣ Kembali ke halaman utama
header("Location: index.php");
exit;
