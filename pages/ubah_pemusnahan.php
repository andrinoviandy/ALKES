<?php
$query = mysqli_query($koneksi, "select * from pemusnahan where id='".$_GET['id_ubah']."'");
$data = mysqli_fetch_array($query);

if (isset($_SESSION['user']) and isset($_SESSION['pass'])) {
if (isset($_POST['simpan_perubahan'])) {
	$Result = mysqli_query($koneksi, "update pemusnahan set tgl_pemusnahan='".$_POST['tgl']."', nama_item='".$_POST['item']."', jumlah_unit='".$_POST['jumlah']."', uraian='".$_POST['uraian']."', lokasi='".$_POST['lokasi']."', jam_mulai='".$_POST['jam_mulai']."', jam_selesai='".$_POST['jam_selesai']."', penanggung_jawab='".$_POST['penanggung_jawab']."', disetujui_oleh='".$_POST['disetujui_oleh']."', disiapkan_oleh='".$_POST['disiapkan_oleh']."', diperiksa_oleh='".$_POST['diperiksa_oleh']."' where id=".$_GET['id_ubah']."");
	if ($Result) {
		echo "<script type='text/javascript'>
		alert('Data Pemusnahan Alkes Berhasil Diubah !');
		window.location='index.php?page=pemusnahan_alkes'
		</script>";
		}
	}
}
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Pemusnahan Alkes
     </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Pemusnahan Alkes</li>
        <li class="active">Ubah Data Pemusnahan</li></ol></section>


    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) --><!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-7 connectedSortable">
          <!-- Custom tabs (Charts with tabs)--><!-- /.nav-tabs-custom -->

          <!-- Chat box -->
          <div class="box box-success"><!-- /.chat -->
            <div class="box-footer">
            <div class="box-header with-border">
              <h3 class="box-title">Ubah Data Pemusnahan</h3></div><div class="box-body"><br />
              <form method="post">
              <label>Tanggal Pemusanahan</label>
              <input name="tgl" class="form-control" placeholder="Nama Barang" type="date" value="<?php echo $data['tgl_pemusnahan']; ?>"><br />
              
              <label>Nama Item</label>
              <input name="item" class="form-control" type="text"  value="<?php echo $data['nama_item']; ?>"><br />
              
              <label>Jumlah Item</label>
              <input name="jumlah" class="form-control" type="text" value="<?php echo $data['jumlah_unit']; ?>"><br />
              
              <label>Uraian</label>
              <input name="uraian" class="form-control" type="text" value="<?php echo $data['uraian']; ?>"><br />
              
              <label>Lokasi</label>
              <input name="lokasi" class="form-control" type="text" value="<?php echo $data['lokasi']; ?>"><br />
              
              <label>Jam Mulai</label>
              <input name="jam_mulai" class="form-control" type="text" value="<?php echo $data['jam_mulai']; ?>"><br />
              
              <label>Jam Selesai</label>
              <input name="jam_selesai" class="form-control" type="text" value="<?php echo $data['jam_selesai']; ?>"><br />
              
              <label>Penanggung Jawab</label>
              <input name="penanggung_jawab" class="form-control" type="text" value="<?php echo $data['penanggung_jawab']; ?>"><br />
              
              <label>Disetujui Oleh</label>
              <input name="disetujui_oleh" class="form-control" type="text" value="<?php echo $data['disetujui_oleh']; ?>"><br />
              
              <label>Disiapkan Oleh</label>
              <input name="disiapkan_oleh" class="form-control" type="text" value="<?php echo $data['disiapkan_oleh']; ?>"><br />
              
              <label>Diperiksa Oleh</label>
              <input name="diperiksa_oleh" class="form-control" type="text" value="<?php echo $data['diperiksa_oleh']; ?>"><br />
              
              <button name="simpan_perubahan" class="btn btn-success" type="submit"><span class="fa fa-edit"></span> Simpan Perubahan</button>
              <br /><br />
              </form>
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