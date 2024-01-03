<?php
if (isset($_POST['tambah_spk_masuk'])) {
	/*$query_spk=mysqli_query($koneksi, "insert into barang_teknisi values('','".$_POST['tgl_spk']."','".$_POST['no_spk']."','0','','')");
	$m = mysqli_fetch_array(mysqli_query($koneksi, "select max(id) as max from barang_teknisi"));
	$max=$m['max'];
	if ($_POST['id_kirim_detail']=='') {
		$se = mysqli_query($koneksi, "select * from barang_dikirim_detail where barang_dikirim_id=".$_POST['id_po']."");
		while ($d = mysqli_fetch_array($se)) {
			$query_spk2=mysqli_query($koneksi, "insert into barang_teknisi_detail values('','$max','".$d['id']."','')");
			}
		} else {
	$query_spk2=mysqli_query($koneksi, "insert into barang_teknisi_detail values('','$max','".$_POST['id_kirim_detail']."','')"); }
	if ($query_spk and $query_spk2) {
		//$update_kirim_brg=mysqli_query($koneksi, "update barang_dikirim set status_spk=1 where id=".$_POST['id_po']."");
		echo "<script type='text/javascript'>
		alert('Data Berhasil Di Simpan !');
		window.location='index.php?page=spi';
		</script>";
		
	} else {
		echo "<script type='text/javascript'>
		alert('Gagal Disimpan !');
		</script>";
		}*/
		echo "<script type='text/javascript'>
		window.location='index.php?page=tambah_brg_demo2';
		</script>";
		$_SESSION['tgl_pinjam']=$_POST['tgl_pinjam'];
		$_SESSION['supplier']=$_POST['supplier'];
		$_SESSION['kegiatan']=str_replace("\n","<br>",$_POST['kegiatan']);
		$_SESSION['estimasi_kembali']=$_POST['estimasi_kembali'];
		$_SESSION['subdis']=$_POST['subdis'];
		$_SESSION['pic']=$_POST['pic'];
		
		$_SESSION['id_pembeli']=$_POST['pembeli'];
		mysqli_query($koneksi, "delete from barang_demo_detail_hash where akun_id=".$_SESSION['id']."");
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
        Tambah Barang Demo
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li></ol></section>


    <!-- Main content -->
    <section class="content">
    
      <!-- Small boxes (Stat box) --><!-- /.row -->
      <!-- Main row -->
      <form id="frm-mhs" name="example_form" action="" method="POST" data-validate="parsley" enctype="multipart/form-data" >
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-6 connectedSortable">
          <!-- Custom tabs (Charts with tabs)--><!-- /.nav-tabs-custom -->

          <!-- Chat box -->
          <div class="box box-success"><!-- /.chat -->
            <div class="box-footer">
            
              <div class="box-body">
              <label>Tanggal Pinjam</label>
              <input name="tgl_pinjam" type="date" class="form-control" autofocus="autofocus" required="required" <?php echo $dis; ?>/>              <br />
              <label>Supplier</label>
              <input name="supplier" type="text" class="form-control" required="required"/>
              <br />
              <label>Kegiatan</label>
              <textarea name="kegiatan" class="form-control" rows="4"></textarea>
              <br />
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
     <br />
              <label>Estimasi Barang Kembali</label>
              <input name="estimasi_kembali" type="date" class="form-control" <?php echo $dis; ?>/>                                  
              
              <br />
              <label>Subdis</label>
              <input name="subdis" type="text" class="form-control" required="required"/>
              <br />
              <label>PIC</label>
              <input name="pic" type="text" class="form-control" required="required"/>
              <br />
              
              <button name="tambah_spk_masuk" type="submit" class="btn btn-success" style="padding:8px"><span class="fa fa-plus"></span> Next </button>
              </div>
              <!--
             <select name="id_teknisi" class="form-control" required <?php echo $dis; ?>>
              <option value="">--Pilih Teknisi--</option>
              <?php 
			  $query_teknisi = mysqli_query($koneksi, "select * from tb_teknisi order by nama_teknisi ASC");
			  while ($data_t = mysqli_fetch_array($query_teknisi)) {
			  ?>
              <option value="<?php echo $data_t['id']; ?>"><?php echo $data_t['nama_teknisi']." - ".$data_t['bidang']; ?></option>
              <?php } ?>
              </select>
              -->
                    <!--<p align="center" style="margin-top:10px"><a href="index.php?page=tambah_spk_masuk#tambahTeknisi"><span class="label bg-blue">Buat Teknisi Baru</span></a></p>        
              -->
              
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
        <section class="col-lg-6 connectedSortable">
          <!-- Custom tabs (Charts with tabs)--><!-- /.nav-tabs-custom -->

          <!-- Chat box --><!-- /.box (chat box) -->

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
      <!-- /.row (main row) -->

  </section>
    <!-- /.content -->
  </div>
  
  <div id="tambahTeknisi" class="modalDialog">
     <div>
        <a href="#" title="Close" class="close">X</a>
        <h3 align="center">Tambah Teknisi Baru</h3> 
     <form method="post">
     <input name="nama_teknisi" id="input" type="text" required placeholder="Nama Teknisi"><br />
              
              <input name="bidang" id="input" type="text" placeholder="Bidang" required><br />
              <input name="no_str" id="input" placeholder="No STR" required><br />
              <input name="no_hp" id="input" type="text" placeholder="No HP" required><br />
              <input name="username" id="input" type="text" placeholder="Username" required><br />
              <input name="password" id="input" type="password" placeholder="Password" required><br />
              Ijazah
              <input name="ijazah" style="background-color:#FFF" id="input" type="file" /><br />
              Sertifikat
              <input name="sertifikat" id="input" type="file" style="background-color:#FFF"/><br />
        <button id="buttonn" name="tambahteknisibaru" type="submit">Simpan</button>
    </form>
    
    </div>
</div>
  