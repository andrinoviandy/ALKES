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
$data = mysqli_fetch_array(mysqli_query($koneksi, "select *,barang_dikirim_detail.id as idd from barang_gudang,barang_gudang_detail,barang_dikirim,barang_dikirim_detail where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and barang_dikirim_detail.id=".$_GET['id'].""));

$ALKES=$data['nama_brg'];
$TIPE=$data['tipe_brg'];
$MERK=$data['merk_brg'];
$NOSERI=$data['no_seri_brg'];
$NAMASET=$data['nama_set'];

// memanggil dan membaca template dokumen yang telah kita buat
$document = file_get_contents("laporan/kartu_garansi/kartu_garansi.rtf");
// isi dokumen dinyatakan dalam bentuk string
$document = str_replace("#ALKES", $ALKES, $document);
$document = str_replace("TYPE", $TIPE, $document);
$document = str_replace("#MERK", $MERK, $document);
$document = str_replace("#SERI", $NOSERI, $document);
$document = str_replace("#SET", $NAMASET, $document);
$document = str_replace("#PERIODE", "1 Tahun", $document);

// header untuk membuka file output RTF dengan MS. Word
header("Content-type: application/msword");
header("Content-disposition: inline; filename=Kartu Garansi-$ALKES-$NOSERI.doc");
header("Content-length: ".strlen($document));
echo $document;
?>