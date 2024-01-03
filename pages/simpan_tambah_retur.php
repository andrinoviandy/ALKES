<?php
$s = mysqli_fetch_array(mysqli_query($koneksi, "select *,barang_gudang_detail.id as idd from barang_dikirim,barang_dikirim_detail,barang_dijual,pembeli,barang_gudang,barang_gudang_detail where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and pembeli.id=barang_dijual.pembeli_id and barang_dijual.id=barang_dikirim.barang_dijual_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and barang_dikirim.id=".$_SESSION['no_po_id'].""));
 
if (isset($_GET['simpan_barang'])==1) {
	$cek = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_kembali_hash where akun_id=".$_SESSION['id'].""));
	if ($cek!=0) {
	
	//$insert_pembeli=mysqli_query($koneksi, "insert into pembeli values('','".$_SESSION['pembeli']."','".$_SESSION['provinsi']."','".$_SESSION['kabupaten']."','".$_SESSION['kecamatan']."','".$_SESSION['kelurahan']."','".$_SESSION['alamat']."','".$_SESSION['kontak_rs']."')");
	
	//$insert_pemakai=mysqli_query($koneksi, "insert into pemakai values('','".$_SESSION['pemakai']."','".$_SESSION['kontak1']."','".$_SESSION['kontak2']."','".$_SESSION['email']."')");
	
	//$pembeli=mysqli_fetch_array(mysqli_query($koneksi, "select max(id) as id_pembeli from pembeli"));
	//$id_pembeli=$_SESSION['pembeli'];
	//$pemakai=mysqli_fetch_array(mysqli_query($koneksi, "select max(id) as id_pemakai from pemakai"));
	//$id_pemakai=$pemakai['id_pemakai'];
	//simpan barang dijual
	$ins_brg_kembali = mysqli_query($koneksi, "insert into barang_kembali(no_retur,tgl_retur,barang_dikirim_id,no_po_id) values('".$_SESSION['no_retur']."','".$_SESSION['tgl_retur']."','".$_SESSION['no_po_id']."','".$s['no_po_jual']."')");
	
	//$total = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_kembali_hash"));
	
	//$simpan1=mysqli_query($koneksi, "insert into aksesoris_jual values('','".$_SESSION['tgl_jual']."','$total','$id_pembeli')");
	
	$d1=mysqli_fetch_array(mysqli_query($koneksi, "select max(id) as id_kembali from barang_kembali"));
	$id_kembali=$d1['id_kembali'];
	//simpan barang pesan detail
	$q2=mysqli_query($koneksi, "select * from barang_kembali_hash where akun_id=".$_SESSION['id']."");
	while ($d2 = mysqli_fetch_array($q2)) {
		$simpan2=mysqli_query($koneksi, "insert into barang_kembali_detail(barang_kembali_id,barang_gudang_detail_id) values('$id_kembali','".$d2['barang_gudang_detail_id']."')");
		mysqli_query($koneksi, "update barang_gudang_detail,barang_dikirim_detail set status_batal=1 where barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_gudang_detail.id=".$d2['barang_gudang_detail_id']."");
		$update=mysqli_query($koneksi, "update barang_gudang_detail set status_kirim=0,status_kerusakan=1,status_kembali_ke_gudang=1 where id=".$d2['barang_gudang_detail_id']."");
		//$up=mysqli_query($koneksi, "update aksesoris_detail set status_terjual_akse=1 where id=".$d2['aksesoris_detail_id']."");
		//$up2=mysqli_query($koneksi, "update aksesoris,aksesoris_detail set stok_total_akse=stok_total_akse-1 where aksesoris.id=aksesoris_detail.aksesoris_id and aksesoris_detail.id=".$d2['aksesoris_detail_id']."");
		}
		if ($ins_brg_kembali and $simpan2) {
			mysqli_query($koneksi, "delete from barang_kembali_hash where akun_id=".$_SESSION['id']."");
			if ($_SESSION['user_admin_teknisi']) {
				echo "<script type='text/javascript'>
	alert('Data Berhasil Di Simpan !');
	window.location='index.php?page=barang_kembali_teknisi'</script>";
				}
			else {
	echo "<script type='text/javascript'>
	alert('Data Berhasil Di Simpan !');
	window.location='index.php?page=barang_kembali'</script>";
			}
		}
	}
	else {
		echo "<script>alert('Data Belum Diisi , Klik Tambah Terlebih Dahulu !');
		window.location='index.php?page=simpan_tambah_retur';
		</script>";
		}
}


if (isset($_POST['simpan_tambah_aksesoris'])) {
	//$no=mysqli_num_rows(mysqli_query($koneksi, "select * from barang_kembali_hash"))+1;
	$simpan = mysqli_query($koneksi, "insert into barang_kembali_hash(akun_id,barang_gudang_detail_id) values('".$_SESSION['id']."','".$_POST['id_akse']."')");
	if ($simpan) {
		echo "<script>window.location='index.php?page=simpan_tambah_retur'</script>";
		}
	
}
	
if (isset($_GET['id_hapus'])) {
	$del = mysqli_query($koneksi, "delete from barang_kembali_hash where id=".$_GET['id_hapus']."");
	}
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Retur Pengembalian</h1><ol class="breadcrumb">
       <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"> Retur Pengembalian</li>
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
              <!--<a href="index.php?page=tambah_barang_masuk"><button name="tambah_laporan" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Tambah Barang</button></a>-->
              <div class="table-responsive">
              <table width="100%" id="" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th valign="bottom">Nomo Retur</th>
      <th valign="bottom"><strong>Tgl Retur</strong></th>
      <th valign="bottom"><strong>No PO/ID</strong></th>
      </tr>
  </thead>
  <tr>
    <td><?php echo $_SESSION['no_retur']; ?></td>
    <td><?php echo date("d-m-Y",strtotime($_SESSION['tgl_retur'])); ?>
    </td>
    <td><?php 
	echo $s['no_po_jual']; ?></td>
    </tr>
</table>
              </div>
                <br />
                <h3 align="center">
                  Tambah Data Alkes
                </h3>
                <button name="tambah_laporan" class="btn btn-success pull pull-left" type="button" data-toggle="modal" data-target="#modal-pilihnoseri"><span class="fa fa-plus"></span> Tambah </button>
                <br /><br />
                <div class="table-responsive">
                <table width="100%" id="example1" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th valign="bottom">No</th>
      <th valign="bottom"><strong>Nama Alkes</strong></th>
      <td align="center" valign="bottom"><strong>No Seri</strong><td align="center" valign="bottom"><strong>Dinas/RS/Klinik/Dll      
      </strong>
      <td align="center" valign="bottom"><strong>Aksi</strong></tr>
  </thead>
  
  
  <?php
   
  $no=0;
  $q_akse = mysqli_query($koneksi, "select *,barang_kembali_hash.id as idd from barang_kembali_hash where akun_id=".$_SESSION['id']."");
  $jm = mysqli_num_rows($q_akse);
  if ($jm!=0) { 
  while ($data_akse = mysqli_fetch_array($q_akse)) {
	  $no++;
  ?>
  <tr>
    <td><?php echo $no; ?></td>
    <td><?php 
	$sel = mysqli_fetch_array(mysqli_query($koneksi, "select * from barang_gudang,barang_gudang_detail,barang_dikirim,barang_dikirim_detail,barang_dijual,pembeli,barang_kembali_hash where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dijual.id=barang_dikirim.barang_dijual_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and pembeli.id=barang_dijual.pembeli_id and barang_gudang_detail.id=barang_kembali_hash.barang_gudang_detail_id and barang_kembali_hash.id=".$data_akse['idd'].""));
	echo $sel['nama_brg']; ?>
    </td>
    <td align="center"><?php echo $sel['no_seri_brg']." / ".$sel['nama_set']; ?></td>
    <td align="center"><?php echo $sel['nama_pembeli']; ?></td>
    <td align="center"><a href="index.php?page=simpan_tambah_retur&id_hapus=<?php echo $data_akse['idd']; ?>" onclick="return confirm('Yakin Akan Menghapus Item Ini ?')"><span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span></a></td>
    </tr>
  <?php }} else {
	  echo "<tr><td colspan='7' align='center'>Tidak Ada Data</td></tr>";
	  } ?>
</table>
                </div>
<br />
<center><a href="index.php?page=simpan_tambah_retur&simpan_barang=1"><button name="simpan_barang" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Simpan</button></a>&nbsp;&nbsp;<a href="index.php?page=barang_kembali"><button name="batal" class="btn btn-success" type="submit"><span class="fa  fa-times-circle"></span> Batal</button></a></center>
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
	$Result = mysqli_query($koneksi, "insert into aksesoris(nama_akse,merk_akse,tipe_akse,nie_akse,stok_total_akse,negara_asal_akse,deskripsi_akse,harga_beli_akse,harga_akse) values('".$_POST['nama_akse']."','".$_POST['merk']."','".$_POST['tipe']."','".$_POST['no_seri']."','".$_POST['stok']."', '".$_POST['deskripsi']."','".$_POST['harga_satuan']."')");
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

<div class="modal fade" id="modal-pilihnoseri">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
              
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" align="center">Tambah Alkes/No Seri</h4>
              </div>
              <form method="post" enctype="multipart/form-data">
              <div class="modal-body">
              <label>Nama Alkes</label>
              <select name="id_akse" id="id_akse" class="form-control select2" autofocus="autofocus" required onchange="changeValue(this.value)" style="width:100%">
    	<option value="">...</option>
        <?php 
		$q = mysqli_query($koneksi, "select *,barang_gudang_detail.id as idd from barang_gudang,barang_gudang_detail,barang_dijual,barang_dikirim,barang_dikirim_detail,pembeli where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dijual.id=barang_dikirim.barang_dijual_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and pembeli.id=barang_dijual.pembeli_id and barang_gudang_detail.status_kirim=1 and barang_dikirim.id=".$_SESSION['no_po_id']." order by nama_brg ASC");
		$jsArray = "var dtBrg = new Array();
";
		while ($d = mysqli_fetch_array($q)) { ?>
        <option value="<?php echo $d['idd']; ?>"><?php 
		if ($d['no_seri_brg']!="") {
		echo $d['nama_brg']." - ".$d['no_seri_brg']; }
		else {
			echo $d['nama_brg']." - ".$d['nama_set'];
			} ?></option>
        <?php 
		$jsArray .= "dtBrg['" . $d['idd'] . "'] = {
						no_seri_brg:'".addslashes($d['no_seri_brg']." / ".$d['nama_set'])."',
						nama_pembeli:'".addslashes($d['nama_pembeli'])."'
						};";
		} ?>
    </select>
    <br /><br />
    <label>No Seri</label>
    <input id="no_seri" name="no_seri" class="form-control" type="text" placeholder="" disabled="disabled"/>
    <br />
    <label>RS/Dinas/Klinik/Dll</label>
    <input id="nama_pembeli" name="nama_pembeli" class="form-control" type="text"  placeholder="" disabled="disabled"/>
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
		document.getElementById('no_seri').value = dtBrg[id_akse].no_seri_brg; 
		document.getElementById('nama_pembeli').value = dtBrg[id_akse].nama_pembeli;
		//document.getElementById('no_akse').value = dtBrg[id_akse].no_akse;
		
	};  
</script>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
