<?php 
if (isset($_GET['simpan_barang'])==1) {
	$s1=mysqli_query($koneksi, "insert into barang_dikirim_set values('','".$_GET['id']."','".$_SESSION['nama_paket']."','".$_SESSION['no_pengiriman']."','".$_SESSION['tgl_pengiriman']."','".$_SESSION['no_po']."','')");
	
	$max = mysqli_fetch_array(mysqli_query($koneksi, "select max(id) as id_max from barang_dikirim_set"));
	$q1 = mysqli_query($koneksi, "select * from barang_dijual_qty_set where barang_dijual_set_id=".$_GET['id']."");
	while ($d1 = mysqli_fetch_array($q1)) {
		mysqli_query($koneksi, "update barang_dijual_qty_set set status_kirim = 1 where id = ".$d1['id']."");
		$q2 = mysqli_query($koneksi, "select * from barang_dijual_qty_set_detail where barang_dijual_qty_set_id = ".$d1['id']."");
		while ($d2 = mysqli_fetch_array($q2)) {
			$total = $d2['qty_barang_gudang']*$d1['qty_set'];
			mysqli_query($koneksi, "update barang_gudang set stok = stok-$total where id=".$d2['barang_gudang_id']."");
			$brg_gudang = mysqli_query($koneksi, "select * from barang_gudang_detail where barang_gudang_id = ".$d2['barang_gudang_id']." order by id ASC LIMIT ".$total."");
			while ($d3 = mysqli_fetch_array($brg_gudang)) {
				$simpan2 = mysqli_query($koneksi, "insert into barang_dikirim_set_detail values('','".$max['id_max']."','".$d1['id']."','".$d2['id']."','".$d3['id']."','0')");
				mysqli_query($koneksi, "update barang_gudang_detail set status_kirim = 1 where id=".$d3['id']."");
				}
			}
		
		//$s = mysqli_query($koneksi, "insert into barang_dikirim_detail_set values('','".$max['id_max']."','".$d['barang_dijual_qty_set_id']."','')");
		//$up_stok = mysqli_query($koneksi, "update barang_gudang_set_2,barang_dijual_qty_set set qty=qty-qty_jual,status_kirim=1 where barang_gudang_set_2.id=barang_dijual_qty_set.barang_gudang_set2_id and barang_dijual_qty_set.id=".$d['barang_dijual_qty_set_id']."");
		//$up_status = mysqli_query($koneksi, "update barang_gudang_detail set status_kirim=1 where id=".$d['barang_gudang_detail_id']."");
		}
	if ($s1 and $simpan2) {
		echo "<script>
		alert('Data Pengiriman Berhasil Disimpan !');
		window.location='index.php?page=pengiriman_barang_set'</script>";
		}
}

if (isset($_POST['ubah_qty_set'])) {
  $up = mysqli_query($koneksi, "update barang_dijual_qty_set set qty_set='" . str_replace(".", "", $_POST['qty_jual_set']) . "' where id=" . $_POST['id_ubah_set'] . "");
  if ($up) {
    echo "<script>
		window.location='index.php?page=simpan_kirim_barang_set&id=$_GET[id]';
		
		</script>";
  }
}

if (isset($_POST['ubah_qty_satuan'])) {
  $up = mysqli_query($koneksi, "update barang_dijual_qty_set_detail set qty_barang_gudang='" . str_replace(".", "", $_POST['qty_jual_satuan']) . "' where id=" . $_POST['id_ubah_satuan'] . "");
  if ($up) {
    echo "<script>
		window.location='index.php?page=simpan_kirim_barang_set&id=$_GET[id]';
		
		</script>";
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
      Pengiriman Alkes (Set)</h1><ol class="breadcrumb">
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
              <div align="center">
              <font class="" size="+2">
                  Barang Yang Akan Dikirim</font><br /><font class="" color="#FF0000"><?php /*
				  $qty = mysqli_query($koneksi, "select *,barang_dijual_qty_set.id as id_qty from barang_dijual_qty_set,barang_gudang_set where barang_gudang_set.id=barang_dijual_qty_set.barang_gudang_set_id and barang_dijual_set_id=".$_GET['id']."");
				  while ($d_qty = mysqli_fetch_array($qty)) {
					  $sel = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_dikirim_detail where barang_dijual_qty_id=".$d_qty['id_qty'].""));
					  echo $d_qty['nama_brg']." (".($d_qty['qty_jual']-$sel).")<br>";
					  }
				  */
				  ?></font>
                  </div>
                  <!--<font color="#FF0000">* Jika Ingin Menambah Data Aksesoris Yang Baru ! Klik Disini <a href="index.php?page=simpan_tambah_aksesoris&id=<?php //echo $_GET['id']; ?>#openAkse"><small data-toggle="tooltip" title="Tambah Aksesoris Baru" class="label bg-blue">+ New Accessories</small></a></font>
                  <button name="tambah" class="btn btn-success pull-left" type="button" data-toggle="modal" data-target="#modal-tambah"><span class="fa fa-plus"></span> Tambah</button>-->
               <br />
                <table width="100%" id="example1" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th valign="bottom" width="3%">No</th>
      <th valign="bottom"><strong>Nama Barang</strong> (Set)     </th>
      <td align="center" valign="bottom"><strong>Merk      
      (Set)</strong><td align="center" valign="bottom"><strong>Qty Jual (Set)</strong><td align="center" valign="bottom" width="5%"><strong>Aksi</strong></tr>
  </thead>
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
    <td align="center"><?php echo $data_akse['merk_brg']; ?></td>
    <td align="center"><?php echo $data_akse['qty_set']; ?></td>
    <td align="center">
    <a href="#" data-toggle="modal" data-target="#modal-edit-set<?php echo $data_akse['idd']; ?>"><span data-toggle="tooltip" title="Edit Qty Jual (Set)" class="fa fa-edit"></span></a>
    <?php if ($jm > 1) { ?>
    &nbsp;
    <a href="index.php?page=simpan_kirim_barang_set&id_hapus=<?php echo $data_akse['idd']; ?>" onclick="return confirm('Yakin Akan Menghapus Item Ini ?')"><span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span></a>
    <?php } ?>
    </td>
    </tr>
    <div class="modal fade" id="modal-edit-set<?php echo $data_akse['idd']; ?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Ubah Qty Jual (Set)</h4>
      </div>
      <form method="post" enctype="multipart/form-data">
        <div class="modal-body">
        <input type="hidden" name="id_ubah_set" value="<?php echo $data_akse['idd']; ?>" />
          <label>Nama Barang Set</label>
          <input name="nama_brg" class="form-control" type="text" value="<?php echo $data_akse['nama_brg'] ?>" disabled="disabled">
          <br />
          <label>Qty Jual (Set)</label>
          <input id="nominal" name="qty_jual_set" class="form-control" type="number" placeholder="" value="<?php echo $data_akse['qty_set'] ?>" required="required"><br />

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <button name="ubah_qty_set" class="btn btn-info" type="submit"><span class="fa fa-check"></span> Simpan Perubahan</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
    <tr>
    <td></td>
    <td colspan="4" style="padding:0px">
    <table width="100%" class="table table-bordered">
    <tr class="bg-info">
          <td colspan="9" align="center"><strong>Rincian Satuan Barang</strong></td>
          </tr>
    <tr>
          <td width="3%"><strong>No</strong></td>
          <td><strong>Nama Barang (Satuan)</strong></td>
          <td><strong>Tipe Barang</strong></td>
          <td><strong>Stok Sisa</strong>
          </td>
          <td><table>
          <tr><td width="20px" class="bg-success">&nbsp;</td><td>&nbsp;Mencukupi</td></tr>
          <tr><td class="bg-danger">&nbsp;</td><td>&nbsp;Tidak Mencukupi</td></tr>
          </table></td>
          <td><strong>Qty Jual (Satuan)</strong></td>
          <td><strong>Qty Jual (Total = Set * Satuan)</strong></td>
          <td align="center" width="4%"><strong>Aksi</strong></td>
          </tr>
        <?php
    $q2 = mysqli_query($koneksi, "select *,barang_dijual_qty_set_detail.id as idd from barang_dijual_qty_set_detail, barang_gudang where barang_gudang.id=barang_dijual_qty_set_detail.barang_gudang_id and barang_dijual_qty_set_id=".$data_akse['idd']."");
	$no2 = 0;
	while ($dt = mysqli_fetch_array($q2)) {
		$no2++;
		$stok_total = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_gudang_detail where status_kirim=0 and status_kerusakan=0 and status_kembali_ke_gudang=0 and barang_gudang_id=" . $dt['barang_gudang_id'] . ""));
		  $stok_po1 = mysqli_fetch_array(mysqli_query($koneksi, "select sum(qty_jual) as stok_po from barang_dijual_qty where barang_gudang_id=" . $dt['barang_gudang_id'] . ""));
		  $stok_po2 = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_dikirim_detail,barang_gudang_detail,barang_dijual_qty where barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dijual_qty.id=barang_dikirim_detail.barang_dijual_qty_id and barang_dijual_qty.barang_gudang_id=" . $dt['barang_gudang_id'] . ""));
		?>        
        <tr>
          <td><?php echo $no.".".$no2 ?></td>
          <td><?php echo $dt['nama_brg'] ?></td>
          <td><?php echo $dt['tipe_brg'] ?></td>
          <td colspan="2" <?php if ($stok_total - ($stok_po1['stok_po'] - $stok_po2) < ($data_akse['qty_set']*$dt['qty_barang_gudang'])) {echo "class='bg-danger'";}else{echo "class='bg-success'";} ?>><?php
          //echo $dt['stok']
		  echo $stok_total - ($stok_po1['stok_po'] - $stok_po2);
		  ?>
          </td>
          <td><?php echo $dt['qty_barang_gudang'] ?></td>
          <td><?php echo $data_akse['qty_set']*$dt['qty_barang_gudang']; ?>
          <div class="pull-right">
          <small class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-lihat<?php echo $dt['idd'] ?>">
                            <i class="fa fa-eye"></i> No. Seri
                          </small>
          </div>
          </td>
          <td align="center" width="5%">
          <a href="#" data-toggle="modal" data-target="#modal-edit-satuan<?php echo $dt['idd']; ?>"><span data-toggle="tooltip" title="Edit Qty (Satuan)" class="fa fa-edit"></span></a>
          &nbsp;
          <a href="index.php?page=simpan_kirim_barang_set&id_hapus=<?php echo $data_akse['idd']; ?>" onclick="return confirm('Yakin Akan Menghapus Item Ini ?')"><span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span></a></td>
          </tr>
          <div class="modal fade" id="modal-lihat<?php echo $dt['idd'] ?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Rincian No. Seri Barang Yang Akan Dipakai</h4>
      </div>
        <div class="modal-body">
          <div class="box-title"><?php echo $dt['nama_brg']; ?><div class="pull pull-right">Jumlah Total : <?php echo $data_akse['qty_set']*$dt['qty_barang_gudang']; ?></div></div>
          <div class="box box-body col-lg-10">
          <div class="row">
          <div class="col-lg-1 bg-info text-center" style="padding:5px; border:1px solid;"><strong>No</strong></div>
          <div class="col-lg-7 bg-info" style="padding:5px; border:1px solid;"><strong>No.Seri Barang</strong></div>
          <div align="center" class="col-lg-2 bg-info" style="padding:5px; border:1px solid"><strong>No. Bath</strong></div>
          <div align="center" class="col-lg-2 bg-info" style="padding:5px; border:1px solid"><strong>No. Lot</strong></div>
          </div>
          <?php
		  $no3=0;
          $q_satuan = mysqli_query($koneksi, "select * from barang_gudang_detail where barang_gudang_id = ".$dt['barang_gudang_id']." order by id ASC LIMIT ".($data_akse['qty_set']*$dt['qty_barang_gudang'])."");
		  while ($dt2 = mysqli_fetch_array($q_satuan)) {
		  $no3++;
		  ?>
          <div class="row">
          <div class="col-lg-1 bg-info text-center" style="padding:5px; border:1px solid;"><strong><?php echo $no3 ?></strong></div>
          <div class="col-lg-7" style="padding:5px; border:1px solid"><?php echo $dt2['no_seri_brg'] ?>&nbsp;</div>
          <div align="center" class="col-lg-2" style="padding:5px; border:1px solid"><?php echo $dt2['no_bath'] ?>&nbsp;</div>
          <div align="center" class="col-lg-2" style="padding:5px; border:1px solid"><?php echo $dt2['no_lot'] ?>&nbsp;</div>
          </div>
          <?php } ?>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          
        </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<div class="modal fade" id="modal-edit-satuan<?php echo $dt['idd']; ?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Ubah Qty Jual (Satuan)</h4>
      </div>
      <form method="post" enctype="multipart/form-data">
        <div class="modal-body">
        <input type="hidden" name="id_ubah_satuan" value="<?php echo $dt['idd']; ?>" />
          <label>Nama Barang</label>
          <input name="nama_brg" class="form-control" type="text" value="<?php echo $dt['nama_brg'] ?>" disabled="disabled">
          <br />
          <label>Qty Jual (Set)</label>
          <input id="nominal" name="qty_jual_satuan" class="form-control" type="number" placeholder="" value="<?php echo $dt['qty_barang_gudang'] ?>" required="required"><br />

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <button name="ubah_qty_satuan" class="btn btn-info" type="submit"><span class="fa fa-check"></span> Simpan Perubahan</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
        <?php
		}
	?>
        </table>
    </td>
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