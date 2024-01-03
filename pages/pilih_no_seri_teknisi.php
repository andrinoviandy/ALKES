<?php 
$da = mysqli_fetch_array(mysqli_query($koneksi, "select *,pembeli.id as idd from pembeli,alamat_provinsi,alamat_kecamatan,alamat_kabupaten,tb_laporan_kerusakan_cs where alamat_provinsi.id=pembeli.provinsi_id and alamat_kabupaten.id=pembeli.kabupaten_id and alamat_kecamatan.id=pembeli.kecamatan_id and pembeli.id=$_GET[id] and pembeli.id=tb_laporan_kerusakan_cs.pembeli_id"));
  
  if (isset($_GET['id_hapus'])) {
	$Result = mysqli_query($koneksi, "delete from tb_laporan_kerusakan_detail where id=".$_GET['id_hapus']."");
	$Result2 = mysqli_query($koneksi, "delete from tb_maintenance_detail where tb_laporan_kerusakan_detail_id=".$_GET['id_hapus']."");
	if ($Result and $Result2)
	{
		echo "<script type='text/javascript'>
		alert('Data Berhasil Di Hapus !');
		window.location='index.php?page=pilih_no_seri_teknisi&id=$_GET[id]&id_laporan=$_GET[id_laporan]';
		</script>";
		}
	}
  
  if (isset($_POST['tambah_laporan'])) {
	$Result = mysqli_query($koneksi, "insert into alat_uji_detail values('','".$_POST['id_akse']."','".$_POST['soft_version']."','".$_POST['tgl_garansi_habis']."','".$_POST['tgl_i']."','".$_POST['lampiran_i']."','".$_POST['tgl_f']."','".$_POST['lampiran_f']."','".$_POST['keterangan']."')");
	if ($Result) {
		mysqli_query($koneksi, "update barang_teknisi_detail set status_uji=1 where id=".$_POST['id_akse']."");
		echo "<script type='text/javascript'>
		alert('Data Berhasil Di Simpan !');
		window.location='index.php?page=simpan_tambah_uji&id=$_GET[id]';
		</script>";
		}
	}
	
if (isset($_POST['tambah'])) {
		if ($da['tgl_lapor']>$_POST['tgl_garansi_habis']) {
			$gr = "Habis";
			}
		else {
			$gr = "Masih";
			}
	$Result = mysqli_query($koneksi, "insert tb_laporan_kerusakan_detail values('','".$_POST['id_lapor']."','".$_POST['id_akse']."','$gr','".$_POST['id_kategori']."','".str_replace("\n","<br>",$_POST['problem'])."','".$_POST['teknisi']."')");
	$max = mysqli_fetch_array(mysqli_query($koneksi, "select max(id) as id_max from tb_laporan_kerusakan_detail"));
	$Result2 = mysqli_query($koneksi, "insert tb_maintenance_detail values('','".$max['id_max']."','0','0')");
	if ($Result and $Result2) {
		echo "<script type='text/javascript'>
		window.location='index.php?page=pilih_no_seri_teknisi&id=$_GET[id]&id_laporan=$_GET[id_laporan]';
		</script>";
		}
	}

$dataa = mysqli_fetch_array(mysqli_query($koneksi, "select * from pembeli where id=".$_SESSION['id_akun'].""));

if (isset($_GET['simpan'])==1) {
	
	$q1 = mysqli_query($koneksi, "select * from tb_laporan_kerusakan_hash where akun_id=".$_SESSION['id']."");
	while ($d1 = mysqli_fetch_array($q1)) {
		$insert2 = mysqli_query($koneksi, "insert into tb_laporan_kerusakan_detail values('','".$d1['tb_laporan_kerusakan_cs_detail_id']."','".$d1['alat_pelatihan_id']."','".$d1['status_garansi']."','".$d1['kategori_job_id']."','".$d1['problem']."','".$d1['teknisi_id']."')");
		}
		
	if ($insert2) {
			mysqli_query($koneksi, "delete from tb_laporan_kerusakan_hash where akun_id=".$_SESSION['id']."");
	echo "<script type='text/javascript'>
	alert('Data Berhasil Di Simpan !');
	window.location='index.php?page=laporan_kerusakan'</script>";
		}
	}


if (isset($_POST['simpan_tambah_aksesoris'])) {
	$no=mysqli_num_rows(mysqli_query($koneksi, "select * from barang_dijual_hash"))+1;
	$simpan = mysqli_query($koneksi, "insert into barang_dijual_hash values('','$no','".$_POST['no_seri']."')");
	if ($simpan) {
		echo "<script>window.location='index.php?page=simpan_jual_alkes2'</script>";
		}
	}
	
//if (isset($_GET['id_hapus'])) {
	//$del = mysqli_query($koneksi, "delete from tb_laporan_kerusakan_hash_hash where id=".$_GET['id_hapus']."");
	//}
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Laporan Kerusakan Alkes</h1><ol class="breadcrumb">
       <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"> Instalasi &amp; Uji Fungsi</li>
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
              <div class="">
              <!--<a href="index.php?page=tambah_barang_masuk"><button name="tambah_laporan" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Tambah Barang</button></a>-->
              
                <table width="100%" id="" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th valign="bottom">Tgl Lapor</th>
      <th valign="bottom">Penelepon</th>
      <th valign="bottom">Kontak Penelepon</th>
      <th valign="bottom">Instansi</th>
      <th valign="bottom"><strong>Keluhan</strong></th>
      <th valign="bottom">Nama Alkes</th>
      </tr>
  </thead>
  <tr>
    <td>
	<?php
    
	echo date("d-m-Y H:i:s A",strtotime($da['tgl_lapor'])); ?></td>
    <td><?php echo $da['nama_penelepon']; ?></td>
    <td><?php echo $da['kontak_penelepon']; ?></td>
    <td><?php echo $da['nama_pembeli']."<hr>".$da['jalan'].", ".$da['kelurahan_id']; ?></td>
    <td><?php echo $da['keluhan']; ?></td>
    <td>
    <table width="100%" border="0" style="line-height:30px;">
        <?php 
	  $q2=mysqli_query($koneksi, "select * from tb_laporan_kerusakan_cs,tb_laporan_kerusakan_cs_detail,barang_gudang,pembeli where pembeli.id=tb_laporan_kerusakan_cs.pembeli_id and tb_laporan_kerusakan_cs.id=tb_laporan_kerusakan_cs_detail.tb_laporan_kerusakan_cs_id and barang_gudang.id=tb_laporan_kerusakan_cs_detail.barang_gudang_id and tb_laporan_kerusakan_cs.id=".$_GET['id_laporan']." and pembeli.id=$_GET[id]");
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
          <td align="left" style="padding-left:10px"><?php echo $n.". ".$d1['nama_brg'] ?></td>
          <td align=""></td>
          <td align="right" style="padding-right:10px"><?php echo $d1['no_seri_brg']." ".$d1['nama_set']; ?>
            </td>
          </tr>
        <?php } ?>
        </table>
    </td>
    </tr>
</table><br />
                <h3 align="center" class="pull pull-left">
                  Tambah Data
                Alkes</h3>
                <!--<font color="#FF0000">* Jika Ingin Menambah Data Aksesoris Yang Baru ! Klik Disini <a href="index.php?page=simpan_tambah_aksesoris&id=<?php //echo $_GET['id']; ?>#openAkse"><small data-toggle="tooltip" title="Tambah Aksesoris Baru" class="label bg-blue">+ New Accessories</small></a></font>-->
                
                <button class="btn btn-success pull pull-right" data-toggle="modal" data-target="#modal-tambah"><span class="fa fa-plus"></span> &nbsp;Pilih No Seri & Teknisi</button>
                <br /><br />
                <table width="100%" id="" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th valign="bottom">No</th>
      <th valign="bottom"><strong>Nama Alkes</strong></th>
      <td align="center" valign="bottom"><strong>No Seri</strong>
      <td align="center" valign="bottom"><strong>No SPI      
      </strong>
      <td align="center" valign="bottom"><strong>No PO      
      </strong>
      <td align="center" valign="bottom"><strong>Garansi Habis</strong>      
      <td align="center" valign="bottom"><strong>Kategori</strong>
      <td align="center" valign="bottom"><strong>Detail Permasalahan</strong>
      <td align="center" valign="bottom"><strong>Teknisi</strong>      
      <td align="center" valign="bottom"><strong>Aksi</strong></tr>
  </thead>
  <form method="post" name="form1" enctype="multipart/form-data">
  </form>
  
  <?php
   
  $no=0;
  $q_akse = mysqli_query($koneksi, "select *,tb_laporan_kerusakan_detail.id as idd from tb_laporan_kerusakan_detail,tb_laporan_kerusakan_cs,tb_laporan_kerusakan_cs_detail where tb_laporan_kerusakan_cs.id=tb_laporan_kerusakan_cs_detail.tb_laporan_kerusakan_cs_id and tb_laporan_kerusakan_cs_detail.id=tb_laporan_kerusakan_detail.tb_laporan_kerusakan_cs_detail_id and tb_laporan_kerusakan_cs.id=".$_GET['id_laporan']." and pembeli_id=".$_GET['id']."");
  $jm = mysqli_num_rows($q_akse);
  if ($jm!=0) { 
  while ($data_akse = mysqli_fetch_array($q_akse)) {
	  $no++;
  ?>
  <tr>
    <td><?php echo $no; ?></td>
    <td><?php 
	$d3 = mysqli_fetch_array(mysqli_query($koneksi, "select * from alat_pelatihan,tb_teknisi,tb_laporan_kerusakan_detail,alat_uji_detail,barang_teknisi_detail,barang_dikirim_detail,barang_gudang,barang_gudang_detail,barang_dijual,barang_dikirim,barang_teknisi where alat_pelatihan.id=tb_laporan_kerusakan_detail.alat_pelatihan_id and tb_teknisi.id=tb_laporan_kerusakan_detail.teknisi_id and alat_uji_detail.id=alat_pelatihan.alat_uji_detail_id and barang_teknisi_detail.id=alat_uji_detail.barang_teknisi_detail_id and barang_dikirim_detail.id=barang_teknisi_detail.barang_dikirim_detail_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_dijual.id=barang_dikirim.barang_dijual_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and barang_teknisi.id=barang_teknisi_detail.barang_teknisi_id and alat_pelatihan.id=".$data_akse['alat_pelatihan_id'].""));
	echo $d3['nama_brg']; ?>
    </td>
    <td align="center"><?php echo $d3['no_seri_brg']." ".$d3['nama_set']; ?></td>
    <td align="center"><?php echo $d3['no_spk']; ?></td>
    <td align="center"><?php echo $d3['no_po_jual']; ?></td>
    <td align="center"><?php 
	if ($_SESSION['tgl_lapor']>$d3['tgl_garansi_habis']) { echo "Habis"; } else { echo "Masih"; }
	?></td>
    <td align="center"><?php 
	$job = mysqli_fetch_array(mysqli_query($koneksi, "select * from kategori_job where id=".$data_akse['kategori_job_id'].""));
	echo $job['nama_job']; ?></td>
    <td><?php echo $data_akse['problem']; ?></td>
    <td align="center"><?php echo $d3['nama_teknisi']; ?></td>
    <td align="center"><a href="index.php?page=pilih_no_seri_teknisi&id=<?php echo $_GET['id'] ?>&id_laporan=<?php echo $_GET['id_laporan'] ?>&id_hapus=<?php echo $data_akse['idd'] ?>" onclick="return confirm('Anda Yakin Akan Menghapus Item Ini ?')"><span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span></a></td>
    </tr>
  <?php }} else {
	  echo "<tr><td colspan='10' align='center'>Tidak Ada Data</td></tr>";
	  } ?>
</table>
<center><a href="index.php?page=laporan_kerusakan_lama&id=<?php echo $_GET['id'] ?>"><button style="padding:10px" name="simpan_barang" class="btn btn-success" type="button"><span class="fa fa-check"></span> Kembali</button></a></center>
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
  
  <div class="modal fade" id="modal-tambah">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" align="center">Tambah Data Alat</h4>
              </div>
              <form method="post">
              <div class="modal-body">
              <p align="justify">
              <label>Nama Alkes</label>
              <select name="id_akse" id="id_akse" class="form-control select2" autofocus="autofocus" required onchange="changeValue(this.value)" style="width:100%">
    	<option value="">...</option>
        <?php 
		$q = mysqli_query($koneksi, "select *,tb_laporan_kerusakan_cs_detail.id as id_lapor,alat_pelatihan.id as idd,pembeli_id as id_rumkit from barang_teknisi,barang_teknisi_detail,barang_teknisi_detail_teknisi, barang_dikirim,barang_dikirim_detail, barang_dijual, barang_gudang, barang_gudang_detail,pembeli, tb_teknisi,alat_uji_detail,alat_pelatihan,tb_laporan_kerusakan_cs_detail where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dijual.id=barang_dikirim.barang_dijual_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and pembeli.id=barang_dijual.pembeli_id and barang_dikirim_detail.id=barang_teknisi_detail.barang_dikirim_detail_id and barang_teknisi.id=barang_teknisi_detail.barang_teknisi_id and barang_teknisi_detail.id=barang_teknisi_detail_teknisi.barang_teknisi_detail_id and tb_teknisi.id=barang_teknisi_detail_teknisi.teknisi_id and barang_teknisi_detail.id=alat_uji_detail.barang_teknisi_detail_id and alat_uji_detail.id=alat_pelatihan.alat_uji_detail_id and barang_gudang.id=tb_laporan_kerusakan_cs_detail.barang_gudang_id and pembeli.id=".$_GET['id']."");
		$jsArray = "var dtBrg = new Array();
";
		while ($d = mysqli_fetch_array($q)) { ?>
        <option value="<?php echo $d['idd']; ?>"><?php echo $d['nama_brg']." / ".$d['no_seri_brg']." ".$d['nama_set']; ?></option>
        <?php 
		$jsArray .= "dtBrg['" . $d['idd'] . "'] = {
						id_lapor:'".addslashes($d['id_lapor'])."',
						no_akse:'".addslashes($d['no_seri_brg']." ".$d['nama_set'])."',
						tgl_garansi_habis:'".addslashes(date("d-m-Y",strtotime($d['tgl_garansi_habis'])))."'
						};";
		} ?>
    </select>
    <br /><br />
    			<input id="id_lapor" name="id_lapor" class="form-control" type="hidden" placeholder="" size="5"/>
                <label>No Seri</label>
                <input id="no_akse" name="no_akse" class="form-control" type="text" placeholder="No Seri" disabled="disabled" size="5"/>
                <br />
                <label>Tanggal Garansi Habis</label>
                <input id="tgl_garansi_habis" name="tgl_garansi_habis" class="form-control" type="text" placeholder="Garansi" readonly="readonly" size="5"/>
                <br />
                <label>Kategori</label>
                <select id="" name="id_kategori" required class="form-control select2" style="width:100%">
      <option value="">--Pilih--</option>
      <?php $query3 = mysqli_query($koneksi, "select * from kategori_job order by id ASC");
			  while ($data=mysqli_fetch_array($query3)) { ?>
      <option value="<?php echo $data['id']; ?>"><?php echo $data['nama_job']; ?></option>
      <?php } ?>
      </select>
      			<br /><br />
                <label>Detail Permasalahan</label>
                <textarea required="required" name="problem" class="form-control" cols="" rows="3"></textarea>
                <br />
                <label>Teknisi</label>
                <select name="teknisi" class="form-control select2" required style="width:100%">
              <option value="">...</option>
              <?php 
			  $query_teknisi = mysqli_query($koneksi, "select * from tb_teknisi order by nama_teknisi ASC");
			  while ($data_t = mysqli_fetch_array($query_teknisi)) {
			  ?>
              <option value="<?php echo $data_t['id']; ?>"><?php echo $data_t['nama_teknisi']." - ".$data_t['bidang']; ?></option>
              <?php } ?>
              </select>
              </p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button name="tambah" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Tambah</button>
              </div>
              </form>
              <script type="text/javascript">    
	<?php 
	echo $jsArray; 
	?>  
	function changeValue(id_akse){  
		//document.getElementById('tipe_akse').value = dtBrg[id_akse].tipe_akse; 
		//document.getElementById('merk_akse').value = dtBrg[id_akse].merk_akse;
		document.getElementById('id_lapor').value = dtBrg[id_akse].id_lapor;
		document.getElementById('no_akse').value = dtBrg[id_akse].no_akse;
		document.getElementById('tgl_garansi_habis').value = dtBrg[id_akse].tgl_garansi_habis;
		
	};  
</script>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
  
<div id="openUji" class="modalDialog">
     <div>
        <a href="#" title="Close" class="close">X</a>
        <h3 align="center">Instalasi &amp; Uji Fungsi</h3>
              <label>Tgl Instalasi</label>
          <input name="tgl_i" class="form-control" type="date" required placeholder="Nama Aksesoris" autofocus><br />
              <label>Lampiran Instalasi</label>
          <input name="lampiran_i" class="form-control" type="file" placeholder="Merk"><br />
              <label>Tgl Uji Fungsi</label>
              <input name="tgl_f" class="form-control" type="date" placeholder="Tipe" required><br />
              <label>Lampiran Uji Fungsi</label>
          <input name="lampiran_f" class="form-control" type="file" placeholder="Nomor Seri" >
              <br />
              Keterangan
              <input name="keterangan" class="form-control" type="text" placeholder="" >
              <br />
              <button name="tambah_laporan" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Simpan</button>
              <br />
             
              
    </div>
</div>

<div id="open_detail" class="modalDialog">
     <div>
        <a href="#" title="Close" class="close">X</a>
        <h3 align="center">Instalasi &amp; Uji Fungsi</h3>
        <?php 
		$sel = mysqli_fetch_array(mysqli_query($koneksi, "select * from alat_uji_detail where barang_teknisi_detail_id=".$_GET['id_detail'].""));
		?>
              <label>Tgl Instalasi</label>
          <input name="tgl_i" class="form-control" type="date" required placeholder="Nama Aksesoris" value="<?php echo $sel['tgl_i'] ?>"><br />
              
              <label>Tgl Uji Fungsi</label>
              <input name="tgl_f" class="form-control" type="date" placeholder="Tipe" value="<?php echo $sel['tgl_f'] ?>"><br />
             
              Keterangan
              <input name="keterangan" class="form-control" type="text" placeholder="" value="<?php echo $sel['keterangan'] ?>">
              <br />
              
              <br />
              </form>
              
    </div>
</div>
