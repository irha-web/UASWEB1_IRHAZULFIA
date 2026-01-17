<?php
include "koneksi.php";

// AMBIL ID BARANG DARI URL
$id = $_GET['id'];

// HAPUS DATA BARANG
$hapus = mysqli_query($conn, "DELETE FROM barang WHERE id_barang='$id'");

if ($hapus) {
    echo "<script>
        alert('Data berhasil dihapus');
        window.location='index.php?page=listproducts';
    </script>";
} else {
    echo "<script>
        alert('Data gagal dihapus');
        window.location='index.php?page=listproducts';
    </script>";
}
