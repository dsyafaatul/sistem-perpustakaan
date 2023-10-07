<?php
//created by dsyafaatul
if(!isset($koneksi)){
  header("Location: index.php");
}else{
?>
<?php
$jumlah_buku = mysql_num_rows(mysql_query("SELECT * FROM tabel_buku"));
$jumlah_siswa = mysql_num_rows(mysql_query("SELECT * FROM tabel_siswa"));
$jumlah_penjaga = mysql_num_rows(mysql_query("SELECT * FROM tabel_penjaga"));
$jumlah_peminjaman = mysql_num_rows(mysql_query("SELECT * FROM tabel_peminjaman"));
?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Home
        <small>Selamat datang! di Sistem Perpustakaan</small>
      </h1>
      <ol class="breadcrumb">
        <li class="active" ><i class="fa fa-home"></i> Home</li>
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
      <!-- =========================================================== -->

      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?= $jumlah_buku ?></h3>

              <p>Jumlah Buku</p>
            </div>
            <div class="icon">
              <i class="fa fa-book"></i>
            </div>
            <a href="?menu=buku" class="small-box-footer">
              More info <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?= $jumlah_peminjaman ?></h3>

              <p>Jumlah Peminjaman</p>
            </div>
            <div class="icon">
              <i class="fa fa-tasks"></i>
            </div>
            <a href="?menu=pengembalian" class="small-box-footer">
              More info <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?= $jumlah_siswa ?></h3>

              <p>Jumlah Anggota</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="?menu=siswa" class="small-box-footer">
              More info <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?= $jumlah_penjaga ?></h3>

              <p>Jumlah Penjaga</p>
            </div>
            <div class="icon">
              <i class="fa fa-user-circle-o"></i>
            </div>
            <a href="?menu=penjaga" class="small-box-footer">
              More info <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->

      <!-- =========================================================== -->
      <div class="row">
        <div class="col-md-7 connectedSortable">
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title"> Transaksi Peminjaman Baru</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered table-striped table-hover datatables-min" width="100%">
                <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Siswa</th>
                    <th>buku</th>
                    <th>Tanggal pinjam</th>
                    <th>Batas Waktu</th>
                    <th>status</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  $data_peminjaman_query = mysql_query("SELECT tabel_siswa.*,tabel_peminjaman.*,tabel_buku.*,tabel_peminjaman.status as status_peminjaman FROM tabel_siswa,tabel_buku,tabel_peminjaman WHERE tabel_peminjaman.nis=tabel_siswa.nis AND tabel_peminjaman.kode_buku=tabel_buku.kode_buku AND tabel_peminjaman.tanggal_pinjam=CURDATE() ORDER BY tanggal_pinjam DESC");
                    while($data_peminjaman = mysql_fetch_array($data_peminjaman_query)){
                      $status = ($data_peminjaman['status_peminjaman']=="0"?"<i class=\"fa fa-close text-red\"></i>":"<i class=\"fa fa-check text-green\"></i>");
                      ?>
                      <tr>
                        <td style="width: 10px"><?= $no ?></td>
                        <td><?= $data_peminjaman['nama_siswa'] ?></td>
                        <td><?= $data_peminjaman['judul_buku'] ?></td>
                        <td><?= $data_peminjaman['tanggal_pinjam'] ?></td>
                        <td><?= $data_peminjaman['batas_waktu'] ?></td>
                        <td><?= $status ?></td>
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

          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Log Aktivitas</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered table-striped table-hover log" width="100%">
                <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>User</th>
                    <th>Aktivitas</th>
                    <th style="width: 50px;">Tanggal</th>
                    <th style="width: 50px;">Waktu</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  $log_query = mysql_query("SELECT log.*,tabel_penjaga.*,DATE_FORMAT(tanggal_log,'%Y-%m-%d') as tanggal ,DATE_FORMAT(tanggal_log,'%H:%i:%s') as jam FROM log,tabel_penjaga WHERE log.id_penjaga=tabel_penjaga.id_penjaga ORDER BY tanggal_log DESC");
                    while($data_log = mysql_fetch_array($log_query)){
                      ?>
                      <tr>
                        <td style="width: 10px"><?= $no ?></td>
                        <td><?= $data_log['nama_penjaga'] ?></td>
                        <td><?= $data_log['aktivitas'] ?></td>
                        <td><?= $data_log['tanggal'] ?></td>
                        <td><?= $data_log['jam'] ?></td>
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
        <div class="col-md-5 connectedSortable">
          <!-- LINE CHART -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Grafik peminjaman</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body chart-responsive">
              <form action="index.php" method="GET" name="form_tahun">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </span>
                  <select class="form-control select2" name="tahun" onchange="form_tahun.submit()">
                  <?php
                  $tahun = (!empty($_GET['tahun']))?$_GET['tahun']:date("Y");
                  $data_tahun_query = mysql_query("SELECT YEAR(tanggal_pinjam) as tahun FROM tabel_peminjaman GROUP BY YEAR(tanggal_pinjam) ORDER BY YEAR(tanggal_pinjam) DESC");
                  while($data_tahun_result = mysql_fetch_array($data_tahun_query)){
                  ?>
                    <option value="<?= $data_tahun_result['tahun'] ?>" <?= ($data_tahun_result['tahun']==$tahun)?"selected":"" ?>><?= $data_tahun_result['tahun'] ?></option>
                  <?php
                  }
                  ?>
                  </select>
                </div>
              </div>
              </form>
              <div class="chart" id="bar-chart" style="height: 300px;"></div>
            </div>
            <!-- /.box-body -->
            <?php
            $data_peminjaman_pertahun_query = mysql_query("SELECT *,DATE_FORMAT(tanggal_pinjam,'%d %M %Y') as tanggal,COUNT(*) as jumlah FROM tabel_peminjaman WHERE YEAR(tanggal_pinjam)='$tahun' GROUP BY DATE_FORMAT(tanggal_pinjam,'%d-%M-%Y') ORDER BY tanggal_pinjam");
            $data = "[";
            while($data_peminjaman_pertahun = mysql_fetch_array($data_peminjaman_pertahun_query)){
              $data .= "{y: '".$data_peminjaman_pertahun['tanggal']."', jumlah:".$data_peminjaman_pertahun['jumlah']."},
              ";
            }
            $data .= "]";
            ?>
            <script>
              $(function(){
                    //BAR CHART
              var bar = new Morris.Bar({
                element: 'bar-chart',
                resize: true,
                data: <?php echo $data ?>,
                barColors: ['#00a65a'],
                xkey: 'y',
                ykeys: ['jumlah'],
                labels: ['Jumlah peminjaman'],
                hideHover: 'auto'
              });
              })
            </script>
          </div>
          <!-- /.box -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Buku Populer</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered table-striped table-hover datatables-min" width="100%">
                <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Peminjaman</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  $data_buku_populer_query = mysql_query("SELECT tabel_buku.*,tabel_kategori.*,COUNT(*) as dipinjam FROM tabel_buku,tabel_kategori,tabel_peminjaman WHERE tabel_peminjaman.kode_buku=tabel_buku.kode_buku AND tabel_buku.id_kategori=tabel_kategori.id_kategori GROUP BY tabel_buku.kode_buku ORDER BY dipinjam DESC LIMIT 0, 10;");
                    while($data_buku_populer = mysql_fetch_array($data_buku_populer_query)){
                      $sisa = $data_buku_populer['stok']-$data_buku_populer['dipinjam'];
                      ?>
                      <tr>
                        <td style="width: 10px"><?= $no ?></td>
                        <td><?= $data_buku_populer['judul_buku'] ?></td>
                        <td><?= $data_buku_populer['nama_kategori'] ?></td>
                        <td><?= $data_buku_populer['dipinjam'] ?> Kali Dipinjam</td>
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
        
          <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Anggota Aktif</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered table-striped table-hover datatables-min" width="100%">
                <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>NIS</th>
                    <th>Siswa</th>
                    <th>Kelas</th>
                    <th>Peminjaman</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  $data_anggota_aktif_query = mysql_query("SELECT tabel_siswa.*,tabel_kelas.*,COUNT(*) as jumlah_peminjaman FROM tabel_siswa,tabel_kelas,tabel_peminjaman WHERE tabel_peminjaman.nis=tabel_siswa.nis AND tabel_siswa.id_kelas=tabel_kelas.id_kelas GROUP BY tabel_siswa.nis ORDER BY jumlah_peminjaman DESC LIMIT 0, 10");
                    while($data_anggota_aktif = mysql_fetch_array($data_anggota_aktif_query)){
                      ?>
                      <tr>
                        <td style="width: 10px"><?= $no ?></td>
                        <td><a href="?menu=siswa&aksi=detail&nis=<?= $data_anggota_aktif['nis'] ?>"><?= $data_anggota_aktif['nis'] ?></a></td>
                        <td><?= $data_anggota_aktif['nama_siswa']; ?></td>
                        <td><?= $data_anggota_aktif['tingkat']." ".$data_anggota_aktif['jurusan'] ?></td>
                        <td><?= $data_anggota_aktif['jumlah_peminjaman'] ?> kali</td>
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
        </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php } ?>