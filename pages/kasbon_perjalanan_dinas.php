<?php
if (isset($_POST['pencarian'])) {
		if ($_POST['pilihan']=='tgl_spk') {
		echo "<script>window.location='index.php?page=$_GET[page]&tgl1=$_POST[tgl1]&tgl2=$_POST[tgl2]'</script>";
		} else {
		echo "<script>window.location='index.php?page=$_GET[page]&kunci=$_POST[kata_kunci]'</script>";
		}
	}

if (isset($_GET['id_hapus'])) {
	//$del0 = mysqli_query($koneksi, "delete from barang_teknisi_detail_teknisi where id=".$_GET['id_brg_teknisi']."");
	//$update = mysqli_query($koneksi, "update barang_teknisi_detail set status_teknisi=0 where id=".$_GET['id_brg_teknisi']."");
	$del1 = mysqli_query($koneksi, "delete from kasbon_perjalanan_dinas_detail where kasbon_perjalanan_dinas_id=".$_GET['id_hapus']."");
	$del = mysqli_query($koneksi, "delete from kasbon_perjalanan_dinas where id=".$_GET['id_hapus']."");
	if ($del and $del1) {
		echo "<script>
		alert('Data berhasil di hapus !');
		window.location='index.php?page=kasbon_perjalanan_dinas'</script>";
		}
	else {
		echo "<script>
		alert('Data gagal di hapus !');
		window.location='index.php?page=kasbon_perjalanan_dinas'</script>";
		}
	}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Kasbon Perjalanan Dinas
     </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Kasbon Perjalanan Dinas</li>
      </ol>
    </section>


    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) --><!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12">
        <div class="box box-body">
        <a href="?page=tambah_kasbon_perjalanan_dinas"><button class="btn btn-success pull pull-left"><span class="fa fa-plus"></span> Tambah </button></a>
              
              <div class="pull pull-right">
              <button class="btn btn-success" data-toggle="modal" data-target="#modal-pencarian"><span class="fa fa-search"></span> Pencarian</button>&nbsp;&nbsp;
              <?php if (isset($_GET['kunci']) or isset($_GET['tgl1'])) { ?>
              <a href="?page=<?php echo $_GET['page'] ?>"><button class="btn btn-info"><span class="fa fa-refresh"></span> Reset</button></a>&nbsp;&nbsp;
              <?php } ?>
              <a data-toggle="tooltip" data-title="Jumlah Data Yang Ditampilkan Per Halaman"><button data-toggle="modal" data-target="#modal-atur" name="limit" class="btn btn-default" type="button"><span class="fa fa-cog"></span></button></a>
              </div>
        </div>
        </section>
        <?php include "header_pencarian.php"; ?>
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
      <th valign="top" bgcolor="#CCCCCC">No</th>
        
        <th valign="top" bgcolor="#CCCCCC">Tanggal_Kasbon</th>
        <th valign="top" bgcolor="#CCCCCC">No Kasbon</th>
        <th valign="top" bgcolor="#CCCCCC">Nilai Kasbon</th>
        <td align="center" valign="top" bgcolor="#CCCCCC"><strong>Detail</strong></td>
        <th align="center" valign="top" bgcolor="#CCCCCC"><strong>Aksi</strong></th>
          </tr>
  </thead>
  <?php
 
// membuka file JSON
	if (isset($_GET['kunci'])) {
	$file = file_get_contents("http://localhost/ALKES/json/$_GET[page].php?paging=$_GET[paging]&kunci=".str_replace(" ","%20",$_GET['kunci'])."");
}
elseif (isset($_GET['tgl1']) and isset($_GET['tgl2'])) {
	$file = file_get_contents("http://localhost/ALKES/json/$_GET[page].php?paging=$_GET[paging]&tgl1=".$_GET['tgl1']."&tgl2=".$_GET['tgl2']."");
}
else {
	$file = file_get_contents("http://localhost/ALKES/json/$_GET[page].php?paging=$_GET[paging]");
	}

$json = json_decode($file, true);
$jml=count($json); 
for ($i=0; $i<$jml; $i++) {

?>
  <tr>
  
    <td align="center"><?php echo $i+1; ?></td>
    <td><?php echo date("d/M/Y", strtotime($json[$i]['tgl_kasbon'])); ?>
    </td>
    <td><?php 
	echo $json[$i]['no_kasbon']; ?></td>
    <td><?php 
	echo number_format($json[$i]['nilai_kasbon'],0,',','.'); ?></td>
    <td align="">
    <table class="table table-bordered">
    <tr>
    <td><strong>No SPI</strong></td>
    <td><strong>Tanggal SPI</strong></td>
    <td><strong>No PO</strong></td>
    <td><strong>Sales</strong></td>
    <td><strong>Lokasi Instalasi</strong></td>
    <td><strong>Teknisi</strong></td>
    <td><strong>Estimasi Berangkat</strong></td>
    <td><strong>Tanggal Berangkat</strong></td>
    <td><strong>Deskripsi</strong></td>
    </tr>
    <?php
    $q3 = mysqli_query($koneksi, "select *,kasbon_perjalanan_dinas_detail.id as idd from kasbon_perjalanan_dinas_detail,barang_teknisi,barang_teknisi_detail,barang_dikirim_detail,barang_dikirim,barang_dijual,tb_teknisi,pembeli where barang_teknisi.id=kasbon_perjalanan_dinas_detail.barang_teknisi_id and barang_teknisi.id=barang_teknisi_detail.barang_teknisi_id and barang_dikirim_detail.id=barang_teknisi_detail.barang_dikirim_detail_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and barang_dijual.id=barang_dikirim.barang_dijual_id and tb_teknisi.id=kasbon_perjalanan_dinas_detail.teknisi_id and pembeli.id=barang_dijual.pembeli_id and kasbon_perjalanan_dinas_id=".$json[$i]['idd']." group by kasbon_perjalanan_dinas_detail.id order by kasbon_perjalanan_dinas_detail.id ASC");
	while ($d3 = mysqli_fetch_array($q3)) {
	?>
    <tr>
    <td><?php echo $d3['no_spk']; ?></td>
    <td><?php echo date("d/m/Y",strtotime($d3['tgl_spk'])); ?></td>
    <td><?php echo $d3['no_po_jual']; ?></td>
    <td><?php echo $d3['marketing']; ?></td>
    <td><?php echo $d3['nama_pembeli']; ?></td>
    <td><?php echo $d3['nama_teknisi']; ?></td>
    <td><?php echo date("d/m/Y",strtotime($d3['estimasi'])); ?></td>
    <td><?php echo date("d/m/Y",strtotime($d3['tgl_berangkat_teknisi'])); ?></td>
    <td><?php echo $d3['deskripsi']; ?></td>
    </tr>
    <?php } ?>
    </table>
    </td>
    <td align="center">
    <a href="index.php?page=kasbon_perjalanan_dinas&id_hapus=<?php echo $json[$i]['idd']; ?>&id_brg_teknisi=<?php echo $json[$i]['barang_teknisi_id']; ?>" onclick="return confirm('Anda Yakin Akan Menghapus Item Ini ?')"><button><span data-toggle="tooltip" title="Hapus" class="fa fa-trash"> Hapus</span></button></a>
    <br /><br />
    <a href="index.php?page=ubah_kasbon_perjalanan_dinas&id=<?php echo $json[$i]['idd']; ?>"><button><span data-toggle="tooltip" title="Ubah" class="fa fa-edit"> Ubah</span></button></a>
    <br /><br />
    <a href="cetak_kasbon_perjalanan_dinas.php?id=<?php echo $json[$i]['idd']; ?>" target="_blank"><button><span data-toggle="tooltip" title="Cetak" class="fa fa-print"> Cetak</span></button></a>
    </td>
  </tr>
  <div class="modal fade" id="modal-detailbarang<?php echo $json[$i]['idd']; ?>">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" align="center">Detail Barang</h4>
              </div>
              <form method="post">
              <div class="modal-body">
              <p align="justify">
              
      <?php 
	  $q2=mysqli_query($koneksi, "select nama_brg,no_seri_brg,status_batal,status_uji,status_teknisi,tipe_brg,barang_teknisi_detail.id as id_detail_teknisi from barang_teknisi,barang_teknisi_detail,barang_dikirim_detail,barang_gudang, barang_gudang_detail where barang_teknisi.id=barang_teknisi_detail.barang_teknisi_id and barang_dikirim_detail.id=barang_teknisi_detail.barang_dikirim_detail_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_teknisi.id=".$json[$i]['idd']."");
	  $n=0;
	  while ($d1=mysqli_fetch_array($q2)) {
	  $n++;
	  ?>
      <?php if ($d1['status_teknisi']==1) { ?>
        <font class="pull pull-right" size="+1">(<span class='fa fa-user'></span>)</font>
        <?php } ?>
        <font class="pull pull-right" size="+1">
        <?php
		if($d1['status_uji']==1) {
			echo "(<span class='fa fa-wrench'></span>)";
			}
			?>
            </font>
      <?php echo $n.". ".$d1['nama_brg']."     |    "; ?>
      <?php echo $d1['tipe_brg']."     |    "; ?>
      <?php echo $d1['no_seri_brg']; ?>
      <hr />
      <?php } ?>
    
              </p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                
              </div>
              </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        
        <div class="modal fade" id="modal-ubah<?php echo $json[$i]['idd']; ?>">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" align="center">Ubah Deskripsi</h4>
              </div>
              <form method="post">
              <div class="modal-body">
              <p align="justify">
              <input type="hidden" value="<?php echo $json[$i]['idd']; ?>" name="id_spk"/>
     <label>Deskripsi</label>
     <textarea rows="4" class="form-control" name="keterangan_spk"><?php echo $json[$i]['keterangan_spk']; ?></textarea>
              </p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button class="btn btn-success" name="ubah_deskripsi" type="submit">Simpan Perubahan</button>
              </div>
              </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
  <?php } ?>
  <?php if ($jml==0) { ?>
  <tr><td colspan="6" align="center">Belum Ada Data</td></tr>
  <?php } ?>
</table>
                </div>
</div>
              </div>
            </div>
          </div>
          <!-- /.box (chat box) -->

          <!-- TO DO List --><!-- /.box -->

        <!-- quick email widget --></section>
        <?php if ($jml!=0) { ?>
  <section class="col-lg-12">      
<center>
	<ul class="pagination btn-success">
    <?php
	include "paging_awal.php";
	?>
    <?php
	$query12 = mysqli_query($koneksi, "SELECT jumlah_limit FROM limiter");
    list($surat_masuk) = mysqli_fetch_array($query12);
	//pagging
    $limit = $surat_masuk;
	if (isset($_GET['tgl1']) and isset($_GET['tgl2'])) {
$queryy = mysqli_query($koneksi, "select *,kasbon_perjalanan_dinas.id as idd from kasbon_perjalanan_dinas,kasbon_perjalanan_dinas_detail,barang_teknisi,barang_teknisi_detail,barang_dikirim_detail,barang_dikirim,barang_dijual,tb_teknisi,pembeli where barang_teknisi.id=kasbon_perjalanan_dinas_detail.barang_teknisi_id and barang_teknisi.id=barang_teknisi_detail.barang_teknisi_id and barang_dikirim_detail.id=barang_teknisi_detail.barang_dikirim_detail_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and barang_dijual.id=barang_dikirim.barang_dijual_id and tb_teknisi.id=kasbon_perjalanan_dinas_detail.teknisi_id and pembeli.id=barang_dijual.pembeli_id and tgl_kasbon between '$_GET[tgl1]' and '$_GET[tgl2]' group by kasbon_perjalanan_dinas.id order by tgl_kasbon DESC,no_ksabon DESC");
	}
	elseif (isset($_GET['kunci']) and isset($_GET['pilihan'])) {
$queryy = mysqli_query($koneksi, "select *,kasbon_perjalanan_dinas.id as idd from kasbon_perjalanan_dinas,kasbon_perjalanan_dinas_detail,barang_teknisi,barang_teknisi_detail,barang_dikirim_detail,barang_dikirim,barang_dijual,tb_teknisi,pembeli where barang_teknisi.id=kasbon_perjalanan_dinas_detail.barang_teknisi_id and barang_teknisi.id=barang_teknisi_detail.barang_teknisi_id and barang_dikirim_detail.id=barang_teknisi_detail.barang_dikirim_detail_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and barang_dijual.id=barang_dikirim.barang_dijual_id and tb_teknisi.id=kasbon_perjalanan_dinas_detail.teknisi_id and pembeli.id=barang_dijual.pembeli_id and $_GET[pilihan] like '%$_GET[kunci]%' group by kasbon_perjalanan_dinas.id order by tgl_kasbon DESC,no_kasbon DESC");
	}
	else {
	$queryy = mysqli_query($koneksi, "select *,kasbon_perjalanan_dinas.id as idd from kasbon_perjalanan_dinas order by tgl_kasbon DESC,no_kasbon DESC");
	}
	$cdata = mysqli_num_rows($queryy);
    $j = ceil($cdata/$limit);
	if ($j > 10) {
		include "paging_lebih_dari_10.php";
	} 
	//< 10 Halaman
	else {
		include "paging_kurang_dari_10.php";
	}
	?>
    <?php
	include "paging_akhir.php";
	?>
    </ul>
</center>
<?php
include "paging_informasi.php";
?>

  </section>
  <?php } ?>
    <!-- /.content -->
  <?php include "atur_halaman.php"; ?>
  <?php include "modal-cari.php"; ?>
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
