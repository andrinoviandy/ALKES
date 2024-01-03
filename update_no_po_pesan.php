<?php require("config/koneksi.php");
$q = mysqli_query($koneksi, "select * from barang_pesan where no_po_jual='-' order by id ASC");
$i=0;
while ($d = mysqli_fetch_array($q)) {
$i++;
	$pem = mysqli_fetch_array(mysqli_query($koneksi, "select nama_pembeli from pembeli where id=".$d['pembeli_id'].""));
	$cek = mysqli_num_rows(mysqli_query($koneksi, "select * from utang_piutang where no_faktur_no_po='".$d['no_po_jual']."' and klien='".$pem['nama_pembeli']."' and nominal='".$d['total_harga']."'"));
	if ($cek!=0) {
		$up = mysqli_query($koneksi, "update utang_piutang set no_faktur_no_po='".'-'.$i."' where no_faktur_no_po='".$d['no_po_jual']."' and klien='".$pem['nama_pembeli']."' and nominal='".$d['total_harga']."'");
		$up2 = mysqli_query($koneksi, "update barang_dijual set no_po_jual='".'-'.$i."' where no_po_jual='".$d['no_po_jual']."' and pembeli_id='".$d['pembeli_id']."' and total_harga='".$d['total_harga']."'");
		}
	}