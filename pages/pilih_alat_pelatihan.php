<?php
if (isset($_GET['hapus'])=='all') {
	$del=mysqli_query($koneksi, "delete from alat_pelatihan_hash where akun_id=".$_SESSION['id']."");
	if ($del) {
		echo "<script>
		window.location='index.php?page=pilih_alat_pelatihan'</script>";
		}
	} 
if (isset($_GET['simpan_barang'])==1) {
	$cek = mysqli_num_rows(mysqli_query($koneksi, "select * from alat_pelatihan_hash where akun_id=".$_SESSION['id'].""));
	if ($cek!=0) {
		echo "<script>
		window.location='index.php?page=tambah_pelatihan2'</script>";
		}
	else {
		echo "<script>
		alert('Data belum diisi !');
		history.back();
		</script>";
		}
}


if (isset($_POST['simpan_tambah_aksesoris'])) {
	$simpan = mysqli_query($koneksi, "insert into alat_pelatihan_hash values('','".$_SESSION['id']."','".$_POST['no_seri']."','','','','','','')");
	if ($simpan) {
		echo "<script>window.location='index.php?page=pilih_alat_pelatihan'</script>";
		}
	}
	
if (isset($_GET['id_hapus'])) {
	$del = mysqli_query($koneksi, "delete from alat_pelatihan_hash where id=".$_GET['id_hapus']."");
	}

if (isset($_GET['hapus'])) {
	$del = mysqli_query($koneksi, "delete from alat_pelatihan_hash where akun_id=".$_SESSION['id']."");
	echo "<script>window.location='index.php?page=pilih_alat_pelatihan'</script>";
	}
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Tambah Data Pelatihan Alkes</h1><ol class="breadcrumb">
       <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Tambah Data Pelatihan Alkes</li>
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
              <a href="index.php?page=pilih_alat_pelatihan&hapus=hapus_all"><button class="pull pull-left btn btn-success">Hapus Semua</button></a><br /><br />
                  <!--<font color="#FF0000">* Jika Ingin Menambah Data Aksesoris Yang Baru ! Klik Disini <a href="index.php?page=simpan_tambah_aksesoris&id=<?php //echo $_GET['id']; ?>#openAkse"><small data-toggle="tooltip" title="Tambah Aksesoris Baru" class="label bg-blue">+ New Accessories</small></a></font>-->
               
                <table width="100%" id="example3" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th width="6%" valign="bottom">No</th>
      <th width="27%" valign="bottom">RS/Dinas/Dll</th>
      <th width="25%" valign="bottom"><strong>Nomor SPI</strong></th>
      <td width="24%" align="center" valign="bottom"><strong>Alkes/No Seri</strong></td>
      <td width="18%" align="center" valign="bottom"><strong>Aksi</strong></td>
     </tr>
  </thead>
  <tr>
    <td>#</td>
    <form method="post" name="form1" enctype="multipart/form-data">
    <td>
    <select name="pembeli" id="pembeli" class="form-control" required>
        <option value="">-- Pilih --</option>
        
        <?php 
		$q3 = mysqli_query($koneksi, "select *,alat_uji_detail.id as idd,pembeli.id as id_rumkit from alat_uji_detail,barang_teknisi_detail,barang_dikirim_detail,barang_dikirim,barang_dijual,pembeli where pembeli.id=barang_dijual.pembeli_id and barang_dijual.id=barang_dikirim.barang_dijual_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and barang_dikirim_detail.id=barang_teknisi_detail.barang_dikirim_detail_id and barang_teknisi_detail.id=alat_uji_detail.barang_teknisi_detail_id and status_pelatihan=0 group by pembeli.id order by nama_pembeli ASC");
		
		while ($d2 = mysqli_fetch_array($q3)) { ?>
        <option value="<?php echo $d2['id_rumkit']; ?>"><?php echo $d2['nama_pembeli']; ?></option>
        <?php } ?>
        
        </select>
    </td>
    <td>
      <select name="id_akse" id="id_akse" class="form-control" required onchange="changeValue(this.value)">
        <option value="">-- Pilih Alkes --</option>
        
        <?php 
		$q = mysqli_query($koneksi, "select *,pembeli_id as id_rumkit,barang_gudang.id as id_gudang,barang_teknisi.id as id_brg_teknisi from barang_teknisi,barang_teknisi_detail, barang_dikirim,barang_dikirim_detail, barang_dijual, barang_gudang, barang_gudang_detail,pembeli,alat_uji_detail where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dijual.id=barang_dikirim.barang_dijual_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and pembeli.id=barang_dijual.pembeli_id and barang_dikirim_detail.id=barang_teknisi_detail.barang_dikirim_detail_id and barang_teknisi.id=barang_teknisi_detail.barang_teknisi_id and barang_teknisi_detail.id=alat_uji_detail.barang_teknisi_detail_id and status_pelatihan=0 group by barang_teknisi.id order by no_spk ASC");
		$jsArray = "var dtBrg = new Array();
";
		while ($d = mysqli_fetch_array($q)) { ?>
        <option id="id_akse" value="<?php echo $d['id_brg_teknisi']; ?>" class="<?php echo $d['id_rumkit']; ?>"><?php echo $d['no_spk']; ?></option>
        <?php 
		$jsArray .= "dtBrg['" . $d['id_gudang'] . "'] = {tipe_akse:'".addslashes($d['tipe_brg'])."',
						merk_akse:'".addslashes($d['merk_brg'])."',
						harga:'".addslashes("Rp ".number_format($d['harga_satuan'],2,',','.'))."',
						no_akse:'".addslashes($d['nie_brg'])."'
						};";
		} ?>
        </select>
    </td>
    <td align="center">
      <select name="no_seri" id="no_seri" class="form-control select2" required style="width:100%">
        <option value="">-- Pilih --</option>
        <?php
	$q_seri = mysqli_query($koneksi, "select *,alat_uji_detail.id as idd,pembeli_id as id_rumkit,barang_gudang.id as id_gudang,barang_teknisi.id as id_brg_teknisi from barang_teknisi,barang_teknisi_detail,barang_teknisi_detail_teknisi, barang_dikirim,barang_dikirim_detail, barang_dijual, barang_gudang, barang_gudang_detail,pembeli, tb_teknisi,alat_uji_detail where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dijual.id=barang_dikirim.barang_dijual_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and pembeli.id=barang_dijual.pembeli_id and barang_dikirim_detail.id=barang_teknisi_detail.barang_dikirim_detail_id and barang_teknisi.id=barang_teknisi_detail.barang_teknisi_id and barang_teknisi_detail.id=barang_teknisi_detail_teknisi.barang_teknisi_detail_id and tb_teknisi.id=barang_teknisi_detail_teknisi.teknisi_id and barang_teknisi_detail.id=alat_uji_detail.barang_teknisi_detail_id and status_pelatihan=0 group by alat_uji_detail.id order by no_seri_brg ASC");
	while ($d_seri=mysqli_fetch_array($q_seri)) {
	?>
        <option id="no_seri" value="<?php echo $d_seri['idd']; ?>" class="<?php echo $d_seri['id_brg_teknisi']; ?>"><?php echo $d_seri['nama_brg']." / ".$d_seri['no_seri_brg']." ".$d_seri['nama_set']; ?></option>
        <?php } ?>
        </select>
      <script src="jquery-1.10.2.min.js"></script>
      <script src="jquery.chained.min.js"></script>
      <script>
            $("#id_akse").chained("#pembeli");
			$("#no_seri").chained("#id_akse");
			
        </script>
    </td>
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
  $q_akse = mysqli_query($koneksi, "select *,alat_pelatihan_hash.id as idd,pembeli_id as id_rumkit from barang_teknisi,barang_teknisi_detail,barang_teknisi_detail_teknisi, barang_dikirim,barang_dikirim_detail, barang_dijual, barang_gudang, barang_gudang_detail,pembeli, tb_teknisi,alat_uji_detail,alat_pelatihan_hash where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dijual.id=barang_dikirim.barang_dijual_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and pembeli.id=barang_dijual.pembeli_id and barang_dikirim_detail.id=barang_teknisi_detail.barang_dikirim_detail_id and barang_teknisi.id=barang_teknisi_detail.barang_teknisi_id and barang_teknisi_detail.id=barang_teknisi_detail_teknisi.barang_teknisi_detail_id and tb_teknisi.id=barang_teknisi_detail_teknisi.teknisi_id and barang_teknisi_detail.id=alat_uji_detail.barang_teknisi_detail_id and alat_uji_detail.id=alat_pelatihan_hash.alat_uji_detail_id and akun_id=".$_SESSION['id']." order by alat_pelatihan_hash.id DESC");
  
  while ($data_akse = mysqli_fetch_array($q_akse)) {
	  $no++;
  ?>
  <tr>
    <td><?php echo $no; ?></td>
    <td><?php echo $data_akse['nama_pembeli']; ?></td>
    <td><?php echo $data_akse['no_spk']; ?>
    </td>
    <td align="center"><?php echo $data_akse['nama_brg']." / ".$data_akse['no_seri_brg']." ".$data_akse['nama_set']; ?></td>
    <td align="center"><a href="index.php?page=pilih_alat_pelatihan&id_hapus=<?php echo $data_akse['idd']; ?>" onclick="return confirm('Yakin Akan Menghapus Item Ini ?')"><span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span></a></td>
    </tr>
  <?php } ?>
</table>
<center><a href="index.php?page=pilih_alat_pelatihan&simpan_barang=1">
  <button name="simpan_barang" class="btn btn-success" type="submit"><span class="fa fa-check"></span> Next</button></a></center>
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
  <?php 
  if (isset($_POST['tambah_laporan'])) {
	$Result = mysqli_query($koneksi, "insert into aksesoris values('','".$_POST['nama_akse']."','".$_POST['merk']."','".$_POST['tipe']."','".$_POST['no_seri']."','".$_POST['stok']."', '".$_POST['deskripsi']."','".$_POST['harga_satuan']."')");
	if ($Result) {
		echo "<script type='text/javascript'>
		alert('Data Berhasil Di Tambah !');
		window.location='index.php?page=simpan_tambah_aksesoris&id=$_GET[id]';
		</script>";
		}
	}
		?>
  <div id="openAkse" class="modalDialog">
     <div>
        <a href="#" title="Close" class="close">X</a>
        <h3 align="center">Tambah Aksesoris Baru</h3> 
     <form method="post">
              <input name="nama_akse" class="form-control" type="text" required placeholder="Nama Aksesoris" autofocus><br />
              
              <input name="merk" class="form-control" type="text" placeholder="Merk" required><br />
              
              <input name="tipe" class="form-control" type="text" placeholder="Tipe" required><br />
              
              <input name="no" class="form-control" type="text" placeholder="Nomor Seri" required><br />
              
              <input name="stok" class="form-control" type="text" placeholder="Stok" required><br />
              
              <textarea name="deskripsi" class="form-control" type="text" rows="5" placeholder="Deskripsi Alat" required></textarea><br />
              <?php if (isset($_SESSION['user_administrator']) && isset($_SESSION['pass_administrator'])) { ?>
              <input name="harga_satuan" class="form-control" type="text" placeholder="Harga Satuan" required><br />
              <?php } ?>
              
              <button name="tambah_laporan" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Simpan</button>
              <br /><br />
              </form>
              
    </div>
</div>
