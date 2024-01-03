<?php
if (isset($_POST['tambah_spk_masuk'])) {
	/*$query_spk=mysqli_query($koneksi, "insert into barang_teknisi values('','".$_POST['tgl_spk']."','".$_POST['no_spk']."','0','','')");
	$m = mysqli_fetch_array(mysqli_query($koneksi, "select max(id) as max from barang_teknisi"));
	$max=$m['max'];
	if ($_POST['id_kirim_detail']=='') {
		$se = mysqli_query($koneksi, "select * from barang_dikirim_detail where barang_dikirim_id=".$_POST['id_po']."");
		while ($d = mysqli_fetch_array($se)) {
			$query_spk2=mysqli_query($koneksi, "insert into barang_teknisi_detail values('','$max','".$d['id']."','')");
			}
		} else {
	$query_spk2=mysqli_query($koneksi, "insert into barang_teknisi_detail values('','$max','".$_POST['id_kirim_detail']."','')"); }
	if ($query_spk and $query_spk2) {
		//$update_kirim_brg=mysqli_query($koneksi, "update barang_dikirim set status_spk=1 where id=".$_POST['id_po']."");
		echo "<script type='text/javascript'>
		alert('Data Berhasil Di Simpan !');
		window.location='index.php?page=spi';
		</script>";
		
	} else {
		echo "<script type='text/javascript'>
		alert('Gagal Disimpan !');
		</script>";
		}*/
		echo "<script type='text/javascript'>
		window.location='index.php?page=tambah_spk_masuk2';
		</script>";
		$_SESSION['tgl_spi']=$_POST['tgl_spk'];
		$_SESSION['no_spi']=$_POST['no_spk'];
		$_SESSION['keterangan']=$_POST['keterangan'];
		mysqli_query($koneksi, "delete from barang_teknisi_hash where akun_id=".$_SESSION['id']."");
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
        Tambah SPI
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="index.php?page=barang_masuk">Surat Perintah Instalasi</a></li>
        <li class="active">Tambah</li></ol></section>


    <!-- Main content -->
    <section class="content">
    
      <!-- Small boxes (Stat box) --><!-- /.row -->
      <!-- Main row -->
      <form id="frm-mhs" name="example_form" action="" method="POST" data-validate="parsley" enctype="multipart/form-data" >
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-6 connectedSortable">
          <!-- Custom tabs (Charts with tabs)--><!-- /.nav-tabs-custom -->

          <!-- Chat box -->
          <div class="box box-success"><!-- /.chat -->
            <div class="box-footer">
            <div class="box-header with-border">
              <h3 class="box-title">Tanggal SPI</h3>
            </div>
              <div class="box-body">
              <input name="tgl_spk" type="date" class="form-control" autofocus="autofocus" required="required" <?php echo $dis; ?>/>                                  
              </div>
            <div class="box-header with-border">
              <h3 class="box-title">No SPI</h3>
            </div>
              <div class="box-body">
              <input name="no_spk" type="text" class="form-control" required="required" <?php echo $dis; ?>/>
              
              </div>
              <div class="box-header with-border">
              <h3 class="box-title">Deskripsi</h3>
            </div>
              <div class="box-body">
              <input name="keterangan" type="text" class="form-control"/>
              <br />
              <button name="tambah_spk_masuk" type="submit" class="btn btn-success" style="padding:8px"><span class="fa fa-plus"></span> Next </button>
              
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

          <!-- Chat box --><!-- /.box (chat box) -->

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
	function changeValue(id_barang){  
		
		document.getElementById('pembeli').value = dtBrg[id_barang].nama_pembeli;
		document.getElementById('provinsi').value = dtBrg[id_barang].provinsi;
		document.getElementById('kabupaten').value = dtBrg[id_barang].kabupaten;
		document.getElementById('kecamatan').value = dtBrg[id_barang].kecamatan;
		document.getElementById('kelurahan').value = dtBrg[id_barang].kelurahan;
		document.getElementById('jalan').value = dtBrg[id_barang].jalan;
		document.getElementById('kontak_rs').value = dtBrg[id_barang].kontak_rs;
		document.getElementById('nama_pemakai').value = dtBrg[id_barang].nama_pemakai;
		document.getElementById('kontak1').value = dtBrg[id_barang].kontak1;
		document.getElementById('kontak2').value = dtBrg[id_barang].kontak2;
		document.getElementById('email').value = dtBrg[id_barang].email;
	};  
</script>
      <!-- /.row (main row) -->

  </section>
    <!-- /.content -->
  </div>
  
  <div id="tambahTeknisi" class="modalDialog">
     <div>
        <a href="#" title="Close" class="close">X</a>
        <h3 align="center">Tambah Teknisi Baru</h3> 
     <form method="post">
     <input name="nama_teknisi" id="input" type="text" required placeholder="Nama Teknisi"><br />
              
              <input name="bidang" id="input" type="text" placeholder="Bidang" required><br />
              <input name="no_str" id="input" placeholder="No STR" required><br />
              <input name="no_hp" id="input" type="text" placeholder="No HP" required><br />
              <input name="username" id="input" type="text" placeholder="Username" required><br />
              <input name="password" id="input" type="password" placeholder="Password" required><br />
              Ijazah
              <input name="ijazah" style="background-color:#FFF" id="input" type="file" /><br />
              Sertifikat
              <input name="sertifikat" id="input" type="file" style="background-color:#FFF"/><br />
        <button id="buttonn" name="tambahteknisibaru" type="submit">Simpan</button>
    </form>
    
    </div>
</div>
  