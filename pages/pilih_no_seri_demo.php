<?php 
if (isset($_GET['simpan_barang'])==1) {
	$cek4 = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_demo_kirim_detail_hash where akun_id=".$_SESSION['id'].""));
	if ($cek4!=0) {
	$s1=mysqli_query($koneksi, "insert into barang_demo_kirim values('','".$_SESSION['nama_paket']."','".$_SESSION['no_pengiriman']."','".$_SESSION['tgl_pengiriman']."','".$_SESSION['no_po']."','".$_SESSION['ekspedisi']."','".$_SESSION['via_pengiriman']."','".$_SESSION['estimasi']."','".$_SESSION['biaya_kirim']."','','".$_SESSION['keterangan']."')");
	
	$max = mysqli_fetch_array(mysqli_query($koneksi, "select max(id) as id_max from barang_demo_kirim"));
	$q = mysqli_query($koneksi, "select * from barang_demo_kirim_detail_hash where akun_id=".$_SESSION['id']."");
	while ($d = mysqli_fetch_array($q)) {
		$s = mysqli_query($koneksi, "insert into barang_demo_kirim_detail values('','".$max['id_max']."','".$d['barang_demo_qty_id']."','".$d['barang_gudang_detail_id']."','')");
		$up_stok = mysqli_query($koneksi, "update barang_gudang,barang_gudang_detail set stok_total=stok_total-1 where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=".$d['barang_gudang_detail_id']."");
		$up_status = mysqli_query($koneksi, "update barang_gudang_detail set status_demo=1 where id=".$d['barang_gudang_detail_id']."");
		
		}
	if ($s1 and $s and $up_status and $up_stok) {
		//$Result = mysqli_query($koneksi, "insert into utang_piutang values('','Hutang','".$_SESSION['no_po']."','".$_POST['tgl_input']."','".$_POST['jatuh_tempo']."','".$_POST['nominal']."','".$_POST['klien']."','".$_POST['deskripsi']."','0')");
		mysqli_query($koneksi, "delete from barang_demo_kirim_detail_hash where akun_id=".$_SESSION['id']."");
		echo "<script>
		alert('Berhasil disimpan !');
		window.location='index.php?page=kirim_barang_demo'</script>";
		}}
		else {
			echo "<script>
		alert('Data Belum Diisi !');
		window.location='index.php?page=pilih_no_seri_demo&id=$_GET[id]'</script>";
			}
}


if (isset($_POST['simpan_tambah_aksesoris'])) {
	$cek=mysqli_fetch_array(mysqli_query($koneksi, "select qty from barang_demo_qty where id=".$_POST['merk_akse'].""));
	$cek2=mysqli_num_rows(mysqli_query($koneksi, "select * from barang_demo_kirim_detail where barang_demo_qty_id=".$_POST['merk_akse'].""));
	$cek3=mysqli_num_rows(mysqli_query($koneksi, "select * from barang_demo_kirim_detail_hash where barang_demo_qty_id=".$_POST['merk_akse']." and akun_id=".$_SESSION['id'].""));
	$nil1 = $cek['qty']-$cek2;
	if ($nil1>$cek3) {
	$simpan = mysqli_query($koneksi, "insert into barang_demo_kirim_detail_hash values('','".$_SESSION['id']."','".$_POST['merk_akse']."','".$_POST['no_seri']."')");
	if ($simpan) {
		echo "<script>window.location='index.php?page=pilih_no_seri_demo&id=$_GET[id]'</script>";
			}
	}
	else {
		echo "<script>
		alert('Gagal ! Sudah Mencukupi Kuantitas');
		window.location='index.php?page=pilih_no_seri_demo&id=$_GET[id]'</script>";
		}
		//}
	}
	
if (isset($_GET['id_hapus'])) {
	$del = mysqli_query($koneksi, "delete from barang_demo_kirim_detail_hash where id=".$_GET['id_hapus']."");
	}
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Pengiriman Barang Demo</h1><ol class="breadcrumb">
       <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"> Pengiriman Barang Demo</li>
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
              <table width="100%" id="" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th valign="bottom"><strong>Nama Paket</strong></th>
      <td align="center" valign="bottom"><strong>No. Surat Jalan</strong></td>
      <td align="center" valign="bottom"><strong>Ekspedisi</strong></td>
      <td align="center" valign="bottom"><strong>Tanggal Pengiriman</strong></td>
      <td align="center" valign="bottom"><strong>Via Pengiriman</strong></td>
      <td align="center" valign="bottom"><strong>Estimasi Brg Sampai</strong></td>
      <td align="center" valign="bottom"><strong>Biaya Jasa</strong></td>
      <td align="center" valign="bottom"><strong>Keterangan</strong></td>
     </tr>
    <tr>
      <th valign="bottom"><?php echo $_SESSION['nama_paket']; ?></th>
      <td align="center" valign="bottom"><?php echo $_SESSION['no_pengiriman']; ?></td>
      <td align="center" valign="bottom"><?php echo $_SESSION['ekspedisi']; ?></td>
      <td align="center" valign="bottom"><?php echo date("d-m-Y",strtotime($_SESSION['tgl_pengiriman'])); ?></td>
      <td align="center" valign="bottom"><?php echo $_SESSION['via_pengiriman']; ?></td>
      <td align="center" valign="bottom"><?php 
	  if ($_SESSION['estimasi']!=0000-00-00) {
	  echo date("d-m-Y",strtotime($_SESSION['estimasi'])); }?></td>
      <td align="center" valign="bottom"><?php echo number_format($_SESSION['biaya_kirim'],2,',','.'); ?></td>
      <td align="left" valign="bottom"><?php echo $_SESSION['keterangan']; ?></td>
      </tr>
  </thead>
</table>
              
              
              <center><font class="" size="+1">Pilih No Seri Yang Akan Dikirim</font></center>
              <div class="box box-body">
              <font class="pull-right" color="#FF0000"><?php 
				  $qty = mysqli_query($koneksi, "select *,barang_demo_qty.id as id_qty from barang_demo_qty,barang_gudang where barang_gudang.id=barang_demo_qty.barang_gudang_id and barang_demo_id=".$_GET['id']."");
				  while ($d_qty = mysqli_fetch_array($qty)) {
					  $sel = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_demo_kirim_detail where barang_demo_qty_id=".$d_qty['id_qty'].""));
					  echo "Kuantitas : ".$d_qty['nama_brg']." (".($d_qty['qty']-$sel).")<br>";
					  }
				  
				  ?></font>
                  <br />
                  <button name="tambah_laporan" class="btn btn-success pull pull-left" type="button" data-toggle="modal" data-target="#modal-pilihnoseri"><span class="fa fa-plus"></span> Pilih/Tambah No Seri </button>
               <br /><br />
               <div class="table-responsive no-padding">
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
      <td align="center" valign="bottom"><strong>No Seri</strong></td>
      <td align="center" valign="bottom"><strong>Aksi</strong></td>
     </tr>
  </thead>
  <?php
   
  $no=0;
  $q_akse = mysqli_query($koneksi, "select *,barang_demo_kirim_detail_hash.id as idd from barang_demo_kirim_detail_hash,barang_gudang,barang_gudang_detail where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_demo_kirim_detail_hash.barang_gudang_detail_id and akun_id=".$_SESSION['id']."");
  
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
    <td align="center"><a href="index.php?page=pilih_no_seri_demo&id=<?php echo $_GET['id']; ?>&id_hapus=<?php echo $data_akse['idd']; ?>" onclick="return confirm('Yakin Akan Menghapus Item Ini ?')"><span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span></a></td>
    </tr>
  <?php } ?>
</table>
<center><a href="index.php?page=pilih_no_seri_demo&id=<?php echo $_GET['id']; ?>&simpan_barang=1"><button name="simpan_barang" class="btn btn-success" type="submit"><span class="fa fa-check"></span> Simpan</button></a></center>
</div>
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
              
      <select name="id_akse" id="id_akse" class="form-control" autofocus="autofocus" required onchange="changeValue(this.value)">
        <option value="">-- Pilih Alkes --</option>
        
        <?php 
		$q = mysqli_query($koneksi, "select *,barang_gudang.id as idd, barang_demo_qty.id as id_qty from barang_gudang,barang_demo_qty where barang_gudang.id=barang_demo_qty.barang_gudang_id and barang_demo_id=".$_GET['id']." group by barang_demo_qty.id order by nama_brg ASC");
		$jsArray = "var dtBrg = new Array();
";
		while ($d = mysqli_fetch_array($q)) { ?>
        <option value="<?php echo $d['idd']; ?>"><?php echo $d['nama_brg']; ?></option>
        <?php 
		$jsArray .= "dtBrg['" . $d['idd'] . "'] = {tipe_akse:'".addslashes($d['tipe_brg'])."',
						merk_akse:'".addslashes($d['id_qty'])."',
						merk_akse2:'".addslashes($d['merk_brg'])."',
						id_qty:'".addslashes($d['id_qty'])."',
						harga:'".addslashes("Rp ".number_format($d['harga_satuan'],2,',','.'))."',
						no_akse:'".addslashes($d['nie_brg'])."'
						};";
		} ?>
        </select>
    <br />
    <input id="tipe_akse" name="tipe_akse" class="form-control" type="text" placeholder="Tipe" disabled="disabled"/>
    <br />
    <input id="merk_akse" name="merk_akse" class="form-control" type="hidden" placeholder="Merk"/>
    
    <input id="merk_akse2" name="merk_akse2" class="form-control" type="text" disabled="disabled" placeholder="Merk"/>
    <br />
    <input id="no_akse" name="no_akse" class="form-control" type="text" placeholder="NIE" disabled="disabled" />
    <br />
    <select name="no_seri" id="no_seri" class="form-control select2" style="width:100%" required>
    <option value="">..Pilih No. Seri..</option>
    <?php
	$q_seri = mysqli_query($koneksi, "select *,barang_gudang_detail.id as idd from barang_gudang_detail INNER JOIN barang_gudang ON barang_gudang.id=barang_gudang_detail.barang_gudang_id and status_kirim=0 and status_kerusakan=0 and status_demo=0 order by no_seri_brg ASC");
	while ($d_seri=mysqli_fetch_array($q_seri)) {
	?>
    <option id="no_seri" value="<?php echo $d_seri['idd']; ?>" class="<?php echo $d_seri['barang_gudang_id']; ?>"><?php echo $d_seri['no_seri_brg']; ?></option>
    <?php } ?>
    </select>
    <script src="jquery-1.10.2.min.js"></script>
        <script src="jquery.chained.min.js"></script>
        <script>
            $("#no_seri").chained("#id_akse");
        </script>
    <script type="text/javascript">    
	<?php 
	echo $jsArray; 
	?>  
	function changeValue(id_akse){  
		document.getElementById('tipe_akse').value = dtBrg[id_akse].tipe_akse; 
		document.getElementById('merk_akse').value = dtBrg[id_akse].merk_akse;
		document.getElementById('merk_akse2').value = dtBrg[id_akse].merk_akse2;
		document.getElementById('no_akse').value = dtBrg[id_akse].no_akse;
		document.getElementById('harga').value = dtBrg[id_akse].harga;
		document.getElementById('id_qty').value = dtBrg[id_akse].id_qty;
	};  
</script>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success" name="simpan_tambah_aksesoris">Simpan</button>
              </div>
              </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
