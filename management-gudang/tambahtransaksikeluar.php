<?php
$hasil = $koneksi->query("SELECT * FROM barang");
while ($data = $hasil->fetch_assoc()) {
    $datasatuan[] = $data;
}

$tanggal = date("Y-m-d");

// Tentukan nilai default status transaksi
$status_transaksi = "Masuk"; // Default status transaksi adalah "Masuk"

?>

<h2>Tambah Transaksi Masuk</h2>

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
    </div>
    <div class="form-group">
        <label for="qty_barang_transaksi">Qty Barang Transaksi</label>
        <input class="form-control" type="number" name="qty_barang_transaksi" id="qty_barang_transaksi">
    </div>
    <div class="form-group">
        <label for="tanggal_transaksi">Tanggal Transaksi</label>
        <input class="form-control" type="date" name="tanggal_transaksi" id="tanggal_transaksi" value="<?php echo $tanggal; ?>">
    </div>
    <div class="form-group">
        <!-- Tambahkan form "hidden" untuk menyimpan nilai status transaksi -->
        <input type="hidden" name="status_transaksi" value="<?php echo $status_transaksi; ?>">
    </div>
    <button class="btn btn-primary" name="kirim">Kirim</button>
</form>

<?php
if (isset($_POST['kirim'])) {
    $id_nama_barang = $_POST['id_nama_barang'];
    $qty_barang_transaksi = $_POST['qty_barang_transaksi'];
    $tanggal_transaksi = $_POST['tanggal_transaksi'];
    $status_transaksi = $_POST['status_transaksi']; // Ambil nilai status transaksi dari form

    // Ubah nilai status transaksi menjadi "Keluar" jika form diisi dan data dikirimkan
    if ($id_nama_barang && $qty_barang_transaksi && $tanggal_transaksi) {
        $status_transaksi = "Keluar";
    }

    $query = "INSERT INTO data_transaksi (id_nama_barang, qty_barang_transaksi, tanggal_transaksi, status_transaksi)
              VALUES ('$id_nama_barang', '$qty_barang_transaksi', '$tanggal_transaksi', '$status_transaksi')";

    if ($koneksi->query($query)) {
        echo '<script>alert("Data transaksi berhasil ditambahkan!");</script>';
    } else {
        echo '<script>alert("Gagal menambahkan data transaksi: ' . $koneksi->error . '");</script>';
    }
}

// Perbaiki penggunaan nama kolom pada query UPDATE
if (isset($_POST['qty']) && isset($_POST['barang'])) {
    $qty = $_POST['qty'];
    $barang = $_POST['barang'];

    // Tambahkan kondisi WHERE pada query UPDATE
    $query = "UPDATE barang SET stok_barang = stok_barang + $qty WHERE id_barang = $barang";

    if ($koneksi->query($query)) {
        echo '<script>alert("Stok barang berhasil diupdate!");</script>';
    } else {
        echo '<script>alert("Gagal mengupdate stok barang: ' . $koneksi->error . '");</script>';
    }
}
?>