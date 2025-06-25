<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Data Pelanggan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Menampilkan Data Pelanggan</h2>
    <form action="save_edit_pelangan.php" method="post">
        <?php
        require("koneksi.php");

        if (isset($_POST['nama'])) {
            // Amankan input untuk mencegah SQL Injection
            $nama = mysqli_real_escape_string($conn, $_POST['nama']);

            // Perhatikan: nama tabel adalah 'pelangan' (bukan 'pelanggan')
            $sql = "SELECT * FROM pelangan WHERE nama='$nama'";
            $hasil = mysqli_query($conn, $sql);

            if (!$hasil) {
                echo "<div class='alert alert-danger'>Query error: " . mysqli_error($conn) . "</div>";
            } else {
                $row = mysqli_fetch_row($hasil);
                if ($row) {
                    do {
                        list($id_pelanggan, $nama, $alamat, $no_hp, $foto) = $row;

                        echo "<div class='mb-3 text-center'>";
                        echo "<img src='images/$foto' class='img-thumbnail' width='300' height='300'>";
                        echo "</div>";

                        echo "<div class='mb-3'>";
                        echo "<label>ID Pelanggan</label>";
                        echo "<input type='text' class='form-control' name='id_pelanggan' value='$id_pelanggan' readonly>";
                        echo "</div>";

                        echo "<div class='mb-3'>";
                        echo "<label>Nama Pelanggan</label>";
                        echo "<input type='text' class='form-control' name='nama' value='$nama'>";
                        echo "</div>";

                        echo "<div class='mb-3'>";
                        echo "<label>Alamat</label>";
                        echo "<input type='text' class='form-control' name='alamat' value='$alamat'>";
                        echo "</div>";

                        echo "<div class='mb-3'>";
                        echo "<label>No HP</label>";
                        echo "<input type='text' class='form-control' name='no_hp' value='$no_hp'>";
                        echo "</div>";

                    } while ($row = mysqli_fetch_row($hasil));
                } else {
                    echo "<div class='alert alert-warning'>Maaf, data <b>$nama</b> tidak ditemukan.</div>";
                }
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