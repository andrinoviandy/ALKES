<?php require("config/koneksi.php"); ?>
<?php
function tgl_indo($tanggal){
	$bulan = array (
		1 =>   'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
	);
	$pecahkan = explode('-', $tanggal);
	
	// variabel pecahkan 0 = tanggal
	// variabel pecahkan 1 = bulan
	// variabel pecahkan 2 = tahun
 
	return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}
// membaca data dari form
$id = $_GET['idd'];
$data = mysqli_fetch_array(mysqli_query($koneksi, "select * from jual_barang,master_barang,tb_teknisi where master_barang.id=jual_barang.id_master_brg and tb_teknisi.id=jual_barang.id_teknisi and jual_barang.id=$id"));
$nama_teknisi=$data['nama_teknisi'];
$bidang=$data['bidang'];
$no_str=$data['no_str'];
$no_hp=$data['no_hp'];
$tgl_spk=tgl_indo($data['tgl_spk_instalasi']);
$pembeli=$data['pembeli'];
$barang=$data['nama_brg'];
$tipe=$data['tipe_brg'];
$no_seri=$data['no_seri_brg'];
$merk=$data['merk_brg'];
$nie=$data['nie_brg'];
$alamat=$data['alamat_pembeli'];
// memanggil dan membaca template dokumen yang telah kita buat
$document = file_get_contents("laporan/spk/instalasi/SPK_Instalasi.rtf");
// isi dokumen dinyatakan dalam bentuk string
$document = str_replace("#DATASERI", $no_seri, $document);
$document = str_replace("#PEMBELI", $pembeli, $document);
$document = str_replace("#NAMA", $nama_teknisi, $document);
$document = str_replace("#JALAN",$alamat,$document);
$document = str_replace("#BIDANG", $bidang, $document);
$document = str_replace("#NOSTR", $no_str, $document);
$document = str_replace("#NOHP", $no_hp, $document);
$document = str_replace("#ALKES", $barang, $document);
$document = str_replace("#MERK", $merk, $document);
$document = str_replace("#TIPE", $tipe, $document);
$document = str_replace("#NIE", $nie, $document);
$document = str_replace("#TANGGAL", $tgl_spk, $document);

// header untuk membuka file output RTF dengan MS. Word
header("Content-type: application/msword");
header("Content-disposition: inline; filename=SPK Instalasi-$nama_teknisi-$tgl_spk.doc");
header("Content-length: ".strlen($document));
echo $document;
?>