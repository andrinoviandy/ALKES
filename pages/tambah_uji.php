<?php
$data=mysqli_fetch_array(mysqli_query($koneksi, "select *,barang_gudang.id as id_gudang from barang_teknisi,barang_teknisi_detail, barang_dikirim,barang_dikirim_detail, barang_dijual,barang_dijual_detail, barang_gudang, barang_gudang_detail,pembeli, tb_teknisi,pemakai where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dijual_detail.barang_gudang_detail_id and barang_dijual.id=barang_dijual_detail.barang_dijual_id and barang_dijual_detail.id=barang_dikirim_detail.barang_dijual_detail_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and pembeli.id=barang_dijual.pembeli_id and pemakai.id=barang_dijual.pemakai_id and barang_dikirim_detail.id=barang_teknisi_detail.barang_dikirim_detail_id and barang_teknisi.id=barang_teknisi_detail.barang_teknisi_id and tb_teknisi.id=barang_teknisi.teknisi_id and barang_teknisi.id=".$_GET['id'].""));

if (isset($_POST['tambah_spk_masuk'])) {
	//$Result = mysqli_query($koneksi, "insert into alat_uji values('','".$_GET['id']."','".$_POST['id_alkes']."','".$_POST['versi_software']."','".$_POST['tgl_garansi_habis']."','".$_POST['tgl_i']."','".$_FILES['lampiran_i']['name']."','".$_POST['tgl_f']."','".$_FILES['lampiran_f']['name']."','".$_POST['keterangan']."')");
	
	//if ($Result) {
		//copy($_FILES['lampiran_f']['tmp_name'], "gambar_fi/fungsi/".$_FILES['lampiran_f']['name']);
		//copy($_FILES['lampiran_i']['tmp_name'], "gambar_fi/instalasi/".$_FILES['lampiran_i']['name']);
		echo "<script type='text/javascript'>
			window.location='index.php?page=simpan_tambah_uji&id=$_GET[id]&id_alkes=$_POST[id_alkes]';
		</script>";
		
		//}
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
      Instalasi &amp; Uji Fungsi</h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Instalasi &amp; Uji Fungsi</li>
        <li class="active">Tambah</li></ol></section>


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
              
              <div class="box-body">
              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <h3 class="box-title"><strong>Tgl SPK :</strong></h3><font class="pull-right"> <h3 class="box-title"><strong><?php echo date("d F Y",strtotime($data['tgl_spk'])); ?></strong></h3></font>
                </li>
                </ul>
                </div>
            </div>
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
              <h3 class="box-title"><strong>Data RS/Dinas/Puskesmas/Klinik/dll</strong></h3>
            </div>
              <div class="box-body">
              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  Nama RS/Dinas/Puskesmas/Klinik/dll : <font class="pull-right"><?php echo $data['nama_pembeli']; ?></font></li>
                <li class="list-group-item">
                  Alamat : <font class="pull-right"><?php echo $data['jalan']; ?></font></li>
                  <li class="list-group-item">
                  Kontak RS/Dinas/Dll : <font class="pull-right"><?php echo $data['kontak_rs']; ?></font></li>
                <li class="list-group-item">
                  Nama Pemakai : <font class="pull-right"><?php echo $data['nama_pemakai']; ?></font></li>
                <li class="list-group-item">
                  Kontak 1 : <font class="pull-right"><?php echo $data['kontak1_pemakai']; ?></font></li>
                  <li class="list-group-item">
                  Kontak 2 : <font class="pull-right"><?php echo $data['kontak2_pemakai']; ?></font></li>
                <li class="list-group-item">
                  Email : <font class="pull-right"><?php echo $data['email_pemakai']; ?></font></li>
                  
                
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
            <div class="box-header with-border">
            <h3>Tambah Data Instalasi & Uji Fungsi</h3>
              <h3 class="box-title"><em>isilah dengan data dengan benar !</em></h3></div><div class="box-body">
              <h3>Aksesoris</h3><!--<small data-toggle="tooltip" title="Tambah Aksesoris Baru" class="label bg-blue pull-right">+ Tambah</small>-->
              <table width="100%" id="example1" border="1" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th>No</th>
      <th>Nama Alkes</th>
    <th> Aksesoris</th>
    <th>Qty</th>
    <th>Aksi</th>
  </thead>
  <?php 
  
  $tes = mysqli_query($koneksi, "select *,barang_gudang.id as id_gudang,aksesoris_alkes.id as id_akse from barang_teknisi,barang_teknisi_detail, barang_dikirim,barang_dikirim_detail, barang_dijual,barang_dijual_detail, barang_gudang, barang_gudang_detail,pembeli, tb_teknisi,pemakai,aksesoris,aksesoris_alkes where barang_gudang.id=aksesoris_alkes.barang_gudang_id and aksesoris.id=aksesoris_alkes.aksesoris_id and barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dijual_detail.barang_gudang_detail_id and barang_dijual.id=barang_dijual_detail.barang_dijual_id and barang_dijual_detail.id=barang_dikirim_detail.barang_dijual_detail_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and pembeli.id=barang_dijual.pembeli_id and pemakai.id=barang_dijual.pemakai_id and barang_dikirim_detail.id=barang_teknisi_detail.barang_dikirim_detail_id and barang_teknisi.id=barang_teknisi_detail.barang_teknisi_id and tb_teknisi.id=barang_teknisi.teknisi_id and barang_teknisi.id=".$_GET['id']."");
  $no=0;
  while ($data_tes = mysqli_fetch_array($tes)) {
	  $no++;
	   ?>
  <tr>
    <td><?php echo $no; ?></td>
    <td><?php echo $data_tes['nama_brg']; ?></td>
    <td><?php echo $data_tes['nama_akse']; ?></td>
    <td><?php echo $data_tes['qty']; ?></td>
    <td><a href="index.php?page=tambah_uji&id=<?php echo $_GET['id']; ?>&id_akse=<?php echo $data_tes['id_akse']; ?>#openAkse">Ubah</a></td>
  </tr>
  <?php } ?>
  <?php 
  $to = mysqli_num_rows($tes);
  if ($to==0) { ?>
  <tr>
    <td colspan="5" align="center">Tidak Ada Aksesoris</td>
    </tr>
  <?php } ?>
</table>
<br />
Pilih Alkes Yang Akan Di Instalasi & Uji Fungsi<br /><br />
<table width="100%" id="example1" border="1" class="table table-bordered table-hover">
              <thead>
  <tr>
    <th>Nama Alkes</th>
    <th><strong>No. Seri</strong></th>
    <th>Pilih</th>
    </tr>
  </thead>
  <?php
  $q = mysqli_query($koneksi, "select *,barang_gudang.id as id_gudang,barang_teknisi_detail.id as id_brg_teknisi_detail from barang_teknisi,barang_teknisi_detail, barang_dikirim,barang_dikirim_detail, barang_dijual,barang_dijual_detail, barang_gudang, barang_gudang_detail,pembeli, tb_teknisi,pemakai where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dijual_detail.barang_gudang_detail_id and barang_dijual.id=barang_dijual_detail.barang_dijual_id and barang_dijual_detail.id=barang_dikirim_detail.barang_dijual_detail_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and pembeli.id=barang_dijual.pembeli_id and pemakai.id=barang_dijual.pemakai_id and barang_dikirim_detail.id=barang_teknisi_detail.barang_dikirim_detail_id and barang_teknisi.id=barang_teknisi_detail.barang_teknisi_id and tb_teknisi.id=barang_teknisi.teknisi_id and barang_teknisi.id=".$_GET['id']."");
  $no=0;
  while ($d = mysqli_fetch_array($q)) {
  $no++;
  ?>
  <tr>
    <td><?php echo $d['nama_brg']; ?></td>
    <td><?php echo $d['no_seri_brg']; ?></td>
    <td><input name="p[]" checked="checked" type="checkbox" value="<?php echo $d['id_brg_teknisi_detail']; ?>" style="height:20px; width:20px" /></td>
    </tr>
  <?php } ?>
</table>
<!--
              <br />
              Versi Software
              <input name="versi_software" class="form-control" type="text" required="required">
              
              <br />
              <?php 
			  $tgl_jual=mysqli_fetch_array(mysqli_query($koneksi, "select tgl_jual + INTERVAL '1' YEAR as tgl_garansi from barang_teknisi,barang_dikirim,barang_dijual where barang_dijual.id=barang_dikirim.barang_dijual_id and barang_dikirim.id=barang_teknisi.barang_dikirim_id and barang_teknisi.id=".$_GET['id'].""));
			  			  ?>
              Tanggal Garansi Habis <font color="#FF0000">(Tgl Jual + 1 Tahun)</font>
              <input name="tgl_garansi_habis" class="form-control" type="date" value="<?php echo $tgl_jual['tgl_garansi']; ?>"><br />
              
              Tanggal Instalasi <font color="#FF0000">*</font>
              <input name="tgl_i" class="form-control" type="date" ><br />
              Lampiran Instalasi
              <input name="lampiran_i" class="form-control" type="file"><br />
              Tanggal Uji Fungsi <font color="#FF0000">*</font>
              <input name="tgl_f" class="form-control" type="date" ><br />
              Lampiran Uji Fungsi
              <input name="lampiran_f" class="form-control" type="file"><br />
              Keterangan
              <input name="keterangan" class="form-control" type="text" value="">--><br />
              
             <button name="tambah_spk_masuk" type="submit" value="Simpan" class="btn btn-success" style="padding:10px"><span class="fa fa-check"></span> Next </button>
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
		document.getElementById('nie').value = dtBrg[id_akse].nie;
		
	};  
</script>
      <!-- /.row (main row) -->

  </section>
    <!-- /.content -->
  </div>
  <?php
  if (isset($_POST['ubah_akse'])) {
	  $up = mysqli_query($koneksi, "update aksesoris_alkes set aksesoris_id='".$_POST['id_akse']."', qty='".$_POST['qty']."' where id=".$_GET['id_akse']."");
	  if ($up) {
		  echo "<script type='text/javascript'>
		window.location='index.php?page=tambah_uji&id=$_GET[id]';
		</script>";
		  }
	  }
  ?>
  <div id="openAkse" class="modalDialog">
     <div>
        <a href="#" title="Close" class="close">X</a>
        <h3 align="center">Ubah Data Aksesoris</h3> 
     <form method="post" enctype="multipart/form-data">
              Aksesoris
              <select name="id_akse" id="input" class="form-control" autofocus="autofocus" required >
        <?php
		$qu = mysqli_fetch_array(mysqli_query($koneksi, "select * from aksesoris_alkes where id=".$_GET['id_akse']."")); 
		$q = mysqli_query($koneksi, "select * from aksesoris order by nama_akse ASC");
		
		while ($d = mysqli_fetch_array($q)) { ?>
        <option <?php if ($d['id']==$qu['aksesoris_id']) {echo "selected";} ?> value="<?php echo $d['id']; ?>"><?php echo $d['nama_akse']; ?></option>
        <?php } ?>
    </select>
    Qty
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
  
  