<?php
if (isset($_POST['tambah_laporan'])) {
	$jumlah_pilih=count($_POST['nama_barang']);
	for ($x=0; $x<$jumlah_pilih; $x++) {
	$jml1 = mysqli_fetch_array(mysqli_query($koneksi, "select * from master_barang where id=".$_POST['nama_barang'][$x].""));
	  if ($_POST['qty']<=$jml1['stok']) 
	  {
	$Result = mysqli_query($koneksi, "insert into jual_barang values('','".$_POST['nama_barang'][$x]."','".$_POST['pembeli']."','".$_POST['alamat']."','".$_POST['telp_pembeli']."','".$_POST['qty']."','".$_POST['tgl_beli']."','','','','','','','','','','')"); }
	if ($Result) {
		mysqli_query($koneksi, "update master_barang set stok=stok-".$_POST['qty']." where id=".$_POST['nama_barang'][$x]."");
		echo "<script type='text/javascript'>
		alert('Data $jml1[nama_brg] Berhasil Di Simpan !');
		</script>";
		} else {
			echo "<script type='text/javascript'>
		alert('Data $jml1[nama_brg] Stok Kurang !');
		</script>";
			}
			}
	}
?>
<script language="JavaScript" type="text/JavaScript">
        counter=0;
        function action(){
            counterNext=counter+1;
            document.getElementById("input"+counter).innerHTML = "<label>Nama Alkes</label><select name='nama_barang[]' class='form-control' required><option>-- Pilih Alkes --</option><?php $q = mysqli_query($koneksi, "select * from master_barang where stok!=0 order by nama_brg ASC"); while ($d = mysqli_fetch_array($q)) { ?><option value='<?php echo $d['id']; ?>'><?php echo $d['nama_brg']; ?></option><?php } ?></select> <div id=\"input"+counterNext+"\"></div>";
			// perhatikan tanda petiknya, sama seperti pemrograman java yang lainnya
            counter++;
        }
    </script>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Jual Alkes
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="index.php?page=jual_barang">Alkes</a></li>
        <li class="active">Jual Alkes</li></ol></section>


    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) --><!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-5 connectedSortable">
          <!-- Custom tabs (Charts with tabs)--><!-- /.nav-tabs-custom -->

          <!-- Chat box -->
          <div class="box box-info"><!-- /.chat -->
            <div class="box-footer">
            <div class="box-header with-border">
              <h3 class="box-title">Jual Alkes</h3>
            </div>
              <div class="box-body">
              <form method="post">
              <label>Nama Alkes</label>
              <select name="nama_barang[]" class="form-control" required>
              <option>-- Pilih Alkes --</option>
              <?php $q = mysqli_query($koneksi, "select * from master_barang where stok!=0 order by nama_brg ASC"); 
			  while ($d = mysqli_fetch_array($q)) { ?>
              <option value="<?php echo $d['id']; ?>"><?php echo $d['nama_brg']; ?></option>
              <?php } ?>
              </select>
              <div id="input0"></div>
              <p align="center" style="margin-top:10px"><a href="javascript:action();"><span class="label bg-blue">Tambah Alkes</span></a></p>
              
              <label>Tanggal</label>
              <input name="tgl_beli" class="form-control" type="date" placeholder="" required><br />
              <label>Pembeli</label>
              <input name="pembeli" class="form-control" type="text" placeholder="Pembeli" required><br />
              <label>Alamat Pembeli</label>
              <input name="alamat" class="form-control" type="text" placeholder="Alamat Pembeli" required><br />
              <label>Kontak Pembeli</label>
              <input name="telp_pembeli" class="form-control" type="text" placeholder="Kontak Pembeli" required><br />
              <label>Quantity</label>
              <input name="qty" class="form-control" type="text" placeholder="Quantity" required><br />
              
              <button name="tambah_laporan" class="btn btn-info" type="submit"><span class="fa fa-plus"></span> Jual Alkes</button>
              <br /><br />
              </form>
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
  