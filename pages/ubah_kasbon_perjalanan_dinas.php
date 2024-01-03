<?php 
if (isset($_POST['simpan_barang'])) {
	
	$simpan1=mysqli_query($koneksi, "insert into kasbon_perjalanan_dinas values('','".$_POST['tgl_kasbon']."','".$_POST['nomor']."','".str_replace(".","",$_POST['nilai'])."')");
	
	$d1=mysqli_fetch_array(mysqli_query($koneksi, "select max(id) as id_max from kasbon_perjalanan_dinas"));
	$id_jual=$d1['id_max'];
	//simpan barang pesan detail
	$q2=mysqli_query($koneksi, "select * from kasbon_perjalanan_dinas_detail_hash where admin_id=".$_SESSION['id']."");
	while ($d2 = mysqli_fetch_array($q2)) {
		$simpan2=mysqli_query($koneksi, "insert into kasbon_perjalanan_dinas_detail values('','$id_jual','".$d2['barang_teknisi_id']."','".$d2['teknisi_id']."','".$d2['estimasi']."','".$d2['tgl_berangkat_teknisi']."','".$d2['deskripsi']."')");
		$up=mysqli_query($koneksi, "update barang_teknisi_detail set status_teknisi=1 where barang_teknisi_id=".$d2['barang_teknisi_id']."");
		$q3 = mysqli_query($koneksi, "select * from barang_teknisi_detail where barang_teknisi_id=".$d2['barang_teknisi_id']." order by id ASC");
		while ($d3 = mysqli_fetch_array($q3)) {
			$simpan3 = mysqli_query($koneksi, "insert into barang_teknisi_detail_teknisi values ('','".$d2['barang_teknisi_id']."','".$d3['id']."','".$d2['teknisi_id']."','".$d2['estimasi']."','".$d2['tgl_berangkat_teknisi']."','".$d2['deskripsi']."')");
			}
		//$up2=mysqli_query($koneksi, "update barang_gudang,barang_gudang_detail set stok_total=stok_total-1 where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=".$d2['barang_gudang_detail_id']."");
		}
		if ($simpan1 and $simpan2 and $simpan3) {
			mysqli_query($koneksi, "delete from kasbon_perjalanan_dinas_detail_hash where admin_id=".$_SESSION['id']."");
	echo "<script type='text/javascript'>
	alert('Data Berhasil Di Simpan !');
	window.location='index.php?page=kasbon_perjalanan_dinas'</script>";
		}
}


if (isset($_POST['simpan_tambah_aksesoris'])) {
	//$no=mysqli_num_rows(mysqli_query($koneksi, "select * from barang_dijual_hash"))+1;
	$simpan = mysqli_query($koneksi, "insert into kasbon_perjalanan_dinas_detail values('','".$_GET['id']."','".$_POST['id_akse']."','".$_POST['id_teknisi']."','".$_POST['estimasi_berangkat']."','".$_POST['tgl_berangkat']."','".$_POST['deskripsi']."')");
	if ($simpan) {
		$q3 = mysqli_query($koneksi, "select * from barang_teknisi_detail where barang_teknisi_id=".$_POST['id_akse']." order by id ASC");
	while ($d3 = mysqli_fetch_array($q3)) {
			$simpan3 = mysqli_query($koneksi, "insert into barang_teknisi_detail_teknisi values ('','".$_POST['id_akse']."','".$d3['id']."','".$_POST['id_teknisi']."','".$_POST['estimasi_berangkat']."','".$_POST['tgl_berangkat']."','".$_POST['deskripsi']."')");
			}
		$update = mysqli_query($koneksi, "update barang_teknisi_detail set status_teknisi=1 where barang_teknisi_id=".$_POST['id_akse']."");
		echo "<script>window.location='index.php?page=ubah_kasbon_perjalanan_dinas&id=$_GET[id]'</script>";
		}	
}

if (isset($_POST['simpan_ubah_aksesoris'])) {
	//$no=mysqli_num_rows(mysqli_query($koneksi, "select * from barang_dijual_hash"))+1;
	$simpan = mysqli_query($koneksi, "update kasbon_perjalanan_dinas_detail set barang_teknisi_id='".$_POST['id_akse']."',teknisi_id='".$_POST['id_teknisi']."',estimasi='".$_POST['estimasi_berangkat']."',tgl_berangkat_teknisi='".$_POST['tgl_berangkat']."',deskripsi='".$_POST['deskripsi']."' where id=".$_POST['idd']."");
	if ($simpan) {
		$cek = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_teknisi_detail where status_uji=0"));
		if ($cek<=0) {
			$simpan3 = mysqli_query($koneksi, "update barang_teknisi_detail_teknisi set teknisi_id='".$_POST['id_teknisi']."',estimasi='".$_POST['estimasi_berangkat']."',tgl_berangkat_teknisi='".$_POST['tgl_berangkat']."',deskripsi='".$_POST['deskripsi']."' where barang_teknisi_id=".$_POST['id_akse']."");
			echo "<script>window.location='index.php?page=ubah_kasbon_perjalanan_dinas&id=$_GET[id]'</script>";
			}
		else {
		$q3 = mysqli_query($koneksi, "select * from barang_teknisi_detail where barang_teknisi_id=".$_POST['id_akse']." order by id ASC");
	while ($d3 = mysqli_fetch_array($q3)) {
			$simpan3 = mysqli_query($koneksi, "insert into barang_teknisi_detail_teknisi values ('','".$_POST['id_akse']."','".$d3['id']."','".$_POST['id_teknisi']."','".$_POST['estimasi_berangkat']."','".$_POST['tgl_berangkat']."','".$_POST['deskripsi']."')");
			}
		$update = mysqli_query($koneksi, "update barang_teknisi_detail set status_teknisi=1 where barang_teknisi_id=".$_POST['id_akse']."");
		echo "<script>window.location='index.php?page=ubah_kasbon_perjalanan_dinas&id=$_GET[id]'</script>";
		}
		
		}
}

if (isset($_POST['simpan_tambah_aksesoris2'])) {
	//$no=mysqli_num_rows(mysqli_query($koneksi, "select * from barang_dijual_hash"))+1;
	$cek = mysqli_fetch_array(mysqli_query($koneksi, "select * from barang_teknisi_detail_teknisi where barang_teknisi_id=".$_POST['id_akse']." group by teknisi_id"));
	$simpan = mysqli_query($koneksi, "insert into kasbon_perjalanan_dinas_detail values('','".$_GET['id']."','".$_POST['id_akse']."','".$cek['teknisi_id']."','".$cek['estimasi']."','".$cek['tgl_berangkat_teknisi']."','".$cek['deskripsi']."')");
	if ($simpan) {
		
		echo "<script>window.location='index.php?page=ubah_kasbon_perjalanan_dinas&id=$_GET[id]'</script>";
		}
	
}
	
if (isset($_GET['id_hapus'])) {
	$del0 = mysqli_query($koneksi, "delete from barang_teknisi_detail_teknisi where id=".$_GET['id_brg_teknisi']."");
	$update = mysqli_query($koneksi, "update barang_teknisi_detail set status_teknisi=0 where id=".$_GET['id_brg_teknisi']."");
	$del1 = mysqli_query($koneksi, "delete from kasbon_perjalanan_dinas_detail where id=".$_GET['id_hapus']."");
	}
	
if (isset($_GET['id_hapus2'])) {
	$del1 = mysqli_query($koneksi, "delete from kasbon_perjalanan_dinas_detail where id=".$_GET['id_hapus2']."");
	}

if (isset($_POST['go_no_seri'])) {
	$cek= mysqli_num_rows(mysqli_query($koneksi, "select *,barang_dikirim_detail.id as idd from barang_dikirim_detail, barang_dikirim,barang_gudang,barang_gudang_detail where barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dikirim_detail.status_spi=0 and barang_dikirim.id=".$_POST['id_akse'].""));
	if ($cek!=0) {
	echo "<script>
alert('Selanjutnya Silakan Tekan (Pilih No Seri) !');	window.location='index.php?page=tambah_spk_masuk2&id_gudang=$_POST[id_akse]';
	</script>";
	}
	else {
	echo "<script>
alert('Data Sudah Ada !);	window.location='index.php?page=tambah_spk_masuk2';
	</script>";
	}
} 

?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Ubah Data Kasbon (Perjalanan Dinas)</h1><ol class="breadcrumb">
       <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"> Tambah Data</li>
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
              
              <div class="table-responsive">
              <table width="100%" id="" class="table table-bordered table-hover">
  <thead>
    <tr>
      
        
        <th valign="top" bgcolor="#CCCCCC">Tanggal Kasbon</th>
        <th valign="top" bgcolor="#CCCCCC">No Kasbon</th>
        <th valign="top" bgcolor="#CCCCCC">Nilai Kasbon</th>
        
          </tr>
  </thead>
  <?php
  $data = mysqli_fetch_array(mysqli_query($koneksi, "select * from kasbon_perjalanan_dinas where id=".$_GET['id'].""));
  ?>
  <tr>
  
    
    <td><?php echo date("d/M/Y", strtotime($data['tgl_kasbon'])); ?>
    </td>
    <td><?php 
	echo $data['no_kasbon']; ?></td>
    <td><?php 
	echo number_format($data['nilai_kasbon'],0,',','.'); ?></td>
    
  </tr>
  
</table>
              </div>
              <button name="tambah_laporan" class="btn btn-success pull pull-right" type="button" data-toggle="modal" data-target="#modal-pilihnoseri2"><span class="fa fa-plus"></span> Tambah SPI Dengan Data Teknisi Sebelumnya</button>
<button name="tambah_laporan" class="btn btn-success pull pull-right" type="button" data-toggle="modal" data-target="#modal-pilihnoseri" style="margin-right:20px"><span class="fa fa-plus"></span> Tambah SPI</button><br /><br /><br />
                <div class="table-responsive">
                <table width="100%" id="example1" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th align="center" valign="bottom">No</th>
      <th valign="bottom">Tanggal SPI </th>
      <th valign="bottom">No. SPI</th>
      <th valign="bottom"><strong>No PO </strong></th>
      <td align="center" valign="bottom"><strong>No Pengiriman</strong>      
      <td align="center" valign="bottom"><strong>Lokasi Instalasi</strong>      
      <td align="center" valign="bottom"><strong>Sales</strong>
      <td align="center" valign="bottom"><strong>Nama Teknisi </strong>
      <td align="center" valign="bottom"><strong>Estimasi Keberangkatan</strong>
      <td align="center" valign="bottom"><strong>Tanggal Berangkat </strong>
      <td align="center" valign="bottom"><strong>Deskripsi</strong>
      <td align="center" valign="bottom"><strong>Aksi</strong></tr>
  </thead>
  <?php
   
  $no=0;
  $q_akse = mysqli_query($koneksi, "select *,kasbon_perjalanan_dinas_detail.id as idd from kasbon_perjalanan_dinas_detail,barang_teknisi,barang_teknisi_detail,barang_dikirim_detail,barang_dikirim,barang_dijual,tb_teknisi,pembeli where barang_teknisi.id=kasbon_perjalanan_dinas_detail.barang_teknisi_id and barang_teknisi.id=barang_teknisi_detail.barang_teknisi_id and barang_dikirim_detail.id=barang_teknisi_detail.barang_dikirim_detail_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and barang_dijual.id=barang_dikirim.barang_dijual_id and tb_teknisi.id=kasbon_perjalanan_dinas_detail.teknisi_id and pembeli.id=barang_dijual.pembeli_id and kasbon_perjalanan_dinas_id=".$_GET['id']." group by kasbon_perjalanan_dinas_detail.id order by kasbon_perjalanan_dinas_detail.id ASC");
  $jm = mysqli_num_rows($q_akse);
  if ($jm!=0) { 
  while ($data_akse = mysqli_fetch_array($q_akse)) {
	  $no++;
  ?>
  <tr>
    <td align="center"><?php echo $no; ?></td>
    <td align="left"><?php echo date("d-m-Y",strtotime($data_akse['tgl_spk'])); ?></td>
    <td align="left"><?php echo $data_akse['no_spk']; ?></td>
    <td align="left"><?php echo $data_akse['no_po_jual']; ?>
    </td>
    <td align="left"><?php echo $data_akse['no_pengiriman']; ?></td>
    <td align="left"><?php echo $data_akse['nama_pembeli']; ?></td>
    <td align="left"><?php echo $data_akse['marketing']; ?></td>
    <td align="left"><?php echo $data_akse['nama_teknisi']; ?></td>
    <td align="left"><?php if ($data_akse['estimasi']!='0000-00-00') {echo date("d-m-Y",strtotime($data_akse['estimasi']));} ?></td>
    <td align="left"><?php if ($data_akse['tgl_berangkat_teknisi']!='0000-00-00') {echo date("d-m-Y",strtotime($data_akse['tgl_berangkat_teknisi']));} ?></td>
    <td align="left"><?php echo $data_akse['deskripsi']; ?></td>
    <td align="center"><?php if ($jm>1) { ?><a data-toggle="modal" data-target="#modal-hapus<?php echo $data_akse['idd']; ?>"><span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span></a><?php } ?>&nbsp;&nbsp;
    <a data-toggle="modal" data-target="#modal-ubah<?php echo $data_akse['idd']; ?>"><span data-toggle="tooltip" title="Ubah" class="fa fa-edit"></span></a>
    </td>
    </tr>
    <div class="modal fade" id="modal-ubah<?php echo $data_akse['idd']; ?>">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
              
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" align="center">Ubah Data</h4>
              </div>
              <form method="post" enctype="multipart/form-data">
              <div class="modal-body">
              <input type="hidden" name="idd" value="<?php echo $data_akse['idd'] ?>" />
              <label>No. SPI / No. PO / No. Pengiriman</label>
              <span class="form-group">
              <select name="id_akse" id="id_akse" class="form-control select2" autofocus="autofocus" required="required" onchange="changeValue(this.value)" style="width:100%">
                <option>...</option>
                <?php 
		$q = mysqli_query($koneksi, "select *,barang_teknisi.id as idd from barang_dikirim,barang_dijual,pembeli,barang_dikirim_detail,barang_teknisi_detail,barang_teknisi where barang_dijual.id=barang_dikirim.barang_dijual_id and pembeli.id=barang_dijual.pembeli_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and barang_dikirim_detail.id=barang_teknisi_detail.barang_dikirim_detail_id and barang_teknisi.id=barang_teknisi_detail.barang_teknisi_id group by barang_teknisi.id order by barang_teknisi.no_spk ASC");
		$jsArray = "var dtBrg = new Array();
";
		while ($d = mysqli_fetch_array($q)) { ?>
                <option <?php if ($data_akse['barang_teknisi_id']==$d['idd']) {echo "selected";} ?> value="<?php echo $d['idd']; ?>"><?php echo "No. SPI : ".$d['no_spk']." / No. PO : ".$d['no_po_jual']." / No. Pengiriman : ".$d['no_pengiriman']; ?></option>
                <?php 
		$jsArray .= "dtBrg['" . $d['idd'] . "'] = {tgl_spi:'".addslashes(date("d-m-Y", strtotime($d['tgl_spk'])))."',
						nama_pembeli:'".addslashes($d['nama_pembeli'])."',
						marketing:'".addslashes($d['marketing'])."'
						};";
		} ?>
              </select>
              </span><br /><br />
                <label>Nama Teknisi</label>
                <select name="id_teknisi" id="id_teknisi" class="form-control select2" required style="width:100%">
        <option value="">...</option>
        <?php 
	$q_seri = mysqli_query($koneksi, "select * from tb_teknisi order by nama_teknisi ASC");
	while ($d_seri=mysqli_fetch_array($q_seri)) {
	?>
        <option <?php if ($d_seri['id']==$data_akse['teknisi_id']) {echo "selected";} ?> value="<?php echo $d_seri['id']; ?>">
          <?php echo $d_seri['nama_teknisi']." / Bidang : ".$d_seri['bidang']; ?></option>
        <?php } ?>
        </select>
                <br />
                <br />
                <label>Estimasi Berangkat</label>
                <input id="estimasi_berangkat" name="estimasi_berangkat" class="form-control" type="date" placeholder="" size="5" value="<?php echo $data_akse['estimasi'] ?>"/>
                <br />
                <label>Tanggal Berangkat</label>
                <input id="tgl_berangkat" name="tgl_berangkat" class="form-control" type="date" placeholder="" size="5" value="<?php echo $data_akse['tgl_berangkat_teknisi'] ?>"/>
                <br />
                <label>Deskripsi</label>
                <textarea class="form-control" rows="5" name="deskripsi"><?php echo $data_akse['deskripsi'] ?></textarea>
              </div>
              <div class="modal-footer">
                
                <button type="submit" class="btn btn-success" name="simpan_ubah_aksesoris">Simpan</button>
              </div>
              </form>
              
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
    
    <div class="modal fade" id="modal-hapus<?php echo $data_akse['idd']; ?>">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Hapus Data</h4>
              </div>
              <div class="modal-body" align="center">
                  <a href="index.php?page=ubah_kasbon_perjalanan_dinas&id_hapus=<?php echo $data_akse['idd']; ?>&id=<?php echo $_GET['id']; ?>&id_brg_teknisi=<?php echo $data_akse['barang_teknisi_id']; ?>"><button data-toggle="tooltip" title="Hapus" class="btn btn-danger">Hapus (Juga akan menghapus data teknisi di instalasi)</button></a>
                  <br /><br />
                  <a href="index.php?page=ubah_kasbon_perjalanan_dinas&id_hapus2=<?php echo $data_akse['idd']; ?>&id=<?php echo $_GET['id']; ?>&id_brg_teknisi=<?php echo $data_akse['barang_teknisi_id']; ?>"><button data-toggle="tooltip" title="Hapus" class="btn btn-info">Hapus (Tidak akan menghapus data teknisi di instalasi)</button></a>
              </div>
              <div class="modal-footer" align="center">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
              </div>
              
            </div>
            <!-- /.modal-content -->
  </div>
          <!-- /.modal-dialog -->
</div>
  <?php }} else {
	  echo "<tr><td colspan='11' align='center'>Tidak Ada Data</td></tr>";
	  } ?>
</table>
                </div>
<center><a href="index.php?page=kasbon_perjalanan_dinas"><button name="batal" class="btn btn-success" type="submit"><span class="fa  fa-times-circle"></span> Kembali</button></a></center>
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
  
<div class="modal fade" id="modal-pilihnoseri2">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
              
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" align="center">Tambah Data Dengan Data Teknisi Sebelumnya</h4>
              </div>
              <form method="post" enctype="multipart/form-data">
              <div class="modal-body">
              <label>No. SPI / No. PO / No. Pengiriman</label>
              <span class="form-group">
              <select name="id_akse" id="id_akse2" class="form-control select2" autofocus="autofocus" required="required" onchange="changeValuett(this.value)" style="width:100%">
                <option>...</option>
                <?php 
		$qtt = mysqli_query($koneksi, "select *,barang_teknisi.id as idd from barang_dikirim,barang_dijual,pembeli,barang_dikirim_detail,barang_teknisi_detail,barang_teknisi where barang_dijual.id=barang_dikirim.barang_dijual_id and pembeli.id=barang_dijual.pembeli_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and barang_dikirim_detail.id=barang_teknisi_detail.barang_dikirim_detail_id and barang_teknisi.id=barang_teknisi_detail.barang_teknisi_id and status_teknisi=1 group by barang_teknisi.id order by barang_teknisi.no_spk ASC");
		$jsArraytt = "var dtBrgtt = new Array();
";
		while ($d = mysqli_fetch_array($qtt)) { ?>
                <option value="<?php echo $d['idd']; ?>"><?php echo "No. SPI : ".$d['no_spk']." / No. PO : ".$d['no_po_jual']." / No. Pengiriman : ".$d['no_pengiriman']; ?></option>
                <?php 
		$jsArraytt .= "dtBrgtt['" . $d['idd'] . "'] = {tgl_spi2:'".addslashes(date("d-m-Y", strtotime($d['tgl_spk'])))."',
						nama_pembeli2:'".addslashes($d['nama_pembeli'])."',
						marketing2:'".addslashes($d['marketing'])."'
						};";
		} ?>
              </select>
              </span><br /><br />
                <label>Tanggal SPI</label>
                <input id="tgl_sampai2" name="tgl_sampai2" class="form-control" type="text" placeholder="Tgl Sampai" disabled="disabled" size="5"/>
                <br />
                <label>Lokasi Instalasi</label>
                <input id="rs2" name="rs2" class="form-control" type="text"  placeholder="RS/Dinas/Dll" disabled="disabled"/>
                <br />
                <label>Marketing</label>
                <input id="marketing2" name="marketing2" class="form-control" type="text" placeholder="Marketing" disabled="disabled" />
                
              </div>
              <div class="modal-footer">
                
                <button type="submit" class="btn btn-success" name="simpan_tambah_aksesoris2">Simpan</button>
              </div>
              </form>
              <script type="text/javascript">    
	<?php 
	echo $jsArraytt; 
	?>  
	function changeValuett(id_akse2){  
		document.getElementById('tgl_sampai2').value = dtBrgtt[id_akse2].tgl_spi2; 
		document.getElementById('rs2').value = dtBrgtt[id_akse2].nama_pembeli2;
		document.getElementById('marketing2').value = dtBrgtt[id_akse2].marketing2;
	};  
</script>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
<div class="modal fade" id="modal-pilihnoseri">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
              
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" align="center">Tambah Data</h4>
              </div>
              <form method="post" enctype="multipart/form-data">
              <div class="modal-body">
              <label>No. SPI / No. PO / No. Pengiriman</label>
              <span class="form-group">
              <select name="id_akse" id="id_akse" class="form-control select2" autofocus="autofocus" required="required" onchange="changeValue(this.value)" style="width:100%">
                <option>...</option>
                <?php 
		$q = mysqli_query($koneksi, "select *,barang_teknisi.id as idd from barang_dikirim,barang_dijual,pembeli,barang_dikirim_detail,barang_teknisi_detail,barang_teknisi where barang_dijual.id=barang_dikirim.barang_dijual_id and pembeli.id=barang_dijual.pembeli_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and barang_dikirim_detail.id=barang_teknisi_detail.barang_dikirim_detail_id and barang_teknisi.id=barang_teknisi_detail.barang_teknisi_id and status_teknisi=0 group by barang_teknisi.id order by barang_teknisi.no_spk ASC");
		$jsArray = "var dtBrg = new Array();
";
		while ($d = mysqli_fetch_array($q)) { ?>
                <option value="<?php echo $d['idd']; ?>"><?php echo "No. SPI : ".$d['no_spk']." / No. PO : ".$d['no_po_jual']." / No. Pengiriman : ".$d['no_pengiriman']; ?></option>
                <?php 
		$jsArray .= "dtBrg['" . $d['idd'] . "'] = {tgl_spi:'".addslashes(date("d-m-Y", strtotime($d['tgl_spk'])))."',
						nama_pembeli:'".addslashes($d['nama_pembeli'])."',
						marketing:'".addslashes($d['marketing'])."'
						};";
		} ?>
              </select>
              </span><br /><br />
                <label>Tanggal SPI</label>
                <input id="tgl_sampai" name="tgl_sampai" class="form-control" type="text" placeholder="Tgl Sampai" disabled="disabled" size="5"/>
                <br />
                <label>Lokasi Instalasi</label>
                <input id="rs" name="rs" class="form-control" type="text"  placeholder="RS/Dinas/Dll" disabled="disabled"/>
                <br />
                <label>Marketing</label>
                <input id="marketing" name="marketing" class="form-control" type="text" placeholder="Marketing" disabled="disabled" />
                <br />
                <label>Nama Teknisi</label>
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
                <br />
                <br />
                <label>Estimasi Berangkat</label>
                <input id="estimasi_berangkat" name="estimasi_berangkat" class="form-control" type="date" placeholder="" size="5"/>
                <br />
                <label>Tanggal Berangkat</label>
                <input id="tgl_berangkat" name="tgl_berangkat" class="form-control" type="date" placeholder="" size="5"/>
                <br />
                <label>Deskripsi</label>
                <input id="deskripsi" name="deskripsi" class="form-control" type="text" size="5"/>
              </div>
              <div class="modal-footer">
                
                <button type="submit" class="btn btn-success" name="simpan_tambah_aksesoris">Simpan</button>
              </div>
              </form>
              <script type="text/javascript">    
	<?php 
	echo $jsArray; 
	?>  
	function changeValue(id_akse){  
		document.getElementById('tgl_sampai').value = dtBrg[id_akse].tgl_spi; 
		document.getElementById('rs').value = dtBrg[id_akse].nama_pembeli;
		document.getElementById('marketing').value = dtBrg[id_akse].marketing;
	};  
</script>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        
        <div class="modal fade" id="modal-tambah">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Data</h4>
              </div>
              <form method="post" enctype="multipart/form-data">
              <div class="modal-body">
                <label>Tanggal Kasbon</label>
                <input type="date" class="form-control" name="tgl_kasbon" placeholder=""/><br />
                <label>Nomor Kasbon</label>
                <input type="text" class="form-control" name="nomor" placeholder=""/><br />
                <label>Nilai Kasbon</label>
                <input type="text" class="form-control" name="nilai" placeholder="" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);"/>       
              </div>
              <div class="modal-footer">
                
                <button type="submit" class="btn btn-success" name="simpan_barang"><span class="fa fa-check"></span> Simpan</button>
              </div>
              </form>
            </div>
            <!-- /.modal-content -->
  </div>
          <!-- /.modal-dialog -->
</div>


        
        
