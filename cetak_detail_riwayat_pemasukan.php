<?php 
header("Content-type: application/vnd-ms-excel");
?>
<?php require("config/koneksi.php"); ?>
<?php
$da2 = mysqli_fetch_array(mysqli_query($koneksi, "select * from utang_piutang where id=$_GET[id_up]"));
if ($da2['u_p']=='Hutang') {
	$s="HU".$da2['id'];
	}
else {
	$s="PI".$da2['id'];
	}
header("Content-Disposition: attachment; filename=Detail Riwayat Pemasukan - $s.xls");
?>
<h3 align="center"><strong>Detail Riwayat Pemasukan</strong></h3>

<p>Tgl Cetak : <?php echo date('d M Y');?></p>
<div class="box-header with-border">
              <h3 class="box-title">Detail Hutang/Piutang</h3></div>
<table width="100%" border="1" id="" class="table table-bordered table-hover">
  <thead>
    <tr>
      <td width="5%" align="center"><strong>-/+</strong></th>
        <th width="15%" valign="top">ID</th>
        <th width="15%" valign="top"><strong>Hutang/Piutang</strong></th>
        <th width="20%" valign="top">Kategori</th>
        <th width="20%" valign="top">Klien</th>
      <th width="20%" valign="top"><strong>Deskripsi</strong></th>
      <th width="15%" valign="top">Nominal</th>
      <th width="15%" valign="top"><strong>Pembayaran Terakhir</strong></th>
      <!--<th valign="top">NIE</th>
      <th valign="top">No. Bath</th>
      <th valign="top">No. Lot</th>-->      </tr>
  </thead>
  <?php
	  $query = mysqli_query($koneksi, "select *,utang_piutang.nominal as nominal_up,utang_piutang.id as id_up from utang_piutang_bayar,buku_kas,utang_piutang,kategori_buku_kas where utang_piutang.id=utang_piutang_bayar.utang_piutang_id and kategori_buku_kas.id=utang_piutang.kategori_buku_kas_id and buku_kas.id=utang_piutang_bayar.buku_kas_id and utang_piutang.id=$_GET[id_up] group by utang_piutang_id order by utang_piutang.tgl_input DESC");

  $no=0;
  while ($data = mysqli_fetch_array($query)) { 
  $no++;
  ?>
  <tr>
    <td align="center" valign="top"><?php
    if ($data['u_p']=='Hutang') {
		echo "-";
		}
	else {
		echo "+";
		} ?></td>
    <td valign="top"><?php if($data['u_p']=='Hutang'){
		echo "HU".$data['id_up'];
		} else { echo "PI".$data['id_up']; }  ?></td>
    
    <td valign="top">
    <?php echo $data['u_p'];;  ?>
  </td>
    <td valign="top"><?php echo $data['nama_kategori']; ?></td>
    <td valign="top"><?php echo $data['klien']; ?></td>
    
      <td valign="top"><?php echo $data['deskripsi']; ?></td>
      <td valign="top"><?php echo "Rp ".number_format($data['nominal_up'],2,',','.'); ?></td>
      <td valign="top">
      <?php
      $dd = mysqli_fetch_array(mysqli_query($koneksi, "select * from utang_piutang_bayar where utang_piutang_id=$data[id_up] order by tgl_bayar DESC LIMIT 1"));
	  echo date("d/m/y",strtotime($dd['tgl_bayar']))." : Rp".number_format($dd['nominal'],2,',','.');
	  ?>
      <br />
      <font style="font-size:11px"><?php 
	$ddd = mysqli_fetch_array(mysqli_query($koneksi, "select sum(nominal) as nominal_bayar from utang_piutang_bayar where utang_piutang_id=$data[id_up]"));
	echo "Total Pembayaran : Rp".number_format($ddd['nominal_bayar'],2,',','.'); ?></font></td>
    <!--<td></td>
    <td><?php echo $data['no_bath']; ?></td>
    <td><?php echo $data['no_lot']; ?></td>-->
    
    </tr>
  <?php } ?>
</table>
<div class="box-header with-border">
<h3 class="box-title"><br />Detail Pembayaran</h3></div>
<table width="100%" border="1" id="example1" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th width="15%" valign="top"><strong>Tanggal</strong></th>
        <th width="18%" valign="top">Nominal</th>
      <th width="22%" valign="top"><strong>Deskripsi</strong></th>
      <th width="15%" valign="top"> Akun</th>
      <!--<th valign="top">NIE</th>
      <th valign="top">No. Bath</th>
      <th valign="top">No. Lot</th>-->
      </tr>
  </thead>
  <?php 
  $q2=mysqli_query($koneksi, "select *,utang_piutang_bayar.id as idd from utang_piutang_bayar,buku_kas where buku_kas.id=utang_piutang_bayar.buku_kas_id and utang_piutang_id=$_GET[id_up]");
  while ($d = mysqli_fetch_array($q2)) {
  ?>
  <tr>
    <td valign="top">
      <?php echo date("d M Y",strtotime($d['tgl_bayar']));  ?></td>
    <td valign="top"><?php echo "Rp ".number_format($d['nominal'],2,',','.'); ?>
    </td>
    
      <td valign="top"><?php echo $d['deskripsi']; ?></td>
      <td valign="top"><?php echo $d['nama_akun']; ?></td>
      </tr>
 <?php } ?>
</table>