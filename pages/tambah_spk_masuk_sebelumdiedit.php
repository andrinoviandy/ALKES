<?php
if (isset($_POST['tambah_spk_masuk'])) {
	$query_spk=mysqli_query($koneksi, "insert into barang_teknisi values('','".$_POST['tgl_spk']."','".$_POST['no_spk']."','0','','')");
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
        Tambah SPI
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="index.php?page=barang_masuk">Surat Perintah Instalasi</a></li>
        <li class="active">Tambah</li></ol></section>


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
            <div class="box-header with-border">
              <h3 class="box-title">Tanggal SPI</h3>
            </div>
              <div class="box-body">
              <input name="tgl_spk" type="date" class="form-control" autofocus="autofocus" required="required" <?php echo $dis; ?>/>                                  
              </div>
            <div class="box-header with-border">
              <h3 class="box-title">No SPI</h3>
            </div>
              <div class="box-body">
              <input name="no_spk" type="text" class="form-control" required="required" <?php echo $dis; ?>/>
              <br />
              <button name="tambah_spk_masuk" type="submit" class="btn btn-success" style="padding:8px"><span class="fa fa-plus"></span> Next </button>
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
          </div>
          <div class="box box-success"><!-- /.chat -->
            <div class="box-footer">
            <div class="box-header with-border">
              <h3 class="box-title">Data Alkes</h3>
            </div>
              <div class="box-body">
              <select name="id_po" id="id_po" onchange="changeValue(this.value)" required class="form-control" <?php echo $dis; ?>>
					<option value="">-- Pilih PO --</option>
					<?php 
					$result = mysqli_query($koneksi, "select *,barang_dikirim.id as idd from barang_dikirim,barang_dikirim_detail, barang_dijual,barang_dijual_detail, barang_gudang,barang_gudang_detail, pembeli, alamat_provinsi, alamat_kabupaten, alamat_kecamatan,pemakai where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dijual_detail.barang_gudang_detail_id and barang_dijual.id=barang_dijual_detail.barang_dijual_id and barang_dijual_detail.id=barang_dikirim_detail.barang_dijual_detail_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and pembeli.id=barang_dijual.pembeli_id and pemakai.id=barang_dijual.pemakai_id and alamat_provinsi.id=pembeli.provinsi_id and alamat_kabupaten.id=pembeli.kabupaten_id and alamat_kecamatan.id=pembeli.kecamatan_id and tgl_sampai!='0000-00-00' group by no_pengiriman order by po_no ASC");    
					$jsArray = "var dtBrg = new Array();
";        
					while ($row = mysqli_fetch_array($result)) {    
					echo '
						<option value="' . $row['idd'] . '"> No PO : ' . $row['po_no'] . '   /   Tanggal Kirim : '.date("d-m-Y",strtotime($row['tgl_kirim'])).'</option>';    
						$jsArray .= "dtBrg['" . $row['idd'] . "'] = {nama_pembeli:'".addslashes($row['nama_pembeli'])."',
						provinsi:'".addslashes($row['nama_provinsi'])."',
						kabupaten:'".addslashes($row['nama_kabupaten'])."',
						kecamatan:'".addslashes($row['nama_kecamatan'])."',
						kelurahan:'".addslashes($row['kelurahan_id'])."',
						jalan:'".addslashes($row['jalan'])."',
						kontak_rs:'".addslashes($row['kontak_rs'])."',
						nama_pemakai:'".addslashes($row['nama_pemakai'])."',
						kontak1:'".addslashes($row['kontak1_pemakai'])."',
						kontak2:'".addslashes($row['kontak2_pemakai'])."',
						email:'".addslashes($row['email_pemakai'])."'
						};
";    
					}      
					?>    
				</select>
                <br />
                <select name="id_kirim_detail" id="id_kirim_detail" class="form-control">
    <option value="">--Semua Alkes Dengan No PO Di Atas--</option>
    
    <?php 
	$q_seri = mysqli_query($koneksi, "select *,barang_dikirim_detail.id as idd from barang_dikirim_detail INNER JOIN barang_dikirim ON barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id");
	while ($d_seri=mysqli_fetch_array($q_seri)) {
	?>
    <option id="id_kirim_detail" value="<?php echo $d_seri['idd']; ?>" class="<?php echo $d_seri['barang_dikirim_id']; ?>">
	<?php 
	$sel = mysqli_fetch_array(mysqli_query($koneksi, "select *,barang_dijual_detail.id as idd from barang_dijual_detail,barang_gudang,barang_gudang_detail where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dijual_detail.barang_gudang_detail_id and barang_dijual_detail.id=".$d_seri['barang_dijual_detail_id'].""));
	echo $sel['nama_brg']." / No Seri : ".$sel['no_seri_brg']; ?></option>
    <?php } ?>
    </select>
    <script src="jquery-1.10.2.min.js"></script>
        <script src="jquery.chained.min.js"></script>
        <script>
            $("#id_kirim_detail").chained("#id_po");
        </script>
              
              
              <br />
              <button name="tambah_spk_masuk" type="submit" value="Simpan" class="btn btn-success" style="padding:20px"><span class="fa fa-plus"></span> Simpan </button>
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
        <section class="col-lg-6 connectedSortable">
          <!-- Custom tabs (Charts with tabs)--><!-- /.nav-tabs-custom -->

          <!-- Chat box -->
          <div class="box box-success"><!-- /.chat -->
            <div class="box-footer">
            <div class="box-header with-border">
              <h3 class="box-title">Data Dinas/Puskesmas/Klinik/dll</h3></div><div class="box-body">
              Nama Dinas/RS/Puskesmas/Klinik/Dll
              <input name="pembeli" id="pembeli" class="form-control" type="text" placeholder="Nama Rumah Sakit/Dinas/Puskesmas/Klinik/dll" disabled="disabled"/>
              <br />
              
              Provinsi
     <input name="provinsi" id="provinsi" class="form-control" type="text" placeholder="Provinsi" disabled="disabled"><br />
    
     Kabupaten
      <input name="kabupaten" id="kabupaten" class="form-control" type="text" placeholder="Kabupaten" disabled="disabled"><br />
     
     Kecamatan
     <input name="kecamatan" id="kecamatan" class="form-control" type="text" placeholder="Kecamatan" disabled="disabled"><br />
     
     Kelurahan
     <input name="kelurahan" id="kelurahan" class="form-control" type="text" placeholder="kelurahan" disabled="disabled"><br />
     
     Jalan
     <input name="jalan" id="jalan" class="form-control" type="text" placeholder="kelurahan" disabled="disabled"><br />
     Kontak RS/Dinas/Klinik/Dll
     <input name="kontak_rs" id="kontak_rs" class="form-control" type="text" placeholder="kelurahan" disabled="disabled"><br />
              Nama Pemakai
             <input name="nama_pemakai" id="nama_pemakai" class="form-control" type="text" placeholder="kelurahan" disabled="disabled"><br />
              Kontak 1
             <input name="kontak1" id="kontak1" class="form-control" type="text" placeholder="kelurahan" disabled="disabled"><br />
             Kontak 2
             <input name="kontak2" id="kontak2" class="form-control" type="text" placeholder="kelurahan" disabled="disabled"><br />
              Email
              <input name="email" id="email" class="form-control" type="email" placeholder="Email" disabled="disabled"><br />
             <!--Keterangan
             <textarea rows="8" name="ket_lain" id="ket_lain" class="form-control" placeholder="Keterangan Lain"></textarea><br />-->
              </div>
            </div>
          </div>
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
    <script type="text/javascript">    
	<?php 
	echo $jsArray; 
	?>  
	function changeValue(id_barang){  
		
		document.getElementById('pembeli').value = dtBrg[id_barang].nama_pembeli;
		document.getElementById('provinsi').value = dtBrg[id_barang].provinsi;
		document.getElementById('kabupaten').value = dtBrg[id_barang].kabupaten;
		document.getElementById('kecamatan').value = dtBrg[id_barang].kecamatan;
		document.getElementById('kelurahan').value = dtBrg[id_barang].kelurahan;
		document.getElementById('jalan').value = dtBrg[id_barang].jalan;
		document.getElementById('kontak_rs').value = dtBrg[id_barang].kontak_rs;
		document.getElementById('nama_pemakai').value = dtBrg[id_barang].nama_pemakai;
		document.getElementById('kontak1').value = dtBrg[id_barang].kontak1;
		document.getElementById('kontak2').value = dtBrg[id_barang].kontak2;
		document.getElementById('email').value = dtBrg[id_barang].email;
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
  