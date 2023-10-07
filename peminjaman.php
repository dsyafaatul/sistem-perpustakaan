<?php
//created by dsyafaatul
  if(!isset($koneksi)){
    header("Location: index.php");
  }else{
?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Peminjaman
        <small>Selamat datang! di Sistem Perpustakaan</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
        <li class="active"><a href="#">Peminjaman</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
      <div class="box box-default">
<div class="box-header with-border">
  Riwayat Peminjaman Hari Ini
</div>
<div class="box-body">
<table class="table table-bordered table-striped table-hover peminjaman" width="100%">
  <thead>
    <tr>
      <th style="width: 10px">#</th>
      <th>Judul Buku</th>
      <th>Siswa</th>
      <th>Tanggal Pinjam</th>
      <th>Batas waktu</th>
      <th>Tanggal Kembali</th>
      <th>Status</th>
      <th style="width: 10px">Ket</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $no = 1;
    $data_peminjaman_query = mysql_query("SELECT tabel_peminjaman.*,tabel_siswa.*,tabel_penjaga.*,tabel_buku.*,tabel_peminjaman.status as status_peminjaman FROM tabel_peminjaman,tabel_siswa,tabel_penjaga,tabel_buku WHERE tabel_siswa.nis=tabel_peminjaman.nis AND tabel_penjaga.id_penjaga=tabel_peminjaman.id_penjaga AND tabel_buku.kode_buku=tabel_peminjaman.kode_buku AND (tabel_peminjaman.tanggal_pinjam=CURDATE() OR tabel_peminjaman.tanggal_kembali=CURDATE()) ORDER BY tanggal_pinjam DESC");
      while($data_peminjaman = mysql_fetch_array($data_peminjaman_query)){
      $status = ($data_peminjaman['status_peminjaman']=="0"?"<i class=\"fa fa-close text-red\"></i>":"<i class=\"fa fa-check text-green\"></i>");
        ?>
        <tr>
          <td style="width: 10px"><?= $no ?></td>
          <td><?= $data_peminjaman['judul_buku'] ?></td>
          <td><?= $data_peminjaman['nama_siswa'] ?></td>
          <td><?= $data_peminjaman['tanggal_pinjam']   ?></td>
          <td><?= $data_peminjaman['batas_waktu'] ?></td>
          <td><?= $data_peminjaman['tanggal_kembali'] ?></td>
          <td><?= $status ?></td>
          <td>
            <?php
              $sekarang_date_time = new DateTime(date("Y-m-d"));
              $batas_waktu_date_time = new DateTime($data_peminjaman['batas_waktu']);
              $tanggal_kembali = new DateTime($data_peminjaman['tanggal_kembali']);
            if($data_peminjaman['status_peminjaman']==0){
              $selisih = $sekarang_date_time->diff($batas_waktu_date_time)->days;
              $keterangan = ($data_peminjaman['batas_waktu']<date("Y-m-d")?"<span class=\"label label-danger\">Telat $selisih Hari</span>":"-");
            }else{
              $selisih = $tanggal_kembali->diff($batas_waktu_date_time)->days;
              $keterangan = ($data_peminjaman['batas_waktu']<$data_peminjaman['tanggal_kembali']?"<span class=\"label label-danger\">Telat $selisih Hari</span>":"-");
            }
            ?>
            <?= $keterangan ?>
            </td>
        </tr>
        <?php
        $no++;
      }
      ?>
  </tbody>
</table>
</div>
</div>
    </section>
    <!-- /.content -->
<?php } ?>