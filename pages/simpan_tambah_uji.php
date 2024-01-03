<?php 
  if (isset($_GET['id_hapus'])) {
	$Result = mysqli_query($koneksi, "delete from alat_uji_detail where barang_teknisi_detail_id=$_GET[id_hapus]");
	if ($Result) {
		mysqli_query($koneksi, "update barang_teknisi_detail set status_uji=0 where id=$_GET[id_hapus]");
		echo "<script type='text/javascript'>
		window.location='index.php?page=simpan_tambah_uji&id=$_GET[id]';
		</script>";
		}
	}
  
  if (isset($_POST['tambah_laporan'])) {
	  if ($_POST['id_akse']=='all') {
		 
		  $q = mysqli_query($koneksi, "select *,barang_teknisi_detail.id as id_brg_teknisi_detail from barang_teknisi_detail where barang_teknisi_id=".$_GET['id']." and status_teknisi=1 and status_uji=0");
		  //$q = mysqli_query($koneksi, "select *,barang_gudang_detail.id as id_gudang,barang_teknisi_detail.id as id_brg_teknisi_detail from barang_teknisi,barang_teknisi_detail,barang_teknisi_detail_teknisi, barang_dikirim,barang_dikirim_detail, barang_dijual, barang_gudang, barang_gudang_detail,pembeli, tb_teknisi,pemakai where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dijual.id=barang_dikirim.barang_dijual_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and pembeli.id=barang_dijual.pembeli_id and pemakai.id=barang_dijual.pemakai_id and barang_dikirim_detail.id=barang_teknisi_detail.barang_dikirim_detail_id and barang_teknisi.id=barang_teknisi_detail.barang_teknisi_id and barang_teknisi_detail.id=barang_teknisi_detail_teknisi.barang_teknisi_detail_id and tb_teknisi.id=barang_teknisi_detail_teknisi.teknisi_id and barang_teknisi_detail.status_uji=0 and status_kembali_ke_gudang=0 and barang_teknisi.id=".$_GET['id']." group by no_seri_brg");
		  while ($d_q = mysqli_fetch_array($q)) {
			  $max = mysqli_fetch_array(mysqli_query($koneksi, "select max(id)+1 as maks from alat_uji_detail"));
	$ext = explode(".",$_FILES['lampiran_i']['name']);
	$ext2 = explode(".",$_FILES['lampiran_f']['name']);
	$lamp_i="Instalasi".$max['maks'].".".$ext[1];
	$lamp_f="Fungsi".$max['maks'].".".$ext2[1];
	$Result = mysqli_query($koneksi, "insert into alat_uji_detail values('','".$d_q['id_brg_teknisi_detail']."','".$_POST['soft_version']."','".$_POST['tgl_garansi_habis']."','".$_POST['tgl_i']."','$lamp_i','".$_POST['tgl_f']."','$lamp_f','".$_POST['keterangan']."','')");
	if ($Result) {
		copy($_FILES['lampiran_i']['tmp_name'], "gambar_fi/instalasi/"."Instalasi".$max['maks'].".".$ext[1]);
		copy($_FILES['lampiran_f']['tmp_name'], "gambar_fi/fungsi/"."Fungsi".$max['maks'].".".$ext2[1]);
		$up=mysqli_query($koneksi, "update barang_teknisi_detail set status_uji=1 where id=".$d_q['id_brg_teknisi_detail']."");
				}
			  }
			  if ($Result and $up) {
				  echo "<script type='text/javascript'>
		alert('Data Berhasil Di Simpan !');
		window.location='index.php?page=simpan_tambah_uji&id=$_GET[id]';
		</script>";
				  }
		  } 
	else if ($_POST['id_akse']!='all') {
	$max = mysqli_fetch_array(mysqli_query($koneksi, "select max(id)+1 as maks from alat_uji_detail"));
	$ext = explode(".",$_FILES['lampiran_i']['name']);
	$ext2 = explode(".",$_FILES['lampiran_f']['name']);
	$lamp_i="Instalasi".$max['maks'].".".$ext[1];
	$lamp_f="Fungsi".$max['maks'].".".$ext2[1];
	$Result = mysqli_query($koneksi, "insert into alat_uji_detail values('','".$_POST['id_akse']."','".$_POST['soft_version']."','".$_POST['tgl_garansi_habis']."','".$_POST['tgl_i']."','$lamp_i','".$_POST['tgl_f']."','$lamp_f','".$_POST['keterangan']."','')");
	if ($Result) {
		copy($_FILES['lampiran_i']['tmp_name'], "gambar_fi/instalasi/"."Instalasi".$max['maks'].".".$ext[1]);
		copy($_FILES['lampiran_f']['tmp_name'], "gambar_fi/fungsi/"."Fungsi".$max['maks'].".".$ext2[1]);
		mysqli_query($koneksi, "update barang_teknisi_detail set status_uji=1 where id=".$_POST['id_akse']."");
		echo "<script type='text/javascript'>
		alert('Data Berhasil Di Simpan !');
		window.location='index.php?page=simpan_tambah_uji&id=$_GET[id]';
		</script>";
		}
	  }
	}
		?>
<?php 
$dataa = mysqli_fetch_array(mysqli_query($koneksi, "select *,barang_gudang.id as id_gudang from barang_teknisi,barang_teknisi_detail,barang_teknisi_detail_teknisi, barang_dikirim,barang_dikirim_detail, barang_dijual, barang_gudang, barang_gudang_detail,pembeli, tb_teknisi,pemakai where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dijual.id=barang_dikirim.barang_dijual_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and barang_teknisi_detail.id=barang_teknisi_detail_teknisi.barang_teknisi_detail_id and pembeli.id=barang_dijual.pembeli_id and pemakai.id=barang_dijual.pemakai_id and barang_dikirim_detail.id=barang_teknisi_detail.barang_dikirim_detail_id and barang_teknisi.id=barang_teknisi_detail.barang_teknisi_id and tb_teknisi.id=barang_teknisi_detail_teknisi.teknisi_id and barang_teknisi.id=".$_GET['id'].""));

if (isset($_GET['simpan_barang'])==1) {
	
	//$insert_pembeli=mysqli_query($koneksi, "insert into pembeli values('','".$_SESSION['pembeli']."','".$_SESSION['provinsi']."','".$_SESSION['kabupaten']."','".$_SESSION['kecamatan']."','".$_SESSION['kelurahan']."','".$_SESSION['alamat']."','".$_SESSION['kontak_rs']."')");
	
	$insert_pemakai=mysqli_query($koneksi, "insert into pemakai values('','".$_SESSION['pemakai']."','".$_SESSION['kontak1']."','".$_SESSION['kontak2']."','".$_SESSION['email']."')");
	
	//$pembeli=mysqli_fetch_array(mysqli_query($koneksi, "select max(id) as id_pembeli from pembeli"));
	$id_pembeli=$_SESSION['pembeli'];
	$pemakai=mysqli_fetch_array(mysqli_query($koneksi, "select max(id) as id_pemakai from pemakai"));
	$id_pemakai=$pemakai['id_pemakai'];
	//simpan barang dijual
	$total = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_dijual_hash"));
	$simpan1=mysqli_query($koneksi, "insert into barang_dijual values('','".$_SESSION['tgl_jual']."','$total','$id_pembeli','$id_pemakai')");
	
	$d1=mysqli_fetch_array(mysqli_query($koneksi, "select max(id) as id_jual from barang_dijual"));
	$id_jual=$d1['id_jual'];
	//simpan barang pesan detail
	$q2=mysqli_query($koneksi, "select * from barang_dijual_hash");
	$jml_baris = mysqli_num_rows($q2);
	for ($i=1; $i<=$jml_baris; $i++) {
		$d2 = mysqli_fetch_array(mysqli_query($koneksi, "select * from barang_dijual_hash where no=$i"));
		$simpan2=mysqli_query($koneksi, "insert into barang_dijual_detail values('','$id_jual','".$d2['barang_gudang_detail_id']."','0')");
		$up=mysqli_query($koneksi, "update barang_gudang_detail set status_terjual=1 where id=".$d2['barang_gudang_detail_id']."");
		$up2=mysqli_query($koneksi, "update barang_gudang,barang_gudang_detail set stok_total=stok_total-1 where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=".$d2['barang_gudang_detail_id']."");
		}
		if ($simpan1 and $simpan2) {
			mysqli_query($koneksi, "delete from barang_dijual_hash");
	echo "<script type='text/javascript'>
	alert('Data Berhasil Di Simpan !');
	window.location='index.php?page=jual_barang'</script>";
		}
	}


if (isset($_POST['simpan_tambah_aksesoris'])) {
	$no=mysqli_num_rows(mysqli_query($koneksi, "select * from barang_dijual_hash"))+1;
	$simpan = mysqli_query($koneksi, "insert into barang_dijual_hash values('','$no','".$_POST['no_seri']."')");
	if ($simpan) {
		echo "<script>window.location='index.php?page=simpan_jual_alkes2'</script>";
		}
	}

?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Instalasi &amp; Uji Fungsi</h1><ol class="breadcrumb">
       <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"> Instalasi &amp; Uji Fungsi</li>
      </ol>
    </section>


    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) --><!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
          <!-- Custom tabs (Charts with tabs)--><!-- /.nav-tabs-custom -->

          <!-- Chat box -->
          <div class="box box-success"><!-- /.chat -->
            <div class="box-footer">
              <div class="box-body">
              <div class="">
              <!--<a href="index.php?page=tambah_barang_masuk"><button name="tambah_laporan" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Tambah Barang</button></a>-->
              <div class="table-responsive">
              <table width="100%" id="" class="table table-bordered ">
  <thead>
    <tr>
      <th valign="bottom"><strong>Tgl SPI</strong></th>
      <th valign="bottom">No SPI</th>
      <th valign="bottom">Nama RS/Dinas/Klinik/dll</th>
      <th valign="bottom">Alamat</th>
      <th valign="bottom"><strong>Kontak RS/Dinas/dll</strong></th>
      <th valign="bottom"><strong>Teknisi</strong></th>
      <th valign="bottom">Kontak Teknisi</th>
      </tr>
  </thead>
  <tr>
    <td><?php echo date("d-m-Y",strtotime($dataa['tgl_spk'])); ?>
    </td>
    <td><?php echo $dataa['no_spk']; ?></td>
    <td bgcolor="#00FFFF" style=""><?php echo $dataa['nama_pembeli']; ?></td>
    <td><?php echo $dataa['jalan']; ?></td>
    <td><?php echo $dataa['kontak_rs']; ?></td>
    <td><?php echo $dataa['nama_teknisi']; ?></td>
    <td><?php echo $dataa['no_hp']." / ".$_SESSION['kontak2']; ?></td>
    </tr>
</table>
              </div>
                <br />
                <h3 align="left">
                  Tambah Data
                </h3>
                <font color="#FF0000">(* Jika <strong>Nama Alkes</strong> Kosong , Berarti Teknisi estimasi dan tgl berangkat masih kosong !)</font>
                <!--<font color="#FF0000">* Jika Ingin Menambah Data Aksesoris Yang Baru ! Klik Disini <a href="index.php?page=simpan_tambah_aksesoris&id=<?php //echo $_GET['id']; ?>#openAkse"><small data-toggle="tooltip" title="Tambah Aksesoris Baru" class="label bg-blue">+ New Accessories</small></a></font>-->
                <button class="btn btn-success pull pull-right" data-toggle="modal" data-target="#modal-tambah"><span class="fa fa-plus"></span> Tambah</button>
                <br /><br />
                
                <div class="table-responsive">
                <table width="100%" id="example1" class="table table-bordered table-hover">
  <thead>
    <tr>
      <td valign="bottom"><strong>No</strong></td>
      <td valign="bottom"><strong>Nama Alkes</strong></td>
      <td align="center" valign="bottom"><strong>No Seri</strong></td>
      <td align="center" valign="bottom"><strong>Software Vers.</strong></td>
      <td align="center" valign="bottom"><strong>Garansi Habis</strong></td>
      <td align="center" valign="bottom"><strong>Instalasi</strong></td>
      <td align="center" valign="bottom"><strong>Lampiran Instalasi</strong></td>
      <td align="center" valign="bottom"><strong>Uji Fungsi</strong></td>
      <td align="center" valign="bottom"><strong>Lampiran Uji Fungsi</strong></td>
      <td align="center" valign="bottom"><strong>Aksi</strong></td>
      
     </tr>
  </thead>
  <script type="text/javascript">    
	<?php 
	echo $jsArray; 
	?>  
	function changeValue(id_akse){  
		//document.getElementById('tipe_akse').value = dtBrg[id_akse].tipe_akse; 
		//document.getElementById('merk_akse').value = dtBrg[id_akse].merk_akse;
		document.getElementById('no_akse').value = dtBrg[id_akse].no_akse;
		
	};  
</script>
  <?php
   
  $no=0;
  $q_akse = mysqli_query($koneksi, "select *,barang_teknisi_detail.id as idd from barang_teknisi,barang_teknisi_detail,barang_teknisi_detail_teknisi, barang_dikirim,barang_dikirim_detail, barang_dijual, barang_gudang, barang_gudang_detail,pembeli, tb_teknisi,alat_uji_detail where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dijual.id=barang_dikirim.barang_dijual_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and pembeli.id=barang_dijual.pembeli_id and barang_dikirim_detail.id=barang_teknisi_detail.barang_dikirim_detail_id and barang_teknisi.id=barang_teknisi_detail.barang_teknisi_id and barang_teknisi_detail.id=barang_teknisi_detail_teknisi.barang_teknisi_detail_id and tb_teknisi.id=barang_teknisi_detail_teknisi.teknisi_id and barang_teknisi_detail.id=alat_uji_detail.barang_teknisi_detail_id and barang_teknisi.id=$_GET[id] group by barang_gudang_detail.id");
  $jm = mysqli_num_rows($q_akse);
  if ($jm!=0) { 
  while ($data_akse = mysqli_fetch_array($q_akse)) {
	  $no++;
  ?>
  <tr>
    <td><?php echo $no; ?></td>
    <td><?php echo $data_akse['nama_brg']; ?>
    </td>
    <td align="center"><?php echo $data_akse['no_seri_brg']; ?></td>
    <td align="center"><?php echo $data_akse['soft_version']; ?></td>
    <td align="center"><?php echo date("d/m/Y",strtotime($data_akse['tgl_garansi_habis'])); ?></td>
    <td align="center"><?php echo date("d/m/Y",strtotime($data_akse['tgl_i'])); ?></td>
    <td align="center">&nbsp;</td>
    <td align="center"><?php echo date("d/m/Y",strtotime($data_akse['tgl_f'])); ?></td>
    <td align="center">&nbsp;</td>
    <td align="center"><a href="index.php?page=simpan_tambah_uji&id=<?php echo $_GET['id']; ?>&id_hapus=<?php echo $data_akse['idd'] ?>" onclick="return confirm('Anda Yakin Akan Menghapus Item Ini ?')"><span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span></a>&nbsp;&nbsp;<a href="index.php?page=simpan_tambah_uji&id=<?php echo $_GET['id']; ?>&id_detail=<?php echo $data_akse['idd'] ?>#open_detail" ><span data-toggle="tooltip" title="Detail" class="fa fa-caret-square-o-right"></span></a></td>
    </tr>
  <?php }} else {
	  echo "<tr><td colspan='10' align='center'>Tidak Ada Data</td></tr>";
	  } ?>
</table>
                </div>
                <br />
<center><a href="index.php?page=spk_masuk"><button name="simpan_barang" class="btn btn-success" type="button"> Ke Halaman Rencana Instalasi</button></a>&nbsp;<a href="index.php?page=uji_fungsi_instalasi"><button name="simpan_barang" class="btn btn-success" type="button"> Ke Halaman Instalasi & Uji Fungsi</button></a></center>
</div>
              </div>
            </div>
          </div>
          <!-- /.box (chat box) -->

          <!-- TO DO List --><!-- /.box -->

        <!-- quick email widget --></section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-5 connectedSortable">

          <!-- Map box --><!-- /.box -->

          <!-- solid sales graph --><!-- /.box -->

          <!-- Calendar --><!-- /.box -->

        </section>
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

  </section>
    <!-- /.content -->
  </div>

<div id="open_detail" class="modalDialog">
     <div>
        <a href="#" title="Close" class="close">X</a>
        <h3 align="center">Instalasi &amp; Uji Fungsi</h3>
        <?php 
		$sel = mysqli_fetch_array(mysqli_query($koneksi, "select * from alat_uji_detail where barang_teknisi_detail_id=".$_GET['id_detail'].""));
		?>
              <label>Tgl Instalasi</label>
          <input name="tgl_i" class="form-control" type="date" required placeholder="Nama Aksesoris" value="<?php echo $sel['tgl_i'] ?>"><br />
              
              <label>Tgl Uji Fungsi</label>
              <input name="tgl_f" class="form-control" type="date" placeholder="Tipe" value="<?php echo $sel['tgl_f'] ?>"><br />
             
              Keterangan
              <textarea name="keterangan" class="form-control" placeholder="" rows="3"><?php echo $sel['keterangan'] ?></textarea>
              <br />
              
              <br />
              </form>
              
    </div>
</div>

<div class="modal fade" id="modal-tambah">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
              
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" align="center">Tambah Data</h4>
              </div>
              <form method="post" enctype="multipart/form-data">
              <div class="modal-body">
                <label>Nama Alkes</label>
                <select name="id_akse" id="id_akse" class="form-control select2" autofocus="autofocus" required onchange="changeValue(this.value)" style="width:100%">
    	<option>...</option>
        <?php 
		$qq = mysqli_query($koneksi, "select *,barang_gudang_detail.id as id_gudang,barang_teknisi_detail.id as id_brg_teknisi_detail from barang_teknisi,barang_teknisi_detail,barang_teknisi_detail_teknisi, barang_dikirim,barang_dikirim_detail, barang_dijual, barang_gudang, barang_gudang_detail,pembeli, tb_teknisi,pemakai where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dijual.id=barang_dikirim.barang_dijual_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and pembeli.id=barang_dijual.pembeli_id and pemakai.id=barang_dijual.pemakai_id and barang_dikirim_detail.id=barang_teknisi_detail.barang_dikirim_detail_id and barang_teknisi.id=barang_teknisi_detail.barang_teknisi_id and barang_teknisi_detail.id=barang_teknisi_detail_teknisi.barang_teknisi_detail_id and tb_teknisi.id=barang_teknisi_detail_teknisi.teknisi_id and barang_teknisi_detail.status_uji=0 and status_kembali_ke_gudang=0 and barang_teknisi.id=".$_GET['id']."");
		$c = mysqli_num_rows($qq);
		?>
        <?php if ($c!=0) { ?>
        <option value="all">Semua Nya</option>
        <?php } ?>
        <?php
		$q = mysqli_query($koneksi, "select *,barang_teknisi_detail.id as id_brg_teknisi_detail from barang_teknisi_detail where barang_teknisi_id=".$_GET['id']." and status_teknisi=1 and status_uji=0"); 
		$jsArray = "var dtBrg = new Array();
";
		while ($d = mysqli_fetch_array($q)) { ?>
        <option value="<?php echo $d['id_brg_teknisi_detail']; ?>"><?php 
		$dd = mysqli_fetch_array(mysqli_query($koneksi, "select * from barang_dikirim_detail,barang_gudang_detail,barang_gudang where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dikirim_detail.id=".$d['barang_dikirim_detail_id'].""));
		echo $dd['nama_brg']." / ".$dd['no_seri_brg']." ".$dd['nama_set']; ?></option>
        <?php 
		$jsArray .= "dtBrg['" . $d['id_brg_teknisi_detail'] . "'] = {
						no_akse:'".addslashes($dd['no_seri_brg']." ".$dd['nama_set'])."'
						};";
		} ?>
    </select>
    <br />
    <br />
                <label>No Seri</label>
                <input id="no_akse" name="no_akse" class="form-control" type="text" placeholder="No Seri" disabled="disabled" size="5"/>
                <br />
                <label>Versi Software</label>
                <input name="soft_version" class="form-control" type="text" placeholder="" size="5"/>
                <br />
                <label>Garansi Habis</label>
                <input name="tgl_garansi_habis" class="form-control" type="date" placeholder="" required="required" size="5"/>
                <br />
                <label>Tanggal Instalasi</label>
                <input name="tgl_i" class="form-control" type="date" required placeholder="Nama Aksesoris" autofocus>
                <br />
                <label>Lampiran Instalasi</label>
                <input name="lampiran_i" class="form-control" type="file" placeholder="Merk">
                <br />
                <label>Tanggal Uji Fungsi</label>
                <input name="tgl_f" class="form-control" type="date" placeholder="Tipe" required>
                <br />
                <label>Lampiran Uji Fungsi</label>
                <input name="lampiran_f" class="form-control" type="file" placeholder="Nomor Seri" >
                <br />
                <label>Keterangan</label>
                <input name="keterangan" class="form-control" type="text" placeholder="" >
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success" name="tambah_laporan">Simpan</button>
              </div>
              </form>
              <script type="text/javascript">    
	<?php 
	echo $jsArray; 
	?>  
	function changeValue(id_akse){  
		//document.getElementById('tipe_akse').value = dtBrg[id_akse].tipe_akse; 
		//document.getElementById('merk_akse').value = dtBrg[id_akse].merk_akse;
		document.getElementById('no_akse').value = dtBrg[id_akse].no_akse;
		
	};  
</script>
            </div>
            <!-- /.modal-content -->
  </div>
          <!-- /.modal-dialog -->
</div>
