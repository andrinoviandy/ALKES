<?php
// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");

$tgl_now=date('d-m-Y');
// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=Replacement Part - $tgl_now.xls");
 
// Tambahkan table
include 'print_replacement_part.php';
?>