<?php
$query = mysqli_query($koneksi, "select *,tb_laporan_kerusakan.id as idd from tb_laporan_kerusakan,akun_customer,kategori_job,barang_dikirim,barang_dijual,barang_gudang,barang_gudang_detail where akun_customer.id=tb_laporan_kerusakan.akun_customer_id and barang_dikirim.id=tb_laporan_kerusakan.barang_dikirim_id and kategori_job.id=tb_laporan_kerusakan.kategori_job_id and barang_dijual.id=barang_dikirim.barang_dijual_id and barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dijual.barang_gudang_detail_id and tb_laporan_kerusakan.id=".$_GET['id']."");
$dat = mysqli_fetch_array($query);

if (isset($_POST['tambah_laporan'])) {
	
	$q=mysqli_fetch_array(mysqli_query($koneksi, "select tgl_garansi_habis from barang_dijual,barang_dikirim,barang_teknisi,alat_uji where barang_dijual.id=barang_dikirim.barang_dijual_id and barang_dikirim.id=barang_teknisi.barang_dikirim_id and barang_teknisi.id=alat_uji.barang_teknisi_id and barang_dikirim.id=".$_POST['id_alkes'].""));
	if ($_POST['tgl_lapor']<=$q['tgl_garansi_habis']) {
		$warranty="Masih Garansi";
		}
	else {
		$warranty="Garansi Habis";
		}
		
	$Result = mysqli_query($koneksi, "update tb_laporan_kerusakan set akun_customer_id=".$_POST['id_akun'].", tgl_lapor='".$_POST['tgl_lapor']."', barang_dikirim_id=".$_POST['id_alkes'].", status_garansi='$warranty', kategori_job_id=".$_POST['id_kategori'].", problem='".$_POST['problem']."', lokasi='".$_POST['lokasi']."' where id=".$_GET['id']."");
	if ($Result) {
		
		echo "<script type='text/javascript'>
		alert('Laporan Kerusakan Berhasil Diubah !');
		window.location='index.php?page=laporan_kerusakan'
		</script>";
		
		}
	}
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Ubah Laporan Kerusakan
     </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="index.php?page=laporan_kerusakan">Laporan Kerusakan</a></li>
        <li class="active">Ubah Laporan Kerusakan</li>
      </ol>
    </section>


    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) --><!-- /.row -->
      <!-- Main row -->
      <form method="post" enctype="multipart/form-data">
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-7 connectedSortable">
          <!-- Custom tabs (Charts with tabs)--><!-- /.nav-tabs-custom -->

          <!-- Chat box -->
          <div class="box box-success"><!-- /.chat -->
            <div class="box-footer">
            <div class="box-header with-border">
              <h3 class="box-title">Ubah Laporan Kerusakan</h3>
            </div>
              <div class="box-body">
              Nama Akun
              <select id="" name="id_akun" class="form-control" <?php if (isset($_SESSION['user_customer'])) { echo "disabled"; } ?> autofocus="autofocus" >
             
              <?php $query = mysqli_query($koneksi, "select * from akun_customer order by nama_user ASC");
			  while ($data=mysqli_fetch_array($query)) { ?>
              <option <?php if ($data['id']==$dat['akun_customer_id']) { echo "selected"; } ?> value="<?php echo $data['id']; ?>"><?php echo $data['nama_user']." / No HP : ".$data['telp_user']; ?></option>
              <?php } ?>
              </select>
              <br />
              Tgl Lapor
              <input name="tgl_lapor" class="form-control" type="date" required value="<?php echo $dat['tgl_lapor']; ?>"><br />
              Nama Alkes
              <select onchange="changeValue(this.value)" id="id_alkes" name="id_alkes" class="form-control" >
              <?php $query = mysqli_query($koneksi, "select nama_brg,merk_brg,tipe_brg,nie_brg,no_lot,no_bath,no_seri_brg,nama_pembeli,barang_dikirim.id as idd from barang_dikirim,barang_dijual,barang_gudang,barang_gudang_detail,pembeli where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dijual.barang_gudang_detail_id and barang_dijual.id=barang_dikirim.barang_dijual_id and pembeli.id=barang_dijual.pembeli_id and tgl_kirim!=0000-00-00 order by nama_brg ASC");
			  $jsArray = "var dtBrg = new Array();";
			  while ($row=mysqli_fetch_array($query)) { ?>
              <option <?php if ($row['idd']==$dat['barang_dikirim_id']) { echo "selected"; } ?> value="<?php echo $row['idd']; ?>"><?php echo $row['nama_brg']." - No Seri : ".$row['no_seri_brg']." - ".$row['nama_pembeli']; ?></option>
              <?php 
			  $jsArray .= "dtBrg['" . $row['idd'] . "'] = {nama_pembeli:'".addslashes($row['nama_pembeli'])."',
						merk_brg:'".addslashes($row['merk_brg'])."',
						tipe_brg:'".addslashes($row['tipe_brg'])."',
						nie_brg:'".addslashes($row['nie_brg'])."',
						no_bath:'".addslashes($row['no_bath'])."',
						no_lot:'".addslashes($row['no_lot'])."',
						no_seri:'".addslashes($row['no_seri_brg'])."'
						};
"; 
			  } ?>
              </select><br />
              Lokasi
              <input name="lokasi" id="kepemilikan" class="form-control" type="text" placeholder="Lokasi" required readonly="readonly" value="<?php echo $dat['lokasi']; ?>"><br />
              
              Kategori Kerusakan
              <select id="" name="id_kategori" class="form-control" >
              
              <?php $query3 = mysqli_query($koneksi, "select * from kategori_job order by id ASC");
			  while ($data=mysqli_fetch_array($query3)) { ?>
              <option <?php if ($data['id']==$dat['kategori_job_id']) { echo "selected"; } ?> value="<?php echo $data['id']; ?>"><?php echo $data['nama_job']; ?></option>
              <?php } ?>
              </select>
              <br />
               
              Deskripsi Kerusakan / Problem
              <textarea name="problem" class="form-control" placeholder="Deskripsi Kerusakan" rows="5" required><?php echo $dat['problem']; ?></textarea><br />
              
              <button type="submit" name="tambah_laporan" id="button" class="btn btn-info"><span class="fa fa-plus"></span> Simpan Perubahan</button>
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
        <section class="col-lg-5 connectedSortable">

          <div class="box box-success"><!-- /.chat -->
            <div class="box-footer">
            <div class="box-header with-border">
              <h3 class="box-title">Data Alkes</h3>
            </div>
              <div class="box-body"><br />
              Merk
              <input name="merk" type="text" disabled="disabled" required class="form-control" id="merk" placeholder="Merk" value="<?php echo $dat['merk_brg']; ?>">
              
              <br />
              Tipe
              <input name="tipe" id="tipe" class="form-control" type="text" placeholder="Tipe" readonly="readonly" disabled="disabled" value="<?php echo $dat['tipe_brg']; ?>"><br />
              NIE
              <input name="nie" id="nie_brg" class="form-control" type="text" placeholder="Nomor Ijin Edar (NIE)" readonly="readonly" disabled="disabled" value="<?php echo $dat['nie_brg']; ?>"><br />
              No Bath
              <input name="no_bath" id="no_bath" class="form-control" type="text" placeholder="Nomor Bath" readonly="readonly" disabled="disabled" value="<?php echo $dat['no_bath']; ?>"><br />
              No Lot
              <input name="no_lot" id="no_lot" class="form-control" type="text" placeholder="Nomor Lot" readonly="readonly" disabled="disabled" value="<?php echo $dat['no_lot']; ?>"><br />
              No Seri
              <input name="no_seri" id="no_seri" class="form-control" type="text" placeholder="Nomor Seri" readonly="readonly" disabled="disabled" value="<?php echo $dat['no_seri_brg']; ?>"><br />
              
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