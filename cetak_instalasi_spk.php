
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

$content='<table width="100%" style="line-height:23px">
  <tr>
    <td align="center"><img src="img/pemusnahan alkes.jpg" width="200px" height="50px"></td>
  </tr>
  <tr>
    <td align="center">
      <h3>SURAT PERINTAH KERJA<br>
        UJI FUNGSI INSTALASI ALKES / LAB<br>
        Nomor : ..... /SPK/VII/2018
        
    </h3></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><p align="justify">Dalam rangka Instalasi dan Uji Fungsi Alat Kesehatan, maka Manager PT. Kharisma memberi tanggung jawab kepada :</p></td>
  </tr>
  <tr>
    <td><table width="100%">
      <tr>
        <td width="5%">&nbsp;</td>
        <td width="26%">Nama Teknisi</td>
        <td width="2%">:</td>
        <td width="67%">&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>Kompetensi</td>
        <td>:</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>No. STR</td>
        <td>:</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>No. HP</td>
        <td>:</td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Dengan ALKES / LAB yang akan di install adalah sebagai berikut :</td>
  </tr>
  <tr>
    <td>
    <table width="100%">
      <tr>
        <td width="5%">&nbsp;</td>
        <td width="37%">Nama Alkes</td>
        <td width="2%">:</td>
        <td width="56%">&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>Merk</td>
        <td>:</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>Tipe / No. Seri</td>
        <td>:</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>Nomor Ijin Edar (NIE)</td>
        <td>:</td>
        <td>&nbsp;</td>
      </tr>
    </table>
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Tempat instalasi adalah sebagai berikut :</td>
  </tr>
  <tr>
    <td><table width="100%">
      <tr>
        <td width="5%">&nbsp;</td>
        <td width="45%">Nama RS/Dinas/Puskesmas/Klinik</td>
        <td width="2%">:</td>
        <td width="48%">&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>Alamat</td>
        <td>:</td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Surat perintah ini diberikan kepada Saudara yang bersangkutan untuk dapat dilaksanakan sebagaimana mestinya.</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">Bandung,  #TANGGAL</td>
  </tr>
  <tr>
    <td align="right"><p>PT.  Kharisma </p></td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
  </tr>
  <tr>
    <td align="right"><p>Sekretaris  / Admin</p></td>
  </tr>
</table>';

$nama_file = "SPK Instalasi-$nama_teknisi-$tgl_spk.doc";

header("Content-Type: application/vnd.ms-word");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Content-disposition: attachment; filename=".$nama_file);

echo $content;