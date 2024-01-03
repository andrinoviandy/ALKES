<?php
if (isset($_POST['tambah_header'])) {
	$simpan_keuangan = mysqli_query($koneksi,"insert into keuangan values('','".$_POST['tanggal']."','Slip Gaji','".$_POST['keterangan']."','".$_POST['gaji_bersih']."')");
	$max = mysqli_fetch_array(mysqli_query($koneksi, "select max(id) as id_max from keuangan"));
	$coa = mysqli_fetch_array(mysqli_query($koneksi, "SELECT *,coa_sub_akun.id as idd FROM coa,coa_sub,coa_sub_akun where coa.id=coa_sub.coa_id and coa_sub.id=coa_sub_akun.coa_sub_id and coa_sub_akun.id=$_POST[coa_id]"));
	$simpan_keuangan_detail = mysqli_query($koneksi,"insert into keuangan_detail values('','$max[id_max]','2','12','62','cr')");
	$simpan_keuangan_detail2 = mysqli_query($koneksi,"insert into keuangan_detail values('','$max[id_max]','3','31','0','cr')");
	
    $Result = mysqli_query($koneksi, "insert into slip_gaji values('','$max[id_max]','$_POST[tanggal]','$_POST[karyawan_id]','$_POST[gaji_kotor]','$_POST[kurang_gaji]','$_POST[gaji_bersih]','".str_replace("\n","<br>",$_POST['keterangan'])."')");
	if ($Result) {
		echo "<script type='text/javascript'>
		alert('Data Berhasil Di Simpan !');
		window.location='index.php?page=slip_gaji'
		</script>";
		}else{
            echo "<script type='text/javascript'>
		alert('Data Gagal Di Simpan !');
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
      <h1><span class="active">Tambah Slip Gaji</span></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Slip Gaji</li>
        <li class="active">Tambah Slip Gaji</li>
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
              <h3 class="box-title">Tambah <span class="active">Slip Gaji</span></h3>
            </div>
              <div class="box-body">
              <form method="post">
              <!--<label>Akun</label>
              <div class="well">
              <select required name="coa_id" class="form-control" id="coa_id">
              <option value="">-- Pilih --</option>
              <?php $query1 = mysqli_query($koneksi,"SELECT * FROM coa where id=2");
              while ($row1= mysqli_fetch_array($query1)) {
              ?>
              <option value="<?php echo $row1['id']?>"><?php echo $row1['nama_grup'];?></option>
              <?php }?>
              </select><br />
              <select required name="coa_sub_id" class="form-control select21" id="coa_sub_id">
              <option value="">-- Pilih --</option>
              <?php $query2 = mysqli_query($koneksi,"SELECT *,coa_sub.id as idd FROM coa_sub INNER JOIN coa ON coa.id=coa_sub.coa_id");
              while ($row1= mysqli_fetch_array($query2)) {
              ?>
              <option id="coa_sub_id" class="<?php echo $row1['coa_id']; ?>" value="<?php echo $row1['idd']?>"><?php echo $row1['nama_sub_grup'];?></option>
              <?php }?>
              </select><br />
              <select name="coa_sub_akun_id" class="form-control select2" id="coa_sub_akun_id" style="width:100%">
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
        </script><br />
              
              </div>-->
              <label>Tanggal</label>
              <input name="tanggal" class="form-control" type="date" placeholder="" value="" required><br />
              <label>Nama Karyawan</label>
              <select name="karyawan_id" class="form-control select2" style="width:100%">
              <option>...</option>
              <?php 
              $query = mysqli_query($koneksi, "SELECT id,nama_karyawan FROM karyawan");
              while($row = mysqli_fetch_array($query)){
              ?>
              <option value="<?php echo $row['id'];?>"><?php echo $row['nama_karyawan'];?></option>
              <?php }?>
              </select><br><br />
              <label>Gaji Kotor</label>
              <input type="number" onkeyup="sum();" name="gaji_kotor" id="gaji_kotor" class="form-control">
              <br />
              <label>Pengurangan</label>
              <input type="number" onkeyup="sum();" name="kurang_gaji" id="kurang_gaji" class="form-control">
              <br />
              <label>Gaji Bersih</label>
              <input name="gaji_bersih" id="gaji_bersih" class="form-control" type="number" placeholder="" readonly="readonly"><br />
              <label>Keterangan</label>
              <textarea class="form-control" rows="4" name="keterangan"></textarea><br />
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
  