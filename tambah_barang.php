<?php
include "koneksi.php";

// PROSES SIMPAN DATA
if (isset($_POST['simpan'])) {
    $kode     = $_POST['kode_barang'];
    $nama     = $_POST['nama_barang'];
    $kategori = $_POST['kategori'];
    $harga    = $_POST['harga'];
    $stok     = $_POST['stok'];
    $satuan   = $_POST['satuan'];

    $simpan = mysqli_query($conn, "
        INSERT INTO barang 
        (kode_barang, nama_barang, kategori, harga, stok, satuan)
        VALUES
        ('$kode', '$nama', '$kategori', '$harga', '$stok', '$satuan')
    ");

    if ($simpan) {
        echo "<script>
            alert('Data berhasil ditambahkan');
            window.location='index.php?page=listproducts';
        </script>";
    } else {
        echo "<script>alert('Gagal menambahkan data');</script>";
    }
}
?>

<style>
.card {
    background: #ffffff;
    padding: 30px;
    border-radius: 10px;
    max-width: 720px;
    margin-left: 0;
    margin-right: auto;
    box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
}
.card h3 {
    margin-bottom: 20px;
    border-bottom: 1px solid #ddd;
    padding-bottom: 10px;
}
.form-group {
    margin-bottom: 15px;
}
label {
    display: block;
    font-weight: bold;
    margin-bottom: 6px;
}
select, input {
    width: 100%;
    padding: 10px;
    border-radius: 5px;
    border: 1px solid #ccc;
}
input:focus, select:focus {
    outline: none;
    border-color: #3498db;
}
.btn {
    padding: 10px 16px;
    border-radius: 5px;
    text-decoration: none;
    color: white;
    border: none;
    cursor: pointer;
}
.btn-tambah {
    background: #27ae60;
}
.btn-tambah:hover {
    background: #219150;
}
.btn-hapus {
    background: #c0392b;
}
.btn-hapus:hover {
    background: #a93226;
}
</style>

<div class="card">
    <h3>Tambah Produk</h3>

    <form method="post">
        <div class="form-group">
            <label>Kode Barang</label>
            <input type="text" name="kode_barang" required>
        </div>

        <div class="form-group">
            <label>Nama Barang</label>
            <input type="text" name="nama_barang" required>
        </div>

        <div class="form-group">
            <label>Kategori</label>
            <select name="kategori" required>
                <option value="">-- Pilih Kategori --</option>
                <option value="Elektronik">Elektronik</option>
                <option value="Pakaian">Pakaian</option>
                <option value="Makanan">Makanan</option>
                <option value="Minuman">Minuman</option>
                <option value="Alat Tulis">Alat Tulis</option>
            </select>
        </div>

        <div class="form-group">
            <label>Harga</label>
            <input type="number" name="harga" required>
        </div>

        <div class="form-group">
            <label>Stok</label>
            <input type="number" name="stok" required>
        </div>

        <div class="form-group">
            <label>Satuan</label>
            <select name="satuan" required>
                <option value="">-- Pilih Satuan --</option>
                <option value="pcs">pcs</option>
                <option value="box">box</option>
                <option value="kg">kg</option>
                <option value="liter">liter</option>
            </select>
        </div>

        <button type="submit" name="simpan" class="btn btn-tambah">
            Simpan
        </button>
        <a href="index.php?page=listproducts" class="btn btn-hapus">
            Batal
        </a>
    </form>
</div>
