<?php require("config/koneksi.php"); ?>
<?php
// membaca data dari form
$id = $_GET['id'];
$data = mysqli_fetch_array(mysqli_query($koneksi, "select *,tb_spk.id as idd from tb_spk,tb_teknisi,tb_laporan_kerusakan,barang,akun where akun.id=barang.id_akun and barang.id=tb_laporan_kerusakan.id_barang and tb_laporan_kerusakan.id=tb_spk.id_lapor and tb_teknisi.id=tb_spk.id_teknisi and tb_spk.id=$id"));
$nama_teknisi=$data['nama_teknisi'];
$bidang=$data['bidang'];
$no_hp=$data['no_hp'];
$tgl_spk=$data['tgl_spk'];
// memanggil dan membaca template dokumen yang telah kita buat
$document = file_get_contents("laporan/spk/perbaikan_alkes/SPK.rtf");
// isi dokumen dinyatakan dalam bentuk string
$document = str_replace("#NAMA", $nama_teknisi, $document);
$document = str_replace("#BIDANG", $bidang, $document);
$document = str_replace("#NOHP", $no_hp, $document);
$document = str_replace("#TANGGAL", $tgl_spk, $document);
// header untuk membuka file output RTF dengan MS. Word
header("Content-type: application/msword");
header("Content-disposition: inline; filename=SPK-$nama_teknisi-$tgl_spk.doc");
header("Content-length: ".strlen($document));
echo $document;
?>