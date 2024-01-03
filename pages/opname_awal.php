<?php
if (isset($_POST['simpan'])) {
	$Result = mysqli_query($koneksi, "insert into stok_opname values(NULL,'".$_POST['tgl']."','".$_POST['keterangan']."')");
	
	if ($Result) {
		$sel = mysqli_fetch_array(mysqli_query($koneksi, "select max(id) as idd from stok_opname"));		
		echo "<script type='text/javascript'>
		alert('Data Berhasil Disimpan , Silakan Scanner Barang !');
	window.location='index.php?page=opname&id=$sel[idd]';
		</script>";
		}
	}

if (isset($_POST['simpan2'])) {
	echo "<script type='text/javascript'>
		alert('Silakan Lanjut Scanner Barang !');
		window.location='index.php?page=opname&id=$_POST[tgl]';
		</script>";
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
        Stok Opname
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Stok Opname</li></ol></section>


    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) --><!-- /.row -->
      <!-- Main row -->
      <form method="post" enctype="multipart/form-data">
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-3 connectedSortable">
          <!-- Custom tabs (Charts with tabs)--><!-- /.nav-tabs-custom -->

          <!-- Chat box -->
          <div class="box box-success"><!-- /.chat -->
            <h3 align="center">Buat Pengecekan Baru</h3>
            <div class="box-footer">
            <div class="box-header with-border">
              <div class="bob-body">
              <form method="post">
              <label>Tanggal Pengecekan</label>
              <input type="date" class="form-control" name="tgl" required="required"/>
              <br />
              <label>Keterangan</label>
              <textarea rows="5" class="form-control" name="keterangan" required="required"></textarea>
              <br />
              <button type="submit" name="simpan" class="btn btn-success"><i class="fa fa-check"></i> &nbsp;Simpan</button>
              </form>
              </div>
            </div>
            </div>
          </div>
          </section>
        <section class="col-lg-3 connectedSortable">
          <!-- Custom tabs (Charts with tabs)--><!-- /.nav-tabs-custom -->

          <!-- Chat box -->
          <div class="box box-success"><!-- /.chat -->
            <h3 align="center">Lanjut Pengecekan Stok</h3>
            <div class="box-footer">
              <div class="box-header with-border">
                <div class="bob-body">
              <form method="post">
              <label>Tanggal Pengecekan</label>
              <select name="tgl" style="width:100%" class="form-control select2" required="required">
              <option value="">...</option>
              	<?php
                $q = mysqli_query($koneksi, "select * from stok_opname order by tgl_cek DESC");
				while ($d = mysqli_fetch_array($q)) {
				?>
                <option value="<?php echo $d['id']; ?>"><?php echo date("d/m/Y", strtotime($d['tgl_cek']))." | ".substr($d['keterangan'],0,15)."..."; ?></option>
                <?php 
				}
				?>
              </select>
              <br />
              <br />
              <button type="submit" name="simpan2" class="btn btn-success"><i class="fa fa-check"></i> &nbsp;Simpan</button>
              </form>
              </div>
          </div>
            </div>
          </div>
          </section>
        <!-- right col -->
      </div>
      </form>
      <!-- /.row (main row) -->

  </section>
    <!-- /.content -->
  </div>
  <?php 
  if (isset($_POST['simpan_1'])) {
	$id=$_GET['id'];
	$max = mysqli_fetch_array(mysqli_query($koneksi, "select max(id)+1 as maks from alat_pelatihan"));
	$ext = explode(".",$_FILES['lamp1']['name']);
	$ext2 = explode(".",$_FILES['lamp2']['name']);
	$lamp1="Lampiran1_".$max['maks'].".".$ext[1];
	$lamp2="Lampiran2_".$max['maks'].".".$ext2[1];
	  $R = mysqli_query($koneksi, "update alat_pelatihan set lamp1='$lamp1' where id=$id");
	  if ($R) {
		  copy($_FILES['lamp1']['tmp_name'], "gambar_pelatihan/lampiran1/$lamp1");
		  echo "<script type='text/javascript'>
		  window.location='index.php?page=ubah_latih&id=$id';
		</script>";
		  }
	  }

if (isset($_POST['simpan_2'])) {
	$id=$_GET['id'];
	$max = mysqli_fetch_array(mysqli_query($koneksi, "select max(id)+1 as maks from alat_pelatihan"));
	$ext = explode(".",$_FILES['lamp1']['name']);
	$ext2 = explode(".",$_FILES['lamp2']['name']);
	$lamp1="Lampiran1_".$max['maks'].".".$ext[1];
	$lamp2="Lampiran2_".$max['maks'].".".$ext2[1];
	  $R = mysqli_query($koneksi, "update alat_pelatihan set lamp2='$lamp2' where id=$id");
	  if ($R) {
		  copy($_FILES['lamp2']['tmp_name'], "gambar_pelatihan/lampiran2/$lamp2");
		  echo "<script type='text/javascript'>
		  window.location='index.php?page=ubah_latih&id=$id';
		</script>";
		  }
	  }
  ?>
  <div id="open1" class="modalDialog">
     <div>
        <a href="#" title="Close" class="close">X</a>
        <h3 align="center">Ubah Lampiran 1</h3> 
     <form method="post" enctype="multipart/form-data">
     <input id="input" name="lamp1" type="file" style="background-color:#FFF"/>
        <button id="buttonn" name="simpan_1" type="submit">Simpan</button>
    </form>
    </div>
</div>

<div id="open2" class="modalDialog">
     <div>
        <a href="#" title="Close" class="close">X</a>
        <h3 align="center">Ubah Lampiran 2</h3> 
     <form method="post" enctype="multipart/form-data">
     <input id="input" name="lamp2" type="file" style="background-color:#FFF"/>
        <button id="buttonn" name="simpan_2" type="submit">Simpan</button>
    </form>
    </div>
</div>
  
  