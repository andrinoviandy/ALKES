<?php require("config/koneksi.php"); ?>
<?php

$simpan = mysqli_query($koneksi, "select * from barang_dijual");
while ($up = mysqli_fetch_array($simpan)) {
	$stok = mysqli_fetch_array(mysqli_query($koneksi, "select sum(harga_jual_saat_itu*qty_jual) as total from barang_dijual_qty where barang_dijual_id=".$up['id'].""));
	$update= mysqli_query($koneksi, "update barang_dijual set total_harga=$stok[total],neto=((total_harga+ongkir)/1.1)-((ppn_jual/100*((total_harga+ongkir)/1.1))+(pph/100*((total_harga+ongkir)/1.1))+(zakat/100*((total_harga+ongkir)/1.1))+biaya_bank) where id=".$up['id']."");
}
?>