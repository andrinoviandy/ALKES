
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Gudang 1</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Alkes</li>
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
              
             
              <!--
              <form method="post">
              <div class="input-group pull pull-left col-xs-1">
                
                <select class="form-control" name="limiterr" style="margin-right:40px">
                <option <?php if ($limiter['limiter']==10) {echo "selected";} ?> value="10">10</option>
                <option <?php if ($limiter['limiter']==50) {echo "selected";} ?> value="50">50</option>
                <option <?php if ($limiter['limiter']==100) {echo "selected";} ?> value="100">100</option>
                <option <?php if ($limiter['limiter']==500) {echo "selected";} ?> value="500">500</option>
                <option <?php if ($limiter['limiter']==1000) {echo "selected";} ?> value="1000">1000</option>
                <?php 
				$total=mysqli_num_rows(mysqli_query($koneksi, "select * from barang_gudang"));
				?>
                <option <?php if ($limiter['limiter']==$total) {echo "selected";} ?> <?php if ($_POST['cari']!='') {echo "selected";} ?> value="<?php echo $total; ?>">All</option>
                </select>
                
                <span class="input-group-btn">
                      <button type="submit" name="button_limit" class="btn btn-default btn-flat"><i class="fa fa-check"></i></button>
                    </span>
                
              </div>
              </form>
              
              <form method="post">
              <div class="input-group pull pull-left col-xs-2">
                
                <select class="form-control" name="urutt" style="margin-right:40px">
                <option <?php if ($limiter['urut']=='ASC') {echo "selected";} ?> value="ASC">Ascending</option>
                <option <?php if ($limiter['urut']=='DESC') {echo "selected";} ?> value="DESC">Descending</option>
                
                </select>
                
                <span class="input-group-btn">
                      <button type="submit" name="button_urut" class="btn btn-default btn-flat"><i class="fa fa-check"></i></button>
                    </span>
                
              </div>
              </form>
              
              <form method="post" class="">
              <div class="input-group input-group-md col-xs-4 pull pull-right">
                <input type="text" name="cari" placeholder="Keyword .. (Not ; Stok, Harga, Pengecekan)" class="form-control">
                    <span class="input-group-btn">
                      <button type="submit" name="button_cari" class="btn btn-info btn-flat"><i class="fa fa-search"></i> Cari </button>
                    </span>
              </div>
              </form>-->
              <span class="pull pull-right"><font color="#FF0000">Keterangan :</font> Tanda "<span class="fa fa-share"></span>" Menandakan Sudah Di Mutasi ke Gudang Utama / Gudang 2</span>
              <br />
              <br />             
              
                <table width="100%" id="example1" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th align="center">#</th>
      <th valign="top">Tgl PO</th>
        <th valign="top">No PO</th>
        <th valign="top">Jenis PO</th>
        <th valign="top">Principle</th>
        <th valign="top">Alamat</th>
        <th valign="top">PPN</th>
        <th valign="top">Cara Pembayaran</th>
        <th valign="top">Alamat Pengiriman</th>
        <th valign="top">Jalur Pengiriman</th>
      <th align="center" valign="top"><strong>Aksi</strong></th>
          </tr>
  </thead>
  <?php
  
	  $query = mysqli_query($koneksi, "select *,barang_pesan.id as idd from barang_pesan,mata_uang where mata_uang.id=barang_pesan.mata_uang_id");
  
  $no=0;
  while ($data = mysqli_fetch_assoc($query)) { 
  $no++;
  ?>
  <tr>
    <td align="center"><?php echo $no; ?></td>
    <td><?php echo date("d-m-Y",strtotime($data['tgl_po_pesan'])); ?></td>
    <td><?php echo $data['no_po_pesan']; ?></td>
    <td><?php echo $data['jenis_po']; ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    
      <td align="center">&nbsp;</td>
  </tr>
  <?php } ?>
</table><br />

              </div>
            </div>
          </div>
          <!-- /.box (chat box) -->

          <!-- TO DO List --><!-- /.box -->

        <!-- quick email widget --></section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

  </section>
    <!-- /.content -->
  </div>
 

<div id="openPilihan" class="modalDialog">
     <div>
        <a href="#" title="Close" class="close">X</a>
        <br />
        <a href="index.php?page=jual_barang2&id=<?php echo $_GET['id']; ?>"><button id="buttonn">Data Dinas/RS/Puskesmas/Klinik Baru</button></a>
        <a href="index.php?page=jual_barang3&id=<?php echo $_GET['id']; ?>"><button id="buttonn">Dari Data Dinas/RS/Puskesmas/Klinik<br />Yang Sudah Terinput</button></a>
    </div>
</div>

<?php 
if (isset($_POST['lunasin'])) {
	$q_lunas=mysqli_query($koneksi, "update barang_pesan set status_lunas='".$_POST['status_lunas']."', tgl_lunas='".$_POST['tgl_lunas']."' where id=$_GET[id]");
	if ($q_lunas) {
		echo "<script type='text/javascript'>
		window.location='index.php?page=barang_gudang1';
		</script>";
		}
	}
?>
<div id="openLunas" class="modalDialog">
     <div>
        <a href="#" title="Close" class="close">X</a>
        <h3 align="center">Pelunasan Alkes</h3> 
     <form method="post">
     <label>Status Lunas</label>
     <select id="input" name="status_lunas" required>
     	<?php 
		$q2 = mysqli_fetch_array(mysqli_query($koneksi, "select status_lunas,tgl_lunas from barang_pesan where id=$_GET[id]"));
		?>
        <?php
		if ($q2['status_lunas']==0) {
		?>
        <option value="0">Belum</option>
        <option value="1">Sudah</option>
        <?php } else { ?>
        <option value="1">Sudah</option>
        <option value="0">Belum</option>
        <?php } ?>
     </select>
     <br /><br />
     <label>Tanggal</label>
     <input id="input" value="<?php echo $q2['tgl_lunas']; ?>" type="date" placeholder="" name="tgl_lunas" required>
     
     
        <button id="buttonn" name="lunasin" type="submit">Simpan</button>
    </form>
    </div>
</div>


