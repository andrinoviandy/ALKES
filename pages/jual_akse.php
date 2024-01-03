<!--<script language="javascript">
  function showKabupaten() {
	  
	  <?php /*
	  
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
	$jml = mysqli_num_rows(mysqli_query($koneksi, "select * from aksesoris_jual where no_po_jual_akse='".$_POST['no_faktur_akse']."'"));
	if ($jml==0 or $_POST['no_faktur_akse']=='') {
	echo "<script type='text/javascript'>
		window.location='index.php?page=simpan_jual_akse';
		</script>";
		$_SESSION['tgl_jual']=$_POST['tgl_jual'];
		$_SESSION['no_faktur']=$_POST['no_faktur_akse'];
		$_SESSION['pembeli']=$_POST['pembeli'];
		$_SESSION['provinsi']=$_POST['provinsi'];
		$_SESSION['kecamatan']=$_POST['kecamatan'];
		$_SESSION['kabupaten']=$_POST['kabupaten'];
		$_SESSION['kelurahan']=$_POST['kelurahan'];
		$_SESSION['alamat']=$_POST['jalan'];
		$_SESSION['kontak_rs']=$_POST['kontak_rs'];
		$_SESSION['marketing']=$_POST['marketing'];
		$_SESSION['subdis']=$_POST['subdis'];
		$_SESSION['diskon']=$_POST['diskon'];
		$_SESSION['ppn']=$_POST['ppn'];
		$_SESSION['biaya_pengiriman']=$_POST['biaya_pengiriman'];
	} else {
		echo "<script type='text/javascript'>
		alert('Maaf NO PO sudah ada !');
		history.back();
		</script>";
		}
}
	?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Jual Aksesoris Alkes</h1><ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Jual Aksesoris</li>
      </ol>
    </section>


    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) --><!-- /.row -->
      <!-- Main row -->
      <form method="post" id="form_combo" enctype="multipart/form-data">
      
<div class="row">
<div class="col-md-6"><!-- /.box -->

          <!-- iCheck -->
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Data Pembeli</h3>
            </div>
          <div class="box-body">
              Tanggal Jual
              <div class="input-group col-sm-1">
              <input name="tgl_jual" class="form-control" placeholder="" type="date" required="required" autofocus="autofocus">
        </div><br />
              No PO Penjualan
              <input name="no_faktur_akse" type="text" class="form-control" /><br />
            Nama RS/Dinas/Puskesmas/Klinik/Dll
              <div class="form-group">
              <select name="pembeli" id="pembeli" onchange="changeValue(this.value)" required class="form-control select2" style="width:100%">
					<option value="">-- Pilih Alkes --</option>
					<?php 
					$result = mysqli_query($koneksi, "select *,pembeli.id as idd from pembeli,alamat_provinsi,alamat_kabupaten,alamat_kecamatan where alamat_provinsi.id=pembeli.provinsi_id and alamat_kabupaten.id=pembeli.kabupaten_id and alamat_kecamatan.id=pembeli.kecamatan_id group by nama_pembeli order by nama_pembeli ASC");    
					$jsArray = "var dtPembeli = new Array();
";        
					while ($row = mysqli_fetch_array($result)) {    
					echo '
						<option value="' . $row['idd'] . '">' . $row['nama_pembeli'] . '</option>';    
						$jsArray .= "dtPembeli['" . $row['idd'] . "'] = {nama_pembeli:'".addslashes($row['nama_pembeli'])."',
							provinsi:'".addslashes($row['nama_provinsi'])."',
							provinsi_id:'".addslashes($row['provinsi_id'])."',
						kabupaten:'".addslashes($row['nama_kabupaten'])."',
						kabupaten_id:'".addslashes($row['kabupaten_id'])."',
						kecamatan:'".addslashes($row['nama_kecamatan'])."',
						kecamatan_id:'".addslashes($row['kecamatan_id'])."',
						kelurahan:'".addslashes($row['kelurahan_id'])."',
						jalan:'".addslashes(substr($row['jalan'],0,15)."...")."',
						kontak_rs:'".addslashes($row['kontak_rs'])."'
						};
";
					}      
					?>    
				</select></div><br />
              <div class="well">
              <div class="box-header" align="center"><strong>Alamat RS/Dinas/Puskesmas/Klinik/Dll</strong></div>
              <input class="form-control" type="hidden" name="nama_pembeli" id="nama_pembeli">
              Provinsi
     <input class="form-control" type="text" name="provinsi" id="provinsi" disabled="disabled"><input class="form-control" type="hidden" name="id_provinsi" id="id_provinsi"><br />
    
     Kabupaten
     <input class="form-control" type="text" name="kabupaten" id="kabupaten" disabled="disabled"><input class="form-control" type="hidden" name="id_kabupaten" id="id_kabupaten"><br />
     
     Kecamatan
     <input class="form-control" type="text" name="kecamatan" id="kecamatan" disabled="disabled"><input class="form-control" type="hidden" name="id_kecamatan" id="id_kecamatan"><br />
     
     Kelurahan
     <input class="form-control" type="text" placeholder="" name="kelurahan" id="kelurahan" readonly="readonly"><br />
     Alamat Jalan
     <input class="form-control" type="text" placeholder="" name="jalan" id="jalan" readonly="readonly"><br />
     Kontak RS/Dinas/Dll
     <input class="form-control" type="text" placeholder="" name="kontak_rs" required id="kontak_rs" readonly="readonly"><br />
     </div>
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
     Biaya Pengiriman
     <input class="form-control" type="text" placeholder="Biaya Pengiriman" name="biaya_pengiriman" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);"><br />
     <input name="lapor" type="submit" value="Jual Aksesoris" class="form-control btn btn-success"/>
            
    <script type="text/javascript">    
	<?php 
	echo $jsArray; 
	?>  
	function changeValue(pembeli){  
		document.getElementById('nama_pembeli').value = dtPembeli[pembeli].nama_pembeli;
		document.getElementById('provinsi').value = dtPembeli[pembeli].provinsi;
		document.getElementById('id_provinsi').value = dtPembeli[pembeli].provinsi_id;
		document.getElementById('kabupaten').value = dtPembeli[pembeli].kabupaten;
		document.getElementById('id_kabupaten').value = dtPembeli[pembeli].kabupaten_id;
		document.getElementById('kecamatan').value = dtPembeli[pembeli].kecamatan;
		document.getElementById('id_kecamatan').value = dtPembeli[pembeli].kecamatan_id;
		document.getElementById('kelurahan').value = dtPembeli[pembeli].kelurahan;
		document.getElementById('jalan').value = dtPembeli[pembeli].jalan;
		document.getElementById('kontak_rs').value = dtPembeli[pembeli].kontak_rs;
	};  
</script>
          </div>
          </div>
          <!-- /.box -->
        </div>

<!-- /.content -->
  </div>
  </form>
  </section>
  </div>
  
  