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
$data = mysqli_fetch_array(mysqli_query($koneksi, "select *,tb_maintenance.id as idd from tb_laporan_kerusakan,akun_customer,kategori_job,barang_dikirim,barang_dijual,barang_gudang,alat_uji,tb_maintenance,tb_teknisi,pembeli,alamat_kabupaten where akun_customer.id=tb_laporan_kerusakan.akun_customer_id and barang_dikirim.id=tb_laporan_kerusakan.barang_dikirim_id and kategori_job.id=tb_laporan_kerusakan.kategori_job_id and barang_dijual.id=barang_dikirim.barang_dijual_id and barang_gudang.id=barang_dijual.barang_gudang_id and tb_laporan_kerusakan.id=tb_maintenance.laporan_kerusakan_id and tb_teknisi.id=tb_maintenance.teknisi_id and pembeli.id=barang_dijual.pembeli_id and alamat_kabupaten.id=pembeli.kabupaten_id and tb_maintenance.id=".$_GET['id'].""));

//$data2=mysqli_fetch_array(mysqli_query($koneksi, "select * from replacement_part where maintenance_id=$id"));

$HOS=$data['nama_pembeli'];
$alamat=$data['jalan']." ".$data['kelurahan_id'];
$kota=$data['nama_kabupaten'];
$user=$data['nama_user'];
$telp=$data['telp_user'];
$alamat_user=$data['alamat_user'];

$IN=$data['nama_brg'];
$SN=$data['no_seri_brg'];
$BRAND=$data['merk_brg'];
$TYPE=$data['tipe_brg'];

$job=$data['nama_job'];
$problem=$data['problem'];




// memanggil dan membaca template dokumen yang telah kita buat
$document = file_get_contents("laporan/report/report_service.rtf");
// isi dokumen dinyatakan dalam bentuk string
$document = str_replace("#HN", $HOS, $document);
$document = str_replace("#AD", $alamat, $document);
$document = str_replace("#CITY", $kota, $document);
$document = str_replace("#USER", $user, $document);
$document = str_replace("#FAX", $telp, $document);
$document = str_replace("#PRO", $alamat_user, $document);

$document = str_replace("#IN", $IN, $document);
$document = str_replace("#SN", $SN, $document);
$document = str_replace("#MERK", $BRAND, $document);
$document = str_replace("#TIPE", $TYPE, $document);

$document = str_replace("#MAS", $problem, $document);

// header untuk membuka file output RTF dengan MS. Word
header("Content-type: application/msword");
header("Content-disposition: inline; filename=Report Service-$IN/$HOS.doc");
header("Content-length: ".strlen($document));
echo $document;
?>