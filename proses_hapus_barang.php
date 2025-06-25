<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Proses Hapus Data Barang</title>
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
            <h2>PROSES HAPUS DATA BARANG</h2>
        </div>
        <div class="card-body bg-light">
            <?php
            require("koneksi.php");

            $pilihan = $_POST['pilihan'];
            $cari_data = $_POST['cari_data'];

            $sql = "SELECT * FROM barang WHERE $pilihan = '$cari_data'";
            $hasil = mysqli_query($conn, $sql);

            if ($hasil && mysqli_num_rows($hasil) > 0) {
                while ($row = mysqli_fetch_row($hasil)) {
                    list($kode_barang, $nama_barang, $harga, $stok, $foto) = $row;

                    echo "<form action='hapus_barang.php' method='post'>";
                    echo "<div class='row'>";
                    echo "<div class='col-md-8'>";
                    echo "<div class='mb-3'><label class='form-label'>Kode Barang</label><input type='text' class='form-control' value='$kode_barang' readonly></div>";
                    echo "<div class='mb-3'><label class='form-label'>Nama Barang</label><input type='text' class='form-control' value='$nama_barang' readonly></div>";
                    echo "<div class='mb-3'><label class='form-label'>Harga</label><input type='text' class='form-control' value='$harga' readonly></div>";
                    echo "<div class='mb-3'><label class='form-label'>Stok</label><input type='text' class='form-control' value='$stok' readonly></div>";
                    echo "<input type='hidden' name='kode_barang' value='$kode_barang'>";
                    echo "</div>";
                    echo "<div class='col-md-4 text-center'>";
                    echo "<img src='images/$foto' class='img-thumbnail photo' alt='Foto Barang'>";
                    echo "</div>";
                    echo "</div>";
                    echo "<hr>";
                    echo "<div class='text-center'>";
                    echo "<button type='submit' class='btn btn-danger btn-lg w-100 mb-2'>Yakin Data Ini Akan Dihapus!</button>";
                    echo "</div>";
                    echo "</form>";
                }
            } else {
                echo "<div class='alert alert-danger text-center rounded-4'><strong>Maaf, data tidak ditemukan!</strong></div>";
            }
            ?>
        </div>
    </div>
</div>
</body>
</html>