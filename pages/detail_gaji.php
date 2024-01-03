<?php 
$data = mysqli_fetch_array(mysqli_query($koneksi, "select * from gaji_karyawan where id=$_GET[id]"));

if (isset($_POST['ubahdetailgaji'])) {
	//$besar_gaji = mysqli_fetch_array(mysqli_query($koneksi, "select * from gaji where id=".$_POST['gaji_id2'].""));
	$simpan = mysqli_query($koneksi, "update gaji_karyawan_detail set gaji_id='".$_POST['gaji_id2']."',besargaji='".str_replace(".","",$_POST['besar_gaji2'])."',dikali='".$_POST['qty2']."',total='".($_POST['qty2']*str_replace(".","",$_POST['besar_gaji2']))."',keterangan='".$_POST['keterangan2']."' where id=$_POST[id_ubah]");
	if ($simpan) {
		$sl = mysqli_fetch_array(mysqli_query($koneksi, "select sum(total) as tot from gaji_karyawan_detail where gaji_karyawan_id=".$_GET['id'].""));
		mysqli_query($koneksi,"update keuangan set saldo=$sl[tot] where id=".$data['keuangan_id']."");
		echo "<script>window.location='index.php?page=detail_gaji&id=$_GET[id]'</script>";
		}
	}

if (isset($_POST['simpan_tambah_aksesoris'])) {
	
	$simpan = mysqli_query($koneksi, "insert into gaji_karyawan_detail values('','".$_GET['id']."','".$_POST['gaji_id']."','".str_replace(".","",$_POST['besar_gaji'])."','".$_POST['qty']."','".($_POST['qty']*str_replace(".","",$_POST['besar_gaji']))."','".$_POST['keterangan']."')");
	if ($simpan) {
		$sl = mysqli_fetch_array(mysqli_query($koneksi, "select sum(total) as tot from gaji_karyawan_detail where gaji_karyawan_id=".$_GET['id'].""));
		mysqli_query($koneksi,"update keuangan set saldo=$sl[tot] where id=".$data['keuangan_id']."");
		echo "<script>window.location='index.php?page=detail_gaji&id=$_GET[id]'</script>";
		}
	}
	
if (isset($_GET['id_hapus'])) {
	$del = mysqli_query($koneksi, "delete from gaji_karyawan_detail where id=".$_GET['id_hapus']."");
	if ($del) {
		$sl = mysqli_fetch_array(mysqli_query($koneksi, "select sum(total) as tot from gaji_karyawan_detail where gaji_karyawan_id=".$_GET['id'].""));
		mysqli_query($koneksi,"update keuangan set saldo=$sl[tot] where id=".$data['keuangan_id']."");
		echo "<script>window.location='index.php?page=detail_gaji&id=$_GET[id]'</script>";
		}
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
function sum2() {
      var txtFirstNumberValue = document.getElementById('besar_gaji2').value;
      var txtSecondNumberValue = document.getElementById('qty2').value;
	  //var txtThirdNumberValue = document.getElementById('diskon').value;
      var result = parseFloat(txtFirstNumberValue) * parseFloat(txtSecondNumberValue);
      if (!isNaN(result)) {
         document.getElementById('total2').value = result;
      }
}
</script>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
  <section class="content-header">
      <h1>
    Detail Gaji</h1>
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
      </tr>
  </thead>
  <tr>
    <td><?php echo date("d-m-Y",strtotime($data['tgl_gaji'])); ?></td>
    <td><?php $d_kar=mysqli_fetch_array(mysqli_query($koneksi, "select * from karyawan where id=".$data['karyawan_id'].""));
	echo $d_kar['nama_karyawan']; ?></td>
    <td><?php echo $data['bulan_tahun']; ?></td>
    <td><?php echo $data['jumlah_hari_kerja']." hari"; ?></td>
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
<br />
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
  
  <?php
   
  $no=0;
  $q_akse = mysqli_query($koneksi, "select *,gaji_karyawan_detail.id as idd from gaji_karyawan_detail,gaji where gaji.id=gaji_karyawan_detail.gaji_id and gaji_karyawan_id=".$_GET['id']."");
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
    <td align="center"><a href="index.php?page=detail_gaji&id_hapus=<?php echo $data_akse['idd']; ?>&id=<?php echo $_GET['id'] ?>" onclick="return confirm('Yakin Akan Menghapus Item Ini ?')"><span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span></a>&nbsp;&nbsp;<a href="#" data-toggle="modal" data-target="#modal-ubah<?php echo $data_akse['idd']; ?>"><span data-toggle="tooltip" title="Ubah" class="fa fa-edit"></span></a></td>
    </tr>
    <div class="modal fade" id="modal-ubah<?php echo $data_akse['idd']; ?>">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" align="center">Ubah Data</h4>
              </div>
              <form method="post">
              <div class="modal-body">
              <p align="justify">
              <input type="hidden" name="id_ubah" value="<?php echo $data_akse['idd']; ?>"/>
              <label>Nama Gaji</label>
              <select name="gaji_id2" id="gaji_id2" class="form-control" autofocus="autofocus" required onchange="changeValue2(this.value)">
    	<option value="">-- Pilih Gaji --</option>
        <?php 
		$q22 = mysqli_query($koneksi, "select * from gaji order by id ASC");
		$jsArray2 = "var dtBrg2 = new Array()";
		while ($d2 = mysqli_fetch_array($q22)) { ?>
        <option <?php if ($data_akse['gaji_id']==$d2['id']) {echo "selected";} ?> value="<?php echo $d2['id']; ?>"><?php echo $d2['nama_gaji']." - ".$d2['kategori']; ?></option>
        <?php
		$jsArray2 .= "dtBrg2['" . $d2['id'] . "'] = {kategori2:'".addslashes($d2['kategori'])."',besar_gaji2:'".addslashes(number_format($d2['besar_gaji'],0,',','.'))."'
						};";
		} ?>
    </select>
              <br />
              <label>Besar Gaji</label>
          <input id="besar_gaji2" name="besar_gaji2" class="form-control" type="text" placeholder="" size="6" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this); sum();" value="<?php echo number_format($data_akse['besargaji'],0,',','.'); ?>"/>
              <br />
              <label>Dikali</label>
          <input id="qty2" name="qty2" class="form-control" type="number" placeholder="" size="2" onkeyup="sum2();" required="required" value="<?php echo $data_akse['dikali']; ?>"/>
              <br />
              <label>Total</label>
          <input id="total2" name="total2" class="form-control" type="text" placeholder="" size="9" value="Otomatis Terjumlah" disabled="disabled"/>
              <br />
              <label>Keterangan</label>
          <input name="keterangan2" class="form-control" type="text" placeholder="" value="<?php echo $data_akse['keterangan']; ?>"/>
              <br />
          
              </p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button name="ubahdetailgaji" class="btn btn-success" type="submit">Simpan</button>
              </div>
              </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
  <?php }} else {
	  echo "<tr><td colspan='9' align='center'>Tidak Ada Data</td></tr>";
	  } ?>
    <tr bgcolor="#009900">
    <td colspan="11"></td>
    </tr>
    <tr>
      <td colspan="5" align="right">Total Penerimaan</td>
      <td><?php
      $total1 = mysqli_fetch_array(mysqli_query($koneksi, "select sum(gaji_karyawan_detail.total) as total1 from gaji,gaji_karyawan_detail where gaji.id=gaji_karyawan_detail.gaji_id and gaji.kategori='Penerimaan' and gaji_karyawan_id=".$_GET['id'].""));
	  echo "Rp".number_format($total1['total1'],2,',','.');
	  ?></td>
      <td>&nbsp;</td>
      <td align="center"></td>
    </tr>
    <tr>
      <td colspan="5" align="right">Total Potongan</td>
      <td><?php
      $total2 = mysqli_fetch_array(mysqli_query($koneksi, "select sum(gaji_karyawan_detail.total) as total1 from gaji,gaji_karyawan_detail where gaji.id=gaji_karyawan_detail.gaji_id and gaji.kategori='Pengeluaran' and gaji_karyawan_id=".$_GET['id'].""));
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
        <center><a href="index.php?page=gaji_karyawan">
        <button name="Kembali" class="btn btn-success" type="button"><span class="fa  fa-check"></span> Kembali</button></a></center>
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
  <?php
  $detail_gaji = mysqli_fetch_array(mysqli_query($koneksi, "select * from gaji_karyawan_detail where id=$_GET[id_ubah]"));
  ?>
  <div id="ubah_detail_gaji" class="modalDialog">
     <div>
        <a href="#" title="Close" class="close">X</a>
        <h3 align="center">Ubah Gaji</h3>
        <form method="post" enctype="multipart/form-data" >
              <label>Nama Gaji</label>
              <select name="gaji_id2" id="gaji_id2" class="form-control" autofocus="autofocus" required onchange="changeValue2(this.value)">
    	<option value="">-- Pilih Gaji --</option>
        <?php 
		$q22 = mysqli_query($koneksi, "select * from gaji order by id ASC");
		$jsArray2 = "var dtBrg2 = new Array()";
		while ($d2 = mysqli_fetch_array($q22)) { ?>
        <option <?php if ($detail_gaji['gaji_id']==$d2['id']) {echo "selected";} ?> value="<?php echo $d2['id']; ?>"><?php echo $d2['nama_gaji']." - ".$d2['kategori']; ?></option>
        <?php
		$jsArray2 .= "dtBrg2['" . $d2['id'] . "'] = {kategori2:'".addslashes($d2['kategori'])."',besar_gaji2:'".addslashes(number_format($d2['besar_gaji'],0,',','.'))."'
						};";
		} ?>
    </select>
              <br />
              <label>Besar Gaji</label>
          <input id="besar_gaji2" name="besar_gaji2" class="form-control" type="text" placeholder="" size="6" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this); sum();" value="<?php echo number_format($detail_gaji['besargaji'],0,',','.'); ?>"/>
              <br />
              <label>Dikali</label>
          <input id="qty2" name="qty2" class="form-control" type="number" placeholder="" size="2" onkeyup="sum2();" required="required" value="<?php echo $detail_gaji['dikali']; ?>"/>
              <br />
              <label>Total</label>
          <input id="total2" name="total2" class="form-control" type="text" placeholder="" size="9" value="Otomatis Terjumlah" disabled="disabled"/>
              <br />
              <label>Keterangan</label>
          <input name="keterangan2" class="form-control" type="text" placeholder="" value="<?php echo $detail_gaji['keterangan']; ?>"/>
              <br />
          <button name="ubahdetailgaji" class="form-control btn btn-success" type="submit">Simpan</button>
              <br />
              </form>
              <script type="text/javascript">    
	<?php 
	echo $jsArray;
	
	?>  
	function changeValue(gaji_id){  
		document.getElementById('kategori').value = dtBrg[gaji_id].kategori;
		document.getElementById('besar_gaji').value = dtBrg[gaji_id].besar_gaji;
	}; 
	
</script>
              
    </div>
</div>