<?php
if (isset($_POST['tambah_simpan'])) {
	$Result = mysqli_query($koneksi, "update daftar_akun set no_akun='".$_POST['no_akun']."',nama='".$_POST['nama']."', tipe='".$_POST['tipe']."', saldo='".$_POST['saldo']."' where id=".$_GET['id']."");
	if ($Result) {
		echo "<script type='text/javascript'>
		alert('Data Berhasil Di Simpan !');
		window.location='index.php?page=daftar_akun'
		</script>";
		}
	}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><span class="active">Edit Akun</span></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Akun (C0A)</li>
        <li class="active">Edit Daftar Akun</li>
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
        <?php $query = mysqli_query($koneksi,"select * from daftar_akun where id=$_GET[id]");?>
        <?php $query1 = mysqli_query($koneksi,"select * from tipe_akun");?> 
          <!-- Chat box -->
          <div class="box box-success"><!-- /.chat -->
            <div class="box-footer">
            <div class="box-header with-border">
              <h3 class="box-title">Edit <span class="active">Akun</span></h3>
            </div>
              <div class="box-body">
              <form method="post">
              <label>Tipe Akun</label>
              <select name="tipe" class="form-control" required>
                  <option> -- PILIH --</option>
                <?php
                    $data = mysqli_fetch_array($query);
                  while ($row = mysqli_fetch_array($query1)) {
                  ?>
                  <option value="<?php echo $row['id'];?>"<?php if($data['tipe'] == $row['id']) echo 'selected="selected"';?>><?php echo $row['tipe_akun'];?></option>
                  <?php }?>
              </select>
              <br>
             <label>No Akun</label>
              <input type="text" name="no_akun" class="form-control" value="<?php echo $data['no_akun'];?>">
              <br>
              <label>Nama</label>
              <input type="text" name="nama" class="form-control" value="<?php  echo $data['nama'];?>">
              <br />
              <label>Saldo</label>
              <input name="saldo" class="form-control" type="number" required placeholder="" value="<?php echo $data['saldo'];?>"><br />
              <button name="tambah_simpan" class="btn btn-success" type="submit"><span class="fa fa-check"></span> Simpan</button>
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
  