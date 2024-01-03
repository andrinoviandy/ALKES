
<?php
$data=mysqli_fetch_array(mysqli_query($koneksi, "select * from keuangan,keuangan_detail,slip_gaji where keuangan.id=slip_gaji.keuangan_id and keuangan.id=keuangan_detail.keuangan_id and slip_gaji.id=".$_GET['id_ubah'].""));

if (isset($_POST['tambah_header'])) {
	$simpan_keuangan = mysqli_query($koneksi,"update keuangan set tgl_transaksi='".$_POST['tanggal']."',deskripsi='".$_POST['keterangan']."',saldo='".$_POST['gaji_bersih']."' where id=".$data['keuangan_id']."");
	//$coa = mysqli_fetch_array(mysqli_query($koneksi, "SELECT *,coa_sub_akun.id as idd FROM coa,coa_sub,coa_sub_akun where coa.id=coa_sub.coa_id and coa_sub.id=coa_sub_akun.coa_sub_id and coa_sub_akun.id=$_POST[coa_id]"));
	//$simpan_keuangan_detail = mysqli_query($koneksi,"update keuangan_detail set coa_id='".$coa['coa_id']."',coa_sub_id='".$coa['coa_sub_id']."',coa_sub_akun_id='".$coa['idd']."' where keuangan_id=$data[keuangan_id]");
	
    $Result = mysqli_query($koneksi, "update slip_gaji set tgl_slip='".$_POST['tanggal']."',karyawan_id='".$_POST['karyawan_id']."',gaji_kotor='".$_POST['gaji_kotor']."',pengurangan='".$_POST['kurang_gaji']."',gaji_bersih='".$_POST['gaji_bersih']."',keterangan='".str_replace("\n","<br>",$_POST['keterangan'])."' where id=$_GET[id_ubah]");
	if ($Result and $simpan_keuangan and $simpan_keuangan_detail) {
		echo "<script type='text/javascript'>
		alert('Data Berhasil Di Ubah !');
		window.location='index.php?page=slip_gaji'
		</script>";
		}else{
            echo "<script type='text/javascript'>
		alert('Data Gagal Di Ubah !');
		history.back();
		</script>";
        }
	}
?>
<script type="text/javascript">
function sum() {
      var txtFirstNumberValue = document.getElementById('gaji_kotor').value;
      var txtSecondNumberValue = document.getElementById('kurang_gaji').value;
	  var txtThirdNumberValue = document.getElementById('gaji_bersih').value;
	  
      var result = parseFloat(txtFirstNumberValue) - parseFloat(txtSecondNumberValue);
	  if (!isNaN(result)) {
         document.getElementById('gaji_bersih').value = result;
      }
}

function sum_total_keseluruhan() {
      var txtFirstNumberValue = document.getElementById('total_price_ppn').value;
      var txtSecondNumberValue = document.getElementById('cost_byair').value;
      var txtFourNumberValue = document.getElementById('nilai_tukar').value;
	  var result = parseFloat(txtFirstNumberValue) + parseFloat(txtSecondNumberValue);
	  var total_rupiah = parseFloat(result) * parseFloat(txtFourNumberValue);
      if (!isNaN(result)) {
         document.getElementById('cost_cf').value = result;
		 document.getElementById('dalam_rupiah').value = total_rupiah;
		 document.getElementById('nominal').value = total_rupiah;
      }
}

function sum_total_rupiah() {
      var txtFirstNumberValue = document.getElementById('nilai_tukar').value;
      var txtSecondNumberValue = document.getElementById('cost_cf').value;
      var result = parseFloat(txtFirstNumberValue) * parseFloat(txtSecondNumberValue);
      if (!isNaN(result)) {
         document.getElementById('dalam_rupiah').value = result;
      }
}
</script>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><span class="active">Ubah Slip Gaji</span></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Slip Gaji</li>
        <li class="active">Ubah Slip Gaji</li>
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
             Ubah <span class="active">Slip Gaji</span>
            </div>
              <div class="box-body">
              <form method="post">
              <!--<label>Akun</label>
              <div class="well">
              <select required name="coa_id" class="form-control select2" id="coa_id" style="width:100%">
              <option value="">-- Pilih --</option>
              <?php $query1 = mysqli_query($koneksi,"SELECT *,coa_sub_akun.id as idd FROM coa,coa_sub,coa_sub_akun where coa.id=coa_sub.coa_id and coa_sub.id=coa_sub_akun.coa_sub_id and coa.id=2 order by coa.id ASC");
              while ($row1= mysqli_fetch_array($query1)) {
              ?>
              <option <?php if ($data['coa_sub_akun_id']==$row1['idd']) {echo "selected";} ?> value="<?php echo $row1['idd']?>"><?php echo $row1['nama_grup']." - ".$row1['nama_sub_grup']." - ".$row1['nama_akun'];?>
              </option>
              <?php }?>
              </select>
              </div>-->
              <label>Tanggal</label>
              <input name="tanggal" class="form-control" type="date" placeholder="" value="<?php echo $data['tgl_slip']; ?>" required><br />
              <label>Nama Karyawan</label>
              <select name="karyawan_id" class="form-control select2" style="width:100%">
              <option>...</option>
              <?php 
              $query = mysqli_query($koneksi, "SELECT id,nama_karyawan FROM karyawan");
              while($row = mysqli_fetch_array($query)){
              ?>
              <option <?php if ($data['karyawan_id']==$row['id']) {echo "selected";} ?> value="<?php echo $row['id'];?>"><?php echo $row['nama_karyawan'];?></option>
              <?php }?>
              </select><br><br />
              <label>Gaji Kotor</label>
              <input type="number" onkeyup="sum();" name="gaji_kotor" id="gaji_kotor" class="form-control" value="<?php echo $data['gaji_kotor']; ?>">
              <br />
              <label>Pengurangan</label>
              <input type="number" onkeyup="sum();" name="kurang_gaji" id="kurang_gaji" class="form-control" value="<?php echo $data['pengurangan']; ?>">
              <br />
              <label>Gaji Bersih</label>
              <input name="gaji_bersih" id="gaji_bersih" class="form-control" type="number" placeholder="" readonly="readonly" value="<?php echo $data['gaji_bersih']; ?>"><br />
              <label>Keterangan</label>
              <textarea class="form-control" rows="4" name="keterangan"><?php echo $data['keterangan']; ?></textarea><br />
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
  