<?php
$nopo = mysqli_fetch_array(mysqli_query($koneksi, "select * from barang_dikirim where id=".$_SESSION['no_po']."")); 
if (isset($_GET['simpan_barang'])==1) {
	$cek4 = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_dikirim_detail_hash where akun_id=".$_SESSION['id'].""));
	if ($cek4!=0) {
	$s1=mysqli_query($koneksi, "insert into barang_dikirim values('','".$nopo['barang_dijual_id']."','".$_SESSION['nama_paket']."','".$_SESSION['no_pengiriman']."','".$_SESSION['tgl_pengiriman']."','".$nopo['no_po_jual']."','".$_SESSION['ekspedisi']."','".$_SESSION['via_pengiriman']."','".$_SESSION['estimasi']."','".$_SESSION['biaya_pengiriman']."','','','1')");
	if ($s1) {
	$max = mysqli_fetch_array(mysqli_query($koneksi, "select max(id) as id_max from barang_dikirim")); 
	$q = mysqli_query($koneksi, "select * from barang_dikirim_detail_hash where akun_id=".$_SESSION['id']."");
	while ($d = mysqli_fetch_array($q)) {
		$s = mysqli_query($koneksi, "insert into barang_dikirim_detail values('','".$max['id_max']."','".$d['barang_dijual_qty_id']."','".$d['barang_gudang_detail_id']."','0','0')");
		$up_stok = mysqli_query($koneksi, "update barang_gudang,barang_gudang_detail set stok_total=stok_total-1 where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=".$d['barang_gudang_detail_id']."");
		$up_status = mysqli_query($koneksi, "update barang_gudang_detail set status_kirim=1 where id=".$d['barang_gudang_detail_id']."");
		}
	if ($s1 and $s and $up_stok and $up_status) {
		//$Result = mysqli_query($koneksi, "insert into utang_piutang values('','Hutang','".$_SESSION['no_po']."','".$_POST['tgl_input']."','".$_POST['jatuh_tempo']."','".$_POST['nominal']."','".$_POST['klien']."','".$_POST['deskripsi']."','0')");
		mysqli_query($koneksi, "delete from barang_dikirim_detail_hash where akun_id=".$_SESSION['id']."");
		echo "<script>
		alert('Berhasil disimpan !');
		window.location='index.php?page=kirim_barang'</script>";
		}} else {
			echo "<script>
		alert('Gagal disimpan ! Hindari Penggunaan Tanda Petik (')');
		window.location='index.php?page=pilih_no_seri_pengganti'</script>";
			}}
		else {
			echo "<script>
		alert('Data Belum Diisi !');
		window.location='index.php?page=pilih_no_seri_pengganti'</script>";
			}
}


if (isset($_POST['simpan_tambah_aksesoris'])) {
	$cek_no_seri = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_dikirim_detail_hash where id=".$_POST['barang_dikirim_detail_hash_id'].""));
	if ($cek_no_seri==0) {
	$simpan = mysqli_query($koneksi, "insert into barang_dikirim_detail_hash values('','".$_SESSION['id']."','".$_POST['barang_dijual_qty_id']."','".$_POST['no_seri']."','')");
	if ($simpan) {
		echo "<script>window.location='index.php?page=pilih_no_seri_pengganti'</script>";
			}
	}
	else {
		$simpan = mysqli_query($koneksi, "update barang_dikirim_detail_hash set akun_id='".$_SESSION['id']."',barang_dijual_qty_id='".$_POST['barang_dijual_qty_id']."',barang_gudang_detail_id='".$_POST['no_seri']."' where id=".$_POST['barang_dikirim_detail_hash_id']."");
	if ($simpan) {
		echo "<script>window.location='index.php?page=pilih_no_seri_pengganti'</script>";
			}
		}
		//}
	}
	
if (isset($_GET['id_hapus'])) {
	$del = mysqli_query($koneksi, "delete from barang_dikirim_detail_hash where id=".$_GET['id_hapus']."");
	}
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Pengiriman Alkes Pengganti</h1><ol class="breadcrumb">
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
      <th valign="bottom"><strong>No. PO </strong></th>
      <th valign="bottom">No Surat Jalan Sebelumnya</th>
      <th valign="bottom"><strong>Nama Paket</strong></th>
      <td align="center" valign="bottom"><strong>No. Surat Jalan Baru</strong></td>
      <td align="center" valign="bottom"><strong>Ekspedisi</strong></td>
      <td align="center" valign="bottom"><strong>Tanggal Pengiriman</strong></td>
      <td align="center" valign="bottom"><strong>Via Pengiriman</strong></td>
      <td align="center" valign="bottom"><strong>Estimasi Brg Sampai</strong></td>
      <td align="center" valign="bottom"><strong>Biaya Jasa</strong></td>
     </tr>
    <tr>
      <th valign="bottom"><?php 
	  echo $nopo['no_po_jual']; ?></th>
      <td valign="bottom"><?php echo $nopo['no_pengiriman'] ?></td>
      <td valign="bottom"><?php echo $_SESSION['nama_paket']; ?></td>
      <td align="center" valign="bottom"><?php echo $_SESSION['no_pengiriman']; ?></td>
      <td align="center" valign="bottom"><?php echo $_SESSION['ekspedisi']; ?></td>
      <td align="center" valign="bottom"><?php echo date("d-m-Y",strtotime($_SESSION['tgl_pengiriman'])); ?></td>
      <td align="center" valign="bottom"><?php echo $_SESSION['via_pengiriman']; ?></td>
      <td align="center" valign="bottom"><?php 
	  if ($_SESSION['estimasi']!=0000-00-00) {
	  echo date("d-m-Y",strtotime($_SESSION['estimasi'])); }?></td>
      <td align="center" valign="bottom"><?php echo number_format($_SESSION['biaya_kirim'],2,',','.'); ?></td>
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
              <center>
                <font class="" size="+2">Data Barang Yang Batal</font>
                  </center>
                  
				  <div class="box box-body">
				  
                  <!--<font color="#FF0000">* Jika Ingin Menambah Data Aksesoris Yang Baru ! Klik Disini <a href="index.php?page=simpan_tambah_aksesoris&id=<?php //echo $_GET['id']; ?>#openAkse"><small data-toggle="tooltip" title="Tambah Aksesoris Baru" class="label bg-blue">+ New Accessories</small></a></font>-->
               
                <div class="table-responsive">
                <table width="100%" id="example2" class="table table-bordered table-hover">
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
      <td align="center" valign="bottom"><strong>No Seri Lama</strong></td>
      <td align="center" valign="bottom"><strong>No Seri Pengganti</strong></td>
      <td align="center" valign="bottom"><strong>Aksi</strong></td>
     </tr>
  </thead>
  <?php
   
  $no=0;
  $q_akse = mysqli_query($koneksi, "select *,barang_dikirim_detail.id as idd from barang_dikirim_detail,barang_gudang,barang_gudang_detail where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and status_batal=1 and barang_dikirim_id=".$_SESSION['no_po']."");
  
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
    <td align="center"><?php echo $data_akse['no_seri_brg']; ?></td>
    <td align="center"><?php 
	$data = mysqli_fetch_array(mysqli_query($koneksi, "select *,barang_dikirim_detail_hash.id as idd from barang_dikirim_detail_hash,barang_gudang_detail where barang_gudang_detail.id=barang_dikirim_detail_hash.barang_gudang_detail_id and barang_dijual_qty_id=".$data_akse['barang_dijual_qty_id'].""));
	echo $data['no_seri_brg'];
	?></td>
    <td align="center"><button class="btn btn-warning" data-toggle="modal" data-target="#modal-pilihnoseri<?php echo $data_akse['idd'] ?>">Ganti</button>&nbsp;<a href="?page=<?php echo $_GET['page']; ?>&id_hapus=<?php echo $data['idd'] ?>"><button class="btn btn-danger">Hapus</button></a></td>
    </tr>
    <div class="modal fade" id="modal-pilihnoseri<?php echo $data_akse['idd'] ?>">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
              
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" align="center">Ganti No Seri</h4>
              </div>
              <form method="post" enctype="multipart/form-data">
              <div class="modal-body">
              <input type="hidden" name="barang_dijual_qty_id" value="<?php echo $data_akse['barang_dijual_qty_id']; ?>"/>
              <input type="hidden" name="barang_dikirim_detail_hash_id" value="<?php echo $data['idd']; ?>"/>
              
    <select name="no_seri" class="form-control select2" style="width:100%" required>
    <option value="">--Pilih No Seri--</option>
    <?php
	$q_seri = mysqli_query($koneksi, "select *,barang_gudang_detail.id as idd from barang_gudang_detail INNER JOIN barang_gudang ON barang_gudang.id=barang_gudang_detail.barang_gudang_id and status_kirim=0 and status_kerusakan=0 and status_demo=0 and barang_gudang_id=".$data_akse['barang_gudang_id']." order by no_seri_brg ASC");
	while ($d_seri=mysqli_fetch_array($q_seri)) {
	?>
    <option value="<?php echo $d_seri['idd']; ?>"><?php echo $d_seri['no_seri_brg']; ?></option>
    <?php } ?>
    </select>
    
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-warning" name="simpan_tambah_aksesoris">Ganti</button>
              </div>
              </form>
              
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
  <?php } ?>
</table>
                </div>
                </div>
<center><a href="index.php?page=pilih_no_seri_pengganti&simpan_barang=1"><button name="simpan_barang" class="btn btn-warning" type="button"><span class="fa fa-check"></span> Simpan & Kirim Barang</button></a>&nbsp;&nbsp;<a href="index.php?page=kirim_barang_pengganti"><button name="simpan_barang" class="btn btn-success" type="button"><span class="fa fa-close"></span> Kembali</button></a></center>
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
