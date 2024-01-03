<?php 
if (isset($_GET['simpan_barang'])==1) {
	$cek = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_teknisi_hash where akun_id=".$_SESSION['id'].""));
	if ($cek!=0) {
	//$insert_pembeli=mysqli_query($koneksi, "insert into pembeli values('','".$_SESSION['pembeli']."','".$_SESSION['provinsi']."','".$_SESSION['kabupaten']."','".$_SESSION['kecamatan']."','".$_SESSION['kelurahan']."','".$_SESSION['alamat']."','".$_SESSION['kontak_rs']."')");
	
	//$insert_pemakai=mysqli_query($koneksi, "insert into pemakai values('','".$_SESSION['pemakai']."','".$_SESSION['kontak1']."','".$_SESSION['kontak2']."','".$_SESSION['email']."')");
	
	//$pembeli=mysqli_fetch_array(mysqli_query($koneksi, "select max(id) as id_pembeli from pembeli"));
	/*$id_pembeli=$_SESSION['pembeli'];
	$pemakai=mysqli_fetch_array(mysqli_query($koneksi, "select max(id) as id_pemakai from pemakai"));
	$id_pemakai=$pemakai['id_pemakai'];
	//simpan barang dijual
	$total = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_dijual_hash where akun_id=".$_SESSION['id'].""));
	*/
	$simpan1=mysqli_query($koneksi, "insert into barang_teknisi values('','".$_SESSION['tgl_spi']."','".$_SESSION['no_spi']."','".$_SESSION['keterangan']."')");
	
	$d1=mysqli_fetch_array(mysqli_query($koneksi, "select max(id) as id_max from barang_teknisi"));
	$id_jual=$d1['id_max'];
	//simpan barang pesan detail
	$q2=mysqli_query($koneksi, "select * from barang_teknisi_hash where akun_id=".$_SESSION['id']."");
	while ($d2 = mysqli_fetch_array($q2)) {
		$simpan2=mysqli_query($koneksi, "insert into barang_teknisi_detail values('','$id_jual','".$d2['barang_dikirim_detail_id']."','0','0')");
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
	$cek = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_teknisi_hash where akun_id=".$_SESSION['id'].""));
	if ($cek==0) {
	if ($_POST['no_seri']=='') {
		$que = mysqli_query($koneksi, "select * from barang_dikirim_detail where barang_dikirim_id=".$_GET['id_gudang']."");
		while ($data_que = mysqli_fetch_array($que)) {
			$simpan = mysqli_query($koneksi, "insert into barang_teknisi_hash values('','".$_SESSION['id']."','".$data_que['id']."','0')");
			}
			if ($simpan) {
		echo "<script>window.location='index.php?page=tambah_spk_masuk2'</script>";
		}
		}
	else {
	$simpan = mysqli_query($koneksi, "insert into barang_teknisi_hash values('','".$_SESSION['id']."','".$_POST['no_seri']."','0')");
	if ($simpan) {
		echo "<script>window.location='index.php?page=tambah_spk_masuk2'</script>";
			}
		}
	} 
	else {
		$data2 = mysqli_fetch_array(mysqli_query($koneksi, "select * from barang_teknisi_hash where akun_id=".$_SESSION['id'].""));
		$cek2 = mysqli_fetch_array(mysqli_query($koneksi, "select * from barang_dikirim,barang_dikirim_detail where barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and barang_dikirim_detail.id=".$data2['barang_dikirim_detail_id'].""));
		//$cek2['po_no'];
		$cek3 = mysqli_fetch_array(mysqli_query($koneksi, "select * from barang_dikirim where id=".$_GET['id_gudang'].""));
		if ($cek2['po_no']==$cek3['po_no']) {
			//batas
			if ($_POST['no_seri']=='') {
		$que = mysqli_query($koneksi, "select * from barang_dikirim_detail where barang_dikirim_id=".$_GET['id_gudang']."");
		while ($data_que = mysqli_fetch_array($que)) {
			$simpan = mysqli_query($koneksi, "insert into barang_teknisi_hash values('','".$_SESSION['id']."','".$data_que['id']."','0')");
			}
			if ($simpan) {
		echo "<script>window.location='index.php?page=tambah_spk_masuk2'</script>";
		}
		}
	else {
	$simpan = mysqli_query($koneksi, "insert into barang_teknisi_hash values('','".$_SESSION['id']."','".$_POST['no_seri']."','0')");
	if ($simpan) {
		echo "<script>window.location='index.php?page=tambah_spk_masuk2'</script>";
			}
		}
		//batas
			}
		else {
			echo "<script>alert('Maaf NO PO tidak sama , Gunakan No PO yang sama , karena satu tempat RS/Dinas/Dll hanya bisa 1 SPI');</script>";
			}
		}
}
	
if (isset($_GET['id_hapus'])) {
	$del = mysqli_query($koneksi, "delete from barang_teknisi_hash where id=".$_GET['id_hapus']."");
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
	alert('Data Sudah Ada !);
	window.location='index.php?page=tambah_spk_masuk2';
	</script>";
	}
} 

?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Tambah SPI</h1><ol class="breadcrumb">
       <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"> Tambah SPI</li>
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
              <table width="100%" id="" class="table table-bordered">
  <thead>
    <tr height="">
      <th width="11%" valign="bottom"><strong>Tgl SPI</strong></th>
      <th width="23%" valign="bottom">No SPI</th>
      <th width="66%" valign="bottom">Deskripsi</th>
      </tr>
  </thead>
  <tr>
    <td><?php echo date("d F Y",strtotime($_SESSION['tgl_spi'])); ?>
    </td>
    <td><?php echo $_SESSION['no_spi']; ?></td>
    <td><?php echo $_SESSION['keterangan']; ?></td>
    </tr>
</table>
              </div>
                <br />

<?php if (isset($_GET['id_gudang'])) { ?>
<button name="tambah_laporan2" class="btn btn-success" type="button" data-toggle="modal" data-target="#modal-pilihnoseri2"><span class="fa fa-plus"></span> Pilih No Seri </button>
&nbsp;&nbsp;
<button name="tambah_laporan" class="btn btn-success" type="button" data-toggle="modal" data-target="#modal-pilihnoseri"><span class="fa fa-plus"></span> Ulangi Dengan No. PO dan No. Pengiriman Yang Lain</button>
<?php } else { ?>
<button name="tambah_laporan" class="btn btn-success" type="button" data-toggle="modal" data-target="#modal-pilihnoseri"><span class="fa fa-plus"></span> Tambah </button>
<?php } ?>
<font color="#FF0000" class="pull pull-right" size="+2">* Gunakan No PO Yang Sama Jika Data Lebih Dari Satu</font><br /><br />
                <div class="table-responsive">
                <table width="100%" id="example1" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th align="center" valign="bottom">No</th>
      <th valign="bottom"><strong>No PO / No Pengiriman</strong></th>
      <td align="center" valign="bottom"><strong>Tgl_Sampai</strong>
      <td align="center" valign="bottom"><strong>RS/Dinas/Dll      
      </strong>
      <td align="center" valign="bottom"><strong>Nama Paket      
      </strong>
      <td align="center" valign="bottom"><strong> Alkes
      / No Seri</strong>
      <td align="center" valign="bottom"><strong>Aksi</strong></tr>
  </thead>
  <?php
   
  $no=0;
  $q_akse = mysqli_query($koneksi, "select *,barang_teknisi_hash.id as idd from barang_teknisi_hash,barang_dikirim_detail,barang_dikirim,barang_dijual,pembeli,barang_gudang_detail,barang_gudang where barang_dikirim_detail.id=barang_teknisi_hash.barang_dikirim_detail_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and barang_dijual.id=barang_dikirim.barang_dijual_id and pembeli.id=barang_dijual.pembeli_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_gudang.id=barang_gudang_detail.barang_gudang_id and akun_id=".$_SESSION['id']."");
  $jm = mysqli_num_rows($q_akse);
  if ($jm!=0) { 
  while ($data_akse = mysqli_fetch_array($q_akse)) {
	  $no++;
  ?>
  <tr>
    <td align="center"><?php echo $no; ?></td>
    <td align="left"><?php echo $data_akse['no_po_jual']." / ".$data_akse['no_pengiriman']; ?>
    </td>
    <td align="left"><?php echo date("d-m-Y",strtotime($data_akse['tgl_kirim'])); ?></td>
    <td align="left"><?php echo $data_akse['nama_pembeli']; ?></td>
    <td align="left"><?php echo $data_akse['nama_paket']; ?></td>
    <td align="left"><?php echo $data_akse['nama_brg']." / ".$data_akse['no_seri_brg']." ".$data_akse['nama_set']; ?></td>
    <td align="center"><a href="index.php?page=tambah_spk_masuk2&id_hapus=<?php echo $data_akse['idd']; ?>" onclick="return confirm('Yakin Akan Menghapus Item Ini ?')"><span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span></a></td>
    </tr>
  <?php }} else {
	  echo "<tr><td colspan='7' align='center'>Tidak Ada Data</td></tr>";
	  } ?>
</table>
                </div>
<center><a href="index.php?page=tambah_spk_masuk2&simpan_barang=1"><button name="simpan_barang" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Simpan</button></a>&nbsp;&nbsp;<a href="index.php?page=spi"><button name="batal" class="btn btn-success" type="submit"><span class="fa  fa-times-circle"></span> Batal</button></a></center>
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
  

<div class="modal fade" id="modal-pilihnoseri">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
              
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" align="center">Tambah SPI</h4>
              </div>
              <form method="post" enctype="multipart/form-data">
              <div class="modal-body">
              <label>No. PO / No. Surat Jalan <font color="#FF0000">(*Akan Muncul Jika Tanggal Sampai Di Menu Data Pengiriman Alkes Sudah Ada)</font></label>
              <span class="form-group">
              <select name="id_akse" id="id_akse" class="form-control select2" autofocus="autofocus" required="required" onchange="changeValue(this.value)" style="width:100%">
                <option>...</option>
                <?php 
		$q = mysqli_query($koneksi, "select *,barang_dikirim.id as idd from barang_dikirim,barang_dijual,pembeli,barang_dikirim_detail where barang_dijual.id=barang_dikirim.barang_dijual_id and pembeli.id=barang_dijual.pembeli_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and tgl_sampai!='0000-00-00' and status_spi=0 group by barang_dikirim.id order by barang_dikirim.no_pengiriman ASC");
		$jsArray = "var dtBrg = new Array();
";
		while ($d = mysqli_fetch_array($q)) { ?>
                <option value="<?php echo $d['idd']; ?>"><?php echo "No. PO : ".$d['no_po_jual']." / No. Surat Jalan : ".$d['no_pengiriman']; ?></option>
                <?php 
		$jsArray .= "dtBrg['" . $d['idd'] . "'] = {tgl_sampai:'".addslashes(date("d-m-Y", strtotime($d['tgl_sampai'])))."',
						nama_pembeli:'".addslashes($d['nama_pembeli'])."',
						nama_paket:'".addslashes($d['nama_paket'])."'
						};";
		} ?>
              </select>
              </span><br /><br />
                <label>Tanggal Sampai</label>
                <input id="tgl_sampai" name="tgl_sampai" class="form-control" type="text" placeholder="Tgl Sampai" disabled="disabled" size="5"/>
                <br />
                <label>RS/Dinas/Klinik/Dll</label>
                <input id="rs" name="rs" class="form-control" type="text"  placeholder="RS/Dinas/Dll" disabled="disabled"/>
                <br />
                <label>Nama Paket</label>
                <input id="nama_paket" name="nama_paket" class="form-control" type="text" placeholder="Nama Paket" disabled="disabled" />
                <br />
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success" name="go_no_seri">Next</button>
              </div>
              </form>
              <script type="text/javascript">    
	<?php 
	echo $jsArray; 
	?>  
	function changeValue(id_akse){  
		document.getElementById('tgl_sampai').value = dtBrg[id_akse].tgl_sampai; 
		document.getElementById('rs').value = dtBrg[id_akse].nama_pembeli;
		document.getElementById('nama_paket').value = dtBrg[id_akse].nama_paket;
	};  
</script>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        
        <div class="modal fade" id="modal-pilihnoseri2">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
              
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" align="center">Pilih Barang</h4>
              </div>
              <form method="post" enctype="multipart/form-data">
              <div class="modal-body">
                <label>Pilih Alkes / No Seri</label>
                <select name="no_seri" id="no_seri" class="form-control select2" style="width:100%">
    <option value="">--Semua nya--</option>
    <?php 
	$q_seri = mysqli_query($koneksi, "select *,barang_dikirim_detail.id as idd from barang_dikirim_detail, barang_dikirim,barang_gudang,barang_gudang_detail where barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dikirim_detail.status_spi=0 and barang_dikirim.id=".$_GET['id_gudang']."");
	while ($d_seri=mysqli_fetch_array($q_seri)) {
	?>
    <option id="id_kirim_detail" value="<?php echo $d_seri['idd']; ?>">
	<?php echo $d_seri['nama_brg']." / ".$d_seri['no_seri_brg']; ?></option>
    <?php } ?>
    </select>
    
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
        </div>
