<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hasil Edit Data Pelanggan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Hasil Edit Data Pelanggan</h2>
    <hr>
    <?php
    require("koneksi.php");

    $id_pelanggan = $_POST['id_pelanggan'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $no_hp = $_POST['no_hp'];

    // Gunakan nama tabel yang benar: 'pelangan'
    $sql = "UPDATE pelangan 
            SET nama='$nama', alamat='$alamat', no_hp='$no_hp' 
            WHERE id_pelanggan='$id_pelanggan'";

    $hasil = mysqli_query($conn, $sql);

    if ($hasil) {
        echo "
        <div class='alert alert-success'>
            <strong>Sukses!</strong> Data berhasil diupdate.
        </div>
        <table class='table table-bordered mt-3'>
            <tr><th>ID Pelanggan</th><td>$id_pelanggan</td></tr>
            <tr><th>Nama Pelanggan</th><td>$nama</td></tr>
            <tr><th>Alamat</th><td>$alamat</td></tr>
            <tr><th>No HP</th><td>$no_hp</td></tr>
        </table>
        <a href='ifram.html' class='btn btn-primary'>Kembali ke Beranda</a>
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