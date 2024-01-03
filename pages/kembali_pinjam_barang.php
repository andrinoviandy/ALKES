<?php 
if (isset($_POST['pencarian'])) {
		if ($_POST['pilihan']=='tgl_peminjaman') {
		echo "<script>window.location='index.php?page=peminjaman_barang&tgl_awal=$_POST[tgl_awal]&tgl_akhir=$_POST[tgl_akhir]&tampil=$_POST[tampil]'</script>";
		} else {
		echo "<script>window.location='index.php?page=peminjaman_barang&pilihan=$_POST[pilihan]&kunci=$_POST[kata_kunci]&tampil=$_POST[tampil]'</script>";
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

if (isset($_POST['simpan_pengembalian'])) {
	$cek = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_pinjam_kembali where barang_pinjam_id=".$_POST['barang_pinjam_id'].""));
	if ($cek!=0) {
	$up_stok = mysqli_query($koneksi, "update barang_pinjam_kembali set tgl_kembali_ke_gudang='".$_POST['tgl_pengembalian1']."', tgl_kembali_ke_pemilik='".$_POST['tgl_pengembalian2']."' where barang_pinjam_id=".$_POST['barang_pinjam_id']."");
	if ($up_stok) {
	echo "<script type='text/javascript'>
		window.location='index.php?page=kembali_pinjam_barang';
		</script>";
		}
	} else {
	$up_stok = mysqli_query($koneksi, "insert into barang_pinjam_kembali values('','".$_POST['barang_pinjam_id']."','".$_POST['tgl_pengembalian1']."','".$_POST['tgl_pengembalian2']."')");
	if ($up_stok) {
	echo "<script type='text/javascript'>
		window.location='index.php?page=kembali_pinjam_barang';
		</script>";
		}
	}
}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Pengembalian Barang Pinjaman</h1>
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
              <br />
              <div class="table-responsive no-padding">
              <table width="129%" id="<?php if (isset($_GET['pilihan']) or isset($_GET['tgl_awal'])){echo "example1";} else {echo "example3";} ?>" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th valign="top">No</th>
        
        <th valign="top">Tanggal Peminjaman</th>
        <th valign="top">Pemilik</th>
        <th valign="top">Di Tujukan Ke</th>
        <th valign="top">No. Surat Jalan</th>
        <th valign="top">Kegiatan</th>
        <th valign="top">Barang</th>
        <th valign="top"><strong>Estimasi Pengembalian</strong></th>
        <th valign="top">Tanggal Pengiriman</th>
      <th valign="top">Tanggal Kembali Ke Gudang</th>
      <th valign="top">Tanggal Kembali Ke Pemilik</th>
      <th valign="top">Aksi</th>
      
      <!--<th valign="top"><strong>Teknisi</strong></th>-->
      
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
    <td>
    <?php
    $kir = mysqli_fetch_array(mysqli_query($koneksi, "select tgl_kirim,nama_pembeli from barang_pinjam_kirim,barang_pinjam_kirim_detail,barang_pinjam_detail,pembeli where barang_pinjam_kirim.id=barang_pinjam_kirim_detail.barang_pinjam_kirim_id and barang_pinjam_kirim_detail.barang_gudang_detail_id=barang_pinjam_detail.barang_gudang_detail_id and pembeli.id=barang_pinjam_kirim.pembeli_id and barang_pinjam_id=".$json[$i]['idd'].""));
	echo $kir['nama_pembeli'];
	?>
    </td>
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
	  echo date("d/m/Y", strtotime($json[$i]['estimasi_pengembalian']));
	  } ?></td>
    <td>
    <?php
    
	echo date("d/m/Y", strtotime($kir['tgl_kirim']));
	?>
    </td>
    <td>
    <?php
    $kem = mysqli_fetch_array(mysqli_query($koneksi, "select * from barang_pinjam_kembali where barang_pinjam_id=".$json[$i]['idd'].""));
	if ($kem['tgl_kembali_ke_gudang']!=0000-00-00) {
	echo date("d/m/Y",strtotime($kem['tgl_kembali_ke_gudang']));
	}
	?>
    </td>
    <td><?php 
	if ($kem['tgl_kembali_ke_pemilik']!=0000-00-00) {
		echo date("d/m/Y",strtotime($kem['tgl_kembali_ke_pemilik']));
		}
	 ?></td>
    <td>
    <?php if ($kir['tgl_kirim']!=0000-00-00) { ?>
    <a href="#" data-toggle="modal" data-target="#modal-pengembalian<?php echo $json[$i]['idd'] ?>"><span data-toggle="tooltip" title="Ubah Tanggal Pengembalian" class="fa fa-calendar"></span></a>
    <?php } ?>
    </td>
    
    <!--<td><?php 
	$data_tek=mysqli_fetch_array(mysqli_query($koneksi, "select * from tb_teknisi where id=".$json[$i]['teknisi_id'].""));
	echo $data_tek['nama_teknisi']; ?>
    <a href="index.php?page=spi&id_tek=<?php echo $json[$i]['teknisi_id']; ?>#open_teknisi"><span data-toggle="tooltip" title="Detail Teknisi" class="fa fa-eye pull pull-left"></span></a>
    </td>-->
    
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
        
        <div class="modal fade" id="modal-pengembalian<?php echo $json[$i]['idd']; ?>">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" align="center">Input Tanggal Pengembalian Barang</h4>
              </div>
              <form method="post">
              <div class="modal-body">
              <input type="hidden" name="barang_pinjam_id" value="<?php echo $json[$i]['idd']; ?>" />
              <label>Tanggal Kembali Ke Gudang</label>
              <input type="date" class="form-control" name="tgl_pengembalian1" /><br />
              <label>Tanggal Kembali Ke Pemilik</label>
              <input type="date" class="form-control" name="tgl_pengembalian2" />
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" name="simpan_pengembalian" class="btn btn-primary">Save</button>
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