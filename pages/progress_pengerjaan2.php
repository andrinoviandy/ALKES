
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Progress Perbaikan <u><?php $da = mysqli_fetch_array(mysqli_query($koneksi, "select * from pembeli where id=$_GET[id]")); ?></u></h1>
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
      <th valign="bottom">Nama Customer</th>
      <th valign="bottom">Alamat</th>
      <th valign="bottom"><strong>Kontak</strong></th>
      </tr>
  </thead>
  <tr>
    <td><?php echo $da['nama_pembeli']; ?></td>
    <td><?php echo $da['jalan']; ?></td>
    <td><?php echo $da['kontak_rs']; ?></td>
    </tr>
</table>
             <br />
             <table width="100%" id="example1" class="table table-bordered table-hover">
  <thead>
    <tr>
      <td align="center">#</td>
      <td><strong>Tgl Lapor</strong></td>
      <td><strong>Penelepon</strong></td>
      <td><strong>Kontak Penelepon</strong></td>
      <td><strong>Keluhan</strong></td>
      <td><strong><font>Nama Alkes</font> <font class="pull pull-right">No Seri / Nama Set</font></strong></td>
      <td align="center"><strong>No SPI</strong></td>
      <td align="center"><strong>No PO</strong></td>
      <td align="center"><strong>Teknisi</strong></td>
      <td align="center"><strong>Aksi</strong></td>
     
      </tr>
  </thead>
  <?php
 
// membuka file JSON
if (isset($_SESSION['id_b'])) {
$file = file_get_contents("http://localhost/ALKES/json/pembuatan_spk2.php?id=$_GET[id]&id_b=$_SESSION[id_b]");
	}
else {
$file = file_get_contents("http://localhost/ALKES/json/pembuatan_spk2.php?id=$_GET[id]");
}
$json = json_decode($file, true);
$jml=count($json); 
for ($i=0; $i<$jml; $i++) {
//echo "Nama Barang ke-".$i." : " . $json[$i]['nama_brg'] . "<br />";
//echo 'Nama Anggota ke-3 : ' . $json['2']['nama_brg'];
?>
  <tr>
    <td align="center"><?php echo $i+1; ?></td>
    <td><font><?php echo date("d-m-Y H:i:s A",strtotime($json[$i]['tgl_lapor'])); ?></font></td>
    <td><?php echo $json[$i]['nama_penelepon']; ?></td>
    <td><?php echo $json[$i]['kontak_penelepon']; ?></td>
    <td><?php echo $json[$i]['keluhan']; ?></td>
    <td>
      <table width="100%" border="0" style="line-height:30px;">
        <?php 
	  $q2=mysqli_query($koneksi, "select * from tb_laporan_kerusakan_cs,tb_laporan_kerusakan_cs_detail,tb_laporan_kerusakan_detail,alat_pelatihan,alat_uji_detail,barang_teknisi_detail,barang_dikirim_detail,barang_gudang_detail,barang_gudang,tb_teknisi where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dikirim_detail.id=barang_teknisi_detail.barang_dikirim_detail_id and barang_teknisi_detail.id=alat_uji_detail.barang_teknisi_detail_id and alat_uji_detail.id=alat_pelatihan.alat_uji_detail_id and alat_pelatihan.id=tb_laporan_kerusakan_detail.alat_pelatihan_id and tb_laporan_kerusakan_cs.id=tb_laporan_kerusakan_cs_detail.tb_laporan_kerusakan_cs_id and tb_laporan_kerusakan_cs_detail.id=tb_laporan_kerusakan_detail.tb_laporan_kerusakan_cs_detail_id and tb_teknisi.id=tb_laporan_kerusakan_detail.teknisi_id and tb_laporan_kerusakan_cs.id=".$json[$i]['idd']."");
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
          <td></td>
          <td align="right" style="padding-right:10px"><?php echo $d1['no_seri_brg']." ".$d1['nama_set']; ?>
            </td>
          </tr>
        <?php } ?>
        </table>
    </td>
    <td align="center">
    <table width="100%" border="0" style="line-height:30px;">
        <?php 
	  $q3=mysqli_query($koneksi, "select * from tb_laporan_kerusakan_cs,tb_laporan_kerusakan_cs_detail,tb_laporan_kerusakan_detail,alat_pelatihan,alat_uji_detail,barang_teknisi_detail,barang_dikirim_detail,barang_gudang_detail,barang_gudang,tb_teknisi,barang_teknisi where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dikirim_detail.id=barang_teknisi_detail.barang_dikirim_detail_id and barang_teknisi_detail.id=alat_uji_detail.barang_teknisi_detail_id and alat_uji_detail.id=alat_pelatihan.alat_uji_detail_id and alat_pelatihan.id=tb_laporan_kerusakan_detail.alat_pelatihan_id and tb_laporan_kerusakan_cs.id=tb_laporan_kerusakan_cs_detail.tb_laporan_kerusakan_cs_id and tb_laporan_kerusakan_cs_detail.id=tb_laporan_kerusakan_detail.tb_laporan_kerusakan_cs_detail_id and tb_teknisi.id=tb_laporan_kerusakan_detail.teknisi_id and barang_teknisi.id=barang_teknisi_detail.barang_teknisi_id and tb_laporan_kerusakan_cs.id=".$json[$i]['idd']."");
	  $nn=0;
	  while ($d1=mysqli_fetch_array($q3)) {
	  $nn++;
	  if ($nn%2==0) {
		  $col="#CCCCCC";
		  }
		  else {
			  $col="#999999";
			  }
	  ?>
        <tr bgcolor="<?php echo $col; ?>">
          <td align="left" style="padding-left:10px"><?php echo $nn.". ".$d1['no_spk'] ?></td>
          
          </tr>
        <?php } ?>
        </table>
    </td>
    <td align="center">
    <table width="100%" border="0" style="line-height:30px;">
        <?php 
	  $q4=mysqli_query($koneksi, "select * from tb_laporan_kerusakan_cs,tb_laporan_kerusakan_cs_detail,tb_laporan_kerusakan_detail,alat_pelatihan,alat_uji_detail,barang_teknisi_detail,barang_dikirim_detail,barang_gudang_detail,barang_gudang,tb_teknisi,barang_teknisi,barang_dikirim,barang_dijual where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dikirim_detail.id=barang_teknisi_detail.barang_dikirim_detail_id and barang_teknisi_detail.id=alat_uji_detail.barang_teknisi_detail_id and alat_uji_detail.id=alat_pelatihan.alat_uji_detail_id and alat_pelatihan.id=tb_laporan_kerusakan_detail.alat_pelatihan_id and tb_laporan_kerusakan_cs.id=tb_laporan_kerusakan_cs_detail.tb_laporan_kerusakan_cs_id and tb_laporan_kerusakan_cs_detail.id=tb_laporan_kerusakan_detail.tb_laporan_kerusakan_cs_detail_id and tb_teknisi.id=tb_laporan_kerusakan_detail.teknisi_id and barang_teknisi.id=barang_teknisi_detail.barang_teknisi_id and barang_dijual.id=barang_dikirim.barang_dijual_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and tb_laporan_kerusakan_cs.id=".$json[$i]['idd']."");
	  $n4=0;
	  while ($d1=mysqli_fetch_array($q4)) {
	  $n4++;
	  if ($n4%2==0) {
		  $col="#CCCCCC";
		  }
		  else {
			  $col="#999999";
			  }
	  ?>
        <tr bgcolor="<?php echo $col; ?>">
          <td align="left" style="padding-left:10px"><?php echo $n4.". ".$d1['no_po_jual'] ?></td>
          
          </tr>
        <?php } ?>
        </table>
    </td>
    <td align="center">
    <table width="100%" border="0" style="line-height:30px;">
        <?php 
	  $q3=mysqli_query($koneksi, "select * from tb_laporan_kerusakan_cs,tb_laporan_kerusakan_cs_detail,tb_laporan_kerusakan_detail,alat_pelatihan,alat_uji_detail,barang_teknisi_detail,barang_dikirim_detail,barang_gudang_detail,barang_gudang,tb_teknisi where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dikirim_detail.id=barang_teknisi_detail.barang_dikirim_detail_id and barang_teknisi_detail.id=alat_uji_detail.barang_teknisi_detail_id and alat_uji_detail.id=alat_pelatihan.alat_uji_detail_id and alat_pelatihan.id=tb_laporan_kerusakan_detail.alat_pelatihan_id and tb_laporan_kerusakan_cs.id=tb_laporan_kerusakan_cs_detail.tb_laporan_kerusakan_cs_id and tb_laporan_kerusakan_cs_detail.id=tb_laporan_kerusakan_detail.tb_laporan_kerusakan_cs_detail_id and tb_teknisi.id=tb_laporan_kerusakan_detail.teknisi_id and tb_laporan_kerusakan_cs.id=".$json[$i]['idd']."");
	  $m=0;
	  while ($d1=mysqli_fetch_array($q3)) {
	  $m++;
	  if ($m%2==0) {
		  $col="#CCCCCC";
		  }
		  else {
			  $col="#999999";
			  }
	  ?>
        <tr bgcolor="<?php echo $col; ?>">
          <td align="left" style="padding-left:10px"><?php echo $n.". ".$d1['nama_teknisi'] ?></td>
          <td></td>
          <td align="right" style="padding-right:10px"><?php echo $d1['no_seri_brg']." ".$d1['nama_set']; ?>
            </td>
          </tr>
        <?php } ?>
        </table>
    </td>
    <td align="center">
      <a href="index.php?page=progress_pengerjaan3&id_detail=<?php echo $json[$i]['idd']; ?>&id=<?php echo $_GET['id']; ?>"><span data-toggle="tooltip" title="Detail Progress" class="fa fa-caret-square-o-right"></span></a>
      <!--
      <a href="pages/delete_spk.php?id_hapus=<?php echo $json[$i]['idd']; ?>&id=<?php echo $_GET['id']; ?>" onclick="return confirm('Anda Yakin Akan Menghapus Item Ini ?')"><span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span></a> &nbsp;&nbsp;
      
      <a href="index.php?page=detail_pembuatan_spk2&id_detail=<?php echo $json[$i]['idd']; ?>&id=<?php echo $_GET['id']; ?>"><span data-toggle="tooltip" title="Detail Maintenance" class="fa fa-caret-square-o-right"></span></a> &nbsp;&nbsp; 
      
      <a href="index.php?page=buat_spk&id=<?php echo $data['idd']; ?>"><small data-toggle="tooltip" title="Progress Pengerjaan" class="label bg-green">Progress</small></a>
    -->  
    </td>
    
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
