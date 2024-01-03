<?php
if (isset($_POST['tambah_header'])) {
	/*$Result = mysqli_query($koneksi, "insert into gaji_karyawan values('','$_POST[tgl_gaji]','$_POST[karyawan_id]','$_POST[bulan_tahun]','$_POST[jumlah_hari_kerja]')");
	if ($Result) {
		echo "<script type='text/javascript'>
		alert('Data Berhasil Di Simpan !');
		window.location='index.php?page=gaji_karyawan'
		</script>";
		}*/
	$_SESSION['tgl_gaji']=$_POST['tgl_gaji'];
	$_SESSION['karyawan_id']=$_POST['karyawan_id'];
	$_SESSION['bulan_tahun']=$_POST['bulan_tahun'];
	$_SESSION['jumlah_hari_kerja']=$_POST['jumlah_hari_kerja'];
	$_SESSION['catatan']=$_POST['catatan'];
	echo "<script>window.location='index.php?page=pilih_gaji'</script>";
	}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><span class="active">Tambah Gaji Karyawan</span></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Gaji Karyawan</li>
        <li class="active">Tambah GajiKaryawan</li>
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
              <h3 class="box-title">Tambah <span class="active">Gaji Karyawan</span></h3>
            </div>
              <div class="box-body">
              <form method="post" enctype="multipart/form-data">
              <label>Tanggal Dikeluarkan Gaji</label>
              <input name="tgl_gaji" class="form-control" type="date" placeholder="" value="" required="required" autofocus="autofocus"><br />
              <label>Karyawan</label>
              <select name="karyawan_id" class="form-control select2" style="width:100%" required="required" onchange="changeValue(this.value)">
                <option value="">-- Pilih --</option>
                <?php
              $q1 = mysqli_query($koneksi, "select *,karyawan.id as idd from karyawan order by nama_karyawan ASC");
			  $jsArray = "var dtBrg = new Array();
";
			  while ($data = mysqli_fetch_array($q1)) {
			  ?>
                <option value="<?php echo $data['idd']; ?>"><?php echo $data['nama_karyawan']; ?></option>
                <?php 
			  $jsArray .= "dtBrg['" . $data['idd'] . "'] = {nik:'".addslashes($data['nik'])."',nama_jabatan:'".addslashes($data['jabatan'])."',nama_divisi:'".addslashes($data['divisi'])."'
						};";
			  } ?>
              </select>
              <br /><br />
              <label>NIK</label>
              <input id="nik" name="nik" class="form-control" type="text" placeholder="" value="" disabled="disabled"><br />
              <label>Jabatan</label>
              <input id="nama_jabatan" name="nama_jabatan" class="form-control" type="text" placeholder="" value="" disabled="disabled"><br />
              <label>Divisi</label>
              <input id="nama_divisi" name="divisi" class="form-control" type="text" placeholder="" value="" disabled="disabled"><br />
              <label>Bulan dan Tahun Penggajian</label>
              <input name="bulan_tahun" class="form-control" type="text" placeholder="" value="" required="required"><br />
              <label>Jumlah Hari Kerja</label>
              <input name="jumlah_hari_kerja" class="form-control" type="number" placeholder="" value="" required="required"><br />
              <label>Catatan</label>
              <input name="catatan" class="form-control" type="text" placeholder="" value=""><br />
              <button name="tambah_header" class="btn btn-success" type="submit"><span class="fa fa-check"></span> Pilih Gaji</button>
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
  