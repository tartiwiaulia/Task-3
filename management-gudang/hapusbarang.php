<?php 
$koneksi->query("DELETE FROM barang WHERE id_barang='$_GET[id]'");

echo "<script>alert('produk anda telah terhapus')</script>";
echo "<script>location='index.php?halaman=barang'</script>";

?>