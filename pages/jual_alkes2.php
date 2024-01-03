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
if (isset($_POST['simpan_rs'])) {
$insert_pembeli=mysqli_query($koneksi, "insert into pembeli values('','".$_POST['nama_pembeli']."','".$_POST['provinsi']."','".$_POST['kabupaten']."','".$_POST['kecamatan']."','".$_POST['kelurahan']."','".$_POST['alamat']."','".$_POST['kontak_rs']."')");
if ($insert_pembeli) {
	echo "<script>history.back(-1)</script>";
	}
}

if (isset($_POST['lapor'])) {
	$jml = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_dijual where no_po_jual='".$_POST['no_faktur']."'"));
	if ($jml==0) {
	mysqli_query($koneksi, "delete from barang_dijual_hash where akun_id=".$_SESSION['id']."");
	echo "<script type='text/javascript'>
		window.location='index.php?page=simpan_jual_alkes2';
		</script>";
		$_SESSION['tgl_jual']=$_POST['tgl_jual'];
		$_SESSION['pembeli']=$_POST['pembeli'];
		$_SESSION['provinsi']=$_POST['provinsi'];
		$_SESSION['kecamatan']=$_POST['kecamatan'];
		$_SESSION['kabupaten']=$_POST['kabupaten'];
		$_SESSION['kelurahan']=$_POST['kelurahan2'];
		$_SESSION['alamat']=$_POST['jalan2'];
		$_SESSION['kontak_rs']=$_POST['kontak_rs2'];
		$_SESSION['pemakai']=$_POST['pemakai'];
		$_SESSION['kontak1']=$_POST['kontak1'];
		$_SESSION['kontak2']=$_POST['kontak2'];
		$_SESSION['email']=$_POST['email'];
		$_SESSION['marketing']=$_POST['marketing'];
		$_SESSION['subdis']=str_replace("\n","<br>",$_POST['subdis']);
		$_SESSION['no_faktur']=$_POST['no_faktur'];
		$_SESSION['no_kontrak']=$_POST['no_kontrak'];
		$_SESSION['diskon']=$_POST['diskon'];
		$_SESSION['ppn']=$_POST['ppn'];
		$_SESSION['status_po']=$_POST['status_po'];
		unset($_SESSION['ongkir']);
		unset($_SESSION['diskon']);
		unset($_SESSION['ppn']);
		unset($_SESSION['pph']);
		unset($_SESSION['zakat']);
		unset($_SESSION['biaya_bank']);
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
        Jual Alkes</h1><ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Jual Alkes</li>
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
              <h3 class="box-title"><i>Isilah Data Dengan Benar</i></h3>
            </div>
          <div class="box-body">
              Tanggal Jual
              <input name="tgl_jual" type="date" class="form-control" required autofocus="autofocus"/><br />
              No PO Penjualan
              <input name="no_faktur" type="text" class="form-control" required /><br />
              No Kontrak
              <input name="no_kontrak" type="text" class="form-control" required /><br />
            Nama RS/Dinas/Puskesmas/Klinik/Dll
            <div class="input-group">
              <select name="pembeli" id="pembeli" onchange="changeValue(this.value)" required class="form-control select2" style="width:100%">
              <option value="">...</option>
					
					<?php 
					$result = mysqli_query($koneksi, "select *,pembeli.id as idd from pembeli,alamat_provinsi,alamat_kabupaten,alamat_kecamatan where alamat_provinsi.id=pembeli.provinsi_id and alamat_kabupaten.id=pembeli.kabupaten_id and alamat_kecamatan.id=pembeli.kecamatan_id order by nama_pembeli ASC");    
					$jsArray = "var dtPembeli = new Array();
";        
					while ($row = mysqli_fetch_array($result)) {    
					echo '
						<option value="' . $row['idd'] . '">' . $row['nama_pembeli'] . '&nbsp;(' .$row['kontak_rs']. ')</option>';    
						$jsArray .= "dtPembeli['" . $row['idd'] . "'] = {nama_pembeli:'".addslashes($row['nama_pembeli'])."',
							provinsi:'".addslashes($row['nama_provinsi'])."',
							provinsi_id:'".addslashes($row['provinsi_id'])."',
						kabupaten:'".addslashes($row['nama_kabupaten'])."',
						kabupaten_id:'".addslashes($row['kabupaten_id'])."',
						kecamatan:'".addslashes($row['nama_kecamatan'])."',
						kecamatan_id:'".addslashes($row['kecamatan_id'])."',
						kelurahan:'".addslashes($row['kelurahan_id'])."',
						jalan:'".addslashes(substr($row['jalan'],0,17).".....")."',
						kontak_rs:'".addslashes($row['kontak_rs'])."'
						};
";
					}      
					?>    
				</select>
                <a href="#" class="input-group-addon label-success" data-toggle="modal" data-target="#modal-tambahrs"><i class="fa fa-plus"></i></a>
                </div><br />
              <div class="well">
              <div class="box-header" align="center"><strong>Alamat RS/Dinas/Puskesmas/Klinik/Dll</strong></div>
              <input class="form-control" type="hidden" name="nama_pembeli" id="nama_pembeli">
              Provinsi
     <input class="form-control" type="text" name="provinsi2" id="provinsi2" disabled="disabled"><input class="form-control" type="hidden" name="id_provinsi" id="id_provinsi"><br />
    
     Kabupaten
     <input class="form-control" type="text" name="kabupaten2" id="kabupaten2" disabled="disabled"><input class="form-control" type="hidden" name="id_kabupaten" id="id_kabupaten"><br />
     
     Kecamatan
     <input class="form-control" type="text" name="kecamatan2" id="kecamatan2" disabled="disabled"><input class="form-control" type="hidden" name="id_kecamatan" id="id_kecamatan"><br />
     
     Kelurahan
     <input class="form-control" type="text" placeholder="" name="kelurahan2" id="kelurahan2" readonly="readonly"><br />
     Alamat Jalan
     <input class="form-control" type="text" placeholder="" name="jalan2" id="jalan2" readonly="readonly"><br />
     Kontak RS/Dinas/Dll
     <input class="form-control" type="text" placeholder="" name="kontak_rs2" required id="kontak_rs2" readonly="readonly"><br />
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
       <option value="">...</option>
       <?php $s = mysqli_query($koneksi, "select * from marketing order by nama_marketing ASC");
	 while ($d_s = mysqli_fetch_array($s)) { ?>
       <option value="<?php echo $d_s['nama_marketing']; ?>"><?php echo $d_s['nama_marketing']; ?></option>
       <?php } ?>
     </select>
     <br /><br />
     Sub Distributor
     <textarea class="form-control" name="subdis" required rows="5" placeholder="Gunakan [ENTER] untuk melainkan kalimat pertama dan kalimat berikutnya"></textarea>
     <br />
     Status PO
     <select required="required" name="status_po" class="form-control select2" style="width:100%">
       <option value="0">Belum Deal</option>
       <option value="1">Sudah Deal</option>
     </select>
     <!--
     <br />
     Diskon (%)
     <input class="form-control" type="number" placeholder="Diskon" name="diskon" required><br />
     PPN (%)
     <input class="form-control" type="number" placeholder="PPN" name="ppn" required><br />
     -->
     <br /><br />
     <input name="lapor" type="submit" value="Next" class="form-control btn btn-success"/>
            
    <script type="text/javascript">    
	<?php 
	echo $jsArray; 
	?>  
	function changeValue(pembeli){  
		document.getElementById('nama_pembeli').value = dtPembeli[pembeli].nama_pembeli;
		document.getElementById('provinsi2').value = dtPembeli[pembeli].provinsi;
		document.getElementById('id_provinsi').value = dtPembeli[pembeli].provinsi_id;
		document.getElementById('kabupaten2').value = dtPembeli[pembeli].kabupaten;
		document.getElementById('id_kabupaten').value = dtPembeli[pembeli].kabupaten_id;
		document.getElementById('kecamatan2').value = dtPembeli[pembeli].kecamatan;
		document.getElementById('id_kecamatan').value = dtPembeli[pembeli].kecamatan_id;
		document.getElementById('kelurahan2').value = dtPembeli[pembeli].kelurahan;
		document.getElementById('jalan2').value = dtPembeli[pembeli].jalan;
		document.getElementById('kontak_rs2').value = dtPembeli[pembeli].kontak_rs;
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
  
  <div class="modal fade" id="modal-tambahrs">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" align="center">Tambah Data RS/Dinas/Puskesmas/Klinik/Dll</h4>
              </div>
              <form method="post" enctype="multipart/form-data">
              <div class="modal-body">
                Nama RS/Dinas/Puskesmas/Klinik/Dll
              <input name="nama_pembeli" class="form-control" placeholder="Nama Rumah Sakit/Dinas/Dll" type="text" required="required"><br />
              <div class="well">
              <div class="box-header" align="center"><strong>Alamat RS/Dinas/Puskesmas/Klinik/Dll</strong></div>
              Provinsi
     <select class="form-control" name="provinsi" id="provinsi" required>
     <option value="">-- Pilih Provinsi --</option>
	 <?php $q1=mysqli_query($koneksi, "select * from alamat_provinsi order by nama_provinsi ASC"); 
	 while ($row1=mysqli_fetch_array($q1)){
	 ?>
     <option value="<?php echo $row1['id']; ?>"><?php echo $row1['nama_provinsi']; ?></option>
     <?php 
	 } ?>
     </select><br />
    
     Kabupaten
     <select class="form-control" name="kabupaten" id="kabupaten" required>
     <option value="">-- Pilih Kabupaten/Kota --</option>
     <?php $q2=mysqli_query($koneksi, "select *,alamat_kabupaten.id as idd from alamat_kabupaten INNER JOIN alamat_provinsi ON alamat_provinsi.id=alamat_kabupaten.provinsi_id order by nama_kabupaten ASC"); 
	 while ($row2=mysqli_fetch_array($q2)){
	 ?>
     <option id="kabupaten" class="<?php echo $row2['provinsi_id']; ?>" value="<?php echo $row2['idd']; ?>"><?php echo $row2['nama_kabupaten']; ?></option>
     <?php } ?>
     </select><br />
     
     Kecamatan
     <select class="form-control" name="kecamatan" id="kecamatan" required>
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
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success" name="simpan_rs">Simpan</button>
              </div>
              </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>