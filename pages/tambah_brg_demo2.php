<?php 
if (isset($_GET['simpan_barang'])==1) {
	$s1=mysqli_query($koneksi, "insert into barang_demo values('','".$_SESSION['tgl_pinjam']."','".$_SESSION['supplier']."','".$_SESSION['kegiatan']."','".$_SESSION['id_pembeli']."','".$_SESSION['estimasi_kembali']."','".$_SESSION['subdis']."','".$_SESSION['pic']."')");
	
	$max = mysqli_fetch_array(mysqli_query($koneksi, "select max(id) as id_max from barang_demo"));
	$q = mysqli_query($koneksi, "select * from barang_demo_qty_hash where akun_id=".$_SESSION['id']."");
	while ($d = mysqli_fetch_array($q)) {
		$s = mysqli_query($koneksi, "insert into barang_demo_qty values('','".$max['id_max']."','".$d['barang_gudang_id']."','".$d['qty']."')");
		//$up_stok = mysqli_query($koneksi, "update barang_gudang,barang_gudang_detail set stok_total=stok_total-1 where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=".$d['barang_gudang_detail_id']."");
		//$up_status = mysqli_query($koneksi, "update barang_gudang_detail set status_demo=1 where id=".$d['barang_gudang_detail_id']."");
		}
	if ($s1 and $s) {
		mysqli_query($koneksi, "delete from barang_demo_qty_hash where akun_id=".$_SESSION['id']."");
		echo "<script>
		alert('Berhasil disimpan !');
		window.location='index.php?page=barang_demo'</script>";
		}
}


if (isset($_POST['simpan_tambah_aksesoris'])) {
	
	$simpan = mysqli_query($koneksi, "insert into barang_demo_qty_hash values('','".$_SESSION['id']."','".$_POST['id_akse']."','".$_POST['qty']."')");
	if ($simpan) {
		echo "<script>window.location='index.php?page=tambah_brg_demo2'</script>";
			}
	}
	
if (isset($_GET['id_hapus'])) {
	$del = mysqli_query($koneksi, "delete from barang_demo_qty_hash where id=".$_GET['id_hapus']."");
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
              <div class="box-body">
              <div class="">
              <div class="table-responsive">
              <table width="100%" id="" class="table table-bordered table-hover">
  <thead>
    <tr>
      <td valign="bottom"><strong>Tanggal Pinjam</strong></td>
      <td valign="bottom"><strong>Supplier</strong></td>
      <td valign="bottom"><strong>Kegiatan</strong></td>
      <td valign="bottom"><strong>Rumah Sakit/Dinas/Dll</strong></td>
      <td valign="bottom"><strong>Estimasi Kembali</strong></td>
      <td valign="bottom"><strong>Subdis</strong></td>
      <td valign="bottom"><strong>PIC</strong></td>
      </tr>
    <tr>
      <td valign="bottom"><?php echo date("d-m-Y",strtotime($_SESSION['tgl_pinjam'])); ?></td>
      <td valign="bottom"><?php echo $_SESSION['supplier']; ?></td>
      <td valign="bottom"><?php echo $_SESSION['kegiatan']; ?></td>
      <td valign="bottom"><?php 
	  $pem = mysqli_fetch_array(mysqli_query($koneksi, "select * from pembeli where id=".$_SESSION['id_pembeli'].""));
	  echo $pem['nama_pembeli']; ?></td>
      <td valign="bottom"><?php echo $_SESSION['estimasi_kembali']; ?></td>
      <td valign="bottom"><?php echo $_SESSION['subdis']; ?></td>
      <td valign="bottom"><?php echo $_SESSION['pic']; ?></td>
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
              </div>
              <!--<a href="index.php?page=tambah_barang_masuk"><button name="tambah_laporan" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Tambah Barang</button></a>-->
              <br /><br />
              <font class="" size="+2">
                Data Barang Demo</font>
                  <font class="" color="#FF0000"><?php 
				  $qty = mysqli_query($koneksi, "select *,barang_dijual_qty.id as id_qty from barang_dijual_qty,barang_gudang where barang_gudang.id=barang_dijual_qty.barang_gudang_id and barang_dijual_id=".$_GET['id']."");
				  while ($d_qty = mysqli_fetch_array($qty)) {
					  $sel = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_dikirim_detail where barang_dijual_qty_id=".$d_qty['id_qty'].""));
					  echo "Kuantitas ".$d_qty['nama_brg']." (".($d_qty['qty_jual']-$sel).")<br>";
					  }
				  
				  ?></font>
                  <!--<font color="#FF0000">* Jika Ingin Menambah Data Aksesoris Yang Baru ! Klik Disini <a href="index.php?page=simpan_tambah_aksesoris&id=<?php //echo $_GET['id']; ?>#openAkse"><small data-toggle="tooltip" title="Tambah Aksesoris Baru" class="label bg-blue">+ New Accessories</small></a></font>-->
               <button name="tambah_laporan" class="btn btn-success pull pull-right" type="button" data-toggle="modal" data-target="#modal-pilihnoseri"><span class="fa fa-plus"></span> Tambah </button>
               <br /><br />
                <div class="table-responsive">
                <table width="100%" id="example1" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th valign="bottom">No</th>
      <th valign="bottom"><strong>Nama Alkes</strong></th>
      <td align="center" valign="bottom"><strong>Tipe      
      </strong></td>
      <td align="center" valign="bottom"><strong>Merk      
      </strong></td>
      <td align="center" valign="bottom"><strong>NIE      
      </strong></td>
      <td align="center" valign="bottom"><strong>Qty</strong></td>
      <td align="center" valign="bottom"><strong>Aksi</strong></td>
     </tr>
  </thead>
  
  
  <?php
   
  $no=0;
  $q_akse = mysqli_query($koneksi, "select *,barang_demo_qty_hash.id as idd from barang_demo_qty_hash,barang_gudang where barang_gudang.id=barang_demo_qty_hash.barang_gudang_id and akun_id=".$_SESSION['id']."");
  
  while ($data_akse = mysqli_fetch_array($q_akse)) {
	  $no++;
  ?>
  <tr>
    <td><?php echo $no; ?></td>
    <td><?php echo $data_akse['nama_brg']; ?>
    </td>
    <td align="center"><?php echo $data_akse['tipe_brg']; ?></td>
    <td align="center"><?php echo $data_akse['merk_brg']; ?></td>
    <td align="center"><?php echo $data_akse['nie_brg']; ?></td>
    <td align="center"><?php echo $data_akse['qty']; ?></td>
    <td align="center"><a href="index.php?page=tambah_brg_demo2&id_hapus=<?php echo $data_akse['idd']; ?>" onclick="return confirm('Yakin Akan Menghapus Item Ini ?')"><span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span></a></td>
    </tr>
  <?php } ?>
</table>
                </div>
<center><a href="index.php?page=tambah_brg_demo2&simpan_barang=1"><button name="simpan_barang" class="btn btn-success" type="submit"><span class="fa fa-check"></span> Simpan</button></a></center>
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
<div class="modal fade" id="modal-pilihnoseri">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
              
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" align="center">Pilih/Tambah No Seri</h4>
              </div>
              <form method="post" enctype="multipart/form-data">
              <div class="modal-body">
              
      <select name="id_akse" id="id_akse" class="form-control select2" autofocus="autofocus" required onchange="changeValue(this.value)" style="width:100%">
        <option value="">-- Pilih Alkes</option>
        
        <?php 
		$q = mysqli_query($koneksi, "select *,barang_gudang.id as idd from barang_gudang where stok_total!=0 order by nama_brg ASC");
		$jsArray = "var dtBrg = new Array();
";
		while ($d = mysqli_fetch_array($q)) { ?>
        <option value="<?php echo $d['idd']; ?>"><?php echo $d['nama_brg']; ?></option>
        <?php 
		$jsArray .= "dtBrg['" . $d['idd'] . "'] = {tipe_akse:'".addslashes($d['tipe_brg'])."',
						merk_akse:'".addslashes($d['merk_brg'])."',
						no_akse:'".addslashes($d['nie_brg'])."'
						};";
		} ?>
        </select>
    <br /><br />
    <input id="tipe_akse" name="tipe_akse" class="form-control" type="text" placeholder="Tipe" disabled="disabled"/>
    <br />
    <input id="merk_akse" name="merk_akse" class="form-control" type="text" placeholder="Merk" disabled="disabled"/>
    
    <br />
    <input id="no_akse" name="no_akse" class="form-control" type="text" placeholder="No Akse" disabled="disabled" />
    <br />
    <input id="qty" name="qty" class="form-control" type="text" placeholder="Angka" size="4"/>
    
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success" name="simpan_tambah_aksesoris">Simpan</button>
              </div>
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
            <!-- /.modal-content -->
  </div>
          <!-- /.modal-dialog -->
</div>
