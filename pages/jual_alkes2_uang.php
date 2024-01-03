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
	mysqli_query($koneksi, "delete from barang_dijual_hash where akun_id=".$_SESSION['id']."");
	echo "<script type='text/javascript'>
		window.location='index.php?page=simpan_jual_alkes2';
		</script>";
		$_SESSION['tgl_jual']=$_POST['tgl_jual'];
		$_SESSION['pembeli']=$_POST['pembeli'];
		$_SESSION['provinsi']=$_POST['provinsi'];
		$_SESSION['kecamatan']=$_POST['kecamatan'];
		$_SESSION['kabupaten']=$_POST['kabupaten'];
		$_SESSION['kelurahan']=$_POST['kelurahan'];
		$_SESSION['alamat']=$_POST['jalan'];
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
              No Faktur Penjualan
              <input name="no_faktur" type="text" class="form-control" required /><br />
            Nama RS/Dinas/Puskesmas/Klinik/Dll
              <select name="pembeli" id="pembeli" onchange="changeValue(this.value)" required class="form-control">
					<option value="">-- Pilih --</option>
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
						jalan:'".addslashes($row['jalan'])."',
						kontak_rs:'".addslashes($row['kontak_rs'])."'
						};
";
					}      
					?>    
				</select><br />
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
     Nama Pemakai
     <input class="form-control" type="text" placeholder="Nama Pemakai" name="pemakai" required><br />
     Kontak 1 (Pemakai)
     <input class="form-control" type="text" placeholder="Kontak 1" name="kontak1" required><br />
     Kontak 2 (Pemakai)
     <input class="form-control" type="text" placeholder="Kontak 2" name="kontak2" required><br />
     Email (Pemakai)
     <input class="form-control" type="email" placeholder="XXX@xxxx.com" name="email"><br />
     Marketing
     <input class="form-control" type="text" placeholder="Marketing" name="marketing" required><br />
     Sub Distributor
     <input class="form-control" type="text" placeholder="Sub Distributor" name="subdis" required><br />
     Diskon (%)
     <input class="form-control" type="text" placeholder="Diskon" name="diskon" required><br />
     PPN (%)
     <input class="form-control" type="text" placeholder="PPN" name="ppn" required><br />
            
            	
            
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
        
        <div class="col-md-6"><!-- /.box -->

          <!-- iCheck -->
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title"><i>Catat Sebagai Piutang</i></h3>
            </div>
          <div class="box-body">
          <input type="radio" onclick="javascript:yesnoPiutang();" name="yesnopiutang" id="noPiutang" style="height:20px; width:20px" checked="checked"><label>&nbsp;&nbsp;Tidak</label><br />
              <input type="radio" onclick="javascript:yesnoPiutang();" name="yesnopiutang" id="yesPiutang" style="height:20px; width:20px"><label>&nbsp;&nbsp;Ya</label><br /><br />
              <div id="ifYesPiutang" style="display:none">
              <label>Tanggal</label>
              <input name="tgl_input" class="form-control" type="date" placeholder=""><br />
              <label>Tidak Ada Jatuh Tempo</label>
              <input type="radio" onclick="javascript:yesnoCheck();" name="yesno" id="noCheck" style="height:20px; width:20px" checked="checked">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label>Jatuh Tempo</label>
              <input type="radio" onclick="javascript:yesnoCheck();" name="yesno" id="yesCheck" style="height:20px; width:20px"><br />
              <div id="ifYes" style="display:none">
              <label>Tanggal Jatuh Tempo</label>
              <input name="jatuh_tempo" type="date" class="form-control" placeholder="" value=""><br />
              </div>
              <br /> 
              <label>Nominal</label>
              <input name="nominal" class="form-control" type="text" placeholder="Otomatis Akan Terakumulasi Setelah Memilih Alkes Setelah Halaman Ini" disabled="disabled" value=""><br />
              <label>Klien</label>
              <input name="klien" id="klien" class="form-control" type="text" placeholder="" value="" ><br />
              <label>Deskripsi</label>
              <textarea name="deskripsi" class="form-control" rows="4"></textarea><br />
              <label>Kategori</label>
              <select name="kategori" id="kategori" class="form-control">
    <option value="">-- Pilih --</option>
    <?php 
	$q_seri = mysqli_query($koneksi, "select * from kategori_buku_kas where utang_piutang='Hutang' order by no_kategori ASC");
	while ($d_seri=mysqli_fetch_array($q_seri)) {
	?>
    <option value="<?php echo $d_seri['id']; ?>" class=""><?php echo $d_seri['no_kategori']." | &nbsp;&nbsp;".$d_seri['nama_kategori']; ?></option>
    <?php } ?>
    </select><br /></div>
              <!--
              <label>Akun</label>
              <select name="akun" id="akun" class="form-control" required>
              <option value="">-- Pilih --</option>
              <?php
              $q = mysqli_query($koneksi, "select * from coa order by nama_akun ASC");
			  while ($d=mysqli_fetch_array($q)) {
			  ?>
              <option value="<?php echo $d['id']; ?>"><?php echo $d['nama_akun']; ?></option>
              <?php } ?>
              </select><br />
              <label>Jenis</label>
              <select name="jenis_akun" id="jenis_akun" class="form-control" required>
    <option value="">--Jenis--</option>
    <?php 
	$q_seri = mysqli_query($koneksi, "select *,coa_detail.id as idd,coa_detail.nama_akun as nama from coa_detail INNER JOIN coa ON coa.id=coa_detail.coa_id order by coa_detail.nama_akun ASC");
	while ($d_seri=mysqli_fetch_array($q_seri)) {
	?>
    <option id="jenis_akun" value="<?php echo $d_seri['idd']; ?>" class="<?php echo $d_seri['coa_id']; ?>"><?php echo $d_seri['nama']; ?></option>
    <?php } ?>
    </select>
              <script src="jquery-1.10.2.min.js"></script>
        <script src="jquery.chained.min.js"></script>
        <script>
            $("#jenis_akun").chained("#akun");
        </script>
        -->
              
              <input name="lapor" type="submit" value="Next" class="form-control btn btn-success"/>
        
            
    <script type="text/javascript">
	function yesnoCheck() {

    if (document.getElementById('yesCheck').checked) {

        document.getElementById('ifYes').style.display = 'block';

    }

    else document.getElementById('ifYes').style.display = 'none';

}  
function yesnoPiutang() {

    if (document.getElementById('yesPiutang').checked) {

        document.getElementById('ifYesPiutang').style.display = 'block';

    }

    else document.getElementById('ifYesPiutang').style.display = 'none';

}    
	<?php 
	echo $jsArray; 
	?>  
	function changeValue(pembeli){  
		document.getElementById('nama_pembeli').value = dtPembeli[pembeli].nama_pembeli;
		document.getElementById('klien').value = dtPembeli[pembeli].nama_pembeli;
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
  
  