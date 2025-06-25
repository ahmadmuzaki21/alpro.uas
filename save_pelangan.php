<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Informasi Data Pelanggan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
  <div class="container mt-5">
    <div class="card">
      <div class="card-header bg-primary text-white text-center">
        <h4>Informasi Data Pelanggan</h4>
      </div>
      <div class="card-body">
        <?php
        require("koneksi.php");

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          $id_pelanggan = $_POST['id_pelanggan'] ?? '';
          $nama = $_POST['nama'] ?? '';
          $alamat = $_POST['alamat'] ?? '';
          $no_hp = $_POST['no_hp'] ?? '';
          $foto_name = '';

          if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
            $foto_name = basename($_FILES['foto']['name']);
            move_uploaded_file($_FILES['foto']['tmp_name'], 'uploads/' . $foto_name);
          }
          
          if ($nama !== '') {
  $id_pelanggan = mysqli_real_escape_string($conn, $id_pelanggan);
  $nama = mysqli_real_escape_string($conn, $nama);
  $alamat = mysqli_real_escape_string($conn, $alamat);
  $no_hp = mysqli_real_escape_string($conn, $no_hp);
  $foto = mysqli_real_escape_string($conn, $foto_name);

  $sql = "INSERT INTO pelangan (id_pelanggan, nama, alamat, no_hp, foto)
        VALUES ('$id_pelanggan', '$nama', '$alamat', '$no_hp', '$foto')";

  $hasil = mysqli_query($conn, $sql);

            if ($hasil) {
                echo "<div class='alert alert-success'>Data berhasil disimpan.</div>";

                // Tampilkan data yang disimpan
                echo "<div class='mt-4'>";
                echo "<h5>Data Pelanggan yang Disimpan:</h5>";
                echo "<ul class='list-group'>";
                echo "<li class='list-group-item'><strong>ID:</strong> $id_pelanggan</li>";
                echo "<li class='list-group-item'><strong>Nama:</strong> $nama</li>";
                echo "<li class='list-group-item'><strong>Alamat:</strong> $alamat</li>";
                echo "<li class='list-group-item'><strong>No. HP:</strong> $no_hp</li>";
                if (!empty($foto)) {
                echo "<li class='list-group-item'><strong>Foto:</strong><br><img src='uploads/$foto' alt='Foto Pelangan' class='img-thumbnail' width='150'></li>";
                }
                echo "</ul>";
                echo "</div>";
            } else {
                echo "<div class='alert alert-danger'>Gagal menyimpan data: " . mysqli_error($conn) . "</div>";
            }
            }

          
        }
        ?>
      
      </div>
    </div>
    <a href="ifram.html" class="btn btn-primary mt-3">Kembali ke Beranda</a>
  </div>
</body>
</html>