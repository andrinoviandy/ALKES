<?php
if (isset($_POST['lapor'])) {
	$stok=mysqli_fetch_array(mysqli_query($koneksi, "select stok from barang_gudang where id=".$_GET['id'].""));
	if ($_POST['qty']<=$stok['stok']) { 
	$simpan_pembeli = mysqli_query($koneksi, "insert into barang_dijual values('','".$_GET['id']."','".$_POST['qty']."', '".$_POST['tgl_jual']."', '".$_POST['pembeli']."', '".$_POST['provinsi']."', '".$_POST['kabupaten']."', '".$_POST['kecamatan']."', '".$_POST['kelurahan']."', '".$_POST['kontak']."','".$_POST['email']."')");
	if ($simpan_pembeli) {
		$kurang_stok=mysqli_query($koneksi, "update barang_gudang set stok=stok-$_POST[qty] where id=".$_GET['id']."");
		if ($kurang_stok) {
		echo "<script type='text/javascript'>
		alert('Alkes Berhasil Dijual !');
		window.location='index.php?page=jual_barang'
		</script>";
			}
		}
	} else {
		echo "<script type='text/javascript'>
		alert('Stok Tidak Cukup !');
		</script>";
		}
}
	?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Jual Alkes</h1><ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Jual Alkes</li>
      </ol>
    </section>


    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) --><!-- /.row -->
      <!-- Main row -->
<div class="row">
<div class="col-md-6"><!-- /.box -->

          <!-- iCheck -->
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Data Pembeli</h3>
            </div>
          <div class="box-body">
          	<form method="post" data-validate="parsley" enctype="multipart/form-data">
              Tanggal Jual
              <input name="tgl_jual" type="date" class="form-control" required autofocus="autofocus"/><br />
            Nama RS/Dinas/Puskesmas/Klinik/Dll
              <input name="pembeli" class="form-control" placeholder="Nama Rumah Sakit/Dinas/Dll" type="text" value="<?php echo $data['nama_brg']; ?>"><br />
              <div class="well">
              <div class="box-header" align="center"><strong>Alamat RS/Dinas/Puskesmas/Klinik/Dll</strong></div>
              Provinsi
     <select class="form-control" name="provinsi" id="provinsi">
     <option value="">-- Pilih Provinsi --</option>
	 <?php $q1=mysqli_query($koneksi, "select * from alamat_provinsi order by nama_provinsi ASC"); 
	 while ($row1=mysqli_fetch_array($q1)){
	 ?>
     <option value="<?php echo $row1['id']; ?>"><?php echo $row1['nama_provinsi']; ?></option>
     <?php 
	 } ?>
     </select><br />
    
     Kabupaten
     <select class="form-control" name="kabupaten" id="kabupaten">
     <option value="">-- Pilih Provinsi --</option>
     <?php $q2=mysqli_query($koneksi, "select *,alamat_kabupaten.id as idd from alamat_kabupaten INNER JOIN alamat_provinsi ON alamat_provinsi.id=alamat_kabupaten.provinsi_id order by nama_kabupaten ASC"); 
	 while ($row2=mysqli_fetch_array($q2)){
	 ?>
     <option id="kabupaten" class="<?php echo $row2['provinsi_id']; ?>" value="<?php echo $row2['idd']; ?>"><?php echo $row2['nama_kabupaten']; ?></option>
     <?php } ?>
     </select><br />
     
     Kecamatan
     <select class="form-control" name="kecamatan" id="kecamatan">
     <option value="">-- Pilih Provinsi --</option>
     <?php $q3=mysqli_query($koneksi, "select *,alamat_kecamatan.id as idd from alamat_kecamatan INNER JOIN alamat_kabupaten ON alamat_kabupaten.id=alamat_kecamatan.kabupaten_id order by nama_kecamatan ASC"); 
	 while ($row3=mysqli_fetch_array($q3)){
	 ?>
     <option id="kecamatan" class="<?php echo $row3['kabupaten_id']; ?>" value="<?php echo $row3['idd']; ?>"><?php echo $row3['nama_kecamatan']; ?></option>
     <?php } ?>
     </select><br />
      Kelurahan
     <select class="form-control" name="kelurahan" id="kelurahan">
     <option value="">-- Pilih Provinsi --</option>
     <?php $q4=mysqli_query($koneksi, "select kecamatan_id,nama_kelurahan,alamat_kelurahan.id as idd from alamat_kelurahan INNER JOIN alamat_kecamatan ON alamat_kecamatan.id=alamat_kelurahan.kecamatan_id order by nama_kelurahan ASC"); 
	 while ($row4=mysqli_fetch_array($q4)){
	 ?>
     <option id="kelurahan" class="<?php echo $row4['kecamatan_id']; ?>" value="<?php echo $row4['idd']; ?>"><?php echo $row4['nama_kelurahan']; ?></option>
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
     Alamat Jalan
     <input class="form-control" type="text" placeholder="Jl.Xxx" name="alamat" required><br />
     Kontak
     <input class="form-control" type="text" placeholder="Kontak" name="kontak" required><br />
     Email
     <input class="form-control" type="email" placeholder="XXX@xxxx.com" name="email" required><br />
     </div>
     Quantity
     <input class="form-control" type="text" placeholder="Quantity" name="qty" required><br />
            
            	<input name="lapor" type="submit" value="Jual Alkes" class="form-control btn btn-success"/>
            </form>
            
          </div>
          </div>
          <!-- /.box -->
        </div>
      <div class="col-md-6">

        <div class="box box-success">
          <div class="box-header with-border">
              <h3 class="box-title">Data Alkes</h3>
          </div>
          	<div class="box-body">
            <?php 
			$data = mysqli_fetch_array(mysqli_query($koneksi,"select * from barang_gudang where id=".$_GET['id'].""));
			?>
          	<pre style="font-family:'Arial Black', Gadget, sans-serif">
            
     Nama Alkes			: <?php echo $data['nama_brg']; ?>
            
            
     Merk					: <?php echo $data['merk_brg']; ?>
            
            
     Tipe					: <?php echo $data['tipe_brg']; ?>
            
            
     Nomor Ijin Edar (NIE)	: <?php echo $data['nie_brg']; ?>
            
            
     Negara Asal			: <?php echo $data['negara_asal']; ?>
            
            
     Stok					: <?php echo $data['stok']; ?>
            
          	</pre>
          	</div>
          </div>
          <!-- /.box --><!-- /.box -->

        </div>
        
    <!-- /.content -->
  </div>
  </section>
  </div>
  <script language="javascript">
  function showKabupaten() {
	  
	  <?php 
	  $query1=mysqli_query($koneksi, "select * from alamat_provinsi");
	  while ($d1=mysqli_fetch_array($query1)) {
		  $prov = $d1['id'];
		  echo "if (document.form1.provinsi == \"".$prov."\")";
		  echo "{";
		  $query2=mysqli_query($koneksi, "select * from alamat_kabupaten where provinsi_id='$prov' order by nama_kabupaten ASC");
		  $content= "document.getElementById('kabupaten').innerHTML=\"";
		  while ($d2=mysqli_fetch_array($query2)) {
			  $content.= "<option value='".$d2['id']."'>".$d2['nama_kabupaten']."</option>"; 
			  }
			  $content.="\"";
			  echo 
		  echo "}";
		  }
	  ?>
	  
	  }
  </script>
  