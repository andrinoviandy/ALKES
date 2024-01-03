<?php
if (isset($_POST['tambah_spk_masuk'])) {
	echo "<script type='text/javascript'>
		window.location='index.php?page=pilih_peminjaman_barang';
		</script>";
		mysqli_query($koneksi, "delete from barang_pinjam_hash where akun_id=".$_SESSION['id']."");
		$_SESSION['tgl']=$_POST['tgl'];
		$_SESSION['kegiatan']=$_POST['kegiatan'];
		$_SESSION['barang_dikirim_id']=$_POST['nomor_po'];
		$_SESSION['estimasi']=$_POST['estimasi'];
		
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
        Tambah Peminjaman Barang
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="index.php?page=barang_masuk">Tambah Peminjaman Barang</a></li></ol></section>


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
              <h3 class="box-title">Tanggal Peminjaman</h3>
            </div>
              <div class="box-body">
              <input name="tgl" type="date" class="form-control" autofocus="autofocus" required="required" />                                  
              </div>
            <div class="box-header with-border">
              <h3 class="box-title">Kegiatan</h3>
            </div>
              <div class="box-body">
              <textarea name="kegiatan" rows="4" class="form-control" required="required"></textarea>                                  
              </div>
              <div class="box-header with-border">
              <h3 class="box-title">Rumah Sakit/Dinas/Dll - (No. Surat Jalan / No. PO)</h3>
            </div>
              <div class="box-body">
              
              <select name="nomor_po" class="form-control select2" style="width:100%" required>
              <option value="">-- Pilih  --</option>
			  <?php $q = mysqli_query($koneksi, "select *,barang_dikirim.id as idd from barang_dikirim,barang_dikirim_detail,barang_dijual,pembeli,barang_gudang,barang_gudang_detail where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and pembeli.id=barang_dijual.pembeli_id and barang_dijual.id=barang_dikirim.barang_dijual_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id group by barang_dikirim.no_pengiriman order by barang_dikirim.no_pengiriman ASC");
			  while ($d =mysqli_fetch_array($q)) {
			   ?>
              <option value="<?php echo $d['idd']; ?>"><?php echo $d['nama_pembeli']." - (".$d['no_pengiriman']." - ".$d['no_po_jual'].")"; ?></option>
              <?php } ?>
              </select>
                                                
              </div>
            <div class="box-header with-border">
              <h3 class="box-title">Estimasi Pengembalian</h3>
            </div>
              <div class="box-body">
              <input name="estimasi" type="date" class="form-control" autofocus="autofocus" />                                  
              </div>
            <div class="box-header with-border">
             
            </div>
              <div class="box-body">
              <button name="tambah_spk_masuk" type="submit" value="Simpan" class="btn btn-success" style="padding:20px"><span class="fa fa-plus"></span>Next</button>
              <br />
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
		document.getElementById('tipe').value = dtBrg[id_barang].tipe; 
		document.getElementById('merk').value = dtBrg[id_barang].merk;
		document.getElementById('nie').value = dtBrg[id_barang].nie;
		document.getElementById('no_bath').value = dtBrg[id_barang].no_bath;
		document.getElementById('no_lot').value = dtBrg[id_barang].no_lot;
		document.getElementById('no_seri').value = dtBrg[id_barang].no_seri;
		document.getElementById('pembeli').value = dtBrg[id_barang].nama_pembeli;
		document.getElementById('provinsi').value = dtBrg[id_barang].provinsi;
		document.getElementById('kabupaten').value = dtBrg[id_barang].kabupaten;
		document.getElementById('kecamatan').value = dtBrg[id_barang].kecamatan;
		document.getElementById('kelurahan').value = dtBrg[id_barang].kelurahan;
		document.getElementById('jalan').value = dtBrg[id_barang].jalan;
		document.getElementById('nama_pemakai').value = dtBrg[id_barang].nama_pemakai;
		document.getElementById('kontak').value = dtBrg[id_barang].kontak;
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
  