<?php 
header("Content-type: application/msword");
header("Content-disposition: inline; filename=Sertifikat Pelatihan-$_GET[nama].doc");
require("config/koneksi.php"); ?>
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
$nama=ucwords(strtolower($_GET['nama']));
$data = mysqli_fetch_array(mysqli_query($koneksi, "select *,alat_uji_detail.id as idd,pembeli_id as id_rumkit from barang_teknisi,barang_teknisi_detail,barang_teknisi_detail_teknisi, barang_dikirim,barang_dikirim_detail, barang_dijual, barang_gudang, barang_gudang_detail,pembeli, tb_teknisi,alat_uji_detail,alat_pelatihan where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dijual.id=barang_dikirim.barang_dijual_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and pembeli.id=barang_dijual.pembeli_id and barang_dikirim_detail.id=barang_teknisi_detail.barang_dikirim_detail_id and barang_teknisi.id=barang_teknisi_detail.barang_teknisi_id and barang_teknisi_detail.id=barang_teknisi_detail_teknisi.barang_teknisi_detail_id and tb_teknisi.id=barang_teknisi_detail_teknisi.teknisi_id and barang_teknisi_detail.id=alat_uji_detail.barang_teknisi_detail_id and alat_uji_detail.id=alat_pelatihan.alat_uji_detail_id and alat_pelatihan.id=".$_GET['id'].""));

$ALKES=$data['nama_brg'];
$TIPE=$data['tipe_brg'];
$MERK=$data['merk_brg'];
$NOSERI=$data['no_seri_brg'];
$tgl_pelatihan=tgl_indo($data['tgl_pelatihan']);

// memanggil dan membaca template dokumen yang telah kita buat
$document = file_get_contents("laporan/sertifikat/sertifikat_pelatihan.rtf");
// isi dokumen dinyatakan dalam bentuk string
$document = str_replace("#NAMA", $nama, $document);
$document = str_replace("#ALKES", $ALKES, $document);
$document = str_replace("#TYPE", $TIPE, $document);
$document = str_replace("#BRAND", $MERK, $document);
$document = str_replace("#TGL_PELATIHAN", $tgl_pelatihan, $document);

// header untuk membuka file output RTF dengan MS. Word

header("Content-length: ".strlen($document));
echo $document;
?>