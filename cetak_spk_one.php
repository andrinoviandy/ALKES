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
$id = $_GET['id'];
$data = mysqli_fetch_array(mysqli_query($koneksi, "select *,tb_spk.id as idd from tb_spk,tb_teknisi,tb_laporan_kerusakan,barang,akun where akun.id=barang.id_akun and barang.id=tb_laporan_kerusakan.id_barang and tb_laporan_kerusakan.id=tb_spk.id_lapor and tb_teknisi.id=tb_spk.id_teknisi and tb_spk.id=$id"));
$nama_teknisi=$data['nama_teknisi'];
$bidang=$data['bidang'];
$no_str=$data['no_str'];
$no_hp=$data['no_hp'];
$tgl_spk=tgl_indo($data['tgl_spk']);
$pemilik=$data['kepemilikan'];
$barang=$data['nama_barang'];
// memanggil dan membaca template dokumen yang telah kita buat
$document = file_get_contents("laporan/spk/perbaikan_alkes/SPK.rtf");
// isi dokumen dinyatakan dalam bentuk string
$document = str_replace("#NAMA", $nama_teknisi, $document);
$document = str_replace("#BIDANG", $bidang, $document);
$document = str_replace("#STR", $no_str, $document);
$document = str_replace("#NOHP", $no_hp, $document);
$document = str_replace("#TANGGAL", $tgl_spk, $document);
$document = str_replace("#PEMILIK", $pemilik, $document);
$document = str_replace("#BARANG", $barang, $document);
// header untuk membuka file output RTF dengan MS. Word
header("Content-type: application/msword");
header("Content-disposition: inline; filename=SPK Perbaikan ALKES-$nama_teknisi-$tgl_spk.doc");
header("Content-length: ".strlen($document));
echo $document;
?>