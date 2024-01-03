<?php 
if (isset($_GET['simpan'])==1) {
	$cek = mysqli_num_rows(mysqli_query($koneksi, "select * from gaji_karyawan_detail_hash where akun_id=".$_SESSION['id'].""));
	if ($cek!=0) {
	//$total = mysqli_fetch_array(mysqli_query($koneksi, "select sum(total) as total_harga from pjp_detail_hash where akun_id=".$_SESSION['id'].""));
	//$total_harga=$total['total_harga']+$_SESSION['ongkir'];
	$cek1 = mysqli_num_rows(mysqli_query($koneksi, "select * from gaji_karyawan"));
	if ($cek1==0){
	$id=1;
	} else {
	$max = mysqli_fetch_array(mysqli_query($koneksi, "select max(id)+1 as idd from gaji_karyawan"));
	$id=$max['idd'];
	}
	$total1 = mysqli_fetch_array(mysqli_query($koneksi, "select sum(gaji_karyawan_detail_hash.total) as total1 from gaji,gaji_karyawan_detail_hash where gaji.id=gaji_karyawan_detail_hash.gaji_id and gaji.kategori='Penerimaan' and akun_id=".$_SESSION['id'].""));
    $total2 = mysqli_fetch_array(mysqli_query($koneksi, "select sum(gaji_karyawan_detail_hash.total) as total1 from gaji,gaji_karyawan_detail_hash where gaji.id=gaji_karyawan_detail_hash.gaji_id and gaji.kategori='Pengeluaran' and akun_id=".$_SESSION['id'].""));
	$total_home_pay=$total1['total1']-$total2['total1'];
	$simpan1 = mysqli_query($koneksi,"insert into keuangan values('','".$_SESSION['tgl_gaji']."','Gaji Karyawan','".$_SESSION['bulan_tahun']."','".$total_home_pay."')");
	$max = mysqli_fetch_array(mysqli_query($koneksi, "select max(id) as id_max from keuangan"));
	$simpan1=mysqli_query($koneksi, "insert into gaji_karyawan values('$id','$max[id_max]','".$_SESSION['tgl_gaji']."','".$_SESSION['karyawan_id']."','".$_SESSION['bulan_tahun']."','".$_SESSION['jumlah_hari_kerja']."','".$_SESSION['catatan']."')");
	$simpan2 = mysqli_query($koneksi,"insert into keuangan_detail values('','$max[id_max]','2','12','62','db')");
	$simpan3 = mysqli_query($koneksi,"insert into keuangan_detail values('','$max[id_max]','3','31','','cr')");
	
	$data1=mysqli_fetch_array(mysqli_query($koneksi, "select max(id) as idd from gaji_karyawan"));
	$idd=$data1['idd'];
	
	//simpan 
	$q2=mysqli_query($koneksi, "select * from gaji_karyawan_detail_hash where akun_id=".$_SESSION['id']."");
	while ($d2 = mysqli_fetch_array($q2)) {
		$cek2 = mysqli_num_rows(mysqli_query($koneksi, "select * from gaji_karyawan_detail"));
	if ($cek2==0){
	$id2=1;
	} else {
	$max = mysqli_fetch_array(mysqli_query($koneksi, "select max(id)+1 as idd from gaji_karyawan_detail"));
	$id2=$max['idd'];
	}
		$simpan2=mysqli_query($koneksi, "insert into gaji_karyawan_detail values('$id2','$idd','".$d2['gaji_id']."','".$d2['besargaji']."','".$d2['dikali']."','".$d2['total']."','".$d2['keterangan']."')");
		
		}
		if ($simpan1 and $simpan2) {
			//$Result = mysqli_query($koneksi, "insert into utang_piutang values('','Piutang','".$_SESSION['no_faktur']."','".$_POST['tgl_input']."','".$_POST['jatuh_tempo']."','".$_POST['nominal']."','".$_POST['klien']."','".$_POST['deskripsi']."','0')");
			mysqli_query($koneksi, "delete from gaji_karyawan_detail_hash where akun_id=".$_SESSION['id']."");
			
				echo "<script type='text/javascript'>
				alert('Data Berhasil Di Simpan !');
				window.location='index.php?page=gaji_karyawan'</script>";
			
		}
	}
	else {
		echo "<script type='text/javascript'>
	alert('Data tidak boleh kosong , silakan tambah terlebih dahulu ! !');
	window.location='index.php?page=pilih_gaji'</script>";
		}
}


if (isset($_POST['simpan_tambah_aksesoris'])) {
	$besar_gaji = mysqli_fetch_array(mysqli_query($koneksi, "select * from gaji where id=".$_POST['gaji_id'].""));
	
	
	$simpan = mysqli_query($koneksi, "insert into gaji_karyawan_detail_hash values('','".$_SESSION['id']."','".$_POST['gaji_id']."','".str_replace(".","",$_POST['besar_gaji'])."','".$_POST['qty']."','".($_POST['qty']*str_replace(".","",$_POST['besar_gaji']))."','".$_POST['keterangan']."')");
	if ($simpan) {
		echo "<script>window.location='index.php?page=pilih_gaji'</script>";
		}
	/*} else {
		echo "<script>alert('Maaf , Stok Tidak Mencukupi !');
		</script>";
		}*/
	}
	
if (isset($_GET['id_hapus'])) {
	$del = mysqli_query($koneksi, "delete from gaji_karyawan_detail_hash where id=".$_GET['id_hapus']."");
	}
?>
<script type="text/javascript">
function sum() {
      var txtFirstNumberValue = document.getElementById('besar_gaji').value;
      var txtSecondNumberValue = document.getElementById('qty').value;
	  //var txtThirdNumberValue = document.getElementById('diskon').value;
      var result = parseFloat(txtFirstNumberValue) * parseFloat(txtSecondNumberValue);
      if (!isNaN(result)) {
         document.getElementById('total').value = result;
      }
}
</script>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
  <section class="content-header">
      <h1>
    Tambah Gaji</h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active"> Tambah Gaji</li>
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
              <div class="box-body table-responsive no-padding">
              <div class="">
              <!--<a href="index.php?page=tambah_barang_masuk"><button name="tambah_laporan" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Tambah Barang</button></a>-->
              
                <table width="100%" id="" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th valign="bottom">Tgl Dikeluarkan Gaji</th>
      <th valign="bottom"><strong>Nama Karyawan</strong></th>
      <th valign="bottom">Bulan dan Tahun Penggajian</th>
      <th valign="bottom"><strong>Jumlah Hari Kerja</strong></th>
      <th valign="bottom">Catatan</th>
      </tr>
  </thead>
  <tr>
    <td><?php echo date("d-m-Y",strtotime($_SESSION['tgl_gaji'])); ?></td>
    <td><?php $d_kar=mysqli_fetch_array(mysqli_query($koneksi, "select * from karyawan where id=".$_SESSION['karyawan_id'].""));
	echo $d_kar['nama_karyawan']; ?></td>
    <td><?php echo $_SESSION['bulan_tahun']; ?></td>
    <td><?php echo $_SESSION['jumlah_hari_kerja']." hari"; ?></td>
    <td><?php echo $_SESSION['catatan']; ?></td>
    </tr>
</table><br />

<div class="well">
<h4 align="center">Tambah Gaji</h4>
<form method="post">
<label>Nama Gaji</label>
<select name="gaji_id" id="gaji_id" class="form-control select2" autofocus="autofocus" required onchange="changeValue(this.value)" style="width:100%">
    	<option value="">-- Pilih Gaji --</option>
        <?php 
		$q = mysqli_query($koneksi, "select * from gaji order by id ASC");
		$jsArray = "var dtBrg = new Array();
";
		while ($d = mysqli_fetch_array($q)) { ?>
        <option value="<?php echo $d['id']; ?>"><?php echo $d['nama_gaji']." - ".$d['kategori']; ?></option>
        <?php
		
		 
		$jsArray .= "dtBrg['" . $d['id'] . "'] = {kategori:'".addslashes($d['kategori'])."',besar_gaji:'".addslashes(number_format($d['besar_gaji'],0,',','.'))."'
						};";
		} ?>
    </select><br /><br />
    <label>Kategori</label>
    <input id="kategori" name="tipe_akse" class="form-control" type="text" placeholder="Kategori" disabled="disabled" size="5"/><br />
    <label>Besaran Gaji</label>
    <input id="besar_gaji" name="besar_gaji" class="form-control" type="text" placeholder="" size="18" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this); sum();"/><br />
    <label>Dikali</label>
    <input id="qty" name="qty" class="form-control" type="number" placeholder="" size="4" onkeyup="sum();" required="required"/><br />
    <label>Total</label>
    <input value="Otomatis Terjumlah" name="total" class="form-control" type="text" placeholder="" size="9" disabled="disabled"/><br />
    <label>Keterangan</label>
    <input name="keterangan" class="form-control" type="text" placeholder=""/><br />
    <button name="simpan_tambah_aksesoris" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Tambah</button>
</form>
</div>
                <table width="100%" id="example1" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th valign="bottom">No</th>
      <th valign="bottom"><strong>Nama Gaji</strong></th>
      <td align="center" valign="bottom"><strong>Kategori</strong></td>
      
      <td align="center" valign="bottom"><strong>Besaran Gaji</strong></td>
      <td align="center" valign="bottom"><strong>Dikali</strong></td>
      <td valign="bottom"><strong>Total</strong></td>
      <td valign="bottom"><strong>Keterangan</strong></td>      
      <td align="center" valign="bottom"><strong>Aksi</strong></td>
     </tr>
  </thead>
  
  <script type="text/javascript">    
	<?php 
	echo $jsArray; 
	?>  
	function changeValue(gaji_id){  
		document.getElementById('kategori').value = dtBrg[gaji_id].kategori;
		document.getElementById('besar_gaji').value = dtBrg[gaji_id].besar_gaji;
	};  
</script>
  <?php
   
  $no=0;
  $q_akse = mysqli_query($koneksi, "select *,gaji_karyawan_detail_hash.id as idd from gaji_karyawan_detail_hash,gaji where gaji.id=gaji_karyawan_detail_hash.gaji_id and akun_id=".$_SESSION['id']."");
  $jm = mysqli_num_rows($q_akse);
  if ($jm!=0) { 
  while ($data_akse = mysqli_fetch_array($q_akse)) {
	  $no++;
  ?>
  <tr>
    <td><?php echo $no; ?></td>
    <td><?php echo $data_akse['nama_gaji']; ?>
    </td>
    
    <td align="center"><?php echo $data_akse['kategori']; ?></td>
    
    <td align="center"><?php echo "Rp".number_format($data_akse['besargaji'],2,',','.'); ?></td>
    <td align="center"><?php echo $data_akse['dikali']; ?></td>
    <td><?php echo "Rp".number_format($data_akse['besargaji']*$data_akse['dikali'],2,',','.'); ?></td>
    <td><?php echo $data_akse['keterangan']; ?></td>
    <td align="center"><a href="index.php?page=pilih_gaji&id_hapus=<?php echo $data_akse['idd']; ?>" onclick="return confirm('Yakin Akan Menghapus Item Ini ?')"><span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span></a></td>
    </tr>
  <?php }} else {
	  echo "<tr><td colspan='9' align='center'>Tidak Ada Data</td></tr>";
	  } ?>
    <tr bgcolor="#009900">
    <td colspan="11"></td>
    </tr>
    <tr>
      <td colspan="5" align="right">Total Penerimaan</td>
      <td><?php
      $total1 = mysqli_fetch_array(mysqli_query($koneksi, "select sum(gaji_karyawan_detail_hash.total) as total1 from gaji,gaji_karyawan_detail_hash where gaji.id=gaji_karyawan_detail_hash.gaji_id and gaji.kategori='Penerimaan' and akun_id=".$_SESSION['id'].""));
	  echo "Rp".number_format($total1['total1'],2,',','.');
	  ?></td>
      <td>&nbsp;</td>
      <td align="center"></td>
    </tr>
    <tr>
      <td colspan="5" align="right">Total Potongan</td>
      <td><?php
      $total2 = mysqli_fetch_array(mysqli_query($koneksi, "select sum(gaji_karyawan_detail_hash.total) as total1 from gaji,gaji_karyawan_detail_hash where gaji.id=gaji_karyawan_detail_hash.gaji_id and gaji.kategori='Pengeluaran' and akun_id=".$_SESSION['id'].""));
	  echo "Rp".number_format($total2['total1'],2,',','.');
	  ?></td>
      <td>&nbsp;</td>
      <td align="center"></td>
    </tr>
    
    <tr>
      <td colspan="5" align="right"><strong>Total Home Pay</strong></td>
      <td><strong>
        <?php 
	$total_home_pay=$total1['total1']-$total2['total1'];
	echo "Rp".number_format($total_home_pay,2,',','.'); ?>
      </strong></td>
      <td>&nbsp;</td>
      <td align="center"></td>
    </tr>
    <tr>
      <td colspan="8" align="right">
        <center><!--<a href="index.php?page=simpan_jual_alkes2&simpan_barang=1"><button name="simpan_barang" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Simpan</button></a>--><a href="index.php?page=pilih_gaji&simpan=1"><button name="simpan" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Simpan</button></a>&nbsp;&nbsp;<a href="index.php?page=gaji_karyawan"><button name="batal" class="btn btn-success" type="button"><span class="fa  fa-times-circle"></span> Batal</button></a></center>
        </td>
    </tr>
      
                </table>
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