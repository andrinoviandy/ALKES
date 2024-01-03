<?php 
if (isset($_POST['simpan_tambah_aksesoris'])) {
	$simpan = mysqli_query($koneksi, "insert into spesifikasi values('','".$_GET['id']."','".$_POST['id_akse']."','".str_replace("\n","<br>",$_POST['spesifikasi'])."')");
	}
	
if (isset($_GET['id_hapus'])) {
	$del = mysqli_query($koneksi, "delete from spesifikasi where id=".$_GET['id_hapus']."");
	}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Tambah Spesifikasi Alkes</h1><ol class="breadcrumb">
       <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Tambah Spesifikasi Alkes</li>
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
      <th valign="bottom"><strong>Nama Alkes</strong></th>
      <th valign="bottom">NIE</th>
      <th valign="bottom"><strong>Tipe</strong></th>
      <th valign="bottom">Merk</th>
      <th valign="bottom"><strong>Negara Asal</strong></th>
      <th valign="bottom"><strong>Deskripsi Alat</strong></th>
      <th valign="bottom">Stok</th>
      </tr>
  </thead>
  <?php
	$data=mysqli_fetch_array(mysqli_query($koneksi, "select * from barang_gudang where id=".$_GET['id'].""));
	?> 
  <tr>
    <td><?php echo $data['nama_brg']; ?>
    </td>
    <td><?php echo $data['nie_brg']; ?></td>
    <td><?php echo $data['tipe_brg']; ?></td>
    <td><?php echo $data['merk_brg']; ?></td>
    <td><?php echo $data['negara_asal']; ?></td>
    <td><?php echo $data['deskripsi_alat']; ?></td>
    <td><?php echo $data['stok_total']; ?></td>
    </tr>
</table><br />
                <h3 align="left">
                  Tambah Spesifikasi
                </h3>
                <!--<font color="#FF0000">* Jika Ingin Menambah Data Aksesoris Yang Baru ! Klik Disini <a href="index.php?page=simpan_tambah_aksesoris&id=<?php echo $_GET['id']; ?>#openAkse"><small data-toggle="tooltip" title="Tambah Aksesoris Baru" class="label bg-blue">+ New Accessories</small></a></font>-->
                <br />
                <table width="100%" id="" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th valign="bottom">No</th>
      <th valign="bottom"><strong>Pilih Kategori</strong></th>
      <td align="center" valign="bottom"><strong>Deskripsi      
      </strong>
        <strong>Kategori</strong>
      <td align="center" valign="bottom"><strong>Spesifikasi</strong>
      <td align="center" valign="bottom"><strong>Aksi</strong></tr>
  </thead>
  
  <tr>
    <td>#</td>
    <form method="post" enctype="multipart/form-data">
    <td>
    <select name="id_akse" id="id_akse" class="form-control" autofocus="autofocus" required onchange="changeValue(this.value)">
    	<option value="">-- Pilih Kategori</option>
        <?php 
		$q = mysqli_query($koneksi, "select * from kategori_spesifikasi order by nama_kategori_spes ASC");
		$jsArray = "var dtBrg = new Array();
";
		while ($d = mysqli_fetch_array($q)) { ?>
        <option value="<?php echo $d['id']; ?>"><?php echo $d['nama_kategori_spes']; ?></option>
        <?php 
		$jsArray .= "dtBrg['" . $d['id'] . "'] = {deskripsi_spesifikasi:'".addslashes($d['deskripsi_spesifikasi'])."'
						};";
		} ?>
    </select>
    <a href="index.php?page=simpan_tambah_spesifikasi&id=<?php echo $_GET['id']; ?>#tambahKategori"><small data-toggle="tooltip" title="Tambah Kategori Baru" class="label bg-blue">+&nbsp; Kategori Baru</small></a>
    </td>
    <td align="center"><input id="deskripsi" name="deskripsi" class="form-control" type="text" placeholder="Deskripsi Kategori" disabled="disabled"/></td>
    <td align="center">
    <textarea required="required" name="spesifikasi" class="form-control" placeholder="Spesifikasi"></textarea>
    </td>
    <td align="center"><button name="simpan_tambah_aksesoris" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Tambah</button></td>
    </form>
  </tr>
  
  <script type="text/javascript">    
	<?php 
	echo $jsArray; 
	?>  
	function changeValue(id_akse){  
		document.getElementById('deskripsi').value = dtBrg[id_akse].deskripsi_spesifikasi; 
	};  
</script>
  <?php
   
  $no=0;
  $q_akse = mysqli_query($koneksi, "select *,spesifikasi.id as idd from spesifikasi,kategori_spesifikasi where barang_gudang_id=".$_GET['id']." and kategori_spesifikasi.id=spesifikasi.kategori_spesifikasi_id");
  $jm = mysqli_num_rows($q_akse);
  if ($jm!=0) { 
  while ($data_akse = mysqli_fetch_array($q_akse)) {
	  $no++;
  ?>
  <tr>
    <td><?php echo $no; ?></td>
    <td><?php echo $data_akse['nama_kategori_spes']; ?>
    </td>
    <td align="center"><?php echo $data_akse['deskripsi_spesifikasi']; ?></td>
    <td><?php echo $data_akse['nama_spesifikasi']; ?></td>
    <td align="center"><a href="index.php?page=simpan_tambah_spesifikasi&id=<?php echo $_GET['id']; ?>&id_hapus=<?php echo $data_akse['idd']; ?>" onclick="return confirm('Yakin Akan Menghapus Item Ini ?')"><span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span></a></td>
    </tr>
  <?php }} else {
	  echo "<tr><td colspan='7' align='center'>Tidak Ada Aksesoris</td></tr>";
	  } ?>
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
  <?php 
  if (isset($_POST['tambah_laporan'])) {
	$Result = mysqli_query($koneksi, "insert into kategori_spesifikasi values('','".$_POST['nama_kategori']."','".$_POST['deskripsi']."')");
	if ($Result) {
		echo "<script type='text/javascript'>
		alert('Data Berhasil Di Tambah !');
		window.location='index.php?page=simpan_tambah_spesifikasi&id=$_GET[id]';
		</script>";
		}
	}
		?>
  <div id="tambahKategori" class="modalDialog">
     <div>
        <a href="#" title="Close" class="close">X</a>
        <h3 align="center">Tambah Kategori Baru</h3> 
     <form method="post">
              <input name="nama_kategori" class="form-control" type="text" placeholder="Nama Kategori" required><br />
              
              <textarea name="deskripsi" class="form-control" type="text" rows="7" placeholder="Deskripsi Kategori" required></textarea><br />
              
              <button name="tambah_laporan" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Simpan</button>
              <br /><br />
              </form>
              
    </div>
</div>
