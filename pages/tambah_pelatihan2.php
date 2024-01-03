<?php
$data=mysqli_fetch_array(mysqli_query($koneksi, "select *,alat_uji_detail.id as idd,pembeli_id as id_rumkit from barang_teknisi,barang_teknisi_detail,barang_teknisi_detail_teknisi, barang_dikirim,barang_dikirim_detail, barang_dijual, barang_gudang, barang_gudang_detail,pembeli, tb_teknisi,alat_uji_detail where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dijual.id=barang_dikirim.barang_dijual_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and pembeli.id=barang_dijual.pembeli_id and barang_dikirim_detail.id=barang_teknisi_detail.barang_dikirim_detail_id and barang_teknisi.id=barang_teknisi_detail.barang_teknisi_id and barang_teknisi_detail.id=barang_teknisi_detail_teknisi.barang_teknisi_detail_id and tb_teknisi.id=barang_teknisi_detail_teknisi.teknisi_id and barang_teknisi_detail.id=alat_uji_detail.barang_teknisi_detail_id and alat_uji_detail.id=".$_GET['id'].""));

if (isset($_POST['tambah_spk_masuk'])) {
	$Result = mysqli_query($koneksi, "update alat_pelatihan_hash set banyak_peserta='".$_POST['peserta']."', pelatih='".$_POST['pelatih']."', tgl_pelatihan='".$_POST['tgl_pelatihan']."', pelatihan_oleh='".$_POST['pelatihan_oleh']."' where akun_id=".$_SESSION['id']."");
	if ($Result) {
		echo "<script type='text/javascript'>
		alert('Silakan Tambah Data Peserta !');
		window.location='index.php?page=tambah_peserta_pelatihan2&banyak_peserta=$_POST[peserta]';
		</script>";
		
		}
	}

if (isset($_POST['tambahteknisibaru'])) {
	$dat=mysqli_num_rows(mysqli_query($koneksi, "select * from tb_teknisi where nama_teknisi='".$_POST['nama_teknisi']."'"));
	if ($dat==0) {
	$Result = mysqli_query($koneksi, "insert into tb_teknisi values('','".$_POST['nama_teknisi']."','".$_POST['bidang']."','".$_POST['no_str']."','".$_POST['no_hp']."','".$_POST['username']."','".md5($_POST['password'])."','".$_POST['nama_teknisi']."-".$_FILES['ijazah']['name']."','".$_POST['nama_teknisi']."-".$_FILES['sertifikat']['name']."')");
	if ($Result) {
		copy($_FILES['ijazah']['tmp_name'], "ijazah_teknisi/".$_POST['nama_teknisi']."-".$_FILES['ijazah']['name']);
		copy($_FILES['sertifikat']['tmp_name'], "ijazah_teknisi/sertifikat/".$_POST['nama_teknisi']."-".$_FILES['sertifikat']['name']);
		echo "<script type='text/javascript'>
		alert('Teknisi Berhasil Di Tambah !');
		window.location='index.php?page=tambah_spk_masuk'
		</script>";
		}
	} else {
		echo "<script type='text/javascript'>
		alert('Nama Teknisi Sudah Ada !');
		window.location='index.php?page=tambah_spk_masuk#tambahTeknisi'
		</script>";
		}
}
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Pelatihan Alkes
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Pelatihan Alkes</li>
        <li class="active">Tambah</li></ol></section>


    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) --><!-- /.row -->
      <!-- Main row -->
      <form method="post" enctype="multipart/form-data">
      <div class="row">
        <!-- Left col -->
        
        <section class="col-lg-4 connectedSortable">
          <!-- Custom tabs (Charts with tabs)--><!-- /.nav-tabs-custom -->

          <!-- Chat box -->
          <div class="box box-success"><!-- /.chat -->
            <div class="box-footer">
            <div class="box-header with-border">
              <h3>Tambah Data Pelatihan Alat</h3>
              <h3 class="box-title"><em>isilah dengan data dengan benar !</em></h3></div><div class="box-body">
              Banyak Peserta Pelatihan (Maks. 15 Orang) <font color="#FF0000">*</font>
              <input name="peserta" class="form-control" type="text" required autofocus="autofocus" placeholder="Hanya isi dengan ANGKA"/>
              <br />
              Pelatih <font color="#FF0000">*</font>
              <input name="pelatih" class="form-control" required type="text">
              
              <br />
              Tanggal Pelatihan <font color="#FF0000">*</font>
              <input name="tgl_pelatihan" class="form-control" required="required" type="date" ><br />
              Pelatihan Oleh
              <input name="pelatihan_oleh" class="form-control" type="text"><br />
              <button name="tambah_spk_masuk" type="submit" value="Simpan" class="btn btn-success" style="padding:10px"><span class="fa fa-plus"></span> Next </button>
              </div>
            </div>
          </div>
          <!-- /.box (chat box) -->

          <!-- TO DO List --><!-- /.box -->

        <!-- quick email widget --></section>
        <section class="col-lg-8 connectedSortable">
          <!-- Custom tabs (Charts with tabs)--><!-- /.nav-tabs-custom -->

          <!-- Chat box -->
          <div class="box box-success"><!-- /.chat -->
            <div class="box-footer">
            
            <div class="box-header with-border">
              <h3 class="box-title"><strong>Data Alkes</strong></h3>
            </div>
              <div class="box-body">
              <table width="100%" id="example3" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th valign="bottom">No</th>
      <th valign="bottom">RS/Dinas/Dll</th>
      <th valign="bottom"><strong>Nama Alkes</strong></th>
      <td align="center" valign="bottom"><strong>No Seri / Nama Set</strong></td>
      </tr>
  </thead>
  <?php
  $no=0;
  $q_akse = mysqli_query($koneksi, "select *,alat_pelatihan_hash.id as idd,pembeli_id as id_rumkit from barang_teknisi,barang_teknisi_detail,barang_teknisi_detail_teknisi, barang_dikirim,barang_dikirim_detail, barang_dijual, barang_gudang, barang_gudang_detail,pembeli, tb_teknisi,alat_uji_detail,alat_pelatihan_hash where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dijual.id=barang_dikirim.barang_dijual_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and pembeli.id=barang_dijual.pembeli_id and barang_dikirim_detail.id=barang_teknisi_detail.barang_dikirim_detail_id and barang_teknisi.id=barang_teknisi_detail.barang_teknisi_id and barang_teknisi_detail.id=barang_teknisi_detail_teknisi.barang_teknisi_detail_id and tb_teknisi.id=barang_teknisi_detail_teknisi.teknisi_id and barang_teknisi_detail.id=alat_uji_detail.barang_teknisi_detail_id and alat_uji_detail.id=alat_pelatihan_hash.alat_uji_detail_id and akun_id=".$_SESSION['id']." order by alat_pelatihan_hash.id DESC");
  
  while ($data_akse = mysqli_fetch_array($q_akse)) {
	  $no++;
  ?>
  <tr>
    <td><?php echo $no; ?></td>
    <td><?php echo $data_akse['nama_pembeli']; ?></td>
    <td><?php echo $data_akse['nama_brg']; ?>
    </td>
    <td align="center"><?php echo $data_akse['no_seri_brg']." / ".$data_akse['nama_set']; ?></td>
    </tr>
  <?php } ?>
</table>                                 
              </div>
            </div>
          </div>
          <!-- /.box (chat box) -->

          <!-- TO DO List --><!-- /.box -->

        <!-- quick email widget -->
          <!-- Custom tabs (Charts with tabs)--><!-- /.nav-tabs-custom -->

          <!-- Chat box -->
          
          <!-- /.box (chat box) -->

          <!-- TO DO List --><!-- /.box -->

        <!-- quick email widget --></section>
        
        <section class="col-lg-12 connectedSortable" align="center">
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
      </form>
      <!-- /.row (main row) -->

  </section>
    <!-- /.content -->
  </div>
  
  