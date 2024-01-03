
<?php
if (isset($_POST['tambah_laporan'])) {
	$Result = mysqli_query($koneksi, "insert into barang_gudang values('','".$_POST['nama_barang']."','".$_POST['tipe']."','".$_POST['merk']."','".$_POST['nie']."', '".$_POST['no_bath']."', '".$_POST['no_lot']."','".$_POST['negara_asal']."','".$_POST['stok']."', '".$_POST['deskripsi']."','".$_POST['harga_beli']."','".$_POST['harga_satuan']."','0')");
	if ($Result) {
		echo "<script type='text/javascript'>
		alert('Data Berhasil Di Tambah !');
		</script>";
		}
	}
if (isset($_POST['tambah_aksesoris'])) {
	//mysqli_query($koneksi, "delete from barang_pesan_hash");
	//$Result = mysqli_query($koneksi, "insert into barang_gudang values('','".$_POST['nama_barang']."','".$_POST['tipe']."','".$_POST['merk']."','".$_POST['nie']."', '".$_POST['no_bath']."', '".$_POST['no_lot']."','".$_POST['negara_asal']."','".$_POST['stok']."', '".$_POST['deskripsi']."','".$_POST['harga_satuan']."','0')");
	//if ($Result) {
		//$max = mysqli_fetch_array(mysqli_query($koneksi, "select max(id) as maks from barang_gudang"));
		/*echo "<script type='text/javascript'>
		//window.location='index.php?page=simpan_tambah_aksesoris&id=$max[maks]';
		</script>";*/
	//}
	$jml = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_pesan_inventory where no_po_pesan='".$_POST['no_po']."'"));
	if ($jml==0) {
	mysqli_query($koneksi, "delete from barang_pesan_inven_detail_hash where akun_id=".$_SESSION['id']."");
	$_SESSION['tgl_po']=$_POST['tgl_po'];
	$_SESSION['no_po']=$_POST['no_po'];
	$_SESSION['id_princ']=$_POST['id_akse'];
	$_SESSION['ppn']=$_POST['ppn'];
	$_SESSION['cara_pembayaran']=$_POST['cara_pembayaran'];
	$_SESSION['mata_uang']=$_POST['mata_uang'];
	$_SESSION['alamat_pengiriman']=$_POST['alamat_pengiriman'];
	$_SESSION['jalur_pengiriman']=$_POST['jalur_pengiriman'];
	$_SESSION['estimasi_pengiriman']=$_POST['estimasi_pengiriman'];
	$_SESSION['catatan']=$_POST['catatan'];
	echo "<script type='text/javascript'>
	window.location='index.php?page=simpan_tambah_pemesanan_inven_sudah_ada';
		</script>";
	} else {
		echo "<script type='text/javascript'>
		alert('Maaf NO PO sudah ada !');
		history.back();
		</script>";
		}
	}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Tambah PO Dalam Negeri
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="index.php?page=barang_masuk">Alkes</a></li>
        <li class="active">Tambah Pesanan</li></ol></section>


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
              <h3 class="box-title">Detail Pesanan</h3>
            </div>
              <div class="box-body">
              
              Tanggal PO
              <input name="tgl_po" class="form-control" type="date"  placeholder="" required autofocus="autofocus"><br />
              No PO
              <input name="no_po" class="form-control" type="text"  placeholder="No. PO" required><br />
              PPN
              <input name="ppn" class="form-control" type="text" placeholder="PPN (Example : 10%)" ><br />
              Cara Pembayaran
              <input name="cara_pembayaran" class="form-control" type="text" placeholder="Cara Pembayaran (COD/Tempo)" ><br />
              Mata Uang
              <select class="form-control" name="mata_uang">
    <?php 
	$q_uang=mysqli_query($koneksi, "select * from mata_uang order by id ASC");
	while ($d_mu=mysqli_fetch_array($q_uang)) {
	?>
    <option value="<?php echo $d_mu['id']; ?>"><?php echo $d_mu['jenis_mu']; ?></option>
    <?php } ?>
    </select><br />
              Alamat Pengiriman
              <textarea name="alamat_pengiriman" class="form-control" placeholder="Alamat Pengiriman" rows="8">
PT. CIPTA VARIA KHARISMA UTAMA
Jl. Utan Kayu Raya No. 105A
Jakarta Timur 13120
INDONESIA

Telp. : +62 21 8511 303 / Fax. : +62 21 85 07 633
Attn : Mr. Made Sumarta
              </textarea><br />
             Jalur Pengiriman
              <input name="jalur_pengiriman" class="form-control" type="text" placeholder="Jalur Pengiriman" ><br />
              Estimasi Pengiriman Barang
              <input name="estimasi_pengiriman" class="form-control" type="date" placeholder="Estimasi Pengiriman" ><br />
              Catatan
              <textarea name="catatan" class="form-control" placeholder="Note" rows="4"></textarea><br />
              <br />
              </div>
            </div>
          </div>
          <!-- /.box (chat box) -->

          <!-- TO DO List --><!-- /.box -->

        <!-- quick email widget --></section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-6 connectedSortable">
          <!-- Custom tabs (Charts with tabs)--><!-- /.nav-tabs-custom -->

          <!-- Chat box -->
          <div class="box box-success"><!-- /.chat -->
            <div class="box-footer">
            <div class="box-header with-border">
              <h3 class="box-title">Principle</h3>
            </div>
              <div class="box-body">
              Nama Principle
              <div class="form-group">
              <select name="id_akse" id="id_akse" class="form-control select2" required onchange="changeValue(this.value)" style="width:100%">
    	<option>-- Pilih Principle --</option>
        <?php 
		$q = mysqli_query($koneksi, "select * from principle group by nama_principle order by nama_principle ASC");
		$jsArray = "var dtBrg = new Array();
";
		while ($d = mysqli_fetch_array($q)) { ?>
        <option value="<?php echo $d['id']; ?>"><?php echo $d['nama_principle']; ?></option>
        <?php 
		$jsArray .= "dtBrg['" . $d['id'] . "'] = {alamat_princ:'".str_replace("<br>","[Enter]",substr($d['alamat_principle'],0,30))."............',
						telp_princ:'".addslashes($d['telp_principle'])."',
						fax_princ:'".addslashes($d['fax_principle'])."',
						attn_princ:'".addslashes($d['attn_principle'])."'
						};";
		} ?>
        
    </select></div>
    <br />
    
              Alamat Principle
              <textarea name="alamat_princ" rows="4" disabled="disabled" class="form-control" id="alamat_princ" placeholder="" ></textarea><br />
              Telp. Principle
              <input name="telp_princ" type="text" disabled="disabled" class="form-control" id="telp_princ" placeholder="" ><br />
              Fax. Principle
              <input name="fax_princ" type="text" disabled="disabled" class="form-control" id="fax_princ" placeholder="" ><br />
             Attn Principle
              <input name="attn_princ" type="text" disabled="disabled" class="form-control" id="attn_princ" placeholder="" ><br />
              <button name="tambah_aksesoris" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Next</button>
              <br /><br />
               <script type="text/javascript">    
	<?php 
	echo $jsArray; 
	?>  
	function changeValue(id_akse){  
		document.getElementById('alamat_princ').value = dtBrg[id_akse].alamat_princ; 
		document.getElementById('telp_princ').value = dtBrg[id_akse].telp_princ;
		document.getElementById('fax_princ').value = dtBrg[id_akse].fax_princ;
		document.getElementById('attn_princ').value = dtBrg[id_akse].attn_princ;
	};  
</script>
              
              </div>
            </div>
          </div>
          <!-- /.box (chat box) -->

          <!-- TO DO List --><!-- /.box -->

        <!-- quick email widget --></section>
        <!-- right col -->
      </div>
      </form>
      
      <!-- /.row (main row) -->

  </section>
    <!-- /.content -->
  </div>
  
  