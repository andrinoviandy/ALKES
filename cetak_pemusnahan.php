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
$q=mysqli_query($koneksi, "select * from pemusnahan where id=$id");
$data = mysqli_fetch_array($q);
$date=tgl_indo($data['tgl_pemusnahan']);
$tgl=date('d', strtotime($data['tgl_pemusnahan']));
$bulan=date('m', strtotime($data['tgl_pemusnahan']));
$tahun=date('Y', strtotime($data['tgl_pemusnahan']));
$nama1=$data['disetujui_oleh'];
$nama2=$data['diperiksa_oleh'];
$nama3=$data['disiapkan_oleh'];
$table=

// memanggil dan membaca template dokumen yang telah kita buat
$document = file_get_contents("laporan/pemusnahan/berita_acara.rtf");
// isi dokumen dinyatakan dalam bentuk string
$document = str_replace("#TGL", $tgl, $document);
$document = str_replace("#BULAN", $bulan, $document);
$document = str_replace("#TAHUN", $tahun, $document);
$document = str_replace("#NAMA1", $nama1, $document);
$document = str_replace("#NAMA2", $nama2, $document);
$document = str_replace("#NAMA3", $nama3, $document);
//$document = str_replace("#BARANG", $barang, $document);
// header untuk membuka file output RTF dengan MS. Word
header("Content-type: application/msword");
header("Content-disposition: inline; filename=Berita Acara Pemusnahan Alkes-$date.doc");
header("Content-length: ".strlen($document));
echo $document;
?>