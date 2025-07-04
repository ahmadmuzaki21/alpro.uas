<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Edit Data Pelanggan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    .foto-preview {
      max-width: 300px;
      max-height: 300px;
      object-fit: cover;
    }
  </style>
</head>
<body class="bg-light">
  <div class="container mt-5">
    <div class="card shadow-lg rounded-4">
      <div class="card-header bg-primary text-white text-center">
        <h4>Edit Data Pelanggan</h4>
      </div>
      <div class="card-body bg-white">
        <form action="save_edit_pelangan.php" method="post">
          <?php
          require("koneksi.php");

          if (isset($_POST['nama'])) {
              $nama = mysqli_real_escape_string($conn, $_POST['nama']);
              $sql = "SELECT * FROM pelangan WHERE nama='$nama'";
              $hasil = mysqli_query($conn, $sql);

              if ($hasil && mysqli_num_rows($hasil) > 0) {
                  $row = mysqli_fetch_assoc($hasil);

                  $id_pelanggan = htmlspecialchars($row['id_pelanggan']);
                  $nama = htmlspecialchars($row['nama']);
                  $alamat = htmlspecialchars($row['alamat']);
                  $no_hp = htmlspecialchars($row['no_hp']);
                  $foto = htmlspecialchars($row['foto']);
                  $foto_path = "uploads/" . $foto;

                  echo "<div class='text-center mb-3'>";
                  if (!empty($foto) && file_exists($foto_path)) {
                      echo "<img src='$foto_path' class='img-thumbnail foto-preview' alt='Foto Pelanggan'>";
                  } else {
                      echo "<img src='https://via.placeholder.com/300x300?text=No+Image' class='img-thumbnail foto-preview' alt='Tidak Ada Foto'>";
                  }
                  echo "</div>";

                  echo "<div class='mb-3'>";
                  echo "<label>ID Pelanggan</label>";
                  echo "<input type='text' class='form-control' name='id_pelanggan' value='$id_pelanggan' readonly>";
                  echo "</div>";

                  echo "<div class='mb-3'>";
                  echo "<label>Nama Pelanggan</label>";
                  echo "<input type='text' class='form-control' name='nama' value='$nama' required>";
                  echo "</div>";

                  echo "<div class='mb-3'>";
                  echo "<label>Alamat</label>";
                  echo "<input type='text' class='form-control' name='alamat' value='$alamat' required>";
                  echo "</div>";

                  echo "<div class='mb-3'>";
                  echo "<label>No HP</label>";
                  echo "<input type='text' class='form-control' name='no_hp' value='$no_hp' required>";
                  echo "</div>";
              } else {
                  echo "<div class='alert alert-warning text-center'>Data <b>$nama</b> tidak ditemukan.</div>";
              }
          } else {
              echo "<div class='alert alert-warning text-center'>Parameter 'nama' tidak diterima.</div>";
          }
          ?>
          <div class="d-flex justify-content-start gap-2">
            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
            <button type="reset" class="btn btn-secondary">Reset</button>
          </div>
        </form>

        <!-- Tombol kembali di pojok kanan bawah -->
        <div class="text-end mt-4">
          <a href="edit_pelangan.html" class="btn btn-outline-primary">Kembali</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>