<?php
require("koneksi.php");

$kode_barang = $_POST['kode_barang'] ?? '';
$nama_barang = $_POST['nama_barang'] ?? '';
$harga = $_POST['harga'] ?? '';
$stok = $_POST['stok'] ?? '';

// Update data
$sql = "UPDATE barang 
        SET nama_barang='$nama_barang', harga='$harga', stok='$stok' 
        WHERE kode_barang='$kode_barang'";

$hasil = mysqli_query($conn, $sql);

// Ambil ulang data (untuk tampilkan kembali setelah update)
$sql_foto = "SELECT * FROM barang WHERE kode_barang='$kode_barang'";
$data = mysqli_query($conn, $sql_foto);
$row = mysqli_fetch_assoc($data);
$foto = htmlspecialchars($row['foto'] ?? '');
$foto_path = "uploads/" . $foto;
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Hasil Edit Data Barang</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container mt-5">
    <div class="card shadow">
      <div class="card-header bg-success text-white text-center">
        <h4 class="mb-0">Hasil Edit Data Barang</h4>
      </div>
      <div class="card-body">
        <?php if ($hasil): ?>
          <div class="alert alert-success text-center">
            <strong>Sukses!</strong> Data berhasil diupdate.
          </div>

          <div class="row">
            <div class="col-md-4 text-center">
              <?php if (!empty($foto) && file_exists($foto_path)): ?>
                <img src="<?= $foto_path ?>" class="img-thumbnail" width="250" height="250" alt="Foto Barang">
              <?php else: ?>
                <img src="https://via.placeholder.com/250x250?text=No+Image" class="img-thumbnail" alt="Foto Tidak Ada">
              <?php endif; ?>
            </div>

            <div class="col-md-8">
              <table class="table table-bordered">
                <tr><th>Kode Barang</th><td><?= htmlspecialchars($kode_barang) ?></td></tr>
                <tr><th>Nama Barang</th><td><?= htmlspecialchars($nama_barang) ?></td></tr>
                <tr><th>Harga</th><td><?= htmlspecialchars($harga) ?></td></tr>
                <tr><th>Stok</th><td><?= htmlspecialchars($stok) ?></td></tr>
              </table>
            </div>
          </div>

          <div class="text-end mt-4">
            <a href="ifram.html" class="btn btn-primary">Kembali ke Beranda</a>
          </div>

        <?php else: ?>
          <div class="alert alert-danger text-center">
            <strong>Gagal!</strong> Data tidak berhasil diupdate.<br>
            <span class="text-danger"><?= mysqli_error($conn) ?></span>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</body>
</html>