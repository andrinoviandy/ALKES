<?php
$data = mysqli_fetch_array(mysqli_query($koneksi, "select *,aksesoris_jual.id as idd,pembeli.id as id_pembeli from aksesoris_jual,aksesoris_jual_detail,aksesoris,aksesoris_detail, pembeli where aksesoris.id=aksesoris_detail.aksesoris_id and aksesoris_detail.id=aksesoris_jual_detail.aksesoris_detail_id and aksesoris_jual.id=aksesoris_jual_detail.aksesoris_jual_id and pembeli.id=aksesoris_jual.pembeli_id and aksesoris_jual.id=".$_GET['id'].""));

if (isset($_POST['lapor'])) {
	$query=mysqli_query($koneksi, "update barang_dijual,pembeli set tgl_jual='".$_POST['tgl_jual']."', nama_pembeli='".$_POST['pembeli']."', provinsi_id='".$_POST['provinsi']."', kabupaten_id='".$_POST['kabupaten']."', kecamatan_id='".$_POST['kecamatan']."', kelurahan_id='".$_POST['kelurahan']."', jalan='".$_POST['alamat']."', nama_pemakai='".$_POST['pemakai']."', kontak='".$_POST['kontak']."', email='".$_POST['email']."' where pembeli.id=barang_dijual.pembeli_id and barang_dijual.id=".$_GET['id']."");
		if ($query) {
		echo "<script type='text/javascript'>
		alert('Item Berhasil Diubah !');
		window.location='index.php?page=jual_barang'
		</script>";
			
	} else {
		echo "<script type='text/javascript'>
		alert('Item Gagal Diubah !');
		</script>";
		}
}

if (isset($_GET['id_hapus'])) {
	$del1 = mysqli_query($koneksi, "delete from barang_dijual_detail where id=".$_GET['id_hapus']."");
	if ($del1) {
		mysqli_query($koneksi, "update barang_dijual set qty=qty-1 where id=".$_GET['id']."");
		echo "<script type='text/javascript'>
		window.location='index.php?page=ubah_barang_jual2&id=$_GET[id]'
		</script>";
		}
	}
	?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Ubah Data Jual Alkes</h1><ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Jual Alkes</li>
        <li class="active">Ubah Data Jual Alkes</li>
        </ol>
    </section>


    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) --><!-- /.row -->
      <!-- Main row -->
<div class="row">
<div class="col-md-5"><!-- /.box -->

          <!-- iCheck -->
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Ubah Data Pembeli</h3>
            </div>
          <div class="box-body">
          	<form method="post">
              Tanggal Jual
              <input name="tgl_jual" type="date" class="form-control" required autofocus="autofocus" value="<?php echo $data['tgl_jual_akse']; ?>"/><br />
             
            Nama RS/Dinas/Puskesmas/Klinik/Dll
              <input name="pembeli" type="text" class="form-control" required placeholder="" value="<?php echo $data['nama_pembeli']; ?>"/>
              <br />
              <div class="well">
              <div class="box-header" align="center"><strong>Alamat RS/Dinas/Puskesmas/Klinik/Dll</strong></div>
              Provinsi
     <select class="form-control" name="provinsi" id="provinsi">
     <option value="">-- Pilih Provinsi --</option>
	 <?php $q1=mysqli_query($koneksi, "select * from alamat_provinsi order by nama_provinsi ASC"); 
	 while ($row1=mysqli_fetch_array($q1)){
	 ?>
     <option <?php if ($row1['id']==$data['provinsi_id']){ echo "selected"; } ?> value="<?php echo $row1['id']; ?>"><?php echo $row1['nama_provinsi']; ?></option>
     <?php 
	 } ?>
     </select><br />
    
     Kabupaten
     <select class="form-control" name="kabupaten" id="kabupaten">
     <option value="">-- Pilih Kabupaten/Kota --</option>
     <?php $q2=mysqli_query($koneksi, "select *,alamat_kabupaten.id as idd from alamat_kabupaten INNER JOIN alamat_provinsi ON alamat_provinsi.id=alamat_kabupaten.provinsi_id order by nama_kabupaten ASC"); 
	 while ($row2=mysqli_fetch_array($q2)){
	 ?>
     <option <?php if ($row2['idd']==$data['kabupaten_id']){ echo "selected"; } ?> id="kabupaten" class="<?php echo $row2['provinsi_id']; ?>" value="<?php echo $row2['idd']; ?>"><?php echo $row2['nama_kabupaten']; ?></option>
     <?php } ?>
     </select><br />
     
     Kecamatan
     <select class="form-control" name="kecamatan" id="kecamatan">
     <option value="">-- Pilih Kecamatan --</option>
     <?php $q3=mysqli_query($koneksi, "select *,alamat_kecamatan.id as idd from alamat_kecamatan INNER JOIN alamat_kabupaten ON alamat_kabupaten.id=alamat_kecamatan.kabupaten_id order by nama_kecamatan ASC"); 
	 while ($row3=mysqli_fetch_array($q3)){
	 ?>
     <option <?php if ($row3['idd']==$data['kecamatan_id']){ echo "selected"; } ?> id="kecamatan" class="<?php echo $row3['kabupaten_id']; ?>" value="<?php echo $row3['idd']; ?>"><?php echo $row3['nama_kecamatan']; ?></option>
     <?php } ?>
     </select><br />
     <script src="jquery-1.10.2.min.js"></script>
        <script src="jquery.chained.min.js"></script>
        <script>
            $("#kabupaten").chained("#provinsi");
			$("#kecamatan").chained("#kabupaten");
			$("#kelurahan").chained("#kecamatan");
            //$("#kecamatan").chained("#kota");
        </script>
     Kelurahan
     <input class="form-control" type="text" placeholder="Kelurahan" name="kelurahan" required value="<?php echo $data['kelurahan_id']; ?>"><br />
     Alamat Jalan
     <input class="form-control" type="text" placeholder="Jl.Xxx" name="alamat" required value="<?php echo $data['jalan']; ?>"><br />
     Kontak RS/Dinas/Dll
     <input class="form-control" type="text" placeholder="Kontak" name="kontak_rs" required value="<?php echo $data['kontak_rs']; ?>"><br />
     
     </div>
     Nama Pemakai
     <input class="form-control" type="text" placeholder="Nama Pemakai" name="pemakai" required value="<?php echo $data['nama_pemakai']; ?>"><br />
     Kontak 1
     <input class="form-control" type="text" placeholder="Kontak" name="kontak" required value="<?php echo $data['kontak1_pemakai']; ?>"><br />
     Kontak 2
     <input class="form-control" type="text" placeholder="Kontak" name="kontak" required value="<?php echo $data['kontak2_pemakai']; ?>"><br />
     Email
     <input class="form-control" type="email" placeholder="XXX@xxxx.com" name="email" required value="<?php echo $data['email_pemakai']; ?>"><br />
            	<input name="lapor" type="submit" value="Simpan Perubahan" class="form-control btn btn-success"/>
            </form>
          </div>
          </div>
          <!-- /.box -->
        </div>
      <div class="col-md-7">

        <div class="box box-success"><!-- /.chat -->
            <div class="box-footer">
            <div class="box-header with-border">
              <h3 class="box-title">Detail Alkes Yang Dijual</h3>
              <span class="pull pull-right">Quantity : <?php echo $data['qty']; ?></span>
              </div><div class="box-body">
          <br />
          <table  width="100%" id="example1" class="table table-bordered table-hover">
              <thead>
  <tr>
    <th><strong>Nama Alkes</strong></th>
    <th>Merk</th>

    <th><strong>Tipe</strong></th>
    <th>No Seri</th>
    <th><strong>Harga</strong></th>
    <th><strong>Aksi</strong></th>
  </tr>
  </thead>
  <?php
  $q = mysqli_query($koneksi, "select *,barang_dijual_detail.id as idd from barang_dijual_detail,barang_dijual,barang_gudang_detail,barang_gudang where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dijual_detail.barang_gudang_detail_id and barang_dijual.id=barang_dijual_detail.barang_dijual_id and barang_dijual.id=".$_GET['id']."");
  $no=0;
  while ($d = mysqli_fetch_array($q)) {
  $no++;
  ?>
  <tr>
    <td><?php echo $d['nama_brg']; ?></td>
    <td><?php echo $d['merk_brg']; ?></td>
    <td><?php echo $d['tipe_brg']; ?></td>
    <td><?php echo $d['no_seri_brg']; ?></td>
    <td><?php echo "Rp ".number_format($d['harga_satuan'],0,',','.'); ?></td>
    <td>
    <!--<a href="index.php?page=ubah_barang_dijual2&id=<?php echo $_GET['id']; ?>&detail=<?php echo $d['idd']; ?>#open_detail"><span data-toggle="tooltip" title="Ubah" class="fa fa-edit"></span></a>&nbsp;-->
    <?php if (isset($_SESSION['user_administrator']) or isset($_SESSION['user_admin_gudang'])) { ?>
    <a href="index.php?page=ubah_barang_jual2&id=<?php echo $_GET['id']; ?>&id_hapus=<?php echo $d['idd']; ?>" onclick="return confirm('Yakin Akan Menghapus Item Ini ?')"><span data-toggle="tooltip" title="Hapus" class="fa fa-trash"></span></a>
    <?php } ?>
    </td>
  </tr>
  <?php } ?>
</table>

              
              </div>
            </div>
          </div>
          <!-- /.box --><!-- /.box -->

        </div>
        
    <!-- /.content -->
  </div>
  </section>
  </div>