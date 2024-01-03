<?php require("config/koneksi.php");
//mysqli_query($koneksi, "delete from utang_piutang");
$q = mysqli_query($koneksi, "select * from barang_dijual order by id ASC");
while ($d = mysqli_fetch_array($q)) {
	$pem = mysqli_fetch_array(mysqli_query($koneksi, "select nama_pembeli from pembeli where id=".$d['pembeli_id'].""));
	$cek = mysqli_num_rows(mysqli_query($koneksi, "select * from utang_piutang where no_faktur_no_po='".$d['no_po_jual']."' and klien='".$pem['nama_pembeli']."' and nominal='".$d['total_harga']."'"));
	if ($cek!=0) {
		$up = mysqli_query($koneksi, "update utang_piutang set nominal='".$d['neto']."' where no_faktur_no_po='".$d['no_po_jual']."'");
		}
	else {
		$up = mysqli_query($koneksi, "INSERT INTO utang_piutang values('','Piutang','".$d['no_po_jual']."','".$d['tgl_jual']."','0000-00-00','".$d['neto']."','".$pem['nama_pembeli']."','','0')");
		}
	}