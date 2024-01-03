<?php
// Skrip berikut ini adalah skrip yang bertugas untuk meng-export data tadi ke excell
$tgl1=$_POST['tgl1'];
$tgl2=$_POST['tgl2'];
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Laporan Kerusakan/$tgl1 to $tgl2.xls");

include "pages/isi_laporan_kerusakan.php";
?>