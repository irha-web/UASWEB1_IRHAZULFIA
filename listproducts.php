<?php
include "koneksi.php";

// CEK KONEKSI
if (!$conn) {
    die("Koneksi database gagal");
}

// AMBIL DATA BARANG
$query = mysqli_query($conn, "SELECT * FROM barang");

// CEK QUERY
if (!$query) {
    die("Query error: " . mysqli_error($conn));
}
?>

<div class="card shadow-sm">
    <div class="card-body">

        <div class="d-flex justify-content-between mb-3">
            <h4>List Produk</h4>
            <a href="#" class="btn btn-success">+ Tambah Produk</a>
        </div>

        <table class="table table-bordered table-striped text-center align-middle">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Nama Produk</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Satuan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>

            <?php
            if (mysqli_num_rows($query) > 0) {
                $no = 1;
                while ($row = mysqli_fetch_assoc($query)) {
            ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $row['kode_barang'] ?></td>
                    <td><?= $row['nama_barang'] ?></td>
                    <td><?= $row['kategori'] ?></td>
                    <td>Rp <?= number_format($row['harga']) ?></td>
                    <td><?= $row['stok'] ?></td>
                    <td><?= $row['satuan'] ?></td>
                    <td>
                        <a href="#" class="btn btn-primary btn-sm">Edit</a>
                        <a href="#" class="btn btn-danger btn-sm">Hapus</a>
                    </td>
                </tr>
            <?php
                }
            } else {
            ?>
                <tr>
                    <td colspan="8">Data barang belum tersedia</td>
                </tr>
            <?php } ?>

            </tbody>
        </table>

    </div>
</div>