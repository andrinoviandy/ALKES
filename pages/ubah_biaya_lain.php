<?php
$data = mysqli_fetch_array(mysqli_query($koneksi, "select * from biaya_lain,buku_kas,keuangan,keuangan_detail where buku_kas.id=biaya_lain.buku_kas_id and keuangan.id=biaya_lain.keuangan_id and keuangan.id=keuangan_detail.keuangan_id and biaya_lain.id=".$_GET['id_ubah'].""));

if (isset($_POST['tambah_header'])) {
    $cek_saldo = mysqli_fetch_array(mysqli_query($koneksi, "select * from buku_kas where id=".$_POST['buku_kas_id'].""));
	$nom= str_replace(".","",$_POST['harga']);
	if ($_POST['jenis_transaksi']=='Pembayaran') {	
	if ($cek_saldo['saldo'] < $nom) {
        echo "<script type='text/javascript'>
		alert('Gagal Disimpan , Saldo Pada Buku Kas Ini Kurang Dari Nominal Yang Di Masukkan ! Silakan Tambah Saldo Atau Gunakan Buku Kas Lain !');
		window.location='index.php?page=biaya_lain'
		</script>";
        }
        else {
			$coa = mysqli_fetch_array(mysqli_query($koneksi, "SELECT *,coa_sub_akun.id as idd FROM coa,coa_sub,coa_sub_akun where coa.id=coa_sub.coa_id and coa_sub.id=coa_sub_akun.coa_sub_id and coa_sub_akun.id=$_POST[coa_id]"));
			
	$Result1 = mysqli_query($koneksi, "update biaya_lain,keuangan,buku_kas set biaya_lain.buku_kas_id='".$_POST['buku_kas_id']."', biaya_lain.jenis_transaksi='".$_POST['jenis_transaksi']."',biaya_lain.tgl='".$_POST['tanggal']."',biaya_lain.penerima='".$_POST['penerima']."',biaya_lain.deskripsi='".$_POST['deskripsi']."',biaya_lain.harga='".$nom."',keuangan.tgl_transaksi='".$_POST['tanggal']."',keuangan.deskripsi='".$_POST['deskripsi']."',keuangan.saldo='".$nom."',buku_kas.saldo=buku_kas.saldo+$data[harga] where keuangan.id=biaya_lain.keuangan_id and buku_kas.id=biaya_lain.buku_kas_id and biaya_lain.id=$_GET[id_ubah]");
	$del_keuangan = mysqli_query($koneksi, "delete from keuangan_detail where keuangan_id=".$data['keuangan_id']."");
	//$Result = mysqli_query($koneksi, "update biaya_lain,keuangan,keuangan_detail,buku_kas set biaya_lain.buku_kas_id='".$_POST['buku_kas_id']."',biaya_lain.jenis_transaksi='".$_POST['jenis_transaksi']."',biaya_lain.tgl='".$_POST['tanggal']."',biaya_lain.penerima='".$_POST['penerima']."',biaya_lain.deskripsi='".$_POST['deskripsi']."',biaya_lain.harga='".$nom."',keuangan_detail.coa_id='".$_POST['coa_id']."',keuangan_detail.coa_sub_id='".$_POST['coa_sub_id']."',keuangan_detail.coa_sub_akun_id='".$_POST['coa_sub_akun_id']."',keuangan.tgl_transaksi='".$_POST['tanggal']."',keuangan.deskripsi='".$_POST['deskripsi']."',keuangan.saldo='".$nom."',buku_kas.saldo=buku_kas.saldo+$data[harga] where keuangan.id=biaya_lain.keuangan_id and buku_kas.id=biaya_lain.buku_kas_id and keuangan.id=keuangan_detail.keuangan_id and biaya_lain.id=$_GET[id_ubah]");
	if ($Result1) {
		if ($_POST['coa_id']==1) {
	$simpan_keuangan_detail = mysqli_query($koneksi,"insert into keuangan_detail values('','$data[keuangan_id]','".$_POST['coa_id']."','".$_POST['coa_sub_id']."','".$_POST['coa_sub_akun_id']."','db')");
	} else {
	$simpan_keuangan_detail = mysqli_query($koneksi,"insert into keuangan_detail values('','$data[keuangan_id]','".$_POST['coa_id']."','".$_POST['coa_sub_id']."','".$_POST['coa_sub_akun_id']."','cr')");
	}
		
		if ($_POST['coa_id']==5) {
		$simpan_keuangan_detail2 = mysqli_query($koneksi,"insert into keuangan_detail values('','$data[keuangan_id]','3','32','','cr')");
		}
		$cek_saldo2 = mysqli_fetch_array(mysqli_query($koneksi, "select * from buku_kas where id=".$_POST['buku_kas_id'].""));	
        $saldo_kurang= $cek_saldo2['saldo'] - $nom;
        $up=mysqli_query($koneksi, "update buku_kas set saldo='".$saldo_kurang."' where id=$_POST[buku_kas_id]");
            echo "<script type='text/javascript'>
        alert('Perubahan Berhasil Disimpan !');
        window.location='index.php?page=biaya_lain'
        </script>";
    }else{
        echo "<script type='text/javascript'>
        alert('Gagal Disimpan !');
        history.back();
        </script>";
        }
    }
	} 
	else {
		//$coa = mysqli_fetch_array(mysqli_query($koneksi, "SELECT *,coa_sub_akun.id as idd FROM coa,coa_sub,coa_sub_akun where coa.id=coa_sub.coa_id and coa_sub.id=coa_sub_akun.coa_sub_id and coa_sub_akun.id=$_POST[coa_id]"));
		
	$Result1 = mysqli_query($koneksi, "update biaya_lain,keuangan,buku_kas set biaya_lain.buku_kas_id='".$_POST['buku_kas_id']."', biaya_lain.jenis_transaksi='".$_POST['jenis_transaksi']."',biaya_lain.tgl='".$_POST['tanggal']."',biaya_lain.penerima='".$_POST['penerima']."',biaya_lain.deskripsi='".$_POST['deskripsi']."',biaya_lain.harga='".$nom."',keuangan.tgl_transaksi='".$_POST['tanggal']."',keuangan.deskripsi='".$_POST['deskripsi']."',keuangan.saldo='".$nom."',buku_kas.saldo=buku_kas.saldo-$data[harga] where keuangan.id=biaya_lain.keuangan_id and buku_kas.id=biaya_lain.buku_kas_id and biaya_lain.id=$_GET[id_ubah]");
	$del_keuangan = mysqli_query($koneksi, "delete from keuangan_detail where keuangan_id=".$data['keuangan_id'].""); 
	
	//mysqli_query($koneksi, "update biaya_lain,keuangan,keuangan_detail,buku_kas set biaya_lain.buku_kas_id='".$_POST['buku_kas_id']."',biaya_lain.jenis_transaksi='".$_POST['jenis_transaksi']."',biaya_lain.tgl='".$_POST['tanggal']."',biaya_lain.penerima='".$_POST['penerima']."',biaya_lain.deskripsi='".$_POST['deskripsi']."',biaya_lain.harga='".$nom."',keuangan_detail.coa_id='".$_POST['coa_id']."',keuangan_detail.coa_sub_id='".$_POST['coa_sub_id']."',keuangan_detail.coa_sub_akun_id='".$_POST['coa_sub_akun_id']."',keuangan.tgl_transaksi='".$_POST['tanggal']."',keuangan.deskripsi='".$_POST['deskripsi']."',keuangan.saldo='".$nom."',buku_kas.saldo=buku_kas.saldo-$data[harga] where keuangan.id=biaya_lain.keuangan_id and buku_kas.id=biaya_lain.buku_kas_id and keuangan.id=keuangan_detail.keuangan_id and biaya_lain.id=$_GET[id_ubah]");
	if ($Result1) {
		if ($_POST['coa_id']==1) {
	$simpan_keuangan_detail = mysqli_query($koneksi,"insert into keuangan_detail values('','$data[keuangan_id]','".$_POST['coa_id']."','".$_POST['coa_sub_id']."','".$_POST['coa_sub_akun_id']."','cr')");
	} else {
	$simpan_keuangan_detail = mysqli_query($koneksi,"insert into keuangan_detail values('','$data[keuangan_id]','".$_POST['coa_id']."','".$_POST['coa_sub_id']."','".$_POST['coa_sub_akun_id']."','db')");
	}
		
		if ($_POST['coa_id']==4) {
		$simpan_keuangan_detail2 = mysqli_query($koneksi,"insert into keuangan_detail values('','$data[keuangan_id]','3','32','','db')");
		}
		$cek_saldo2 = mysqli_fetch_array(mysqli_query($koneksi, "select * from buku_kas where id=".$_POST['buku_kas_id'].""));	
        $saldo_kurang= $cek_saldo2['saldo'] + $nom;
        $up=mysqli_query($koneksi, "update buku_kas set saldo='".$saldo_kurang."' where id=$_POST[buku_kas_id]");
            echo "<script type='text/javascript'>
        alert('Perubahan Berhasil Disimpan !');
        window.location='index.php?page=biaya_lain'
        </script>";
    }else{
        echo "<script type='text/javascript'>
        alert('Gagal Disimpan !');
        history.back();
        </script>";
        }
	}
}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><span class="active">Ubah Penerimaan &amp; Pembayaran</span></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Biaya Lain</li>
        <li class="active">Ubah Biaya Lain</li>
      </ol>
    </section>


    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) --><!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-5 connectedSortable">
          <!-- Custom tabs (Charts with tabs)--><!-- /.nav-tabs-custom -->

          <!-- Chat box -->
          <div class="box box-success"><!-- /.chat -->
            <div class="box-footer">
            <div class="box-header with-border">
              <h3 class="box-title">Ubah <span class="active">Biaya Lain</span></h3>
            </div>
              <div class="box-body">
              <form method="post">
              <label>Jenis Transaksi</label>
              <select required name="jenis_transaksi" class="form-control select2" style="width:100%" >
              <option value="">-- Pilih --</option>
              <option <?php if ($data['jenis_transaksi']=='Penerimaan') {echo "selected";} ?> value="Penerimaan">Penerimaan</option>
              <option <?php if ($data['jenis_transaksi']=='Pembayaran') {echo "selected";} ?> value="Pembayaran">Pembayaran</option>
              </select>
              <br /><br />
              <label>Tanggal</label>
              <input name="tanggal" class="form-control" type="date" placeholder="" value="<?php echo $data['tgl']; ?>" required="required"><br />
              <label>Akun Bank / Kas</label>
              <select name="buku_kas_id" class="form-control select2" style="width:100%" required>
              <option value="">-- Pilih --</option>
              <?php $query = mysqli_query($koneksi,"SELECT id,nama_akun FROM buku_kas"); 
              while ($row = mysqli_fetch_array($query)) {
              ?> 
              <option <?php if ($data['buku_kas_id']==$row['id']) {echo "selected";} ?> value="<?php echo $row['id'];?>"><?php echo $row['nama_akun'];?></option>
              <?php } ?>
              </select>
              <br /><br />
              <label>Diterima Oleh / Diterima Dari</label>
              <input name="penerima" class="form-control" type="text" placeholder="" value="<?php echo $data['penerima']; ?>"><br />
              <label>Akun</label>
              <div class="well">
              <select required name="coa_id" class="form-control" id="coa_id">
              <option value="">-- Pilih --</option>
              <?php $query1 = mysqli_query($koneksi,"SELECT * FROM coa");
              while ($row1= mysqli_fetch_array($query1)) {
              ?>
              <option <?php if ($data['coa_id']==$row1['id']) {echo "selected";} ?> value="<?php echo $row1['id']?>"><?php echo $row1['nama_grup'];?></option>
              <?php }?>
              </select><br />
              <select required name="coa_sub_id" class="form-control" id="coa_sub_id">
              <option value="">-- Pilih --</option>
              <?php $query2 = mysqli_query($koneksi,"SELECT *,coa_sub.id as idd FROM coa_sub INNER JOIN coa ON coa.id=coa_sub.coa_id");
              while ($row1= mysqli_fetch_array($query2)) {
              ?>
              <option <?php if ($data['coa_sub_id']==$row1['idd']) {echo "selected";} ?> id="coa_sub_id" class="<?php echo $row1['coa_id']; ?>" value="<?php echo $row1['idd']?>"><?php echo $row1['nama_sub_grup'];?></option>
              <?php }?>
              </select><br />
              <select name="coa_sub_akun_id" class="form-control select2" style="width:100%" id="coa_sub_akun_id">
              <option value="">-- Pilih --</option>
              <?php $query3 = mysqli_query($koneksi,"SELECT *,coa_sub_akun.id as idd FROM coa_sub_akun INNER JOIN coa_sub ON coa_sub.id=coa_sub_akun.coa_sub_id");
              while ($row1= mysqli_fetch_array($query3)) {
              ?>
              <option <?php if ($data['coa_sub_akun_id']==$row1['idd']) {echo "selected";} ?> id="coa_sub_akun_id" class="<?php echo $row1['coa_sub_id']; ?>" value="<?php echo $row1['idd']?>"><?php echo $row1['nama_akun'];?></option>
              <?php } ?>
              </select>
              <script src="jquery-1.10.2.min.js"></script>
        <script src="jquery.chained.min.js"></script>
        <script>
            $("#coa_sub_id").chained("#coa_id");
			$("#coa_sub_akun_id").chained("#coa_sub_id");
        </script>
              </div>
              <label>Deskripsi</label>
              <textarea name="deskripsi" class="form-control" rows="4"><?php echo $data['deskripsi']; ?></textarea><br />
              <label>Harga</label>
              <input name="harga" class="form-control" type="text" placeholder="" value="<?php echo number_format($data['harga'],0,',','.'); ?>" required="required" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);"><br />
              
              <button name="tambah_header" class="btn btn-success" type="submit"><span class="fa fa-check"></span> Simpan Perubahan</button>
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
  