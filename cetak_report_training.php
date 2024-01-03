<?php 
header("Content-type: application/msword");
header("Content-disposition: inline; filename=Laporan Pelatihan.doc");
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
$data = mysqli_fetch_array(mysqli_query($koneksi, "select *,alat_uji_detail.id as idd,pembeli_id as id_rumkit from barang_teknisi,barang_teknisi_detail,barang_teknisi_detail_teknisi, barang_dikirim,barang_dikirim_detail, barang_dijual, barang_gudang, barang_gudang_detail,pembeli, tb_teknisi,alat_uji_detail,alat_pelatihan,peserta_pelatihan where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dijual.id=barang_dikirim.barang_dijual_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and pembeli.id=barang_dijual.pembeli_id and barang_dikirim_detail.id=barang_teknisi_detail.barang_dikirim_detail_id and barang_teknisi.id=barang_teknisi_detail.barang_teknisi_id and barang_teknisi_detail.id=barang_teknisi_detail_teknisi.barang_teknisi_detail_id and tb_teknisi.id=barang_teknisi_detail_teknisi.teknisi_id and barang_teknisi_detail.id=alat_uji_detail.barang_teknisi_detail_id and alat_uji_detail.id=alat_pelatihan.alat_uji_detail_id and alat_pelatihan.id=peserta_pelatihan.alat_pelatihan_id and alat_pelatihan.id=".$_GET['id'].""));

$HOS=$data['nama_pembeli'];
$IN=$data['nama_brg'];
$SN=$data['no_seri_brg'];
$TGL_I=date("d M Y",strtotime($data['tgl_i']));
/////////////////////////
$BRAND=$data['merk_brg'];
$TYPE=$data['tipe_brg'];
$SW=$data['soft_version'];
$WE=tgl_indo($data['tgl_garansi_habis']);
$pecah=explode(",",$data['nama_peserta']);
$jml=count($pecah);
if (isset($pecah[0])) {
	$nama1=$pecah[0];
	} else {
		$nama1='';
		}
if (isset($pecah[1])) {
	$nama2=$pecah[1];
	} else {
		$nama2='';
		}
if (isset($pecah[2])) {
	$nama3=$pecah[2];
	} else {
		$nama3='';
		}
if (isset($pecah[3])) {
	$nama4=$pecah[3];
	} else {
		$nama4='';
		}
if (isset($pecah[4])) {
	$nama5=$pecah[4];
	} else {
		$nama5='';
		}
if (isset($pecah[5])) {
	$nama6=$pecah[5];
	} else {
		$nama6='';
		}
if (isset($pecah[6])) {
	$nama7=$pecah[6];
	} else {
		$nama7='';
		}
if (isset($pecah[7])) {
	$nama8=$pecah[7];
	} else {
		$nama8='';
		}
if (isset($pecah[8])) {
	$nama9=$pecah[8];
	} else {
		$nama9='';
		}
if (isset($pecah[9])) {
	$nama10=$pecah[9];
	} else {
		$nama10='';
		}
if (isset($pecah[10])) {
	$nama11=$pecah[10];
	} else {
		$nama11='';
		}
if (isset($pecah[11])) {
	$nama12=$pecah[11];
	} else {
		$nama12='';
		}
if (isset($pecah[12])) {
	$nama13=$pecah[12];
	} else {
		$nama13='';
		}
if (isset($pecah[13])) {
	$nama14=$pecah[13];
	} else {
		$nama14='';
		}
if (isset($pecah[14])) {
	$nama15=$pecah[14];
	} else {
		$nama15='';
		}


// memanggil dan membaca template dokumen yang telah kita buat
$document = file_get_contents("laporan/report/report_training.rtf");
// isi dokumen dinyatakan dalam bentuk string
$document = str_replace("#HOSPITAL", $HOS, $document);
$document = str_replace("#IN", $IN, $document);
$document = str_replace("#SN", $SN, $document);
$document = str_replace("#BRAND", $BRAND, $document);
$document = str_replace("#TYPE", $TYPE, $document);
$document = str_replace("#REV", $SW, $document);
$document = str_replace("#WE", $WE, $document);
$document = str_replace("#DATE", $TGL_I, $document);
$document = str_replace("#PN", "Pelatihan Penggunaan Alkes : $IN", $document);

$document = str_replace("#O1", ucwords(strtolower($nama1)), $document);
$document = str_replace("#O2", ucwords(strtolower($nama2)), $document);
$document = str_replace("#O3", ucwords(strtolower($nama3)), $document);
$document = str_replace("#O4", ucwords(strtolower($nama4)), $document);
$document = str_replace("#O5", ucwords(strtolower($nama5)), $document);
$document = str_replace("#O6", ucwords(strtolower($nama6)), $document);
$document = str_replace("#O7", ucwords(strtolower($nama7)), $document);
$document = str_replace("#O8", ucwords(strtolower($nama8)), $document);
$document = str_replace("#O9", ucwords(strtolower($nama9)), $document);
$document = str_replace("#B1", ucwords(strtolower($nama10)), $document);
$document = str_replace("#B2", ucwords(strtolower($nama11)), $document);
$document = str_replace("#B3", ucwords(strtolower($nama12)), $document);
$document = str_replace("#B4", ucwords(strtolower($nama13)), $document);
$document = str_replace("#B5", ucwords(strtolower($nama14)), $document);
$document = str_replace("#B6", ucwords(strtolower($nama15)), $document);



// header untuk membuka file output RTF dengan MS. Word

header("Content-length: ".strlen($document));
echo $document;
?>