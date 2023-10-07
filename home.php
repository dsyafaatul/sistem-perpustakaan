<?php
//created by dsyafaatul
  if(!isset($koneksi)){
    header("Location: index.php");
  }else{
?>
    <!-- Main content -->
    <section class="content container-fluid">
      <div class="login-logo" style="margin-top: 50px;">
          <img src="<?= "admin/img/".$config['logo'] ?>" alt="" width="100" height="100">
          <h3 style="padding: 0px;"> PERPUSTAKAAN <?php echo $config['nama'] ?></h3>
          <h5 style="padding: 0px;"><?php echo $config['alamat'] ?></h5>
        </div>
        <div class="col-md-8 col-md-offset-2">
            <div class="col-md-8 col-md-offset-2">
              <form action="">
              <div class="form-group">
                <div class="input-group">
                  <input type="text" class="form-control" name="q" placeholder="Cari Buku Berdasarkan Judul Buku">
                  <span class="input-group-btn">
                    <button class="btn btn-primary">
                      <i class="fa fa-search"></i>
                    </button>
                  </span>
                </div>
              </div>
              </form>
            </div>
              <?php
              $q = $_GET['q'];
              if(!empty($q)){
                  $data_buku_query = mysql_query("SELECT tabel_buku.*,tabel_kategori.* FROM tabel_buku,tabel_kategori WHERE tabel_buku.id_kategori=tabel_kategori.id_kategori AND (tabel_buku.judul_buku LIKE '%$q%' OR tabel_buku.kode_buku='$q') ORDER BY tabel_buku.judul_buku");
              ?>
            <div class="col-md-12">
            <div class="box box-default box-solid">
            <div class="box-header with-border">
              Pencarian Buku "<?= $q ?>"
            </div>
            <div class="box-body">
            <table class="table table-bordered table-striped datatables-min" width="100%">
                <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Kode</th>
                    <th>Judul</th>
                    <th>Pengarang</th>
                    <th style="width: 5px;">Stok</th>
                    <th style="width: 5px;">Sisa</th>
                    <th>Dipinjam</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                    while($data_buku = mysql_fetch_array($data_buku_query)){
                      $sisa = $data_buku['stok']-(mysql_num_rows(mysql_query("SELECT * FROM tabel_peminjaman WHERE kode_buku='$data_buku[kode_buku]' AND status='0'")));
                      $dipinjam = mysql_num_rows(mysql_query("SELECT * FROM tabel_peminjaman WHERE kode_buku='$data_buku[kode_buku]' AND status='0'"));
                      ?>
                      <tr>
                        <td style="width: 10px"><?= $no ?></td>
                        <td><?= $data_buku['kode_buku'] ?></td>
                        <td><?= $data_buku['judul_buku'] ?></td>
                        <td><?= $data_buku['pengarang'] ?></td>
                        <td><?= $data_buku['stok'] ?></td>
                        <td><?= $sisa ?></td>
                        <td><?= $dipinjam ?></td>
                        <td><a href="index.php?kode_buku=<?= $data_buku['kode_buku'] ?>"><i class="fa fa-eye"></i></a></td>
                      </tr>
                      <?php
                      $no++;
                    }
                    ?>
                </tbody>
              </table>
              </div>
              </div>
              </div>
                <?php } ?>
                <?php
                $kode_buku = $_GET['kode_buku'];
                if(!empty($kode_buku)){
                  $jumlah_pinjam = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM tabel_peminjaman WHERE kode_buku='$kode_buku'"));
                  $data_buku = mysql_fetch_array(mysql_query("SELECT tabel_buku.*,tabel_kategori.* FROM tabel_buku,tabel_kategori WHERE tabel_buku.kode_buku='$kode_buku' AND tabel_buku.id_kategori=tabel_kategori.id_kategori"));
                  $sisa = $data_buku['stok']-(mysql_num_rows(mysql_query("SELECT * FROM tabel_peminjaman WHERE kode_buku='$data_buku[kode_buku]' AND status='0'")));
                  $dipinjam = mysql_num_rows(mysql_query("SELECT * FROM tabel_peminjaman WHERE kode_buku='$data_buku[kode_buku]' AND status='0'"));
                  ?>
                  <div class="col-md-12">
                    <div class="box box-default box-solid">
                    <div class="box-header with-border">
                      Detail Buku "<?= $data_buku['judul_buku'] ?>"
                    </div>
                    <div class="box-body">
                    <table class="table table-bordered table-hover" width="100%">
                      <tr>
                        <td>ID</td>
                        <td>:</td>
                        <td><?= $data_buku['id_buku'] ?></td>
                      </tr>
                      <tr>
                        <td>Kode Buku</td>
                        <td>:</td>
                        <td><?= $data_buku['kode_buku'] ?></td>
                      </tr>
                      <tr>
                        <td>Judul Buku</td>
                        <td>:</td>
                        <td><?= $data_buku['judul_buku'] ?></td>
                      </tr>
                      <tr>
                        <td>Kategori</td>
                        <td>:</td>
                        <td><?= $data_buku['nama_kategori'] ?></td>
                      </tr>
                      <tr>
                        <td>Pengarang</td>
                        <td>:</td>
                        <td><?= $data_buku['pengarang'] ?></td>
                      </tr>
                      <tr>
                        <td>Penerbit</td>
                        <td>:</td>
                        <td><?= $data_buku['penerbit'] ?></td>
                      </tr>
                      <tr>
                        <td>Tahun Terbit</td>
                        <td>:</td>
                        <td><?= $data_buku['tahun_terbit'] ?></td>
                      </tr>
                      <tr>
                        <td>Tanggal Masuk</td>
                        <td>:</td>
                        <td><?= $data_buku['tanggal_masuk'] ?></td>
                      </tr>
                      <tr>
                        <td>Stok</td>
                        <td>:</td>
                        <td><?= $data_buku['stok'] ?></td>
                      </tr>
                      <tr>
                        <td>Sisa</td>
                        <td>:</td>
                        <td><?= $sisa ?></td>
                      </tr>
                      <tr>
                        <td>Dipinjam</td>
                        <td>:</td>
                        <td><?= $dipinjam ?></td>
                      </tr>
                      <tr>
                        <td>Jumlah Peminjaman</td>
                        <td>:</td>
                        <td><?= $jumlah_pinjam[0] ?></td>
                      </tr>
                    </table>
                  </div>
                  </div>
                  </div>
                  <?php
                }
                ?>
        </div>
    </section>
    <!-- /.content -->
<?php } ?>