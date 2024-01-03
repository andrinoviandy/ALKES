<?php
$queri = mysqli_query($koneksi, "select *,tb_maintenance.id as idd from tb_laporan_kerusakan,akun_customer,kategori_job,barang_dikirim,barang_dijual,barang_gudang,barang_gudang_detail,tb_maintenance,tb_teknisi where akun_customer.id=tb_laporan_kerusakan.akun_customer_id and barang_dikirim.id=tb_laporan_kerusakan.barang_dikirim_id and kategori_job.id=tb_laporan_kerusakan.kategori_job_id and barang_dijual.id=barang_dikirim.barang_dijual_id and barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dijual.barang_gudang_detail_id and tb_laporan_kerusakan.id=tb_maintenance.laporan_kerusakan_id and tb_teknisi.id=tb_maintenance.teknisi_id and tb_maintenance.id=".$_GET['id_ubah']."");
$ubah = mysqli_fetch_array($queri);

if (isset($_POST['tambah_laporan'])) {
	$Result = mysqli_query($koneksi, "update tb_maintenance set tgl_maintenance='".$_POST['tgl_spk']."', teknisi_id=".$_POST['id_teknisi']." where id=".$_GET['id_ubah']."");
	if ($Result) {
		
		echo "<script type='text/javascript'>
		alert('Data Berhasil Diubah !');
		window.location='index.php?page=pembuatan_spk';
		</script>";
		}
	}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Ubah Maintenance Kerusakan
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Maintenance Kerusakan</li>
        <li class="active">Ubah Maintenance Kerusakan</li>
      </ol>
    </section>
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
              <h3 class="box-title">Ubah Data Maintenance Kerusakan</h3>
            </div>
              <div class="box-body">
              <form method="post">
              <br />
              <label>Tanggal Maintenance</label>
              <input name="tgl_spk" class="form-control" type="date" required value="<?php echo $ubah['tgl_maintenance']; ?>"><br />
              
              <label>Nama Barang - Pelapor</label>
             
              <input name="id_lapor" class="form-control" type="text" disabled="disabled" value="<?php echo $ubah['nama_brg']." / No Seri : ".$ubah['no_seri_brg']." - ".$ubah['nama_user']; ?>">
              <br />
              
              <label>Teknisi</label>
              <select name="id_teknisi" class="form-control" required>
              
              <?php 
			  $query_teknisi = mysqli_query($koneksi, "select * from tb_teknisi order by nama_teknisi ASC");
			  while ($data_t = mysqli_fetch_array($query_teknisi)) {
			  ?>
              <option <?php if ($data_t['id']==$ubah['teknisi_id']) { echo "selected"; } ?> value="<?php echo $data_t['id']; ?>"><?php echo $data_t['nama_teknisi']." - ".$data_t['bidang']; ?></option>
              <?php } ?>
              </select><br />
              
              <button type="submit" name="tambah_laporan" id="button" class="btn btn-success"><span class="fa fa-edit"></span> Simpan Perubahan</button>
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