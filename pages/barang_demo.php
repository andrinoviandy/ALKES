<?php 
if (isset($_POST['pencarian'])) {
		if ($_POST['pilihan']=='tgl_pinjam') {
		echo "<script>window.location='index.php?page=barang_demo&tgl_awal=$_POST[tgl_awal]&tgl_akhir=$_POST[tgl_akhir]&tampil=$_POST[tampil]'</script>";
		} else {
		echo "<script>window.location='index.php?page=barang_demo&pilihan=$_POST[pilihan]&kunci=$_POST[kata_kunci]&tampil=$_POST[tampil]'</script>";
		}
		
	}

if (isset($_POST['kirim_barang'])) {
	mysqli_query($koneksi, "delete from barang_demo_kirim_detail_hash where akun_id=".$_SESSION['id']."");
	$_SESSION['nama_paket']=$_POST['nama_paket'];
	$_SESSION['no_pengiriman']=$_POST['no_peng'];
	$_SESSION['ekspedisi']=$_POST['ekspedisi'];
	$_SESSION['tgl_pengiriman']=$_POST['tgl_kirim'];
	$_SESSION['via_pengiriman']=$_POST['via_kirim'];
	$_SESSION['estimasi']=$_POST['estimasi_brg_sampai'];
	$_SESSION['biaya_kirim']=$_POST['biaya_kirim'];
	$_SESSION['no_po']=$_POST['no_po'];
	$_SESSION['keterangan']=str_replace("\n","<br>",$_POST['keterangan']);
	echo "<script type='text/javascript'>
		window.location='index.php?page=pilih_no_seri_demo&id=".$_POST['id_kirim']."';
		</script>";
}

if (isset($_GET['id_hapus'])) {
	$d1=mysqli_query($koneksi, "delete from barang_demo_qty where barang_demo_id=".$_GET['id_hapus']."");
	$d2=mysqli_query($koneksi, "delete from barang_demo where id=".$_GET['id_hapus']."");
	if ($d1 and $d2) {
	echo "<script type='text/javascript'>
	alert('Data berhasil di hapus');
		window.location='index.php?page=barang_demo';
		</script>";
	} else {
		echo "<script>alert('Data tidak dapat di hapus ?')</script>";
		}
		
	}
if (isset($_GET['id_ubah'])) {
	$sel=mysqli_query($koneksi, "select * from barang_demo_detail where barang_demo_id=".$_GET['id_ubah']."");
	while ($d = mysqli_fetch_array($sel)) {
		$up_stok = mysqli_query($koneksi, "update barang_gudang,barang_gudang_detail set stok_total=stok_total+1,status_demo=0 where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=".$d['barang_gudang_detail_id']."");
		}
		if ($up_stok) {
			mysqli_query($koneksi, "update barang_demo set status=1 where id=".$_GET['id_ubah']."");
	echo "<script type='text/javascript'>
		window.location='index.php?page=barang_demo';
		</script>";
		}
	}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Barang Demo</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
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
              <?php if (isset($_SESSION['user_admin_gudang']) or isset($_SESSION['user_administrator'])) { ?>
              <a href="index.php?page=tambah_brg_demo">
              <button name="tambah_laporan" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Tambah </button></a>
              <?php } ?>
              <?php if (isset($_GET['kunci']) or isset($_GET['tgl_awal'])) { ?>
              <a href="?page=barang_demo"><button class="btn btn-info pull pull-right"><span class="fa fa-refresh"></span> Reset</button></a>&nbsp;&nbsp;
              <?php } ?>
              <button class="btn btn-success pull pull-right" data-toggle="modal" data-target="#modal-pencarian"><span class="fa fa-search"></span> Pencarian</button>
              <br />
              <?php if (isset($_GET['kunci']) or isset($_GET['tgl_awal'])) { ?>
              <br />
              <div class="pull pull-left">Data Berdasarkan : <?php 
			  if ($_GET['pilihan']=='supplier') {echo "<u><em>Supplier</em></u>, Kata Kunci : ";}
			  elseif ($_GET['pilihan']=='nama_pembeli') {echo "<u><em>Nama RS/Dinas/Klinik/Dll</em></u>, Kata Kunci : ";}
			  elseif ($_GET['pilihan']=='nama_brg') {echo "<u><em>Nama Barang</em></u>, Kata Kunci : ";}
			  elseif ($_GET['pilihan']=='tipe_brg') {echo "<u><em>Tipe Barang</em></u>, Kata Kunci : ";}
			  else {
				  $tgl11=date("d/m/Y",strtotime($_GET['tgl_awal']));
				  $tgl22=date("d/m/Y",strtotime($_GET['tgl_akhir']));
				  echo "<u><em>Rentang Tanggal : $tgl11 - $tgl22</em></u>";}
			  echo "<u><em>".$_GET['kunci']."</em></u>"; ?></div><br />
              <?php } ?>
              <div class="table-responsive no-padding">
              <table width="100%" id="<?php if (isset($_GET['pilihan']) or isset($_GET['tgl_awal'])){echo "example1";} else {echo "example3";} ?>" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th valign="top">No</th>
        
        <th valign="top">Tanggal Pinjam</th>
        <th valign="top">Supplier</th>
        <th valign="top">Kegiatan</th>
        <th valign="top">Rumah Sakit/Dinas/Dll</th>
        <th valign="top">Barang</th>
        <th valign="top">Sisa Kirim</th>
      
      <th valign="top"><strong>Estimasi Kembali</strong></th>
      <th valign="top">Subdis</th>
      <th valign="top">PIC</th>
      
      <!--<th valign="top"><strong>Teknisi</strong></th>-->
      <th valign="top"><strong>Aksi</strong></th>
          </tr>
  </thead>
  <?php
if (isset($_GET['pilihan']) and isset($_GET['kunci'])) {
	$file = file_get_contents("http://localhost/ALKES/json/barang_demo.php?pilihan=$_GET[pilihan]&kunci=".str_replace(" ","%20",$_GET['kunci'])."");
}
elseif (isset($_GET['tgl_awal']) and isset($_GET['tgl_akhir'])) {
	$file = file_get_contents("http://localhost/ALKES/json/barang_demo.php?tgl_awal=".$_GET['tgl_awal']."&tgl_akhir=".$_GET['tgl_akhir']."");
	}
else {
$file = file_get_contents("http://localhost/ALKES/json/barang_demo.php");
}
// membuka file JSON

$json = json_decode($file, true);
$jml=count($json); 
for ($i=0; $i<$jml; $i++) {
//echo "Nama Barang ke-".$i." : " . $json[$i]['nama_brg'] . "<br />";
//echo 'Nama Anggota ke-3 : ' . $json['2']['nama_brg'];
?>
  <tr>
  
    <td align="center"><?php echo $i+1; ?></td>
    <td><?php echo date("d/m/Y", strtotime($json[$i]['tgl_pinjam'])); ?>
    </td>
    <td><?php 
	echo $json[$i]['supplier']; ?></td>
    <td><?php 
	echo $json[$i]['deskripsi_kegiatan']; ?></td>
    <td><?php 
	echo $json[$i]['nama_pembeli']; ?></td>
    <td>
    <?php if ($_GET['tampil']==1) { ?>
    <?php 
	  $q23=mysqli_query($koneksi, "select * from barang_gudang,barang_demo,barang_demo_qty where barang_gudang.id=barang_demo_qty.barang_gudang_id and barang_demo.id=barang_demo_qty.barang_demo_id and barang_demo.id=".$json[$i]['idd']."");
	  $n2=0;
	  while ($d1=mysqli_fetch_array($q23)) {
	  $n2++;
	  ?>
      <?php if ($d1['status_batal']==1) { ?>
        <font class="pull pull-right" size="" color="#FF0000">(Batal)</font>
        <?php } ?>
      <?php echo $n2.".[".$d1['nama_brg']."]-[".$d1['tipe_brg']."]-[".$d1['qty']."]"; ?>
      <hr style="margin:0px; border-top:1px double; width:100%"/>
      <?php } ?>
    <?php } else { ?>
    <a href="#" data-toggle="modal" data-target="#modal-detailbarang<?php echo $json[$i]['idd']; ?>"><small data-toggle="tooltip" title="Detail Barang" class="label bg-primary"><span class="fa fa-folder-open"></span></small></a>
    <?php } ?>
    </td>
    <td>
    <?php if ($_GET['tampil']==1) { ?>
    <?php 
	  $q24=mysqli_query($koneksi, "select *,barang_demo_qty.id as id_det_jual from barang_demo_qty,barang_demo,barang_gudang where barang_demo.id=barang_demo_qty.barang_demo_id and barang_gudang.id=barang_demo_qty.barang_gudang_id and barang_demo_qty.barang_demo_id=".$json[$i]['idd']."");
	  $n3=0;
	  while ($d1=mysqli_fetch_array($q24)) {
	  $n3++;
	  ?>
      <?php
	  $q4 = mysqli_num_rows(mysqli_query($koneksi , "select * from barang_demo_kirim_detail where barang_demo_qty_id=".$d1['id_det_jual'].""));
		
		if ($d1['qty']-$q4==0) {
			echo "<span class='fa fa-check pull pull-right'></span>";
			}
		else {
			echo "<span class='fa fa-close pull pull-right'></span>";
			}
	  echo $n3."[".$d1['nama_brg']."]-[".$d1['tipe_brg']."]-[".$d1['qty']-$q4."]"; ?>
      <?php if ($d1['status_batal']==1){echo "<span class='pull pull-right'>(Batal)</span>";} ?>
      <hr style="margin:0px; border-top:1px double; width:100%"/>
      <?php } ?>
    <?php } else { ?>
    <a href="#" data-toggle="modal" data-target="#modal-sisakirim<?php echo $json[$i]['idd']; ?>"><small data-toggle="tooltip" title="Detail Barang" class="label bg-primary"><span class="fa fa-folder-open"></span></small></a>
    <?php } ?>
    </td>
    
    <td><!--<a href="index.php?page=spk_masuk&id_spk=<?php //echo $data['idd']; ?>#open_detail"><span data-toggle="tooltip" title="Detail Rumah Sakit/Dinas/Puskemas/Klinik" class="fa fa-eye pull pull-left"></span></a>-->
      <?php 
	  if ($json[$i]['estimasi_kembali']!='0000-00-00') {
	  echo date("d-m-Y", strtotime($json[$i]['estimasi_kembali']));
	  } ?></td>
    <td><?php 
	echo $json[$i]['subdis']; ?></td>
    <td><?php 
	echo $json[$i]['pic']; ?></td>
    
    <!--<td><?php 
	$data_tek=mysqli_fetch_array(mysqli_query($koneksi, "select * from tb_teknisi where id=".$json[$i]['teknisi_id'].""));
	echo $data_tek['nama_teknisi']; ?>
    <a href="index.php?page=spi&id_tek=<?php echo $json[$i]['teknisi_id']; ?>#open_teknisi"><span data-toggle="tooltip" title="Detail Teknisi" class="fa fa-eye pull pull-left"></span></a>
    </td>-->
    <td align="center">
      <?php if ($json[$i]['status']==0) { ?>
        <a href="index.php?page=barang_demo&id_hapus=<?php echo $json[$i]['idd']; ?>" onclick="return confirm('Anda Yakin Akan Menghapus Item Ini ?')"><span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span></a>&nbsp;&nbsp;<a href="index.php?page=ubah_barang_demo&id_ubah=<?php echo $json[$i]['idd']; ?>"><span data-toggle="tooltip" title="Ubah" class="fa fa-edit"></span></a><br />
        <?php
        $q_cek=mysqli_query($koneksi, "select *,barang_demo_qty.id as id_det_jual from barang_demo_qty,barang_demo,barang_gudang where barang_demo.id=barang_demo_qty.barang_demo_id and barang_gudang.id=barang_demo_qty.barang_gudang_id and barang_demo_qty.barang_demo_id=".$json[$i]['idd']."");
	  $n_cek=0;
	  while ($d1=mysqli_fetch_array($q_cek)) {
	  $q4 = mysqli_num_rows(mysqli_query($koneksi , "select * from barang_demo_kirim_detail where barang_demo_qty_id=".$d1['id_det_jual'].""));
	  $n_cek=$n_cek+$d1['qty']-$q4;
	  }
	  if ($n_cek!=0) {
		?>
        <a href="#" data-toggle="modal" data-target="#modal-kirim<?php echo $json[$i]['idd']; ?>"><small data-toggle="tooltip" title="Kirim" class="label bg-green">Kirim</small></a>
        <?php  } ?>
        <!--<a href="index.php?page=barang_demo&id_ubah=<?php echo $json[$i]['idd']; ?>" onclick="return confirm('Aksi ini akan mengembalikan stok ke gudang , dan history tidak akan terhapus ?')"><small data-toggle="tooltip" title="Kembali Ke Stok Gudang" class="label bg-green">Kembali Ke Gudang</small></a>--><?php } else {echo "Sudah Masuk Stok";} ?>
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
	  $q2=mysqli_query($koneksi, "select * from barang_gudang,barang_demo,barang_demo_qty where barang_gudang.id=barang_demo_qty.barang_gudang_id and barang_demo.id=barang_demo_qty.barang_demo_id and barang_demo.id=".$json[$i]['idd']."");
	  $n=0;
	  while ($d1=mysqli_fetch_array($q2)) {
	  $n++;
	  ?>
      <?php echo "<b>Nama Barang : </b>".$d1['nama_brg']."<br>"; ?>
      <?php echo "<b>Tipe Barang : </b>".$d1['tipe_brg']."<br>" ?>
      <?php echo "<b>Kuantitas : </b>".$d1['qty']."<br>"; ?>
      <?php if ($d1['status_batal']==1){echo " (Batal)";} ?>
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
        
        <div class="modal fade" id="modal-sisakirim<?php echo $json[$i]['idd']; ?>">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" align="center">Sisa Barang Belum Di Kirim</h4>
              </div>
              <form method="post">
              <div class="modal-body">
              <p align="justify">
              
      <?php 
	  $q2=mysqli_query($koneksi, "select *,barang_demo_qty.id as id_det_jual from barang_demo_qty,barang_demo,barang_gudang where barang_demo.id=barang_demo_qty.barang_demo_id and barang_gudang.id=barang_demo_qty.barang_gudang_id and barang_demo_qty.barang_demo_id=".$json[$i]['idd']."");
	  $n=0;
	  while ($d1=mysqli_fetch_array($q2)) {
	  $n++;
	  ?>
      <?php
	  $q4 = mysqli_num_rows(mysqli_query($koneksi , "select * from barang_demo_kirim_detail where barang_demo_qty_id=".$d1['id_det_jual'].""));
		
		if ($d1['qty']-$q4==0) {
			echo "<h2><span class='fa fa-check pull pull-right'></span></h2>";
			}
		else {
			echo "<h2><span class='fa fa-close pull pull-right'></span></h2>";
			}
	  echo "<b>Nama Barang : </b>".$d1['nama_brg']."<br>"; ?>
      <?php echo "<b>Tipe Barang : </b>".$d1['tipe_brg']."<br>" ?>
      <?php echo "<b>Kuantitas : </b>".$d1['qty']."<br>"; ?>
      <?php echo "<b>Barang Belum Di Kirim : </b>"; 
		echo $d1['qty']-$q4;
		
			
	  ?>
      <?php if ($d1['status_batal']==1){echo " (Batal)";} ?>
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
        
        <div class="modal fade" id="modal-kirim<?php echo $json[$i]['idd']; ?>">
          <div class="modal-dialog modal-md">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" align="center">Kirim Barang Demo</h4>
              </div>
              <form method="post">
              <div class="modal-body">
              <p align="justify">
              <input type="hidden" name="id_kirim" value="<?php echo $json[$i]['idd']; ?>"/>
              <label>Nama Paket</label>
     <input id="input" type="text" placeholder="" name="nama_paket" required>
     <label>No. Surat Jalan</label>
     <input id="input" type="text" placeholder="" name="no_peng" required>
     <label>Ekspedisi</label>
     <input id="input" type="text" placeholder="" name="ekspedisi" required>
     <label>Tanggal Pengiriman</label>
     <input id="input" type="date" placeholder="" name="tgl_kirim" required>
     <label>Via Pengiriman</label>
     <input id="input" type="text" placeholder="" name="via_kirim" required>
     <label>Estimasi Barang Sampai</label>
     <input id="input" type="date" placeholder="" name="estimasi_brg_sampai" >
     <label>Biaya Jasa</label>
     <input id="input" type="text" placeholder="" name="biaya_kirim" required="required">
     <label>Keterangan</label>
     <textarea name="keterangan" id="input" rows="4"></textarea>
              </p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button name="kirim_barang" type="submit" class="btn btn-success">Next</button>
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
  
  <div class="modal fade" id="modal-pencarian">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
              <script type="text/javascript">
			  function yesnoCheck() {
				  if (document.getElementById('yesCheck').value=='tgl_pinjam') {
					  document.getElementById('ifYes').style.display = 'block';
					  document.getElementById('kata_kunci').style.display = 'none';
					  }
					  else 
					  { document.getElementById('ifYes').style.display = 'none';
					  document.getElementById('kata_kunci').style.display = 'block';
					  }
					  }

 

</script>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Pencarian</h4>
              </div>
              <form method="post" enctype="multipart/form-data">
              <div class="modal-body">
                <select class="form-control select2" name="pilihan" required style="width:100%" onchange="javascript:yesnoCheck();" id="yesCheck">
                <option value="">...</option>
                <option value="tgl_pinjam">Berdasarkan Rentang Tanggal Peminjaman</option>
                <option value="supplier">Berdasarkan Supplier</option>
                <option value="nama_pembeli">Berdasarkan Nama RS/Dinas/Klinik/Dll</option>
                <option value="nama_brg">Berdasarkan Nama Barang</option>
                <option value="tipe_brg">Berdasarkan Tipe Barang</option>
                </select>
                <br /><br />
                <div id="kata_kunci" style="display:block">
                <input type="text" class="form-control" name="kata_kunci" placeholder="Kata Kunci"/>
                </div>
                <div id="ifYes" style="display:none">
              <label>Dari Tanggal</label>
              <input name="tgl_awal" type="date" class="form-control" placeholder="" value=""><br />
              <label>Sampai Tanggal</label>
              <input name="tgl_akhir" type="date" class="form-control" placeholder="" value="">
              </div>
              <br />
              <select name="tampil" class="form-control select2" style="width:100%">
                <option value="">...</option>
                <option value="1">Tampilkan Detail Barang</option>
                <option value="0">Tidak Tampilkan Detail Barang</option>
                </select>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success" name="pencarian">Cari</button>
              </div>
              </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>