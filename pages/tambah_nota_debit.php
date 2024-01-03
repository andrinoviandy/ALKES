<?php
if (isset($_POST['tambah_header'])) {
	$Result = mysqli_query($koneksi, "INSERT into nota_debit values('','$_POST[tanggal]','$_POST[pemasok_id]','".$_POST['deskripsi']."','".$_POST['pilihan_biaya_id']."','".$_POST['harga']."')");
	if ($Result) {
		echo "<script type='text/javascript'>
		alert('Data Berhasil Di Simpan !');
		window.location='index.php?page=nota_debit'
		</script>";
		}else{
            echo "<script type='text/javascript'>
		alert('Data gagal Di Simpan !');
		window.location='index.php?page=nota_debit'
		</script>";
        }
	}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><span class="active">Tambah Nota Debit</span></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Nota Debit</li>
        <li class="active">Tambah Nota Debit</li>
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
              <h3 class="box-title">Tambah <span class="active">Nota Debit</span></h3>
            </div>
              <div class="box-body">
              <form method="post">
              <label>Tanggal</label>
              <input name="tanggal" class="form-control" type="date" placeholder="" required="required"><br />
              <label>Nama Pemasok</label>
              <select name="pemasok_id" class="form-control" required="required">
              <option>-- Pilih Pemasok --</option>
              <?php 
              $query = mysqli_query($koneksi,"SELECT id,nama_pemasok FROM pemasok");
              while ($row = mysqli_fetch_array($query)) {?>
              <option value="<?php echo $row['id'];?>"><?php echo $row['nama_pemasok'];?></option>
              <?php } ?>
              </select>
              <br /> 
              <label>Deskripsi</label>
              <textarea name="deskripsi" class="form-control"></textarea><br />
              <label>Pilihan Biaya</label>
              <select name="pilihan_biaya_id" class="form-control" required="required">
              <option>-- Pilih Biaya --</option>
              <?php 
              $query1 = mysqli_query($koneksi,"SELECT * FROM pilihan_biaya");
              while ($row1 = mysqli_fetch_array($query1)) {?>
              <option value="<?php echo $row1['id'];?>"><?php echo $row1['nama_biaya'];?></option>
              <?php } ?>
              </select>
              <br />
              <label>Harga</label>
              <input type="number" name="harga" class="form-control"><br>
              <button name="tambah_header" class="btn btn-success" type="submit"><span class="fa fa-check"></span> Simpan</button>
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
  