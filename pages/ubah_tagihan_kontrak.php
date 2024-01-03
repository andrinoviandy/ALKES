<?php
$data = mysqli_fetch_array(mysqli_query($koneksi, "select * from kontrak_tagihan where id=".$_GET['id'].""));

if (isset($_POST['tambah_header'])) {
	$Result = mysqli_query($koneksi, "update kontrak_tagihan set kontrak_id='".$_POST['kontrak_id']."',tgl_penagihan='".$_POST['tgl']."',deskripsi='".$_POST['deskripsi']."' where id=".$_GET['id']."");
	if ($Result) {
		echo "<script type='text/javascript'>
		alert('Data Berhasil Di Ubah !');
		window.location='index.php?page=tagihan_kontrak'
		</script>";
		}
	}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><span class="active">Ubah Penagihan</span></h1><ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Penagihan</li>
        <li class="active">Ubah Penagihan</li>
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
              <h3 class="box-title">Ubah <span class="active">Penagihan</span></h3>
            </div>
              <div class="box-body">
              <form method="post">
              <label>Nomor Kontrak</label>
              <select name="kontrak_id" class="form-control select2" style="width:100%" required="required">
                <option value="">...</option>
                <?php
              $q1 = mysqli_query($koneksi, "select *,kontrak.id as idd from kontrak order by no_kontrak DESC");
			  
			  while ($d = mysqli_fetch_array($q1)) {
			  ?>
                <option <?php if ($data['kontrak_id']==$d['idd']){echo "selected";} ?> value="<?php echo $d['idd']; ?>"><?php echo $d['no_kontrak']; ?></option>
                <?php } ?>
              </select>
              <br /><br />
              <label>Tanggal </label>
              <input name="tgl" class="form-control" type="date" placeholder="" value="<?php echo $data['tgl_penagihan']; ?>" required="required"><br />
              <label>Deskripsi</label>
              <textarea class="form-control" name="deskripsi" rows="5"><?php echo $data['deskripsi']; ?></textarea><br />
              
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
  