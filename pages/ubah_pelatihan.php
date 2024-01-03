<?php
$query = mysqli_query($koneksi, "select * from pelatihan_alat where id='".$_GET['id']."'");
$data = mysqli_fetch_array($query);

if (isset($_POST['ubah_lampiran'])) {
	$res = mysqli_query($koneksi, "update pelatihan_alat set lamp1='".$_FILES['lamp1']['name']."', lamp2='".$_FILES['lamp2']['name']."' where id=".$_GET['id']."");
	if ($res) {
		copy($_FILES['lamp1']['tmp_name'], "gambar_pelatihan/".$_FILES['lamp1']['name']);
		copy($_FILES['lamp2']['tmp_name'], "gambar_pelatihan/".$_FILES['lamp2']['name']);
		echo "<script type='text/javascript'>
		window.location='index.php?page=ubah_pelatihan&id=$_GET[id]';
		</script>";
		}
	}

if (isset($_SESSION['user']) and isset($_SESSION['pass'])) {
if (isset($_POST['simpan_perubahan'])) {
	$Result = mysqli_query($koneksi, "update pelatihan_alat set peserta='".$_POST['peserta']."', pelatih='".$_POST['pelatih']."', tgl_pelatihan='".$_POST['tgl_pelatihan']."' where id=".$_GET['id']."");
	if ($Result) {
		echo "<script type='text/javascript'>
		alert('Data Alkes BERHASIL Diubah !');
		window.location='index.php?page=pelatihan_alat'
		</script>";
		}
	else {
		echo "<script type='text/javascript'>
		alert('Data Alkes GAGAL Diubah !');
		window.location='index.php?page=pelatihan_alat'
		</script>";
		}
	}
}
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Pelatihan
     </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="index.php?page=pelatihan_alat">Pelatihan Alat</a></li>
        <li class="active">Ubah Data Pelatihan</li></ol></section>


    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) --><!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-6 connectedSortable">
          <!-- Custom tabs (Charts with tabs)--><!-- /.nav-tabs-custom -->

          <!-- Chat box -->
          <div class="box box-success"><!-- /.chat -->
            <div class="box-footer">
            <div class="box-header with-border">
              <h3 class="box-title">Ubah Data Pelatihan</h3></div><div class="box-body"><br />
              <form method="post" enctype="multipart/form-data">
              <label>Tanggal Pelatihan</label>
              <input name="tgl_pelatihan" class="form-control" placeholder="Tanggal Pelatihan" type="date" value="<?php echo $data['tgl_pelatihan']; ?>"><br />
              
              <label>Peserta</label>
              <input name="peserta" class="form-control" type="text" placeholder="Merk" value="<?php echo $data['peserta']; ?>"><br />
              <label>Pelatih</label>
              <input name="pelatih" class="form-control" type="text" placeholder="Pelatih" value="<?php echo $data['pelatih']; ?>"><br />
              
              
              
              <button name="simpan_perubahan" class="btn btn-success" type="submit"><span class="fa fa-edit"></span> Simpan Perubahan</button>
              <br /><br />
              </form>
              <a href="index.php?page=ubah_pelatihan&id=<?php echo $_GET['id']; ?>#openLampiran"><button class="form-control" style="background-color:#CCC"><strong>Ubah Lampiran</strong></button></a><br />
              </div>
              
              
            </div>
          </div>
          <!-- /.box (chat box) -->

          <!-- TO DO List --><!-- /.box -->

        <!-- quick email widget --></section>
        <section class="col-lg-3 connectedSortable">
          <!-- Custom tabs (Charts with tabs)--><!-- /.nav-tabs-custom -->

          <!-- Chat box -->
          <div class="box box-success"><!-- /.chat -->
            <div class="box-footer">
            <div class="box-header with-border">
              <strong>Lampiran 1</strong> 
              <hr />
              <img src="gambar_pelatihan/<?php echo $data['lamp1']; ?>"  width="100%"/>
              </div>
              </div>
          </div>
          </section>
        <section class="col-lg-3 connectedSortable">
          <!-- Custom tabs (Charts with tabs)--><!-- /.nav-tabs-custom -->

          <!-- Chat box -->
          <div class="box box-success"><!-- /.chat -->
            <div class="box-footer">
            <div class="box-header with-border">
              <strong>Lampiran 2</strong>
              <hr />
              <img src="gambar_pelatihan/<?php echo $data['lamp2']; ?>"  width="100%"/>
              </div>
            </div>
          </div>
          </section>
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
  
  <div id="openLampiran" class="modalDialog">
     <div>
        <a href="#" title="Close" class="close">X</a>
        <h3 align="center">Ubah Lampiran Photo / Video</h3> 
     <form method="post" enctype="multipart/form-data">
     <label>Lampiran 1</label>
     <input id="input" type="file" placeholder="" name="lamp1" style="background-color:#FFF">
     <label>Lampiran 2</label>
     <input id="input" type="file" name="lamp2" style="background-color:#FFF">
        <button id="buttonn" name="ubah_lampiran" type="submit">Simpan</button>
    </form>
    </div>
</div>