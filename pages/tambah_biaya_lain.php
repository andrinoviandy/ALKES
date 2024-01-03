<?php
if (isset($_POST['tambah_header'])) {
    $cek_saldo = mysqli_fetch_array(mysqli_query($koneksi, "select * from buku_kas where id=".$_POST['buku_kas_id'].""));
	
	if ($_POST['jenis_transaksi']=='Pembayaran') {	
	$nom= str_replace(".","",$_POST['harga']);
	if ($cek_saldo['saldo'] < $nom) {
        echo "<script type='text/javascript'>
		alert('Gagal Disimpan , Saldo Pada Buku Kas Ini Kurang Dari Nominal Yang Di Masukkan ! Silakan Tambah Saldo Atau Gunakan Buku Kas Lain !');
		window.location='index.php?page=biaya_lain'
		</script>";
        }
        else{
	$simpan_keuangan = mysqli_query($koneksi,"insert into keuangan values('','".$_POST['tanggal']."','".$_POST['jenis_transaksi']."','".$_POST['deskripsi']."','".$nom."')");
	$max = mysqli_fetch_array(mysqli_query($koneksi, "select max(id) as id_max from keuangan"));
	//$coa = mysqli_fetch_array(mysqli_query($koneksi, "SELECT *,coa_sub_akun.id as idd FROM coa,coa_sub,coa_sub_akun where coa.id=coa_sub.coa_id and coa_sub.id=coa_sub_akun.coa_sub_id and coa_sub_akun.id=$_POST[coa_id]"));
	if ($_POST['coa_id']==1) {
	$simpan_keuangan_detail = mysqli_query($koneksi,"insert into keuangan_detail values('','$max[id_max]','".$_POST['coa_id']."','".$_POST['coa_sub_id']."','".$_POST['coa_sub_akun_id']."','db')");
	} else {
	$simpan_keuangan_detail = mysqli_query($koneksi,"insert into keuangan_detail values('','$max[id_max]','".$_POST['coa_id']."','".$_POST['coa_sub_id']."','".$_POST['coa_sub_akun_id']."','cr')");
	}
	if ($_POST['coa_id']==5) {
	$simpan_keuangan_detail2 = mysqli_query($koneksi,"insert into keuangan_detail values('','$max[id_max]','3','32','','cr')");
	}
	$Result = mysqli_query($koneksi, "insert into biaya_lain values('','$max[id_max]','".$_POST['buku_kas_id']."','".$_POST['jenis_transaksi']."','".$_POST['tanggal']."','".$_POST['penerima']."','".$_POST['deskripsi']."','".$nom."')");
	if ($simpan_keuangan and $Result and $simpan_keuangan_detail) {	
        $saldo_kurang= $cek_saldo['saldo'] - $nom;
        $up=mysqli_query($koneksi, "update buku_kas set saldo='".$saldo_kurang."' where id=$_POST[buku_kas_id]");
            echo "<script type='text/javascript'>
        alert('Berhasil Disimpan !');
        window.location='index.php?page=biaya_lain'
        </script>";
    }else{
        echo "<script type='text/javascript'>
        alert('Gagal Disimpan !');
        history.back();
        </script>";
        }
    }} 
	
	else {
		$nom= str_replace(".","",$_POST['harga']);
	$simpan_keuangan = mysqli_query($koneksi,"insert into keuangan values('','".$_POST['tanggal']."','".$_POST['jenis_transaksi']."','".$_POST['deskripsi']."','".$nom."')");
	$max = mysqli_fetch_array(mysqli_query($koneksi, "select max(id) as id_max from keuangan"));
	//$coa = mysqli_fetch_array(mysqli_query($koneksi, "SELECT *,coa_sub_akun.id as idd FROM coa,coa_sub,coa_sub_akun where coa.id=coa_sub.coa_id and coa_sub.id=coa_sub_akun.coa_sub_id and coa_sub_akun.id=$_POST[coa_id]"));
	if ($_POST['coa_id']==1) {
	$simpan_keuangan_detail = mysqli_query($koneksi,"insert into keuangan_detail values('','$max[id_max]','".$_POST['coa_id']."','".$_POST['coa_sub_id']."','".$_POST['coa_sub_akun_id']."','cr')");
	} else {
	$simpan_keuangan_detail = mysqli_query($koneksi,"insert into keuangan_detail values('','$max[id_max]','".$_POST['coa_id']."','".$_POST['coa_sub_id']."','".$_POST['coa_sub_akun_id']."','db')");
	}
	if ($_POST['coa_id']==4) {
	$simpan_keuangan_detail2 = mysqli_query($koneksi,"insert into keuangan_detail values('','$max[id_max]','3','32','','db')");
	}
	$Result = mysqli_query($koneksi, "insert into biaya_lain values('','$max[id_max]','".$_POST['buku_kas_id']."','".$_POST['jenis_transaksi']."','".$_POST['tanggal']."','".$_POST['penerima']."','".$_POST['deskripsi']."','".$nom."')");
	if ($simpan_keuangan and $Result and $simpan_keuangan_detail) {	
        $saldo_kurang= $cek_saldo['saldo'] + $nom;
        $up=mysqli_query($koneksi, "update buku_kas set saldo='".$saldo_kurang."' where id=$_POST[buku_kas_id]");
            echo "<script type='text/javascript'>
        alert('Berhasil Disimpan !');
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
      <h1><span class="active">Tambah Penerimaan &amp; Pembayaran Lain</span></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Biaya Lain</li>
        <li class="active">Tambah Biaya Lain</li>
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
              <h3 class="box-title">Tambah Biaya Lain</h3>
            </div>
              <div class="box-body">
              <form method="post">
              <label>Jenis Transaksi</label>
              <select required name="jenis_transaksi" class="form-control select2" style="width:100%" >
              <option value="">-- Pilih --</option>
              <option value="Penerimaan">Penerimaan</option>
              <option value="Pembayaran">Pembayaran</option>
              </select>
              <br /><br />
              <label>Tanggal</label>
              <input name="tanggal" class="form-control" type="date" placeholder="" value="" required="required"><br />
              <label>Akun Bank / Kas</label>
              <select name="buku_kas_id" class="form-control select2" style="width:100%" required>
              <option value="">-- Pilih --</option>
              <?php $query = mysqli_query($koneksi,"SELECT id,nama_akun FROM buku_kas"); 
              while ($row = mysqli_fetch_array($query)) {
              ?>
              <option value="<?php echo $row['id'];?>"><?php echo $row['nama_akun'];?></option>
              <?php } ?>
              </select>
              <br /><br />
              <label>Diterima Oleh / Diterima Dari</label>
              <input name="penerima" class="form-control" type="text" placeholder=""><br />
              <label>Akun</label>
              <div class="well">
              <select required name="coa_id" class="form-control" id="coa_id">
              <option value="">-- Pilih --</option>
              <?php $query1 = mysqli_query($koneksi,"SELECT * FROM coa");
              while ($row1= mysqli_fetch_array($query1)) {
              ?>
              <option value="<?php echo $row1['id']?>"><?php echo $row1['nama_grup'];?></option>
              <?php }?>
              </select><br />
              <select required name="coa_sub_id" class="form-control" id="coa_sub_id">
              <option value="">-- Pilih --</option>
              <?php $query2 = mysqli_query($koneksi,"SELECT *,coa_sub.id as idd FROM coa_sub INNER JOIN coa ON coa.id=coa_sub.coa_id and coa_sub.id!=2 and coa_sub.id!=9");
              while ($row1= mysqli_fetch_array($query2)) {
              ?>
              <option id="coa_sub_id" class="<?php echo $row1['coa_id']; ?>" value="<?php echo $row1['idd']?>"><?php echo $row1['nama_sub_grup'];?></option>
              <?php }?>
              </select><br />
              <select name="coa_sub_akun_id" class="form-control select2" style="width:100%" id="coa_sub_akun_id">
              <option value="">-- Pilih --</option>
              <?php $query3 = mysqli_query($koneksi,"SELECT *,coa_sub_akun.id as idd FROM coa_sub_akun INNER JOIN coa_sub ON coa_sub.id=coa_sub_akun.coa_sub_id");
              while ($row1= mysqli_fetch_array($query3)) {
              ?>
              <option id="coa_sub_akun_id" class="<?php echo $row1['coa_sub_id']; ?>" value="<?php echo $row1['idd']?>"><?php echo $row1['nama_akun'];?></option>
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
              <textarea name="deskripsi" class="form-control" rows="4"></textarea><br />
              <label>Harga</label>
              <input name="harga" class="form-control" type="text" placeholder="" value="" required="required" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);"><br />
              
              <button name="tambah_header" class="btn btn-success" type="submit"><span class="fa fa-check"></span> Simpan</button>
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
  