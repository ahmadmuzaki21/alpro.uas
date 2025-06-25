<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Hasil Pencarian Pelanggan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card shadow-lg">
          <div class="card-header bg-success text-white text-center">
            <h4>Hasil Pencarian Pelanggan</h4>
          </div>
          <div class="card-body">
            <table class="table table-bordered">
              <?php
              require("koneksi.php");

              $nama = $_POST['nama'];
              $sql = "SELECT * FROM pelangan WHERE nama = '$nama'"; 
              $hasil = mysqli_query($conn, $sql);
              $row = mysqli_fetch_row($hasil);

              if ($row) {
                  do {
                      list($id_pelanggan, $nama, $alamat, $no_hp, $foto) = $row;

                      echo "<tr><th width='200'>ID</th><td>$id_pelanggan</td></tr>";
                      echo "<tr><th>Nama Pelanggan</th><td>$nama</td></tr>";
                      echo "<tr><th>Alamat</th><td>$alamat</td></tr>";
                      echo "<tr><th>No HP</th><td>$no_hp</td></tr>";
                      echo "<tr><th>Foto</th><td><img src='foto/$foto' width='150' class='img-thumbnail'></td></tr>";

                  } while ($row = mysqli_fetch_row($hasil));
              } else {
                  echo "<tr><td colspan='2' class='text-center text-danger'><strong>Maaf, Data yang Anda cari tidak ada.</strong></td></tr>";
              }
              ?>
            </table>
            <div class="text-center">
              <a href="ifram.html" class="btn btn-primary mt-3">Kembali</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

