<?php include "config.php"; ?>
<link rel="stylesheet" href="style.css">

<div class="container">
    <h2>Daftar Produk</h2>
    <a href="tambah.php" class="btn">Tambah Produk</a>

    <table>
        <tr>
            <th>Gambar</th>
            <th>Nama</th>
            <th>Harga</th>
            <th>Aksi</th>
        </tr>

        <?php
        $result = mysqli_query($conn, "SELECT * FROM produk ORDER BY id DESC");
        while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <tr>
            <td>
                <img src="uploads/<?= $row['gambar']; ?>" width="80">
            </td>
            <td><?= $row['nama']; ?></td>
            <td>Rp <?= number_format($row['harga']); ?></td>
            <td>
                <a href="edit.php?id=<?= $row['id']; ?>" class="btn">Edit</a>
                <a href="hapus.php?id=<?= $row['id']; ?>"
                   class="btn btn-danger"
                   onclick="return confirm('Yakin hapus?')">
                   Hapus
                </a>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>
