<?php
require("koneksi.php");

$kode_barang = $_POST['kode_barang'] ?? '';

if (!empty($kode_barang)) {
    // Ambil nama file foto dari database
    $sql_foto = "SELECT foto FROM barang WHERE kode_barang = '$kode_barang'";
    $result_foto = mysqli_query($conn, $sql_foto);
    $data_foto = mysqli_fetch_assoc($result_foto);
    $nama_foto = $data_foto['foto'] ?? '';

    // Hapus file foto jika ada
    if (!empty($nama_foto)) {
        $path_foto = "uploads/$nama_foto";
        if (file_exists($path_foto)) {
            unlink($path_foto); // hapus file dari folder
        }
    }

    // Hapus data dari tabel barang
    $sql = "DELETE FROM barang WHERE kode_barang = '$kode_barang'";
    $hasil = mysqli_query($conn, $sql);

    // Tampilkan hasil
    echo '<!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <title>Hapus Data Barang</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
            body {
                background-image: url("paper.gif");
                background-size: cover;
                background-attachment: fixed;
            }
        </style>
    </head>
    <body>
    <div class="container mt-5">
        <div class="card shadow-lg rounded-4">
            <div class="card-header bg-danger text-white text-center rounded-top-4">
                <h2>DELETE DATA BARANG</h2>
            </div>
            <div class="card-body bg-light text-center">';

    if ($hasil) {
        echo "<div class='alert alert-success rounded-4'><h4 class='mb-0'>✅ Data dengan KODE <b>$kode_barang</b> dan fotonya berhasil dihapus!</h4></div>";
    } else {
        echo "<div class='alert alert-danger rounded-4'><h4 class='mb-0'>❌ Gagal menghapus data!</h4><br><code>" . mysqli_error($conn) . "</code></div>";
    }

    echo '<a href="ifram.html" class="btn btn-primary mt-3">Kembali ke Beranda</a>
            </div>
        </div>
    </div>
    </body>
    </html>';
}
?>