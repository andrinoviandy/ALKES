<?php 
if (isset($_GET['id_hapus'])) {
	$del2 = mysqli_query($koneksi, "delete from barang_pesan_detail where barang_pesan_id=".$_GET['id_hapus']."");
	$del = mysqli_query($koneksi, "delete from barang_pesan where id=".$_GET['id_hapus']."");
	if ($del and $del2){
		echo "<script>window.location='index.php?page=pembelian_alkes'</script>";
		}
	}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      PO Dalam Negeri</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Pemesanan Alkes</li>
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
              
              <a href="index.php?page=pembelian_alkes#openPilihan">
              <button name="tambah_laporan" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Tambah</button></a>
              <br /><br />
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
              
              
              <?php
              if ($_POST['cari']!='') {
                echo "Results  Of  '".$_POST['cari']."'";
			  	}
				?>
                <table width="100%" id="example1" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th align="center">#</th>
        <th valign="top"><strong>Tgl PO</strong></th>
        <th valign="top">No PO</th>
      <th valign="top"><strong>Nama Principle</strong></th>
      <th valign="top"><strong>Alamat</strong></th>
      <th valign="top"><span class="pull pull-left"><strong>Nama Barang</strong></span><span class="pull pull-right"><strong>Qty</strong></span></th>
      <th align="center" valign="top"><strong>PPN</strong></th>
        
        <th align="center" valign="top"><strong>Cara Pembayaran (COD/Tempo)</strong></th>
        <th align="center" valign="top"><strong>Alamat Pengiriman</strong></th>
        <th align="center" valign="top"><strong>Jalur Pengiriman</strong>        </th>
        <th align="center" valign="top"><strong>Aksi</strong></th>
          </tr>
  </thead>
  <?php
  
	  $query = mysqli_query($koneksi, "select *,barang_pesan.id as idd from barang_pesan where jenis_po='Dalam Negeri' order by tgl_po_pesan DESC");
  
  $no=0;
  while ($data = mysqli_fetch_assoc($query)) { 
  $no++;
  ?>
  <tr>
    <td align="center"><?php echo $no; ?></td>
    <td><?php echo date("d/m/Y",strtotime($data['tgl_po_pesan'])); ?>
    </td>
    <td><?php echo $data['no_po_pesan']; ?></td>
    
      <td><?php 
	  $sel = mysqli_fetch_array(mysqli_query($koneksi, "select * from principle where id=".$data['principle_id'].""));
	  echo $sel['nama_principle']; ?></td>
    <td><?php echo $sel['alamat_principle']."<br>Telp : ".$sel['telp_principle']."<br>Fax : ".$sel['fax_principle']."<br>Attn : ".$sel['attn_principle']; ?></td>
    <td><table width="100%" border="0">
      <?php 
	  $q=mysqli_query($koneksi, "select * from barang_pesan_detail,barang_gudang where barang_gudang.id=barang_pesan_detail.barang_gudang_id and barang_pesan_detail.barang_pesan_id=".$data['idd']."");
	  $n=0;
	  while ($d1=mysqli_fetch_array($q)) {
	  $n++;
	  if ($n%2==0) {
		  $col="#CCCCCC";
		  }
		  else {
			  $col="#999999";
			  }
	  ?>
      <tr bgcolor="<?php echo $col; ?>">
        <td style="padding-left:5px"><?php echo $d1['nama_brg'] ?></td>
        <td style="padding-left:1px; padding-right:1px"><?php echo $d1['qty']; ?>
        <?php if ($d1['status_ke_stok']==1) { ?>
        <span class="fa fa-share"></span>
        <?php } ?>
        </td>
        </tr>
      <?php } ?>
    </table></td>
    <td align="center"><?php echo $data['ppn']."%"; ?></td>
    <td align="center"><?php echo $data['cara_pembayaran']; ?></td>
    <td><?php echo $data['alamat_pengiriman']; ?></td>
    <td align="center"><?php echo $data['jalur_pengiriman']; ?></td>
    <td align="center">
    <?php if (isset($_SESSION['pass_administrator'])) { ?>
    <a href="index.php?page=pembelian_alkes&id_hapus=<?php echo $data['idd']; ?>" onclick="return confirm('Anda Yakin Akan Menghapus Item Ini ?')"><span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span></a>&nbsp;<?php } ?><a href="index.php?page=ubah_pembelian_alkes&id=<?php echo $data['idd']; ?>"><span data-toggle="tooltip" title="Ubah" class="fa fa-edit"></span></a>
    <a href="cetak_surat_po_pemesanan.php?id=<?php echo $data['idd']; ?>" target="_blank"><span data-toggle="tooltip" title="Cetak PO" class="fa fa-print"></span></a>
    </td>
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
        <a href="index.php?page=tambah_pembelian_alkes"><button id="buttonn">Data Principle Baru</button></a>
        <a href="index.php?page=tambah_pembelian_alkes_sudah_ada">
        <button id="buttonn">Dari Data Principle<br />Yang Sudah Terinput</button></a>
    </div>
</div>


