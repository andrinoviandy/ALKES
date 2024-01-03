
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Laporan Kerusakan
        
      dari <u><?php $da = mysqli_fetch_array(mysqli_query($koneksi, "select *,pembeli.id as idd from pembeli,alamat_provinsi,alamat_kecamatan,alamat_kabupaten where alamat_provinsi.id=pembeli.provinsi_id and alamat_kabupaten.id=pembeli.kabupaten_id and alamat_kecamatan.id=pembeli.kecamatan_id and pembeli.id=$_GET[id]")); echo $da['nama_pembeli']; ?></u></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Laporan Kerusakan</li>
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
              
              <!--
              <form method="post" class="">
              <div class="input-group input-group-md col-xs-4 pull pull-right">
                <input type="text" name="cari" placeholder="Keyword....." class="form-control">
                    <span class="input-group-btn">
                      <button type="submit" name="button_cari" class="btn btn-info btn-flat"><i class="fa fa-search"></i> Cari </button>
                    </span>
              </div>
              </form>
              -->
              <table width="100%" id="" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th valign="bottom">Nama Instansi</th>
      <th valign="bottom">Alamat</th>
      <th valign="bottom"><strong>Kontak</strong></th>
      </tr>
  </thead>
  <tr>
    <td><?php echo $da['nama_pembeli']; ?></td>
    <td><?php echo $da['jalan'].", ".$da['kelurahan_id'].", ".$da['nama_kecamatan'].", ".$da['nama_kabupaten'].", ".$da['nama_provinsi']; ?></td>
    <td><?php echo $da['kontak_rs']; ?></td>
    </tr>
</table>
             <br />
                <table width="100%" id="example1" class="table table-bordered table-hover">
  <thead>
    <tr>
      <td align="center">#</td>
      <td><strong>Tanggal Lapor</strong></td>
      <td><strong>Nama Penelepon</strong></td>
      <td><strong>Kontak Penelepon</strong></td>
      <td><strong>Keluhan</strong></td>
      <td><font><strong>Nama Alkes</strong></font><font class="pull-right"><strong>No PO</strong></font></td>
      <td align="center"><strong>Aksi</strong></td>
     
      </tr>
  </thead>
  <?php
 
// membuka file JSON
$file = file_get_contents("http://localhost/ALKES/json/laporan_kerusakan_lama_cs.php?id=$_GET[id]");
$json = json_decode($file, true);
$jml=count($json); 
for ($i=0; $i<$jml; $i++) {
//echo "Nama Barang ke-".$i." : " . $json[$i]['nama_brg'] . "<br />";
//echo 'Nama Anggota ke-3 : ' . $json['2']['nama_brg'];
?>
  <tr>
    <td align="center"><?php echo $i+1; ?></td>
    <td>
      <font><?php echo date("d-m-Y H:i:s A",strtotime($json[$i]['tgl_lapor'])); ?></font></td>
    <td><?php echo $json[$i]['nama_penelepon']; ?></td>
    <td><?php echo $json[$i]['kontak_penelepon']; ?></td>
    <td><?php echo $json[$i]['keluhan']; ?></td>
    <td>
      <table width="100%" border="0" style="line-height:30px;">
        <?php 
	  $q2=mysqli_query($koneksi, "select * from tb_laporan_kerusakan_cs,tb_laporan_kerusakan_cs_detail,barang_gudang,pembeli where pembeli.id=tb_laporan_kerusakan_cs.pembeli_id and tb_laporan_kerusakan_cs.id=tb_laporan_kerusakan_cs_detail.tb_laporan_kerusakan_cs_id and barang_gudang.id=tb_laporan_kerusakan_cs_detail.barang_gudang_id and tb_laporan_kerusakan_cs.id=".$json[$i]['idd']." and pembeli.id=$_GET[id]");
	  $n=0;
	  while ($d1=mysqli_fetch_array($q2)) {
	  $n++;
	  if ($n%2==0) {
		  $col="#CCCCCC";
		  }
		  else {
			  $col="#999999";
			  }
	  ?>
        <tr bgcolor="<?php echo $col; ?>">
          <td align="left" style="padding-left:10px"><?php echo $n.". ".$d1['nama_brg'] ?></td>
          <td align=""></td>
          <td align="right" style="padding-right:10px"><?php echo $d1['no_po_jual_cs']; ?>
            </td>
          </tr>
        <?php } ?>
        </table>
    </td>
    <td align="center">
      
      <a href="pages/delete_laporan_cs.php?id_hapus=<?php echo $json[$i]['idd']; ?>&id=<?php echo $_GET['id']; ?>" onclick="return confirm('Anda Yakin Akan Menghapus Item Ini ?')"><span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span></a> &nbsp;&nbsp;
      <!--
      <a href="index.php?page=detail_laporan_kerusakan_lama&id_detail=<?php echo $json[$i]['idd']; ?>&id=<?php echo $_GET['id']; ?>"><span data-toggle="tooltip" title="Detail Kerusakan" class="fa fa-caret-square-o-right"></span></a> &nbsp;&nbsp; 
      --></td>
    
  </tr>
  <?php } ?>
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
