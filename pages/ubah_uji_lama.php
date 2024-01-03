<?php
$data=mysqli_fetch_array(mysqli_query($koneksi, "select *,alat_uji.id as idd,barang_gudang.id as id_gudang from alat_uji,barang_teknisi,barang_dikirim,barang_dijual, barang_gudang,barang_gudang_detail,pembeli,tb_teknisi,alamat_provinsi,alamat_kabupaten,alamat_kecamatan where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dijual.barang_gudang_detail_id and barang_dijual.id=barang_dikirim.barang_dijual_id and pembeli.id=barang_dijual.pembeli_id and alamat_provinsi.id=pembeli.provinsi_id and alamat_kabupaten.id=pembeli.kabupaten_id and alamat_kecamatan.id=pembeli.kecamatan_id and barang_dikirim.id=barang_teknisi.barang_dikirim_id and barang_teknisi.id=alat_uji.barang_teknisi_id and tb_teknisi.id=barang_teknisi.teknisi_id and alat_uji.id=".$_GET['id'].""));

if (isset($_POST['tambah_spk_masuk'])) {
	$Result = mysqli_query($koneksi, "update alat_uji set soft_version='".$_POST['versi_software']."', tgl_garansi_habis='".$_POST['tgl_garansi_habis']."', tgl_f='".$_POST['tgl_f']."', tgl_i='".$_POST['tgl_i']."', keterangan='".$_POST['keterangan']."' where id='".$_GET['id']."'");
	
	if ($Result) {
		echo "<script type='text/javascript'>
		alert('Data Berhasil Di Ubah !');
		window.location='index.php?page=uji_fungsi_instalasi';
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

if (isset($_POST['simpan_fungsi'])) {
	$id=$_GET['id'];
	  $R = mysqli_query($koneksi, "update alat_uji set lampiran_f='".$_FILES['uji_f']['name']."' where id=$id");
	  if ($R) {
		  copy($_FILES['uji_f']['tmp_name'], "gambar_fi/fungsi/".$_FILES['uji_f']['name']);
		  echo "<script type='text/javascript'>
		  window.location='index.php?page=ubah_uji&id=$id';
		</script>";
		  }
	  }

if (isset($_POST['simpan_instalasi'])) {
	$id=$_GET['id'];
	  $R = mysqli_query($koneksi, "update alat_uji set lampiran_i='".$_FILES['uji_i']['name']."' where id=$id");
	  if ($R) {
		  copy($_FILES['uji_i']['tmp_name'], "gambar_fi/instalasi/".$_FILES['uji_i']['name']);
		  echo "<script type='text/javascript'>
		  window.location='index.php?page=ubah_uji&id=$id';
		</script>";
		  }
	  }
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Uji Fungsi &amp; Instalasi
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="index.php?page=barang_masuk">SPK Masuk</a></li>
        <li class="active">Ubah</li></ol></section>


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
            <div class="box-footer">
            
            <div class="box-header with-border">
              <h3 class="box-title"><strong>Teknisi</strong></h3>
            </div>
              <div class="box-body">
              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  Nama :<font class="pull-right"> <?php echo $data['nama_teknisi']; ?></font>
                </li>
                <li class="list-group-item">
                  Kompetensi :<font class="pull-right"> <?php echo $data['bidang']; ?></font>
                </li>
                
              </ul>                                 
              </div>
              <div class="box-header with-border">
              <h3 class="box-title"><strong>Data Alkes</strong></h3>
            </div>
              <div class="box-body">
              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  Nama Alkes : <font class="pull-right"><?php echo $data['nama_brg']; ?></font></li>
                <li class="list-group-item">
                  Tipe : <font class="pull-right"><?php echo $data['tipe_brg']; ?></font></li>
                <li class="list-group-item">
                  Merk : <font class="pull-right"><?php echo $data['merk_brg']; ?></font></li>
                  <li class="list-group-item">
                  No Seri : <font class="pull-right"><?php echo $data['no_seri_brg']; ?></font></li>
                  <li class="list-group-item">
                  NIE (Nomor Ijin Edar) : <font class="pull-right"><?php echo $data['nie_brg']; ?></font></li>
                
              </ul>                                 
              </div>
              <div class="box-header with-border">
              <h3 class="box-title"><strong>Data Rumah Sakit/Dinas/Puskesmas/Klinik/dll</strong></h3>
            </div>
              <div class="box-body">
              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  Nama RS/Dinas/Puskesmas/Klinik/dll : <font class="pull-right"><?php echo $data['nama_pembeli']; ?></font></li>
                <li class="list-group-item">
                  Alamat : <font class="pull-right"><?php echo $data['jalan']." Kel.".$data['kelurahan_id']." Kec.".$data['nama_kecamatan']; ?></font></li>
                <li class="list-group-item">
                  Kontak : <font class="pull-right"><?php echo $data['kontak']; ?></font></li>
                <li class="list-group-item">
                  Email : <font class="pull-right"><?php echo $data['email']; ?></font></li>
                  <li class="list-group-item">
                  Keterangan Lain : <font class="pull-right"><?php echo $data['ket_lain']; ?></font></li>
                
              </ul>                                 
              </div>
            </div>
          </div>
          <!-- /.box (chat box) -->

          <!-- TO DO List --><!-- /.box -->

        <!-- quick email widget -->
          <!-- Custom tabs (Charts with tabs)--><!-- /.nav-tabs-custom -->

          <!-- Chat box -->
          
          <!-- /.box (chat box) -->

          <!-- TO DO List --><!-- /.box -->

        <!-- quick email widget --></section>
        <section class="col-lg-6 connectedSortable">
          <!-- Custom tabs (Charts with tabs)--><!-- /.nav-tabs-custom -->

          <!-- Chat box -->
          <div class="box box-success"><!-- /.chat -->
            <div class="box-footer">
            
            <div class="timeline-body">
            <font color="#FF0000">*Klik Gambar Untuk Mengubah Lampiran</font><br />
            <?php if ($data['lampiran_f']!='') { ?>
                  <a href="#openFungsi"><img src="gambar_fi/fungsi/<?php echo $data['lampiran_f']; ?>" class="margin" title="Uji Fungsi" data-toggle="tooltip" width="60px"></a>
                  <?php } else { ?>
                  <a href="#openFungsi"><img src="gambar_fi/x.png"  title="Uji Fungsi" data-toggle="tooltip"></a>
                  <?php } ?>
                  <?php if ($data['lampiran_i']!='') { ?>
                  <a href="#openInstalasi"><img src="gambar_fi/instalasi/<?php echo $data['lampiran_i']; ?>" class="margin" title="Instalasi" data-toggle="tooltip" width="60px"></a>
                  <?php } else { ?>
                  <a href="#openInstalasi"><img src="gambar_fi/x.png" class="margin" title="Instalasi" data-toggle="tooltip"></a>                  
                  <?php } ?>
                </div>
            <hr />
            <div class="box-header with-border">
              <h3 class="box-title"><em>Lakukan perubahan data dengan benar !</em></h3></div><div class="box-body">
              Aksesoris<!--<small data-toggle="tooltip" title="Tambah Aksesoris Baru" class="label bg-blue pull-right">+ Tambah</small>-->
              <table width="100%" border="1" class="table table-bordered table-hover">
  <thead>
    <th>No</th>
    <th>Nama Aksesoris</th>
    <th>Qty</th>
    <th>#</th>
  </thead>
  <?php 
  $tes = mysqli_query($koneksi, "select *,aksesoris_alkes.id as id_akse from aksesoris_alkes,aksesoris where aksesoris.id=aksesoris_alkes.aksesoris_id and barang_gudang_id=".$data['id_gudang']." order by nama_akse ASC");
  $no=0;
  while ($data_tes = mysqli_fetch_array($tes)) {
	  $no++;
	   ?>
  <tr>
    <td><?php echo $no; ?></td>
    <td><?php echo $data_tes['nama_akse']; ?></td>
    <td><?php echo $data_tes['qty']; ?></td>
    <td><a href="index.php?page=ubah_uji&id=<?php echo $_GET['id']; ?>&id_akse=<?php echo $data_tes['id_akse']; ?>#openAkse">Ubah</a></td>
  </tr>
  <?php } ?>
  <?php 
  $to = mysqli_num_rows($tes);
  if ($to==0) { ?>
  <tr>
    <td colspan="4" align="center">Tidak Ada Aksesoris</td>
    </tr>
  <?php } ?>
</table>

              <br />
              Versi Software
              <input name="versi_software" class="form-control" type="text" value="<?php echo $data['soft_version']; ?>">
              
              <br />
              Tanggal Garansi Habis
              <input name="tgl_garansi_habis" class="form-control" type="date" value="<?php echo $data['tgl_garansi_habis']; ?>"><br />
              
              <!--<select name="aksesoris" class="form-control">
              <option value="">--Pilih Aksesoris--</option>
              <?php 
			  //$akse = mysqli_query($koneksi, "select * from aksesoris order by nama_akse ASC");
			  //while ($data_akse = mysqli_fetch_array($akse)) {
			  ?>
              <option value="<?php //echo $data_akse['id']; ?>"><?php //echo $data_akse['nama_akse']." - ".$data_akse['no_akse']; ?></option>
              <?php //} ?>
              </select>
              
              <br />-->
              
              Tanggal Instalasi <font color="#FF0000">*</font>
              <input name="tgl_i" class="form-control" type="date" value="<?php echo $data['tgl_i']; ?>"><br />
              
              Tanggal Uji Fungsi <font color="#FF0000">*</font>
              <input name="tgl_f" class="form-control" type="date" value="<?php echo $data['tgl_f']; ?>"><br />
              Keterangan
              <input name="keterangan" class="form-control" type="text" value="<?php echo $data['keterangan']; ?>"><br />
              
             <button name="tambah_spk_masuk" type="submit" value="Simpan" class="btn btn-success" style="padding:10px"><span class="fa fa-plus"></span> Simpan </button>
              </div>
            </div>
          </div>
          <!-- /.box (chat box) -->

          <!-- TO DO List --><!-- /.box -->

        <!-- quick email widget --></section>
        
        <section class="col-lg-12 connectedSortable" align="center">
          </section>
        
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-5 connectedSortable">

          <!-- Map box --><!-- /.box -->

          <!-- solid sales graph --><!-- /.box -->

          <!-- Calendar --><!-- /.box -->

        </section>
        <!-- right col -->
      </div>
      </form>
      <script type="text/javascript">    
	<?php 
	echo $jsArray; 
	?>  
	function changeValue(id_akse){  
		document.getElementById('model').value = dtBrg[id_akse].model; 
		document.getElementById('tipe').value = dtBrg[id_akse].tipe;
		document.getElementById('no_akse').value = dtBrg[id_akse].no_seri;
		
	};  
</script>
      <!-- /.row (main row) -->

  </section>
    <!-- /.content -->
  </div>
  
  <div id="openFungsi" class="modalDialog">
     <div>
        <a href="#" title="Close" class="close">X</a>
        <h3 align="center">Ubah Lampiran Uji Fungsi</h3> 
     <form method="post" enctype="multipart/form-data">
     <input id="input" name="uji_f" type="file" style="background-color:#FFF"/>
        <button id="buttonn" name="simpan_fungsi" type="submit">Simpan</button>
    </form>
    </div>
</div>

<div id="openInstalasi" class="modalDialog">
     <div>
        <a href="#" title="Close" class="close">X</a>
        <h3 align="center">Ubah Lampiran Instalasi</h3> 
     <form method="post" enctype="multipart/form-data">
     <input id="input" name="uji_i" type="file" style="background-color:#FFF"/>
        <button id="buttonn" name="simpan_instalasi" type="submit">Simpan</button>
    </form>
    </div>
</div>
<?php
  if (isset($_POST['ubah_akse'])) {
	  $up = mysqli_query($koneksi, "update aksesoris_alkes set aksesoris_id='".$_POST['id_akse']."', qty='".$_POST['qty']."' where id=".$_GET['id_akse']."");
	  if ($up) {
		  echo "<script type='text/javascript'>
		window.location='index.php?page=ubah_uji&id=$_GET[id]';
		</script>";
		  }
	  }
  ?>
  <div id="openAkse" class="modalDialog">
     <div>
        <a href="#" title="Close" class="close">X</a>
        <h3 align="center">Ubah Data Aksesoris</h3> 
     <form method="post" enctype="multipart/form-data">
              <select name="id_akse" id="input" class="form-control" autofocus="autofocus" required >
        <?php
		$qu = mysqli_fetch_array(mysqli_query($koneksi, "select * from aksesoris_alkes where id=".$_GET['id_akse']."")); 
		$q = mysqli_query($koneksi, "select * from aksesoris order by nama_akse ASC");
		
		while ($d = mysqli_fetch_array($q)) { ?>
        <option <?php if ($d['id']==$qu['aksesoris_id']) {echo "selected";} ?> value="<?php echo $d['id']; ?>"><?php echo $d['nama_akse']; ?></option>
        <?php } ?>
    </select>
    
    <input id="input" required="required" name="qty" class="form-control" type="text" placeholder="Qty" value="<?php echo $qu['qty']; ?>" />
              
              <button id="buttonn" name="ubah_akse" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Simpan</button>
              <br /><br />
              </form>
              <script type="text/javascript">    
	<?php 
	echo $jsArray; 
	?>  
	function changeValue(id_akse){  
		document.getElementById('tipe_akse').value = dtBrg[id_akse].tipe_akse; 
		document.getElementById('merk_akse').value = dtBrg[id_akse].merk_akse;
		document.getElementById('no_akse').value = dtBrg[id_akse].no_akse;
		
	};  
</script>
    </div>
</div>
  