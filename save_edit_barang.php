<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hasil Edit Data Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Hasil Edit Data Barang</h2>
    <hr>
    <?php
    require("koneksi.php");

    $kode_barang = $_POST['kode_barang']??'';
    $nama_barang = $_POST['nama_barang']??'';
    $harga = $_POST['harga']??'';
    $stok = $_POST['stok']??'';

    // Gunakan nama tabel yang benar: 'barang'
    $sql = "UPDATE barang 
            SET nama_barang='$nama_barang', harga='$harga', stok='$stok' 
            WHERE kode_barang='$kode_barang'";

    $hasil = mysqli_query($conn, $sql);

    if ($hasil) {
        echo "
        <div class='alert alert-success'>
            <strong>Sukses!</strong> Data berhasil diupdate.
        </div>
        <table class='table table-bordered mt-3'>
            <tr><th>Kode Barang</th><td>$kode_barang</td></tr>
            <tr><th>Nama Barang</th><td>$nama_barang</td></tr>
            <tr><th>Harga</th><td>$harga</td></tr>
            <tr><th>Stok</th><td>$stok</td></tr>
        </table>
        <a href='index.php' class='btn btn-primary'>Kembali ke Beranda</a>
        ";
    } else {
        echo "
        <div class='alert alert-danger'>
            <strong>Gagal!</strong> Data tidak berhasil diupdate.<br>
            Error: " . mysqli_error($conn) . "
        </div>
        ";
    }
    ?>
</div>
</body>
</html>