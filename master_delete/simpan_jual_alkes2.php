<?php
require('../config/koneksi.php');
if (isset($_GET['id_hapus'])) {
    $del = mysqli_query($koneksi, "delete from barang_dijual_qty_hash where id=" . $_GET['id_hapus'] . "");
    $tot = mysqli_fetch_array(mysqli_query($koneksi, "select sum(okr) as tot_okr from barang_dijual_qty_hash where akun_id=" . $_SESSION['id'] . ""));
    $_SESSION['ongkir'] = $tot['tot_okr'];
  }