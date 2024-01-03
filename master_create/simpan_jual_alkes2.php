<?php
require('../config/koneksi.php'); {
  session_start();
  if ($_POST['pilih_jenis'] == 1) {
    $cek_harga = mysqli_fetch_array(mysqli_query($koneksi, "select * from barang_gudang where id=" . $_POST['id_akse'] . ""));
    if ($cek_harga['harga_satuan'] != 0) {
      $simpan = mysqli_query($koneksi, "insert into barang_dijual_qty_hash values('','" . $_SESSION['id'] . "','" . $_POST['id_akse'] . "','','" . $cek_harga['harga_satuan'] . "','" . $_POST['qty'] . "','" . str_replace(".", "", $_POST['ongkirr']) . "')");
      if ($simpan) {
        $tot = mysqli_fetch_array(mysqli_query($koneksi, "select sum(okr) as tot_okr from barang_dijual_qty_hash where akun_id=" . $_SESSION['id'] . ""));
        $_SESSION['ongkir'] = $tot['tot_okr'];
        // echo "<script>window.location='index.php?page=simpan_jual_alkes2'</script>";
      }
      /*} else {
		echo "<script>alert('Maaf , Stok Tidak Mencukupi !');
		</script>";
		}*/
    } else {
      echo "<script>alert('Harga jual alat tidak boleh 0 , update harga jual nya terlebih dahulu !');
		</script>";;
    }
  } else if ($_POST['pilih_jenis'] == 2) {
    $cek_harga = mysqli_fetch_array(mysqli_query($koneksi, "select * from barang_gudang where id=" . $_POST['id_akse'] . ""));
    if ($cek_harga['harga_satuan'] != 0) {
      //$stok = mysqli_fetch_array(mysqli_query($koneksi, "select stok_total from barang_gudang where id=".$_POST['id_akse'].""));
      //$stok_po1 = mysqli_fetch_array(mysqli_query($koneksi, "select sum(qty_jual) as stok_po from barang_dijual_qty where barang_gudang_id=".$_POST['id_akse'].""));
      //$stok_po2 = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_dikirim_detail,barang_gudang_detail,barang_dijual_qty where barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dijual_qty.id=barang_dikirim_detail.barang_dijual_qty_id and barang_dijual_qty.barang_gudang_id=".$_POST['id_akse'].""));
      //$go=$stok['stok_total']-($stok_po1['stok_po']-$stok_po2);
      //if ($go>=$_POST['qty']) {
      $sel_hrg_jual = mysqli_fetch_array(mysqli_query($koneksi, "select harga_satuan from barang_gudang where id=" . $_POST['id_akse'] . ""));
      $simpan = mysqli_query($koneksi, "insert into barang_dijual_qty_hash values('','" . $_SESSION['id'] . "','" . $_POST['id_akse'] . "','','" . $sel_hrg_jual['harga_satuan'] . "','" . $_POST['qty'] . "','" . str_replace(".", "", $_POST['ongkirr']) . "')");
      if ($simpan) {
        $tot = mysqli_fetch_array(mysqli_query($koneksi, "select sum(okr) as tot_okr from barang_dijual_qty_hash where akun_id=" . $_SESSION['id'] . ""));
        $_SESSION['ongkir'] = $tot['tot_okr'];
        // echo "<script>window.location='index.php?page=simpan_jual_alkes2'</script>";
      }
      /*} else {
		echo "<script>alert('Maaf , Stok Tidak Mencukupi !');
		</script>";
		}*/
    } else {
      echo "<script>alert('Harga jual alat tidak boleh 0 , update harga jual nya terlebih dahulu !');
		</script>";;
    }
  }
}
