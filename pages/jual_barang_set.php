<script type="text/javascript">
	function run(){
		var cb = document.getElementById("cb");
 
		if(document.getElementById("cekbox").checked == false){
			cb.disabled = true;
		}else{
			cb.disabled = false;
		}
 
	}
	</script>
<!--<script language="javascript">
  function showKabupaten() {
	  
	  <?php 
	  $data_alkes = mysqli_fetch_array(mysqli_query($koneksi, "select * from barang_gudang where id=".$_GET['id'].""));
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
	mysqli_query($koneksi, "delete from barang_dijual_qty_set_hash where akun_id=".$_SESSION['id']."");
		echo "<script type='text/javascript'>
		window.location='index.php?page=simpan_jual_barang_set';
		</script>";
		$_SESSION['tgl_jual']=$_POST['tgl_jual'];
		$_SESSION['pembeli']=$_POST['pembeli'];
		$_SESSION['provinsi']=$_POST['provinsi'];
		$_SESSION['kecamatan']=$_POST['kecamatan'];
		$_SESSION['kabupaten']=$_POST['kabupaten'];
		$_SESSION['kelurahan']=$_POST['kelurahan'];
		$_SESSION['alamat']=$_POST['alamat'];
		$_SESSION['kontak_rs']=$_POST['kontak_rs'];
		$_SESSION['pemakai']=$_POST['pemakai'];
		$_SESSION['kontak1']=$_POST['kontak1'];
		$_SESSION['kontak2']=$_POST['kontak2'];
		$_SESSION['email']=$_POST['email'];
		$_SESSION['marketing']=$_POST['marketing'];
		$_SESSION['subdis']=$_POST['subdis'];
		$_SESSION['no_faktur']=$_POST['no_faktur'];
		$_SESSION['diskon']=$_POST['diskon'];
		$_SESSION['ppn']=$_POST['ppn'];
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
      <form method="post" enctype="multipart/form-data">
      
<div class="row">
<div class="col-md-6"><!-- /.box -->

          <!-- iCheck -->
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title"><i>Isilah Data Dengan Benar</i></h3>
            </div>
          <div class="box-body">
          	
              Tanggal Jual
              <input name="tgl_jual" type="date" class="form-control" required autofocus="autofocus"/><br />
             No Faktur Penjualan
              <input name="no_faktur" type="text" class="form-control" required /><br />
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
     Kontak RS/Dinas/Dll
     <input class="form-control" type="text" placeholder="" name="kontak_rs" required><br />
     
     </div>
     Nama Pemakai
     <input class="form-control" type="text" placeholder="Nama Pemakai" name="pemakai" required><br />
     Kontak 1 (Pemakai)
     <input class="form-control" type="text" placeholder="Kontak 1" name="kontak1" required><br />
     Kontak 2 (Pemakai)
     <input class="form-control" type="text" placeholder="Kontak 2" name="kontak2" required><br />
     Email (Pemakai)
     <input class="form-control" type="email" placeholder="XXX@xxxx.com" name="email"><br />
     Marketing
     <select required="required" name="marketing" class="form-control select2" style="width:100%">
       <option value="">-- Pilih --</option>
       <?php $s = mysqli_query($koneksi, "select * from marketing order by nama_marketing ASC");
	 while ($d_s = mysqli_fetch_array($s)) { ?>
       <option value="<?php echo $d_s['nama_marketing']; ?>"><?php echo $d_s['nama_marketing']; ?></option>
       <?php } ?>
     </select>
     <br /><br />
     Sub Distributor
     <input class="form-control" type="text" placeholder="Sub Distributor" name="subdis" required><br />
     Diskon (%)
     <input class="form-control" type="text" placeholder="Diskon" name="diskon" required><br />
     PPN (%)
     <input class="form-control" type="text" placeholder="PPN" name="ppn" required><br />
            
            	<input name="lapor" type="submit" value="Next" class="form-control btn btn-success" id=""/>
            
            
          </div>
          </div>
          <!-- /.box -->
        </div>

<!-- /.content -->
  </div>
  </form>
  </section>
  </div>
  
  