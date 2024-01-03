<?php
if (isset($_POST['buat_training'])) {
		  $nama_lamp1=($_FILES["lamp1"]["name"]);
		  $fisik_lamp1=($_FILES["lamp1"]["tmp_name"]);
		  $nama_lamp2=($_FILES["lamp2"]["name"]);
		  $fisik_lamp2=($_FILES["lamp2"]["tmp_name"]);
		  $queri = mysqli_query($koneksi, "INSERT INTO pelatihan_alat values('','".$_GET['id']."','".$_POST['peserta']."','".$_POST['pelatih']."','".$_POST['tgl_pelatihan']."','".$nama_lamp1."','".$nama_lamp2."')");
		  
		  if ($queri) {
			copy($fisik_lamp1, "gambar_pelatihan/".$nama_lamp1);
		  copy($fisik_lamp2, "gambar_pelatihan/".$nama_lamp2);
		  echo "<script type='text/javascript'>
	window.location='index.php?page=uji_fungsi_instalasi';
		  </script>";
		  } else { 	
			echo "<script type='text/javascript'>
			alert('Gagal Disimpan');
	window.location='index.php?page=uji_fungsi_instalasi';
		  </script>";
		}
	}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Instalasi & Uji Fungsi</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Uji Fungsi &amp; Instalasi</li>
      </ol>
    </section>


    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) --><!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
          <!-- Custom tabs (Charts with tabs)--><!-- /.nav-tabs-custom -->

          <!-- Chat box -->
          <div class="box box-success"><!-- /.chat -->
            <div class="box-footer">
              <div class="box-body table-responsive no-padding">
              <div class="">
              <!--<a href="index.php?page=tambah_barang_masuk"><button name="tambah_laporan" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Tambah Barang</button></a><br />-->
              <form method="post">
              <div class="input-group pull pull-left col-xs-1">
                
                <select class="form-control" name="limiterr" style="margin-right:40px">
                <option <?php if ($limiter['limiter']==10) {echo "selected";} ?> value="10">10</option>
                <option <?php if ($limiter['limiter']==50) {echo "selected";} ?> value="50">50</option>
                <option <?php if ($limiter['limiter']==100) {echo "selected";} ?> value="100">100</option>
                <option <?php if ($limiter['limiter']==500) {echo "selected";} ?> value="500">500</option>
                <option <?php if ($limiter['limiter']==1000) {echo "selected";} ?> value="1000">1000</option>
                <?php 
				$total=mysqli_num_rows(mysqli_query($koneksi, "select * from barang_gudang"));
				?>
                <option <?php if ($limiter['limiter']==$total) {echo "selected";} ?> <?php if ($_POST['cari']!='') {echo "selected";} ?> value="<?php echo $total; ?>">All</option>
                </select>
                
                <span class="input-group-btn">
                      <button type="submit" name="button_limit" class="btn btn-default btn-flat"><i class="fa fa-check"></i></button>
                    </span>
                
              </div>
              </form>
              
              <form method="post">
              <div class="input-group pull pull-left col-xs-2">
                
                <select class="form-control" name="urutt" style="margin-right:40px">
                <option <?php if ($limiter['urut']=='ASC') {echo "selected";} ?> value="ASC">Ascending</option>
                <option <?php if ($limiter['urut']=='DESC') {echo "selected";} ?> value="DESC">Descending</option>
                
                </select>
                
                <span class="input-group-btn">
                      <button type="submit" name="button_urut" class="btn btn-default btn-flat"><i class="fa fa-check"></i></button>
                    </span>
                
              </div>
              </form>
              <!--
              <form method="post" class="">
              <div class="input-group input-group-md col-xs-4 pull pull-right">
                <input type="text" name="cari" placeholder="Keyword....." class="form-control">
                    <span class="input-group-btn">
                      <button type="submit" name="button_cari" class="btn btn-info btn-flat"><i class="fa fa-search"></i> Cari </button>
                    </span>
              </div>
              </form>--><br /><br />
                <table width="100%" id="example1" class="table table-bordered table-hover">
  <thead>
    <tr>
      <td align="center">&nbsp;</th>
        
        <th><strong>Nama Alkes</strong></th>
        <th>No Seri</th>
        
      <th>Nama RS/Dinas/Pusk./dll</th>
      <th>Teknisi</th>
      <th>Versi Software</th>
      
      <th>Tgl Garansi Habis</th>
      <th><strong>Tgl Instalasi</strong></th>
      <th align="center"><strong>Lampiran</strong></th>
      <th align="center"><strong>Tgl Uji Fungsi</strong></th>
      <th align="center"><strong>Lampiran</strong></th>
      <td align="center"><strong>Aksi</strong></th>
        </tr>
  </thead>
  <?php
  if (isset($_SESSION['id_b'])) {
	  if (isset($_GET['id_lihat'])) {
	  $query = mysqli_query($koneksi, "select *,alat_uji.id as idd from alat_uji,barang_teknisi,barang_dikirim,barang_dijual,barang_dijual_detail, barang_gudang,pembeli where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dijual_detail.barang_gudang_detail_id and barang_dijual.id=barang_dijual_detail.barang_dijual_id and barang_dijual.id=barang_dikirim.barang_dijual_id and pembeli.id=barang_dijual.pembeli_id and barang_dikirim.id=barang_teknisi.barang_dikirim_id and barang_teknisi.id=alat_uji.barang_teknisi_id and barang_teknisi.teknisi_id=".$_SESSION['id_b']." and alat_uji.barang_teknisi_id=".$_GET['id_lihat']." order by alat_uji.id ".$limiter['urut'].""); 
  } else {
	  $query = mysqli_query($koneksi, "select *,alat_uji.id as idd from alat_uji,barang_teknisi,barang_dikirim,barang_dijual,barang_dijual_detail, barang_gudang,pembeli where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dijual_detail.barang_gudang_detail_id and barang_dijual.id=barang_dijual_detail.barang_dijual_id and barang_dijual.id=barang_dikirim.barang_dijual_id and pembeli.id=barang_dijual.pembeli_id and barang_dikirim.id=barang_teknisi.barang_dikirim_id and barang_teknisi.id=alat_uji.barang_teknisi_id and barang_teknisi.teknisi_id=".$_SESSION['id_b']." order by alat_uji.id ".$limiter['urut']." LIMIT ".$limiter['limiter']."");
  }
	  }
	  
	  
	  
  else {
  if (isset($_GET['id_lihat'])) {
	  $query = mysqli_query($koneksi, "select *,alat_uji.id as idd from alat_uji,barang_teknisi,barang_dikirim,barang_dijual,barang_dijual_detail, barang_gudang,barang_gudang_detail,pembeli where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dijual_detail.barang_gudang_detail_id and barang_dijual.id=barang_dijual_detail.barang_dijual_id and barang_dijual.id=barang_dikirim.barang_dijual_id and pembeli.id=barang_dijual.pembeli_id and barang_dikirim.id=barang_teknisi.barang_dikirim_id and barang_teknisi.id=alat_uji.barang_teknisi_id and alat_uji.barang_teknisi_id=".$_GET['id_lihat']." order by alat_uji.id ".$limiter['urut'].""); 
  } else {
	  $query = mysqli_query($koneksi, "select *,alat_uji.id as idd from alat_uji,barang_teknisi,barang_dikirim,barang_dijual,barang_dijual_detail, barang_gudang,barang_gudang_detail,pembeli where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dijual_detail.barang_gudang_detail_id and barang_dijual.id=barang_dijual_detail.barang_dijual_id and barang_dijual.id=barang_dikirim.barang_dijual_id and pembeli.id=barang_dijual.pembeli_id and barang_dikirim.id=barang_teknisi.barang_dikirim_id and barang_teknisi.id=alat_uji.barang_teknisi_id order by alat_uji.id ".$limiter['urut']." LIMIT ".$limiter['limiter']."");
  }
  }
  $no=0;
  while ($data = mysqli_fetch_assoc($query)) { 
  $no++;
  ?>
  <tr>
    <td align="center"><?php echo $no; ?></td>
    <td>
    <?php 
	$tt=mysqli_num_rows(mysqli_query($koneksi, "select * from alat_pelatihan where uji_id=".$data['idd'].""));
	if ($tt!=0) {
	?>
    <a href="index.php?page=pelatihan_alat&id_lihat_alat=<?php echo $data['idd']; ?>" data-toggle="tooltip" title="Lihat Pelatihan Alat"><?php echo $data['nama_brg']; ?></a>
    <?php } else { echo $data['nama_brg']; }?>
    </td>
    <td><?php echo $data['no_seri_brg']; ?></td>
    
    <td><?php echo $data['nama_pembeli']; ?></td>    
    <td><?php 
	$tek = mysqli_fetch_array(mysqli_query($koneksi, "select * from tb_teknisi where id=".$data['teknisi_id'].""));
	echo $tek['nama_teknisi']; ?></td>
    <td><?php echo $data['soft_version']; ?></td>
   
    <td><?php echo date("d-m-Y",strtotime($data['tgl_garansi_habis'])); ?></td>
    <td><?php
	if ($data['tgl_i']!='0000-00-00') { 
	echo date("d-m-Y",strtotime($data['tgl_i'])); 
	} else {
	echo "<font color='#FF0000'>...........</font>";
	}
	?></td>
    <td>
    <?php if ($data['lampiran_i']!='') { ?>
    <a href="gambar_fi/instalasi/<?php echo $data['lampiran_i']; ?>" target="_blank"><img src="gambar_fi/instalasi/<?php echo $data['lampiran_i']; ?>" width="50px" /></a>
    <?php } ?>
    </td>
    <td><?php
	if ($data['tgl_f']!='0000-00-00') {
	echo date("d-m-Y",strtotime($data['tgl_f'])); 
	} else {
	echo "<font color='#FF0000'>...........</font>";
	}
	?></td>
    <td>
    <?php if ($data['lampiran_f']!='') { ?>
    <a href="gambar_fi/fungsi/<?php echo $data['lampiran_f']; ?>" target="_blank"><img src="gambar_fi/fungsi/<?php echo $data['lampiran_f']; ?>" width="50px" /></a>
    <?php } ?>
    </td>
    <td align="center">
    <?php if (!isset($_SESSION['id_b'])) { ?>
    <a href="pages/delete_uji.php?id_hapus=<?php echo $data['idd']; ?>" onclick="return confirm('Anda Yakin Akan Menghapus Item Ini ?')"><span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span></a> &nbsp;
    <?php } ?>
    <a href="index.php?page=ubah_uji&id=<?php echo $data['idd']; ?>"><span data-toggle="tooltip" title="Ubah" class="fa fa-edit"></span></a> &nbsp;
    <?php if (!isset($_SESSION['id_b'])) { ?>
    <a href="cetak_surat_perintah_instalasi.php?id=<?php echo $data['idd']; ?>"><span data-toggle="tooltip" title="Cetak Surat Perintah Instalasi" class="fa fa-print"></span></a>&nbsp;&nbsp; <a target="_blank" href="cetak_laporan_instalasi.php?id=<?php echo $data['idd']; ?>"><span data-toggle="tooltip" title="Download Report" class="glyphicon glyphicon-print"></span></a>
      <?php } ?>
	  <?php 
	  
	  if ($tt==0) { ?>
      <a href="index.php?page=tambah_pelatihan&id=<?php echo $data['idd']; ?>"><small data-toggle="tooltip" title="Pelatihan Alat" class="label bg-blue">Pelatihan</small>
    <?php } ?>
    </td>
  </tr>
  <?php } ?>
</table>
</div>
              </div>
            </div>
          </div>
          <!-- /.box (chat box) -->

          <!-- TO DO List --><!-- /.box -->

        <!-- quick email widget --></section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-5 connectedSortable">

          <!-- Map box --><!-- /.box -->

          <!-- solid sales graph --><!-- /.box -->

          <!-- Calendar --><!-- /.box -->

        </section>
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

  </section>
    <!-- /.content -->
  </div>
  <?php 
  if (isset($_POST['jual'])) {  
	  $q = mysqli_query($koneksi, "update jual_barang set status_f=".$_POST['status_f'].", status_i=".$_POST['status_i'].", tgl_uji_fungsi='".$_POST['tgl_uji_fungsi']."', tgl_instalasi='".$_POST['tgl_instalasi']."', lampiran='".$_FILES['lampiran']['name']."' where id=".$_GET['id']."");
	  if ($q) {
		  copy($_FILES['lampiran']['tmp_name'], "gambar_fi/".$_FILES['lampiran']['name']);
		  echo "<script type='text/javascript'>
		  window.location='index.php?page=uji_fungsi_instalasi';
		  </script>";
		  }
		//$d = mysqli_fetch_array(mysqli_query($koneksi, "select * from master barang where id=".$_GET['id'].""));
  } 
  
  if (isset($_POST['buat_spk'])) {
	  $q2 = mysqli_query($koneksi, "update jual_barang set id_teknisi=".$_POST['teknisi'].", tgl_spk_instalasi='".$_POST['tgl_spk_instalasi']."' where id=$_GET[id]");
	  if ($q2) {
		  echo "<script type='text/javascript'>
	window.location='index.php?page=uji_fungsi_instalasi';
		  </script>";
		  }
	  }
	  
	  
		?>
  <div id="openUbahStatus" class="modalDialog">
     <div>
        <a href="#" title="Close" class="close">X</a>
        <h3 align="center">Status Uji Fungsi &amp; Instalasi</h3> 
        <?php 
		$data_status=mysqli_fetch_array(mysqli_query($koneksi, "select * from jual_barang where id=$_GET[id]"));
		?>
     <form method="post" enctype="multipart/form-data">
     <label id="">Tgl Uji Fungsi</label>
     <input name="tgl_uji_fungsi" type="date" id="input" value="<?php echo $data_status['tgl_uji_fungsi']; ?>" required/>
     <?php if ($data_status['status_f']!=0) { ?>
     <label>Status Uji Fungsi</label>
     <select name="status_f" id="input">
     <option value="1">OK</option>
     <option value="0">TIDAK</option>
     </select>
     <?php } else { ?>
     <label>Status Uji Fungsi</label>
     <select name="status_f" id="input">
     <option value="0">TIDAK</option>
     <option value="1">OK</option>
     </select>
     <?php }  ?>
     <label id="">Tgl Instalasi</label>
     <input name="tgl_instalasi" type="date" id="input" value="<?php echo $data_status['tgl_instalasi']; ?>" required/>
     <?php if ($data_status['status_i']!=0) { ?>
     <label>Status Instalasi</label>
     <select name="status_i" id="input">
     <option value="1">OK</option>
     <option value="0">TIDAK</option>
     </select>
     <?php } else { ?>
     <label>Status Instalasi</label>
     <select name="status_i" id="input">
     <option value="0">TIDAK</option>
     <option value="1">OK</option>
     </select>
     <?php }  ?>
     <label>Lampiran</label>
     <input name="lampiran" type="file" style="background-color:#FFF" id="input"/>
<button id="buttonn" name="jual" type="submit">Simpan</button>
    </form>
    </div>
</div>

<div id="openBuatSPK" class="modalDialog">
     <div>
        <a href="#" title="Close" class="close">X</a>
        <h3 align="center">Pembuatan SPK Instalasi</h3> 
        <?php 
		$data_spk=mysqli_fetch_array(mysqli_query($koneksi, "select * from jual_barang where id=$_GET[id]"));
		?>
     <form method="post">
     <label>Tgl SPK</label>
     <input name="tgl_spk_instalasi" type="date" id="input" value="<?php echo $data_spk['tgl_spk_instalasi']; ?>"/>
     <label>Teknisi</label>
     <select name="teknisi" id="input">
     <option>--Pilih Teknisi--</option>
     <?php 
	 $q_tek = mysqli_query($koneksi, "select * from tb_teknisi order by nama_teknisi ASC");
	 while ($d_t = mysqli_fetch_array($q_tek)) {
	 ?>
     <option value="<?php echo $d_t['id']; ?>"><?php echo $d_t['nama_teknisi']; ?></option>
     <?php } ?>
     </select>
<button id="buttonn" name="buat_spk" type="submit">Simpan</button>
    </form>
    </div>
</div>

<div id="openPelatihan" class="modalDialog">
     <div>
        <a href="#" title="Close" class="close">X</a>
        <h3 align="center">Pelatihan Alkes</h3> 
        <?php 
		$data_spk=mysqli_fetch_array(mysqli_query($koneksi, "select * from jual_barang where id=$_GET[id]"));
		?>
     <form method="post" enctype="multipart/form-data">
     <label>Tgl Pelatihan</label>
     <input name="tgl_pelatihan" type="date" id="input"/>
     <input id="input" name="peserta" type="text" placeholder="Peserta"/>
     <input id="input" name="pelatih" type="text" placeholder="Pelatih"/>
     <!--<select name="pelatih" id="input">
     <option>--Pilih Pelatih--</option>
     <?php 
	 //$q_tek = mysqli_query($koneksi, "select * from tb_teknisi order by nama_teknisi ASC");
	 //while ($d_t = mysqli_fetch_array($q_tek)) {
	 ?>
     <option value="<?php //echo $d_t['id']; ?>"><?php //echo $d_t['nama_teknisi']; ?></option>
     <?php //} ?>
     </select>-->
     <input name="lamp1" type="file" id="input" style="background-color:#FFF"/>
     <input name="lamp2" type="file" id="input" style="background-color:#FFF"/>
<button id="buttonn" name="buat_training" type="submit">Simpan</button>
    </form>
    </div>
</div>

<div id="detailAkse" class="modalDialog">
     <div>
        <a href="#" title="Close" class="close">X</a>
        <h3 align="center">Detail Aksesoris</h3> 
        Nama Aksesoris
        <input id="input" disabled="disabled" value="<?php echo $q3['nama_brg']; ?>"/>
        Merk
        <input id="input" disabled="disabled" value="<?php echo $q3['merk_brg']; ?>"/>
        Tipe
        <input id="input" disabled="disabled" value="<?php echo $q3['tipe_brg']; ?>"/>
        NIE
        <input id="input" disabled="disabled" value="<?php echo $q3['nie_brg']; ?>"/>
        Deksripsi Alkes
        <input id="input" disabled="disabled" value="<?php echo $q3['deskripsi_alat']; ?>"/><br /><br />
    </div>
</div>
