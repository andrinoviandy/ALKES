<?php 
header("Content-type: application/vnd-ms-excel");
?>
<?php require("config/koneksi.php"); ?>
<?php 
$da = mysqli_fetch_array(mysqlI_query($koneksi, "select * from buku_kas where id=$_GET[id]"));
header("Content-Disposition: attachment; filename=Riwayat Buku Kas - $da[nama_akun].xls");
?>
<h3 align="center"><strong>Riwayat Hutang &amp; Piutang</strong></h3>

<p><b>Buku Kas : <?php echo $da['nama_akun']; ?></b><br /><b>Saldo Kas : <?php echo "Rp ".number_format($da['saldo'],2,',','.'); ?></b><br />Tgl Cetak : <?php echo date('d M Y');?></p>
<table width="100%" border="1" id="" class="table table-bordered table-hover">
  <thead>
    <tr>
      <td width="5%" align="center"><strong>-/+</strong></th>
        <th width="15%" valign="top">ID</th>
        <th width="15%" valign="top"><strong>Hutang/Piutang</strong></th>
        <th width="20%" valign="top">No. Faktur/No. PO</th>
        <th width="20%" valign="top">Klien</th>
      <th width="20%" valign="top"><strong>Deskripsi</strong></th>
      <th width="15%" valign="top">Nominal</th>
      <th width="15%" valign="top"><strong>Pembayaran Terakhir</strong></th>
      <th width="10%" align="center" valign="top">Status</th>
      <!--<th valign="top">NIE</th>
      <th valign="top">No. Bath</th>
      <th valign="top">No. Lot</th>-->
      </tr>
  </thead>
  <?php
	  $query = mysqli_query($koneksi, "select *,utang_piutang.nominal as nominal_up,utang_piutang.id as id_up from utang_piutang_bayar,buku_kas,utang_piutang where utang_piutang.id=utang_piutang_bayar.utang_piutang_id and buku_kas.id=utang_piutang_bayar.buku_kas_id and buku_kas.id=".$_GET['id']." group by utang_piutang_id order by utang_piutang.tgl_input DESC");

  $no=0;
  while ($data = mysqli_fetch_array($query)) { 
  $no++;
  ?>
  <tr>
    <td valign="top"><?php
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
    <td align="center" valign="top"><?php echo $data['no_faktur_no_po']; ?></td>
    <td valign="top"><?php echo $data['klien']; ?></td>
    
      <td valign="top"><?php echo $data['deskripsi']; ?></td>
      <td valign="top"><?php echo "Rp ".number_format($data['nominal_up'],2,',','.'); ?></td>
      <td valign="top">
      <?php
      $dd = mysqli_fetch_array(mysqli_query($koneksi, "select * from utang_piutang_bayar where buku_kas_id=$_GET[id] and utang_piutang_id=$data[id_up] order by tgl_bayar DESC LIMIT 1"));
	  echo date("d/m/y",strtotime($dd['tgl_bayar']))." : Rp".number_format($dd['nominal'],2,',','.');
	  ?>
      <br />
      <font style="font-size:11px"><?php 
	$ddd = mysqli_fetch_array(mysqli_query($koneksi, "select sum(nominal) as nominal_bayar from utang_piutang_bayar where utang_piutang_id=$data[id_up]"));
	echo "Total Pembayaran : Rp".number_format($ddd['nominal_bayar'],2,',','.'); ?></font></td>
      <td valign="top"><?php if ($data['status_lunas']==0){echo "Belum Lunas";}else {echo "Sudah Lunas";} ?></td>
    <!--<td></td>
    <td><?php echo $data['no_bath']; ?></td>
    <td><?php echo $data['no_lot']; ?></td>-->
    
  </tr>
  <?php } ?>
</table>