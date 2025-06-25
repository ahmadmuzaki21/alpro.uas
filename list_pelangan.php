<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Pelanggan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('paper.gif');
            background-size: cover;
            background-attachment: fixed;
        }
        .photo {
            width: 80px;
            height: 80px;
            object-fit: cover;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="card shadow-lg rounded-4">
        <div class="card-header bg-info text-white text-center rounded-top-4">
            <h2>Daftar Pelanggan</h2>
        </div>
        <div class="card-body bg-light">
            <?php
            require("koneksi.php");

            $sql = "SELECT * FROM pelangan ORDER BY nama";
            $hasil = mysqli_query($conn, $sql);

            if (mysqli_num_rows($hasil) > 0) {
                echo "<table class='table table-bordered table-hover text-center align-middle'>";
                echo "<thead class='table-primary'>";
                echo "<tr>
                        <th>No</th>
                        <th>Foto</th>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>No HP</th>
                      </tr>";
                echo "</thead><tbody>";

                $no = 1;
                while ($row = mysqli_fetch_assoc($hasil)) {
                    echo "<tr>";
                    echo "<td>$no</td>";
                    echo "<td><img src='images/{$row['foto']}' class='photo rounded-circle' alt='Foto'></td>";
                    echo "<td>{$row['id_pelanggan']}</td>";
                    echo "<td>{$row['nama']}</td>";
                    echo "<td>{$row['alamat']}</td>";
                    echo "<td>{$row['no_hp']}</td>";
                    echo "</tr>";
                    $no++;
                }

                echo "</tbody></table>";
            } else {
                echo "<div class='alert alert-warning text-center rounded-4'><strong>Data pelanggan kosong!</strong></div>";
            }

            mysqli_close($conn);
            ?>
        </div>
    </div>
</div>
</body>
</html>