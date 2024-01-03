
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Tambah Progress</h1>
      <ol class="breadcrumb">
        <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="">Progress Pengerjaan</a></li>
        <li class="active"><a href="">Detail Progress Pengerjaan</a></li>
        <li class="active">Tambah Progress</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) --><!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <div class="col-xs-12">
          <div class="box"><!-- /.box-header -->
            <div class="box-body">
            <section class="invoice">
      <!-- title row -->
      
      <!-- info row --><!-- /.row -->

      <!-- Table row -->
      
      
      <!-- /.row --><!-- /.row -->

      <!-- this row will not appear when printing -->
      <div class="row">
        <div class="table-responsive">
        <table width="100%" id="" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th valign="top"><strong>Nama Alkes</strong></th>
        
      <th valign="top"><strong>Merk</strong></th>
      <th valign="top"><strong>Tipe</strong></th>
      <th valign="top">No Seri/Nama Set</th>
      <!--<th valign="top">NIE</th>
      <th valign="top">No. Bath</th>
      <th valign="top">No. Lot</th>-->
      <th valign="top"><strong>Negara Asal</strong></th>
     
        <th align="center" valign="top"><strong>Deskripsi Alat        
        </strong></th>
        
        </tr>
  </thead>
  <?php
 
	  $query = mysqli_query($koneksi, "select *,barang_gudang.id as id_gudang from barang_gudang,barang_gudang_detail where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang.id=".$_GET['id_gudang']." and barang_gudang_detail.id=".$_GET['id_gudang_detail']."");
	  //$query = mysqli_query($koneksi, "select *,barang_gudang.id as idd from barang_gudang order by id ".$limiter['urut']." LIMIT ".$limiter['limiter']."");

  $no=0;
  while ($data = mysqli_fetch_assoc($query)) { 
  $no++;
  ?>
  <tr>
    <td>
      <?php echo $data['nama_brg']; ?>
    </td>
    
      <td><?php echo $data['merk_brg']; ?></td>
    <td><?php echo $data['tipe_brg']; ?></td>
    <td><?php echo $data['no_seri_brg']." ".$data['nama_set']; ?></td>
    <!--<td><?php echo $data['nie_brg']; ?></td>
    <td><?php echo $data['no_bath']; ?></td>
    <td><?php echo $data['no_lot']; ?></td>-->
    <td><?php echo $data['negara_asal']; ?></td>
    <td><?php echo $data['deskripsi_alat']; ?></td>
    </tr>
  <?php } ?>
</table>
        </div>
      <?php 
	  if (isset($_POST['simpan'])) {
		  $max2 = mysqli_fetch_array(mysqli_query($koneksi, "select max(id)+1 as maks from barang_kembali_teknisi_progress"));
	$ext2 = explode(".",$_FILES['lampiran']['name']);
	$lamp_f="BarangKembaliRusak$max2[maks]".".".$ext2[1];
		  $queri_simpan= mysqli_query($koneksi, "insert into barang_kembali_teknisi_progress values('','".$_GET['id_ubah']."','".$_POST['tgl']."','".$_POST['deskripsi_kerusakan']."','".$_POST['deskripsi_perbaikan']."','$lamp_f')");
		  
		  if ($queri_simpan) {
			  copy($_FILES['lampiran']['tmp_name'], "gambar_progress_barang_kembali/$lamp_f");
			  //mysqli_query($koneksi, "update tb_maintenance_detail set status_proses=1 where id=".$_GET['id_alkes']."");
			  echo "<script type='text/javascript'>
			  alert('Progress Berhasil Di Tambah'); window.location='index.php?page=tambah_progress_barang_kembali&id_gudang_detail=$_GET[id_gudang_detail]&id_ubah=$_GET[id_ubah]&id_gudang=$_GET[id_gudang]'
			  </script>";
			  }
			else {
				echo "<script type='text/javascript'>
			  alert('Gagal Di Tambah'); window.location='index.php?page=tambah_progress_barang_kembali2&id_gudang_detail=$_GET[id_gudang_detail]&id_ubah=$_GET[id_ubah]&id_gudang=$_GET[id_gudang]'
			  </script>";
				}
		  }
	  ?>
      <br /><h3 align="center">Tambah Progress</h3><br />
      <form method="post" enctype="multipart/form-data">
      <label>Tanggal</label>
        <div class="input-group col-sm-1">
              <span class="input-group-addon"><span class="fa fa-calendar"></span></span><input name="tgl" class="form-control" placeholder="" type="date" required="required" autofocus="autofocus">
        </div><br />
        <label>Deskripsi Kerusakan</label>
        <textarea name="deskripsi_kerusakan" cols="" rows="4" class="form-control" required="required" ></textarea>
       <br />
       <label>Deskripsi Perbaikan</label>
        <textarea name="deskripsi_perbaikan" cols="" rows="4" class="form-control" required="required"></textarea>
        <br />
        <label>Lampiran Photo/Video</label>
        <input name="lampiran" type="file" class="form-control" style="background-color:#CCC"/>
        <br />
        <input class="btn btn-success" name="simpan" type="submit" value="Tambah Progress"/>
        </form>
      </div>
    </section>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        </div>
        </section>
    <!-- /.content -->
  </div>