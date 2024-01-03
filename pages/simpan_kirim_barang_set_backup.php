<?php 
if (isset($_GET['simpan_barang'])==1) {
	$s1=mysqli_query($koneksi, "insert into barang_dikirim_set values('','".$_GET['id']."','".$_SESSION['nama_paket']."','".$_SESSION['no_pengiriman']."','".$_SESSION['tgl_pengiriman']."','".$_SESSION['no_po']."','')");
	
	$max = mysqli_fetch_array(mysqli_query($koneksi, "select max(id) as id_max from barang_dikirim_set"));
	$q = mysqli_query($koneksi, "select * from barang_dikirim_detail_set_hash where akun_id=".$_SESSION['id']."");
	while ($d = mysqli_fetch_array($q)) {
		$s = mysqli_query($koneksi, "insert into barang_dikirim_detail_set values('','".$max['id_max']."','".$d['barang_dijual_qty_set_id']."','')");
		$up_stok = mysqli_query($koneksi, "update barang_gudang_set_2,barang_dijual_qty_set set qty=qty-qty_jual,status_kirim=1 where barang_gudang_set_2.id=barang_dijual_qty_set.barang_gudang_set2_id and barang_dijual_qty_set.id=".$d['barang_dijual_qty_set_id']."");
		//$up_status = mysqli_query($koneksi, "update barang_gudang_detail set status_kirim=1 where id=".$d['barang_gudang_detail_id']."");
		}
	if ($s1 and $s and $up_stok) {
		mysqli_query($koneksi, "delete from barang_dikirim_detail_set_hash where akun_id=".$_SESSION['id']."");
		echo "<script>
		alert('Berhasil disimpan !');
		window.location='index.php?page=pengiriman_barang_set'</script>";
		}
}


if (isset($_POST['simpan_tambah_aksesoris'])) {
	//$no=mysqli_num_rows(mysqli_query($koneksi, "select * from barang_dijual_hash"))+1;
	/*$cek = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_gudang,barang_gudang_detail,barang_dijual_detail,barang_dijual where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dijual_detail.barang_gudang_detail_id and barang_dijual.id=barang_dijual_detail.barang_dijual_id and barang_dijual.id=".$_GET['id']." and barang_gudang.id=".$_POST['id_akse'].""));
	$cek2 = mysqli_fetch_array(mysqli_query($koneksi, "select * from barang_dijual_qty,barang_gudang where barang_gudang.id=barang_dijual_qty.barang_gudang_id and barang_dijual_id=".$_GET['id']." and barang_gudang.id=".$_POST['id_akse'].""));
	
	if ($cek>$cek2['qty_jual']) {
		echo "<script>
		alert('Maaf jumlah dengan alkes ini sudah terpenuhi !');
		window.location='index.php?page=pilih_no_seri&id=$_GET[id]'</script>";
		}
	else {*/
	//mysqli_query($koneksi, "");
	$simpan = mysqli_query($koneksi, "insert into barang_dikirim_detail_set_hash values('','".$_SESSION['id']."','".$_POST['nama_set']."')");
	if ($simpan) {
		echo "<script>window.location='index.php?page=simpan_kirim_barang_set&id=$_GET[id]'</script>";
			}
	}
	
if (isset($_GET['id_hapus'])) {
	$del = mysqli_query($koneksi, "delete from barang_dikirim_detail_set_hash where id=".$_GET['id_hapus']."");
	}
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Pengiriman Alkes</h1><ol class="breadcrumb">
       <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"> Pengiriman Alkes</li>
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
              <table width="100%" id="" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th valign="bottom"><strong>Nama Paket</strong></th>
      <td align="center" valign="bottom"><strong>No. Pengiriman</strong></td>
      <td align="center" valign="bottom"><strong>Tanggal Pengiriman</strong></td>
      <td align="center" valign="bottom"><strong>No. Faktur      
      </strong></td>
     </tr>
    <tr>
      <th valign="bottom"><?php echo $_SESSION['nama_paket']; ?></th>
      <td align="center" valign="bottom"><?php echo $_SESSION['no_pengiriman']; ?></td>
      <td align="center" valign="bottom"><?php echo date("d-m-Y",strtotime($_SESSION['tgl_pengiriman'])); ?></td>
      <td align="center" valign="bottom"><?php echo $_SESSION['no_po']; ?></td>
      </tr>
  </thead>
  
  <script type="text/javascript">    
	<?php 
	echo $jsArray; 
	?>  
	function changeValue(id_akse){  
		document.getElementById('tipe_akse').value = dtBrg[id_akse].tipe_akse; 
		document.getElementById('merk_akse').value = dtBrg[id_akse].merk_akse;
		document.getElementById('no_akse').value = dtBrg[id_akse].no_akse;
		document.getElementById('harga').value = dtBrg[id_akse].harga;
	};  
</script>
  <?php
   
  $no=0;
  $q_akse = mysqli_query($koneksi, "select *,barang_dijual_detail.id as idd from barang_dijual_detail,barang_gudang_detail,barang_gudang where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dijual_detail.barang_gudang_detail_id and barang_dijual_detail.barang_dijual_id=".$_GET['id']."");
  $jm = mysqli_num_rows($q_akse);
  if ($jm!=0) { 
  while ($data_akse = mysqli_fetch_array($q_akse)) {
	  $no++;
  ?>
  <?php }} ?>
</table>
              <!--<a href="index.php?page=tambah_barang_masuk"><button name="tambah_laporan" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Tambah Barang</button></a>-->
              <br /><br />
              <div class="pull pull-right">
              <font class="" size="+2">
                  Pilih  Nama Set Yang Akan Dikirim</font><br /><font class="" color="#FF0000"><?php 
				  $qty = mysqli_query($koneksi, "select *,barang_dijual_qty_set.id as id_qty from barang_dijual_qty_set,barang_gudang_set where barang_gudang_set.id=barang_dijual_qty_set.barang_gudang_set_id and barang_dijual_set_id=".$_GET['id']."");
				  while ($d_qty = mysqli_fetch_array($qty)) {
					  $sel = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_dikirim_detail where barang_dijual_qty_id=".$d_qty['id_qty'].""));
					  echo $d_qty['nama_brg']." (".($d_qty['qty_jual']-$sel).")<br>";
					  }
				  
				  ?></font>
                  </div>
                  <!--<font color="#FF0000">* Jika Ingin Menambah Data Aksesoris Yang Baru ! Klik Disini <a href="index.php?page=simpan_tambah_aksesoris&id=<?php //echo $_GET['id']; ?>#openAkse"><small data-toggle="tooltip" title="Tambah Aksesoris Baru" class="label bg-blue">+ New Accessories</small></a></font>-->
                  <button name="tambah" class="btn btn-success pull-left" type="button" data-toggle="modal" data-target="#modal-tambah"><span class="fa fa-plus"></span> Tambah</button>
               
                <table width="100%" id="example1" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th valign="bottom">No</th>
      <th valign="bottom"><strong>Nama Barang</strong></th>
      <td align="center" valign="bottom"><strong>Pilih Set</strong>      
      <td align="center" valign="bottom"><strong>Nama Set</strong>      
      <td align="center" valign="bottom"><strong>Qty Jual</strong>
      <td align="center" valign="bottom"><strong>Aksi</strong></tr>
  </thead>
  
  <tr>
    <td>#</td>
    <form method="post" name="form1" enctype="multipart/form-data">
    <td>
    <select name="id_akse" id="id_akse" class="form-control" autofocus="autofocus" required="required">
    	<option>-- Pilih Barang --</option>
        <?php 
		$q = mysqli_query($koneksi, "select *,barang_gudang_set.id as idd from barang_gudang_set,barang_gudang_set_1,barang_gudang_set_2,barang_gudang_po_set,barang_dijual_qty_set where barang_gudang_set.id=barang_gudang_po_set.barang_gudang_set_id and barang_gudang_po_set.id=barang_gudang_set_1.barang_gudang_po_set_id and barang_gudang_set_1.id=barang_gudang_set_2.barang_gudang_set1_id and barang_gudang_set_2.id=barang_dijual_qty_set.barang_gudang_set2_id and barang_dijual_set_id=".$_GET['id']." group by nama_brg order by nama_brg ASC");
		$jsArray = "var dtBrg2 = new Array();
";
		while ($d = mysqli_fetch_array($q)) { ?>
        <option value="<?php echo $d['idd']; ?>"><?php echo $d['nama_brg']; ?></option>
        <?php 
	  $jsArray .= "dtBrg2['" . $d['idd'] . "'] = {qty_jual:'".addslashes($d['qty_jual'])."',
	  harga_satuan:'".addslashes(number_format($d['harga_jual'],2,'.',','))."'
						};";
	  } ?>
    </select>
    </td>
    <td align="center"><select name="pilih_set" id="pilih_set" class="form-control" required="required">
      <option value="">--Pilih--</option>
      <?php
	$q_seri = mysqli_query($koneksi, "select *,barang_gudang_set.id as idd, barang_gudang_set_1.id as id_set1 from barang_gudang_set,barang_gudang_set_1,barang_gudang_set_2,barang_gudang_po_set,barang_dijual_qty_set where barang_gudang_set.id=barang_gudang_po_set.barang_gudang_set_id and barang_gudang_po_set.id=barang_gudang_set_1.barang_gudang_po_set_id and barang_gudang_set_1.id=barang_gudang_set_2.barang_gudang_set1_id and barang_gudang_set_2.id=barang_dijual_qty_set.barang_gudang_set2_id and barang_dijual_set_id=".$_GET['id']." group by barang_gudang_set_1.id order by barang_gudang_set_1.id ASC");
	while ($d_seri=mysqli_fetch_array($q_seri)) {
	?>
      <option id="pilih_set" value="<?php echo $d_seri['id_set1']; ?>" class="<?php echo $d_seri['idd']; ?>"><?php echo "ID ".$d_seri['id_set1']; ?></option>
      <?php } ?>
    </select></td>
    <td align="center"><select name="nama_set" id="nama_set" class="form-control" onchange="changeValue(this.value)">
      <option value="">-- Semua Nya --</option>
      <?php
	$q_seri2 = mysqli_query($koneksi, "select *,barang_gudang_set.id as idd, barang_gudang_set_1.id as id_set1, barang_gudang_set_2.id as id_set2 from barang_gudang_set,barang_gudang_po_set,barang_gudang_set_1,barang_gudang_set_2 where barang_gudang_set.id=barang_gudang_po_set.barang_gudang_set_id and barang_gudang_po_set.id=barang_gudang_set_1.barang_gudang_po_set_id and barang_gudang_set_1.id=barang_gudang_set_2.barang_gudang_set1_id and qty!=0 order by barang_gudang_set_2.nama_set ASC");
	$jsArray2 = "var dtBrg2 = new Array();
";
	while ($d_seri=mysqli_fetch_array($q_seri2)) {
	?>
      <option id="nama_set" value="<?php echo $d_seri['id_set2']; ?>" class="<?php echo $d_seri['id_set1']; ?>"><?php echo $d_seri['nama_set']; ?></option>
      <?php 
	  $jsArray2 .= "dtBrg2['" . $d_seri['id_set2'] . "'] = {qty:'".addslashes($d_seri['qty'])."',
	  harga_satuan:'".addslashes(number_format($d_seri['harga_jual'],2,'.',','))."'
						};";
	  } ?>
      </select>
      <script src="jquery-1.10.2.min.js"></script>
      <script src="jquery.chained.min.js"></script>
      <script>
            $("#pilih_set").chained("#id_akse");
			$("#nama_set").chained("#pilih_set");
        </script>
    </td>
    <td align="center">
      <input id="qty_jual" name="qty_jual" class="form-control" type="text" placeholder="" size="2" disabled="disabled"/></td>
    <td align="center"><button name="simpan_tambah_aksesoris" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Tambah</button></td>
    </form>
  </tr>
  
<script type="text/javascript">    
	<?php 
	echo $jsArray2; 
	?>  
	function changeValue(nama_set){  
		document.getElementById('qty_jual').value = dtBrg2[nama_set].qty_jual;
	};  
</script>
  <?php
   
  $no=0;
  $q_akse = mysqli_query($koneksi, "select *,barang_dijual_qty_set.id as idd from barang_dijual_qty_set , barang_gudang_set where barang_gudang_set.id=barang_dijual_qty_set.barang_gudang_set_id and barang_dijual_set_id = ".$_GET['id']."");
  $jm = mysqli_num_rows($q_akse);
  if ($jm!=0) { 
  while ($data_akse = mysqli_fetch_array($q_akse)) {
	  $no++;
  ?>
  <tr>
    <td><?php echo $no; ?></td>
    <td><?php echo $data_akse['nama_brg']; ?>
    </td>
    <td align="center"><?php echo "ID ".$data_akse['id_set1']; ?></td>
    <td align="center"><?php echo $data_akse['nama_set']; ?></td>
    <td align="center"><?php echo $data_akse['qty_jual']; ?></td>
    <td align="center"><a href="index.php?page=simpan_kirim_barang_set&id_hapus=<?php echo $data_akse['idd']; ?>" onclick="return confirm('Yakin Akan Menghapus Item Ini ?')"><span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span></a></td>
    </tr>
  <?php }} else {
	  echo "<tr><td colspan='10' align='center'>Tidak Ada Data</td></tr>";
	  } ?>
</table>
<center><a href="index.php?page=simpan_kirim_barang_set&id=<?php echo $_GET['id']; ?>&simpan_barang=1"><button name="simpan_barang" class="btn btn-success" type="submit"><span class="fa fa-check"></span> Simpan</button></a></center>
<!--
<center><a href="index.php?page=simpan_jual_alkes2&simpan_barang=1"><button name="simpan_barang" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Simpan</button></a>&nbsp;&nbsp;<a href="index.php?page=jual_barang"><button name="batal" class="btn btn-success" type="submit"><span class="fa  fa-times-circle"></span> Batal</button></a></center>
-->
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
  if (isset($_POST['tambah_laporan'])) {
	$Result = mysqli_query($koneksi, "insert into aksesoris values('','".$_POST['nama_akse']."','".$_POST['merk']."','".$_POST['tipe']."','".$_POST['no_seri']."','".$_POST['stok']."', '".$_POST['deskripsi']."','".$_POST['harga_satuan']."')");
	if ($Result) {
		echo "<script type='text/javascript'>
		alert('Data Berhasil Di Tambah !');
		window.location='index.php?page=simpan_tambah_aksesoris&id=$_GET[id]';
		</script>";
		}
	}
		?>
  <div id="openAkse" class="modalDialog">
     <div>
        <a href="#" title="Close" class="close">X</a>
        <h3 align="center">Tambah Aksesoris Baru</h3> 
     <form method="post">
              <input name="nama_akse" class="form-control" type="text" required placeholder="Nama Aksesoris" autofocus><br />
              
              <input name="merk" class="form-control" type="text" placeholder="Merk" required><br />
              
              <input name="tipe" class="form-control" type="text" placeholder="Tipe" required><br />
              
              <input name="no" class="form-control" type="text" placeholder="Nomor Seri" required><br />
              
              <input name="stok" class="form-control" type="text" placeholder="Stok" required><br />
              
              <textarea name="deskripsi" class="form-control" type="text" rows="5" placeholder="Deskripsi Alat" required></textarea><br />
              <?php if (isset($_SESSION['user_administrator']) && isset($_SESSION['pass_administrator'])) { ?>
              <input name="harga_satuan" class="form-control" type="text" placeholder="Harga Satuan" required><br />
              <?php } ?>
              
              <button name="tambah_laporan" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Simpan</button>
              <br /><br />
              </form>
              
    </div>
</div>
<div class="modal fade" id="modal-tambah">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" align="center"><strong>Tambah Data</strong></h4>
      </div>
      <form method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <label>Nama Set</label>
          <select class="form-control" name="barang_dijual_qty_set_id" id="barang_dijual_qty_set_id" required>
     <option value="">...</option>
	 <?php $q1=mysqli_query($koneksi, "select *,barang_dijual_qty_set.id as idd from barang_dijual_qty_set, barang_gudang_set where barang_dijual_set_id = ".$_GET['id']." and barang_gudang_set.id=barang_dijual_qty_set.barang_gudang_set_id order by nama_brg ASC"); 
	 while ($row1=mysqli_fetch_array($q1)){
	 ?>
     <option value="<?php echo $row1['idd']; ?>"><?php echo $row1['nama_brg']; ?></option>
     <?php 
	 } ?>
     </select>
          <br />
          <label>Nama Barang</label>
          <select class="form-control" name="barang_gudang_id" id="barang_gudang_id" required>
     <option value="all1">Semua</option>
     <?php $q2=mysqli_query($koneksi, "select *,barang_dijual_qty_set_detail.id as idd from barang_dijual_qty_set_detail, barang_gudang, barang_dijual_qty_set where barang_gudang.id = barang_dijual_qty_set_detail.barang_gudang_id"); 
	 while ($row2=mysqli_fetch_array($q2)){
	 ?>
     <option id="barang_gudang_id" class="<?php echo $row2['barang_dijual_qty_set_id']; ?>" value="<?php echo $row2['idd']; ?>"><?php echo $row2['nama_brg']; ?></option>
     <?php } ?>
     </select>
          <br />
          <label>Qty Jual (Set)</label>
          <input id="qty" name="qty" class="form-control" type="number" placeholder="" size="2" />
          <br />
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <button name="simpan_tambah_aksesoris" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Tambah</button>
        </div>
        <script src="jquery-1.10.2.min.js"></script>
        <script src="jquery.chained.min.js"></script>
        <script>
            $("#barang_gudang_id").chained("#barang_dijual_qty_set_id");
            //$("#kecamatan").chained("#kota");
        </script>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>