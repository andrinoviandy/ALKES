<?php
 
header("Content-type:application/json");
 
//koneksi ke database
require("../config/koneksi.php");
 
//menampilkan data dari database, table tb_anggota
if (isset($_GET['id_keuangan'])) {
$sql = "select *,slip_gaji.id as idd from slip_gaji inner join karyawan on karyawan.id=slip_gaji.karyawan_id and slip_gaji.keuangan_id=".$_GET['id_keuangan']." order by tgl_slip DESC, slip_gaji.id DESC";
$result = mysqli_query($koneksi, $sql) or die("Error " . mysqli_error($koneksi));
} else {
$sql = "select *,slip_gaji.id as idd from slip_gaji inner join karyawan on karyawan.id=slip_gaji.karyawan_id order by tgl_slip DESC, slip_gaji.id DESC";
$result = mysqli_query($koneksi, $sql) or die("Error " . mysqli_error($koneksi));
}
 
//membuat array
while ($row = mysqli_fetch_assoc($result)) {
    $ArrAnggota[] = $row;
}
 
echo json_encode($ArrAnggota, JSON_PRETTY_PRINT);
 
//tutup koneksi ke database
mysqli_close($koneksi);
?>