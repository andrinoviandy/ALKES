<?php
if (isset($_POST['tambah_spk_masuk'])) {
	$Result = mysqli_query($koneksi, "update alat_pelatihan set banyak_peserta='".$_POST['peserta']."', pelatih='".$_POST['pelatih']."', tgl_pelatihan='".$_POST['tgl_pelatihan']."', pelatihan_oleh='".$_POST['pelatihan_oleh']."' where id=".$_GET['id']."");
	
	if ($Result) {		
		echo "<script type='text/javascript'>
		alert('Silakan Update Data Peserta !');
	window.location='index.php?page=tambah_peserta_pelatihan&id=$_GET[id]';
		</script>";
		}
	}

if (isset($_POST['tambahteknisibaru'])) {
	$dat=mysqli_num_rows(mysqli_query($koneksi, "select * from tb_teknisi where nama_teknisi='".$_POST['nama_teknisi']."'"));
	if ($dat==0) {
	$Result = mysqli_query($koneksi, "insert into tb_teknisi values('','".$_POST['nama_teknisi']."','".$_POST['bidang']."','".$_POST['no_str']."','".$_POST['no_hp']."','".$_POST['username']."','".md5($_POST['password'])."','".$_POST['nama_teknisi']."-".$_FILES['ijazah']['name']."','".$_POST['nama_teknisi']."-".$_FILES['sertifikat']['name']."')");
	if ($Result) {
		copy($_FILES['ijazah']['tmp_name'], "ijazah_teknisi/".$_POST['nama_teknisi']."-".$_FILES['ijazah']['name']);
		copy($_FILES['sertifikat']['tmp_name'], "ijazah_teknisi/sertifikat/".$_POST['nama_teknisi']."-".$_FILES['sertifikat']['name']);
		echo "<script type='text/javascript'>
		alert('Teknisi Berhasil Di Tambah !');
		window.location='index.php?page=tambah_spk_masuk'
		</script>";
		}
	} else {
		echo "<script type='text/javascript'>
		alert('Nama Teknisi Sudah Ada !');
		window.location='index.php?page=tambah_spk_masuk#tambahTeknisi'
		</script>";
		}
}
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Ringkasan
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Ringkasan</li></ol></section>


    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) --><!-- /.row -->
      <!-- Main row -->
      <form method="post" enctype="multipart/form-data">
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-6 connectedSortable">
          <!-- Custom tabs (Charts with tabs)--><!-- /.nav-tabs-custom -->

          <!-- Chat box -->
          <div class="box box-success"><!-- /.chat -->
            <h3 align="center">Neraca</h3>
            <div class="box-footer">
            <div class="box-header with-border" style="background-color:#FC9">
              <h3 class="box-title"><strong>Aset</strong></h3>
              <h3 class="box-title pull pull-right">
                  <strong><?php 
				  $aset1=mysqli_fetch_array(mysqli_query($koneksi, "select sum(saldo) as total from buku_kas"));
				  $aset11_d=mysqli_fetch_array(mysqli_query($koneksi, "select sum(saldo) as total from keuangan,keuangan_detail,coa,coa_sub where keuangan.id=keuangan_detail.keuangan_id and coa.id=keuangan_detail.coa_id and coa_sub.id=keuangan_detail.coa_sub_id and db_cr='db' and coa.id=1"));
				  $aset11_c=mysqli_fetch_array(mysqli_query($koneksi, "select sum(saldo) as total from keuangan,keuangan_detail,coa,coa_sub where keuangan.id=keuangan_detail.keuangan_id and coa.id=keuangan_detail.coa_id and coa_sub.id=keuangan_detail.coa_sub_id and db_cr='cr' and coa.id=1"));
				  echo number_format($aset1['total']+($aset11_d['total']-$aset11_c['total']),2,',','.'); ?>
                  </strong></h3>
            </div>
              <div class="box-body">
              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  Kas di Bank<font class="pull-right">
                  <a href="index.php?page=buku_bank"><?php 
				  $aset2=mysqli_fetch_array(mysqli_query($koneksi, "select sum(saldo) as total from buku_kas where tipe_akun='BANK'"));
				  echo number_format($aset2['total'],2,',','.'); ?>
                  </a></font></li>
                <li class="list-group-item">
                  Kas di Tangan
                  <font class="pull-right">
				  <a href="index.php?page=buku_kas"><?php 
				  $aset3=mysqli_fetch_array(mysqli_query($koneksi, "select sum(saldo) as total from buku_kas where tipe_akun='KAS'"));
				  echo number_format($aset3['total'],2,',','.'); ?></a></font>
                  
                </li>
                <?php 
				$q_coa = mysqli_query($koneksi, "select * from coa_sub where coa_id=1");
				while ($d_coa=mysqli_fetch_array($q_coa)) {
				?>
                <li class="list-group-item">
                  <?php echo $d_coa['nama_sub_grup']; ?>
                  <font class="pull-right">
                  <a href="index.php?page=lihat_ringkasan_aset&judul=<?php echo $d_coa['nama_sub_grup']; ?>&id=<?php echo $d_coa['id']; ?>">
				  <?php 
				  $saldo1 = mysqli_fetch_array(mysqli_query($koneksi, "select sum(saldo) as total from keuangan,keuangan_detail where keuangan.id=keuangan_detail.keuangan_id and db_cr='db' and coa_sub_id=$d_coa[id]"));
				  $saldo2 = mysqli_fetch_array(mysqli_query($koneksi, "select sum(saldo) as total from keuangan,keuangan_detail where keuangan.id=keuangan_detail.keuangan_id and db_cr='cr' and coa_sub_id=$d_coa[id]"));
				  echo number_format($saldo1['total']-$saldo2['total'],2,',','.');
				  ?></a>
                  </font>
                </li>
                <?php } ?>
              </ul>                                 
              </div>
              <div class="box-header with-border" style="background-color:#FC9">
              <h3 class="box-title"><strong>Dikurangi Kewajiban</strong></h3><h3 class="box-title pull pull-right">
                  <strong><?php 
				  $kewajiban1=mysqli_fetch_array(mysqli_query($koneksi, "select sum(saldo) as total from keuangan,keuangan_detail,coa,coa_sub where keuangan.id=keuangan_detail.keuangan_id and coa.id=keuangan_detail.coa_id and coa_sub.id=keuangan_detail.coa_sub_id and db_cr='db' and coa.id=2"));
				  $kewajiban2=mysqli_fetch_array(mysqli_query($koneksi, "select sum(saldo) as total from keuangan,keuangan_detail,coa,coa_sub where keuangan.id=keuangan_detail.keuangan_id and coa.id=keuangan_detail.coa_id and coa_sub.id=keuangan_detail.coa_sub_id and db_cr='cr' and coa.id=2"));
				  echo number_format($kewajiban1['total']-$kewajiban2['total'],2,',','.'); ?>
                  </strong></h3>
            </div>
              <div class="box-body">
              <ul class="list-group list-group-unbordered">
                <?php 
				$q_coa2 = mysqli_query($koneksi, "select * from coa_sub where coa_id=2");
				while ($d_coa=mysqli_fetch_array($q_coa2)) {
				?>
                <li class="list-group-item">
                  <?php echo $d_coa['nama_sub_grup']; ?><font class="pull-right"><a href="index.php?page=lihat_ringkasan_kewajiban&judul=<?php echo $d_coa['nama_sub_grup']; ?>&id=<?php echo $d_coa['id']; ?>">
                  <?php 
				  $saldo2_db = mysqli_fetch_array(mysqli_query($koneksi, "select sum(saldo) as total from keuangan,keuangan_detail where keuangan.id=keuangan_detail.keuangan_id and db_cr='db' and coa_sub_id=$d_coa[id]"));
				  $saldo2_cr = mysqli_fetch_array(mysqli_query($koneksi, "select sum(saldo) as total from keuangan,keuangan_detail where keuangan.id=keuangan_detail.keuangan_id and db_cr='cr' and coa_sub_id=$d_coa[id]"));
				  echo number_format($saldo2_db['total']-$saldo2_cr['total'],2,',','.');
				  ?>
                  </a></font></li>
                <?php } ?>
              </ul>                                 
              </div>
              <div class="box-header with-border" style="background-color:#FC9">
              <h3 class="box-title"><strong>Ekuitas</strong></h3>
              <h3 class="box-title pull pull-right">
                  <strong><?php 
				  $ekuitas_1=mysqli_fetch_array(mysqli_query($koneksi, "select sum(saldo) as total from keuangan,keuangan_detail,coa,coa_sub where keuangan.id=keuangan_detail.keuangan_id and coa.id=keuangan_detail.coa_id and coa_sub.id=keuangan_detail.coa_sub_id and coa.id=3 and db_cr='db'"));
				  $ekuitas_2=mysqli_fetch_array(mysqli_query($koneksi, "select sum(saldo) as total from keuangan,keuangan_detail,coa,coa_sub where keuangan.id=keuangan_detail.keuangan_id and coa.id=keuangan_detail.coa_id and coa_sub.id=keuangan_detail.coa_sub_id and coa.id=3 and db_cr='cr'"));
				  echo number_format($ekuitas_1['total']-$ekuitas_2['total'],2,',','.');
				  //echo number_format(($aset1['total']+($aset11_c['total']-$aset11_d['total'])-($kewajiban1['total']-$kewajiban2['total'])),2,',','.');
				  ?>
                  </strong></h3>
            </div>
              <div class="box-body">
              <ul class="list-group list-group-unbordered">
                <?php 
				$q_coa3 = mysqli_query($koneksi, "select * from coa_sub where coa_id=3");
				while ($d_coa=mysqli_fetch_array($q_coa3)) {
				?>
                <li class="list-group-item">
                  <?php echo $d_coa['nama_sub_grup']; ?>
                  <font class="pull-right">
				  <a href="index.php?page=lihat_ringkasan_ekuitas&judul=<?php echo $d_coa['nama_sub_grup']; ?>&id=<?php echo $d_coa['id']; ?>">
				  <?php 
				  $saldo3_1 = mysqli_fetch_array(mysqli_query($koneksi, "select sum(saldo) as total from keuangan,keuangan_detail where keuangan.id=keuangan_detail.keuangan_id and coa_sub_id=$d_coa[id] and db_cr='db'"));
				  $saldo3_2 = mysqli_fetch_array(mysqli_query($koneksi, "select sum(saldo) as total from keuangan,keuangan_detail where keuangan.id=keuangan_detail.keuangan_id and coa_sub_id=$d_coa[id] and db_cr='cr'"));
				  echo number_format($saldo3_1['total']-$saldo3_2['total'],2,',','.');
				  ?>
                  </a>
                  </font>
                </li>
                <?php } ?>
              </ul>                                 
              </div>
            </div>
          </div>
          </section>
        <section class="col-lg-6 connectedSortable">
          <!-- Custom tabs (Charts with tabs)--><!-- /.nav-tabs-custom -->

          <!-- Chat box -->
          <div class="box box-success"><!-- /.chat -->
            <h3 align="center">Laporan Laba Rugi</h3>
            <div class="box-footer">
            <div class="box-header with-border" style="background-color:#FC9">
              <h3 class="box-title"><strong>Pemasukan</strong></h3>
              <h3 class="box-title pull pull-right">
                  <strong><?php 
				  $pemasukan=mysqli_fetch_array(mysqli_query($koneksi, "select sum(saldo) as total from keuangan,keuangan_detail,coa,coa_sub where keuangan.id=keuangan_detail.keuangan_id and coa.id=keuangan_detail.coa_id and coa_sub.id=keuangan_detail.coa_sub_id and coa.id=4"));
				  echo number_format($pemasukan['total'],2,',','.'); ?>
                  </strong></h3>
            </div>
              <div class="box-body">
              <ul class="list-group list-group-unbordered">
                <?php 
				$q_coa4 = mysqli_query($koneksi, "select * from coa_sub where coa_id=4");
				while ($d_coa=mysqli_fetch_array($q_coa4)) {
				?>
                <li class="list-group-item">
                  <?php echo $d_coa['nama_sub_grup']; ?>
                  <font class="pull-right">
				  <a href="index.php?page=lihat_ringkasan&judul=<?php echo $d_coa['nama_sub_grup']; ?>&id=<?php echo $d_coa['id']; ?>">
				  <?php 
				  $saldo4 = mysqli_fetch_array(mysqli_query($koneksi, "select sum(saldo) as total from keuangan,keuangan_detail where keuangan.id=keuangan_detail.keuangan_id and keuangan_detail.coa_sub_id=$d_coa[id]"));
				  echo number_format($saldo4['total'],2,',','.');
				  ?>
                  </a>
                  </font>
                </li>
                <?php } ?>
              </ul>                                 
              </div>
              <div class="box-header with-border" style="background-color:#FC9">
              <h3 class="box-title"><strong>Dikurangi Pengeluaran</strong></h3>
              <h3 class="box-title pull pull-right">
                  <strong><?php 
				  $pengeluaran=mysqli_fetch_array(mysqli_query($koneksi, "select sum(saldo) as total from keuangan,keuangan_detail,coa,coa_sub where keuangan.id=keuangan_detail.keuangan_id and coa.id=keuangan_detail.coa_id and coa_sub.id=keuangan_detail.coa_sub_id and coa.id=5"));
				  echo number_format($pengeluaran['total'],2,',','.'); ?>
                  </strong></h3>
            </div>
              <div class="box-body">
              <ul class="list-group list-group-unbordered">
                <?php 
				$q_coa5 = mysqli_query($koneksi, "select * from coa_sub where coa_id=5");
				while ($d_coa=mysqli_fetch_array($q_coa5)) {
				?>
                <li class="list-group-item">
                  <?php echo $d_coa['nama_sub_grup']; ?>
                  <font class="pull-right">
				  <a href="index.php?page=lihat_ringkasan&judul=<?php echo $d_coa['nama_sub_grup']; ?>&id=<?php echo $d_coa['id']; ?>">
				  <?php 
				  $saldo5 = mysqli_fetch_array(mysqli_query($koneksi, "select sum(saldo) as total from keuangan,keuangan_detail where keuangan.id=keuangan_detail.keuangan_id and coa_sub_id=$d_coa[id]"));
				  echo number_format($saldo5['total'],2,',','.');
				  ?>
                  </a>
                  </font>
                </li>
                <?php } ?>
              </ul>                                 
              </div>
              <div class="box-header with-border" style="background-color:#FC9">
              <h3 class="box-title"><strong>
              <?php if ($pemasukan['total']-$pengeluaran['total']<0) {echo "Rugi Bersih";} else {echo "Laba Bersih";} ?></strong></h3>
              <h3 class="box-title pull pull-right">
                  <strong><?php 
				  echo number_format($pemasukan['total']-$pengeluaran['total'],2,',','.'); ?>
                  </strong></h3>
            </div>
            </div>
          </div>
          </section>
        <!-- right col -->
      </div>
      </form>
      <!-- /.row (main row) -->

  </section>
  <select>
  <option></option>
  </select>
    <!-- /.content -->
  </div>
  <?php 
  if (isset($_POST['simpan_1'])) {
	$id=$_GET['id'];
	$max = mysqli_fetch_array(mysqli_query($koneksi, "select max(id)+1 as maks from alat_pelatihan"));
	$ext = explode(".",$_FILES['lamp1']['name']);
	$ext2 = explode(".",$_FILES['lamp2']['name']);
	$lamp1="Lampiran1_".$max['maks'].".".$ext[1];
	$lamp2="Lampiran2_".$max['maks'].".".$ext2[1];
	  $R = mysqli_query($koneksi, "update alat_pelatihan set lamp1='$lamp1' where id=$id");
	  if ($R) {
		  copy($_FILES['lamp1']['tmp_name'], "gambar_pelatihan/lampiran1/$lamp1");
		  echo "<script type='text/javascript'>
		  window.location='index.php?page=ubah_latih&id=$id';
		</script>";
		  }
	  }

if (isset($_POST['simpan_2'])) {
	$id=$_GET['id'];
	$max = mysqli_fetch_array(mysqli_query($koneksi, "select max(id)+1 as maks from alat_pelatihan"));
	$ext = explode(".",$_FILES['lamp1']['name']);
	$ext2 = explode(".",$_FILES['lamp2']['name']);
	$lamp1="Lampiran1_".$max['maks'].".".$ext[1];
	$lamp2="Lampiran2_".$max['maks'].".".$ext2[1];
	  $R = mysqli_query($koneksi, "update alat_pelatihan set lamp2='$lamp2' where id=$id");
	  if ($R) {
		  copy($_FILES['lamp2']['tmp_name'], "gambar_pelatihan/lampiran2/$lamp2");
		  echo "<script type='text/javascript'>
		  window.location='index.php?page=ubah_latih&id=$id';
		</script>";
		  }
	  }
  ?>
  <div id="open1" class="modalDialog">
     <div>
        <a href="#" title="Close" class="close">X</a>
        <h3 align="center">Ubah Lampiran 1</h3> 
     <form method="post" enctype="multipart/form-data">
     <input id="input" name="lamp1" type="file" style="background-color:#FFF"/>
        <button id="buttonn" name="simpan_1" type="submit">Simpan</button>
    </form>
    </div>
</div>

<div id="open2" class="modalDialog">
     <div>
        <a href="#" title="Close" class="close">X</a>
        <h3 align="center">Ubah Lampiran 2</h3> 
     <form method="post" enctype="multipart/form-data">
     <input id="input" name="lamp2" type="file" style="background-color:#FFF"/>
        <button id="buttonn" name="simpan_2" type="submit">Simpan</button>
    </form>
    </div>
</div>
  
  