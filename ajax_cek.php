<?php
include "config/koneksi.php";
$pegawai = mysqli_fetch_array(mysqli_query($koneksi, "select * from principle where id='$_GET[id_akse]'"));
$data_pegawai = array('alamat_princ'   	=>  $pegawai['alamat_princ'],);
 echo json_encode($data_pegawai);
 ?>