<?php
include "koneksi.php";

// AMBIL ID BARANG
$id = $_GET['id'];

// AMBIL DATA BARANG BERDASARKAN ID
$query = mysqli_query($conn, "SELECT * FROM barang WHERE id_barang='$id'");
$data  = mysqli_fetch_assoc($query);

// JIKA DATA TIDAK DITEMUKAN
if (!$data) {
    echo "<script>alert('Data tidak ditemukan');window.location='index.php?page=listproducts';</script>";
}

// PROSES UPDATE DATA
if (isset($_POST['update'])) {
    $kode_barang = $_POST['kode_barang'];
    $nama_barang = $_POST['nama_barang'];
    $kategori    = $_POST['kategori'];
    $harga       = $_POST['harga'];
    $stok        = $_POST['stok'];
    $satuan      = $_POST['satuan'];

    $update = mysqli_query($conn, "
        UPDATE barang SET
            kode_barang='$kode_barang',
            nama_barang='$nama_barang',
            kategori='$kategori',
            harga='$harga',
            stok='$stok',
            satuan='$satuan'
        WHERE id_barang='$id'
    ");

    if ($update) {
        echo "<script>
            alert('Data berhasil diupdate');
            window.location='index.php?page=listproducts';
        </script>";
    } else {
        echo "<script>alert('Gagal update data');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Edit Data Produk</h5>
        </div>
        <div class="card-body">

            <form method="post">
                <div class="mb-3">
                    <label class="form-label">Kode Barang</label>
                    <input type="text" name="kode_barang" class="form-control" 
                           value="<?= $data['kode_barang']; ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nama Barang</label>
                    <input type="text" name="nama_barang" class="form-control" 
                           value="<?= $data['nama_barang']; ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <input type="text" name="kategori" class="form-control" 
                           value="<?= $data['kategori']; ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Harga</label>
                    <input type="number" name="harga" class="form-control" 
                           value="<?= $data['harga']; ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Stok</label>
                    <input type="number" name="stok" class="form-control" 
                           value="<?= $data['stok']; ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Satuan</label>
                    <input type="text" name="satuan" class="form-control" 
                           value="<?= $data['satuan']; ?>">
                </div>

                <button type="submit" name="update" class="btn btn-success">
                    Simpan Perubahan
                </button>
                <a href="index.php?page=listproducts" class="btn btn-secondary">
                    Kembali
                </a>
            </form>

        </div>
    </div>
</div>

</body>
</html>
