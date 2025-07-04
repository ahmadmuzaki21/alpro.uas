<?php
include 'koneksi.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Daftar Transaksi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">
    <h2>Daftar Transaksi</h2>
    <a href="input_transaksi.html" class="btn btn-primary mb-3">Tambah Transaksi</a>
    <a href="export_transaksi.php" class="btn btn-success mb-3">Export ke CSV</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Pelanggan</th>
                <th>Barang</th>
                <th>Jumlah</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $query = "SELECT t.*, p.nama AS nama_pelanggan, b.nama_barang 
                      FROM transaksi t 
                      JOIN pelanggan p ON t.id_pelanggan = p.id_pelanggan
                      JOIN barang b ON t.kode_barang = b.kode_barang";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                            <td>{$no}</td>
                            <td>{$row['nama_pelanggan']}</td>
                            <td>{$row['nama_barang']}</td>
                            <td>{$row['jumlah']}</td>
                            <td>{$row['tanggal']}</td>
                          </tr>";
                    $no++;
                }
            } else {
                echo "<tr><td colspan='5' class='text-center'>Belum ada transaksi</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>