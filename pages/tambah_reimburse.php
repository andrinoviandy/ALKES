<?php
if (isset($_POST['tambah_header'])) {
    $cek_saldo = mysqli_fetch_array(mysqli_query($koneksi, "select * from buku_kas where id=".$_POST['akun'].""));
	$nom = str_replace(".","",$_POST['nominal']);	
	if ($cek_saldo['saldo'] < $nom) {
		
        echo "<script type='text/javascript'>
		alert('Gagal Disimpan , Saldo Pada Buku Kas Ini Kurang Dari Nominal Yang Di Masukkan ! Silakan Tambah Saldo Atau Gunakan Buku Kas Lain !');
		window.location='index.php?page=reimburse'
		</script>";
        // echo "<script type='text/javascript'>
		// alert('Data Berhasil Di Simpan !');
		// window.location='index.php?page=reimburse'
		// 
        }
        else {
			$simpan1 = mysqli_query($koneksi,"insert into keuangan values('','".$_POST['tgl']."','Reimburse','".$_POST['keterangan']."','".$nom."')");
	$max = mysqli_fetch_array(mysqli_query($koneksi, "select max(id) as id_max from keuangan"));
            $Result = mysqli_query($koneksi, "insert into reimburse values('','$max[id_max]','".$_POST['tgl']."','".$_POST['diterima_dari']."','".$_POST['diterima_oleh']."','".$_POST['akun']."','".$nom."','".$_POST['keterangan']."')");
			$simpan2 = mysqli_query($koneksi,"insert into keuangan_detail values('','$max[id_max]','2','12','62','db')");
			$simpan3 = mysqli_query($koneksi,"insert into keuangan_detail values('','$max[id_max]','3','32','','cr')");
            if ($Result) {
                $saldo_kurang= $cek_saldo['saldo'] - $nom;
                $up=mysqli_query($koneksi, "update buku_kas set saldo='".$saldo_kurang."' where id=$_POST[akun]");
                    echo "<script type='text/javascript'>
                alert('Pembayaran Berhasil Disimpan !');
                window.location='index.php?page=reimburse'
                </script>";
            } else {
                echo "<script type='text/javascript'>
                alert('Pembayaran Gagal Disimpan !');
                window.location='index.php?page=reimburse'
                </script>";
				
            }
        }
	}

if (isset($_POST['simpan'])) {
	$q = mysqli_query($koneksi, "INSER INTO reimburse values('','','','','','')");
	if ($q) {
		echo "<script>
		alert('Data Berhasil Di Simpan !');
		window.location='index.php?page=mencoba'
		alert('Data Berhasil Di Ubah');
		alert('Semua Nya Sama')
		</script>";
		}
	}

?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><span class="active">Tambah Hutang</span></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Hutang</li>
        <li class="active">Tambah Hutang</li>
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
              <h3 class="box-title">Tambah <span class="active">Reimburse</span></h3>
            </div>
              <div class="box-body">
              <form method="post">
              <label>Tanggal</label>
              <input name="tgl" class="form-control" type="date" placeholder="" required="required" autofocus="autofocus"><br />
              <label>Diterima Dari</label>
              <select name="diterima_dari" class="form-control select2" style="width:100%" required="required">
              <option value="">...</option>
                <option disabled="disabled"><strong>Karyawan</strong></option>
                <?php
              $q1 = mysqli_query($koneksi, "select *,karyawan.id as idd from karyawan order by nama_karyawan ASC");
			  $jsArray = "var dtBrg = new Array();
";
			  while ($data = mysqli_fetch_array($q1)) {
			  ?>
                <option value="<?php echo $data['idd']; ?>">- <?php echo $data['nama_karyawan']; ?></option>
                <?php } ?>
              </select>
              <br /><br /> 
              <label>Diterima Oleh</label>
              <input name="diterima_oleh" class="form-control" placeholder="" required="required"/>
              <br />
              <label>Akun</label>
              <select name="akun" id="akun" class="form-control select2" required style="width:100%">
              <option value="">-- Pilih --</option>
              <?php
              $q = mysqli_query($koneksi, "select * from buku_kas order by no_akun ASC");
			  while ($d=mysqli_fetch_array($q)) {
			  ?>
              <option value="<?php echo $d['id']; ?>"><?php echo $d['no_akun']." | &nbsp;&nbsp;".$d['nama_akun']; ?></option>
              <?php } ?>
              </select><br /><br />
              <label>Nominal</label>
              <input type="text" name="nominal" class="form-control" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);"><br>
              <label>Keterangan</label>
              <textarea name="keterangan" class="form-control" rows="4"></textarea><br />
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
  