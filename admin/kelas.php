<?php
//created by dsyafaatul
if(!isset($koneksi)){
  header("Location: index.php");
}else{
?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Kelas
        <small>Selamat datang! di Sistem Perpustakaan</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
        <li class="active"><a href="#">Data Kelas</a></li>
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
        if($aksi=="edit" AND !empty($_GET['id_kelas'])){
          $id_kelas = (!empty($_GET['id_kelas']))?(int)$_GET['id_kelas']:"";
          $data_kelas = mysql_fetch_array(mysql_query("SELECT * FROM tabel_kelas WHERE id_kelas=$id_kelas"));
          ?>
          <div class="col-md-12">
              <div class="box box-warning box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">Edit Kelas</h3>
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div>
                  <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <form action="proses_edit_kelas.php?id_kelas=<?= $data_kelas['id_kelas'] ?>" method="POST">
                <div class="box-body">
                    <div class="form-group">
                      <input type="text" name="tingkat" value="<?= $data_kelas['tingkat'] ?>" placeholder="Tingkat" class="form-control" required="required">
                    </div>
                    <div class="form-group">
                      <input type="text" name="jurusan" value="<?= $data_kelas['jurusan'] ?>" placeholder="Nama Jurusan" class="form-control" required="required">
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                  <div class="form-group pull-right">
                      <a href="index.php?menu=kelas" class="btn btn-default">Batal</a>
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
                    <th style="width: 10px">Tingkat</th>
                    <th>Jurusan</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  $data_kelas_query = mysql_query("SELECT * FROM tabel_kelas");
                    while($data_kelas = mysql_fetch_array($data_kelas_query)){
                      ?>
                      <tr>
                        <td style="width: 10px"><?= $no ?></td>
                        <td><?= $data_kelas['tingkat'] ?></td>
                        <td><?= $data_kelas['jurusan'] ?></td>
                        <td style="width: 10px">
                        <a href="?menu=kelas&aksi=edit&id_kelas=<?= $data_kelas['id_kelas'] ?>" class="btn btn-warning btn-xs">
                          <i class="fa fa-pencil"></i>
                        </a>
                         <?php
                        if($data_kelas['status']==1){
                        ?>
                        <a href="proses_edit_status_kelas.php?id_kelas=<?= $data_kelas['id_kelas'] ?>" class="btn btn-danger btn-xs" onclick="return confirm('apakah anda yakin ingin mengnonaktifkan?')">
                          <i class="fa fa-lock"></i>
                        </a>
                        <?php }else{ ?>
                        <a href="proses_edit_status_kelas.php?id_kelas=<?= $data_kelas['id_kelas'] ?>" class="btn btn-success btn-xs" onclick="return confirm('apakah anda yakin ingin mengaktifkan?')">
                          <i class="fa fa-unlock"></i>
                        </a>
                        <?php } ?>
                        <?php
                        $level = $_SESSION['level'];
                        if($level=="Admin"){
                        ?>
                        <a href="proses_hapus_kelas.php?id_kelas=<?= $data_kelas['id_kelas'] ?>" class="btn btn-danger btn-xs" onclick="return confirm('apakah anda yakin ingin menghapus?')">
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
              <h4 class="modal-title">Tambah Kelas</h4>
            </div>
            <form action="proses_tambah_kelas.php" method="POST">
            <div class="modal-body">
                <div class="form-group">
                  <input type="text" name="tingkat" value="" placeholder="Tingkat" class="form-control" required="required">
                </div>
                <div class="form-group">
                  <input type="text" name="jurusan" value="" placeholder="Nama Jurusan" class="form-control" required="required">
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
  <?php } ?>