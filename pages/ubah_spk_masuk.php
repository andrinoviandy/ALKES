<?php
$id=$_GET['id'];
$data=mysqli_fetch_array(mysqli_query($koneksi, "select *,barang_teknisi.id as idd, barang_dikirim.id as id_brg_kirim from barang_teknisi,barang_gudang,barang_gudang_detail,barang_dijual,barang_dikirim,pembeli,alamat_provinsi,alamat_kabupaten,alamat_kecamatan,alamat_kelurahan where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dijual.barang_gudang_detail_id and barang_dijual.id=barang_dikirim.barang_dijual_id and barang_dikirim.id=barang_teknisi.barang_dikirim_id and pembeli.id=barang_dijual.pembeli_id and alamat_provinsi.id=pembeli.provinsi_id and alamat_kabupaten.id=pembeli.kabupaten_id and alamat_kecamatan.id=pembeli.kecamatan_id and barang_teknisi.id=$id"));

if (isset($_POST['tambah_spk_masuk'])) {
	$query_spk=mysqli_query($koneksi, "update barang_teknisi set tgl_spk='".$_POST['tgl_spk']."', teknisi_id='".$_POST['id_teknisi']."', barang_dikirim_id='".$_POST['id_barang']."' where id=".$_GET['id']."");
	if ($query_spk) {
		echo "<script type='text/javascript'>
		alert('Data Berhasil Di Ubah !');
		window.location='index.php?page=spk_masuk';
		</script>";
		
	} else {
		echo "<script type='text/javascript'>
		alert('Gagal Diubah !');
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
		window.location='index.php?page=ubah_spk_masuk&id=$_GET[id]'
		</script>";
		}
	} else {
		echo "<script type='text/javascript'>
		alert('Nama Teknisi Sudah Ada ! Buat Nama Teknisi Yang Lain !');
		window.location='index.php?page=ubah_spk_masuk&id=$_GET[id]#tambahTeknisi'
		</script>";
		}
}
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Tambah
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="index.php?page=barang_masuk">SPK Masuk</a></li>
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
              <h3 class="box-title">Tanggal SPK</h3>
            </div>
              <div class="box-body">
              <input name="tgl_spk" type="date" class="form-control" autofocus="autofocus" value="<?php echo $data['tgl_spk']; ?>" required="required"/>                                  
              </div>
            <div class="box-header with-border">
              <h3 class="box-title">Pilih Teknisi</h3>
            </div>
              <div class="box-body">
              
             <select name="id_teknisi" class="form-control" required <?php echo $dis; ?>>
              <option value="">--Pilih Teknisi--</option>
              <?php 
			  $query_teknisi = mysqli_query($koneksi, "select * from tb_teknisi order by nama_teknisi ASC");
			  while ($data_t = mysqli_fetch_array($query_teknisi)) {
			  ?>
              <option <?php if ($data_t['id']==$data['teknisi_id']) {echo "selected";} ?> value="<?php echo $data_t['id']; ?>"><?php echo $data_t['nama_teknisi']." - ".$data_t['bidang']; ?></option>
              <?php } ?>
              </select>
              
                    <p align="center" style="margin-top:10px"><a href="index.php?page=ubah_spk_masuk&id=<?php echo $_GET['id']; ?>#tambahTeknisi"><span class="label bg-blue">Buat Teknisi Baru</span></a></p>        
              
              </div>
            </div>
          </div>
          <div class="box box-success"><!-- /.chat -->
            <div class="box-footer">
            <div class="box-header with-border">
              <h3 class="box-title">Data Alkes</h3>
            </div>
              <div class="box-body">
              
              <select name="id_barang" id="id_barang" onchange="changeValue(this.value)" required class="form-control">
					<option value="">-- Pilih Alkes --</option>
					<?php 
					$result = mysqli_query($koneksi, "select *,barang_dikirim.id as idd from barang_dikirim, barang_dijual, barang_gudang,barang_gudang_detail, pembeli, alamat_provinsi, alamat_kabupaten, alamat_kecamatan where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dijual.barang_gudang_detail_id and barang_dijual.id=barang_dikirim.barang_dijual_id and pembeli.id=barang_dijual.pembeli_id and alamat_provinsi.id=pembeli.provinsi_id and alamat_kabupaten.id=pembeli.kabupaten_id and alamat_kecamatan.id=pembeli.kecamatan_id and tgl_kirim!='0000-00-00' order by nama_brg ASC");    
					$jsArray = "var dtBrg = new Array();
";        
					while ($row = mysqli_fetch_array($result)) {    ?>
                    <option <?php if ($row['idd']==$data['id_brg_kirim']) {echo "selected";} ?> value="<?php echo $row['idd']; ?>"><?php echo $row['nama_brg']; ?></option>
                    <?php 
					echo   
						$jsArray .= "dtBrg['" . $row['idd'] . "'] = {tipe:'".addslashes($row['tipe_brg'])."',
						merk:'".addslashes($row['merk_brg'])."',
						no_seri:'".addslashes($row['no_seri_brg'])."',
						nie:'".addslashes($row['nie_brg'])."',
						no_bath:'".addslashes($row['no_bath'])."',
						no_lot:'".addslashes($row['no_lot'])."',
						nama_pembeli:'".addslashes($row['nama_pembeli'])."',
						provinsi:'".addslashes($row['nama_provinsi'])."',
						kabupaten:'".addslashes($row['nama_kabupaten'])."',
						kecamatan:'".addslashes($row['nama_kecamatan'])."',
						kelurahan:'".addslashes($row['kelurahan_id'])."',
						jalan:'".addslashes($row['jalan'])."',
						nama_pemakai:'".addslashes($row['nama_pemakai'])."',
						kontak:'".addslashes($row['kontak'])."',
						email:'".addslashes($row['email'])."'
						};
";    
					}      
					?>    
				</select>
              <br />
              Merk
              <input name="merk" id="merk" class="form-control" type="text" placeholder="Merk" readonly="readonly" disabled="disabled" value="<?php echo $data['merk_brg']; ?>">
              
              <br />
              Tipe
              <input name="tipe" id="tipe" class="form-control" type="text" placeholder="Tipe" readonly="readonly" disabled="disabled" value="<?php echo $data['tipe_brg']; ?>"><br />
              NIE
              <input name="nie" id="nie" class="form-control" type="text" placeholder="Nomor Ijin Edar (NIE)" readonly="readonly" disabled="disabled" value="<?php echo $data['nie_brg']; ?>"><br />
              No Bath
              <input name="no_bath" id="no_bath" class="form-control" type="text" placeholder="Nomor Bath" readonly="readonly" disabled="disabled" value="<?php echo $data['no_bath']; ?>"><br />
              No Lot
              <input name="no_lot" id="no_lot" class="form-control" type="text" placeholder="Nomor Lot" readonly="readonly" disabled="disabled" value="<?php echo $data['no_lot']; ?>"><br />
              No Seri
              <input name="no_seri" id="no_seri" class="form-control" type="text" placeholder="Nomor Seri" readonly="readonly" disabled="disabled" value="<?php echo $data['no_seri_brg']; ?>"><br />
              
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
              <input name="pembeli" id="pembeli" class="form-control" type="text" placeholder="Nama Rumah Sakit/Dinas/Puskesmas/Klinik/dll" disabled="disabled" value="<?php echo $data['nama_pembeli']; ?>"/>
              <br />
              
              Provinsi
     <input name="provinsi" id="provinsi" class="form-control" type="text" placeholder="Provinsi" disabled="disabled" value="<?php echo $data['nama_provinsi']; ?>"><br />
    
     Kabupaten
      <input name="kabupaten" id="kabupaten" class="form-control" type="text" placeholder="Kabupaten" disabled="disabled" value="<?php echo $data['nama_kabupaten']; ?>"><br />
     
     Kecamatan
     <input name="kecamatan" id="kecamatan" class="form-control" type="text" placeholder="Kecamatan" disabled="disabled" value="<?php echo $data['nama_kecamatan']; ?>"><br />
     
     Kelurahan
     <input name="kelurahan" id="kelurahan" class="form-control" type="text" placeholder="kelurahan" disabled="disabled" value="<?php echo $data['kelurahan_id']; ?>"><br />
     
     Jalan
     <input name="jalan" id="jalan" class="form-control" type="text" placeholder="kelurahan" disabled="disabled" value="<?php echo $data['jalan']; ?>"><br />
              Nama Pemakai
             <input name="nama_pemakai" id="nama_pemakai" class="form-control" type="text" placeholder="kelurahan" disabled="disabled" value="<?php echo $data['nama_pemakai']; ?>"><br />
              Kontak
             <input name="kontak" id="kontak" class="form-control" type="text" placeholder="kelurahan" disabled="disabled" value="<?php echo $data['kontak']; ?>"><br />
              Email
              <input name="email" id="email" class="form-control" type="email" placeholder="Email" disabled="disabled" value="<?php echo $data['email']; ?>"><br />
             <!--Keterangan
             <textarea rows="8" name="ket_lain" id="ket_lain" class="form-control" placeholder="Keterangan Lain"></textarea><br />-->
              </div>
            </div>
          </div>
          <!-- /.box (chat box) -->

          <!-- TO DO List --><!-- /.box -->

        <!-- quick email widget --></section>
        
        <section class="col-lg-12 connectedSortable" align="center">
          <button name="tambah_spk_masuk" type="submit" value="Simpan" class="btn btn-success" style="padding:20px"><span class="fa fa-plus"></span> Simpan </button>
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
		document.getElementById('tipe').value = dtBrg[id_barang].tipe; 
		document.getElementById('merk').value = dtBrg[id_barang].merk;
		document.getElementById('nie').value = dtBrg[id_barang].nie;
		document.getElementById('no_bath').value = dtBrg[id_barang].no_bath;
		document.getElementById('no_lot').value = dtBrg[id_barang].no_lot;
		document.getElementById('no_seri').value = dtBrg[id_barang].no_seri;
		document.getElementById('pembeli').value = dtBrg[id_barang].nama_pembeli;
		document.getElementById('provinsi').value = dtBrg[id_barang].provinsi;
		document.getElementById('kabupaten').value = dtBrg[id_barang].kabupaten;
		document.getElementById('kecamatan').value = dtBrg[id_barang].kecamatan;
		document.getElementById('kelurahan').value = dtBrg[id_barang].kelurahan;
		document.getElementById('jalan').value = dtBrg[id_barang].jalan;
		document.getElementById('nama_pemakai').value = dtBrg[id_barang].nama_pemakai;
		document.getElementById('kontak').value = dtBrg[id_barang].kontak;
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
  