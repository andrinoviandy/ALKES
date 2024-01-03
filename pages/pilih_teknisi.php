<?php
$data=mysqli_fetch_array(mysqli_query($koneksi, "select * from barang_teknisi where id=".$_GET['id']."")); 

if (isset($_POST['simpan_teknisi'])) {
	$sim = mysqli_query($koneksi, "update barang_teknisi,barang_teknisi_detail,barang_teknisi_detail_teknisi,barang_dikirim,barang_dikirim_detail,pembeli,barang_dijual,barang_gudang,barang_gudang_detail,tb_teknisi set estimasi='".$_POST['estimasi']."', tgl_berangkat_teknisi='".$_POST['tgl_berangkat']."',deskripsi='".$_POST['deskripsi']."' where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dijual.id=barang_dikirim.barang_dijual_id and pembeli.id=barang_dijual.pembeli_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and barang_dikirim_detail.id=barang_teknisi_detail.barang_dikirim_detail_id and barang_teknisi.id=barang_teknisi_detail.barang_teknisi_id and barang_teknisi_detail.id=barang_teknisi_detail_teknisi.barang_teknisi_detail_id and tb_teknisi.id=barang_teknisi_detail_teknisi.teknisi_id and barang_teknisi.id=".$_POST['id_ubah']." and barang_gudang.id=".$_POST['id_gudang']."");
	if ($sim){
		echo "<script>window.location='index.php?page=pilih_teknisi&id=$_POST[id_ubah]'</script>";
		}
	}

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
		$que = mysqli_query($koneksi, "select * from barang_teknisi_detail where barang_teknisi_id=".$_GET['id']."");
		while ($data_que = mysqli_fetch_array($que)) {
			$simpan = mysqli_query($koneksi, "insert into barang_teknisi_detail_teknisi values('','".$_GET['id']."','".$data_que['id']."','".$_POST['id_teknisi']."','".$_POST['estimasi']."','".$_POST['tgl_berangkat']."','".$_POST['deskripsi']."')");
			mysqli_query($koneksi, "update barang_teknisi_detail set status_teknisi=1 where id=".$data_que['id']."");
			}
			if ($simpan) {
		echo "<script>
		window.location='index.php?page=pilih_teknisi&id=$_GET[id]'</script>";
		}
		}
	else {
		$que = mysqli_query($koneksi, "select *,barang_teknisi_detail.id as idd from barang_gudang,barang_gudang_detail,barang_dijual,barang_dikirim,barang_dikirim_detail,barang_teknisi,barang_teknisi_detail where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dijual.id=barang_dikirim.barang_dijual_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and barang_dikirim_detail.id=barang_teknisi_detail.barang_dikirim_detail_id and barang_teknisi.id=barang_teknisi_detail.barang_teknisi_id and barang_teknisi.id=".$_GET['id']." and barang_gudang.id=".$_POST['id_brg']."");
		while ($data_que = mysqli_fetch_array($que)) {
			$simpan = mysqli_query($koneksi, "insert into barang_teknisi_detail_teknisi values('','".$_GET['id']."','".$data_que['idd']."','".$_POST['id_teknisi']."','".$_POST['estimasi']."','".$_POST['tgl_berangkat']."','".$_POST['deskripsi']."')");
			mysqli_query($koneksi, "update barang_teknisi_detail set status_teknisi=1 where id=".$data_que['idd']."");
			}
			if ($simpan) {
		echo "<script>
		window.location='index.php?page=pilih_teknisi&id=$_GET[id]'</script>";
		}
		}
	
	
}
	
if (isset($_GET['id_hapus'])) {
	$cek = mysqli_num_rows(mysqli_query($koneksi, "select * from alat_uji_detail,barang_teknisi_detail,barang_dikirim_detail,barang_gudang_detail,barang_gudang,barang_teknisi where barang_teknisi_detail.id=alat_uji_detail.barang_teknisi_detail_id and barang_dikirim_detail.id=barang_teknisi_detail.barang_dikirim_detail_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_teknisi.id=barang_teknisi_detail.barang_teknisi_id and barang_gudang.id=".$_GET['id_hapus']." and barang_teknisi.id=".$_GET['id'].""));
	if ($cek==0) {
		$sq=mysqli_query($koneksi, "select *,barang_teknisi_detail_teknisi.id as id_detail_teknisi, barang_teknisi_detail.id as id_d from barang_teknisi_detail_teknisi,barang_teknisi_detail,barang_dikirim_detail,barang_gudang_detail,barang_gudang,barang_teknisi where barang_teknisi_detail.id=barang_teknisi_detail_teknisi.barang_teknisi_detail_id and barang_dikirim_detail.id=barang_teknisi_detail.barang_dikirim_detail_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_teknisi.id=barang_teknisi_detail.barang_teknisi_id and barang_gudang.id=".$_GET['id_hapus']." and barang_teknisi.id=".$_GET['id']."");
		while ($da=mysqli_fetch_array($sq)) {
			$del = mysqli_query($koneksi, "delete from barang_teknisi_detail_teknisi where id=".$da['id_detail_teknisi']."");
			mysqli_query($koneksi, "update barang_teknisi_detail set status_teknisi=0 where id=".$da['id_d']."");
			}
	 if ($del) { echo "<script>window.location='index.php?page=pilih_teknisi&id=$_GET[id]';
	</script>";} else {
	echo "<script>
alert('Data Gagal Di Hapus !');	window.location='index.php?page=pilih_teknisi&id=$_GET[id]';
	</script>";
	}
	} else {
		echo "<script>
alert('Data tidak dapat di hapus karena sudah dilakukan Instalasi & Uji Fungsi !');	window.location='index.php?page=pilih_teknisi&id=$_GET[id]';
	</script>";
		}
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
              <table width="100%" id="" class="table table-bordered">
  <thead>
    <tr>
      <th width="" valign="bottom"><strong>Tgl SPI</strong></th>
      <th width="" valign="bottom">No SPI</th>
      <th width="" valign="bottom">Deskripsi</th>
      </tr>
  </thead>
  <tr>
    <td><?php echo date("d F Y",strtotime($data['tgl_spk'])); ?>
    </td>
    <td><?php echo $data['no_spk']; ?></td>
    <td><?php echo $data['keterangan_spk']; ?></td>
    </tr>
</table>
              </div>
                <br />
                <font align="left" size="+2">
                 Data</font>
                <button class="btn btn-success pull pull-right" data-toggle="modal" data-target="#modal-tambah"><span class="fa fa-plus"></span> Tambah</button>
                 <br /><br />
                <div class="table-responsive">
                <table width="100%" id="example1" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th align="center" valign="bottom">No</th>
      <th valign="bottom"><strong> Nama Alkes</strong></th>
      <th valign="bottom"><strong> Teknisi</strong></th>
      <th valign="bottom"><strong>Estimasi</strong></th>
      <th valign="bottom"><strong>Tgl Berangkat</strong></th>
      <th valign="bottom"><strong>Deskripsi</strong></th>      
      <th align="center" valign="bottom"><strong>Aksi</strong></th>
      </tr>
  </thead>
  
  <?php
   
  $no=0;
  $q_akse = mysqli_query($koneksi, "select *,barang_teknisi.id as idd,barang_gudang.id as id_gudang from barang_teknisi,barang_teknisi_detail,barang_teknisi_detail_teknisi,barang_dikirim,barang_dikirim_detail,pembeli,barang_dijual,barang_gudang,barang_gudang_detail,tb_teknisi where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dijual.id=barang_dikirim.barang_dijual_id and pembeli.id=barang_dijual.pembeli_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and barang_dikirim_detail.id=barang_teknisi_detail.barang_dikirim_detail_id and barang_teknisi.id=barang_teknisi_detail.barang_teknisi_id and barang_teknisi_detail.id=barang_teknisi_detail_teknisi.barang_teknisi_detail_id and tb_teknisi.id=barang_teknisi_detail_teknisi.teknisi_id and barang_teknisi.id=".$_GET['id']." group by barang_gudang.id order by nama_brg ASC");
  $jm = mysqli_num_rows($q_akse);
  
  while ($data_akse = mysqli_fetch_array($q_akse)) {
	  $no++;
  ?>
  <tr>
    <td align=""><?php echo $no; ?></td>
    <td align="left"><?php echo $data_akse['nama_brg']." / ".$data_akse['tipe_brg']; ?>
    </td>
    <td align="left"><?php echo $data_akse['nama_teknisi'] ?></td>
    <td><?php echo date("d/M/Y",strtotime($data_akse['estimasi'])); ?></td>
    <td><?php 
	if ($data_akse['tgl_berangkat_teknisi']!=0000-00-00) {
	echo date("d/M/Y",strtotime($data_akse['tgl_berangkat_teknisi'])); 
	}
	?></td>
    <td><?php echo $data_akse['deskripsi']; ?></td>
    <td><a href="#" data-toggle="modal" data-target="#modal-ubah<?php echo $data_akse['idd'] ?>"><span data-toggle="tooltip" title="Ubah" class="fa fa-edit"></span></a>&nbsp;&nbsp;<a href="index.php?page=pilih_teknisi&id_hapus=<?php echo $data_akse['id_gudang']; ?>&id=<?php echo $_GET['id']; ?>" onclick="return confirm('Yakin Akan Menghapus Item Ini ?')"><span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span></a></td>
    </tr>
    <div class="modal fade" id="modal-ubah<?php echo $data_akse['idd']; ?>">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" align="center">Ubah Data</h4>
              </div>
              <form method="post">
              <div class="modal-body">
              <p align="justify">
              <input type="hidden" value="<?php echo $data_akse['idd']; ?>" name="id_ubah"/>
              <input type="hidden" value="<?php echo $data_akse['id_gudang']; ?>" name="id_gudang"/>
              <label>Nama Alkes</label>
                <select name="id_brg" id="id_brg" class="form-control select2" disabled="disabled" autofocus="autofocus" required onchange="changeValue(this.value)" style="width:100%">
        <option value="">--Pilih--</option>
        <option value="all">SEMUA NYA</option>
        <?php 
		$q = mysqli_query($koneksi, "select *,barang_gudang.id as idd from barang_dikirim,barang_dikirim_detail, barang_dijual, barang_gudang,barang_gudang_detail,barang_teknisi,barang_teknisi_detail where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dijual.id=barang_dikirim.barang_dijual_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and barang_teknisi.id=barang_teknisi_detail.barang_teknisi_id and barang_dikirim_detail.id=barang_teknisi_detail.barang_dikirim_detail_id and barang_teknisi.id=".$_GET['id']." group by tipe_brg order by barang_dikirim.no_po_jual ASC");
		$jsArray = "var dtBrg = new Array();
";
		while ($d = mysqli_fetch_array($q)) { ?>
        <option <?php if ($data_akse['id_gudang']==$d['idd']) {echo "selected";} ?> value="<?php echo $d['idd']; ?>"><?php echo $d['nama_brg']." / ".$d['tipe_brg']; ?></option>
        <?php 
		$jsArray .= "dtBrg['" . $d['idd'] . "'] = {tgl_kirim:'".addslashes($d['tgl_kirim'])."',
						nama_pembeli:'".addslashes($d['nama_pembeli'])."',
						nama_paket:'".addslashes($d['nama_paket'])."'
						};";
		} ?>
        </select>
                <label>Teknisi</label>
                <select name="id_teknisi" id="id_teknisi" class="form-control select2" disabled="disabled" required style="width:100%">
        <option value="">...</option>
        <?php 
	$q_seri = mysqli_query($koneksi, "select * from tb_teknisi order by nama_teknisi ASC");
	while ($d_seri=mysqli_fetch_array($q_seri)) {
	?>
        <option <?php if ($data_akse['teknisi_id']==$d_seri['id']) {echo "selected";} ?> value="<?php echo $d_seri['id']; ?>">
          <?php echo $d_seri['nama_teknisi']." / Bidang : ".$d_seri['bidang']; ?></option>
        <?php } ?>
        </select>
                <label>Estimasi</label>
                <input type="date" name="estimasi" id="" class="form-control" required="required" value="<?php echo $data_akse['estimasi'] ?>"/>
                <label>Tanggal Berangkat</label>
                <input type="date" name="tgl_berangkat" id="" class="form-control" value="<?php echo $data_akse['tgl_berangkat_teknisi'] ?>"/>
                <label>Deskripsi</label>
                <input type="text" class="form-control" name="deskripsi" value="<?php echo $data_akse['deskripsi'] ?>"/>
              </p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button class="btn btn-success" name="simpan_teknisi" type="submit">Simpan Perubahan</button>
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
<center><!--<a href="index.php?page=tambah_spk_masuk2&simpan_barang=1"><button name="simpan_barang" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Simpan</button></a>&nbsp;&nbsp;--><a href="index.php?page=spk_masuk"><button name="batal" class="btn btn-success" type="submit"><span class="fa  fa-check"></span> Kembali Ke Halaman SPI</button></a></center>
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
                <h4 class="modal-title" align="center">Tambah Data</h4>
              </div>
              <form method="post" enctype="multipart/form-data">
              <div class="modal-body">
                <label>Nama Alkes</label>
                <select name="id_brg" id="id_brg" class="form-control select2" autofocus="autofocus" required onchange="changeValue(this.value)" style="width:100%">
        <option value="">--Pilih--</option>
        <option value="all">SEMUA NYA</option>
        <?php 
		$q = mysqli_query($koneksi, "select *,barang_gudang.id as idd from barang_dikirim,barang_dikirim_detail, barang_dijual, barang_gudang,barang_gudang_detail,barang_teknisi,barang_teknisi_detail where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dijual.id=barang_dikirim.barang_dijual_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and barang_teknisi.id=barang_teknisi_detail.barang_teknisi_id and barang_dikirim_detail.id=barang_teknisi_detail.barang_dikirim_detail_id and barang_teknisi.id=".$_GET['id']." group by nama_brg order by barang_dikirim.no_po_jual ASC");
		$jsArray = "var dtBrg = new Array();
";
		while ($d = mysqli_fetch_array($q)) { ?>
        <option value="<?php echo $d['idd']; ?>"><?php echo $d['nama_brg']." / ".$d['tipe_brg']; ?></option>
        <?php 
		$jsArray .= "dtBrg['" . $d['idd'] . "'] = {tgl_kirim:'".addslashes($d['tgl_kirim'])."',
						nama_pembeli:'".addslashes($d['nama_pembeli'])."',
						nama_paket:'".addslashes($d['nama_paket'])."'
						};";
		} ?>
        </select>
                <label>Teknisi</label>
                <select name="id_teknisi" id="id_teknisi" class="form-control select2" required style="width:100%">
        <option value="">--Pilih Teknisi--</option>
        <?php 
	$q_seri = mysqli_query($koneksi, "select * from tb_teknisi order by nama_teknisi ASC");
	while ($d_seri=mysqli_fetch_array($q_seri)) {
	?>
        <option value="<?php echo $d_seri['id']; ?>">
          <?php echo $d_seri['nama_teknisi']." / Bidang : ".$d_seri['bidang']; ?></option>
        <?php } ?>
        </select>
                <label>Estimasi</label>
                <input type="date" name="estimasi" id="" class="form-control" required="required"/>
                <label>Tanggal Berangkat</label>
                <input type="date" name="tgl_berangkat" id="" class="form-control"/>
                <label>Deskripsi</label>
                <input type="text" class="form-control" name="deskripsi"/>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success" name="simpan_tambah_aksesoris">Simpan</button>
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