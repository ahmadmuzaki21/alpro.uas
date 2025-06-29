<?php
require("koneksi.php");

// Ambil data dari form
$nama_barang = isset($_POST['nama']) ? trim($_POST['nama']) : '';

// Amankan input
$nama_barang = mysqli_real_escape_string($conn, $nama_barang);

// Query ke database
$sql = "SELECT * FROM barang WHERE nama_barang = '$nama_barang'";
$hasil = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($hasil);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hasil Pencarian Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-success text-white text-center">
            <h3>Hasil Pencarian Barang</h3>
        </div>
        <div class="card-body">
            <?php if ($row) { 
                $foto = htmlspecialchars($row['foto']);
                $foto_path = "uploads/" . $foto;
            ?>
            <table class="table table-bordered">
                <tr><th>Kode Barang</th><td><?= htmlspecialchars($row['kode_barang']) ?></td></tr>
                <tr><th>Nama Barang</th><td><?= htmlspecialchars($row['nama_barang']) ?></td></tr>
                <tr><th>Harga</th><td><?= htmlspecialchars($row['harga']) ?></td></tr>
                <tr><th>Stok</th><td><?= htmlspecialchars($row['stok']) ?></td></tr>
                <tr><th>Foto</th>
                    <td>
                        <?php if (!empty($foto) && file_exists("uploads/$foto")) { ?>
                            <img src="<?= $foto_path ?>" width="100" height="100" alt="Foto Barang">
                        <?php } else { ?>
                            <img src="https://via.placeholder.com/100x100?text=No+Image" width="100" height="100" alt="Tidak Ada Foto">
                        <?php } ?>
                    </td>
                </tr>
            </table>
            <?php } else { ?>
                <div class="alert alert-danger text-center">
                    Data untuk nama <b><?= htmlspecialchars($nama_barang) ?></b> tidak ditemukan.
                </div>
            <?php } ?>
            <div class="text-end mt-4">
                <a href="ifram.html" class="btn btn-primary">Kembali</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>
