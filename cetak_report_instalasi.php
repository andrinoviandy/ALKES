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
$data = mysqli_fetch_array(mysqli_query($koneksi, "select *,alat_uji.id as idd from alat_uji,barang_teknisi,barang_dikirim,barang_dijual, barang_gudang,barang_gudang_detail,pembeli,alamat_provinsi,alamat_kabupaten,alamat_kecamatan,tb_teknisi where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dijual.barang_gudang_detail_id and barang_dijual.id=barang_dikirim.barang_dijual_id and pembeli.id=barang_dijual.pembeli_id and alamat_provinsi.id=pembeli.provinsi_id and alamat_kabupaten.id=pembeli.kabupaten_id and alamat_kecamatan.id=pembeli.kecamatan_id and barang_dikirim.id=barang_teknisi.barang_dikirim_id and tb_teknisi.id=barang_teknisi.teknisi_id and barang_teknisi.id=alat_uji.barang_teknisi_id and alat_uji.id=$id"));



$RS=$data['nama_pembeli'];
$ALMT=$data['jalan'].", Kel. ".$data['kelurahan_id']."  Kec. ".ucwords(strtolower($data['nama_kecamatan']))." Kab. ".ucwords(strtolower($data['nama_kabupaten']));
$TELP=$data['kontak'];

$TGL_INSTALASI=tgl_indo($data['tgl_i']);
$OLEH=$data['nama_teknisi'];

$ALKES=$data['nama_brg'];
$NOSERI=$data['no_seri_brg'];
$TIPE=$data['tipe_brg'];
$SI=$data['soft_version'];
$TGL_GARANSI=tgl_indo($data['tgl_garansi_habis']);


// memanggil dan membaca template dokumen yang telah kita buat
$document = file_get_contents("laporan/report/report_installation.rtf");
// isi dokumen dinyatakan dalam bentuk string
$document = str_replace("MDL", '', $document);
$document = str_replace("#RS", $RS, $document);
$document = str_replace("#ALMT", $ALMT, $document);
$document = str_replace("#TELP", $TELP, $document);

$document = str_replace("#TGLINS", $TGL_INSTALASI, $document);
$document = str_replace("#OLEH", $OLEH, $document);

$document = str_replace("#ALKES", $ALKES, $document);
$document = str_replace("#TIPE", $TIPE, $document);
$document = str_replace("#SERI", $NOSERI, $document);
$document = str_replace("#SI", $SI, $document);
$document = str_replace("#GARANSI", $TGL_GARANSI, $document);

$document = str_replace("#AKSE", '', $document);

$document = str_replace("#SAK", '', $document);
$document = str_replace("#KET", '', $document);

//$document = str_replace("#PN", "Pelatihan Penggunaan Alkes : $barang", $document);
// header untuk membuka file output RTF dengan MS. Word
header("Content-type: application/msword");
header("Content-disposition: inline; filename=Report Installation-".$data['nama_pembeli']."-$ALKES.doc");
header("Content-length: ".strlen($document));
echo $document;
?>