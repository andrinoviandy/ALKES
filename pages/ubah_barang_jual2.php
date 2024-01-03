<?php
$data = mysqli_fetch_array(mysqli_query($koneksi, "select *,barang_dijual.id as idd,pembeli.id as id_pembeli from barang_dijual,barang_dijual_detail,barang_gudang,barang_gudang_detail, pembeli,pemakai where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dijual_detail.barang_gudang_detail_id and barang_dijual.id=barang_dijual_detail.barang_dijual_id and pembeli.id=barang_dijual.pembeli_id and pemakai.id=barang_dijual.pemakai_id and barang_dijual.id=".$_GET['id'].""));

if (isset($_POST['lapor'])) {
	$query=mysqli_query($koneksi, "update barang_dijual set tgl_jual='".$_POST['tgl_jual']."',no_faktur_jual='".$_POST['no_faktur']."',marketing='".$_POST['marketing']."',subdis='".$_POST['subdis']."',diskon_jual='".$_POST['diskon']."',ppn_jual='".$_POST['ppn']."' where id=".$_GET['id']."");
		if ($query) {
		echo "<script type='text/javascript'>
		alert('Item Berhasil Diubah !');
		window.location='index.php?page=jual_barang'
		</script>";
			
	} else {
		echo "<script type='text/javascript'>
		alert('Item Gagal Diubah !');
		</script>";
		}
}

if (isset($_GET['id_hapus'])) {
	$del1 = mysqli_query($koneksi, "delete from barang_dijual_detail where id=".$_GET['id_hapus']."");
	
	if ($del1) {
		mysqli_query($koneksi, "update barang_dijual set qty=qty-1 where id=".$_GET['id']."");
		
		echo "<script type='text/javascript'>
		window.location='index.php?page=ubah_barang_jual2&id=$_GET[id]'
		</script>";
		}
	else {
		echo "<script type='text/javascript'>
		alert('Maaf item tidak dapat di hapus karena sudah masuk proses pengiriman ! Jika ingin melanjutkan, hapus proses pengiriman terlebih dahulu !');
		window.location='index.php?page=ubah_barang_jual2&id=$_GET[id]'
		</script>";
			}
	}
	?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Ubah Data Jual Alkes</h1><ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Jual Alkes</li>
        <li class="active">Ubah Data Jual Alkes</li>
        </ol>
    </section>


    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) --><!-- /.row -->
      <!-- Main row -->
<div class="row">
<div class="col-md-5"><!-- /.box -->

          <!-- iCheck -->
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Ubah Data Pembeli</h3>
            </div>
          <div class="box-body">
          	<form method="post">
              Tanggal Jual
              <input name="tgl_jual" type="date" class="form-control" required autofocus="autofocus" value="<?php echo $data['tgl_jual']; ?>"/><br />
              No Faktur
              <input name="no_faktur" type="text" class="form-control" required value="<?php echo $data['no_faktur_jual']; ?>"/><br />
              Marketing
              <input name="marketing" type="text" class="form-control" required value="<?php echo $data['marketing']; ?>"/><br />
              Sub Distributor
              <input name="subdis" type="text" class="form-control" required value="<?php echo $data['subdis']; ?>"/><br />
              Diskon (%)
              <input name="diskon" type="text" class="form-control" required value="<?php echo $data['diskon_jual']; ?>"/><br />
              PPN (%)
              <input name="ppn" type="text" class="form-control" required value="<?php echo $data['ppn_jual']; ?>"/><br />
            	<input name="lapor" type="submit" value="Simpan Perubahan" class="btn btn-success"/>
            </form>
          </div>
          </div>
          <!-- /.box -->
        </div>
      <div class="col-md-7">

        <div class="box box-success"><!-- /.chat -->
            <div class="box-footer">
            <div class="box-header with-border">
              <h3 class="box-title">Detail Alkes Yang Dijual</h3>
              <span class="pull pull-right">Quantity : <?php echo $data['qty']; ?></span>
              </div><div class="box-body">
          <br />
          <table  width="100%" id="example1" class="table table-bordered table-hover">
              <thead>
  <tr>
    <th><strong>Nama Alkes</strong></th>
    <th>Merk</th>

    <th><strong>Tipe</strong></th>
    <th>No Seri</th>
    <th><strong>Harga Beli</strong></th>
    <th>Harga Jual</th>
    
    <!--<th><strong>Aksi</strong></th>-->
  </tr>
  </thead>
  <?php
  $q = mysqli_query($koneksi, "select *,barang_dijual_detail.id as idd from barang_dijual_detail,barang_dijual,barang_gudang_detail,barang_gudang where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dijual_detail.barang_gudang_detail_id and barang_dijual.id=barang_dijual_detail.barang_dijual_id and barang_dijual.id=".$_GET['id']."");
  $no=0;
  while ($d = mysqli_fetch_array($q)) {
  $no++;
  ?>
  <tr>
    <td><?php echo $d['nama_brg']; ?></td>
    <td><?php echo $d['merk_brg']; ?></td>
    <td><?php echo $d['tipe_brg']; ?></td>
    <td><?php echo $d['no_seri_brg']; ?></td>
    <td><?php echo "Rp ".number_format($d['harga_beli'],0,',','.'); ?></td>
    <td><?php echo "Rp ".number_format($d['harga_satuan'],0,',','.'); ?></td>
    <!--
    <td><a href="index.php?page=simpan_tambah_aksesoris&id=<?php echo $data['idd']; ?>"><small data-toggle="tooltip" title="Kelola Aksesoris" class="label bg-green">Batal Jual</small></a><br /><a href="index.php?page=simpan_tambah_aksesoris&id=<?php echo $data['idd']; ?>"><small data-toggle="tooltip" title="Kelola Aksesoris" class="label bg-yellow">Ganti Barang</small></a></td>-->
    <!--<td>
    <a href="index.php?page=ubah_barang_dijual2&id=<?php echo $_GET['id']; ?>&detail=<?php echo $d['idd']; ?>#open_detail"><span data-toggle="tooltip" title="Ubah" class="fa fa-edit"></span></a>&nbsp;
    <?php if (isset($_SESSION['user_administrator']) or isset($_SESSION['user_admin_gudang'])) { ?>
    <a href="index.php?page=ubah_barang_jual2&id=<?php echo $_GET['id']; ?>&id_hapus=<?php echo $d['idd']; ?>" onclick="return confirm('Yakin Akan Menghapus Item Ini ?')"><span data-toggle="tooltip" title="Hapus" class="fa fa-trash"></span></a>
    <?php } ?>
    </td>-->
  </tr>
  <?php } ?>
</table>

              
              </div>
            </div>
          </div>
          <!-- /.box --><!-- /.box -->

        </div>
        
    <!-- /.content -->
  </div>
  </section>
  </div>