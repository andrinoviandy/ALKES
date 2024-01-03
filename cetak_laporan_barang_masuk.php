<?php
// Skrip berikut ini adalah skrip yang bertugas untuk meng-export data tadi ke excell

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Laporan Barang Masuk.xls");

include "pages/isi_laporan_barang_masuk.php";
?>