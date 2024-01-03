<?php require("config/koneksi.php");
//mysqli_query($koneksi, "delete from utang_piutang");
$q = mysqli_query($koneksi, "select * from barang_pesan where jenis_po='Dalam Negeri'");
while ($d = mysqli_fetch_array($q)) {
	$pem = mysqli_fetch_array(mysqli_query($koneksi, "select nama_principle from principle where id=".$d['principle_id'].""));
	$cek = mysqli_num_rows(mysqli_query($koneksi, "select * from utang_piutang where no_faktur_no_po='".$d['no_po_pesan']."' and klien='".$pem['nama_principle']."'"));
	if ($cek!=0) {
		$up = mysqli_query($koneksi, "update utang_piutang set nominal='".$d['cost_cf']."' where no_faktur_no_po='".$d['no_po_pesan']."' and klien='".$pem['nama_principle']."'");
		}
	else {
		$up = mysqli_query($koneksi, "INSERT INTO utang_piutang values('','Hutang','".$d['no_po_pesan']."','".$d['tgl_po_pesan']."','0000-00-00','".$d['cost_cf']."','".$pem['nama_principle']."','','0')");
		}
	}