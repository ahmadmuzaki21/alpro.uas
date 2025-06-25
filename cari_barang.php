<?php
require("koneksi.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $sql = "SELECT * FROM barang WHERE nama_barang LIKE '%$nama%'";
    $hasil = mysqli_query($conn, $sql);

    if (mysqli_num_rows($hasil) > 0) {
        echo "<table class='table table-bordered'>";
        while ($row = mysqli_fetch_assoc($hasil)) {
            echo "<tr><th>ID</th><td>" . $row['kode_barang'] . "</td></tr>";
            echo "<tr><th>Nama Barang</th><td>" . $row['nama_barang'] . "</td></tr>";
            echo "<tr><th>Harga</th><td>Rp " . number_format($row['harga'], 0, ',', '.') . "</td></tr>";
            echo "<tr><th>Stok</th><td>" . $row['stok'] . "</td></tr>";
            echo "<tr><th>Foto</th><td><img src='foto/" . $row['foto'] . "' width='150' class='img-thumbnail'></td></tr>";
            echo "<tr><td colspan='2'><hr></td></tr>";
        }
        echo "</table>";
    } else {
        echo "<p class='text-center text-danger'><strong>Maaf, Data yang Anda cari tidak ada.</strong></p>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Form Pencarian Barang</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card shadow-lg">
          <div class="card-header bg-success text-white text-center">
            <h4>Form Pencarian Barang</h4>
          </div>
          <div class="card-body">
            <form action="cari_barang.php" method="post">
              <div class="mb-3">
                <label for="nama" class="form-label">Nama Barang</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
              </div>
              <button type="submit" class="btn btn-primary">Cari</button>
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