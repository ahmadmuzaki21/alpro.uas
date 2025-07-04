<?php
include 'koneksi.php';

$id_pelanggan = $_POST['id_pelanggan'];
$kode_barang = $_POST['kode_barang'];
$jumlah = $_POST['jumlah'];
$tanggal = $_POST['tanggal'];

$query = "INSERT INTO transaksi (id_pelanggan, kode_barang, jumlah, tanggal)
          VALUES ('$id_pelanggan', '$kode_barang', '$jumlah', '$tanggal')";
mysqli_query($conn, $query);

header("Location: list_transaksi.php");
?>