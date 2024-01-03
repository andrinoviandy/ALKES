<?php
if (isset($_POST['tambah_header'])) {
	$Result = mysqli_query($koneksi, "insert into utang_piutang values('','Hutang','','".$_POST['tgl_input']."','".$_POST['jatuh_tempo']."','".$_POST['nominal']."','".$_POST['klien']."','".$_POST['deskripsi']."','0')");
	if ($Result) {
		echo "<script type='text/javascript'>
		alert('Data Berhasil Di Simpan !');
		window.location='index.php?page=utang'
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
              <h3 class="box-title">Tambah <span class="active">Hutang / Credit</span></h3>
            </div>
              <div class="box-body">
              <script type="text/javascript">

 

function yesnoCheck() {

    if (document.getElementById('yesCheck').checked) {

        document.getElementById('ifYes').style.display = 'block';

    }

    else document.getElementById('ifYes').style.display = 'none';

}

 

</script>
              <form method="post">
              <label>Tanggal</label>
              <input name="tgl_input" class="form-control" type="date" placeholder="" required="required"><br />
              <label>Tidak Ada Jatuh Tempo</label>
              <input type="radio" onclick="javascript:yesnoCheck();" name="yesno" id="noCheck" style="height:20px; width:20px" checked="checked">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label>Jatuh Tempo</label>
              <input type="radio" onclick="javascript:yesnoCheck();" name="yesno" id="yesCheck" style="height:20px; width:20px"><br />
              <div id="ifYes" style="display:none">
              <label>Tanggal Jatuh Tempo</label>
              <input name="jatuh_tempo" type="date" class="form-control" placeholder="" value=""><br />
              </div>
              <br /> 
              <label>Nominal</label>
              <input name="nominal" class="form-control" type="text" placeholder="" value="" required="required"><br />
              <label>Klien</label>
              <input name="klien" class="form-control" type="text" placeholder="" value="" required="required"><br />
              <label>Deskripsi</label>
              <textarea name="deskripsi" class="form-control" rows="4" required="required"></textarea><br />
              
              <!--
              <label>Akun</label>
              <select name="akun" id="akun" class="form-control" required>
              <option value="">-- Pilih --</option>
              <?php
              $q = mysqli_query($koneksi, "select * from coa order by nama_akun ASC");
			  while ($d=mysqli_fetch_array($q)) {
			  ?>
              <option value="<?php echo $d['id']; ?>"><?php echo $d['nama_akun']; ?></option>
              <?php } ?>
              </select><br />
              <label>Jenis</label>
              <select name="jenis_akun" id="jenis_akun" class="form-control" required>
    <option value="">--Jenis--</option>
    <?php 
	$q_seri = mysqli_query($koneksi, "select *,coa_detail.id as idd,coa_detail.nama_akun as nama from coa_detail INNER JOIN coa ON coa.id=coa_detail.coa_id order by coa_detail.nama_akun ASC");
	while ($d_seri=mysqli_fetch_array($q_seri)) {
	?>
    <option id="jenis_akun" value="<?php echo $d_seri['idd']; ?>" class="<?php echo $d_seri['coa_id']; ?>"><?php echo $d_seri['nama']; ?></option>
    <?php } ?>
    </select>
              <script src="jquery-1.10.2.min.js"></script>
        <script src="jquery.chained.min.js"></script>
        <script>
            $("#jenis_akun").chained("#akun");
        </script>
        -->
              
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
  