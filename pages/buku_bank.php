<?php 
if (isset($_POST['button_urut'])) {
	echo "<script>window.location='cetak_stok_alkes.php?merk=$_POST[merk]'</script>";
	}
?>
<?php 
if (isset($_GET['id_hapus'])) {
	$del2 = mysqli_query($koneksi, "delete from buku_kas where id=".$_GET['id_hapus']."");
	if ($del2) {
		echo "<script type='text/javascript'>
		alert('Akun Berhasil Di Hapus !');
		window.location='index.php?page=buku_bank';
		</script>";
		}
	else {
		echo "<script type='text/javascript'>
		alert('Akun Gagal Di Hapus !');
		window.location='index.php?page=buku_bank';
		</script>";
		}
	}

if (isset($_POST['tambah_laporan'])) {
	$Result = mysqli_query($koneksi, "update buku_kas set no_akun='".$_POST['no_akun']."',nama_akun='".$_POST['nama_akun']."', tipe_akun='".$_POST['akun_tipe']."' where id=".$_POST['id']."");
	if ($Result) {
		echo "<script type='text/javascript'>
		alert('Akun Berhasil Di Ubah !');
		window.location='index.php?page=buku_bank';
		</script>";
		}
	}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Rekening Bank</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Rekening Bank</li>
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
              <div class="box-body">
              <div class="input-group pull pull-left col-xs-1" style="padding-right:10px">
              <a href="index.php?page=tambah_buku_bank">
              <button name="tambah_laporan" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Tambah</button></a></div>
              
              <!--<form method="post" action="cetak_stok_alkes.php">--><!--<a href="cetak_stok_alkes.php">
              <button name="tambah_laporan" class="btn btn-warning" type="submit"><span class="fa fa-print"></span> Cetak Stok Alkes</button></a>
              <span class="pull pull-right"><font color="#FF0000">Keterangan :</font> Klik Nama Alkes Untuk Melihat Proses Penjualan</span>
              --><br /><br />
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
              <br />
              
              <?php
              if ($_POST['cari']!='') {
                echo "Results  Of  '".$_POST['cari']."'";
			  	}
				?>
                <div class="table-responsive">
                <table width="100%" id="example1" class="table table-bordered table-hover">
  <thead>
    <tr>
      <td width="5%" align="center">#</th>
        <th width="15%" valign="top"><strong>No Akun</strong></th>
        <th width="20%" valign="top">Nama</th>
      <th width="15%" valign="top">Saldo Awal</th>
      <!--<th valign="top">NIE</th>
      <th valign="top">No. Bath</th>
      <th valign="top">No. Lot</th>-->
      <th width="10%" align="center" valign="top"><strong>Aksi</strong></th>
          </tr>
  </thead>
  <?php
	  $query = mysqli_query($koneksi, "select *,buku_kas.id as idd from buku_kas where tipe_akun='BANK' order by no_akun ASC");

  $no=0;
  while ($data = mysqli_fetch_assoc($query)) { 
  $no++;
  ?>
  <tr>
    <td align="center"><?php echo $no; ?></td>
    
    <td>
    <?php echo $data['no_akun'];  ?>
  </td>
    <td><?php echo $data['nama_akun']; ?></td>
    
      <td><?php echo "Rp ".number_format($data['saldo'],2,',','.'); ?>
      <hr / style="padding:0px; margin:0px">
      <div class="pull pull-right">Saldo Riil :</div> 
      </td>
    <!--<td></td>
    <td><?php //echo $data['no_bath']; ?></td>
    <td><?php //echo $data['no_lot']; ?></td>-->
    <td>
    <?php
    $jm1 = mysqli_num_rows(mysqli_query($koneksi, "select * from biaya_lain where buku_kas_id=".$data['idd'].""));
	$jm2 = mysqli_num_rows(mysqli_query($koneksi, "select * from utang_piutang_bayar where buku_kas_id=".$data['idd'].""));
	if ($jm1==0 and $jm2==0) {
	?>
      <a href="index.php?page=buku_bank&id_hapus=<?php echo $data['idd']; ?>" onclick="return confirm('Anda Yakin Akan Menghapus Item Ini ? Riwayat Pembayaran Pada Buku Ini Juga Akan Ikut Terhapus !')"><span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span></a>&nbsp;
      <?php } ?>
      <a href="#" data-toggle="modal" data-target="#modal-ubah<?php echo $data['idd']; ?>"><span data-toggle="tooltip" title="Ubah" class="fa fa-edit"></span></a>&nbsp;<a href="index.php?page=ubah_buku_kas&id=<?php echo $data['idd']; ?>"><span data-toggle="tooltip" title="Riwayat Akun" class="fa fa-caret-square-o-right"></span></a><!--&nbsp;<a target="_blank" href="cetak_rekapan_alkes2.php?id=<?php echo $data['idd']; ?>"><span data-toggle="tooltip" title="Print" class="fa fa-print"></span></a>
      -->
      <!-- Tombol Jual -->
      
      <?php /* if ($data['stok_total']!=0 and $data['status_cek']!=0) { ?>
      &nbsp;<a href="index.php?page=barang_masuk&id=<?php echo $data['idd']; ?>#openPilihan"><small data-toggle="tooltip" title="Jual Alkes" class="label bg-blue">Jual</small></a>
      <!--&nbsp;<a href="index.php?page=jual_barang2&id=<?php //echo $data['idd']; ?>"><small data-toggle="tooltip" title="Jual Alkes" class="label bg-blue">Jual</small>-->
      <?php } */ ?>
      
    </td>
  </tr>
  <div class="modal fade" id="modal-ubah<?php echo $data['idd']; ?>">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Ubah Akun</h4>
              </div>
              <form method="post">
              <div class="modal-body">
              <input name="id" class="form-control" type="hidden" required placeholder="" value="<?php echo $data['idd']; ?>">
              <label>No. Akun</label>
              <input name="no_akun" class="form-control" type="text" required placeholder="" value="<?php echo $data['no_akun']; ?>"><br />
              <label>Nama Akun</label>
              <input name="nama_akun" class="form-control" type="text" required placeholder="" value="<?php echo $data['nama_akun']; ?>"><br />
              <label>Tipe Akun</label>
              <input name="akun_tipe" class="form-control" type="text" required placeholder="" readonly="readonly" value="<?php echo $data['tipe_akun']; ?>"><br />
              <label>Saldo Total</label>
              <input name="saldo" class="form-control" type="text" placeholder="" readonly="readonly" value="<?php echo number_format($data['saldo'],2,',','.'); ?>" >
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button name="tambah_laporan" type="submit" class="btn btn-success">Simpan</button>
              </div>
              </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
  <?php } ?>
</table>
                </div>
                <br />

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


