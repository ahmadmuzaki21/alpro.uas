<?php
require("koneksi.php");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Data Barang</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card shadow">
          <div class="card-header bg-warning text-dark text-center">
            <h4 class="mb-0">Edit Data Barang</h4>
          </div>
          <div class="card-body">
            <form action="save_edit_barang.php" method="post">
              <?php
              if (isset($_POST['nama'])) {
                $nama = mysqli_real_escape_string($conn, $_POST['nama']);
                $sql = "SELECT * FROM barang WHERE nama_barang = '$nama'";
                $hasil = mysqli_query($conn, $sql);

                if ($hasil && mysqli_num_rows($hasil) > 0) {
                  $row = mysqli_fetch_assoc($hasil);
                  $foto = htmlspecialchars($row['foto']);
                  $foto_path = "uploads/" . $foto;
              ?>

              <div class="text-center mb-4">
                <?php if (!empty($foto) && file_exists($foto_path)) { ?>
                  <img src="<?= $foto_path ?>" class="img-thumbnail" width="300" height="300" alt="Foto Barang">
                <?php } else { ?>
                  <img src="https://via.placeholder.com/300x300?text=No+Image" class="img-thumbnail" width="300" height="300" alt="Foto Tidak Ada">
                  <div class="text-danger mt-2">Foto tidak ditemukan</div>
                <?php } ?>
              </div>

              <div class="mb-3">
                <label for="kode_barang" class="form-label">Kode Barang</label>
                <input type="text" class="form-control" id="kode_barang" name="kode_barang" value="<?= htmlspecialchars($row['kode_barang']) ?>" readonly>
              </div>

              <div class="mb-3">
                <label for="nama_barang" class="form-label">Nama Barang</label>
                <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="<?= htmlspecialchars($row['nama_barang']) ?>" required>
              </div>

              <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="number" class="form-control" id="harga" name="harga" value="<?= htmlspecialchars($row['harga']) ?>" min="0" required>
              </div>

              <div class="mb-3">
                <label for="stok" class="form-label">Stok</label>
                <input type="number" class="form-control" id="stok" name="stok" value="<?= htmlspecialchars($row['stok']) ?>" min="0" required>
              </div>

              <div class="d-flex justify-content-between mt-4">
                <div>
                  <button type="submit" class="btn btn-success me-2">Simpan Perubahan</button>
                  <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
                <a href="edit_barang.html" class="btn btn-outline-primary">Kembali</a>
              </div>

              <?php
                } else {
                  echo "<div class='alert alert-danger text-center'>Maaf, data untuk nama <b>" . htmlspecialchars($nama) . "</b> tidak ditemukan.</div>";
                }
              } else {
                echo "<div class='alert alert-warning text-center'>Parameter <b>'nama'</b> tidak diterima.</div>";
              }
              ?>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>