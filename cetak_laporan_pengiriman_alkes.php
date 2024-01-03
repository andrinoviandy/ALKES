<?php 
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Rekapan Pengiriman Alkes - ".date("d/m/Y", strtotime($_POST['tgl1']))." - ".date("d/m/Y", strtotime($_POST['tgl2'])).".xls");
?>
<?php require("config/koneksi.php"); ?>
<h2 align="center" style="margin-bottom:0px"><strong>PT. CIPTA VARIA KHARISMA UTAMA</strong></h2>
<center>
Rekapan Pengiriman Alkes
<br />
Tanggal : <?php echo date("d/m/Y", strtotime($_POST['tgl1']))." - ".date("d/m/Y", strtotime($_POST['tgl2'])) ?>
</center>
<br />
<table width="100%" id="" border="1">
  <thead>
    <tr>
      <th align="center">No</th>
      <th align="center" bgcolor="#99FFCC">Tanggal Kirim</th>
      <th width="20%">Nama Paket</th>
      <th>No_Surat_Jalan</th>
      <th>No_PO</th>
      <th>Nama Barang</th>
      <th>Tipe</th>
      <th>No. Seri</th>
      <th>Status</th>
      <th><strong>Lokasi Tujuan</strong></th>
      <th>Kontak</th>
      <th>Ekspedisi</th>
      <th>Via Pengiriman</th>
      <th>Estimasi Sampai Tujuan</th>
      <th bgcolor="#99FFCC"><strong>Tanggal Sampai</strong></th>
     </tr>
  </thead>
  <?php
// membuka file JSON
$file = file_get_contents("http://localhost/ALKES/json/kirim_barang.php?tgl1=".$_POST['tgl1']."&tgl2=".$_POST['tgl2']."");
$json = json_decode($file, true);
$jml=count($json); 
for ($i=0; $i<$jml; $i++) {
//echo "Nama Barang ke-".$i." : " . $json[$i]['nama_brg'] . "<br />";
//echo 'Nama Anggota ke-3 : ' . $json['2']['nama_brg'];
?>
  <tr>
    <td align="center" valign="top"><?php
	$akh =0; 
	if (isset($_GET['paging'])) {
		if ($_GET['paging']==1) {
			echo $i+1;
			$akh = $i+1;
			}
		else {
			$sel = mysqli_fetch_array(mysqli_query($koneksi, "select jumlah_limit from limiter"));
			echo (($_GET['paging']-1)*$sel['jumlah_limit'])+$i+1;
			$akh = (($_GET['paging']-1)*$sel['jumlah_limit'])+$i+1;
			}
	} else {
		echo $i+1;
		$akh = $i+1;
		}
	?></td>
    <td align="center" valign="top" bgcolor="#99FFCC"><?php echo date("d M Y",strtotime($json[$i]['tgl_kirim'])); ?></td>
    <td valign="top"><?php echo $json[$i]['nama_paket']; ?></td>
    
    <td valign="top"><span class="label bg-info" style="color:#000; font-size:12px"><?php echo $json[$i]['no_pengiriman'];
	 ?></span>
     <?php if ($json[$i]['status_pengganti']==1) {echo "<br><marquee><em>(Barang Pengganti)</em></marquee>";}
	 ?>
    </td>
    <td valign="top">
    <!--
    <table width="100%" border="0">
      <?php 
	  $q2=mysqli_query($koneksi, "select no_po_gudang from barang_gudang,barang_gudang_po,barang_gudang_detail,barang_dikirim_detail where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_po.id=barang_gudang_detail.barang_gudang_po_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dikirim_id=".$json[$i]['idd']."");
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
        <td align="left"><?php echo $d1['no_po_gudang']; ?></td>
        </tr>
      <?php } ?>
    </table>--><?php echo $json[$i]['no_po_jual']; ?></td>
    <td colspan="4" valign="top">
    <table border="1">
    <?php 
	  $q23=mysqli_query($koneksi, "select nama_brg,no_seri_brg,status_spi,status_kerusakan,status_batal,tipe_brg from barang_gudang,barang_gudang_detail,barang_dikirim_detail where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dikirim_id=".$json[$i]['idd']."");
	  $n2=0;
	  while ($d1=mysqli_fetch_array($q23)) {
	  $n2++;
	  ?>
      
      <tr>
      	<td valign="top"><?php echo $d1['nama_brg'] ?></td>
        <td valign="top"><?php echo $d1['tipe_brg'] ?></td>
        <td valign="top"><?php echo $d1['no_seri_brg'] ?></td>
        <td align="center" valign="top">
        	<?php if ($d1['status_batal']==1) { ?>
            Dibatalkan
            <?php } ?>
			<?php
            if($d1['status_spi']==1) {
				echo "Masuk SPI";
                }
			?>
        </td>
      </tr>
      <?php } ?>
      </table>
    </td>
    <td valign="top"><?php 
	$data3=mysqli_fetch_array(mysqli_query($koneksi, "select nama_pembeli,kontak_rs from pembeli,barang_dijual,barang_dikirim where pembeli.id=barang_dijual.pembeli_id and barang_dijual.id=barang_dikirim.barang_dijual_id and barang_dikirim.id=".$json[$i]['idd'].""));
	echo $data3['nama_pembeli']; ?>
    </td>
    <td valign="top"><?php echo $data3['kontak_rs']; ?></td>
    <td colspan="3" valign="top">
    <table border="1">
      <tr>
        <td><?php echo $json[$i]['ekspedisi']; ?></td>
        <td><?php echo $json[$i]['via_pengiriman']; ?></td>
        <td>
        	<?php 
			if ($json[$i]['estimasi_barang_sampai']!=0000-00-00) {
			echo date("d/m/Y",strtotime($json[$i]['estimasi_barang_sampai'])); } 
			?>
        </td>
      </tr>
	</table>
    </td>
    <?php 
	if ($json[$i]['tgl_sampai']!=0000-00-00) {
		$bg="#99FFCC";
		}
		else {
			$bg="red";
			}
	?>
    <td align="center" valign="top" bgcolor=<?php echo $bg; ?>>
		<?php
		if ($json[$i]['tgl_sampai']!=0000-00-00) {
	echo date("d M Y", strtotime($json[$i]['tgl_sampai'])); } else {
		echo "-";
		} ?>
    </td>
  </tr>
  <?php } ?>
</table>