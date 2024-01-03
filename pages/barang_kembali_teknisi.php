<?php
if (isset($_GET['id_hapus'])) {
	//$sel = mysqli_fetch_array(mysqli_query($koneksi, "select barang_dikirim_id from barang_kembali where id=".$_GET['id_hapus'].""));
	$del = mysqli_query($koneksi, "delete from barang_kembali_detail where barang_kembali_id=".$_GET['id_hapus']."");
	$del2 = mysqli_query($koneksi, "delete from barang_kembali where id=".$_GET['id_hapus']."");
	if ($del and $del2) {
		//mysqli_query($koneksi, "update barang_dikirim set status_barang_kembali=0 where id=".$sel['barang_dikirim_id']."");
		echo "<script type='text/javascript'>
		window.location='index.php?page=barang_kembali_teknisi'
		</script>";
		}
	}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Alkes Rusak Yang Dikembalikan</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Data Alkes Rusak</li>
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
              
              <a href="index.php?page=tambah_retur">
              <button name="tambah_laporan" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Tambah Retur</button></a><span class="pull pull-right"><table>
  <tr>
    <td><strong style="color:#F00">Keterangan</strong> : &nbsp;&nbsp;&nbsp;</td>
    <td valign="top">1. </td>
    <td valign="top">Tanda &quot;<span class="fa fa-user"></span>&quot; menandakan sudah diberikan <strong>Teknisi</strong></td>
  </tr>
</table>
</span><br /><br />
              <div class="table-responsive">
              <table width="100%" id="example1" class="table table-bordered table-hover">
                <thead>
    <tr>
      
      <th valign="top">#</th>
        
        <th align="center" valign="top"><table width="100%">
          <tr>
            <td>Nama Alkes</td>
            <td>Tipe Brg</td>
            <td>No Seri</td>
          </tr>
        </table></th>
     
      <th align="center" valign="top"><strong>Nomor Retur</strong>        </th>
        <th align="center" valign="top">Tgl Retur</th>
        <th align="center" valign="top">Nomor PO/ID</th>
        <th align="center" valign="top">Dinas/RS/Dll</th>
        <th align="center" valign="top"><strong>Aksi</strong></th>
          </tr>
  </thead>
  <?php
 
// membuka file JSON
$file = file_get_contents("http://localhost/ALKES/json/barang_kembali.php");
$json = json_decode($file, true);
$jml=count($json); 
for ($i=0; $i<$jml; $i++) {
//echo "Nama Barang ke-".$i." : " . $json[$i]['nama_brg'] . "<br />";
//echo 'Nama Anggota ke-3 : ' . $json['2']['nama_brg'];
?>
  <tr>
    
    <td><?php echo $i+1; ?></td>
    <td valign="top">
      <table width="100%" border="0">
	  <?php 
	  $q2=mysqli_query($koneksi, "select nama_brg,no_seri_brg,tipe_brg,barang_kembali_detail.id as idd from barang_kembali_detail,barang_gudang,barang_gudang_detail where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_kembali_detail.barang_gudang_detail_id and barang_kembali_id=".$json[$i]['idd']."");
	  $n=0;
	  while ($d1=mysqli_fetch_array($q2)) {
	  $n++;
	  if ($n%2==0) {
		  $col="#CCCCCC";
		  }
		  else {
			  $col="#999999";
			  }
	  ?>
      <tr bgcolor="<?php echo $col; ?>">
        <td align="left"><?php echo $d1['nama_brg'] ?></td>
        <td align="left"><?php echo $d1['tipe_brg'] ?></td>
        <td align="right"><?php echo $d1['no_seri_brg'];
		$dd = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_kembali_teknisi where barang_kembali_detail_id=".$d1['idd'].""));
		if ($dd) {
			echo " <span class='fa fa-user'></span>";
			}
		?></td>
        </tr>
      <?php } ?>
    </table>
    </td>
    <td><?php echo $json[$i]['no_retur']; ?></td>
    <td><?php echo date("d/m/Y",strtotime($json[$i]['tgl_retur'])); ?></td>
    
    <td><?php echo $json[$i]['no_po_id']; ?></td>
    <td><?php 
	$pemb = mysqli_fetch_array(mysqli_query($koneksi, "select nama_pembeli from barang_kembali,barang_dikirim,barang_dikirim_detail,barang_dijual,pembeli where pembeli.id=barang_dijual.pembeli_id and barang_dijual.id=barang_dikirim.barang_dijual_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and barang_dikirim.id=barang_kembali.barang_dikirim_id and barang_kembali.id=".$json[$i]['idd']."")); 
	echo $pemb['nama_pembeli'];
	?></td>
    <td align="">
    <form method="post">
    <?php if (isset($_SESSION['user_administrator']) && isset($_SESSION['pass_administrator'])) { ?>
    
    <a href="index.php?page=barang_kembali_teknisi&id_hapus=<?php echo $json[$i]['idd']; ?>" onclick="return confirm('Anda Yakin Akan Menghapus Item Ini ?')"><span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span></a> &nbsp; <?php } ?><!--<a href="index.php?page=ubah_barang_kembali&id=<?php echo $json[$i]['idd']; ?>"><span data-toggle="tooltip" title="Ubah" class="fa fa-edit"></span></a>&nbsp; --><a href="cetak_surat_kembali.php?id=<?php echo $json[$i]['idd']; ?>" target="_blank"><span data-toggle="tooltip" title="Cetak Retur Pengembalian" class="fa fa-print"></span></a> &nbsp; <a href="index.php?page=barang_kembali_pilih_teknisi&id=<?php echo $json[$i]['idd']; ?>"><small data-toggle="tooltip" title="Pilih Teknisi" class="label bg-green">Pilih Teknisi</small></a>
      <!-- Tombol Jual -->
	 
      
      <input type="hidden" name="id" value="<?php echo $json[$i]['idd']; ?>"/>
      </a>
      </form>
      
    </td>
  </tr>
  <?php } ?>
</table>
              </div>
              <br />

              </div>
            </div>
          </div>
          <!-- /.box (chat box) -->

          <!-- TO DO List --><!-- /.box -->

        <!-- quick email widget --></section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

  </section>
    <!-- /.content -->
  </div>
 

<div id="openPilihan" class="modalDialog">
     <div>
        <a href="#" title="Close" class="close">X</a>
        <br />
        <a href="index.php?page=jual_barang2&id=<?php echo $_GET['id']; ?>"><button id="buttonn">Data Dinas/RS/Puskesmas/Klinik Baru</button></a>
        <a href="index.php?page=jual_barang3&id=<?php echo $_GET['id']; ?>"><button id="buttonn">Dari Data Dinas/RS/Puskesmas/Klinik<br />Yang Sudah Terinput</button></a>
    </div>
</div>


