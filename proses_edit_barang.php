<?php
require("koneksi.php");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Data Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Edit Data Barang</h2>
    <form action="save_edit_barang.php" method="post">
        <?php
        if (isset($_POST['nama'])) {
            $nama = mysqli_real_escape_string($conn, $_POST['nama']);

            $sql = "SELECT * FROM barang WHERE nama_barang='$nama'";
            $hasil = mysqli_query($conn, $sql);

            if ($hasil && mysqli_num_rows($hasil) > 0) {
                $row = mysqli_fetch_assoc($hasil);

                echo "<div class='mb-3 text-center'>";
                echo "<img src='images/{$row['foto']}' class='img-thumbnail' width='300' height='300'>";
                echo "</div>";

                echo "<div class='mb-3'>";
                echo "<label>Kode Barang</label>";
                echo "<input type='text' class='form-control' name='kode_barang' value='{$row['kode_barang']}' readonly>";
                echo "</div>";

                echo "<div class='mb-3'>";
                echo "<label>Nama Barang</label>";
                echo "<input type='text' class='form-control' name='nama_barang' value='{$row['nama_barang']}' required>";
                echo "</div>";

                echo "<div class='mb-3'>";
                echo "<label>Harga</label>";
                echo "<input type='number' class='form-control' name='harga' value='{$row['harga']}' required>";
                echo "</div>";

                echo "<div class='mb-3'>";
                echo "<label>Stok</label>";
                echo "<input type='number' class='form-control' name='stok' value='{$row['stok']}' required>";
                echo "</div>";
            } else {
                echo "<div class='alert alert-danger'>Maaf, data <b>$nama</b> tidak ditemukan.</div>";
            }
        } else {
            echo "<div class='alert alert-warning'>Parameter 'nama' tidak diterima.</div>";
        }
        ?>
        <hr>
        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
        <button type="reset" class="btn btn-secondary">Reset</button>
    </form>
</div>
</body>
</html>