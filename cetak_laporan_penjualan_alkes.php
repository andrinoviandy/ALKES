<?php 
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Rekapan Penjualan Alkes - ".date("d/m/Y", strtotime($_POST['tgl1']))." - ".date("d/m/Y", strtotime($_POST['tgl2'])).".xls");
?>
<?php require("config/koneksi.php"); ?>
<h2 align="center" style="margin-bottom:0px"><strong>PT. CIPTA VARIA KHARISMA UTAMA</strong></h2>
<center>
Rekapan Penjualan Alkes
<br />
Tanggal : <?php echo date("d/m/Y", strtotime($_POST['tgl1']))." - ".date("d/m/Y", strtotime($_POST['tgl2'])) ?>
</center>
<br />
<table width="100%" id="" border="1">
  <thead>
    <tr>
      <th align="center">No</th>
      <th align="center" width="5%"><strong>Status PO</strong></th>
      <th align="center"><strong>Tanggal_Jual</strong></th>
      <th align="center">No PO</th>
      <th align="center">No_Kontrak</th>
      <!--<th align="center">No_PO</th>-->
      <th align="center">Nama Barang</th>
      <th align="center">Tipe</th>
      <th align="center">Qty</th>
      <th align="center"><strong>Dinas/RS/Puskemas/Klinik</strong></th>
      <th align="center">Nama Pemakai</th>
      <th align="center">Marketing</th>
      <th align="center">Subdis</th>
      
      <th align="center">Total Harga</th>
      <th align="center">Ongkir</th>
      <th align="center">DPP</th>
      <th align="center">Diskon</th>
      <th align="center">PPN</th>
      <th align="center">PPh</th>
      <th align="center">Zakat</th>
      <th align="center">Biaya Bank</th>
      <th align="center">Neto</th>
      <th align="center">Fee Subdis</th>
      
      <th align="center">Status</th>
    </tr>
  </thead>
  <?php
 
// membuka file JSON
$file = file_get_contents("http://localhost/ALKES/json/jual_barang_uang.php?cetak_rekap=1&tgl1=".$_POST['tgl1']."&tgl2=".$_POST['tgl2']."");
$json = json_decode($file, true);
$jml=count($json); 
for ($i=0; $i<$jml; $i++) {
//echo "Nama Barang ke-".$i." : " . $json[$i]['nama_brg'] . "<br />";
//echo 'Nama Anggota ke-3 : ' . $json['2']['nama_brg'];
?>
  <tr>
    <td align="center" valign="top"><?php echo $i+1; ?></td>
    <td valign="top"><?php $jm_deal=mysqli_num_rows(mysqli_query($koneksi, "select * from barang_dijual where no_po_jual='".$json[$i]['no_po_jual']."' and status_deal=1"));
	if ($jm_deal!=0) {echo "Sudah Deal";} else {echo "Belum Deal";} ?></td>
    <td valign="top">
    <?php if ($json[$i]['tgl_jual']!='0000-00-00') { echo date("d F Y",strtotime($json[$i]['tgl_jual']));}	
	?>
    </td>
    <td valign="top"><?php echo $json[$i]['no_po_jual'];
	?></td>
    <td valign="top"><?php echo $json[$i]['no_kontrak'];
	?></td>
    <td colspan="3" valign="top">
    <table border="1">
    <?php
	$jml_deal = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_dijual where status_deal=1 and no_po_jual='".$json[$i]['no_po_jual']."'")); 
	if ($jml_deal==0) {
	  $d2=mysqli_fetch_array(mysqli_query($koneksi, "select *,barang_dijual.id as idd from barang_dijual_qty,barang_dijual,barang_gudang where barang_dijual.id=barang_dijual_qty.barang_dijual_id and barang_gudang.id=barang_dijual_qty.barang_gudang_id and barang_dijual.no_po_jual='".$json[$i]['no_po_jual']."' order by barang_dijual.id DESC LIMIT 1"));
	  $q23=mysqli_query($koneksi, "select *,barang_dijual_qty.id as id_det_jual from barang_dijual_qty,barang_dijual,barang_gudang where barang_dijual.id=barang_dijual_qty.barang_dijual_id and barang_gudang.id=barang_dijual_qty.barang_gudang_id and barang_dijual.id=".$d2['idd']."");
	  echo "<center><em>Riwayat Terakhir</em></center>";
	} else {
		$q23=mysqli_query($koneksi, "select *,barang_dijual_qty.id as id_det_jual from barang_dijual_qty,barang_dijual,barang_gudang where barang_dijual.id=barang_dijual_qty.barang_dijual_id and barang_gudang.id=barang_dijual_qty.barang_gudang_id and barang_dijual.no_po_jual='".$json[$i]['no_po_jual']."' and status_deal=1");
	}
	  $n2=0;
	  while ($d1=mysqli_fetch_array($q23)) {
	  $n2++;
	  ?>
      <tr>
      	<td valign="top"><?php echo $d1['nama_brg'] ?></td>
        <td valign="top"><?php echo $d1['tipe_brg'] ?></td>
        <td valign="top" align="center"><?php echo $d1['qty_jual'] ?>
        </td>
      </tr>
      <?php } ?>
      </table>
    </td>
    <td valign="top"><?php 
	$data_pem=mysqli_fetch_array(mysqli_query($koneksi, "select * from barang_dijual,pembeli,pemakai where pembeli.id=barang_dijual.pembeli_id and pemakai.id=barang_dijual.pemakai_id and barang_dijual.id=".$json[$i]['idd'].""));
	echo $data_pem['nama_pembeli']; ?></td>
    <td valign="top"><?php echo $data_pem['nama_pemakai']; ?></td>
    <td align="center" valign="top"><?php echo $json[$i]['marketing']; ?></td>
    <td align="center" valign="top"><?php echo $json[$i]['subdis']; ?></td>
    
    <td valign="top"><?php
    $jml_deal = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_dijual where status_deal=1 and no_po_jual='".$json[$i]['no_po_jual']."'"));
	if ($jml_deal==0) {
	  $data_deal=mysqli_fetch_array(mysqli_query($koneksi, "select *,barang_dijual.id as idd,barang_dijual_qty.id as id_det_jual from barang_dijual_qty,barang_dijual,barang_gudang where barang_dijual.id=barang_dijual_qty.barang_dijual_id and barang_gudang.id=barang_dijual_qty.barang_gudang_id and barang_dijual.no_po_jual='".$json[$i]['no_po_jual']."' order by barang_dijual.id DESC LIMIT 1"));
	} else {
		$data_deal=mysqli_fetch_array(mysqli_query($koneksi, "select *,barang_dijual.id as idd,barang_dijual_qty.id as id_det_jual from barang_dijual_qty,barang_dijual,barang_gudang where barang_dijual.id=barang_dijual_qty.barang_dijual_id and barang_gudang.id=barang_dijual_qty.barang_gudang_id and barang_dijual.no_po_jual='".$json[$i]['no_po_jual']."' and status_deal=1"));
	}
	echo $data_deal['total_harga'];
	//echo number_format($data_deal['total_harga'],0,',','.'); ?></td>
    <td valign="top"><?php 
	echo $data_deal['ongkir'];
	//echo number_format($data_deal['ongkir'],0,',','.'); ?></td>
    <td valign="top"><?php
    $dpp = ($data_deal['total_harga']+$data_deal['ongkir'])/1.1; 
	echo $dpp;
	//echo number_format($dpp,2,',','.'); ?></td>
    <td valign="top"><?php echo $data_deal['diskon_jual']." %"; ?>
    </td>
    <td valign="top"><?php echo $data_deal['ppn_jual']." %"; ?><br />
    <?php echo 
"(".($data_deal['ppn_jual']/100)*($dpp).")";	//"(".number_format(($data_deal['ppn_jual']/100)*($dpp),2,',','.').")"; ?>
    </td>
    <td valign="top"><?php echo $data_deal['pph']." %"; ?><br />
    <?php echo 
"(".$data_deal['pph']/100*$dpp.")";	//"(".number_format($data_deal['pph']/100*$dpp,2,',','.').")"; ?>
    </td>
    <td valign="top">
	<?php echo $data_deal['zakat']." %"; ?><br />
	<?php echo 
	
"(".$data_deal['zakat']/100*$dpp.")";	//"(".number_format($data_deal['zakat']/100*$dpp,2,',','.').")"; ?></td>
    <td valign="top"><?php echo 
	$data_deal['biaya_bank'];
	//number_format($data_deal['biaya_bank'],0,',','.'); ?></td>
    <td valign="top"><strong><?php echo 
	$data_deal['neto'];
	//number_format($data_deal['neto'],0,',','.'); ?></strong></td>
    <td valign="top"><?php 
	$dpp_m = $data_deal['total_harga']/1.1;
	//$ppn_m = $dpp_m * $json[$i]['ppn_jual']/100;
	$pph_m = $dpp_m * $data_deal['pph']/100;
	$zakat_m = $dpp_m * $data_deal['zakat']/100;
	$biaya_bank_m = $data_deal['biaya_bank'];
	$fee = ($dpp_m - ($pph_m+$zakat_m+$biaya_bank_m)) * $data_deal['diskon_jual']/100;
	echo number_format($fee,0,',','.'); ?></td>
    
    <td align="center" valign="top"><?php
    $ttl = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_dikirim where barang_dijual_id=".$data_deal['idd'].""));
	$brg_sm = mysqli_fetch_array(mysqli_query($koneksi, "select tgl_sampai from barang_dikirim where barang_dijual_id=".$data_deal['idd'].""));
	$jml_deal = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_dijual where status_deal=1 and no_po_jual='".$json[$i]['no_po_jual']."'"));
	if ($ttl>0) {
	if ($brg_sm['tgl_sampai']!='0000-00-00') {
		echo "<span class='label bg-green'>Sudah Sampai</span><br>";
		echo date("d/m/Y",strtotime($brg_sm['tgl_sampai']));
		}
	else {
		echo "<span class='label bg-yellow'>Belum Sampai</span>";
		}
	} else {
		if ($jml_deal==0) {
			echo "Belum Deal";
			}
		else {
			echo "Sudah Deal<br><span class='label bg-red'>Proses</span>";
			}
		}
	?></td>
  </tr>
  <?php } ?>
</table>