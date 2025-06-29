<?php
require("koneksi.php");

$pilihan = $_POST['pilihan'];
$data_cari = $_POST['data_cari'];

$sql = "SELECT * FROM pelangan WHERE $pilihan = '$data_cari'";
$hasil = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Proses Hapus Data Pelanggan</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-image: url('paper.gif');
      background-size: cover;
      background-attachment: fixed;
    }
    .photo {
      max-width: 300px;
      max-height: 300px;
      object-fit: cover;
    }
  </style>
</head>
<body>
  <div class="container mt-5">
    <div class="card shadow-lg rounded-4">
      <div class="card-header bg-primary text-white text-center rounded-top-4">
        <h2>PROSES HAPUS DATA PELANGGAN</h2>
      </div>
      <div class="card-body bg-light">
        <?php
        if ($hasil && mysqli_num_rows($hasil) > 0) {
          while ($row = mysqli_fetch_assoc($hasil)) {
            $id_pelanggan = htmlspecialchars($row['id_pelanggan']);
            $nama = htmlspecialchars($row['nama']);
            $alamat = htmlspecialchars($row['alamat']);
            $no_hp = htmlspecialchars($row['no_hp']);
            $foto = htmlspecialchars($row['foto']);
            $foto_path = "uploads/$foto";

            echo "<form action='hapus_pelangan.php' method='post'>";
            echo "<div class='row'>";
            echo "<div class='col-md-8'>";
            echo "<div class='mb-3'><label class='form-label'>ID Pelanggan</label><input type='text' class='form-control' value='$id_pelanggan' readonly></div>";
            echo "<div class='mb-3'><label class='form-label'>Nama</label><input type='text' class='form-control' value='$nama' readonly></div>";
            echo "<div class='mb-3'><label class='form-label'>Alamat</label><input type='text' class='form-control' value='$alamat' readonly></div>";
            echo "<div class='mb-3'><label class='form-label'>No HP</label><input type='text' class='form-control' value='$no_hp' readonly></div>";
            echo "<input type='hidden' name='id_pelanggan' value='$id_pelanggan'>";
            echo "</div>";
            echo "<div class='col-md-4 text-center'>";
            if (!empty($foto) && file_exists($foto_path)) {
              echo "<img src='$foto_path' class='img-thumbnail photo' alt='Foto Pelanggan'>";
            } else {
              echo "<img src='https://via.placeholder.com/300x300?text=No+Image' class='img-thumbnail photo' alt='Tidak Ada Foto'>";
            }
            echo "</div>";
            echo "</div>";
            echo "<hr>";
            echo "<div class='text-center'>";
            echo "<button type='submit' class='btn btn-danger w-100 mb-2'>Yakin Data Ini Akan Dihapus!</button>";
            echo "</div>";
            echo "</form>";
          }
        } else {
          echo "<div class='alert alert-danger text-center rounded-4'><strong>Maaf, data tidak ditemukan!</strong></div>";
        }
        ?>
        <div class="text-end mt-3">
          <a href="hapus_pelangan.html" class="btn btn-outline-primary">Kembali</a>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
