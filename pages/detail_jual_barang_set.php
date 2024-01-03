<?php 
if (isset($_GET['id_b_s'])) {
	$q=mysqli_query($koneksi, "update barang_dikirim set tgl_sampai='' where id=".$_GET['id_b_s']."");
	if ($q) {
		echo "<script>window.location='index.php?page=kirim_barang'</script>";
		}
	}
if (isset($_GET['id_hapus'])) {
	$q1 = mysqli_query($koneksi, "update barang_dikirim,barang_dikirm_detail,barang_gudang_detail set barang_gudang_detail.status_kirim=0 where barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dikirim.id=".$_GET['id_hapus']."");
	//$q2 = mysqli_query($koneksi, "select * from barang_dikirim,barang_dikirm_detail,barang_gudang_detail,barang_gudang where barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dikirim.id=".$_GET['id_hapus']."");
	}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Detail Pengiriman Alkes
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Detail Pengiriman Alkes</li>
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
          <div class="box box-warning"><!-- /.chat -->
            <div class="box-footer">
              <div class="box-body table-responsive no-padding">
              <div class="">
              <!--<a href="index.php?page=tambah_barang_kirim">
              <button name="tambah_laporan" class="btn btn-warning" type="submit"><span class="fa fa-plus"></span> Kirim Alkes</button></a><br /><br />--><span class="pull pull-right"><table>
  <tr>
    <td><strong style="color:#F00">Keterangan</strong> : &nbsp;&nbsp;&nbsp;</td>
    <td valign="top">1. </td>
    <td valign="top"><strong style="color:#F00">Tanggal Sampai</strong> wajib diisi , untuk pembuatan SPI </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td valign="top">2. </td>
    <td>Jika <strong>Box</strong> Di <strong>Nama Alkes</strong> Berwarna <strong style="color:#F00">Merah</strong> , Itu menandakan<br /> 
      barang telah dikembalikan karena mengalami kerusakan</td>
  </tr>
</table>
</span>
             <br /><br /><br /><br />
                <table width="100%" id="example1" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th align="center">&nbsp;</th>
        
        <th bgcolor="#99FFCC">Tanggal Kirim</th>
        <th>Nama Paket</th>
        
        <th>No Pengiriman</th>
        <th>No PO</th>
      <th><strong>Nama_Alkes/Nama_Set/Qty_Jual</strong></th>
      <th><strong>Tempat Tujuan</strong></th>
      <th bgcolor="#99FFCC"><strong>Tanggal Sampai</strong></th>
      
        </tr>
  </thead>
  <?php
// membuka file JSON
$file = file_get_contents("http://localhost/ALKES/json/kirim_barang_set.php?id=$_GET[id]");
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
	$data3=mysqli_fetch_array(mysqli_query($koneksi, "select nama_pembeli from pembeli,barang_dijual,barang_dikirim where pembeli.id=barang_dijual.pembeli_id and barang_dijual.id=barang_dikirim.barang_dijual_id and barang_dikirim.id=".$json[$i]['idd'].""));
	echo $data3['nama_pembeli']; ?></td>
    
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
  if (isset($_POST['sampai_barang'])) {
	  $tgl_k = mysqli_fetch_array(mysqli_query($koneksi, "select * from barang_dikirim where id=".$_GET['id'].""));
	  if ($_POST['tgl_sampai']>=$tgl_k['tgl_kirim']) {
	  $que = mysqli_query($koneksi, "update barang_dikirim set tgl_sampai='".$_POST['tgl_sampai']."' where id=".$_GET['id']."");
	  if ($que) {
		  //mysqli_query($koneksi, "insert into uji_f_i values('','".$_GET['id']."','0','0','')");
		  echo "<script type='text/javascript'>
		  window.location='index.php?page=kirim_barang'
		  </script>";
		  }
	  	} else {
			echo "<script type='text/javascript'>alert('Tanggal Sampai Tidak Boleh Kurang Dari Tanggal Pengiriman !');
		  </script>";
			}
	  }
  ?>
  <div id="openSampai" class="modalDialog">
     <div>
        <a href="#" title="Close" class="close">X</a>
        <h3 align="center">Status Alkes</h3>
        <?php $d=mysqli_fetch_array(mysqli_query($koneksi, "select * from barang_dikirim where id=".$_GET['id']."")); ?> 
     <form method="post">
     <label>Tanggal Sampai</label>
     <input id="input" type="date" placeholder="" name="tgl_sampai" required value="<?php echo $d['tgl_sampai']; ?>">
     <!--<label>Keterangan</label>
     <textarea rows="4" id="input" type="text" placeholder="Keterangan" name="keterangan"><?php echo $d['ket_brg']; ?></textarea>-->
        <button id="buttonn" name="sampai_barang" type="submit">Simpan</button>
    </form>
    </div>
</div>
<?php 
$q = mysqli_fetch_array(mysqli_query($koneksi, "select * from pembeli,alamat_provinsi,alamat_kabupaten,alamat_kecamatan where alamat_provinsi.id=pembeli.provinsi_id and alamat_kabupaten.id=pembeli.kabupaten_id and alamat_kecamatan.id=pembeli.kecamatan_id and pembeli.id=".$_GET['id'].""))
?>
<div id="openDetailPembeli" class="modalDialog">
     <div>
        <a href="#" title="Close" class="close">X</a>
        <h3 align="center">Detail RS/Dinas/Klinik/Dll</h3> 
     <form method="post">
     <label>Nama RS/Dinas/Puskesmas/Klinik/Dll</label>
     <input id="input" type="text" placeholder="" name="no_peng" readonly="readonly" disabled value="<?php echo $q['nama_pembeli']; ?>">
     <label>Alamat</label>
     <textarea rows="4" id="input" placeholder="" name="no_peng" readonly="readonly" disabled><?php echo "Kelurahan ".$q['kelurahan_id']."\nKecamatan ".$q['nama_kecamatan']." \nKabupaten ".$q['nama_kabupaten']."\nProvinsi ".$q['nama_provinsi']; ?></textarea>
     <label>Kontak</label>
     <input id="input" type="text" placeholder="" name="no_po" readonly="readonly" disabled value="<?php echo $q['kontak_rs']; ?>">
     <br /><br />
    </form>
    </div>
</div>