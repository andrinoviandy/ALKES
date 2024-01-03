<?php
$data = mysqli_fetch_array(mysqli_query($koneksi, "select * from buku_kas where id=".$_GET['id_bank'].""));
 
if (isset($_POST['button_urut'])) {
	echo "<script>window.location='cetak_stok_alkes.php?merk=$_POST[merk]'</script>";
	}
?>
<?php 
if (isset($_GET['id_hapus'])) {
	$del2 = mysqli_query($koneksi, "delete from buku_kas where id=".$_GET['id_hapus']."");
	}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Ringkasan  <?php echo $_GET['judul']; ?></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Ringkasan Bank</li>
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
              <div class="box-body table-responsive no-padding"><!--
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
                <table width="100%" id="example3" class="table table-bordered table-hover">
  <thead>
    <tr>
      <td width="5%" align="center">#</th>
        <th width="15%" valign="top"><strong>Tanggal</strong></th>
        <th width="20%" valign="top"> Transaksi</th>
      <th width="15%" valign="top">Deskripsi</th>
      <th width="10%" align="center" valign="top">Debet</th>
      <th width="10%" align="center" valign="top">Kredit</th>
      <th width="10%" align="center" valign="top">Saldo</th>
          </tr>
  </thead>
  <?php
	 $query = mysqli_query($koneksi, "select *,keuangan.id as idd from keuangan,keuangan_detail where keuangan.id=keuangan_detail.keuangan_id and keuangan_detail.coa_sub_id=".$_GET['id']." order by tgl_transaksi DESC,keuangan.id DESC");
	  
  $no=0;
  while ($data = mysqli_fetch_array($query)) { 
  $no++;
  ?>
  <tr>
    <td align="center"><?php echo $no; ?></td>
    <td><?php echo date("d-m-Y",strtotime($data['tgl_transaksi'])); ?></td>
    <td><?php echo $data['nama_transaksi']; ?></td>
    <td><?php echo $data['deskripsi']; ?></td>
    <td>
    <?php if ($data['nama_transaksi']=='Transfer Antar Kas & Bank') { ?>
	<a href="index.php?page=deposit&id_keuangan=<?php echo $data['idd']; ?>"> 
    <?php } else if ($data['nama_transaksi']=='Faktur Penjualan Alkes Ber No Seri') { ?>
    <a href="index.php?page=jual_barang_uang&id_keuangan=<?php echo $data['idd']; ?>">
    <?php } else if ($data['nama_transaksi']=='Faktur Penjualan Aksesoris') { ?>
    <a href="index.php?page=penjualan_aksesoris_uang&id_keuangan=<?php echo $data['idd']; ?>">
    <?php } else if ($data['nama_transaksi']=='Faktur Penjualan Inventory') { ?>
    <a href="index.php?page=penjualan_inventory&id_keuangan=<?php echo $data['idd']; ?>">
	<?php } else { ?>
    <a href="index.php?page=biaya_lain&id_keuangan=<?php echo $data['idd']; ?>">
    <?php } ?>
	<?php if ($data['db_cr']=='db'){echo "Rp".number_format($data['saldo'],2,',','.');} else {
		$q = mysqli_query($koneksi, "select * from deposit where id=$data[id_deposit]");
		$cek1 = mysqli_fetch_array($q);
		$j = mysqli_num_rows($q);
		if ($j!=0) {
		if ($cek1['ke_akun_id']==$_GET['id_bank']) {
			echo "Rp".number_format($data['saldo'],2,',','.');
			} 
		}
		} ?>
        </a>
        </td>
    <td>
	<?php if ($data['nama_transaksi']=='Transfer Antar Kas & Bank') { ?>
	<a href="index.php?page=deposit&id_keuangan=<?php echo $data['idd']; ?>"> <?php } else if ($data['nama_transaksi']=='Faktur Pembelian Alkes Ber No Seri DN') { ?>
    <a href="index.php?page=pembelian_alkes&id_keuangan=<?php echo $data['idd']; ?>">
    <?php } else if ($data['nama_transaksi']=='Faktur Pembelian Alkes Ber No Seri LN') { ?>
    <a href="index.php?page=pembelian_alkes2&id_keuangan=<?php echo $data['idd']; ?>">
    <?php } else if ($data['nama_transaksi']=='Faktur Pembelian Aksesoris LN') { ?>
    <a href="index.php?page=pembelian_akse2&id_keuangan=<?php echo $data['idd']; ?>">
    <?php } else if ($data['nama_transaksi']=='Faktur Pembelian Aksesoris DN') { ?>
    <a href="index.php?page=pembelian_akse&id_keuangan=<?php echo $data['idd']; ?>">
    <?php } else if ($data['nama_transaksi']=='Faktur Pembelian Inventory DN') { ?>
    <a href="index.php?page=pembelian_inventory&id_keuangan=<?php echo $data['idd']; ?>">
    <?php } else if ($data['nama_transaksi']=='Faktur Pembelian Inventory LN') { ?>
    <a href="index.php?page=pembelian_inventory2&id_keuangan=<?php echo $data['idd']; ?>">
    <?php } else if ($data['nama_transaksi']=='Penerimaan' or $data['nama_transaksi']=='Pembayaran'){ ?>
    <a href="index.php?page=biaya_lain&id_keuangan=<?php echo $data['idd']; ?>">
    <?php } else if ($data['nama_transaksi']=='Beban Ekspedisi Alkes Ber No Seri') { ?>
    <a href="index.php?page=kirim_barang&id_keuangan=<?php echo $data['idd']; ?>">
    <?php } ?>
	<?php if ($data['db_cr']=='cr'){echo "Rp".number_format($data['saldo'],2,',','.'); } else {
		$q = mysqli_query($koneksi, "select * from deposit where id=$data[id_deposit]");
		$cek1 = mysqli_fetch_array($q);
		$j = mysqli_num_rows($q);
		if ($j!=0) {
		if ($cek1['dari_akun_id']==$_GET['id_bank']) {
			echo "Rp".number_format($data['saldo'],2,',','.');
			} 
		}
		} ?>
        </a>
        </td>
    <td></td>
  </tr>
  <?php } ?>
  <tfoot>
    <td align="center">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>
    <hr />
    <strong>
	<?php 
	 $debet = mysqli_fetch_array(mysqli_query($koneksi, "select sum(saldo) as total from keuangan,keuangan_detail where keuangan.id=keuangan_detail.keuangan_id and keuangan_detail.coa_sub_id=".$_GET['id']." and db_cr='db' order by tgl_transaksi DESC,keuangan.id DESC"));
	 echo "Rp".number_format($debet['total'],2,',','.');
	?>
    </strong>
    </td>
    <td>
    <hr />
    <strong>
	<?php 
	 $kredit = mysqli_fetch_array(mysqli_query($koneksi, "select sum(saldo) as total from keuangan,keuangan_detail where keuangan.id=keuangan_detail.keuangan_id and keuangan_detail.coa_sub_id=".$_GET['id']." and db_cr='cr' order by tgl_transaksi DESC,keuangan.id DESC"));
	 echo "Rp".number_format($kredit['total'],2,',','.');
	?>
    </strong>
    </td>
    <td>
    <hr />
    <strong style="font-size:18px">
    <?php echo "Rp".number_format($debet['total']-$kredit['total'],2,',','.'); ?>
    </strong>
    </td>
  </tfoot>
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


