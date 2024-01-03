<?php
if (isset($_POST['tambah_laporan'])) {
	/*$q=mysqli_fetch_array(mysqli_query($koneksi, "select tgl_garansi_habis from barang_dijual,barang_dikirim,barang_teknisi,alat_uji where barang_dijual.id=barang_dikirim.barang_dijual_id and barang_dikirim.id=barang_teknisi.barang_dikirim_id and barang_teknisi.id=alat_uji.barang_teknisi_id and barang_dikirim.id=".$_POST['id_alkes'].""));
	if ($_POST['tgl_lapor']<=$q['tgl_garansi_habis']) {
		$warranty="Masih Garansi";
		}
	else {
		$warranty="Garansi Habis";
		}
	$Result = mysqli_query($koneksi, "insert into tb_laporan_kerusakan values('','".$_POST['id_akun']."','".$_POST['tgl_lapor']."','".$_POST['id_alkes']."','".$warranty."','".$_POST['id_kategori']."','".$_POST['problem']."','".$_POST['lokasi']."','0')");
	if ($Result) {
		echo "<script type='text/javascript'>
		alert('Laporan Kerusakan Berhasil Disimpan !');
		
		</script>";
		}*/
		$_SESSION['id_akun']=$_POST['id_akun'];
		$_SESSION['tgl_lapor']=$_POST['tgl_lapor'];
		$_SESSION['penelepon']=$_POST['penelepon'];
		$_SESSION['nomor_hp']=$_POST['nomor_hp'];
		$_SESSION['keluhan']=$_POST['keluhan'];
		echo "<script type='text/javascript'>
		window.location='index.php?page=simpan_tambah_laporan';
		</script>";
	}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Laporan Kerusakan
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="index.php?page=laporan_kerusakan">Laporan Kerusakan</a></li>
        <li class="active">Tambah Laporan Kerusakan</li>
      </ol>
    </section>


    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) --><!-- /.row -->
      <!-- Main row -->
      <form method="post">
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-4 connectedSortable">
          <!-- Custom tabs (Charts with tabs)--><!-- /.nav-tabs-custom -->

          <!-- Chat box -->
          <div class="box box-success"><!-- /.chat -->
            <div class="box-footer">
            <div class="box-header with-border">
              <h3 class="box-title">Tambah Laporan Kerusakan</h3>
            </div>
              <div class="box-body">
              
              Tgl Lapor
              <input name="tgl_lapor" class="form-control" type="datetime-local" required autofocus="autofocus" value=""><br />
              Penelepon
              <input name="penelepon" class="form-control" type="text" required autofocus="autofocus" value=""><br />
              Nomor Yang Bisa Dihubungi
              <input name="nomor_hp" class="form-control" type="text" required autofocus="autofocus" value=""><br />
              Instansi
                <select id="" name="id_akun" class="form-control select2" required>
              <option value="">--Pilih--</option>
              <?php $query = mysqli_query($koneksi, "select *,alat_pelatihan.id as idd,pembeli_id as id_rumkit from barang_teknisi,barang_teknisi_detail,barang_teknisi_detail_teknisi, barang_dikirim,barang_dikirim_detail, barang_dijual, barang_gudang, barang_gudang_detail,pembeli, tb_teknisi,alat_uji_detail,alat_pelatihan where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dijual.id=barang_dikirim.barang_dijual_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and pembeli.id=barang_dijual.pembeli_id and barang_dikirim_detail.id=barang_teknisi_detail.barang_dikirim_detail_id and barang_teknisi.id=barang_teknisi_detail.barang_teknisi_id and barang_teknisi_detail.id=barang_teknisi_detail_teknisi.barang_teknisi_detail_id and tb_teknisi.id=barang_teknisi_detail_teknisi.teknisi_id and barang_teknisi_detail.id=alat_uji_detail.barang_teknisi_detail_id and alat_uji_detail.id=alat_pelatihan.alat_uji_detail_id group by pembeli.id order by nama_pembeli ASC");
			  while ($data=mysqli_fetch_array($query)) { ?>
              <option value="<?php echo $data['id_rumkit']; ?>"><?php echo $data['nama_pembeli']." / Kontak : ".$data['kontak_rs']; ?></option>
              <?php } ?>
              </select>
              <br /><br />
              Keluhan
              <textarea name="keluhan" rows="3" class="form-control"></textarea><br />
              <button type="submit" name="tambah_laporan" id="button" class="btn btn-info"><span class="fa fa-plus"></span> Next</button>
              <br /><br />
              
              <script type="text/javascript">    
	<?php 
	echo $jsArray; 
	?>  
	function changeValue(id_alkes){  
		document.getElementById('merk').value = dtBrg[id_alkes].merk_brg;
		document.getElementById('tipe').value = dtBrg[id_alkes].tipe_brg;
		document.getElementById('nie_brg').value = dtBrg[id_alkes].nie_brg;
		document.getElementById('no_bath').value = dtBrg[id_alkes].no_bath;
		document.getElementById('no_lot').value = dtBrg[id_alkes].no_lot;
		document.getElementById('no_seri').value = dtBrg[id_alkes].no_seri;
		document.getElementById('kepemilikan').value = dtBrg[id_alkes].nama_pembeli;
		
	};  
</script>
              </div>
            </div>
          </div>
          <!-- /.box (chat box) -->

          <!-- TO DO List --><!-- /.box -->

        <!-- quick email widget --></section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-5 connectedSortable"></section>
        <!-- right col -->
      </div>
      </form>
      <!-- /.row (main row) -->

  </section>
    <!-- /.content -->
  </div>