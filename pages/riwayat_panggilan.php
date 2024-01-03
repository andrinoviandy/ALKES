<?php 
if (isset($_GET['id_hapus'])) {
	$del = mysqli_query($koneksi, "delete from riwayat_panggilan where id=".$_GET['id_hapus']."");
	if ($del) {
		echo "<script>	window.location='index.php?page=riwayat_panggilan&id=$_GET[id]';
		</script>";
		}
	}
	
if (isset($_POST['simpan_tambah_aksesoris'])) {
	$jam=date("h")+5;
	$waktu=date("$jam:i:s");
	$simpan = mysqli_query($koneksi, "insert into riwayat_panggilan values('','".$_GET['id']."','".$_POST['tgl']."','$waktu','".$_POST['kegiatan']."')");
	if ($simpan) {
		echo "<script>window.location='index.php?page=riwayat_panggilan&id=$_GET[id]'</script>";
		}
	}

if (isset($_POST['simpan_perubahan'])) {
	$simpan = mysqli_query($koneksi, "update riwayat_panggilan set kegiatan='".$_POST['kegiatan1']."' where id=".$_POST['id_ubah']."");
	if ($simpan) {
		echo "<script>window.location='index.php?page=riwayat_panggilan&id=$_GET[id]'</script>";
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
            <div class="box-body">
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
              <div class="table-responsive">
              <table width="100%" id="" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th bgcolor="#99FFCC">Tanggal_Kirim</th>
                    <th width="20%">Nama_Paket</th>
                    <th>No_Surat_Jalan</th>
                    <th>No PO Pembelian</th>
                    <th>No PO Penjualan</th>
                    <th>Barang</th>
                    <th>Marketing</th>
                    <th>SubDis</th>
                    <th><strong>Lokasi_Tujuan</strong></th>
                    <th>Kontak</th>
                    <th>Pemakai</th>
                    <th>Kontak Pemakai</th>
                    <th>Teknisi</th>
                    <th>Ekspedisi</th>
                    <th>Via_Pengiriman</th>
                    <th>Estimasi_Barang_Sampai</th>
                    <th bgcolor="#99FFCC"><strong>Tanggal_Sampai</strong></th>
                  </tr>
                </thead>
                <?php
// membuka file JSON
$file = file_get_contents("http://localhost/ALKES/json/kirim_barang.php?id_riwayat=$_GET[id]");
$json = json_decode($file, true);
$jml=count($json); 
for ($i=0; $i<$jml; $i++) {
//echo "Nama Barang ke-".$i." : " . $json[$i]['nama_brg'] . "<br />";
//echo 'Nama Anggota ke-3 : ' . $json['2']['nama_brg'];
?>
                <tr>
                  <td bgcolor="#99FFCC"><?php echo date("d M Y",strtotime($json[$i]['tgl_kirim'])); ?></td>
                  <td><?php echo $json[$i]['nama_paket']; ?></td>
                  <td><?php echo $json[$i]['no_pengiriman']; ?></td>
                  <td><a href="#" data-toggle="modal" data-target="#modal-detailpo<?php echo $_GET['id']; ?>"><small data-toggle="tooltip" title="Detail Barang" class="label bg-primary"><span class="fa fa-folder-open"></span></small></a></td>
                  <td><?php echo $json[$i]['no_po_jual']; ?></td>
                  <td><a href="#" data-toggle="modal" data-target="#modal-detailbarang<?php echo $_GET['id']; ?>"><small data-toggle="tooltip" title="Detail Barang" class="label bg-primary"><span class="fa fa-folder-open"></span></small></a></td>
                  <td><?php
    $data3=mysqli_fetch_array(mysqli_query($koneksi, "select * from pemakai,pembeli,barang_dijual,barang_dikirim where pembeli.id=barang_dijual.pembeli_id and pemakai.id=barang_dijual.pemakai_id and barang_dijual.id=barang_dikirim.barang_dijual_id and barang_dikirim.id=".$json[$i]['idd'].""));
	echo $data3['marketing'];
	?></td>
                  <td><?php echo $data3['subdis']; ?></td>
                  <td><?php 
	echo $data3['nama_pembeli']; ?></td>
                  <td><?php echo $data3['kontak_rs']; ?></td>
                  <td><?php echo $data3['nama_pemakai']; ?></td>
                  <td><?php echo $data3['kontak1_pemakai']." / ".$data3['kontak2_pemakai']; ?></td>
                  <td><a href="#" data-toggle="modal" data-target="#modal-teknisi<?php echo $_GET['id']; ?>"><small data-toggle="tooltip" title="Detail Barang" class="label bg-primary"><span class="fa fa-folder-open"></span></small></a></td>
                  <td><?php echo $json[$i]['ekspedisi']; ?></td>
                  <td><?php echo $json[$i]['via_pengiriman']; ?></td>
                  <td><?php if ($json[$i]['estimasi_barang_sampai']!=0000-00-00) {
	echo date("d/m/Y",strtotime($json[$i]['estimasi_barang_sampai'])); } ?></td>
                  <?php 
	if ($json[$i]['tgl_sampai']!=0000-00-00) {
		$bg="#99FFCC";
		}
		else {
			$bg="red";
			}
	?>
                  <td bgcolor="<?php echo $bg; ?>"><?php
		if ($json[$i]['tgl_sampai']!=0000-00-00) {
	echo date("d M Y", strtotime($json[$i]['tgl_sampai'])); } else {
		echo "-";
		} ?></td>
                  
                </tr>
                <div class="modal fade" id="modal-detailbarang<?php echo $_GET['id']; ?>">
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
	  $q=mysqli_query($koneksi, "select nama_brg,no_seri_brg,status_spi,status_kerusakan,status_batal,tipe_brg from barang_gudang,barang_gudang_detail,barang_dikirim_detail where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dikirim_id=".$_GET['id']."");
	  $n=0;
	  while ($d1=mysqli_fetch_array($q)) {
	  $n++;
	  ?>
      <?php if ($d1['status_batal']==1) { ?>
        <font class="pull pull-right" size="+1">Batal</font>
        <?php } ?>
        <font class="pull pull-right" size="+2">
        <?php
		if($d1['status_spi']==1) {
			echo "(<span class='fa fa-sticky-note-o'></span>)";
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
        
        <div class="modal fade" id="modal-teknisi<?php echo $_GET['id']; ?>">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" align="center">Teknisi</h4>
              </div>
              <form method="post">
              <div class="modal-body">
              <p align="justify">
              
      <?php 
	  $q3=mysqli_query($koneksi, "select nama_brg,nama_teknisi,no_hp from tb_teknisi,barang_teknisi_detail_teknisi,barang_teknisi_detail,barang_dikirim_detail,barang_gudang,barang_gudang_detail where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dikirim_detail.id=barang_teknisi_detail.barang_dikirim_detail_id and barang_teknisi_detail.id=barang_teknisi_detail_teknisi.barang_teknisi_detail_id and tb_teknisi.id=barang_teknisi_detail_teknisi.teknisi_id and barang_dikirim_detail.barang_dikirim_id=".$_GET['id']."");
	  $cek = mysqli_num_rows($q3);
	  if ($cek!=0) {
	  $n=0;
	  while ($d1=mysqli_fetch_array($q3)) {
	  $n++;
	  ?>
      <?php if ($d1['status_batal']==1) { ?>
        <font class="pull pull-right" size="+1">Batal</font>
        <?php } ?>
        <font class="pull pull-right" size="+2">
        <?php
		if($d1['status_spi']==1) {
			echo "(<span class='fa fa-sticky-note-o'></span>)";
			}
			?>
            </font>
      <?php echo $n.". ".$d1['nama_brg']."     |    "; ?>
      <?php echo $d1['nama_teknisi']."     |    "; ?>
      <?php echo $d1['no_hp']; ?>
      <hr />
      <?php } } else { echo "Bagian Teknisi Belum Menentukan Teknisi"; } ?>
    
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
        
        <div class="modal fade" id="modal-detailpo<?php echo $_GET['id']; ?>">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" align="center">No. PO Pembelian</h4>
              </div>
              <form method="post">
              <div class="modal-body">
              <p align="justify">
              
      <?php 
	  $q2=mysqli_query($koneksi, "select no_po_gudang,nama_brg from barang_gudang,barang_gudang_po,barang_gudang_detail,barang_dikirim_detail where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_po.id=barang_gudang_detail.barang_gudang_po_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dikirim_id=".$_GET['id']."");
	  $n=0;
	  while ($d1=mysqli_fetch_array($q2)) {
	  $n++;
	  ?>
      
      <?php echo $n.". ".$d1['nama_brg']."     |    "; ?>
      <?php echo $d1['no_po_gudang']; ?>
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
                <?php } ?>
              </table>
              </div>
              <br />
<h3 align="center">Riwayat Panggilan</h3>

<button name="tambah_laporan" class="btn btn-success pull pull-left" type="button" data-toggle="modal" data-target="#modal-pilihnoseri"><span class="fa fa-plus"></span> Tambah </button>
               <br /><br />
<div class="table-responsive">
<table width="100%" id="example3" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th width="6%" valign="bottom">No</th>
      <th width="" valign="bottom">Tanggal</th>
      <th width="" valign="bottom">Jam</th>
      <th width="" valign="bottom"><strong>Kegiatan</strong></th>
      <td width="" align="center" valign="bottom"><strong>Aksi</strong></td>
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
		document.getElementById('id_qty').value = dtBrg[id_akse].id_qty;
	};  
</script>
  <?php
   
  $no=0;
  $q_akse = mysqli_query($koneksi, "select * from riwayat_panggilan where barang_dikirim_id=".$_GET['id']." order by tgl_riwayat DESC");
  
  while ($data_akse = mysqli_fetch_array($q_akse)) {
	  $no++;
  ?>
  <tr>
    <td><?php echo $no; ?></td>
    <td><?php echo date("d/M/Y",strtotime($data_akse['tgl_riwayat'])); ?></td>
    <td><?php echo $data_akse['waktu']; ?></td>
    <td><?php echo $data_akse['kegiatan']; ?>
    </td>
    <td align="center"><a href="index.php?page=riwayat_panggilan&id_hapus=<?php echo $data_akse['id']; ?>&id=<?php echo $_GET['id']; ?>" onclick="return confirm('Yakin Akan Menghapus Item Ini ?')"><span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span></a>&nbsp;&nbsp;<a href="#" data-toggle="modal" data-target="#modal-ubahriwayat<?php echo $data_akse['id']; ?>"><span data-toggle="tooltip" title="Ubah" class="fa fa-edit"></span></a></td>
    </tr>
    <div class="modal fade" id="modal-ubahriwayat<?php echo $data_akse['id']; ?>">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
              
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" align="center">Ubah Riwayat Panggilan</h4>
              </div>
              <form method="post" enctype="multipart/form-data">
              <div class="modal-body">
              <input type="hidden" name="id_ubah" class="form-control" value="<?php echo $data_akse['id'] ?>"/>
              <label>Tanggal</label>
                <input type="date" name="tgl1" class="form-control" value="<?php echo $data_akse['tgl_riwayat'] ?>" disabled="disabled"/>
                <br />
                <label>Jam</label>
                <input type="text" name="waktu1" disabled="disabled" class="form-control" value="Disable"/>
                <br />
                <label>Kegiatan</label>
                <textarea name="kegiatan1" class="form-control" cols="80%" rows="3"><?php echo $data_akse['kegiatan'] ?></textarea>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success" name="simpan_perubahan">Simpan Perubahan</button>
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

<div class="modal fade" id="modal-pilihnoseri">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
              
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" align="center">Tambah Riwayat Panggilan</h4>
              </div>
              <form method="post" enctype="multipart/form-data">
              <div class="modal-body">
              <label>Tanggal</label>
                <input type="date" name="tgl" class="form-control" value=""/>
                <br />
                <label>Jam</label>
                <input type="text" name="waktu" disabled="disabled" class="form-control" value="Auto"/>
                <br />
                <label>Kegiatan</label>
                <textarea name="kegiatan" class="form-control" cols="80%" rows="3"></textarea>
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
       