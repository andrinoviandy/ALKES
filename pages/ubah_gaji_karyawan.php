<?php
$data=mysqli_fetch_array(mysqli_query($koneksi, "select *,gaji_karyawan.id as idd from gaji_karyawan,karyawan where karyawan.id=gaji_karyawan.karyawan_id and gaji_karyawan.id=".$_GET['id_ubah'].""));

if (isset($_POST['tambah_header'])) {
	$Result = mysqli_query($koneksi, "update gaji_karyawan set tgl_gaji='$_POST[tgl_gaji]',karyawan_id='$_POST[karyawan_id]',bulan_tahun='$_POST[bulan_tahun]',jumlah_hari_kerja='$_POST[jumlah_hari_kerja]',catatan='$_POST[catatan]' where id=".$_GET['id_ubah']."");
	if ($Result) {
		//$sel = mysqli_fetch_array(mysqli_query($koneksi, "select besar_gaji from gaji,gaji_karyawan_detail where gaji.id=gaji_karyawan_detail.gaji_id and gaji_karyawan"));
		mysqli_query($koneksi, "update gaji_karyawan_detail,gaji set gaji_karyawan_detail.dikali='".$_POST['jumlah_hari_kerja']."',total=$_POST[jumlah_hari_kerja]*gaji.besar_gaji,keterangan='$_POST[jumlah_hari_kerja] hari X Besar Tunjangan' where gaji.id=gaji_karyawan_detail.gaji_id and gaji_karyawan_id=".$_GET['id_ubah']." and gaji_karyawan_detail.dikali!=1");
		echo "<script type='text/javascript'>
		alert('Data Berhasil Di Ubah !');
		window.location='index.php?page=gaji_karyawan'
		</script>";
		}
	}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><span class="active">Ubah Gaji Karyawan</span></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Gaji Karyawan</li>
        <li class="active">Ubah Gaji Karyawan</li>
      </ol>
    </section>


    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) --><!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-5 connectedSortable">
          <!-- Custom tabs (Charts with tabs)--><!-- /.nav-tabs-custom -->

          <!-- Chat box -->
          <div class="box box-success"><!-- /.chat -->
            <div class="box-footer">
            <div class="box-header with-border">
              <h3 class="box-title">Ubah <span class="active">Gaji Karyawan</span></h3>
            </div>
              <div class="box-body">
              <form method="post" enctype="multipart/form-data">
              <label>Tanggal Dikeluarkan Gaji</label>
              <input name="tgl_gaji" class="form-control" type="date" placeholder="" value="<?php echo $data['tgl_gaji']; ?>" required="required" autofocus="autofocus"><br />
              <label>Karyawan</label>
              <select name="karyawan_id" class="form-control select2" style="width:100%" required="required" onchange="changeValue(this.value)">
                <option value="">-- Pilih --</option>
                <?php
              $q1 = mysqli_query($koneksi, "select *,karyawan.id as idd from karyawan order by nama_karyawan ASC");
			  $jsArray = "var dtBrg = new Array();
";
			  while ($data2 = mysqli_fetch_array($q1)) {
			  ?>
                <option <?php if ($data['karyawan_id']==$data2['idd']) {echo "selected";} ?> value="<?php echo $data2['idd']; ?>"><?php echo $data2['nama_karyawan']; ?></option>
                <?php 
			  $jsArray .= "dtBrg['" . $data2['idd'] . "'] = {nik:'".addslashes($data2['nik'])."',nama_jabatan:'".addslashes($data2['nama_jabatan'])."',nama_divisi:'".addslashes($data2['nama_divisi'])."'
						};";
			  } ?>
              </select>
              <br /><br />
              <label>NIK</label>
              <input id="nik" name="nik" class="form-control" type="text" placeholder="" value="<?php echo $data['nik']; ?>" disabled="disabled"><br />
              <label>Jabatan</label>
              <input id="nama_jabatan" name="nama_jabatan" class="form-control" type="text" placeholder="" value="<?php echo $data['jabatan']; ?>" disabled="disabled"><br />
              <label>Divisi</label>
              <input id="nama_divisi" name="divisi" class="form-control" type="text" placeholder="" value="<?php echo $data['divisi']; ?>" disabled="disabled"><br />
              <label>Bulan dan Tahun Penggajian</label>
              <input name="bulan_tahun" class="form-control" type="text" placeholder="" value="<?php echo $data['bulan_tahun']; ?>" required="required"><br />
              <label>Jumlah Hari Kerja</label>
              <input name="jumlah_hari_kerja" class="form-control" type="number" placeholder="" value="<?php echo $data['jumlah_hari_kerja']; ?>"><br />
              <label>Catatan</label>
              <input name="catatan" class="form-control" type="text" placeholder="" value="<?php echo $data['catatan']; ?>"><br />
              <button name="tambah_header" class="btn btn-success" type="submit"><span class="fa fa-check"></span> Simpan</button>
        </form>
        <script type="text/javascript">    
	<?php 
	echo $jsArray; 
	?>  
	function changeValue(karyawan_id){  
		document.getElementById('nik').value = dtBrg[karyawan_id].nik;
		document.getElementById('nama_jabatan').value = dtBrg[karyawan_id].nama_jabatan; 
		document.getElementById('nama_divisi').value = dtBrg[karyawan_id].nama_divisi;
	};  
</script>
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
  