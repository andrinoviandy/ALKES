<?php
$data = mysqli_fetch_array(mysqli_query($koneksi, "select * from reimburse,keuangan,keuangan_detail where keuangan.id=reimburse.keuangan_id and keuangan.id=keuangan_detail.keuangan_id and reimburse.id=$_GET[id_ubah]"));

if (isset($_POST['tambah_header'])) {
    //$cek_saldo = mysqli_fetch_array(mysqli_query($koneksi, "select * from buku_kas where id=".$_POST['akun'].""));	
	//$simpan_keuangan = mysqli_query($koneksi,"insert into keuangan values('','".$_POST['tanggal']."','Reimburse','".$_POST['deskripsi']."','".$_POST['nominal']."')");
	$query = mysqli_query($koneksi, "update reimburse,keuangan set reimburse.tgl_reimburse='".$_POST['tanggal']."',keuangan.tgl_transaksi='".$_POST['tanggal']."',reimburse.karyawan_id='".$_POST['karyawan_id']."',reimburse.deskripsi='".$_POST['deskripsi']."',keuangan.deskripsi='".$_POST['deskripsi']."',reimburse.nominal='".$_POST['nominal']."',keuangan.saldo='".$_POST['nominal']."' where keuangan.id=reimburse.keuangan_id and reimburse.id=".$_GET['id_ubah']."");
	$del_keuangan = mysqli_query($koneksi, "delete from keuangan_detail where keuangan_id=".$data['keuangan_id']."");
	$simpan_keuangan_detail = mysqli_query($koneksi,"insert into keuangan_detail values('','$data[keuangan_id]','".$_POST['coa_id']."','".$_POST['coa_sub_id']."','".$_POST['coa_sub_akun_id']."','cr')");
	$simpan_keuangan_detail2 = mysqli_query($koneksi,"insert into keuangan_detail values('','$data[keuangan_id]','3','32','','cr')");
	$simpan_keuangan_detail3 = mysqli_query($koneksi,"insert into keuangan_detail values('','$data[keuangan_id]','2','12','','cr')");
	
	if ($query and $simpan_keuangan_detail and $simpan_keuangan_detail2 and $simpan_keuangan_detail3) {
        echo "<script type='text/javascript'>
		alert('Berhasil Diubah !');
		window.location='index.php?page=reimburse'
		</script>";
        // echo "<script type='text/javascript'>
		// alert('Data Berhasil Di Simpan !');
		// window.location='index.php?page=reimburse'
		// </script>";
        
        }
	}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><span class="active">Ubah Reimburse</span></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Reimburse</li>
        <li class="active">Ubah Reimburse</li>
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
              <h3 class="box-title">Ubah <span class="active">Reimburse</span></h3>
            </div>
              <div class="box-body">
              <form method="post">
              <label>Tanggal</label>
              <input name="tanggal" class="form-control" type="date" placeholder="" value="<?php echo $data['tgl_reimburse']; ?>" required><br />
              <label>Karyawan</label>
              <select name="karyawan_id" class="form-control select2" required style="width:100%">
              <option value="">-- Pilih Karyawan --</option>
              <?php 
              $query = mysqli_query($koneksi, "SELECT id,nama_karyawan FROM karyawan");
              while($row = mysqli_fetch_array($query)){
              ?>
              <option <?php if ($data['karyawan_id']==$row['id']){echo "selected";} ?> value="<?php echo $row['id'];?>"><?php echo $row['nama_karyawan'];?></option>
              <?php }?>
              </select><br><br />
              <label>Akun</label>
              <div class="well">
              <select required name="coa_id" class="form-control" id="coa_id">
              <option value="">-- Pilih --</option>
              <?php $query1 = mysqli_query($koneksi,"SELECT * FROM coa where id!=1 and id!=2 and id!=3");
              while ($row1= mysqli_fetch_array($query1)) {
              ?>
              <option <?php if ($data['coa_id']==$row1['id']) {echo "selected";} ?> value="<?php echo $row1['id']?>"><?php echo $row1['nama_grup'];?></option>
              <?php }?>
              </select><br />
              <select required name="coa_sub_id" class="form-control" id="coa_sub_id">
              <option value="">-- Pilih --</option>
              <?php $query2 = mysqli_query($koneksi,"SELECT *,coa_sub.id as idd FROM coa_sub INNER JOIN coa ON coa.id=coa_sub.coa_id");
              while ($row1= mysqli_fetch_array($query2)) {
              ?>
              <option <?php if ($data['coa_sub_id']==$row1['idd']) {echo "selected";} ?> id="coa_sub_id" class="<?php echo $row1['coa_id']; ?>" value="<?php echo $row1['idd']?>"><?php echo $row1['nama_sub_grup'];?></option>
              <?php }?>
              </select><br />
              <select name="coa_sub_akun_id" class="form-control select2" style="width:100%" id="coa_sub_akun_id">
              <option value="">-- Pilih --</option>
              <?php $query3 = mysqli_query($koneksi,"SELECT *,coa_sub_akun.id as idd FROM coa_sub_akun INNER JOIN coa_sub ON coa_sub.id=coa_sub_akun.coa_sub_id");
              while ($row1= mysqli_fetch_array($query3)) {
              ?>
              <option <?php if ($data['coa_sub_akun_id']==$row1['idd']) {echo "selected";} ?> id="coa_sub_akun_id" class="<?php echo $row1['coa_sub_id']; ?>" value="<?php echo $row1['idd']?>"><?php echo $row1['nama_akun'];?></option>
              <?php } ?>
              </select>
              <script src="jquery-1.10.2.min.js"></script>
        <script src="jquery.chained.min.js"></script>
        <script>
            $("#coa_sub_id").chained("#coa_id");
			$("#coa_sub_akun_id").chained("#coa_sub_id");
        </script>
              </div> 
              <label>Deskripsi</label>
              <textarea name="deskripsi" class="form-control" placeholder="" rows="4"><?php echo $data['deskripsi']; ?></textarea>
              <br />
              <label>Nominal</label>
              <input type="number" name="nominal" class="form-control" required="required" value="<?php echo $data['nominal']; ?>"><br>
              <button name="tambah_header" class="btn btn-success" type="submit"><span class="fa fa-check"></span> Simpan Perubahan</button>
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
  