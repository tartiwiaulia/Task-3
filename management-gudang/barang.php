<h2>halaman barang</h2>

<div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             Advanced Tables <a href="index.php?halaman=tambahbarang" class="btn btn-primary">tambah barang</a>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                           <th>no</th>
                                           <th>barang</th>
                                           <th>stok</th>
                                           <th>ukuran</th>
                                           <th>satuan</th>
                                           <th>harga (RP)</th>
                                           <th>aksi</th>
                                        </tr>
                                    </thead>
                                   <tbody>

                                   <?php $nomor = 1;?>
                                   <?php $hasil = $koneksi->query("SELECT * FROM barang LEFT JOIN satuan_barang ON barang.id_satuan_barang = satuan_barang.id_satuan") ?>
                                   <?php while($data = $hasil->fetch_assoc()){?>
                                      <tr>
                                        <td><?php echo $nomor?></td>
                                        <td><?php echo $data['nama_barang']?></td>
                                        <td><?php echo $data['stok_barang']?></td>
                                        <td><?php echo $data['ukuran_barang']?></td>
                                        <td><?php echo $data['satuan_barang']?></td>
                                        <td><?php echo $data['harga_barang']?></td>
                                        <td>
                                            <a href="index.php?halaman=hapusbarang&id=<?php echo $data['id_barang']?>" class="btn btn-danger">hapus</a>
                                            <a href="index.php?halaman=editbarang&id=<?php echo $data['id_barang']?>" class="btn btn-warning">edit</a>
                                        </td>
                                      </tr>
                                      <?php $nomor++ ?>
                                      <?php } ?>
                                   </tbody>
                                </table>
                            </div>
                            
                        </div>
                    </div>
                    <!--End Advanced Tables -->
                </div>
            </div>