<?php 
if (isset($_GET['id_hapus'])) {
	$del2 = mysqli_query($koneksi, "delete from gaji where id=".$_GET['id_hapus']."");
	}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Master Gaji</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Master Gaji</li>
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
              <div class="input-group pull pull-left col-xs-1" style="padding-right:10px">
              
              <a href="index.php?page=tambah_master_gaji">
              <button name="tambah_laporan" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Tambah</button></a>
              
              </div>
              <?php if ($jm==0) { ?>
              <br /><br />
              
              <?php } ?>
              <br />
              <?php
              if ($_POST['cari']!='') {
                echo "Results  Of  '".$_POST['cari']."'";
			  	}
				?>
                <table width="100%" id="example3" class="table table-bordered table-hover">
  <thead>
    <tr>
      <td width="" align="center"><strong>No</strong>
        </th>
        <th width="" valign="top">Kategori</th>
        <th width="" valign="top"><strong>Nama Gaji</strong></th>
        <th width="" valign="top">Besar Gaji</th>
        <th width="" align="center" valign="top"><strong>Aksi</strong></th>
          </tr>
  </thead>
  <?php
	  $query = mysqli_query($koneksi, "SELECT *,gaji.id as idd FROM gaji");

  $no=0;
  while ($data = mysqli_fetch_assoc($query)) { 
  $no++;
  ?>
  <tr>
    <td align="center"><?php echo $no; ?></td>
    <td><?php echo $data['kategori'];  ?></td>
    
    <td><?php echo $data['nama_gaji'];  ?></td>
    <td><?php echo "Rp".number_format($data['besar_gaji'],0,',','.');  ?></td>
    <td>
      
      <a href="index.php?page=master_gaji&id_hapus=<?php echo $data['idd']; ?>" onclick="return confirm('Anda Yakin Akan Menghapus Item Ini ?')"><span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span></a>&nbsp;&nbsp;<a href="index.php?page=ubah_master_gaji&id_ubah=<?php echo $data['idd']; ?>"><span data-toggle="tooltip" title="Ubah" class="fa fa-edit"></span></a>
      
    </td>
  </tr>
  <?php } ?>
</table><br />

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
  <?php
  $da = mysqli_fetch_array(mysqli_query($koneksi, "select * from karyawan where id =$_GET[id_ubah]"));
  if (isset($_POST['ubah_riwayat'])) {
    $query = mysqli_query($koneksi,"UPDATE karyawan set nama_karyawan='$_POST[nama_karyawan2]',alamat='$_POST[alamat2]',email='$_POST[email2]' where id=$da[id]");
    if ($query) {
        echo "<script type='text/javascript'>
		alert('Perubahan Berhasil Disimpan !');
		window.location='index.php?page=karyawan'
		</script>";
    }else{
        echo "<script type='text/javascript'>
		alert('Perubahan Gagal Disimpan !');
		window.location='index.php?page=karyawan'
		</script>";
    }
}
  ?>
  <div id="openUbah" class="modalDialog">
     <div>
        <a href="#" title="Close" class="close">X</a>
        <h3 align="center">Ubah Karyawan</h3>  
     <form method="post">
              <label>NIK</label>
              <input name="nik" class="form-control" type="text" placeholder="" required="required" value="<?php echo $da['nik']; ?>"><br />
              <label>Nama Karyawan</label>
              <input name="nama_karyawan2" class="form-control" type="text" placeholder="" required="required" value="<?php echo $da['nama_karyawan']; ?>"><br />
              <label>Alamat</label>
              <textarea name="alamat2" class="form-control" rows="5"><?php echo $da['alamat'];?></textarea><br />
              <label>Email</label>
                <input type="email" name="email2" class="form-control" value="<?php echo $da['email'];?>">
                <br />             
       <button name="ubah_riwayat" class="btn btn-success" type="submit"><span class="fa fa-check"></span> Simpan </button>
        </form>

              
    </div>
</div>