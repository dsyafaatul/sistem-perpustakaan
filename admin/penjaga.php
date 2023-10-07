<?php
//created by dsyafaatul
if(!isset($koneksi)){
  header("Location: index.php");
}else{
  $level = $_SESSION['level'];
  if($level!="Admin"){
    ?>
    <script type="text/javascript">
      location='index.php?menu=error404';
    </script>
    <?php
  }else{
?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Penjaga
        <small>Selamat datang! di Sistem Perpustakaan</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
        <li class="active"><a href="#">Data Penjaga</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
      <div class="col-md-12">
          <?php
          $alert = $_GET['alert'];
          if(isset($alert)){
            if($alert=='error'){
            ?>
              <div class="alert alert-danger alert-dismissible" style="display: none;">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="icon fa fa-ban"></i>Gagal!
              </div>
            <?php
            }else if($alert=='success'){
            ?>
              <div class="alert alert-success alert-dismissible" style="display: none;">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="icon fa fa-check"></i>Berhasil!
              </div>
            <?php
            }
          }
          ?>
      </div>
      <?php
      $aksi = $_GET['aksi'];
      if(!empty($aksi)){
        if($aksi=="edit" AND !empty($_GET['id_penjaga'])){
          $id_penjaga = (!empty($_GET['id_penjaga']))?(int)$_GET['id_penjaga']:"";
          $data_penjaga = mysql_fetch_array(mysql_query("SELECT * FROM tabel_penjaga WHERE id_penjaga=$id_penjaga"));
          ?>
          <div class="col-md-12">
              <div class="box box-warning box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">Edit Penjaga</h3>
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div>
                  <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <form enctype="multipart/form-data" action="proses_edit_penjaga.php?id_penjaga=<?= $data_penjaga['id_penjaga'] ?>" method="POST">
                <div class="box-body">
                    <div class="form-group">
                      <input type="text" name="nama_penjaga" value="<?= $data_penjaga['nama_penjaga'] ?>" placeholder="Nama Lengkap" class="form-control" required="required">
                    </div>
                    <div class="form-group">
                      <input type="text" name="username" value="<?= $data_penjaga['username'] ?>" placeholder="Username" class="form-control" required="required">
                    </div>
                    <div class="form-group">
                      <input type="password" name="password" value="" placeholder="Password" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="radio" name="jenis_kelamin" value="L" class="minimal" <?= ($data_penjaga['jenis_kelamin']=="L")?"checked":""; ?> required="required">
                         Laki-Laki
                        <input type="radio" name="jenis_kelamin" value="P" class="minimal" <?= ($data_penjaga['jenis_kelamin']=="P")?"checked":""; ?> required="required">
                         Perempuan
                    </div>
                    <div class="form-group">
                      <input type="text" name="no_telepon" value="<?= $data_penjaga['no_telepon'] ?>" placeholder="No Telepon" class="form-control" required="required">
                    </div>
                    <div class="form-group">
                      <textarea name="alamat" class="form-control" rows="3" placeholder="Alamat" required="required"><?= $data_penjaga['alamat'] ?></textarea>
                    </div>
                    <div class="form-group">
                      <input type="file" name="foto" class="form-control">
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                  <div class="form-group pull-right">
                      <a href="index.php?menu=penjaga" class="btn btn-default">Batal</a>
                      <input type="Reset" value="Reset" class="btn btn-warning" />
                      <input type="submit" name="action" value="Simpan" class="btn btn-success" />
                  </div>
                </div>
                </form>
              </div>
              <!-- /.box -->
            </div>
          <?php
        }
      }
      ?>
      <div class="col-md-12">
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">
                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modal_tambah">
                  <i class="fa fa-plus"></i> Tambah
                </a>
                <a href="laporan_pdf.php?laporan=penjaga" class="btn btn-warning" target="blank"><i class="fa fa-file-pdf-o"></i> PDF</a>
                <a href="laporan_excel.php?laporan=penjaga" class="btn btn-success" target="blank"><i class="fa fa-file-excel-o"></i> Excel</a>
              </h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered table-striped table-hover datatables-full" width="100%">
                <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Foto</th>
                    <th>Nama</th>
                    <th>username</th>
                    <th>Jenis Kelamin</th>
                    <th>No Telepon</th>
                    <th>Alamat</th>
                    <th>Level</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  $data_penjaga_query = mysql_query("SELECT * FROM tabel_penjaga ORDER BY nama_penjaga");
                    while($data_penjaga = mysql_fetch_array($data_penjaga_query)){
                    $jenis_kelamin = ($data_penjaga['jenis_kelamin']=="L"?"Laki-Laki":"Perempuan");
                      ?>
                      <tr>
                        <td style="width: 10px"><?= $no ?></td>
                        <td><img src="img/<?= $data_penjaga['foto_penjaga'] ?>" alt="" width="40" height="40" class="img-circle"></td>
                        <td><?= $data_penjaga['nama_penjaga'] ?></td>
                        <td><?= $data_penjaga['username'] ?></td>
                        <td><?= $jenis_kelamin ?></td>
                        <td><?= $data_penjaga['no_telepon'] ?></td>
                        <td><?= $data_penjaga['alamat'] ?></td>
                        <td><?= $data_penjaga['level'] ?></td>
                        <td>
                        <a href="?menu=penjaga&aksi=edit&id_penjaga=<?= $data_penjaga['id_penjaga'] ?>" class="btn btn-warning btn-xs">
                          <i class="fa fa-pencil"></i>
                        </a>
                        <?php
                        if($data_penjaga['level']!="Admin"){
                        if($data_penjaga['status']==1){
                        ?>
                        <a href="proses_edit_status_penjaga.php?id_penjaga=<?= $data_penjaga['id_penjaga'] ?>" class="btn btn-danger btn-xs" onclick="return confirm('apakah anda yakin ingin mengnonaktifkan?')">
                          <i class="fa fa-lock"></i>
                        </a>
                        <?php }else{ ?>
                        <a href="proses_edit_status_penjaga.php?id_penjaga=<?= $data_penjaga['id_penjaga'] ?>" class="btn btn-success btn-xs" onclick="return confirm('apakah anda yakin ingin mengaktifkan?')">
                          <i class="fa fa-unlock"></i>
                        </a>
                        <?php } } ?>
                          <?php
                          if($data_penjaga['level']!="Admin"){
                          ?>
                        <a href="proses_hapus_penjaga.php?id_penjaga=<?= $data_penjaga['id_penjaga'] ?>" class="btn btn-danger btn-xs" onclick="return confirm('apakah anda yakin ingin menghapus?')">
                          <i class="fa fa-trash"></i>
                        </a>
                        <?php } ?>
                      </td>
                      </tr>
                      <?php
                      $no++;
                    }
                    ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <div class="modal fade" id="modal_tambah">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Tambah Penjaga</h4>
            </div>
            <form action="proses_tambah_penjaga.php" method="POST">
            <div class="modal-body">
                <div class="form-group">
                  <input type="text" name="nama_penjaga" value="" placeholder="Nama Lengkap" class="form-control" required="required">
                </div>
                <div class="form-group">
                  <input type="text" name="username" value="" placeholder="Username" class="form-control" required="required">
                </div>
                <div class="form-group">
                  <input type="password" name="password" value="" placeholder="Password" class="form-control" required="required">
                </div>
                <div class="form-group">
                    <input type="radio" name="jenis_kelamin" value="L" class="minimal" required="required">
                     Laki-Laki
                    <input type="radio" name="jenis_kelamin" value="P" class="minimal" required="required">
                     Perempuan
                </div>
                <div class="form-group">
                  <input type="text" name="no_telepon" value="" placeholder="No Telepon" class="form-control" required="required">
                </div>
                <div class="form-group">
                  <textarea name="alamat" class="form-control" rows="3" placeholder="Alamat" required="required"></textarea>
                </div>
            </div>
            <div class="modal-footer">
              <input type="button" value="Batal" class="btn btn-default" data-dismiss="modal" />
              <input type="Reset" value="Reset" class="btn btn-warning" />
              <input type="submit" name="action" value="Simpan" class="btn btn-success" />
            </div>
          </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php }} ?>