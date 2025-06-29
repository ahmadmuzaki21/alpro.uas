<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hasil Edit Data Pelanggan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .foto-preview {
            max-width: 300px;
            max-height: 300px;
            object-fit: cover;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Hasil Edit Data Pelanggan</h2>
    <hr>
    <?php
    require("koneksi.php");

    $id_pelanggan = $_POST['id_pelanggan'];
    $nama         = $_POST['nama'];
    $alamat       = $_POST['alamat'];
    $no_hp        = $_POST['no_hp'];

    // Update data pelanggan
    $sql = "UPDATE pelangan 
            SET nama='$nama', alamat='$alamat', no_hp='$no_hp' 
            WHERE id_pelanggan='$id_pelanggan'";
    $hasil = mysqli_query($conn, $sql);

    if ($hasil) {
        // Ambil ulang data untuk ditampilkan termasuk foto
        $q = mysqli_query($conn, "SELECT * FROM pelangan WHERE id_pelanggan='$id_pelanggan'");
        $data = mysqli_fetch_assoc($q);
        $foto = isset($data['foto']) ? htmlspecialchars($data['foto']) : '';
        $foto_path = "uploads/" . $foto;

        echo "<div class='alert alert-success'><strong>Sukses!</strong> Data berhasil diupdate.</div>";

        echo "<table class='table table-bordered mt-3'>";
        echo "<tr><th>ID Pelanggan</th><td>" . htmlspecialchars($id_pelanggan) . "</td></tr>";
        echo "<tr><th>Nama Pelanggan</th><td>" . htmlspecialchars($nama) . "</td></tr>";
        echo "<tr><th>Alamat</th><td>" . htmlspecialchars($alamat) . "</td></tr>";
        echo "<tr><th>No HP</th><td>" . htmlspecialchars($no_hp) . "</td></tr>";
        echo "<tr><th>Foto</th><td>";

        if (!empty($foto) && file_exists($foto_path)) {
            echo "<img src='$foto_path' class='img-thumbnail foto-preview' alt='Foto Pelanggan'>";
        } else {
            echo "<img src='https://via.placeholder.com/300x300?text=No+Image' class='img-thumbnail foto-preview' alt='Tidak Ada Foto'>";
        }

        echo "</td></tr>";
        echo "</table>";

        echo "<a href='ifram.html' class='btn btn-primary mt-3'>Kembali ke Beranda</a>";
    } else {
        echo "<div class='alert alert-danger'><strong>Gagal!</strong> Data tidak berhasil diupdate.<br>Error: " . mysqli_error($conn) . "</div>";
    }
    ?>
</div>
</body>
</html>
