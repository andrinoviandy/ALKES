<!--<script language="javascript">
  function showKabupaten() {
	  
	  <?php 
	  $data_alkes = mysqli_fetch_array(mysqli_query($koneksi, "select * from aksesoris where id=".$_GET['id'].""));
	  /*
	  
	  $query1=mysqli_query($koneksi, "select * from alamat_provinsi");
	  while ($d1=mysqli_fetch_array($query1)) {
		  $prov = $d1['id'];
		  echo "if (document.form1.provinsi.value == \"".$prov."\")";
		  echo "{";
		  $query2=mysqli_query($koneksi, "select * from alamat_kabupaten where provinsi_id=$prov order by nama_kabupaten ASC");
		  $content= "document.getElementById('kabupaten').innerHTML=\"";
		  while ($d2=mysqli_fetch_array($query2)) {
			  $content.= "<option value='".$d2['id']."'>".$d2['nama_kabupaten']."</option>";
			  $idd=$d2['id']; 
			  }
			  $content.="\"";
			  echo $content;
		  echo "}\n";
		  }
	  ?>
	  }
	  
  </script>
  
  <script language="javascript">
  function showKecamatan() {
	  <?php
	  $query4 = mysqli_query($koneksi, "select * from alamat_kecamatan");
	  while ($d4=mysqli_fetch_array($query4)) {
		$kabu=$d4['id'];
		echo "if (document.form1.kabupaten.value == \"".$kabu."\")";
		echo "{";
	  $query3=mysqli_query($koneksi, "select * from alamat_kecamatan where kabupaten_id=".$kabu."");
	  $content="document.getElementById('kecamatan').innerHTML=\"";
	  while ($d3=mysqli_fetch_array($query3)) {
		  $content.= "<option value=".$d3['id'].">".$d3['nama_kecamatan']."</option>";
		  }
		  $content.="\"";
		  echo $content;
		  echo "}\n";
  } */
	  ?>
	  }
  </script>-->
<?php
if (isset($_POST['lapor'])) {
	$max_query = mysqli_fetch_array(mysqli_query($koneksi, "select max(id) as maximum from pembeli"));
	$max_pembeli = $max_query['maximum']+1;
	
	for ($j=0; $j<count($_POST['pilih']); $j++) {
		$up = mysqli_query($koneksi, "update barang_gudang_detail set status_terjual=1 where id=".$_POST['pilih'][$j]."");
		}
		
	$Result = mysqli_query($koneksi, "insert into pembeli values('$max_pembeli','".$_POST['pembeli']."','".$_POST['provinsi']."','".$_POST['kabupaten']."','".$_POST['kecamatan']."','".$_POST['kelurahan']."','".$_POST['alamat']."','".$_POST['pemakai']."','".$_POST['kontak']."','".$_POST['email']."')");		
	
	for ($k=0; $k<count($_POST['pilih']); $k++) {
	$query_barang_dijual=mysqli_query($koneksi, "insert into barang_dijual values('','".$_POST['tgl_jual']."','".$_POST['pilih'][$k]."','1','$max_pembeli')");
		}
	
	if ($Result) {
		$jml_pilih = count($_POST['pilih']);
		$update_stok=mysqli_query($koneksi, "update barang_gudang set stok=stok-$jml_pilih where id=".$_GET['id']."");
		
		echo "<script type='text/javascript'>
		alert('Alkes Berhasil Dijual !');
		window.location='index.php?page=jual_barang'
		</script>";
		} 
	else {
		echo "<script type='text/javascript'>
		alert('Data Tidak Berhasil Disimpan !');
		</script>";
		}
}
	?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Jual Aksesoris</h1><ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Jual Aksesoris</li>
      </ol>
    </section>


    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) --><!-- /.row -->
      <!-- Main row -->
      <form method="post" enctype="multipart/form-data">
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
          <!-- Custom tabs (Charts with tabs)--><!-- /.nav-tabs-custom -->

          <!-- Chat box -->
          <div class="box box-success"><!-- /.chat -->
            <div class="box-footer">
              <div class="box-body table-responsive no-padding">
              <div class="">
              <!--<a href="index.php?page=tambah_barang_masuk"><button name="tambah_laporan" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Tambah Barang</button></a>-->
              
                <table width="100%" id="" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th valign="bottom">Tgl Masuk</th>
      <th valign="bottom">Po Nomor</th>
      <th valign="bottom"><strong>Nama Aksesoris</strong></th>
      <th valign="bottom"><strong>Tipe</strong></th>
      <th valign="bottom">Merk</th>
      <th valign="bottom"><strong>Deskripsi Alat</strong></th>
      <th valign="bottom">Stok</th>
      </tr>
  </thead>
  <?php

	?> 
  <tr>
    <td><?php echo date("d M Y",strtotime($data_alkes['tgl_masuk_akse'])); ?></td>
    <td><?php echo $data_alkes['no_po_akse']; ?></td>
    <td><?php echo $data_alkes['nama_akse']; ?></td>
    <td><?php echo $data_alkes['tipe_akse']; ?></td>
    <td><?php echo $data_alkes['merk_akse']; ?></td>
    <td><?php echo $data_alkes['deskripsi_akse']; ?></td>
    <td bgcolor="#00FF00"><?php echo $data_alkes['stok_akse']; ?></td>
    </tr>
</table><br />
                <br />
                <table width="100%" id="" class="table table-bordered table-hover">
  <thead>
    <tr>
      <td align="center" valign="bottom"><strong>Data Alkes Ke-</strong></td>
      
      <td align="center" valign="bottom"><strong>No. Bath      
      </strong></td>
      <td align="center" valign="bottom"><strong>No. Lot     
      </strong></td>
      <td align="center" valign="bottom"><strong>No. Seri</strong></td>
      <td align="center" valign="bottom"><strong>Pilih</strong></td>
      </tr>
  </thead>
  <?php
  $q_detail = mysqli_query($koneksi, "select * from barang_gudang_detail where barang_gudang_id=".$_GET['id'].""); 
  $i=0;
  while ($data_detail = mysqli_fetch_array($q_detail)) {
	  $i++;
	  if ($data_detail['status_terjual']==0) {
		  $bg ="#00FF00";
		  }
  ?>
  
  <tr>
    <td align="center" bgcolor="<?php echo $bg; ?>"><b><?php echo $i; ?></b></td>
    
    <td align="center"><?php echo $data_detail['no_bath']; ?></td>
    <td align="center"><?php echo $data_detail['no_lot']; ?></td>
    <td align="center"><?php echo $data_detail['no_seri_brg']; ?></td>
    <td align="center">
    <?php if ($data_detail['status_terjual']==0) { ?>
    <input style="height:20px; width:20px" type="checkbox" class="minimal" name="pilih[]" value="<?php echo $data_detail['id']; ?>">
    <?php } else {
		echo "Sudah Terjual";
		} ?>
    </td>
    </tr>
  <?php } ?>
  <script type="text/javascript">    
	<?php 
	echo $jsArray; 
	?>  
	function changeValue(id_akse){  
		document.getElementById('tipe_akse').value = dtBrg[id_akse].tipe_akse; 
		document.getElementById('merk_akse').value = dtBrg[id_akse].merk_akse;
		document.getElementById('no_akse').value = dtBrg[id_akse].no_akse;
		
	};  
</script>
</table>
</div>
              </div>
            </div>
          </div>
          <!-- /.box (chat box) -->

          <!-- TO DO List --><!-- /.box -->

        <!-- quick email widget --></section>
        </div>
<div class="row">
<div class="col-md-12"><!-- /.box -->

          <!-- iCheck -->
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Data Pembeli</h3>
            </div>
          <div class="box-body">
          	
              Tanggal Jual
              <input name="tgl_jual" type="date" class="form-control" required autofocus="autofocus"/><br />
             
            Nama RS/Dinas/Puskesmas/Klinik/Dll
              <input name="pembeli" class="form-control" placeholder="Nama Rumah Sakit/Dinas/Dll" type="text"><br />
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
     <option value="">-- Pilih Kabupaten/Kota --</option>
     <?php $q2=mysqli_query($koneksi, "select *,alamat_kabupaten.id as idd from alamat_kabupaten INNER JOIN alamat_provinsi ON alamat_provinsi.id=alamat_kabupaten.provinsi_id order by nama_kabupaten ASC"); 
	 while ($row2=mysqli_fetch_array($q2)){
	 ?>
     <option id="kabupaten" class="<?php echo $row2['provinsi_id']; ?>" value="<?php echo $row2['idd']; ?>"><?php echo $row2['nama_kabupaten']; ?></option>
     <?php } ?>
     </select><br />
     
     Kecamatan
     <select class="form-control" name="kecamatan" id="kecamatan">
     <option value="">-- Pilih Kecamatan --</option>
     <?php $q3=mysqli_query($koneksi, "select *,alamat_kecamatan.id as idd from alamat_kecamatan INNER JOIN alamat_kabupaten ON alamat_kabupaten.id=alamat_kecamatan.kabupaten_id order by nama_kecamatan ASC"); 
	 while ($row3=mysqli_fetch_array($q3)){
	 ?>
     <option id="kecamatan" class="<?php echo $row3['kabupaten_id']; ?>" value="<?php echo $row3['idd']; ?>"><?php echo $row3['nama_kecamatan']; ?></option>
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
     <input class="form-control" type="text" placeholder="Kelurahan" name="kelurahan" required><br />
     Alamat Jalan
     <input class="form-control" type="text" placeholder="Jl.Xxx" name="alamat" required><br />
     
     </div>
     Nama Pemakai
     <input class="form-control" type="text" placeholder="Nama Pemakai" name="pemakai" required><br />
     Kontak
     <input class="form-control" type="text" placeholder="Kontak" name="kontak" required><br />
     Email
     <input class="form-control" type="email" placeholder="XXX@xxxx.com" name="email" required><br />
            
            	<input name="lapor" type="submit" value="Jual Alkes" class="form-control btn btn-success"/>
            
            
          </div>
          </div>
          <!-- /.box -->
        </div>

<!-- /.content -->
  </div>
  </form>
  </section>
  </div>
  
  