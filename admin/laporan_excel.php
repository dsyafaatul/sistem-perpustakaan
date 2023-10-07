<?php
//created by dsyafaatul
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=LAPORAN ".strtoupper($_GET['laporan']).".xls");
include('koneksi.php');
$laporan = $_GET['laporan'];
if(isset($laporan)){
	if($laporan=="peminjaman"){
		?>
          <table border="1">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Judul Buku</th>
                    <th>Siswa</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Batas waktu</th>
                    <th>Status</th>
                    <th>Ket</th>
                    <th>denda</th>
                  </tr>
                </thead>
                <?php
                $range = $_GET['range'];
                if(!empty($range)){
                ?>
                <tbody>
                  <?php
                  $no = 1;
                  $range = explode("-",trim($_GET['range']));
                  $start = date("Y/m/d",strtotime($range[0]));
                  $end = date("Y/m/d",strtotime($range[1]));
                  $id_kelas = $_GET['id_kelas'];
                  $status = $_GET['status'];
                  if(!empty($id_kelas) AND empty($status)){
                  $data_peminjaman_query = mysql_query("SELECT tabel_peminjaman.*,tabel_siswa.*,tabel_kelas.*,tabel_penjaga.*,tabel_buku.*,tabel_peminjaman.status as status_peminjaman FROM tabel_peminjaman,tabel_siswa,tabel_kelas,tabel_penjaga,tabel_buku WHERE tabel_siswa.nis=tabel_peminjaman.nis AND tabel_penjaga.id_penjaga=tabel_peminjaman.id_penjaga AND tabel_buku.kode_buku=tabel_peminjaman.kode_buku AND tabel_siswa.id_kelas=tabel_kelas.id_kelas AND tabel_kelas.id_kelas='$id_kelas' AND tanggal_pinjam BETWEEN '$start' AND '$end' ORDER BY tabel_peminjaman.tanggal_pinjam ASC");
                  }else
                  if(empty($id_kelas) AND !empty($status)){
                    $status = ($_GET['status']=='y')?1:0;
                    $data_peminjaman_query = mysql_query("SELECT tabel_peminjaman.*,tabel_siswa.*,tabel_kelas.*,tabel_penjaga.*,tabel_buku.*,tabel_peminjaman.status as status_peminjaman FROM tabel_peminjaman,tabel_siswa,tabel_kelas,tabel_penjaga,tabel_buku WHERE tabel_siswa.nis=tabel_peminjaman.nis AND tabel_penjaga.id_penjaga=tabel_peminjaman.id_penjaga AND tabel_buku.kode_buku=tabel_peminjaman.kode_buku AND tabel_siswa.id_kelas=tabel_kelas.id_kelas AND tabel_peminjaman.status='$status' AND tanggal_pinjam BETWEEN '$start' AND '$end' ORDER BY tabel_peminjaman.tanggal_pinjam ASC");
                  }else
                  if(empty($id_kelas) AND empty($status)){
                    $data_peminjaman_query = mysql_query("SELECT tabel_peminjaman.*,tabel_siswa.*,tabel_kelas.*,tabel_penjaga.*,tabel_buku.*,tabel_peminjaman.status as status_peminjaman FROM tabel_peminjaman,tabel_siswa,tabel_kelas,tabel_penjaga,tabel_buku WHERE tabel_siswa.nis=tabel_peminjaman.nis AND tabel_penjaga.id_penjaga=tabel_peminjaman.id_penjaga AND tabel_buku.kode_buku=tabel_peminjaman.kode_buku AND tabel_siswa.id_kelas=tabel_kelas.id_kelas AND tanggal_pinjam BETWEEN '$start' AND '$end' ORDER BY tabel_peminjaman.tanggal_pinjam ASC");
                    }else
                    if(!empty($id_kelas) AND !empty($status)){
                      $status = ($_GET['status']=='y')?1:0;
                      $data_peminjaman_query = mysql_query("SELECT tabel_peminjaman.*,tabel_siswa.*,tabel_kelas.*,tabel_penjaga.*,tabel_buku.*,tabel_peminjaman.status as status_peminjaman FROM tabel_peminjaman,tabel_siswa,tabel_kelas,tabel_penjaga,tabel_buku WHERE tabel_siswa.nis=tabel_peminjaman.nis AND tabel_penjaga.id_penjaga=tabel_peminjaman.id_penjaga AND tabel_buku.kode_buku=tabel_peminjaman.kode_buku AND tabel_siswa.id_kelas=tabel_kelas.id_kelas AND tabel_kelas.id_kelas='$id_kelas' AND tabel_peminjaman.status=$status AND tanggal_pinjam BETWEEN '$start' AND '$end' ORDER BY tabel_peminjaman.tanggal_pinjam ASC");
                    }
                    while($data_peminjaman = mysql_fetch_array($data_peminjaman_query)){
                    $status = ($data_peminjaman['status_peminjaman']=="0"?"Belum Kembali":"Sudah Kembali");
                    $keterangan = ($data_peminjaman['keterangan']=="0"?"Telat":"");
                      ?>
                      <tr>
                        <td><?= $no ?></td>
                        <td><?= $data_peminjaman['judul_buku'] ?></td>
                        <td><?= $data_peminjaman['nama_siswa'] ?></td>
                        <td><?= $data_peminjaman['tanggal_pinjam']   ?></td>
                        <td><?= $data_peminjaman['tanggal_kembali']   ?></td>
                        <td><?= $data_peminjaman['batas_waktu'] ?></td>
                        <td><?= $status ?></td>
                        <td><?= $keterangan ?></td>
                        <td><?= $data_peminjaman['denda'] ?></td>
                      </tr>
                      <?php
                      $no++;
                    }
                    ?>
                </tbody>
                <?php
                }else{
                ?>
                <tbody>
                  <?php
                  $no = 1;
                  $data_peminjaman_query = mysql_query("SELECT tabel_peminjaman.*,tabel_siswa.*,tabel_penjaga.*,tabel_buku.* FROM tabel_peminjaman,tabel_siswa,tabel_penjaga,tabel_buku WHERE tabel_siswa.nis=tabel_peminjaman.nis AND tabel_penjaga.id_penjaga=tabel_peminjaman.id_penjaga AND tabel_buku.kode_buku=tabel_peminjaman.kode_buku AND tanggal_pinjam=CURDATE() ORDER BY tanggal_pinjam ASC");
                    while($data_peminjaman = mysql_fetch_array($data_peminjaman_query)){
                    $status = ($data_peminjaman['status_peminjaman']=="0"?"Belum Kembali":"Sudah Kembali");
                    $keterangan = ($data_peminjaman['keterangan']=="0"?"Telat":"");
                      ?>
                      <tr>
                        <td><?= $no ?></td>
                        <td><?= $data_peminjaman['judul_buku'] ?></td>
                        <td><?= $data_peminjaman['nama_siswa'] ?></td>
                        <td><?= $data_peminjaman['tanggal_pinjam']   ?></td>
                        <td><?= $data_peminjaman['tanggal_kembali']   ?></td>
                        <td><?= $data_peminjaman['batas_waktu'] ?></td>
                        <td><?= $status ?></td>
                        <td><?= $keterangan ?></td>
                        <td><?= $data_peminjaman['denda'] ?></td>
                      </tr>
                      <?php
                      $no++;
                    }
                    ?>
                </tbody>
                <?php
                }
                ?>
              </table>
		<?php
	}else if($laporan=="buku"){
		?>
		<table border="1">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Judul</th>
                    <th>Pengarang</th>
                    <th>Penerbit</th>
                    <th>Tahun Terbit</th>
                    <th>Kategori</th>
                    <th>Stok</th>
                    <th>Dipinjam</th>
                    <th>Tanggal Masuk</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  $data_buku_query = mysql_query("SELECT tabel_buku.*,tabel_kategori.* FROM tabel_buku,tabel_kategori WHERE tabel_buku.id_kategori=tabel_kategori.id_kategori ORDER BY tabel_buku.judul_buku");
                    while($data_buku = mysql_fetch_array($data_buku_query)){
                      $sisa = $data_buku['stok']-(mysql_num_rows(mysql_query("SELECT * FROM tabel_peminjaman WHERE kode_buku='$data_buku[kode_buku]' AND status='0'")));
                      $dipinjam = mysql_num_rows(mysql_query("SELECT * FROM tabel_peminjaman WHERE kode_buku='$data_buku[kode_buku]' AND status='0'"));
                      ?>
                      <tr>
                        <td><?= $no ?></td>
                        <td><?= $data_buku['kode_buku'] ?></td>
                        <td><?= $data_buku['judul_buku'] ?></td>
                        <td><?= $data_buku['pengarang'] ?></td>
                        <td><?= $data_buku['penerbit'] ?></td>
                        <td><?= $data_buku['tahun_terbit'] ?></td>
                        <td><?= $data_buku['nama_kategori'] ?></td>
                        <td><?= $sisa ?></td>
                        <td><?= $dipinjam ?></td>
                        <td><?= $data_buku['tanggal_masuk'] ?></td>
                      </tr>
                      <?php
                      $no++;
                    }
                    ?>
                </tbody>
              </table>
		<?php
	}else if($laporan=="buku_kas"){
		?>
		<table border="1">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Penjaga</th>
                    <th>Keterangan</th>
                    <th>Masuk</th>
                    <th>Keluar</th>
                    <th>Tanggal</th>
                    <th>Saldo</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $saldo = 0;
                  $data_buku_kas_query = mysql_query("SELECT *,tabel_buku_kas.status as status_buku_kas FROM tabel_buku_kas,tabel_penjaga WHERE tabel_buku_kas.id_penjaga=tabel_penjaga.id_penjaga ORDER BY id ASC");
                  $hitung = mysql_num_rows($data_buku_kas_query);
                  $no = 1;
                    while($data_buku_kas = mysql_fetch_array($data_buku_kas_query)){
                      if($data_buku_kas['status_buku_kas']==0){
                        if($hitung>1){
                          $saldo = $saldo-$data_buku_kas['uang'];
                        }else{
                          $saldo = $data_buku_kas['uang'];
                        }
                      }else{
                        $saldo = $saldo+$data_buku_kas['uang'];
                      }
                      ?>
                      <tr>
                        <td><?= $no ?></td>
                        <td><?= $data_buku_kas['nama_penjaga'] ?></td>
                        <td><?= $data_buku_kas['keterangan'] ?></td>
                        <td><?= ($data_buku_kas['status_buku_kas']==1)?$data_buku_kas['uang']:"" ?></td>
                        <td><?= ($data_buku_kas['status_buku_kas']==0)?$data_buku_kas['uang']:"" ?></td>
                        <td><?= $data_buku_kas['tanggal'] ?></td>
                        <td><?= $saldo ?></td>
                      </tr>
                      <?php
                      $no++;
                    }
                    ?>
                </tbody>
              </table>
		<?php
	}else if($laporan=="penjaga"){
		?>
		<table border="1">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>username</th>
                    <th>Jenis Kelamin</th>
                    <th>No Telepon</th>
                    <th>Alamat</th>
                    <th>Level</th>
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
                        <td><?= $no ?></td>
                        <td><?= $data_penjaga['nama_penjaga'] ?></td>
                        <td><?= $data_penjaga['username'] ?></td>
                        <td><?= $jenis_kelamin ?></td>
                        <td>'<?= $data_penjaga['no_telepon'] ?></td>
                        <td><?= $data_penjaga['alamat'] ?></td>
                        <td><?= $data_penjaga['level'] ?></td>
                      </tr>
                      <?php
                      $no++;
                    }
                    ?>
                </tbody>
              </table>
		<?php
	}else if($laporan=="siswa"){
		?>
		<table border="1">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nis</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Jenis Kelamin</th>
                    <th>No Telepon</th>
                    <th>Alamat</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  $data_siswa_query = mysql_query("SELECT tabel_siswa.*,tabel_kelas.* FROM tabel_siswa,tabel_kelas WHERE tabel_siswa.id_kelas=tabel_kelas.id_kelas ORDER BY nama_siswa");
                    while($data_siswa = mysql_fetch_array($data_siswa_query)){
                    $jenis_kelamin = ($data_siswa['jenis_kelamin']=="L"?"Laki-Laki":"Perempuan");
                      ?>
                      <tr>
                        <td><?= $no ?></td>
                        <td>'<?= $data_siswa['nis'] ?></td>
                        <td><?= $data_siswa['nama_siswa'] ?></td>
                        <td><?= $data_siswa['tingkat']." ".$data_siswa['jurusan'] ?></td>
                        <td><?= $jenis_kelamin ?></td>
                        <td>'<?= $data_siswa['no_telepon'] ?></td>
                        <td><?= $data_siswa['alamat'] ?></td>
                      </tr>
                      <?php
                      $no++;
                    }
                    ?>
                </tbody>
              </table>
		<?php
	}else{
		header("Location: index.php");
	}
}
?>