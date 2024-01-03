<?php
$data = mysqli_fetch_array(mysqli_query($koneksi, "select * from barang_dijual where id=" . $_GET['id'] . ""));

/*
if (isset($_POST['ubah_qty'])) {
	$Result = mysqli_query($koneksi, "update barang_dijual_qty set qty_jual=".$_POST['qty']." where id=".$_POST['id_ubahitem']."");
	if ($Result) {
		$jml = mysqli_fetch_array(mysqli_query($koneksi, "select sum(qty_jual*harga_jual_saat_itu) as total from barang_dijual_qty where barang_dijual_id=".$_GET['id'].""));
		  mysqli_query($koneksi, "update barang_dijual set total_harga=$jml[total]+($jml[total]*ppn_jual/100)-($jml[total]*diskon_jual/100) where id=".$_GET['id']."");
		echo "<script type='text/javascript'>
		alert('Data Berhasil Di Ubah !');
		window.location='index.php?page=ubah_jual_barang_uang&id=$_GET[id]';
		</script>";
		}
	}
*/
if (isset($_POST['ubah_harga'])) {
  $up = mysqli_query($koneksi, "update barang_gudang set harga_satuan='" . str_replace(".", "", $_POST['nominal']) . "' where id=" . $_POST['barang_id'] . "");
  if ($up) {
    echo "<script>
		window.location='index.php?page=ubah_jual_barang_uang&id=$_GET[id]';
		alert('Harga Berhasil Di Ubah');
		</script>";
  }
}

if (isset($_POST['ubah_qty'])) {
  $upt = mysqli_query($koneksi, "update barang_dijual_qty set qty_jual=" . $_POST['qty'] . " where id=" . $_POST['id_ubahitem'] . "");
  if ($upt) {
    $jml = mysqli_fetch_array(mysqli_query($koneksi, "select sum(qty_jual*harga_jual_saat_itu) as total from barang_dijual_qty where barang_dijual_id=" . $_POST['id_barang_jual'] . ""));
    $data = mysqli_fetch_array(mysqli_query($koneksi, "select * from barang_dijual where id=" . $_POST['id_barang_jual'] . ""));
    $dpp = ($jml['total'] + $data['ongkir']) / 1.1;
    mysqli_query($koneksi, "update barang_dijual set total_harga=" . $jml['total'] . ", neto='" . ($dpp - ($jml['total'] * $data['diskon_jual'] / 100) - (($dpp * $data['ppn_jual'] / 100) + ($dpp * $data['pph'] / 100) + $data['zakat'] + $data['biaya_bank'])) . "' where id=" . $_POST['id_barang_jual'] . "");

    //neto='".($dpp-(($dpp*$ppn/100)+($dpp*$pph/100)+($dpp*$zakat/100)+$biaya_bank))."'
    if ($data['status_deal'] == 1) {
      mysqli_query($koneksi, "update utang_piutang set nominal=" . ($dpp - ($jml['total'] * $data['diskon_jual'] / 100) - ($dpp * $data['ppn_jual'] / 100) - ($dpp * $data['pph'] / 100) - $data['zakat'] - $data['biaya_bank']) . " where no_faktur_no_po='" . $data['no_po_jual'] . "'");
    }
    echo "<script type='text/javascript'>
		alert('Data Berhasil Di Ubah !');
		window.location='index.php?page=ubah_jual_barang_uang&id=$_GET[id]';
		</script>";
  }
}

if (isset($_POST['tambah_laporan'])) {
  $Result = mysqli_query($koneksi, "insert into aksesoris values('','" . $_POST['nama_akse'] . "','" . $_POST['merk'] . "','" . $_POST['tipe'] . "','" . $_POST['no_seri'] . "','" . $_POST['stok'] . "', '" . $_POST['deskripsi'] . "','" . $_POST['harga_satuan'] . "')");
  if ($Result) {
    echo "<script type='text/javascript'>
		alert('Data Berhasil Di Tambah !');
		window.location='index.php?page=simpan_tambah_aksesoris&id=$_GET[id]';
		</script>";
  }
}

if (isset($_POST['tambah_header'])) {
  $cek = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_dijual_qty_hash where akun_id=" . $_SESSION['id'] . ""));
  if ($cek != 0) {
    //$insert_pembeli=mysqli_query($koneksi, "insert into pembeli values('','".$_SESSION['pembeli']."','".$_SESSION['provinsi']."','".$_SESSION['kabupaten']."','".$_SESSION['kecamatan']."','".$_SESSION['kelurahan']."','".$_SESSION['alamat']."','".$_SESSION['kontak_rs']."')");

    $insert_pemakai = mysqli_query($koneksi, "insert into pemakai values('','" . $_SESSION['pemakai'] . "','" . $_SESSION['kontak1'] . "','" . $_SESSION['kontak2'] . "','" . $_SESSION['email'] . "')");

    //$pembeli=mysqli_fetch_array(mysqli_query($koneksi, "select max(id) as id_pembeli from pembeli"));
    $id_pembeli = $_SESSION['pembeli'];
    $pemakai = mysqli_fetch_array(mysqli_query($koneksi, "select max(id) as id_pemakai from pemakai"));
    $id_pemakai = $pemakai['id_pemakai'];
    //simpan barang dijual
    $total = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_dijual_qty_hash where akun_id=" . $_SESSION['id'] . ""));

    $simpan1 = mysqli_query($koneksi, "insert into barang_dijual values('','" . $_SESSION['tgl_jual'] . "','" . $_SESSION['no_faktur'] . "','$id_pembeli','$id_pemakai','" . $_SESSION['marketing'] . "','" . $_SESSION['subdis'] . "','" . $_SESSION['diskon'] . "','" . $_SESSION['ppn'] . "','" . $_POST['nominal'] . "')");

    $d1 = mysqli_fetch_array(mysqli_query($koneksi, "select max(id) as id_jual from barang_dijual"));
    $id_jual = $d1['id_jual'];
    //simpan barang pesan detail
    $q2 = mysqli_query($koneksi, "select * from barang_dijual_qty_hash where akun_id=" . $_SESSION['id'] . "");
    while ($d2 = mysqli_fetch_array($q2)) {
      $simpan2 = mysqli_query($koneksi, "insert into barang_dijual_qty values('','$id_jual','" . $d2['barang_gudang_id'] . "','" . $d2['harga_jual_saat_itu'] . "','" . $d2['qty'] . "','0')");
      //$up=mysqli_query($koneksi, "update barang_gudang_detail set status_terjual=1 where id=".$d2['barang_gudang_detail_id']."");
      //$up2=mysqli_query($koneksi, "update barang_gudang,barang_gudang_detail set stok_total=stok_total-1 where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=".$d2['barang_gudang_detail_id']."");
    }
    if ($simpan1 and $simpan2) {
      $Result = mysqli_query($koneksi, "insert into utang_piutang values('','Piutang','" . $_SESSION['no_faktur'] . "','" . $_POST['tgl_input'] . "','" . $_POST['jatuh_tempo'] . "','" . $_POST['nominal'] . "','" . $_POST['klien'] . "','" . $_POST['deskripsi'] . "','0')");
      mysqli_query($koneksi, "delete from barang_dijual_qty_hash where akun_id=" . $_SESSION['id'] . "");
      echo "<script type='text/javascript'>
	alert('Data Berhasil Di Simpan !');
	window.location='index.php?page=jual_barang_uang'</script>";
    }
  } else {
    echo "<script type='text/javascript'>
	alert('Data tidak boleh kosong , silakan tambah terlebih dahulu ! !');
	window.location='index.php?page=simpan_jual_alkes2'</script>";
  }
}

if (isset($_POST['tambah_riwayat'])) {

  $sel = mysqli_query($koneksi, "select * from barang_dijual where id=" . $_POST['riwayat'] . "");
  $dt_sel = mysqli_fetch_array($sel);
  $simpan1 = mysqli_query($koneksi, "insert into barang_dijual values('','" . $dt_sel['tgl_jual'] . "','" . $dt_sel['no_po_jual'] . "','" . $dt_sel['no_kontrak'] . "','" . $dt_sel['pembeli_id'] . "','" . $dt_sel['pemakai_id'] . "','" . $dt_sel['marketing'] . "','" . $dt_sel['subdis'] . "','" . $dt_sel['ongkir'] . "','" . $dt_sel['diskon_jual'] . "','" . $dt_sel['total_harga'] . "','" . $dt_sel['ppn_jual'] . "','" . $dt_sel['pph'] . "','" . $dt_sel['zakat'] . "','" . $dt_sel['biaya_bank'] . "','" . $dt_sel['neto'] . "','0','0')");

  $id_max = mysqli_fetch_array(mysqli_query($koneksi, "select max(id) as idd from barang_dijual"));
  $sel2 = mysqli_query($koneksi, "select * from barang_dijual_qty where barang_dijual_id=" . $_POST['riwayat'] . "");
  while ($dt = mysqli_fetch_array($sel2)) {
    $simpan2 = mysqli_query($koneksi, "insert into barang_dijual_qty values('','" . $id_max['idd'] . "','" . $dt['barang_gudang_id'] . "','" . $dt['harga_jual_saat_itu'] . "','" . $dt['qty_jual'] . "','" . $dt['okr'] . "','0')");
  }
  if ($simpan1 and $simpan2) {

    echo "<script>
		alert('Riwayat berhasil di tambahkan !');
		window.location='index.php?page=ubah_jual_barang_uang&id=$_GET[id]'</script>";
  }
}

if (isset($_POST['simpan_tambah_aksesoris'])) {
  $cek_harga = mysqli_fetch_array(mysqli_query($koneksi, "select * from barang_gudang where id=" . $_POST['id_akse'] . ""));
  if ($cek_harga['harga_satuan'] != 0) {
    //$stok = mysqli_fetch_array(mysqli_query($koneksi, "select stok_total from barang_gudang where id=".$_POST['id_akse'].""));
    //$stok_po1 = mysqli_fetch_array(mysqli_query($koneksi, "select sum(qty_jual) as stok_po from barang_dijual_qty where barang_gudang_id=".$_POST['id_akse'].""));
    //$stok_po2 = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_dikirim_detail,barang_gudang_detail,barang_dijual_qty where barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dijual_qty.id=barang_dikirim_detail.barang_dijual_qty_id and barang_dijual_qty.barang_gudang_id=".$_POST['id_akse'].""));
    //$go=$stok['stok_total']-($stok_po1['stok_po']-$stok_po2);
    //if ($go>=$_POST['qty']) {
    $sel_hrg_jual = mysqli_fetch_array(mysqli_query($koneksi, "select harga_satuan from barang_gudang where id=" . $_POST['id_akse'] . ""));
    $simpan = mysqli_query($koneksi, "insert into barang_dijual_qty values('','" . $_POST['idd'] . "','" . $_POST['id_akse'] . "','" . $sel_hrg_jual['harga_satuan'] . "','" . $_POST['qty'] . "','" . str_replace(".", "", $_POST['ongkirr']) . "','')");
    if ($simpan) {
      $jml = mysqli_fetch_array(mysqli_query($koneksi, "select sum(qty_jual*harga_jual_saat_itu) as total from barang_dijual_qty where barang_dijual_id=" . $_POST['idd'] . ""));

      mysqli_query($koneksi, "update barang_dijual set ongkir=ongkir+" . str_replace(".", "", $_POST['ongkirr']) . "");
      $data = mysqli_fetch_array(mysqli_query($koneksi, "select * from barang_dijual where id=" . $_POST['idd'] . ""));
      $dpp = ($jml['total'] + $data['ongkir']) / 1.1;
      mysqli_query($koneksi, "update barang_dijual set total_harga=$jml[total], neto='" . ($dpp - ($jml['total'] * $data['diskon_jual'] / 100) - (($dpp * $data['ppn_jual'] / 100) + ($dpp * $data['pph'] / 100) + $data['zakat'] + $data['biaya_bank'])) . "' where id=" . $_POST['idd'] . "");

      //$update_piutang = mysqli_query($koneksi, "update utang_piutang set nominal=$jml[total] where no_faktur_no_po='".$data['no_po_jual']."'");

      if ($data['status_deal'] == 1) {
        $update_piutang = mysqli_query($koneksi, "update utang_piutang set nominal=" . ($dpp - ($jml['total'] * $data['diskon_jual'] / 100) - ($dpp * $data['ppn_jual'] / 100) - ($dpp * $data['pph'] / 100) - $data['zakat'] - $data['biaya_bank']) . " where no_faktur_no_po='" . $data['no_po_jual'] . "'");
      }
      echo "<script>window.location='index.php?page=ubah_jual_barang_uang&id=$_GET[id]'</script>";
    }
  } else {
    echo "<script>alert('Harga jual alat tidak boleh 0 , update harga jual nya terlebih dahulu !');
		</script>";;
  }
}

if (isset($_GET['id_hapus'])) {
  $sel1 = mysqli_fetch_array(mysqli_query($koneksi, "select okr from barang_dijual_qty where id=" . $_GET['id_hapus'] . ""));
  $okr = $data['ongkir'] - $sel1['okr'];
  mysqli_query($koneksi, "update barang_dijual set ongkir=$okr where id=" . $_GET['id_barang_jual'] . "");
  $del = mysqli_query($koneksi, "delete from barang_dijual_qty where id=" . $_GET['id_hapus'] . "");
  $jml = mysqli_fetch_array(mysqli_query($koneksi, "select sum(qty_jual*harga_jual_saat_itu) as total from barang_dijual_qty where barang_dijual_id=" . $_GET['id_barang_jual'] . ""));
  $data = mysqli_fetch_array(mysqli_query($koneksi, "select * from barang_dijual where id=" . $_GET['id_barang_jual'] . ""));
  if ($del) {
    $dpp = ($jml['total'] + $data['ongkir']) / 1.1;
    mysqli_query($koneksi, "update barang_dijual set total_harga=$jml[total], neto='" . ($dpp - ($jml['total'] * $data['diskon_jual'] / 100) - ($dpp * $data['ppn_jual'] / 100) - ($dpp * $data['pph'] / 100) - $data['zakat'] - $data['biaya_bank']) . "' where id=" . $_GET['id_barang_jual'] . "");

    if ($data['status_deal'] == 1) {
      mysqli_query($koneksi, "update utang_piutang set nominal=" . ($dpp - ($jml['total'] * $data['diskon_jual'] / 100) - ($dpp * $data['ppn_jual'] / 100) - ($dpp * $data['pph'] / 100) - $data['zakat'] - $data['biaya_bank']) . " where no_faktur_no_po='" . $data['no_po_jual'] . "'");
    }
    echo "<script>
		  alert('Item berhasil dihapus !');
		  window.location='index.php?page=ubah_jual_barang_uang&id=$_GET[id]'</script>";
  }
}

if (isset($_GET['hapus_riwayat'])) {
  $del = mysqli_query($koneksi, "delete from barang_dijual_qty where barang_dijual_id=" . $_GET['hapus_riwayat'] . "");
  $del2 = mysqli_query($koneksi, "delete from barang_dijual where id=" . $_GET['hapus_riwayat'] . "");
  if ($del and $del2) {
    echo "<script>
		alert('Riwayat berhasil di hapus !');
		window.location='index.php?page=ubah_jual_barang_uang&id=$_GET[id]'</script>";
  }
}

if (isset($_POST['simpan_pemakai'])) {
  $up = mysqli_query($koneksi, "update pemakai set nama_pemakai='" . $_POST['nama_pemakai'] . "', kontak1_pemakai='" . $_POST['kontak1'] . "', kontak2_pemakai='" . $_POST['kontak2'] . "', email_pemakai='" . $_POST['email_pemakai'] . "' where id=" . $data['pemakai_id'] . "");
  $up2 = mysqli_query($koneksi, "update barang_dijual set tgl_jual='" . $_POST['tgl_jual'] . "', no_po_jual='" . $_POST['no_po'] . "', no_kontrak='" . $_POST['no_kontrak'] . "', pembeli_id='" . $_POST['pembeli'] . "',marketing='" . $_POST['marketing'] . "',subdis='" . $_POST['subdis'] . "' where id=" . $_GET['id'] . "");
  if ($_POST['status_deal'] == 0) {
    $up3 = mysqli_query($koneksi, "update barang_dijual set status_deal=0 where no_po_jual='" . $data['no_po_jual'] . "'");
    mysqli_query($koneksi, "update utang_piutang set nominal=0 where no_faktur_no_po='" . $data['no_po_jual'] . "'");
  } else {
    $up3 = mysqli_query($koneksi, "update barang_dijual set status_deal=1 where id='" . $_POST['status_deal'] . "'");
    $data = mysqli_fetch_array(mysqli_query($koneksi, "select * from barang_dijual where id=" . $_POST['status_deal'] . ""));
    $jml = mysqli_fetch_array(mysqli_query($koneksi, "select sum(qty_jual*harga_jual_saat_itu) as total from barang_dijual_qty where barang_dijual_id=" . $_POST['status_deal'] . ""));
    $dpp = ($jml['total'] + $data['ongkir']) / 1.1;
    mysqli_query($koneksi, "update utang_piutang set nominal=" . ($dpp - (($dpp * $data['ppn_jual'] / 100) + ($dpp * $data['pph'] / 100) + ($dpp * $data['zakat'] / 100) + $data['biaya_bank'])) . " where no_faktur_no_po='" . $data['no_po_jual'] . "'");
  }
  if ($up and $up2) {
    echo "<script>window.location='index.php?page=ubah_jual_barang_uang&id=$_GET[id]'</script>";
  }
}

if (isset($_POST['input_ongkir'])) {
  if ($_POST['ongkir'] != '') {
    $ongkir = str_replace(".", "", $_POST['ongkir']);
  } else {
    $ongkir = 0;
  }
  if ($_POST['diskon'] != '') {
    $diskon = $_POST['diskon'];
  } else {
    $diskon = 0;
  }
  if ($_POST['ppn'] != '') {
    $ppn = $_POST['ppn'];
  } else {
    $ppn = 0;
  }
  if ($_POST['pph'] != '') {
    $pph = $_POST['pph'];
  } else {
    $pph = 0;
  }
  if ($_POST['zakat'] != '') {
    $zakat = $_POST['zakat'];
  } else {
    $zakat = 0;
  }
  if ($_POST['biaya_bank'] != '') {
    $biaya_bank = str_replace(".", "", $_POST['biaya_bank']);
  } else {
    $biaya_bank = 0;
  }

  $jml = mysqli_fetch_array(mysqli_query($koneksi, "select sum(qty_jual*harga_jual_saat_itu) as total from barang_dijual_qty where barang_dijual_id=" . $_POST['idd'] . ""));
  $dpp = ($jml['total'] + $ongkir) / 1.1;
  $sm = mysqli_query($koneksi, "update barang_dijual set ongkir=$ongkir, diskon_jual=$diskon, total_harga=$jml[total], ppn_jual=$ppn, pph=$pph, zakat=$zakat, biaya_bank=$biaya_bank, neto='" . ($dpp - (($dpp * $ppn / 100) + ($dpp * $pph / 100) + ($dpp * $zakat / 100) + $biaya_bank)) . "' where id=" . $_POST['idd'] . "");
  if ($sm) {
    $data = mysqli_fetch_array(mysqli_query($koneksi, "select * from barang_dijual where id=" . $_POST['idd'] . ""));
    if ($data['status_deal'] == 1) {
      mysqli_query($koneksi, "update utang_piutang set nominal=" . ($dpp - (($dpp * $data['ppn_jual'] / 100) + ($dpp * $data['pph'] / 100) + ($dpp * $data['zakat'] / 100) + $data['biaya_bank'])) . " where no_faktur_no_po='" . $data['no_po_jual'] . "'");
    }
    echo "<script>
	alert('Perubahan Data Berhasil !');
	window.location='index.php?page=ubah_jual_barang_uang&id=$_GET[id]'</script>";
  }
}
?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Ubah Penjualan Alkes</h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active"> Ubah Penjualan Alkes</li>
    </ol>
  </section>


  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->
    <!-- /.row -->
    <!-- Main row -->
    <div class="row">
      <!-- Left col -->
      <section class="col-lg-12 connectedSortable">
        <!-- Custom tabs (Charts with tabs)-->
        <!-- /.nav-tabs-custom -->

        <!-- Chat box -->
        <div class="box box-success">
          <!-- /.chat -->
          <div class="box-footer">
            <div class="box-body">
              <div class="">
                <!--<a href="index.php?page=tambah_barang_masuk"><button name="tambah_laporan" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Tambah Barang</button></a>-->
                <button name="waw" class="btn btn-success pull pull-right" type="button" data-toggle="modal" data-target="#modal-ubah"><span class="fa fa-edit"></span> Ubah Data Umum</button>
                <br /><br />
                <div class="table-responsive">
                  <table width="100%" id="" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th colspan="7" align="left">
                          <table width="">
                            <tr valign="top">
                              <td><strong>Marketing </strong></td>
                              <td><strong>&nbsp;:&nbsp;</strong></td>
                              <td><strong><?php echo $data['marketing']; ?></strong></td>
                              <td><strong> &nbsp;&nbsp;,&nbsp;&nbsp; </strong></td>
                              <td><strong>Sub Distributor </strong></td>
                              <td><strong> &nbsp;:&nbsp; </strong></td>
                              <td><strong><?php echo $data['subdis']; ?></strong></td>
                              <td><strong>
                                  <!--&nbsp;&nbsp;&nbsp;&nbsp; , Diskon : <?php echo $_SESSION['diskon'] . " %"; ?>&nbsp;&nbsp;&nbsp;&nbsp; , PPN : <?php echo $_SESSION['ppn'] . " %"; ?>-->
                                </strong></td>
                            </tr>
                          </table>
                        </th>
                      </tr>
                      <tr>
                        <th colspan="4" valign="bottom">&nbsp;</th>
                        <th valign="bottom">&nbsp;</th>
                        <th valign="bottom">&nbsp;</th>
                        <th valign="bottom">&nbsp;</th>

                      </tr>
                      <tr>
                        <th valign="bottom"><strong>Tgl Jual</strong></th>
                        <th valign="bottom">No PO</th>
                        <th valign="bottom">No Kontrak</th>
                        <th valign="bottom">Nama RS/Dinas/Klinik/dll</th>
                        <th valign="bottom"><strong>Kelurahan</strong></th>
                        <th valign="bottom">Alamat</th>
                        <th valign="bottom"><strong>Kontak RS/Dinas/dll</strong></th>

                      </tr>
                    </thead>
                    <tr>
                      <td>
                        <?php echo $data['tgl_jual']; ?></td>
                      <td>
                        <?php echo $data['no_po_jual']; ?></td>
                      <td><?php echo $data['no_kontrak']; ?></td>
                      <td><?php
                          $sel = mysqli_fetch_array(mysqli_query($koneksi, "select * from pembeli where id=" . $data['pembeli_id'] . ""));
                          echo $sel['nama_pembeli']; ?></td>
                      <td><?php echo $sel['kelurahan_id']; ?></td>
                      <td><?php echo $sel['jalan']; ?></td>
                      <td><?php echo $sel['kontak_rs']; ?></td>

                    </tr>
                  </table>
                </div>
                <br />
                <div class="table-responsive">
                  <table width="100%" class="table table-bordered table-hover">
                    <tr>
                      <td><strong>Nama Pemakai</strong></td>
                      <td><strong>Kontak 1</strong></td>
                      <td><strong>Kontak 2</strong></td>
                      <td><strong>Email</strong></td>
                      <td><strong>Status PO</strong></td>
                    </tr>
                    <tr>
                      <td><?php
                          $sel_pemakai = mysqli_fetch_array(mysqli_query($koneksi, "select * from pemakai where id=" . $data['pemakai_id'] . "")); ?>
                        <?php echo $sel_pemakai['nama_pemakai']; ?></td>
                      <td>
                        <?php echo $sel_pemakai['kontak1_pemakai']; ?></td>
                      <td><?php echo $sel_pemakai['kontak2_pemakai']; ?></td>
                      <td>
                        <?php echo $sel_pemakai['email_pemakai']; ?></td>
                      <td><?php
                          $jm_deal3 = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_dijual where no_po_jual='" . $data['no_po_jual'] . "' and status_deal=1"));
                          if ($jm_deal3 != 0) {
                            echo "Deal";
                          } else {
                            echo "Belum Deal";
                          } ?></td>
                    </tr>

                  </table>
                </div>

                <br />

                <div class="">
                  <!-- Custom Tabs -->
                  <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                      <?php
                      $que = mysqli_query($koneksi, "select * from barang_dijual where no_po_jual='" . $data['no_po_jual'] . "' order by id ASC");
                      $jm_riwayat = mysqli_num_rows($que);
                      $jm_deal1 = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_dijual where no_po_jual='" . $data['no_po_jual'] . "' and status_deal=1 order by id ASC"));
                      $no2 = 0;
                      while ($dt = mysqli_fetch_array($que)) {
                        $no2++;
                      ?>
                        <li <?php if ($jm_deal1 != 0) {
                              if ($dt['status_deal'] == 1) {
                                echo "class='active'";
                              }
                            } else {
                              if ($no2 == $jm_riwayat) {
                                echo "class='active'";
                              } else {
                                echo "";
                              }
                            }; ?>><a href="#tab_<?php echo $no2; ?>" data-toggle="tab">Riwayat <?php echo $no2; ?> <?php if ($dt['status_deal'] == 1) {
                                                                                                                                                                                                                                                                      echo "<i class='fa fa-check'></i>";
                                                                                                                                                                                                                                                                    } ?></a></li>
                      <?php } ?>
                      <?php
                      $jm_deal = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_dijual where no_po_jual='" . $data['no_po_jual'] . "' and status_deal=1 order by id ASC"));
                      if ($jm_deal == 0) {
                      ?>
                        <button class="btn btn-warning" data-toggle="modal" data-target="#modal-riwayat"><i class="fa fa-calendar"></i> &nbsp;Tambah Riwayat</button>
                      <?php } else { ?>
                        <button class="btn btn-warning" data-toggle="modal" data-target="#modal-teks-riwayat"><i class="fa fa-calendar"></i> &nbsp;Tambah Riwayat</button>
                      <?php } ?>
                      <li class="pull-right"><button class="btn btn-info pull pull-right" data-toggle="modal" data-target="#modal-ubah-harga"><i class="fa fa-edit"></i> Perubahan Harga Jual</button></li>
                    </ul>
                    <div class="tab-content">
                      <?php
                      $que2 = mysqli_query($koneksi, "select * from barang_dijual where no_po_jual='" . $data['no_po_jual'] . "' order by id ASC");
                      $jm_riwayat2 = mysqli_num_rows($que2);
                      $jm_deal2 = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_dijual where no_po_jual='" . $data['no_po_jual'] . "' and status_deal=1 order by id ASC"));
                      $no3 = 0;
                      while ($dt = mysqli_fetch_array($que2)) {
                        $no3++; ?>
                        <div class="well tab-pane <?php if ($jm_deal2 != 0) {
                                                    if ($dt['status_deal'] == 1) {
                                                      echo "active";
                                                    }
                                                  } else {
                                                    if ($no3 == $jm_riwayat2) {
                                                      echo "active";
                                                    } else {
                                                      echo "";
                                                    }
                                                  }; ?>" id="tab_<?php echo $no3; ?>">
                          <button name="tambah" class="btn btn-success" type="submit" data-toggle="modal" data-target="#modal-tambah<?php echo $dt['id'] ?>"><span class="fa fa-plus"></span> Tambah Barang</button>
                          <?php
                          $jm_riwayat = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_dijual where no_po_jual='" . $data['no_po_jual'] . "'"));
                          if ($jm_riwayat > 1 and $_SESSION['user_administrator'] or $jm_riwayat > 1 and $_SESSION['user_admin_keuangan'] or $jm_riwayat > 1 and $_SESSION['user_manajer_keuangan']) {
                          ?>
                            <a href="?page=ubah_jual_barang_uang&id=<?php echo $_GET['id'] ?>&hapus_riwayat=<?php echo $dt['id']; ?>" class="pull-right" onclick="return confirm('Anda yakin akan menghapus Riwayat <?php echo $no3; ?>')"><button class="btn btn-danger"><span data-toggle="tooltip" title="Ubah Qty" class="fa fa-close"></span> Hapus Riwayat <?php echo $no3; ?></button></a>
                          <?php } ?>

                          <div class="modal fade" id="modal-tambah<?php echo $dt['id'] ?>">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">

                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                  <h4 class="modal-title" align="center"><strong>Tambah Data</strong></h4>
                                </div>
                                <form method="post" enctype="multipart/form-data">
                                  <div class="modal-body">
                                    <input type="hidden" name="idd" value="<?php echo $dt['id'] ?>" />
                                    <label>Nama Barang</label>
                                    <select name="id_akse" id="id_akse<?php echo $dt['id'] ?>" class="form-control select2" autofocus="autofocus" required onchange="changeValue<?php echo $dt['id'] ?>(this.value)" style="width:100%">
                                      <option value="">...</option>
                                      <?php
                                      $q = mysqli_query($koneksi, "select * from barang_gudang order by nama_brg ASC");
                                      $jsArray33 = "var dtBrg33 = new Array();
";
                                      while ($d = mysqli_fetch_array($q)) { ?>
                                        <option value="<?php echo $d['id']; ?>"><?php echo $d['nama_brg'] . " - " . $d['tipe_brg']; ?></option>
                                      <?php
                                        $stok_po1 = mysqli_fetch_array(mysqli_query($koneksi, "select sum(qty_jual) as stok_po from barang_dijual_qty where barang_gudang_id=" . $d['id'] . ""));
                                        $stok_po2 = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_dikirim_detail,barang_gudang_detail,barang_dijual_qty where barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dijual_qty.id=barang_dikirim_detail.barang_dijual_qty_id and barang_dijual_qty.barang_gudang_id=" . $d['id'] . ""));

                                        $jsArray33 .= "dtBrg33['" . $d['id'] . "'] = {tipe_akse:'" . addslashes($d['tipe_brg']) . "',
						merk_akse:'" . addslashes($d['merk_brg']) . "',
						stok_total:'" . addslashes($d['stok_total'] - ($stok_po1['stok_po'] - $stok_po2)) . "',
						harga:'" . addslashes("Rp " . number_format($d['harga_satuan'], 2, ',', '.')) . "'
						};";
                                      } ?>
                                    </select>
                                    <br /><br />
                                    <label>Stok Total</label>
                                    <input id="stok_total<?php echo $dt['id'] ?>" name="stok_total" class="form-control" type="text" placeholder="Stok" disabled="disabled" size="4" />
                                    <br />
                                    <label>Harga (<font size="-2" color="#FF0000">Harga tidak boleh 0</font>)</label>
                                    <input id="harga<?php echo $dt['id'] ?>" name="harga" class="form-control" type="text" placeholder="Harga" disabled="disabled" size="8" />
                                    <br />
                                    <label>Tipe</label>
                                    <input id="tipe_akse<?php echo $dt['id'] ?>" name="tipe_akse" class="form-control" type="text" placeholder="Tipe" disabled="disabled" size="15" />
                                    <br />
                                    <label>Merk</label>
                                    <input id="merk_akse<?php echo $dt['id'] ?>" name="merk_akse" class="form-control" type="text" placeholder="Merk" disabled="disabled" size="15" />
                                    <br />
                                    <label>Qty</label>
                                    <input id="qty" name="qty" class="form-control" type="text" placeholder="" size="2" />
                                    <br />
                                    <label>Ongkir</label>
                                    <input id="ongkirr" name="ongkirr" class="form-control" type="text" placeholder="" size="2" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" />
                                    <br />
                                    <label>Total</label>
                                    <input id="" name="total" class="form-control" type="text" placeholder="" size="" value="Auto" disabled="disabled" />

                                  </div>

                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                    <button name="simpan_tambah_aksesoris" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Tambah</button>
                                  </div>
                                  <script type="text/javascript">
                                    <?php
                                    echo $jsArray33;
                                    ?>

                                    function changeValue<?php echo $dt['id'] ?>(id_akse) {
                                      document.getElementById('harga<?php echo $dt['id'] ?>').value = dtBrg33[id_akse].harga;
                                      document.getElementById('stok_total<?php echo $dt['id'] ?>').value = dtBrg33[id_akse].stok_total;
                                      document.getElementById('tipe_akse<?php echo $dt['id'] ?>').value = dtBrg33[id_akse].tipe_akse;
                                      document.getElementById('merk_akse<?php echo $dt['id'] ?>').value = dtBrg33[id_akse].merk_akse;

                                    };
                                  </script>
                                </form>
                              </div>
                              <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                          </div>
                          <br /><br />
                          <div class="table-responsive">
                            <table width="100%" id="example1" class="table table-bordered table-hover">
                              <thead>
                                <tr>
                                  <th valign="bottom">No</th>
                                  <th valign="bottom"><strong>Nama Alkes</strong></th>

                                  <th align="center" valign="bottom"><strong>Harga
                                      Jual</strong></th>
                                  <th align="center" valign="bottom"><strong>Tipe
                                    </strong></th>
                                  <th align="center" valign="bottom"><strong>Merk
                                    </strong></th>
                                  <td align="center" valign="bottom"><strong>Qty</strong></td>
                                  <td valign="bottom" align="right"><strong>Total</strong></td>
                                  <td align="right" valign="bottom"><strong>Ongkir Per Barang</strong></td>
                                  <td align="center" valign="bottom"><strong>Aksi</strong></td>
                                </tr>
                              </thead>


                              <?php

                              $no = 0;
                              $q_akse = mysqli_query($koneksi, "select *,barang_dijual_qty.id as idd from barang_dijual_qty,barang_gudang where barang_gudang.id=barang_dijual_qty.barang_gudang_id and barang_dijual_id=" . $dt['id'] . "");
                              $jm = mysqli_num_rows($q_akse);
                              if ($jm != 0) {
                                while ($data_akse = mysqli_fetch_array($q_akse)) {
                                  $no++;
                              ?>
                                  <tr>
                                    <td><?php echo $no; ?></td>
                                    <td align="left"><?php echo $data_akse['nama_brg']; ?>
                                    </td>

                                    <td align="left"><?php echo "Rp" . number_format($data_akse['harga_jual_saat_itu'], 2, ',', '.'); ?></td>
                                    <td align="left"><?php echo $data_akse['tipe_brg']; ?></td>
                                    <td align="left"><?php echo $data_akse['merk_brg']; ?></td>
                                    <td align="center"><?php echo $data_akse['qty_jual']; ?></td>
                                    <td align="right"><?php echo "Rp" . number_format($data_akse['harga_jual_saat_itu'] * $data_akse['qty_jual'], 2, ',', '.'); ?></td>
                                    <td align="right" bgcolor="#FFFF00"><?php echo "Rp" . number_format($data_akse['okr'], 2, ',', '.'); ?></td>
                                    <td align="center"><?php if ($jm >= 2) { ?><a href="index.php?page=ubah_jual_barang_uang&id=<?php echo $_GET['id']; ?>&id_hapus=<?php echo $data_akse['idd']; ?>&id_barang_jual=<?php echo $dt['id'] ?>" onclick="return confirm('Yakin Akan Menghapus Item Ini ?')"><span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span></a>&nbsp;&nbsp;<?php } ?><a href="#" data-toggle="modal" data-target="#modal-ubahitem<?php echo $data_akse['idd']; ?>"><span data-toggle="tooltip" title="Ubah Qty" class="fa fa-edit"></span></a></td>
                                  </tr>
                                  <div class="modal fade" id="modal-ubahitem<?php echo $data_akse['idd']; ?>">
                                    <div class="modal-dialog modal-sm">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                          <h4 class="modal-title" align="center">Ubah Kuantitas</h4>
                                        </div>
                                        <form method="post">
                                          <div class="modal-body">
                                            <p align="justify">
                                              <input type="hidden" name="id_barang_jual" value="<?php echo $dt['id']; ?>" />
                                              <input type="hidden" name="id_ubahitem" value="<?php echo $data_akse['idd']; ?>" />
                                              <input name="qty" class="form-control" type="number" placeholder="" value="<?php echo $data_akse['qty_jual']; ?>">
                                            </p>
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                            <button name="ubah_qty" class="btn btn-success" type="submit"><span class="fa fa-check"></span> Simpan</button>
                                          </div>
                                        </form>
                                      </div>
                                      <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                  </div>
                              <?php }
                              } else {
                                echo "<tr><td colspan='9' align='center'>Tidak Ada Data</td></tr>";
                              } ?>
                              <tr bgcolor="#009900">
                                <td colspan="9"></td>
                              </tr>
                              <tr>
                                <td colspan="6" align="right"><strong> Total</strong></td>
                                <td align="right"><?php
                                                  $total1 = mysqli_fetch_array(mysqli_query($koneksi, "select sum(qty_jual*harga_satuan) as total1 from barang_gudang,barang_dijual_qty where barang_gudang.id=barang_dijual_qty.barang_gudang_id and barang_dijual_id=" . $dt['id'] . ""));
                                                  echo number_format($total1['total1'], 2, ',', '.');
                                                  ?></td>
                                <td align="center" bgcolor="#FFFF00"></td>
                                <td align="center"></td>
                              </tr>
                              <tr>
                                <td colspan="6" align="right">Total Ongkir
                                  <button type="button" data-toggle="modal" data-target="#modal-ongkir1<?php echo $dt['id'] ?>" class="btn btn-info btn-xs"><span class="fa fa-edit"></span></button>
                                </td>
                                <td align="right" bgcolor="#FFFF00"><?php
                                                                    $data3 = mysqli_fetch_array(mysqli_query($koneksi, "select * from barang_dijual where id=" . $dt['id'] . ""));
                                                                    echo number_format($data3['ongkir'], 2, ',', '.'); ?></td>
                                <td align="center" bgcolor="#FFFF00"></td>
                                <td align="center"></td>
                              </tr>
                              <!--
    <tr>
      <td colspan="6" align="right"><strong>DPP</strong></td>
      <td align="right"><?php echo number_format($data['dpp'], 2, ',', '.'); ?></td>
      <td align="center"></td>
    </tr>
    -->
                              <tr>
                                <td colspan="6" align="right">DPP ((Total + Ongkir) /1.1)</td>
                                <td align="right">
                                  <?php

                                  $dpp = ($data3['ongkir'] + $total1['total1']) / 1.1;
                                  echo number_format($dpp, 2, ',', '.');

                                  ?>
                                </td>
                                <td align="center"></td>
                                <td align="center"></td>
                              </tr>
                              <tr>
                                <td colspan="6" align="right">Diskon (<?php echo $data3['diskon_jual'] . "%"; ?>) <button type="button" data-toggle="modal" data-target="#modal-ongkir2<?php echo $dt['id'] ?>" class="btn btn-info btn-xs"><span class="fa fa-edit"></span></button></td>
                                <td align="right"><?php
                                                  $diskon = $data3['diskon_jual'];
                                                  echo $diskon . "%";
                                                  ?></td>
                                <td align="center"></td>
                                <td align="center"></td>
                              </tr>
                              <tr>
                                <td colspan="6" align="right">PPN (<?php echo $data['ppn_jual'] . "%"; ?>)
                                  <button type="button" data-toggle="modal" data-target="#modal-ongkir3<?php echo $dt['id'] ?>" class="btn btn-info btn-xs"><span class="fa fa-edit"></span></button>
                                </td>
                                <td align="right">
                                  <?php
                                  $ppn = ($dpp) * $data3['ppn_jual'] / 100;
                                  echo number_format($ppn, 2, ',', '.');
                                  ?>
                                </td>
                                <td align="center"></td>
                                <td align="center"></td>
                              </tr>
                              <tr>
                                <td colspan="6" align="right">PPh (<?php echo $data['pph'] . "%"; ?>) <button type="button" data-toggle="modal" data-target="#modal-ongkir4<?php echo $dt['id'] ?>" class="btn btn-info btn-xs"><span class="fa fa-edit"></span></button></td>
                                <td align="right"><?php
                                                  $pph = ($dpp) * $data3['pph'] / 100;
                                                  echo number_format($pph, 2, ',', '.');
                                                  ?></td>
                                <td align="center"></td>
                                <td align="center"></td>
                              </tr>

                              <tr>
                                <td colspan="6" align="right">Zakat (<?php echo $data['zakat'] . "%"; ?>)<button type="button" data-toggle="modal" data-target="#modal-ongkir5<?php echo $dt['id'] ?>" class="btn btn-info btn-xs"><span class="fa fa-edit"></span></button></td>
                                <td align="right"><?php $zakat = $dpp * $data3['zakat'] / 100;
                                                  echo number_format($dpp * $data3['zakat'] / 100, 2, ',', '.'); ?></td>
                                <td align="center"></td>
                                <td align="center"></td>
                              </tr>
                              <tr>
                                <td colspan="6" align="right">Biaya Bank <button type="button" data-toggle="modal" data-target="#modal-ongkir6<?php echo $dt['id'] ?>" class="btn btn-info btn-xs"><span class="fa fa-edit"></span></button></td>
                                <td align="right"><?php echo number_format($data3['biaya_bank'], 2, ',', '.'); ?></td>
                                <td align="center"></td>
                                <td align="center"></td>
                              </tr>
                              <tr>
                                <td colspan="6" align="right" valign="bottom">
                                  <h4><strong>Neto (DPP(Dengan Ongkir)-(PPN dari DPP(Dengan Ongkir)+PPh dari DPP(Dengan Ongkir)+Zakat dari DPP(Dengan Ongkir)+Biaya Bank)</strong>)</h4>
                                </td>
                                <td align="right" valign="bottom">
                                  <h4><strong>
                                      <?php
                                      $total2 = $dpp - ($ppn + $pph + $zakat + $data3['biaya_bank']);
                                      echo number_format($total2, 2, ',', '.'); ?>
                                    </strong></h4>
                                </td>
                                <td align="center"></td>
                                <td align="center"></td>
                              </tr>
                              <tr>
                                <td colspan="6" align="right" valign="bottom"><strong>Fee Supplier (DPP(Tanpa Ongkir)-(PPh dari DPP(Tanpa Ongkir)+Zakat dari DPP(Dengan Ongkir)+Biaya Bank)</strong>)<strong>*Diskon</strong></td>
                                <td align="right" valign="bottom">
                                  <?php
                                  $dpp_m = ($total1['total1'] / 1.1);
                                  //$ppn_m = $dpp_m*$data['ppn_jual']/100;
                                  $pph_m = $dpp_m * $data3['pph'] / 100;
                                  $zakat_m = $dpp_m * $data3['zakat'] / 100;
                                  $biaya_bank_m = $data3['biaya_bank'];
                                  $fee_marketing = ($dpp_m - ($pph_m + $zakat_m + $biaya_bank_m)) * ($diskon / 100);
                                  echo "Rp" . number_format($fee_marketing, 2, ',', '.'); ?>
                                </td>
                                <td align="center"></td>
                                <td align="center"></td>
                              </tr>
                              <tr>
                                <td colspan="9" align="right">
                                  <center>
                                    <!--<a href="index.php?page=simpan_jual_alkes2&simpan_barang=1"><button name="simpan_barang" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Simpan</button></a><a href="index.php?page=ubah_jual_barang_uang#open_piutang"><button name="simpa" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Simpan</button></a>&nbsp;&nbsp;-->
                                  </center>
                                </td>
                              </tr>

                            </table>
                            <!-- Modal-->
                            <div class="modal fade" id="modal-ongkir1<?php echo $dt['id'] ?>">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Nilai Ongkir, Diskon, PPN, PPh, Lain-lain</h4>
                                  </div>
                                  <form method="post" enctype="multipart/form-data">
                                    <div class="modal-body">
                                      <input type="hidden" name="idd" value="<?php echo $dt['id'] ?>" />
                                      <label>Ongkir</label>
                                      <input id="" name="ongkir" class="form-control" type="text" placeholder="" value="<?php echo number_format($data['ongkir'], 0, ',', '.'); ?>" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" style="border-color:#F00">
                                      <br />
                                      <label>Diskon</label>
                                      <input id="" name="diskon" class="form-control" type="text" placeholder="Gunakan Tanda '.' Untuk Koma" value="<?php echo $data['diskon_jual']; ?>">
                                      <br />
                                      <label>PPN (%)</label>
                                      <input id="" name="ppn" class="form-control" type="text" placeholder="Gunakan Tanda '.' Untuk Koma" value="<?php echo $data['ppn_jual']; ?>" <?php echo $focus_ppn; ?>>
                                      <br />
                                      <label>PPh (%)</label>
                                      <input id="" name="pph" class="form-control" type="text" placeholder="Gunakan Tanda '.' Untuk Koma" value="<?php echo $data['pph']; ?>" <?php echo $focus_pph; ?>>
                                      <br />
                                      <label>Zakat (%)</label>
                                      <input name="zakat" class="form-control" type="text" placeholder="Gunakan Tanda '.' Untuk Koma" value="<?php echo $data['zakat'];  ?>">
                                      <br />
                                      <label>Biaya Bank</label>
                                      <input id="" name="biaya_bank" class="form-control" type="text" placeholder="" value="<?php echo number_format($data['biaya_bank'], 0, ',', '.'); ?>" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" <?php echo $focus_biaya_bank; ?>>
                                      <br />
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                      <button name="input_ongkir" class="btn btn-info" type="submit"><span class="fa fa-check"></span>Simpan</button>
                                    </div>
                                  </form>

                                </div>
                                <!-- /.modal-content -->
                              </div>
                              <!-- /.modal-dialog -->
                            </div>

                            <div class="modal fade" id="modal-ongkir2<?php echo $dt['id'] ?>">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Nilai Ongkir, Diskon, PPN, PPh, Lain-lain</h4>
                                  </div>
                                  <form method="post" enctype="multipart/form-data">
                                    <div class="modal-body">
                                      <input type="hidden" name="idd" value="<?php echo $dt['id'] ?>" />
                                      <label>Ongkir</label>
                                      <input id="" name="ongkir" class="form-control" type="text" placeholder="" value="<?php echo number_format($data['ongkir'], 0, ',', '.');  ?>" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);">
                                      <br />
                                      <label>Diskon</label>
                                      <input id="" name="diskon" class="form-control" type="text" placeholder="Gunakan Tanda '.' Untuk Koma" value="<?php echo $data['diskon_jual']; ?>" style="border-color:#F00">
                                      <br />
                                      <label>PPN (%)</label>
                                      <input id="" name="ppn" class="form-control" type="text" placeholder="Gunakan Tanda '.' Untuk Koma" value="<?php echo $data['ppn_jual'];  ?>" <?php echo $focus_ppn; ?>>
                                      <br />
                                      <label>PPh (%)</label>
                                      <input id="" name="pph" class="form-control" type="text" placeholder="Gunakan Tanda '.' Untuk Koma" value="<?php echo $data['pph'];  ?>" <?php echo $focus_pph; ?>>
                                      <br />
                                      <label>Zakat (%)</label>
                                      <input name="zakat" class="form-control" type="text" placeholder="Gunakan Tanda '.' Untuk Koma" value="<?php echo $data['zakat'];  ?>">
                                      <br />
                                      <label>Biaya Bank</label>
                                      <input id="" name="biaya_bank" class="form-control" type="text" placeholder="" value="<?php echo number_format($data['biaya_bank'], 0, ',', '.');  ?>" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" <?php echo $focus_biaya_bank; ?>>
                                      <br />
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                      <button name="input_ongkir" class="btn btn-info" type="submit"><span class="fa fa-check"></span>Simpan</button>
                                    </div>
                                  </form>

                                </div>
                                <!-- /.modal-content -->
                              </div>
                              <!-- /.modal-dialog -->
                            </div>

                            <div class="modal fade" id="modal-ongkir3<?php echo $dt['id'] ?>">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Nilai Ongkir, Diskon, PPN, PPh, Lain-lain</h4>
                                  </div>
                                  <form method="post" enctype="multipart/form-data">
                                    <div class="modal-body">
                                      <input type="hidden" name="idd" value="<?php echo $dt['id'] ?>" />
                                      <label>Ongkir</label>
                                      <input id="" name="ongkir" class="form-control" type="text" placeholder="" value="<?php echo number_format($data['ongkir'], 0, ',', '.');  ?>" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);">
                                      <br />
                                      <label>Diskon</label>
                                      <input id="" name="diskon" class="form-control" type="text" placeholder="Gunakan Tanda '.' Untuk Koma" value="<?php echo $data['diskon_jual'];  ?>">
                                      <br />
                                      <label>PPN (%)</label>
                                      <input id="" name="ppn" class="form-control" type="text" placeholder="Gunakan Tanda '.' Untuk Koma" value="<?php echo $data['ppn_jual'];  ?>" style="border-color:#F00">
                                      <br />
                                      <label>PPh (%)</label>
                                      <input id="" name="pph" class="form-control" type="text" placeholder="Gunakan Tanda '.' Untuk Koma" value="<?php echo $data['pph'];  ?>">
                                      <br />
                                      <label>Zakat (%)</label>
                                      <input name="zakat" class="form-control" type="text" placeholder="Gunakan Tanda '.' Untuk Koma" value="<?php echo $data['zakat'];  ?>">
                                      <br />
                                      <label>Biaya Bank</label>
                                      <input id="" name="biaya_bank" class="form-control" type="text" placeholder="" value="<?php echo number_format($data['biaya_bank'], 0, ',', '.');  ?>" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);">
                                      <br />
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                      <button name="input_ongkir" class="btn btn-info" type="submit"><span class="fa fa-check"></span>Simpan</button>
                                    </div>
                                  </form>

                                </div>
                                <!-- /.modal-content -->
                              </div>
                              <!-- /.modal-dialog -->
                            </div>

                            <div class="modal fade" id="modal-ongkir4<?php echo $dt['id'] ?>">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Nilai Ongkir, Diskon, PPN, PPh, Lain-lain</h4>
                                  </div>
                                  <form method="post" enctype="multipart/form-data">
                                    <div class="modal-body">
                                      <input type="hidden" name="idd" value="<?php echo $dt['id'] ?>" />
                                      <label>Ongkir</label>
                                      <input id="" name="ongkir" class="form-control" type="text" placeholder="" value="<?php echo number_format($data['ongkir'], 0, ',', '.');  ?>" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);">
                                      <br />
                                      <label>Diskon</label>
                                      <input id="" name="diskon" class="form-control" type="text" placeholder="Gunakan Tanda '.' Untuk Koma" value="<?php echo $data['diskon_jual'];  ?>">
                                      <br />
                                      <label>PPN (%)</label>
                                      <input id="" name="ppn" class="form-control" type="text" placeholder="Gunakan Tanda '.' Untuk Koma" value="<?php echo $data['ppn_jual'];  ?>">
                                      <br />
                                      <label>PPh (%)</label>
                                      <input id="" name="pph" class="form-control" type="text" placeholder="Gunakan Tanda '.' Untuk Koma" value="<?php echo $data['pph'];  ?>" style="border-color:#F00">
                                      <br />
                                      <label>Zakat (%)</label>
                                      <input name="zakat" class="form-control" type="text" placeholder="Gunakan Tanda '.' Untuk Koma" value="<?php echo $data['zakat'];  ?>">
                                      <br />
                                      <label>Biaya Bank</label>
                                      <input id="" name="biaya_bank" class="form-control" type="text" placeholder="" value="<?php echo number_format($data['biaya_bank'], 0, ',', '.');  ?>" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);">
                                      <br />
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                      <button name="input_ongkir" class="btn btn-info" type="submit"><span class="fa fa-check"></span>Simpan</button>
                                    </div>
                                  </form>

                                </div>
                                <!-- /.modal-content -->
                              </div>
                              <!-- /.modal-dialog -->
                            </div>


                            <div class="modal fade" id="modal-ongkir5<?php echo $dt['id'] ?>">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Nilai Ongkir, Diskon, PPN, PPh, Lain-lain</h4>
                                  </div>
                                  <form method="post" enctype="multipart/form-data">
                                    <div class="modal-body">
                                      <input type="hidden" name="idd" value="<?php echo $dt['id'] ?>" />
                                      <label>Ongkir</label>
                                      <input id="" name="ongkir" class="form-control" type="text" placeholder="" value="<?php echo number_format($data['ongkir'], 0, ',', '.');  ?>" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);">
                                      <br />
                                      <label>Diskon</label>
                                      <input id="" name="diskon" class="form-control" type="text" placeholder="Gunakan Tanda '.' Untuk Koma" value="<?php echo $data['diskon_jual'];  ?>">
                                      <br />
                                      <label>PPN (%)</label>
                                      <input id="" name="ppn" class="form-control" type="text" placeholder="Gunakan Tanda '.' Untuk Koma" value="<?php echo $data['ppn_jual'];  ?>">
                                      <br />
                                      <label>PPh (%)</label>
                                      <input id="" name="pph" class="form-control" type="text" placeholder="Gunakan Tanda '.' Untuk Koma" value="<?php echo $data['pph'];  ?>">
                                      <br />
                                      <label>Zakat (%)</label>
                                      <input name="zakat" class="form-control" type="text" placeholder="Gunakan Tanda '.' Untuk Koma" value="<?php echo $data['zakat'];  ?>">
                                      <br />
                                      <label>Biaya Bank</label>
                                      <input id="" name="biaya_bank" class="form-control" type="text" placeholder="" value="<?php echo number_format($data['biaya_bank'], 0, ',', '.');  ?>" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);">
                                      <br />
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                      <button name="input_ongkir" class="btn btn-info" type="submit"><span class="fa fa-check"></span>Simpan</button>
                                    </div>
                                  </form>

                                </div>
                                <!-- /.modal-content -->
                              </div>
                              <!-- /.modal-dialog -->
                            </div>


                            <div class="modal fade" id="modal-ongkir6<?php echo $dt['id'] ?>">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Nilai Ongkir, Diskon, PPN, PPh, Lain-lain</h4>
                                  </div>
                                  <form method="post" enctype="multipart/form-data">
                                    <div class="modal-body">
                                      <input type="hidden" name="idd" value="<?php echo $dt['id'] ?>" />
                                      <label>Ongkir</label>
                                      <input id="" name="ongkir" class="form-control" type="text" placeholder="" value="<?php echo number_format($data['ongkir'], 0, ',', '.');  ?>" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);">
                                      <br />
                                      <label>Diskon</label>
                                      <input id="" name="diskon" class="form-control" type="text" placeholder="Gunakan Tanda '.' Untuk Koma" value="<?php echo $data['diskon_jual'];  ?>">
                                      <br />
                                      <label>PPN (%)</label>
                                      <input id="" name="ppn" class="form-control" type="text" placeholder="Gunakan Tanda '.' Untuk Koma" value="<?php echo $data['ppn_jual'];  ?>">
                                      <br />
                                      <label>PPh (%)</label>
                                      <input id="" name="pph" class="form-control" type="text" placeholder="Gunakan Tanda '.' Untuk Koma" value="<?php echo $data['pph'];  ?>">
                                      <br />
                                      <label>Zakat (%)</label>
                                      <input name="zakat" class="form-control" type="text" placeholder="Gunakan Tanda '.' Untuk Koma" value="<?php echo $data['zakat'];  ?>">
                                      <br />
                                      <label>Biaya Bank</label>
                                      <input id="" name="biaya_bank" class="form-control" type="text" placeholder="" value="<?php echo number_format($data['biaya_bank'], 0, ',', '.');  ?>" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" style="border-color:#F00">
                                      <br />
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                      <button name="input_ongkir" class="btn btn-info" type="submit"><span class="fa fa-check"></span>Simpan</button>
                                    </div>
                                  </form>

                                </div>
                                <!-- /.modal-content -->
                              </div>
                              <!-- /.modal-dialog -->
                            </div>
                          </div>
                        </div>
                      <?php } ?>
                      <!-- /.tab-pane -->

                      <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                  </div>
                  <!-- nav-tabs-custom -->
                </div>
                <br />

                <center><a href="index.php?page=jual_barang_uang">
                    <button name="batal" class="btn btn-success" type="button"><span class="fa  fa-check"></span> Kembali Ke Halaman Sebelumnya</button></a>
                </center>
              </div>
            </div>
          </div>
        </div>
        <!-- /.box (chat box) -->

        <!-- TO DO List -->
        <!-- /.box -->

        <!-- quick email widget -->
      </section>
      <!-- /.Left col -->
      <!-- right col (We are only adding the ID to make the widgets sortable)-->
      <section class="col-lg-5 connectedSortable">

        <!-- Map box -->
        <!-- /.box -->

        <!-- solid sales graph -->
        <!-- /.box -->

        <!-- Calendar -->
        <!-- /.box -->

      </section>
      <!-- right col -->
    </div>
    <!-- /.row (main row) -->

  </section>
  <!-- /.content -->
</div>
<?php

?>
<div id="open_piutang" class="modalDialog">
  <div>
    <a href="#" title="Close" class="close">X</a>
    <h3 align="center">Ubah Piutang</h3>
    <script type="text/javascript">
      function yesnoCheck() {
        if (document.getElementById('yesCheck').checked) {
          document.getElementById('ifYes').style.display = 'block';
        } else document.getElementById('ifYes').style.display = 'none';
      }
    </script>
    <form method="post">
      <label>No PO</label>
      <input name="no_faktur" class="form-control" type="text" placeholder="" disabled="disabled" value="<?php echo $_SESSION['no_faktur']; ?>"><br />
      <label>Tanggal</label>
      <input name="tgl_input" class="form-control" type="date" placeholder="" required="required" value="<?php echo $_SESSION['tgl_jual']; ?>"><br />
      <input type="radio" onclick="javascript:yesnoCheck();" name="yesno" id="noCheck" style="height:20px; width:20px" checked="checked"><label>Tidak Ada Jatuh Tempo</label><br /><input type="radio" onclick="javascript:yesnoCheck();" name="yesno" id="yesCheck" style="height:20px; width:20px"><label>Jatuh Tempo</label>
      <br />
      <div id="ifYes" style="display:none">
        <label>Tanggal Jatuh Tempo</label>
        <input name="jatuh_tempo" type="date" class="form-control" placeholder="" value=""><br />
      </div>

      <label>Nominal</label>
      <input name="nominal" class="form-control" type="text" placeholder="" value="<?php echo $total2; ?>" required="required"><br />
      <label>Klien</label>
      <input name="klien" class="form-control" type="text" placeholder="" value="<?php echo $sel['nama_pembeli'];  ?>" required="required"><br />
      <label>Deskripsi</label>
      <textarea name="deskripsi" class="form-control" rows="4"></textarea>
      <br />
      <br />
      <!--
              <label>Akun</label>
              <select name="akun" id="akun" class="form-control" required>
              <option value="">-- Pilih --</option>
              <?php
              $q = mysqli_query($koneksi, "select * from coa order by nama_akun ASC");
              while ($d = mysqli_fetch_array($q)) {
              ?>
              <option value="<?php echo $d['id']; ?>"><?php echo $d['nama_akun']; ?></option>
              <?php } ?>
              </select><br />
              <label>Jenis</label>
              <select name="jenis_akun" id="jenis_akun" class="form-control" required>
    <option value="">--Jenis--</option>
    <?php
    $q_seri = mysqli_query($koneksi, "select *,coa_detail.id as idd,coa_detail.nama_akun as nama from coa_detail INNER JOIN coa ON coa.id=coa_detail.coa_id order by coa_detail.nama_akun ASC");
    while ($d_seri = mysqli_fetch_array($q_seri)) {
    ?>
    <option id="jenis_akun" value="<?php echo $d_seri['idd']; ?>" class="<?php echo $d_seri['coa_id']; ?>"><?php echo $d_seri['nama']; ?></option>
    <?php } ?>
    </select>
              <script src="jquery-1.10.2.min.js"></script>
        <script src="jquery.chained.min.js"></script>
        <script>
            $("#jenis_akun").chained("#akun");
        </script>
        -->

      <button name="tambah_header" class="btn btn-success" type="submit"><span class="fa fa-check"></span> Simpan</button>
    </form>

  </div>
</div>

<?php

?>

<div class="modal fade" id="modal-ubah">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" align="center">Ubah Data Umum</h4>
      </div>
      <form method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <label>Tanggal Jual</label>
          <input type="date" name="tgl_jual" value="<?php echo $data['tgl_jual']; ?>" class="form-control" />
          <br />
          <label>No PO</label>
          <input type="text" name="no_po" value="<?php echo $data['no_po_jual']; ?>" class="form-control" />
          <br />
          <label>No Kontrak</label>
          <input type="text" name="no_kontrak" value="<?php echo $data['no_kontrak']; ?>" class="form-control" />
          <br />
          <label>Nama RS/Dinas/Puskesmas/Klinik/Dll</label>
          <div class="form-group">
            <select name="pembeli" id="pembeli" onchange="changeValue(this.value)" required class="form-control select2" style="width:100%">
              <option value="">...</option>

              <?php
              $result = mysqli_query($koneksi, "select *,pembeli.id as idd from pembeli,alamat_provinsi,alamat_kabupaten,alamat_kecamatan where alamat_provinsi.id=pembeli.provinsi_id and alamat_kabupaten.id=pembeli.kabupaten_id and alamat_kecamatan.id=pembeli.kecamatan_id group by nama_pembeli order by nama_pembeli ASC");
              $jsArray = "var dtPembeli = new Array();
";
              while ($row = mysqli_fetch_array($result)) {
              ?>
                <option <?php if ($data['pembeli_id'] == $row['idd']) {
                          echo "selected";
                        } ?> value="<?php echo $row['idd']; ?>"><?php echo $row['nama_pembeli']; ?></option>
              <?php

                $jsArray .= "dtPembeli['" . $row['idd'] . "'] = {nama_pembeli:'" . addslashes($row['nama_pembeli']) . "',
							provinsi:'" . addslashes($row['nama_provinsi']) . "',
							provinsi_id:'" . addslashes($row['provinsi_id']) . "',
						kabupaten:'" . addslashes($row['nama_kabupaten']) . "',
						kabupaten_id:'" . addslashes($row['kabupaten_id']) . "',
						kecamatan:'" . addslashes($row['nama_kecamatan']) . "',
						kecamatan_id:'" . addslashes($row['kecamatan_id']) . "',
						kelurahan:'" . addslashes($row['kelurahan_id']) . "',
						jalan:'" . addslashes(substr($row['jalan'], 0, 17) . ".....") . "',
						kontak_rs:'" . addslashes($row['kontak_rs']) . "'
						};
";
              }
              ?>
            </select>
          </div>
          <div class="well">
            <div class="box-header" align="center"><strong>Alamat RS/Dinas/Puskesmas/Klinik/Dll</strong></div>
            <input class="form-control" type="hidden" name="nama_pembeli" id="nama_pembeli">
            Kelurahan
            <input class="form-control" type="text" placeholder="" name="kelurahan" id="kelurahan" disabled="disabled" value="<?php echo $sel['kelurahan_id']; ?>"><br />
            Alamat Jalan
            <input class="form-control" type="text" placeholder="" name="jalan" id="jalan" disabled="disabled" value="<?php echo $sel['kelurahan_id']; ?>"><br />
            Kontak RS/Dinas/Dll
            <input class="form-control" type="text" placeholder="" name="kontak_rs" required id="kontak_rs" disabled="disabled" value="<?php echo $sel['kontak_rs']; ?>"><br />
          </div>

          <label>Nama Pemakai</label>
          <input type="text" name="nama_pemakai" value="<?php echo $sel_pemakai['nama_pemakai']; ?>" class="form-control" />
          <br />
          <label>Kontak Pemakai (1)</label>
          <input type="text" value="<?php echo $sel_pemakai['kontak1_pemakai']; ?>" name="kontak1" class="form-control" />
          <br />
          <label>Kontak Pemakai (2)</label>
          <input type="text" name="kontak2" value="<?php echo $sel_pemakai['kontak2_pemakai']; ?>" class="form-control" />
          <br />
          <label>Email Pemakai</label>
          <input type="email" name="email_pemakai" value="<?php echo $sel_pemakai['email_pemakai']; ?>" class="form-control" />
          <br />
          <label>Marketing</label>
          <select required="required" name="marketing" class="form-control select2" style="width:100%">
            <option value="">...</option>
            <?php $s = mysqli_query($koneksi, "select * from marketing order by nama_marketing ASC");
            while ($d_s = mysqli_fetch_array($s)) { ?>
              <option <?php if ($data['marketing'] == $d_s['nama_marketing']) {
                        echo "selected";
                      } ?> value="<?php echo $d_s['nama_marketing']; ?>"><?php echo $d_s['nama_marketing']; ?></option>
            <?php } ?>
          </select>
          <br /><br />
          <label>Subdis</label>
          <textarea class="form-control" name="subdis" required rows="5" placeholder="Gunakan [ENTER] untuk melainkan kalimat pertama dan kalimat berikutnya"><?php echo str_replace("<br>", "\n", $data['subdis']); ?></textarea>
          <br />
          <label>Riwayat Po yang deal</label>
          <select name="status_deal" class="form-control select2" style="width:100%">
            <option <?php if ($jm_deal == 0) {
                      echo "selected";
                    } ?> value="0">Belum Ada</option>
            <?php $s2 = mysqli_query($koneksi, "select * from barang_dijual where no_po_jual='" . $data['no_po_jual'] . "' order by id ASC");
            $nn = 0;
            while ($d_s = mysqli_fetch_array($s2)) {
              $nn++; ?>
              <option <?php if ($d_s['status_deal'] == 1) {
                        echo "selected";
                      } ?> value="<?php echo $d_s['id']; ?>"><?php echo "Riwayat " . $nn; ?></option>
            <?php } ?>
          </select>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success" name="simpan_pemakai">Simpan</button>
        </div>
        <script type="text/javascript">
          <?php
          echo $jsArray;
          ?>

          function changeValue(pembeli) {
            document.getElementById('nama_pembeli').value = dtPembeli[pembeli].nama_pembeli;
            document.getElementById('kelurahan').value = dtPembeli[pembeli].kelurahan;
            document.getElementById('jalan').value = dtPembeli[pembeli].jalan;
            document.getElementById('kontak_rs').value = dtPembeli[pembeli].kontak_rs;
          };
        </script>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal-ubah-harga">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Ubah Harga Barang</h4>
      </div>
      <form method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <label>Nama Barang</label>
          <select name="barang_id" id="barang_id" class="form-control select2" autofocus="autofocus" required onchange="ubahHarga(this.value)" style="width:100%">
            <option value="">...</option>
            <?php
            $qq22 = mysqli_query($koneksi, "select * from barang_gudang order by nama_brg ASC");
            $jsArray5 = "var dtBrg5 = new Array();
";
            while ($d = mysqli_fetch_array($qq22)) { ?>
              <option value="<?php echo $d['id']; ?>"><?php echo $d['nama_brg'] . " - " . $d['tipe_brg']; ?></option>
            <?php
              $stok_po1 = mysqli_fetch_array(mysqli_query($koneksi, "select sum(qty_jual) as stok_po from barang_dijual_qty where barang_gudang_id=" . $d['id'] . ""));
              $stok_po2 = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_dikirim_detail,barang_gudang_detail,barang_dijual_qty where barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dijual_qty.id=barang_dikirim_detail.barang_dijual_qty_id and barang_dijual_qty.barang_gudang_id=" . $d['id'] . ""));

              $jsArray5 .= "dtBrg5['" . $d['id'] . "'] = {harga:'" . addslashes(number_format($d['harga_satuan'], 0, ',', '.')) . "'
						};";
            } ?>
          </select>
          <br /><br />
          <label>Harga Barang</label>
          <input id="nominal" name="nominal" class="form-control" type="text" placeholder="" value="" required="required" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);"><br />

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <button name="ubah_harga" class="btn btn-info" type="submit"><span class="fa fa-check"></span> Simpan Perubahan</button>
        </div>
      </form>
      <script type="text/javascript">
        <?php
        echo $jsArray5;
        ?>

        function ubahHarga(barang_id) {
          document.getElementById('nominal').value = dtBrg5[barang_id].harga;
        };
      </script>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal-riwayat">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Tambah Riwayat</h4>
      </div>
      <form method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <label>Gunakan Data Dari Riwayat ke-</label>
          <select required name="riwayat" class="form-control select2" style="width:100%">
            <option value="">...</option>
            <?php $s3 = mysqli_query($koneksi, "select * from barang_dijual where no_po_jual='" . $data['no_po_jual'] . "' order by id ASC");
            $nm = 0;
            while ($d_s = mysqli_fetch_array($s3)) {
              $nm++; ?>
              <option value="<?php echo $d_s['id']; ?>"><?php echo "Riwayat " . $nm; ?></option>
            <?php } ?>
          </select>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <button name="tambah_riwayat" class="btn btn-warning" type="submit"><span class="fa fa-check"></span> Tambah Riwayat</button>
        </div>
      </form>

    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal-teks-riwayat">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Peringatan !</h4>
      </div>
      <div class="modal-body">
        Silakan Ubah Dulu Riwayat PO Deal Menjadi Belum Ada Untuk Menambah Riwayat (Pilih Ubah Data Umum di Pojok Kanan Atas)
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
      </div>


    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>