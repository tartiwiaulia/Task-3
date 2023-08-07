<?php
ob_start(); // Start output buffering

$hasil = $koneksi->query("SELECT * FROM barang");
while ($data = $hasil->fetch_assoc()) {
    $datasatuan[] = $data;
}

$tanggal = date("Y-m-d");
?>

<h2>Tambah Transaksi Keluar</h2>

<form action="" method="post">
    <div class="form-group">
        <label for="id_nama_barang">Pilih Nama Barang</label>
        <select class="form-control" name="id_nama_barang" id="id_nama_barang">
            <option value="">Pilih Barang</option>
            <?php
            $hasil = $koneksi->query("SELECT * FROM barang");
            while ($data_barang = $hasil->fetch_assoc()) {
                echo '<option value="' . $data_barang['id_barang'] . '">' . $data_barang['nama_barang'] . '</option>';
            }
            ?>
        </select>
        <div class="form-group">
            <label for="qty_barang_transaksi">Qty Barang Transaksi</label>
            <input class="form-control" type="number" name="qty_barang_transaksi" id="qty_barang_transaksi">
        </div>
        <div class="form-group">
            <label for="tanggal_transaksi">Tanggal Transaksi</label>
            <input class="form-control" type="date" name="tanggal_transaksi" id="tanggal_transaksi">
        </div>
        <div class="form-group">
            <!-- Ubah form "hidden" menjadi "status_transaksi" dengan value "masuk" -->
            <input type="hidden" name="status_transaksi" value="masuk">
        </div>
        <button class="btn btn-primary" name="kirim">Kirim</button>
</form>

<?php
if (isset($_POST['kirim'])) {
    $id_nama_barang = $_POST['id_nama_barang'];
    $qty_barang_transaksi = $_POST['qty_barang_transaksi'];
    $tanggal_transaksi = $_POST['tanggal_transaksi'];
    $status_transaksi = $_POST['status_transaksi'];

    $query_insert = "INSERT INTO data_transaksi (id_nama_barang, qty_barang_transaksi, tanggal_transaksi, status_transaksi)
              VALUES ('$id_nama_barang', '$qty_barang_transaksi', '$tanggal_transaksi', '$status_transaksi')";

    if ($koneksi->query($query_insert)) {
        echo '<script>alert("Data transaksi berhasil ditambahkan!");</script>';
    } else {
        echo '<script>alert("Gagal menambahkan data transaksi: ' . $koneksi->error . '");</script>';
    }
}

if (isset($_POST['qty_barang_transaksi']) && isset($_POST['id_nama_barang'])) {
    $qty = $_POST['qty_barang_transaksi'];
    $barang = $_POST['id_nama_barang'];

    $query_update = "UPDATE barang SET stok_barang = stok_barang + $qty WHERE id_barang = $barang";

    if ($koneksi->query($query_update)) {
        echo '<script>alert("Stok barang berhasil diupdate!");</script>';
        header("Location: index.php?halaman=transaksimasuk");
        exit;
    } else {
        echo '<script>alert("Gagal mengupdate stok barang: ' . $koneksi->error . '");</script>';
    }
}

ob_end_flush()
?>