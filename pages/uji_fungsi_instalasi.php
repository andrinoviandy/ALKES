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
            <div class="pull pull-left">
              <button class="btn btn-info" data-toggle="modal" data-target="#modal-cetak"><span class="fa fa-print"></span> Rekap</button>
              </div>
            <br /><br /><br />
              <div class="box-body table-responsive no-padding">
              <div class="">
                <table width="100%" id="example1" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th align="center">No</th>
      <th>Nama RS/Dinas/Pusk./dll</th>
      <td align="center" valign="bottom"><strong>Alamat</strong>      
    
      <td align="center"><strong>Kontak RS/Dinas/Dll</strong>      
      <td align="center"><strong>Aksi</strong></th>
        </tr>
  </thead>
  <?php
  if (isset($_SESSION['id_b'])) {
	  $query = mysqli_query($koneksi, "select *,alat_uji_detail.id as idd,pembeli.id as id_rumkit from alat_uji_detail,barang_teknisi_detail,barang_dikirim_detail,barang_dikirim,barang_dijual,pembeli,tb_teknisi,barang_teknisi_detail_teknisi where pembeli.id=barang_dijual.pembeli_id and barang_dijual.id=barang_dikirim.barang_dijual_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and barang_dikirim_detail.id=barang_teknisi_detail.barang_dikirim_detail_id and barang_teknisi_detail.id=alat_uji_detail.barang_teknisi_detail_id and barang_teknisi_detail.id=barang_teknisi_detail_teknisi.barang_teknisi_detail_id and tb_teknisi.id=barang_teknisi_detail_teknisi.teknisi_id and tb_teknisi.id=$_SESSION[id_b] group by pembeli.id order by nama_pembeli ASC");
	  }
  else {
	  $query = mysqli_query($koneksi, "select *,alat_uji_detail.id as idd,pembeli.id as id_rumkit from alat_uji_detail,barang_teknisi_detail,barang_dikirim_detail,barang_dikirim,barang_dijual,pembeli where pembeli.id=barang_dijual.pembeli_id and barang_dijual.id=barang_dikirim.barang_dijual_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and barang_dikirim_detail.id=barang_teknisi_detail.barang_dikirim_detail_id and barang_teknisi_detail.id=alat_uji_detail.barang_teknisi_detail_id group by pembeli.id order by nama_pembeli ASC");
  }
  $no=0;
  while ($data = mysqli_fetch_assoc($query)) { 
  $no++;
  ?>
  <tr>
    <td align="center"><?php echo $no; ?></td>
    <td><?php echo $data['nama_pembeli']; ?></td>
    <td align="center"><?php echo $data['jalan'].", Kelurahan ".$data['kelurahan_id']; ?></td>
    <td align="center"><?php echo $data['kontak_rs']; ?></td>    
    <td align="center">
    <!--<?php if (!isset($_SESSION['id_b'])) { ?>
    <a href="pages/delete_uji.php?id_hapus=<?php echo $data['idd']; ?>" onclick="return confirm('Anda Yakin Akan Menghapus Item Ini ?')"><span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span></a> &nbsp;
    <?php } ?>-->
    <a href="index.php?page=ubah_uji&id_rumkit=<?php echo $data['id_rumkit']; ?>"><span data-toggle="tooltip" title="Detail" class="fa fa-caret-square-o-right"></span></a> <br />
    <!--<?php if (!isset($_SESSION['id_b'])) { ?>
    <a href="cetak_surat_perintah_instalasi.php?id=<?php echo $data['idd']; ?>"><span data-toggle="tooltip" title="Cetak Surat Perintah Instalasi" class="fa fa-print"></span></a>&nbsp;&nbsp; <a target="_blank" href="cetak_laporan_instalasi.php?id=<?php echo $data['idd']; ?>"><span data-toggle="tooltip" title="Download Report" class="glyphicon glyphicon-print"></span></a><br />
      <?php } ?>-->
	  <!--
	  <?php 
	  
	  if ($tt==0) { ?>
      <a href="index.php?page=tambah_pelatihan&id=<?php echo $data['idd']; ?>"><small data-toggle="tooltip" title="Pelatihan Alat" class="label bg-blue">Pelatihan</small></a>
    <?php } ?>
    -->
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

<div class="modal fade" id="modal-cetak">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><center>
                    Rekap Instalasi & Uji Fungsi
                </center></h4>
              </div>
              <form method="post" enctype="multipart/form-data" action="cetak_laporan_rekapan_instalasi.php">
              <div class="modal-body">
              <label>Dari Tanggal</label>
              <input name="tgl1" type="date" class="form-control" placeholder="" value=""><br />
              <label>Sampai Tanggal</label>
              <input name="tgl2" type="date" class="form-control" placeholder="" value=""><br />
              <!--<label>Status Barang</label>
              <select class="form-control" style="width:100%" name="status">
              <option value="Semua">Semua</option>
              <option value="Sudah Terkirim">Sudah Terkirim</option>
              </select>
              -->
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-info" name="cetak">Cetak</button>
              </div>
              </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
