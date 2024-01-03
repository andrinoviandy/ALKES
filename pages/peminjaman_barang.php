<?php 
if (isset($_POST['pencarian'])) {
		if ($_POST['pilihan']=='tgl_peminjaman') {
		echo "<script>window.location='index.php?page=peminjaman_barang&tgl_awal=$_POST[tgl_awal]&tgl_akhir=$_POST[tgl_akhir]&tampil=$_POST[tampil]'</script>";
		} else {
		echo "<script>window.location='index.php?page=peminjaman_barang&pilihan=$_POST[pilihan]&kunci=$_POST[kata_kunci]&tampil=$_POST[tampil]'</script>";
		}
		
	}

if (isset($_POST['kirim_barang'])) {
	mysqli_query($koneksi, "delete from barang_pinjam_kirim_detail_hash where akun_id=".$_SESSION['id']."");
	$_SESSION['lokasi_tujuan']=$_POST['lokasi_tujuan'];
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
		window.location='index.php?page=pilih_no_seri_pinjam&id=".$_POST['id_kirim']."';
		</script>";
}

if (isset($_GET['id_hapus'])) {
	$d1=mysqli_query($koneksi, "delete from barang_pinjam_detail where barang_pinjam_id=".$_GET['id_hapus']."");
	$d2=mysqli_query($koneksi, "delete from barang_pinjam where id=".$_GET['id_hapus']."");
	if ($d1 and $d2) {
	echo "<script type='text/javascript'>
		alert('Data berhasil di hapus !');
		window.location='index.php?page=peminjaman_barang';
		</script>";
	} else {
		echo "<script>alert('Data tidak dapat di hapus !')</script>";
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
	
if (isset($_POST['simpan_tanggal'])) {
	$up_stok = mysqli_query($koneksi, "update barang_pinjam_detail set tgl_pengembalian='".$_POST['tgl_pengembalian']."' where id=".$_POST['barang_pinjam_detail_id']."");
	if ($up_stok) {
	echo "<script type='text/javascript'>
		window.location='index.php?page=peminjaman_barang';
		</script>";
		}
	}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Peminjaman Barang</h1>
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
              <a href="index.php?page=tambah_peminjaman_barang">
              <button name="tambah_laporan" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Tambah </button></a>
              <?php } ?>
              <?php if (isset($_GET['kunci']) or isset($_GET['tgl_awal'])) { ?>
              <a href="?page=peminjaman_barang"><button class="btn btn-info pull pull-right"><span class="fa fa-refresh"></span> Reset</button></a>&nbsp;&nbsp;
              <?php } ?>
              <button class="btn btn-success pull pull-right" data-toggle="modal" data-target="#modal-pencarian"><span class="fa fa-search"></span> Pencarian</button>
              <br />
              <?php if (isset($_GET['kunci']) or isset($_GET['tgl_awal'])) { ?>
              <br />
              <div class="pull pull-left">Data Berdasarkan : <?php 
			  if ($_GET['pilihan']=='nama_pembeli') {echo "<u><em>Nama RS/Dinas/Klinik/Dll</em></u>, Kata Kunci : ";}
			  elseif ($_GET['pilihan']=='nama_brg') {echo "<u><em>Nama Barang</em></u>, Kata Kunci : ";}
			  elseif ($_GET['pilihan']=='tipe_brg') {echo "<u><em>Tipe Barang</em></u>, Kata Kunci : ";}
			  elseif ($_GET['pilihan']=='no_seri_brg') {echo "<u><em>No Seri Barang</em></u>, Kata Kunci : ";}
			  else {
				  $tgl11=date("d/m/Y",strtotime($_GET['tgl_awal']));
				  $tgl22=date("d/m/Y",strtotime($_GET['tgl_akhir']));
				  echo "<u><em>Rentang Tanggal Peminjaman : $tgl11 - $tgl22</em></u>";}
			  echo "<u><em>".$_GET['kunci']."</em></u>"; ?></div><br />
              <?php } ?>
              <div class="table-responsive no-padding">
              <table width="100%" id="<?php if (isset($_GET['pilihan']) or isset($_GET['tgl_awal'])){echo "example1";} else {echo "example3";} ?>" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th valign="top">No</th>
        
        <th valign="top">Tanggal Peminjaman</th>
        <th valign="top">RS/Dinas/Dll</th>
        <th valign="top">No. Surat Jalan</th>
        <th valign="top">Kegiatan</th>
        <th valign="top">Barang</th>
        <th valign="top"><strong>Estimasi Pengembalian</strong></th>
      
      <!--<th valign="top"><strong>Teknisi</strong></th>-->
      <th valign="top"><strong>Aksi</strong></th>
          </tr>
  </thead>
  <?php
if (isset($_GET['pilihan']) and isset($_GET['kunci'])) {
	$file = file_get_contents("http://localhost/ALKES/json/peminjaman_barang.php?pilihan=$_GET[pilihan]&kunci=".str_replace(" ","%20",$_GET['kunci'])."");
}
elseif (isset($_GET['tgl_awal']) and isset($_GET['tgl_akhir'])) {
	$file = file_get_contents("http://localhost/ALKES/json/peminjaman_barang.php?tgl_awal=".$_GET['tgl_awal']."&tgl_akhir=".$_GET['tgl_akhir']."");
	}
else {
$file = file_get_contents("http://localhost/ALKES/json/peminjaman_barang.php");
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
    <td><?php echo date("d/m/Y", strtotime($json[$i]['tgl_peminjaman'])); ?>
    </td>
    <td><?php 
	echo $json[$i]['nama_pembeli']; ?></td>
    <td><?php 
	echo $json[$i]['no_pengiriman']; ?></td>
    <td><?php 
	echo $json[$i]['kegiatan']; ?></td>
    <td>
    <?php if ($_GET['tampil']==1) { ?>
    <?php 
	  $q23=mysqli_query($koneksi, "select *,barang_pinjam_detail.id as idd from barang_dikirim,barang_dikirim_detail,barang_dijual,pembeli,barang_gudang,barang_gudang_detail,barang_pinjam_detail where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and pembeli.id=barang_dijual.pembeli_id and barang_dijual.id=barang_dikirim.barang_dijual_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and barang_gudang_detail.id=barang_pinjam_detail.barang_gudang_detail_id and barang_pinjam_id=".$json[$i]['idd']."");
	  $n2=0;
	  while ($d1=mysqli_fetch_array($q23)) {
	  $n2++;
	  ?>
      <?php echo $n2.".[".$d1['nama_brg']."]-[".$d1['tipe_brg']."]-[".$d1['no_seri_brg']."]"; ?>
      <hr style="margin:0px; border-top:1px double; width:100%"/>
      <?php } ?>
    <?php } else { ?>
    <a href="#" data-toggle="modal" data-target="#modal-detailbarang<?php echo $json[$i]['idd']; ?>"><small data-toggle="tooltip" title="Detail Barang" class="label bg-primary"><span class="fa fa-folder-open"></span></small></a>
    <?php } ?>
    </td>
    <td>
      <?php 
	  if ($json[$i]['estimasi_pengembalian']!='0000-00-00') {
	  echo date("d-m-Y", strtotime($json[$i]['estimasi_pengembalian']));
	  } ?></td>
    
    <!--<td><?php 
	$data_tek=mysqli_fetch_array(mysqli_query($koneksi, "select * from tb_teknisi where id=".$json[$i]['teknisi_id'].""));
	echo $data_tek['nama_teknisi']; ?>
    <a href="index.php?page=spi&id_tek=<?php echo $json[$i]['teknisi_id']; ?>#open_teknisi"><span data-toggle="tooltip" title="Detail Teknisi" class="fa fa-eye pull pull-left"></span></a>
    </td>-->
    <td align="center">
    <a href="index.php?page=peminjaman_barang&id_hapus=<?php echo $json[$i]['idd']; ?>" onclick="return confirm('Anda Yakin Akan Menghapus Item Ini ?')"><span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span></a>
    <?php
	$n_cek = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_pinjam_detail where barang_pinjam_id=".$json[$i]['idd']." and status_kirim=0"));
	if ($n_cek!=0) {
	?>
    <br />
    <a href="#" data-toggle="modal" data-target="#modal-kirim<?php echo $json[$i]['idd']; ?>"><small data-toggle="tooltip" title="Kirim" class="label bg-green">Kirim</small></a>
    <?php } ?>
    </td>
  </tr>
  <div class="modal fade" id="modal-kirim<?php echo $json[$i]['idd']; ?>">
          <div class="modal-dialog modal-md">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" align="center">Kirim Barang Pinjaman</h4>
              </div>
              <form method="post">
              <div class="modal-body">
              <p align="justify">
              <input type="hidden" name="id_kirim" value="<?php echo $json[$i]['idd']; ?>"/>
              <label>Lokasi Tujuan</label>
              <div class="">
              <select name="lokasi_tujuan" id="lokasi_tujuan" required class="form-control select2" style="width:100%">
              <option value="">...</option>
					
					<?php 
					$result = mysqli_query($koneksi, "select *,pembeli.id as idd from pembeli,alamat_provinsi,alamat_kabupaten,alamat_kecamatan where alamat_provinsi.id=pembeli.provinsi_id and alamat_kabupaten.id=pembeli.kabupaten_id and alamat_kecamatan.id=pembeli.kecamatan_id group by nama_pembeli order by nama_pembeli ASC");    
					
					while ($row = mysqli_fetch_array($result)) {    
					echo '
						<option value="' . $row['idd'] . '">' . $row['nama_pembeli'] . '</option>';    
						
					}      
					?>    
				</select>
                <!--<span class="input-group-addon label-success" data-toggle="modal" data-target="#modal-tambahrs"><i class="fa fa-plus"></i></span>-->
                </div><br />
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
	  $q2=mysqli_query($koneksi, "select *,barang_pinjam_detail.id as idd from barang_dikirim,barang_dikirim_detail,barang_dijual,pembeli,barang_gudang,barang_gudang_detail,barang_pinjam_detail where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and pembeli.id=barang_dijual.pembeli_id and barang_dijual.id=barang_dikirim.barang_dijual_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and barang_gudang_detail.id=barang_pinjam_detail.barang_gudang_detail_id and barang_pinjam_id=".$json[$i]['idd']." group by barang_pinjam_detail.id order by nama_brg ASC");
	  $n=0;
	  while ($d1=mysqli_fetch_array($q2)) {
	  $n++;
	  ?>
      <?php echo "<b>Nama Barang : </b>".$d1['nama_brg']."<br>"; ?>
      <?php echo "<b>Tipe Barang : </b>".$d1['tipe_brg']."<br>" ?>
      <?php echo "<b>No Seri : </b>".$d1['no_seri_brg']."<br>"; ?>
      <?php if ($d1['tgl_pengembalian']!=0000-00-00){echo " (Sudah Dikembalikan)";} ?>
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
        
        <div class="modal fade" id="modal-detailpengembalian<?php echo $json[$i]['idd']; ?>">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" align="center">Detail Pengembalian</h4>
              </div>
              <form method="post">
              <div class="modal-body">
              <p align="justify">
              
      <?php 
	  $q2=mysqli_query($koneksi, "select *,barang_pinjam_detail.id as idd from barang_dikirim,barang_dikirim_detail,barang_dijual,pembeli,barang_gudang,barang_gudang_detail,barang_pinjam_detail where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and pembeli.id=barang_dijual.pembeli_id and barang_dijual.id=barang_dikirim.barang_dijual_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and barang_gudang_detail.id=barang_pinjam_detail.barang_gudang_detail_id and barang_pinjam_id=".$json[$i]['idd']." group by barang_pinjam_detail.id order by nama_brg ASC");
	  $n=0;
	  while ($d1=mysqli_fetch_array($q2)) {
	  $n++;
	  ?>
      <a href="#" data-toggle="modal" data-target="#modal-inputtanggal<?php echo $d1['idd'] ?>" class="pull pull-right"><h3><span data-toggle="tooltip" title="Ubah Tanggal Pengembalian" class="fa fa-calendar"></span></h3></a>
      <?php echo "<b>Nama Barang : </b>".$d1['nama_brg']."<br>"; ?>
      <?php echo "<b>Tipe Barang : </b>".$d1['tipe_brg']."<br>" ?>
      <?php echo "<b>No Seri : </b>".$d1['no_seri_brg']."<br>"; ?>
      <?php echo "<font style='font-size:18px'><b>Tanggal Pengembalian : </b>"; if ($d1['tgl_pengembalian']!=0000-00-00) {echo date("d/M/Y",strtotime($d1['tgl_pengembalian']));} echo "</font><br>"; ?>
      <hr />
      
      <div class="modal fade" id="modal-inputtanggal<?php echo $d1['idd']; ?>">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" align="center">Input Tanggal Pengembalian Barang</h4>
              </div>
              <form method="post">
              <div class="modal-body">
              <input type="hidden" name="barang_pinjam_detail_id" value="<?php echo $d1['idd']; ?>" />
              <input type="date" class="form-control" name="tgl_pengembalian" />
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" name="simpan_tanggal" class="btn btn-primary">Save</button>
              </div>
              </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
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
				  if (document.getElementById('yesCheck').value=='tgl_peminjaman') {
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
                <option value="tgl_peminjaman">Berdasarkan Rentang Tanggal Peminjaman</option>
                <option value="nama_pembeli">Berdasarkan Nama RS/Dinas/Klinik/Dll</option>
                <option value="nama_brg">Berdasarkan Nama Barang</option>
                <option value="tipe_brg">Berdasarkan Tipe Barang</option>
                <option value="no_seri_brg">Berdasarkan No Seri Barang</option>
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