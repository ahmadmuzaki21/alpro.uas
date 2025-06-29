<?php
require("koneksi.php");

$pilihan = isset($_POST['pilihan']) ? mysqli_real_escape_string($conn, $_POST['pilihan']) : '';
$cari_data = isset($_POST['cari_data']) ? mysqli_real_escape_string($conn, $_POST['cari_data']) : '';

$allowed_columns = ['kode_barang', 'nama_barang', 'harga', 'stok', 'foto'];
if (!in_array($pilihan, $allowed_columns)) {
    die("<div class='alert alert-danger text-center'>Kolom pencarian tidak valid.</div>");
}

$sql = "SELECT * FROM barang WHERE $pilihan = '$cari_data'";
$hasil = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Proses Hapus Data Barang</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-image: url('paper.gif');
      background-size: cover;
      background-attachment: fixed;
    }
    .photo {
      width: 100%;
      height: auto;
      max-height: 300px;
      object-fit: cover;
    }
  </style>
</head>
<body>
  <div class="container mt-5">
    <div class="card shadow-lg rounded-4">
      <div class="card-header bg-primary text-white text-center rounded-top-4">
        <h2 class="mb-0">PROSES HAPUS DATA BARANG</h2>
      </div>
      <div class="card-body bg-light">
        <?php
        if ($hasil && mysqli_num_rows($hasil) > 0) {
          while ($row = mysqli_fetch_assoc($hasil)) {
            $kode_barang = htmlspecialchars($row['kode_barang']);
            $nama_barang = htmlspecialchars($row['nama_barang']);
            $harga = htmlspecialchars($row['harga']);
            $stok = htmlspecialchars($row['stok']);
            $foto = htmlspecialchars($row['foto']);
            $foto_path = "uploads/" . $foto;
        ?>
        <form action="hapus_barang.php" method="post">
          <div class="row">
            <div class="col-md-8">
              <div class="mb-3">
                <label class="form-label">Kode Barang</label>
                <input type="text" class="form-control" value="<?= $kode_barang ?>" readonly>
              </div>
              <div class="mb-3">
                <label class="form-label">Nama Barang</label>
                <input type="text" class="form-control" value="<?= $nama_barang ?>" readonly>
              </div>
              <div class="mb-3">
                <label class="form-label">Harga</label>
                <input type="text" class="form-control" value="<?= $harga ?>" readonly>
              </div>
              <div class="mb-3">
                <label class="form-label">Stok</label>
                <input type="text" class="form-control" value="<?= $stok ?>" readonly>
              </div>
              <input type="hidden" name="kode_barang" value="<?= $kode_barang ?>">
            </div>
            <div class="col-md-4 text-center">
              <?php if (!empty($foto) && file_exists($foto_path)) { ?>
                <img src="<?= $foto_path ?>" class="img-thumbnail photo" alt="Foto Barang">
              <?php } else { ?>
                <img src="https://via.placeholder.com/300x300?text=No+Image" class="img-thumbnail photo" alt="Tidak Ada Foto">
              <?php } ?>
            </div>
          </div>
          <hr>
          <div>
            <button type="submit" class="form-control btn btn-danger">Yakin Data Ini Akan Dihapus!</button>
          </div>
        </form>
        <?php
          }
        } else {
          echo "<div class='alert alert-danger text-center rounded-4'><strong>Maaf, data tidak ditemukan!</strong></div>";
        }
        ?>
        <div class="text-end mt-4">
          <a href="hapus_barang.html" class="btn btn-outline-primary btn-sm">Kembali</a>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
