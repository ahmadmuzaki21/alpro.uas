<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hapus Data Barang</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('paper.gif');
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
        <div class="card-body bg-light text-center">
            <?php
            require("koneksi.php");

            $kode_barang = $_POST['kode_barang']??'';

            $sql = "DELETE FROM barang WHERE kode_barang = '$kode_barang'";
            $hasil = mysqli_query($conn, $sql);

            if ($hasil) {
                echo "<div class='alert alert-success rounded-4'><h4 class='mb-0'>✅ Data dengan KODE <b>$kode_barang</b> berhasil dihapus!</h4></div>";
            } else {
                echo "<div class='alert alert-danger rounded-4'><h4 class='mb-0'>❌ Gagal menghapus data!</h4><br><code>" . mysqli_error($conn) . "</code></div>";
            }

            mysqli_close($conn);
            ?>
            <a href="index.php" class="btn btn-primary mt-3">Kembali ke Beranda</a>
        </div>
    </div>
</div>
</body>
</html>