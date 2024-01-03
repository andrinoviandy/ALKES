<?php
$data=mysqli_fetch_array(mysqli_query($koneksi, "select *,alat_uji_detail.id as idd,pembeli_id as id_rumkit from barang_teknisi,barang_teknisi_detail,barang_teknisi_detail_teknisi, barang_dikirim,barang_dikirim_detail, barang_dijual, barang_gudang, barang_gudang_detail,pembeli, tb_teknisi,alat_uji_detail where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dijual.id=barang_dikirim.barang_dijual_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and pembeli.id=barang_dijual.pembeli_id and barang_dikirim_detail.id=barang_teknisi_detail.barang_dikirim_detail_id and barang_teknisi.id=barang_teknisi_detail.barang_teknisi_id and barang_teknisi_detail.id=barang_teknisi_detail_teknisi.barang_teknisi_detail_id and tb_teknisi.id=barang_teknisi_detail_teknisi.teknisi_id and barang_teknisi_detail.id=alat_uji_detail.barang_teknisi_detail_id and alat_uji_detail.id=".$_GET['id'].""));

if (isset($_POST['tambah_spk_masuk'])) {
	$max = mysqli_fetch_array(mysqli_query($koneksi, "select max(id)+1 as maks from alat_pelatihan"));
	$ext = explode(".",$_FILES['lampiran1']['name']);
	$ext2 = explode(".",$_FILES['lampiran2']['name']);
	if ($_FILES['lampiran1']['name']!='' and $_FILES['lampiran2']['name']!='') {
	$lamp1="Lampiran1_".$max['maks'].".".$ext[1];
	$lamp2="Lampiran2_".$max['maks'].".".$ext2[1];
		}
	elseif($_FILES['lampiran1']['name']!='' and $_FILES['lampiran2']['name']=='') {
	$lamp1="Lampiran1_".$max['maks'].".".$ext[1];
	$lamp2="";
		}
	if ($_FILES['lampiran1']['name']=='' and $_FILES['lampiran2']['name']!='') {
	$lamp1="";
	$lamp2="Lampiran2_".$max['maks'].".".$ext2[1];
		}
	else {
	$lamp1="";
	$lamp2="";
	}
	$Result = mysqli_query($koneksi, "insert into alat_pelatihan values('','".$_GET['id']."','".$_POST['peserta']."','".$_POST['pelatih']."','".$_POST['tgl_pelatihan']."','".$_POST['pelatihan_oleh']."','$lamp1','$lamp2')");
	
	if ($Result) {
		mysqli_query($koneksi, "update alat_uji_detail set status_pelatihan=1 where id=".$_GET['id']."");
		$id_pelatihan=mysqli_fetch_array(mysqli_query($koneksi, "select id from alat_pelatihan order by id DESC LIMIT 1"));
		mysqli_query($koneksi, "insert into peserta_pelatihan values('','".$id_pelatihan['id']."','')");
		copy($_FILES['lampiran1']['tmp_name'], "gambar_pelatihan/lampiran1/$lamp1");
		copy($_FILES['lampiran2']['tmp_name'], "gambar_pelatihan/lampiran2/$lamp2");
		
		echo "<script type='text/javascript'>
		alert('Silakan Tambah Data Peserta !');
		window.location='index.php?page=tambah_peserta_pelatihan&id=$id_pelatihan[id]';
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
              <input name="peserta" class="form-control" type="number" required autofocus="autofocus" placeholder="Hanya Ketikkan ANGKA"/>
              <br />
              Pelatih <font color="#FF0000">*</font>
              <input name="pelatih" class="form-control" required type="text">
              
              <br />
              Tanggal Pelatihan <font color="#FF0000">*</font>
              <input name="tgl_pelatihan" class="form-control" required="required" type="date" ><br />
              Pelatihan Oleh
              <input name="pelatihan_oleh" class="form-control" type="text"><br />
              
              Lampiran 1
              <input name="lampiran1" class="form-control" type="file"><br />
              
              Lampiran 2
              <input name="lampiran2" class="form-control" type="file"><br />
             <button name="tambah_spk_masuk" type="submit" value="Simpan" class="btn btn-success" style="padding:10px"><span class="fa fa-plus"></span> Simpan </button>
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
              <h3 class="box-title"><strong>Data Rumah Sakit/Dinas/Puskesmas/Klinik/dll</strong></h3>
            </div>
              <div class="box-body">
              <ul class="list-group list-group-unbordered">
                <li class="list-group-item" style="background-color:#0FF">
                  Nama RS/Dinas/Puskesmas/Klinik/dll : <font class="pull-right" style="font-size:18px; font-weight:bold"><?php echo $data['nama_pembeli']; ?></font></li>
                <li class="list-group-item">
                  Alamat : <font class="pull-right"><?php echo $data['jalan']." Kel. ".$data['kelurahan_id']; ?></font></li>
                <li class="list-group-item">
                  Kontak RS : <font class="pull-right"><?php echo $data['kontak_rs']; ?></font></li>
                  
              </ul>                                 
              </div>
            <div class="box-header with-border">
              <h3 class="box-title"><strong>Teknisi</strong></h3>
            </div>
              <div class="box-body">
              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  Nama :<font class="pull-right"> <?php echo $data['nama_teknisi']; ?></font>
                </li>
                <li class="list-group-item">
                  Kompetensi :<font class="pull-right"> <?php echo $data['bidang']; ?></font>
                </li>
                
              </ul>                                 
              </div>
              <div class="box-header with-border">
              <h3 class="box-title"><strong>Data Alkes</strong></h3>
            </div>
              <div class="box-body">
              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  Nama Alkes : <font class="pull-right"><?php echo $data['nama_brg']; ?></font></li>
                <li class="list-group-item">
                  Tipe : <font class="pull-right"><?php echo $data['tipe_brg']; ?></font></li>
                <li class="list-group-item">
                  Merk : <font class="pull-right"><?php echo $data['merk_brg']; ?></font></li>
                  <li class="list-group-item">
                  No Seri : <font class="pull-right"><?php echo $data['no_seri_brg']; ?></font></li>
                  <li class="list-group-item">
                  NIE (Nomor Ijin Edar) : <font class="pull-right"><?php echo $data['nie_brg']; ?></font></li>
                
              </ul>                                 
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
  
  