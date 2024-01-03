<?php 
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Rekapan Penjualan Aksesoris _ Marketing ".$_POST['marketing']." ($_POST[tahun]).xls");
?>
<?php require("config/koneksi.php"); ?>
<?php session_start(); ?>
<html>
    <head>
        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">
        <style>
         .mytable{
                border:1px solid black; 
                border-collapse: collapse;
                width: 100%;
            }
            .mytable tr th, .mytable tr td{
                border:1px solid black; 
                padding: 2px 5px;
            }
        </style>
    </head>
    <body>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 align="center">
       Penjualan Aksesoris Alkes</h1>
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
              <div class="input-group col-lg-12">
              <br />
              <?php
			  echo "<h3>Marketing : ".$_POST['marketing']." (".$_POST['tahun'].")"."</h3>"; 
			  ?>
                <table border="1" id="">
  <thead>
    <tr>
      <th align="center">No</th>
      <th valign="top">Tgl Jual</th>
        <th valign="top">No PO</th>
       
        <th valign="top"><strong><table><tr><td><strong>Nama Aksesoris</strong></td><td><strong>Qty</strong></td>
          <td><strong>Harga Satuan</strong></td>
          <td><strong>Diskon Per Barang</strong></td>
        </tr>
        </table></strong></th>
      
      <th align="center" valign="top"><strong>Dinas/RS/Puskemas/Klinik</strong></th>
        <th align="center" valign="top"><strong>Kontak Dinas/RS/dll</strong></th>
        <th align="center" valign="top"><strong>Marketing</strong></th>
        <th align="center" valign="top"><strong>Subdis</strong></th>
        <th align="center" valign="top"><strong>Diskon</strong></th>
        <th align="center" valign="top"><strong>PPN</strong></th>
        <th align="center" valign="top"><strong>Total Harga</strong></th>
        
        <?php if (isset($_SESSION['user_administrator']) && isset($_SESSION['pass_administrator']) or isset($_SESSION['user_admin_gudang']) && isset($_SESSION['pass_admin_gudang'])) { ?>
        
        <?php } ?>
          </tr>
  </thead>
  <?php
 
// membuka file JSON
if ($_POST['marketing']=='all') {
	$query = mysqli_query($koneksi, "select *,aksesoris_jual.id as idd from aksesoris_jual,pembeli where pembeli.id=aksesoris_jual.pembeli_id and DATE_FORMAT(aksesoris_jual.tgl_jual_akse,'%Y')='$_POST[tahun]' order by aksesoris_jual.tgl_jual_akse DESC, aksesoris_jual.id DESC");
}
else {
	$query = mysqli_query($koneksi, "select *,aksesoris_jual.id as idd from aksesoris_jual,pembeli where pembeli.id=aksesoris_jual.pembeli_id and aksesoris_jual.marketing_akse='".$_POST['marketing']."' and DATE_FORMAT(aksesoris_jual.tgl_jual_akse,'%Y')='$_POST[tahun]' order by aksesoris_jual.tgl_jual_akse DESC, aksesoris_jual.id DESC");
}
$no =0; 
while ($d = mysqli_fetch_array($query)) {
	$no++;
//echo "Nama Barang ke-".$i." : " . $d['nama_brg'] . "<br />";
//echo 'Nama Anggota ke-3 : ' . $json['2']['nama_brg'];
?>
  <tr>
    <td align="center"><?php
	echo $no;
	?></td>
    <td><?php echo date("d-m-Y",strtotime($d['tgl_jual_akse'])); ?></td>
   <td><?php echo $d['no_po_jual_akse']; ?></td> 
    <td>
    <table width="100%" border="0">
      <?php 
	  $q2=mysqli_query($koneksi, "select * from aksesoris_jual_qty,aksesoris where aksesoris.id=aksesoris_jual_qty.aksesoris_id and aksesoris_jual_qty.aksesoris_jual_id=".$d['idd']."");
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
      <tr>
        <td style="padding-left:2px" align="left"><?php echo $d1['nama_akse'] ?></td>
        <td style="padding-right:2px" align="right"><?php echo $d1['qty_jual_akse']; ?></td>
        <td style="padding-right:2px" align="right"><?php echo number_format($d1['harga_jual_saat_itu'],0,',','.'); ?></td>
        <td style="padding-right:2px" align="right"><?php echo $d1['diskon_jual_akse']; ?></td>
        </tr>
      <?php } ?>
    </table>
    </td>
    
    <td align=""><?php echo $d['nama_pembeli']; ?></td>
    <td align="" style="background-color:<?php echo $color; ?>"><?php echo $d['kontak_rs']; ?></td>
    <td align=""><?php echo $d['marketing_akse']; ?></td>
    <td align=""><?php echo $d['subdis_akse']; ?></td>
    <td align=""><?php echo $d['diskon_akse']." %"; ?></td>
    <td align=""><?php echo $d['ppn_akse']." %"; ?></td>
    <td align="center"><?php echo $d['total_harga']; ?></td>
    
  </tr>
  <?php } ?>
</table>
              </div>
            </div>
          </div>
          </section>
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
  </body>
</html>