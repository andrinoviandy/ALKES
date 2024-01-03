<?php 
if (isset($_GET['id_hapus'])) {
	$del = mysqli_query($koneksi, "delete from riwayat_panggilan_set where id=".$_GET['id_hapus']."");
	if ($del) {
		echo "<script>	window.location='index.php?page=riwayat_panggilan_set&id=$_GET[id]';
		</script>";
		}
	}
if (isset($_POST['simpan_tambah_aksesoris'])) {
	$jam=date("h")+6;
	$waktu=date("$jam:i:s");
	$simpan = mysqli_query($koneksi, "insert into riwayat_panggilan_set values('','".$_GET['id']."','".$_POST['tgl']."','$waktu','".$_POST['kegiatan']."')");
	if ($simpan) {
		echo "<script>window.location='index.php?page=riwayat_panggilan_set&id=$_GET[id]'</script>";
		}
	}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Riwayat Panggilan</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Riwayat Panggilan</li>
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
              
              <!--
              <form method="post" class="">
              <div class="input-group input-group-md col-xs-4 pull pull-right">
                <input type="text" name="cari" placeholder="Keyword....." class="form-control">
                    <span class="input-group-btn">
                      <button type="submit" name="button_cari" class="btn btn-info btn-flat"><i class="fa fa-search"></i> Cari </button>
                    </span>
              </div>
              </form>
              -->
              
              <table width="100%" id="" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th width="4%" align="center">&nbsp;</th>
        
        <th width="12%" bgcolor="#99FFCC">Tanggal Kirim</th>
        <th width="11%">Nama Paket</th>
        
        <th width="16%">No Pengiriman</th>
        <th width="8%">No PO</th>
      <th width="9%"><strong>Nama_Alkes/Nama_Set/Qty_Jual</strong></th>
      <th width="11%"><strong>Tempat Tujuan</strong></th>
      <th width="10%">Kontak</th>
      <th width="12%" bgcolor="#99FFCC"><strong>Tanggal Sampai</strong></th>
      
        </tr>
  </thead>
  <?php
// membuka file JSON
$file = file_get_contents("http://localhost/ALKES/json/kirim_barang_set.php?id_riwayat=$_GET[id]");
$json = json_decode($file, true);
$jml=count($json); 
for ($i=0; $i<$jml; $i++) {
//echo "Nama Barang ke-".$i." : " . $json[$i]['nama_brg'] . "<br />";
//echo 'Nama Anggota ke-3 : ' . $json['2']['nama_brg'];
?>
  <tr>
    <td align="center"><?php echo $i+1; ?></td>
    <td bgcolor="#99FFCC"><?php echo date("d M Y",strtotime($json[$i]['tgl_kirim'])); ?></td>
    <td><?php echo $json[$i]['nama_paket']; ?></td>
    
    <td><?php echo $json[$i]['no_pengiriman']; ?></td>
    <td><?php echo $json[$i]['po_no']; ?></td>
    <td>
    <table width="100%" border="0">
      <?php 
	  $q=mysqli_query($koneksi, "select nama_brg,nama_set,qty_jual from barang_gudang_set,barang_gudang_set_1,barang_gudang_set_2,barang_dikirim_detail_set,barang_dijual_set, barang_dijual_qty_set,barang_gudang_po_set where barang_gudang_set.id=barang_gudang_po_set.barang_gudang_set_id and barang_gudang_po_set.id=barang_gudang_set_1.barang_gudang_po_set_id and barang_gudang_set_1.id=barang_gudang_set_2.barang_gudang_set1_id and barang_gudang_set_2.id=barang_dijual_qty_set.barang_gudang_set2_id and barang_dijual_set.id=barang_dijual_qty_set.barang_dijual_set_id and barang_dijual_qty_set.id=barang_dikirim_detail_set.barang_dijual_qty_set_id and barang_dikirim_set_id=".$json[$i]['idd']."");
	  $n=0;
	  while ($d1=mysqli_fetch_array($q)) {
	  $n++;
	  if ($n%2==0) {
		  if ($d1['status_kembali_ke_gudang']==1){$col="#FF0000";}
		  else {$col="#CCCCCC";}
		  }
		  else {
			  if ($d1['status_kembali_ke_gudang']==1){$col="#FF0000";}
		  else {$col="#999999";}
			  }
	  ?>
      <tr bgcolor="<?php echo $col; ?>">
        <td align="left"><?php echo $d1['nama_brg']." / "; ?></td>
        <td align="left"><?php echo $d1['nama_set']." / "; ?></td>
        <td align="left"><?php echo $d1['qty_jual']; ?></td>
        </tr>
      <?php } ?>
    </table>
    </td>
    <td><?php 
	$data3=mysqli_fetch_array(mysqli_query($koneksi, "select nama_pembeli,kontak_rs from pembeli,barang_dijual_set,barang_dikirim_set where pembeli.id=barang_dijual_set.pembeli_id and barang_dijual_set.id=barang_dikirim_set.barang_dijual_set_id and barang_dikirim_set.id=".$json[$i]['idd'].""));
	echo $data3['nama_pembeli']; ?></td>
    <td><?php echo $data3['kontak_rs']; ?></td>
    
    <?php 
	if ($json[$i]['tgl_sampai']!=0000-00-00) {
		$bg="#99FFCC";
		}
		else {
			$bg="red";
			}
	?>
    <td bgcolor=<?php echo $bg; ?>>
		<?php
		if ($json[$i]['tgl_sampai']!=0000-00-00) {
	echo date("d M Y", strtotime($json[$i]['tgl_sampai'])); } else {
		echo "-";
		} ?>
    </td>
  </tr>
  <?php } ?>
</table>

<br />
<h3 align="center">Riwayat Panggilan</h3>
<br />
<table width="100%" id="example1" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th width="5%" valign="bottom">No</th>
      <th width="24%" valign="bottom">Tanggal</th>
      <th width="24%" valign="bottom">Jam</th>
      <th width="47%" valign="bottom"><strong>Kegiatan</strong></th>
      <td width="24%" align="center" valign="bottom"><strong>Aksi</strong></td>
     </tr>
  </thead>
  <tr>
    <td>#</td>
    <form method="post" name="form1" enctype="multipart/form-data">
    <td><input type="date" name="tgl" class="form-control" value=""/></td>
    <td>
      <input type="text" name="waktu" disabled="disabled" class="form-control" value="Auto"/></td>
    <td><textarea name="kegiatan" class="form-control" cols="70%" rows="2"></textarea></td>
    <td align="center"><button name="simpan_tambah_aksesoris" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Tambah</button></td>
    </form>
  </tr>
  
  <script type="text/javascript">    
	<?php 
	echo $jsArray; 
	?>  
	function changeValue(id_akse){  
		document.getElementById('tipe_akse').value = dtBrg[id_akse].tipe_akse; 
		document.getElementById('merk_akse').value = dtBrg[id_akse].merk_akse;
		document.getElementById('no_akse').value = dtBrg[id_akse].no_akse;
		document.getElementById('harga').value = dtBrg[id_akse].harga;
		document.getElementById('id_qty').value = dtBrg[id_akse].id_qty;
	};  
</script>
  <?php
   
  $no=0;
  $q_akse = mysqli_query($koneksi, "select * from riwayat_panggilan_set where barang_dikirim_set_id=".$_GET['id']." order by tgl_riwayat DESC");
  
  while ($data_akse = mysqli_fetch_array($q_akse)) {
	  $no++;
  ?>
  <tr>
    <td><?php echo $no; ?></td>
    <td><?php echo $data_akse['tgl_riwayat']; ?></td>
    <td><?php echo $data_akse['waktu']; ?></td>
    <td><?php echo $data_akse['kegiatan']; ?>
    </td>
    <td align="center"><a href="index.php?page=riwayat_panggilan_set&id_hapus=<?php echo $data_akse['id']; ?>&id=<?php echo $_GET['id']; ?>" onclick="return confirm('Yakin Akan Menghapus Item Ini ?')"><span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span></a></td>
    </tr>
  <?php } ?>
</table>
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
  if (isset($_POST['kirim_barang'])) {
	  $input = mysqli_query($koneksi, "update barang_gudang_detail_rusak set status_progress=".$_POST['status']." where id=".$_GET['id_ubah']."");
	  	
		if ($input) {
		  		echo "<script>
			window.location='index.php?page=tambah_progress_rusak_dalam&id_gudang_detail	=$_GET[id_gudang_detail]&id_ubah=$_GET[id_ubah]&id_gudang=$_GET[id_gudang]'
				</script>";
		  		}
			
		
	  }
  ?>
  <div id="open_status" class="modalDialog">
     <div>
        <a href="#" title="Close" class="close">X</a>
        <h3 align="center">Pilih Status</h3>
       <form method="post">
       <label>Pilih status</label>
     <select id="input" name="status">
     <?php if ($da['status_progress']==0) { ?>
     	<option value="0">Belum Selesai</option>
        <option value="1">Sudah Selesai</option>
        <?php } else if ($da['status_progress']==1){ ?>
        <option value="1">Sudah Selesai</option>
        <option value="0">Belum Selesai</option>
        <?php } ?>
     </select><!--
     <br /><br />
     <label>Total Biaya (*Jika Sudah Selesai)</label>
     <input type="text" id="input" name="total_biaya"/>-->
     <button id="buttonn" name="kirim_barang" type="submit">Simpan</button>
    </form>
    </div>
</div>
