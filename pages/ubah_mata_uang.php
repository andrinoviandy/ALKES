<?php
if (isset($_POST['tambah_laporan'])) {
	$Result = mysqli_query($koneksi, "update mata_uang set jenis_mu='".$_POST['jenis_mu']."',simbol='".$_POST['simbol']."', negara_mu='".$_POST['negara_mu']."',dalam_rupiah='".$_POST['dalam_rupiah']."',exp_time='".$_POST['exp_time']."' where id=".$_GET['id']."");
	if ($Result) {
		echo "<script type='text/javascript'>
		alert('Berhasil Di Ubah !');
		window.location='index.php?page=mata_uang'
		</script>";
		}
	}
if (isset($_POST['ubah_akun'])) {
	$Result = mysqli_query($koneksi, "update akun_customer set username='".$_POST['user']."', password='".$_POST['pass']."' where id=".$_GET['id']."");
	if ($Result) {
		echo "<script type='text/javascript'>
		alert('Data Akun Berhasil Di Ubah !');
		window.location='index.php?page=akun_user'
		</script>";
		}
	}

$data = mysqli_fetch_array(mysqli_query($koneksi, "select * from mata_uang where id=".$_GET['id'].""));
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><span class="active">Ubah Mata Uang</span></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Mata Uang</li>
        <li class="active">Ubah Mata Uang    </li>
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
              <h3 class="box-title">Ubah <span class="active">Mata Uang</span></h3>
            </div>
              <div class="box-body">
              <form method="post">
             Mata Uang
               <label> </label>
              <input name="jenis_mu" class="form-control" type="text" placeholder="" value="<?php echo $data['jenis_mu']; ?>"><br />
             Simbol
             <label></label>
              <input name="simbol" class="form-control" type="text" placeholder="" value="<?php echo $data['simbol']; ?>"><br />
              
             Negara
             <label></label>
              <input name="negara_mu" class="form-control" type="text" placeholder="" value="<?php echo $data['negara_mu']; ?>"><br />
               Satuan Dalam Rupiah
             <input name="dalam_rupiah" class="form-control" type="text" required placeholder="Negara" value="<?php echo $data['dalam_rupiah']; ?>"><br />
             Exp Time
             <label></label>
              <input name="exp_time" class="form-control" type="date" placeholder="" value="<?php echo $data['exp_time']; ?>"><br />
             <!--<label>Username</label>
              <input name="user" class="form-control" type="text" placeholder="" required value="<?php //echo $data['username']; ?>"><br />
              <label>Password</label>
              <input name="pass" class="form-control" type="password" placeholder="" required value="<?php //echo $data['password']; ?>"><br />-->
              <input type="submit" name="tambah_laporan" id="button" value="Simpan" class="btn btn-success"/><br /><br />
              </form>
              </div>
            </div>
          </div>
          <!-- /.box (chat box) -->

          <!-- TO DO List --><!-- /.box -->

        <!-- quick email widget --></section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

  </section>
    <!-- /.content -->
  </div>
  