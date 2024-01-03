<?php
$data=mysqli_fetch_array(mysqli_query($koneksi, "select * from barang_kembali where id=".$_GET['id']."")); 

if (isset($_GET['simpan_barang'])==1) {
	$cek = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_teknisi_hash where akun_id=".$_SESSION['id'].""));
	if ($cek!=0) {
	//$insert_pembeli=mysqli_query($koneksi, "insert into pembeli values('','".$_SESSION['pembeli']."','".$_SESSION['provinsi']."','".$_SESSION['kabupaten']."','".$_SESSION['kecamatan']."','".$_SESSION['kelurahan']."','".$_SESSION['alamat']."','".$_SESSION['kontak_rs']."')");
	
	$insert_pemakai=mysqli_query($koneksi, "insert into pemakai values('','".$_SESSION['pemakai']."','".$_SESSION['kontak1']."','".$_SESSION['kontak2']."','".$_SESSION['email']."')");
	
	//$pembeli=mysqli_fetch_array(mysqli_query($koneksi, "select max(id) as id_pembeli from pembeli"));
	/*$id_pembeli=$_SESSION['pembeli'];
	$pemakai=mysqli_fetch_array(mysqli_query($koneksi, "select max(id) as id_pemakai from pemakai"));
	$id_pemakai=$pemakai['id_pemakai'];
	//simpan barang dijual
	$total = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_dijual_hash where akun_id=".$_SESSION['id'].""));
	*/
	$simpan1=mysqli_query($koneksi, "insert into barang_teknisi values('','".$_SESSION['tgl_spi']."','".$_SESSION['no_spi']."')");
	
	$d1=mysqli_fetch_array(mysqli_query($koneksi, "select max(id) as id_max from barang_teknisi"));
	$id_jual=$d1['id_max'];
	//simpan barang pesan detail
	$q2=mysqli_query($koneksi, "select * from barang_teknisi_hash where akun_id=".$_SESSION['id']."");
	while ($d2 = mysqli_fetch_array($q2)) {
		$simpan2=mysqli_query($koneksi, "insert into barang_teknisi_detail values('','$id_jual','".$d2['barang_dikirim_detail_id']."','0')");
		$up=mysqli_query($koneksi, "update barang_dikirim_detail set status_spi=1 where id=".$d2['barang_dikirim_detail_id']."");
		//$up2=mysqli_query($koneksi, "update barang_gudang,barang_gudang_detail set stok_total=stok_total-1 where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=".$d2['barang_gudang_detail_id']."");
		}
		if ($simpan1 and $simpan2) {
			mysqli_query($koneksi, "delete from barang_teknisi_hash where akun_id=".$_SESSION['id']."");
	echo "<script type='text/javascript'>
	alert('Data Berhasil Di Simpan !');
	window.location='index.php?page=spi'</script>";
		}
	}
	else {
		echo "<script type='text/javascript'>
	alert('Data tidak boleh kosong , silakan tambah terlebih dahulu ! !');
	window.location='index.php?page=tambah_spk_masuk2'</script>";
		}
}


if (isset($_POST['simpan_tambah_aksesoris'])) {
	//$no=mysqli_num_rows(mysqli_query($koneksi, "select * from barang_dijual_hash"))+1;
	
	if ($_POST['id_brg']=='all') {
		$que = mysqli_query($koneksi, "select * from barang_kembali_detail where barang_kembali_id=".$_GET['id']."");
		while ($data_que = mysqli_fetch_array($que)) {
			$simpan = mysqli_query($koneksi, "insert into barang_kembali_teknisi values('','".$data_que['id']."','".$_POST['id_teknisi']."','0')");
			}
			if ($simpan) {
		echo "<script>
		window.location='index.php?page=barang_kembali_pilih_teknisi&id=$_GET[id]'</script>";
		}
		}
	else {
		if ($_POST['no_seri']=="") {
			$sel = mysqli_query($koneksi, "select barang_kembali_detail.id as idd from barang_gudang_detail,barang_gudang,barang_kembali,barang_kembali_detail where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_kembali_detail.barang_gudang_detail_id and barang_kembali.id=barang_kembali_detail.barang_kembali_id and barang_gudang.id=".$_POST['id_brg']."");
			while ($sm = mysqli_fetch_array($sel)) {
				$simpan = mysqli_query($koneksi, "insert into barang_kembali_teknisi values('','".$sm['idd']."','".$_POST['id_teknisi']."','0')");
				}
				if ($simpan) {
		echo "<script>
		window.location='index.php?page=barang_kembali_pilih_teknisi&id=$_GET[id]'</script>";
				}
			}
		else {
				$simpan = mysqli_query($koneksi, "insert into barang_kembali_teknisi values('','".$_POST['no_seri']."','".$_POST['id_teknisi']."','0')");
				if ($simpan) {
		echo "<script>
		window.location='index.php?page=barang_kembali_pilih_teknisi&id=$_GET[id]'</script>";
				}
				}
		}
	
	
}
	
if (isset($_GET['id_hapus'])) {
	$del = mysqli_query($koneksi, "delete from barang_kembali_teknisi where id=".$_GET['id_hapus']."");
	echo "<script>
	window.location='index.php?page=barang_kembali_pilih_teknisi&id=$_GET[id]';
	</script>";
	}
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Pilih Teknisi</h1><ol class="breadcrumb">
       <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"> Pilih Teknisi</li>
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
              <!--<a href="index.php?page=tambah_barang_masuk"><button name="tambah_laporan" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Tambah Barang</button></a>-->
              <div class="table-responsive">
              <table width="100%" id="" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th width="19%" valign="bottom">No Retur</th>
      <th width="26%" valign="bottom"><strong>Tgl Retur</strong></th>
      <th width="20%" valign="bottom">No PO</th>
      <th width="35%" valign="bottom">Dinas/RS/Dll</th>
      </tr>
  </thead>
  <tr>
    <td align="left"><?php echo $data['no_retur']; ?></td>
    <td align="left"><?php echo date("d F Y",strtotime($data['tgl_retur'])); ?>
    </td>
    <td align="left"><?php echo $data['no_po_id']; ?></td>
    <td align="left"><?php 
	$pemb = mysqli_fetch_array(mysqli_query($koneksi, "select nama_pembeli from barang_kembali,barang_dikirim,barang_dikirim_detail,barang_dijual,pembeli where pembeli.id=barang_dijual.pembeli_id and barang_dijual.id=barang_dikirim.barang_dijual_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and barang_dikirim.id=barang_kembali.barang_dikirim_id and barang_kembali.id=".$_GET['id']."")); 
	echo $pemb['nama_pembeli'];
	?></td>
    </tr>
</table>
              </div>
                <br />
                <font align="left" size="+2">
                 Data</font>
                 <button name="tambah" class="btn btn-success pull pull-right" type="button" data-toggle="modal" data-target="#modal-tambah"><span class="fa fa-plus"></span> Tambah</button>
                 <br /><br />
                <div class="table-responsive">
                <table width="100%" id="example1" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th width="7%" align="center" valign="bottom">No</th>
      <th width="41%" valign="bottom"><strong> Alkes</strong></th>
      <td width="34%" valign="bottom"><strong>No Seri      
      
      / Nama Set</strong><td width="34%" valign="bottom"><strong> Teknisi</strong>
      <td width="18%" align="center" valign="bottom"><strong>Aksi</strong></tr>
  </thead>
  <?php
   
  $no=0;
  $q_akse = mysqli_query($koneksi, "select *,barang_kembali_teknisi.id as idd from barang_gudang_detail,barang_gudang,barang_kembali,barang_kembali_detail,barang_kembali_teknisi,tb_teknisi where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_kembali_detail.barang_gudang_detail_id and barang_kembali.id=barang_kembali_detail.barang_kembali_id and barang_kembali_detail.id=barang_kembali_teknisi.barang_kembali_detail_id and tb_teknisi.id=barang_kembali_teknisi.teknisi_id and barang_kembali.id=".$_GET['id']."");
  $jm = mysqli_num_rows($q_akse);
  if ($jm!=0) { 
  while ($data_akse = mysqli_fetch_array($q_akse)) {
	  $no++;
  ?>
  <tr>
    <td align="center"><?php echo $no; ?></td>
    <td align="left"><?php echo $data_akse['nama_brg']; ?>
    </td>
    <td align="left"><?php echo $data_akse['no_seri_brg']." ".$data_akse['nama_set']; ?></td>
    <td align="left"><?php echo $data_akse['nama_teknisi'] ?></td>
    <td align="center"><a href="index.php?page=barang_kembali_pilih_teknisi&id_hapus=<?php echo $data_akse['idd']; ?>&id=<?php echo $_GET['id']; ?>" onclick="return confirm('Yakin Akan Menghapus Item Ini ?')"><span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span></a></td>
    </tr>
  <?php }} else {
	  echo "<tr><td colspan='7' align='center'>Tidak Ada Data</td></tr>";
	  } ?>
</table>
                </div>
<center><!--<a href="index.php?page=tambah_spk_masuk2&simpan_barang=1"><button name="simpan_barang" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Simpan</button></a>&nbsp;&nbsp;--><a href="index.php?page=barang_kembali_teknisi">
<button name="batal" class="btn btn-success" type="submit"><span class="fa  fa-check"></span> Kembali</button></a></center>
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
$d_tek = mysqli_fetch_array(mysqli_query($koneksi, "select * from barang_teknisi where id=$_GET[id]"));
if (isset($_POST['simpan_teknisi'])) {
	$sim = mysqli_query($koneksi, "update barang_teknisi set teknisi_id='".$_POST['id_teknisi']."', estimasi='".$_POST['estimasi']."', tgl_berangkat_teknisi='".$_POST['tgl_berangkat']."' where id=$_GET[id]");
	if ($sim){
		echo "<script>window.location='index.php?page=spk_masuk'</script>";
		}
	}

?>
<div id="openTeknisi" class="modalDialog">
     <div>
        <a href="#" title="Close" class="close">X</a>
        <h3 align="center"></h3> 
     <form method="post">
     <label>Teknisi</label>
     <select name="id_teknisi" class="form-control" <?php echo $dis; ?>>
              <option value="">--Pilih Teknisi--</option>
              <?php 
			  $query_teknisi = mysqli_query($koneksi, "select * from tb_teknisi order by nama_teknisi ASC");
			  while ($data_t = mysqli_fetch_array($query_teknisi)) {
			  ?>
              <option <?php if($d_tek['teknisi_id']==$data_t['id']) {echo "selected";} ?> value="<?php echo $data_t['id']; ?>"><?php echo $data_t['nama_teknisi']." - ".$data_t['bidang']; ?></option>
              <?php } ?>
              </select><br />
     <label>Estimasi</label>
     <input id="input" type="date" placeholder="" value="<?php echo $d_tek['estimasi']; ?>" name="estimasi"><br /><br />
     <label>Tgl Berangkat</label>
     <input id="input" type="date" placeholder="" name="tgl_berangkat" value="<?php echo $d_tek['tgl_berangkat_teknisi']; ?>">
        <button id="buttonn" name="simpan_teknisi" type="submit">Simpan</button>
    </form>
    </div>
</div>

<div class="modal fade" id="modal-tambah">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" align="center">Tambah Data</h4>
              </div>
              <form method="post" enctype="multipart/form-data">
              <div class="modal-body">
              <label>Nama Alkes</label>
              <select name="id_brg" id="id_brg" class="form-control" autofocus="autofocus" required onchange="changeValue(this.value)">
        <option value="">...</option>
        <option value="all">SEMUA NYA</option>
        <?php 
		$q = mysqli_query($koneksi, "select *,barang_gudang.id as idd from barang_gudang,barang_gudang_detail,barang_kembali,barang_kembali_detail where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_kembali.id=barang_kembali_detail.barang_kembali_id and barang_gudang_detail.id=barang_kembali_detail.barang_gudang_detail_id and barang_kembali.id=".$data['id']." group by nama_brg order by nama_brg ASC");
		$jsArray = "var dtBrg = new Array();
";
		while ($d = mysqli_fetch_array($q)) { ?>
        <option value="<?php echo $d['idd']; ?>"><?php echo $d['nama_brg']; ?></option>
        <?php 
		$jsArray .= "dtBrg['" . $d['idd'] . "'] = {tgl_kirim:'".addslashes($d['tgl_kirim'])."',
						nama_pembeli:'".addslashes($d['nama_pembeli'])."',
						nama_paket:'".addslashes($d['nama_paket'])."'
						};";
		} ?>
        </select><br />
              <label>No Seri</label>
              <select name="no_seri" id="no_seri" class="form-control select2" style="width:100%">
      <option value="">SEMUA NYA</option>
      <?php 
		$qq = mysqli_query($koneksi, "select *,barang_kembali_detail.id as idd from barang_gudang_detail,barang_gudang,barang_kembali,barang_kembali_detail where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_kembali_detail.barang_gudang_detail_id and barang_kembali.id=barang_kembali_detail.barang_kembali_id and status_kembali_ke_gudang=1 order by no_seri_brg ASC");
		$jsArray = "var dtBrg = new Array();
";
		while ($dd = mysqli_fetch_array($qq)) { ?>
      <option id="no_seri" class="<?php echo $dd['barang_gudang_id']; ?>" value="<?php echo $dd['idd']; ?>"><?php echo $dd['no_seri_brg']." ".$dd['nama_set']; ?></option>
      <?php 
		$jsArray .= "dtBrg['" . $dd['idd'] . "'] = {tgl_kirim:'".addslashes($dd['tgl_kirim'])."',
						nama_pembeli:'".addslashes($dd['nama_pembeli'])."',
						nama_paket:'".addslashes($dd['nama_paket'])."'
						};";
		} ?>
    </select><br /><br />
    <script src="jquery-1.10.2.min.js"></script>
        <script src="jquery.chained.min.js"></script>
        <script>
            $("#no_seri").chained("#id_brg");
        </script>
              <label>Teknisi</label>
              <select name="id_teknisi" id="id_teknisi" class="form-control select2" required style="width:100%">
        <option value="">...</option>
        <?php 
	$q_seri = mysqli_query($koneksi, "select * from tb_teknisi order by nama_teknisi ASC");
	while ($d_seri=mysqli_fetch_array($q_seri)) {
	?>
        <option value="<?php echo $d_seri['id']; ?>">
          <?php echo $d_seri['nama_teknisi']." / Bidang : ".$d_seri['bidang']; ?></option>
        <?php } ?>
        </select>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button name="simpan_tambah_aksesoris" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Simpan</button>
              </div>
              </form>
              <script type="text/javascript">    
	<?php 
	echo $jsArray; 
	?>  
	function changeValue(id_akse){  
		document.getElementById('tgl_kirim').value = dtBrg[id_akse].tgl_kirim; 
		document.getElementById('rs').value = dtBrg[id_akse].nama_pembeli;
		document.getElementById('nama_paket').value = dtBrg[id_akse].nama_paket;
	};  
</script>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>