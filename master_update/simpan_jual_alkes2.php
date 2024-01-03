<?php
require('../config/koneksi.php');
// if (isset($_POST['ubah_harga'])) {
    $up = mysqli_query($koneksi, "update barang_gudang set harga_satuan='" . str_replace(".", "", $_POST['nominal']) . "' where id=" . $_POST['barang_id'] . "");
    
//   }