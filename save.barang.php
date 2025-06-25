<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Informasi Data Barang</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
  <div class="container mt-5">
    <div class="card">
      <div class="card-header bg-primary text-white text-center">
        <h4>Informasi Data Barang</h4>
      </div>
      <div class="card-body">
        <?php
        require("koneksi.php");

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          // Ambil data form
          $kode_barang = trim($_POST['kode_barang'] ?? '');
          $nama_barang = trim($_POST['nama_barang'] ?? '');
          $harga = trim($_POST['harga'] ?? '');
          $stok = trim($_POST['stok'] ?? '');
          $foto_name = '';

          // Validasi input wajib
          if ($kode_barang === '' || $nama_barang === '' || $harga === '' || $stok === '') {
            echo "<div class='alert alert-warning'>Semua field wajib diisi.</div>";
            exit;
          }

          // Upload file jika ada
          if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
            $foto_tmp = $_FILES['foto']['tmp_name'];
            $foto_name_original = basename($_FILES['foto']['name']);
            $foto_ext = strtolower(pathinfo($foto_name_original, PATHINFO_EXTENSION));
            $allowed_ext = ['jpg', 'jpeg', 'png', 'gif'];

            if (!in_array($foto_ext, $allowed_ext)) {
              echo "<div class='alert alert-danger'>Ekstensi file tidak diizinkan. Hanya JPG, JPEG, PNG, dan GIF.</div>";
              exit;
            }

            if ($_FILES['foto']['size'] > 2 * 1024 * 1024) {
              echo "<div class='alert alert-danger'>Ukuran file maksimal 2MB.</div>";
              exit;
            }

            // Pastikan folder uploads ada
            if (!is_dir('uploads')) {
              mkdir('uploads', 0755, true);
            }

            // Rename file agar unik
            $foto_name = uniqid('img_') . '.' . $foto_ext;
            move_uploaded_file($foto_tmp, "uploads/$foto_name");
          }

          // Escape input sebelum simpan
          $kode_barang = mysqli_real_escape_string($conn, $kode_barang);
          $nama_barang = mysqli_real_escape_string($conn, $nama_barang);
          $harga = mysqli_real_escape_string($conn, $harga);
          $stok = mysqli_real_escape_string($conn, $stok);
          $foto_name_db = mysqli_real_escape_string($conn, $foto_name);

          // Simpan ke database
          $sql = "INSERT INTO barang (kode_barang, nama_barang, harga, stok, foto)
                  VALUES ('$kode_barang', '$nama_barang', '$harga', '$stok', '$foto_name_db')";

          $hasil = mysqli_query($conn, $sql);

          if ($hasil) {
            echo "<div class='alert alert-success'>Data berhasil disimpan.</div>";
            echo "<ul class='list-group mt-3'>";
            echo "<li class='list-group-item'><strong>Kode barang:</strong> $kode_barang</li>";
            echo "<li class='list-group-item'><strong>Nama Barang:</strong> $nama_barang</li>";
            echo "<li class='list-group-item'><strong>Harga:</strong> $harga</li>";
            echo "<li class='list-group-item'><strong>Stok:</strong> $stok</li>";
            if (!empty($foto_name)) {
              echo "<li class='list-group-item'><strong>Foto:</strong><br><img src='uploads/$foto_name' class='img-thumbnail' width='150'></li>";
            }
            echo "</ul>";
          } else {
            echo "<div class='alert alert-danger'>Gagal menyimpan data: " . mysqli_error($conn) . "</div>";
          }

          mysqli_close($conn);
        }
        ?>
      </div>
    </div>
  </div>
</body>
</html>