<?php 
if (isset($_GET['hapus_all'])==1) {
	mysqli_query($koneksi, "delete from barang_demo_kembali_hash where akun_id=".$_SESSION['id']."");
	}
	
if (isset($_GET['simpan_barang'])==1) {
	$cek4 = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_demo_kembali_hash,barang_demo_kirim_detail where barang_demo_kirim_detail.id=barang_demo_kembali_hash.barang_demo_kirim_detail_id and akun_id=".$_SESSION['id'].""));
	if ($cek4!=0) {
	$q = mysqli_query($koneksi, "select * from barang_demo_kembali_hash,barang_demo_kirim_detail where barang_demo_kirim_detail.id=barang_demo_kembali_hash.barang_demo_kirim_detail_id and akun_id=".$_SESSION['id']."");
	while ($d = mysqli_fetch_array($q)) {
		if ($d['kondisi']=='Bagus') {
		$s = mysqli_query($koneksi, "insert into barang_demo_kembali values('','".$d['tgl_kembali']."','".$d['barang_demo_kirim_detail_id']."','".$d['kondisi']."','".$d['keterangan']."')");
		$up_stok = mysqli_query($koneksi, "update barang_gudang,barang_gudang_detail set stok_total=stok_total+1 where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=".$d['barang_gudang_detail_id']."");		$up_status = mysqli_query($koneksi, "update barang_gudang_detail set status_demo=0 where id=".$d['barang_gudang_detail_id']."");
		mysqli_query($koneksi, "update barang_demo_kirim_detail set status_kembali=1 where id=".$d['barang_demo_kirim_detail_id']."");
		} else {
			$s = mysqli_query($koneksi, "insert into barang_demo_kembali values('','".$d['tgl_kembali']."','".$d['barang_demo_kirim_detail_id']."','".$d['kondisi']."','".$d['keterangan']."')");
			mysqli_query($koneksi, "insert into barang_gudang_detail_rusak values('','".$d['tgl_kembali']."','".$d['barang_gudang_detail_id']."','".$d['keterangan']."','','0')");
			$up_status = mysqli_query($koneksi, "update barang_gudang_detail set status_demo=0, status_kerusakan=1 where id=".$d['barang_gudang_detail_id']."");
			mysqli_query($koneksi, "update barang_demo_kirim_detail set status_kembali=1 where id=".$d['barang_demo_kirim_detail_id']."");
			}
		}
	if ($s and $up_status) {
		//$Result = mysqli_query($koneksi, "insert into utang_piutang values('','Hutang','".$_SESSION['no_po']."','".$_POST['tgl_input']."','".$_POST['jatuh_tempo']."','".$_POST['nominal']."','".$_POST['klien']."','".$_POST['deskripsi']."','0')");
		mysqli_query($koneksi, "delete from barang_demo_kembali_hash where akun_id=".$_SESSION['id']."");
		echo "<script>
		alert('Berhasil disimpan !');
		window.location='index.php?page=kembali_barang_demo'</script>";
		}}
		else {
			echo "<script>
		alert('Data Belum Diisi !');
		window.location='index.php?page=pilih_barang_demo_kembali&id=$_GET[id]'</script>";
			}
}


if (isset($_POST['simpan_tambah_aksesoris'])) {
	
	$simpan = mysqli_query($koneksi, "insert into barang_demo_kembali_hash values('','".$_SESSION['id']."','".$_POST['tgl_kembali']."','".$_POST['no_seri']."','".$_POST['kondisi']."','".$_POST['keterangan']."')");
	if ($simpan) {
		echo "<script>window.location='index.php?page=pilih_barang_demo_kembali&id=$_GET[id]'</script>";
			}
	}
	
if (isset($_GET['id_hapus'])) {
	$del = mysqli_query($koneksi, "delete from barang_demo_kembali_hash where id=".$_GET['id_hapus']."");
	}
	
$data=mysqli_fetch_array(mysqli_query($koneksi, "select * from pembeli,barang_demo,barang_demo_kirim,barang_demo_kirim_detail,barang_demo_qty where pembeli.id=barang_demo.pembeli_id and barang_demo.id=barang_demo_qty.barang_demo_id and barang_demo_qty.id=barang_demo_kirim_detail.barang_demo_qty_id and barang_demo_kirim.id=barang_demo_kirim_detail.barang_demo_kirim_id and barang_demo_kirim.id=".$_GET['id'].""));
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Pengembalian Barang Demo</h1><ol class="breadcrumb">
       <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"> Pengembalian Barang Demo</li>
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
              <div class="table-responsive no-padding">
              <table width="100%" id="" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th valign="bottom"><strong>Tujuan</strong></th>
      <th valign="bottom"><strong>Nama Paket</strong></th>
      <td align="center" valign="bottom"><strong>No. Surat Jalan</strong></td>
      <td align="center" valign="bottom"><strong>Ekspedisi</strong></td>
      <td align="center" valign="bottom"><strong>Tanggal Pengiriman</strong></td>
      <td align="center" valign="bottom"><strong>Via Pengiriman</strong></td>
      <td align="center" valign="bottom"><strong>Estimasi Brg Sampai</strong></td>
      <td align="center" valign="bottom"><strong>Biaya Jasa</strong></td>
     </tr>
    <tr>
      <td valign="bottom"><?php echo $data['nama_pembeli']; ?></td>
      <td valign="bottom"><?php echo $data['nama_paket']; ?></td>
      <td align="center" valign="bottom"><?php echo $data['no_pengiriman']; ?></td>
      <td align="center" valign="bottom"><?php echo $data['ekspedisi']; ?></td>
      <td align="center" valign="bottom"><?php echo date("d-m-Y",strtotime($data['tgl_kirim'])); ?></td>
      <td align="center" valign="bottom"><?php echo $data['via_pengiriman']; ?></td>
      <td align="center" valign="bottom"><?php 
	  if ($data['estimasi_barang_sampai']!=0000-00-00) {
	  echo date("d-m-Y",strtotime($data['estimasi_barang_sampai'])); }?></td>
      <td align="center" valign="bottom"><?php echo $data['biaya_pengiriman']; ?></td>
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
              <br />
              <font class="" size="+2">
                  Pilih No Seri Barang</font><br /><font class="pull pull-left" color="#FF0000">
                  Jika No Seri Nya Tidak Muncul Berarti Barang Tersebut Sudah Di Kembalikan
                  </font>
                  <button class="btn btn-success pull pull-right" data-toggle="modal" data-target="#modal-tambahbarang"><span class="fa fa-plus"></span> Tambah</button>
                  <br /><br />
                  <div class="table-responsive no-padding">
                  <table width="100%" id="example3" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th valign="bottom">No</th>
      <th valign="bottom"><strong>Nama Alkes</strong></th>
      <td align="center" valign="bottom"><strong>Tipe      
      </strong></td>
      <td align="center" valign="bottom"><strong>No Seri</strong></td>
      <td align="center" valign="bottom"><strong>Tgl Kembali</strong></td>
      <td align="center" valign="bottom"><strong>Kondisi Barang</strong></td>
      <td align="center" valign="bottom"><strong>Keterangan</strong></td>
      <td align="center" valign="bottom"><strong>Aksi</strong></td>
     </tr>
  </thead>
  
  
  <?php
   
  $no=0;
  $q_akse = mysqli_query($koneksi, "select *,barang_demo_kembali_hash.id as idd from barang_demo_kirim_detail,barang_demo_kembali_hash,barang_gudang_detail,barang_gudang where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_demo_kirim_detail.barang_gudang_detail_id and barang_demo_kirim_detail.id=barang_demo_kembali_hash.barang_demo_kirim_detail_id and akun_id=".$_SESSION['id']."");
  
  while ($data_akse = mysqli_fetch_array($q_akse)) {
	  $no++;
  ?>
  <tr>
    <td><?php echo $no; ?></td>
    <td><?php echo $data_akse['nama_brg']; ?>
    </td>
    <td align="center"><?php echo $data_akse['tipe_brg']; ?></td>
    <td align="center"><?php echo $data_akse['no_seri_brg']; ?></td>
    <td align="center"><?php echo date("d/m/Y",strtotime($data_akse['tgl_kembali'])); ?></td>
    <td align="center"><?php echo $data_akse['kondisi']; ?></td>
    <td align="center"><?php echo $data_akse['keterangan']; ?></td>
    <td align="center"><a href="index.php?page=pilih_barang_demo_kembali&id=<?php echo $_GET['id']; ?>&id_hapus=<?php echo $data_akse['idd']; ?>" onclick="return confirm('Yakin Akan Menghapus Item Ini ?')"><span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span></a></td>
    </tr>
  <?php } ?>
</table>
                  </div>
<center><a href="index.php?page=pilih_barang_demo_kembali&id=<?php echo $_GET['id']; ?>&simpan_barang=1"><button name="simpan_barang" class="btn btn-success" type="submit"><span class="fa fa-check"></span> Simpan</button></a></center>
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
  <div class="modal fade" id="modal-tambahbarang">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" align="center">Pilih No Seri</h4>
              </div>
              <form method="post">
              <div class="modal-body">
              <p align="justify">
              <label>Pilih Alkes</label>
      <select name="id_akse" id="id_akse" class="form-control" autofocus="autofocus" required onchange="changeValue(this.value)">
        <option value="">...</option>
        
        <?php 
		$q = mysqli_query($koneksi, "select *,barang_gudang.id as idd from pembeli,barang_demo,barang_demo_kirim,barang_demo_kirim_detail,barang_demo_qty,barang_gudang where pembeli.id=barang_demo.pembeli_id and barang_demo.id=barang_demo_qty.barang_demo_id and barang_demo_qty.id=barang_demo_kirim_detail.barang_demo_qty_id and barang_demo_kirim.id=barang_demo_kirim_detail.barang_demo_kirim_id and barang_gudang.id=barang_demo_qty.barang_gudang_id and barang_demo_kirim.id=".$_GET['id']." group by barang_gudang.id order by tipe_brg ASC");
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
        <label>Tipe</label>
    <input id="tipe_akse" name="tipe_akse" class="form-control" type="text" placeholder="Tipe" disabled="disabled"/>
    
      <input id="merk_akse" name="merk_akse" class="form-control" type="hidden" placeholder="Merk"/>
      <label>No Seri</label>
      <select name="no_seri" id="no_seri" class="form-control select2" required style="width:100%">
        <option value="">...</option>
        <?php
	$q_seri = mysqli_query($koneksi, "select *,barang_demo_kirim_detail.id as idd from pembeli,barang_demo,barang_demo_kirim,barang_demo_kirim_detail,barang_demo_qty,barang_gudang_detail where pembeli.id=barang_demo.pembeli_id and barang_demo.id=barang_demo_qty.barang_demo_id and barang_demo_qty.id=barang_demo_kirim_detail.barang_demo_qty_id and barang_demo_kirim.id=barang_demo_kirim_detail.barang_demo_kirim_id and barang_gudang_detail.id=barang_demo_kirim_detail.barang_gudang_detail_id and barang_demo_kirim.id=".$_GET['id']." and status_kembali=0 order by no_seri_brg ASC");
	while ($d_seri=mysqli_fetch_array($q_seri)) {
	?>
        <option id="no_seri" value="<?php echo $d_seri['idd']; ?>" class="<?php echo $d_seri['barang_gudang_id']; ?>"><?php echo $d_seri['no_seri_brg']." / ".$d_seri['nama_set']; ?></option>
        <?php } ?>
        </select>
      <script src="jquery-1.10.2.min.js"></script>
      <script src="jquery.chained.min.js"></script>
      <script>
            $("#no_seri").chained("#id_akse");
        </script>
    <label>Tanggal Kembali</label>
    <input id="tgl_kembali" name="tgl_kembali" class="form-control" type="date" placeholder=""/>
    <label>Kondisi Barang</label>
    <select name="kondisi" id="kondisi" class="form-control" required="required">
      <option value="Bagus">Bagus</option>
      <option value="Rusak">Rusak</option>
    </select>
    <label>Keterangan</label>
    <input id="keterangan" name="keterangan" class="form-control" type="text" placeholder=""/>
    
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
              </p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button name="simpan_tambah_aksesoris" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Tambah</button>
              </div>
              </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>