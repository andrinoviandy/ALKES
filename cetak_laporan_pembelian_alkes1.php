<?php
// Skrip berikut ini adalah skrip yang bertugas untuk meng-export data tadi ke excell
$tgl1=$_POST['tgl1'];
$tgl2=$_POST['tgl2'];
$t1=date("d F Y",strtotime($tgl1));
$t2=date("d F Y",strtotime($tgl2));
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Laporan Pembelian Alkes Dalam Negeri/$t1 to $t2.xls");

include "pages/isi_laporan_pembelian_alkes1.php";
?>