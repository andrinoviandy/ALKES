<?php 
if (isset($_GET['id_hapus'])) {
	$sel = mysqli_fetch_array(mysqli_query($koneksi, "select no_po_pesan from barang_pesan_akse where id=".$_GET['id_hapus'].""));
	$del0 = mysqli_query($koneksi, "delete from utang_piutang_aksesoris where no_faktur_no_po_akse='".$sel['no_po_pesan']."'");
	$del2 = mysqli_query($koneksi, "delete from barang_pesan_akse_detail where barang_pesan_akse_id=".$_GET['id_hapus']."");
	$del = mysqli_query($koneksi, "delete from barang_pesan_akse where id=".$_GET['id_hapus']."");
	if ($del0 and $del and $del2){
		echo "<script>
		alert('Berhasil Di Hapus');
		window.location='index.php?page=pembelian_akse2'</script>";
		}
	else {
		echo "<script>
		alert('Gagal Di Hapus');
		window.location='index.php?page=pembelian_akse2'</script>";
		}
	}
	
if (isset($_GET['id_pulih'])) {
	$up=mysqli_query($koneksi, "update barang_pesan_akse set status_po_batal=0,deskripsi_batal='' where id=".$_GET['id_pulih']."");
	if ($up) {
		echo "<script>window.location='index.php?page=pembelian_akse2'</script>";
		} 
	}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      PO Luar Negeri</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Pemesanan Alkes</li>
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
              
              <a href="index.php?page=pembelian_akse2#openPilihan">
              <button name="tambah_laporan" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Tambah</button></a>
              <br /><br />
              <!--
              <form method="post">
              <div class="input-group pull pull-left col-xs-1">
                
                <select class="form-control" name="limiterr" style="margin-right:40px">
                <option <?php if ($limiter['limiter']==10) {echo "selected";} ?> value="10">10</option>
                <option <?php if ($limiter['limiter']==50) {echo "selected";} ?> value="50">50</option>
                <option <?php if ($limiter['limiter']==100) {echo "selected";} ?> value="100">100</option>
                <option <?php if ($limiter['limiter']==500) {echo "selected";} ?> value="500">500</option>
                <option <?php if ($limiter['limiter']==1000) {echo "selected";} ?> value="1000">1000</option>
                <?php 
				$total=mysqli_num_rows(mysqli_query($koneksi, "select * from barang_gudang"));
				?>
                <option <?php if ($limiter['limiter']==$total) {echo "selected";} ?> <?php if ($_POST['cari']!='') {echo "selected";} ?> value="<?php echo $total; ?>">All</option>
                </select>
                
                <span class="input-group-btn">
                      <button type="submit" name="button_limit" class="btn btn-default btn-flat"><i class="fa fa-check"></i></button>
                    </span>
                
              </div>
              </form>
              
              <form method="post">
              <div class="input-group pull pull-left col-xs-2">
                
                <select class="form-control" name="urutt" style="margin-right:40px">
                <option <?php if ($limiter['urut']=='ASC') {echo "selected";} ?> value="ASC">Ascending</option>
                <option <?php if ($limiter['urut']=='DESC') {echo "selected";} ?> value="DESC">Descending</option>
                
                </select>
                
                <span class="input-group-btn">
                      <button type="submit" name="button_urut" class="btn btn-default btn-flat"><i class="fa fa-check"></i></button>
                    </span>
                
              </div>
              </form>
              
              <form method="post" class="">
              <div class="input-group input-group-md col-xs-4 pull pull-right">
                <input type="text" name="cari" placeholder="Keyword .. (Not ; Stok, Harga, Pengecekan)" class="form-control">
                    <span class="input-group-btn">
                      <button type="submit" name="button_cari" class="btn btn-info btn-flat"><i class="fa fa-search"></i> Cari </button>
                    </span>
              </div>
              </form>-->
             
             
                <table width="100%" id="example1" class="table table-bordered">
  <thead>
    <tr>
      <td align="center">#</td>
        <th valign="top"><strong>Tgl PO</strong></th>
        <th valign="top">No PO</th>
      <th valign="top"><strong>Nama Principle</strong></th>
      <th valign="top"><strong>Alamat</strong></th>
      <th valign="top"><table width="100%">
        <tr>
          <td>Nama Aksesoris</td>
          <td>Tipe Aksesoris</td>
          <td>Qty</td>
        </tr>
      </table></th>
      <th align="center" valign="top"><strong>PPN</strong></th>
        
        <th align="center" valign="top"><strong>Cara Pembayaran (COD/Tempo)</strong></th>
        <th align="center" valign="top"><strong>Alamat Pengiriman</strong></th>
        <th align="center" valign="top"><strong>Jalur Pengiriman</strong>        </th>
        <th align="center" valign="top">Estimasi Pengiriman</th>
        <th align="center" valign="top"><strong>Aksi</strong></th>
          </tr>
  </thead>
  <?php
 
// membuka file JSON
$file = file_get_contents("http://localhost/ALKES/json/po_luar_negeri_akse.php");
$json = json_decode($file, true);
$jml=count($json); 
for ($i=0; $i<$jml; $i++) {
//echo "Nama Barang ke-".$i." : " . $json[$i]['nama_brg'] . "<br />";
//echo 'Nama Anggota ke-3 : ' . $json['2']['nama_brg'];
if ($json[$i]['status_po_batal']==1) {
	$bg="#FF3333";
	}
	else {
		$bg="";
		}
?>
  <tr bgcolor="<?php echo $bg; ?>">
    <td align="center"><?php echo $i+1; ?></td>
    <td><?php echo date("d/m/Y",strtotime($json[$i]['tgl_po_pesan'])); ?>
    </td>
    <td><?php echo $json[$i]['no_po_pesan']; ?></td>
    
      <td><?php 
	  $sel = mysqli_fetch_array(mysqli_query($koneksi, "select * from principle where id=".$json[$i]['principle_id'].""));
	  echo $sel['nama_principle']; ?></td>
    <td><?php echo $sel['alamat_principle']."<br>Telp : ".$sel['telp_principle']."<br>Fax : ".$sel['fax_principle']."<br>Attn : ".$sel['attn_principle']; ?></td>
    <td><table width="100%" border="0">
      <?php 
	  $q=mysqli_query($koneksi, "select * from barang_pesan_akse_detail,aksesoris where aksesoris.id=barang_pesan_akse_detail.aksesoris_id and barang_pesan_akse_detail.barang_pesan_akse_id=".$json[$i]['idd']."");
	  $n=0;
	  while ($d1=mysqli_fetch_array($q)) {
	  $n++;
	  if ($n%2==0) {
		  $col="#CCCCCC";
		  }
		  else {
			  $col="#999999";
			  }
	  ?>
      <tr bgcolor="<?php echo $col; ?>">
        <td style="padding-left:5px"><?php echo $d1['nama_akse'] ?></td>
        <td style="padding-left:5px"><?php echo $d1['tipe_akse'] ?></td>
        <td style="padding-left:1px; padding-right:1px"><?php echo $d1['qty']; ?>
        <?php if ($d1['status_ke_stok']==1) { ?>
        <span class="fa fa-share"></span>
        <?php } ?>
        </td>
        </tr>
      <?php } ?>
    </table></td>
    <td align="center"><?php echo $json[$i]['ppn']."%"; ?></td>
    <td align="center"><?php echo $json[$i]['cara_pembayaran']; ?></td>
    <td><?php echo $json[$i]['alamat_pengiriman']; ?></td>
    <td align="center"><?php echo $json[$i]['jalur_pengiriman']; ?></td>
    <td align="center"><?php 
	if ($json[$i]['estimasi_pengiriman']!=0000-00-00) {
	echo date("d/m/Y",strtotime($json[$i]['estimasi_pengiriman'])); } ?></td>
    <td align="center">
    <?php if ($json[$i]['status_po_batal']==0) { ?>
	<?php if (isset($_SESSION['pass_administrator'])) { ?>
    <a href="index.php?page=pembelian_akse2&id_hapus=<?php echo $json[$i]['idd']; ?>" onclick="return confirm('Anda Yakin Akan Menghapus Item Ini ?')"><span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span></a>&nbsp;<?php } ?>
    <?php
    $cek_uang = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_pesan_akse,utang_piutang_aksesoris,utang_piutang_aksesoris_bayar where barang_pesan_akse.no_po_pesan=utang_piutang_aksesoris.no_faktur_no_po_akse and utang_piutang_aksesoris.id=utang_piutang_aksesoris_bayar.utang_piutang_aksesoris_id and no_po_pesan='".$json[$i]['no_po_pesan']."'"));
	if ($cek_uang==0 and isset($_SESSION['adminpoluar']) or isset($_SESSION['user_administrator'])) { ?>
    <a href="index.php?page=ubah_pembelian_akse2&id=<?php echo $json[$i]['idd']; ?>"><span data-toggle="tooltip" title="Ubah" class="fa fa-edit"></span></a>
    <?php } ?>
    <br />
    <a href="cetak_surat_po_pemesanan_akse_luar.php?id=<?php echo $json[$i]['idd']; ?>" target="_blank"><span data-toggle="tooltip" title="Cetak PO" class="fa fa-print"></span></a>
    <?php 
	$j_cek=mysqli_num_rows(mysqli_query($koneksi, "select * from barang_pesan_akse_detail,aksesoris where aksesoris.id=barang_pesan_akse_detail.aksesoris_id and barang_pesan_akse_detail.barang_pesan_akse_id=".$json[$i]['idd']." and status_ke_stok=1"));
	if ($cek_uang==0 and $j_cek==0) { ?>
    <br />
    <a href="index.php?page=pembelian_akse2&id=<?php echo $json[$i]['idd']; ?>#openBatal"><small data-toggle="tooltip" title="Batalkan PO" class="label bg-red">Batalkan</small></a>
    <?php } }  else { ?>
    <a href="index.php?page=pembelian_akse2&id_pulih=<?php echo $json[$i]['idd']; ?>" onclick="return confirm('Anda yakin akan memulihkan PO ini ?')"><small data-toggle="tooltip" title="Pulihkan PO" class="label bg-green">Pulihkan PO</small></a>
	<?php if ($json[$i]['deskripsi_batal']!='') {
		echo $json[$i]['deskripsi_batal'];
		} } ?>
    </td>
  </tr>
  <?php } ?>
</table><br />

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
        <a href="index.php?page=tambah_pembelian_akse2"><button id="buttonn">Data Principle Baru</button></a>
        <a href="index.php?page=tambah_pembelian_akse2_sudah_ada">
        <button id="buttonn">Dari Data Principle<br />Yang Sudah Terinput</button></a>
    </div>
</div>

<?php 
if (isset($_POST['batal'])) {
	$up=mysqli_query($koneksi, "update barang_pesan_akse set status_po_batal=1,deskripsi_batal='".$_POST['deskripsi']."' where id=".$_GET['id']."");
	if ($up) {
		echo "<script>window.location='index.php?page=pembelian_akse2'</script>";
		} 
	}
?>
<div id="openBatal" class="modalDialog">
     <div>
        <a href="#" title="Close" class="close">X</a>
        <h3 align="center">Deskripsi Batal</h3> 
     <form method="post">
     <textarea class="form-control" rows="4" name="deskripsi"></textarea>
        <button id="buttonn" name="batal" type="submit">Simpan</button>
    </form>
    </div>
</div>


