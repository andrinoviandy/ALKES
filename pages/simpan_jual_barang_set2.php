<?php
if (isset($_POST['ubah_harga'])) {
  $up = mysqli_query($koneksi, "update barang_gudang set harga_satuan='" . str_replace(".", "", $_POST['nominal']) . "' where id=" . $_POST['barang_id'] . "");
  if ($up) {
    echo "<script>
		window.location='index.php?page=simpan_jual_alkes2';
		
		</script>";
  }
}

if (isset($_POST['tambah_header'])) {
  $cek = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_dijual_qty_set_hash where akun_id=" . $_SESSION['id'] . ""));
  if ($cek != 0) {
    
    $insert_pemakai = mysqli_query($koneksi, "insert into pemakai values('','" . $_SESSION['pemakai'] . "','" . $_SESSION['kontak1'] . "','" . $_SESSION['kontak2'] . "','" . $_SESSION['email'] . "')");

    $id_pembeli = $_SESSION['pembeli'];
    $pemakai = mysqli_fetch_array(mysqli_query($koneksi, "select max(id) as id_pemakai from pemakai"));
    $id_pemakai = $pemakai['id_pemakai'];
    //simpan barang dijual
    $total = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_dijual_qty_set_hash where akun_id=" . $_SESSION['id'] . ""));

    $simpan1 = mysqli_query($koneksi, "insert into barang_dijual_set values('','" . $_SESSION['tgl_jual'] . "','" . $_SESSION['no_faktur'] . "','$id_pembeli','$id_pemakai','" . $_SESSION['marketing'] . "','" . $_SESSION['subdis'] . "','" . $_SESSION['diskon'] . "','" . $_SESSION['ppn'] . "','" . $_POST['nominal'] . "')");

    $d1 = mysqli_fetch_array(mysqli_query($koneksi, "select max(id) as id_jual from barang_dijual_set"));
    $id_jual = $d1['id_jual'];
    //simpan barang pesan detail
    $q2 = mysqli_query($koneksi, "select * from barang_dijual_qty_set_hash where akun_id=" . $_SESSION['id'] . "");
    while ($d2 = mysqli_fetch_array($q2)) {
      $simpan2 = mysqli_query($koneksi, "insert into barang_dijual_qty_set values('','$id_jual','" . $d2['barang_gudang_set_id'] . "','" . $d2['qty_set'] . "','0')");
	  $dd = mysqli_fetch_array(mysqli_query($koneksi, "select max(id) as id_detail from barang_dijual_qty_set"));
    $id_detail= $dd['id_detail'];
	$qq = mysqli_query($koneksi, "select * from barang_dijual_qty_set_detail_hash where barang_dijual_qty_set_hash_id=" . $d2['id'] . "");
	while ($d3 = mysqli_fetch_array($qq)) {
		$simpan3 = mysqli_query($koneksi, "insert into barang_dijual_qty_set_detail values ('','".$id_detail."','".$d3['barang_gudang_id']."','".$d3['harga_jual_saat_itu']."','".$d3['qty_barang_gudang']."')");
		}
    }
    if ($simpan1 and $simpan2 and $simpan3) {
      $Result = mysqli_query($koneksi, "insert into utang_piutang_set values('','Piutang','" . $_SESSION['no_faktur'] . "','" . $_POST['tgl_input'] . "','" . $_POST['jatuh_tempo'] . "','".str_replace(".","",$_POST['nominal'])."','" . $_POST['klien'] . "','" . $_POST['deskripsi'] . "','0')");
	  $del = mysqli_query($koneksi, "select * from barang_dijual_qty_set_hash where akun_id=" . $_SESSION['id'] . "");
	  while ($del2 = mysqli_fetch_array($del)) {
		mysqli_query($koneksi, "delete from barang_dijual_qty_set_detail_hash where barang_dijual_qty_set_hash_id =" . $del2['id'] . "");
		mysqli_query($koneksi, "delete from barang_dijual_qty_set_hash where id =" . $del2['id'] . "");
	  }
      echo "<script type='text/javascript'>
	alert('Data Berhasil Di Simpan !');
	window.location='index.php?page=penjualan_barang_set'</script>";
    }
  } else {
    echo "<script type='text/javascript'>
	alert('Data tidak boleh kosong , silakan tambah terlebih dahulu ! !');
	window.location='index.php?page=simpan_jual_barang_set2'</script>";
  }
}


if (isset($_POST['simpan_tambah_aksesoris'])) {
  $cek = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_dijual_qty_set_hash where akun_id = " . $_SESSION['id'] . " and barang_gudang_set_id=" . $_POST['id_akse'] . ""));
  if ($cek == 0) {
    $insert1 = mysqli_query($koneksi, "INSERT INTO barang_dijual_qty_set_hash VALUES('','" . $_SESSION['id'] . "','" . $_POST['id_akse'] . "','" . $_POST['qty'] . "')");
    $max_hash = mysqli_fetch_array(mysqli_query($koneksi, "select max(id) as idd from barang_dijual_qty_set_hash"));
    $da0 = mysqli_fetch_array(mysqli_query($koneksi, "select * from barang_dijual_qty_set_hash where id = " . $max_hash['idd'] . ""));
    $q_set1 = mysqli_query($koneksi, "select * from barang_gudang_set_detail where barang_gudang_set_id = " . $_POST['id_akse'] . "");
    while ($da = mysqli_fetch_array($q_set1)) {
		$hrg = mysqli_fetch_array(mysqli_query($koneksi, "select harga_satuan from barang_gudang where id=".$da['barang_gudang_id'].""));
      $s2 = mysqli_query($koneksi, "INSERT INTO barang_dijual_qty_set_detail_hash values('','" . $max_hash['idd'] . "','" . $da['barang_gudang_id'] . "','" . $hrg['harga_satuan'] . "','" . $da['qty'] . "')");
    }
    echo "<script>window.location='index.php?page=simpan_jual_barang_set2'</script>";
  } else {
    echo "<script>alert('Maaf , Barang sudah dimasukkan !');</script>";
  }
}

if (isset($_GET['id_hapus'])) {
  $id = mysqli_fetch_array(mysqli_query($koneksi, "select barang_dijual_qty_set_hash.id as id1, barang_dijual_qty_set_detail_hash.id as id2 from barang_dijual_qty_set_hash,barang_dijual_qty_set_detail_hash where barang_dijual_qty_set_hash.id = barang_dijual_qty_set_detail_hash.barang_dijual_qty_set_hash_id and barang_dijual_qty_set_hash.id=" . $_GET['id_hapus'] . ""));
  $hapus2 = mysqli_query($koneksi, "delete from barang_dijual_qty_set_detail_hash where barang_dijual_qty_set_hash_id = ".$id['id1']."");
  $hapus1 = mysqli_query($koneksi, "delete from barang_dijual_qty_set_hash where id = ".$id['id1']."");
}
?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Jual Barang Set</h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active"> Jual Barang Set</li>
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
            <div class="box-body table-responsive no-padding">
              <div class="">
                <!--<a href="index.php?page=tambah_barang_masuk"><button name="tambah_laporan" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Tambah Barang</button></a>-->

                <table width="100%" id="" class="table table-responsive">
                  <thead>
                    <tr>
                      <th colspan="9" align="left">Marketing : <?php echo $_SESSION['marketing']; ?>&nbsp;&nbsp;&nbsp;&nbsp; , Sub Distributor : <?php echo $_SESSION['subdis']; ?>&nbsp;&nbsp;&nbsp;&nbsp; , Diskon : <?php echo $_SESSION['diskon'] . " %"; ?>&nbsp;&nbsp;&nbsp;&nbsp; , PPN : <?php echo $_SESSION['ppn'] . " %"; ?></th>
                    </tr>
                    <tr>
                      <th colspan="3" valign="bottom">&nbsp;</th>
                      <th valign="bottom">&nbsp;</th>
                      <th valign="bottom">&nbsp;</th>
                      <th valign="bottom">&nbsp;</th>
                      <th valign="bottom">&nbsp;</th>
                      <th valign="bottom">&nbsp;</th>
                      <th valign="bottom">&nbsp;</th>
                    </tr>
                    <tr>
                      <th valign="bottom"><strong>Tgl Jual</strong></th>
                      <th valign="bottom">No PO</th>
                      <th valign="bottom">Nama RS/Dinas/Klinik/dll</th>
                      <th valign="bottom"><strong>Kelurahan</strong></th>
                      <th valign="bottom">Alamat</th>
                      <th valign="bottom"><strong>Kontak RS/Dinas/dll</strong></th>
                      <th valign="bottom"><strong>Nama Pemakai</strong></th>
                      <th valign="bottom">Kontak Pemakai</th>
                      <th valign="bottom">Email</th>
                    </tr>
                  </thead>
                  <tr>
                    <td><?php echo date("d-m-Y", strtotime($_SESSION['tgl_jual'])); ?>
                    </td>
                    <td><?php echo $_SESSION['no_faktur']; ?></td>
                    <td><?php
                        $sel = mysqli_fetch_array(mysqli_query($koneksi, "select nama_pembeli from pembeli where id=" . $_SESSION['pembeli'] . ""));
                        echo $sel['nama_pembeli']; ?></td>
                    <td><?php echo $_SESSION['kelurahan']; ?></td>
                    <td><?php echo $_SESSION['alamat']; ?></td>
                    <td><?php echo $_SESSION['kontak_rs']; ?></td>
                    <td><?php echo $_SESSION['pemakai']; ?></td>
                    <td><?php echo $_SESSION['kontak1'] . " / " . $_SESSION['kontak2']; ?></td>
                    <td><?php echo $_SESSION['email']; ?></td>
                  </tr>
                </table><br />
                <center>
                  <font align="center" size="+2">
                    Tambah Data Alkes Yang Akan Dijual
                  </font>
                </center>
                <!--<font color="#FF0000">* Jika Ingin Menambah Data Aksesoris Yang Baru ! Klik Disini <a href="index.php?page=simpan_tambah_aksesoris&id=<?php //echo $_GET['id']; 
                                                                                                                                                          ?>#openAkse"><small data-toggle="tooltip" title="Tambah Aksesoris Baru" class="label bg-blue">+ New Accessories</small></a></font>-->
                <br />
                <button name="tambah" class="btn btn-success" type="button" data-toggle="modal" data-target="#modal-tambah"><span class="fa fa-plus"></span> Tambah</button>
                <a href="https://www.contoh.com" target="_self">Buka di Parent Window</a>
                <button class="btn btn-info pull pull-right" data-toggle="modal" data-target="#modal-ubah-harga"><i class="fa fa-edit"></i> Perubahan Harga Jual</button>
                <table width="100%" id="example3" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th valign="bottom">No</th>
                      <th valign="bottom"><strong>Nama Set</strong></th>

                      <td align="center" valign="bottom"><strong>Tipe</strong></td>
                      <td align="center" valign="bottom"><strong>Merk
                        </strong>
                      </td>
                      <td align="center" valign="bottom"><strong>Qty Jual (Set)</strong>
                      </td>
                      <td align="center" valign="bottom"><strong>Rincian Barang Dalam 1 Set</strong></td>
                      <td align="center" valign="bottom"><strong>Total Harga</strong>
                      </td>
                      <td align="center" valign="bottom"><strong>Aksi</strong>
                      </td>
                    </tr>
                  </thead>

                  <script type="text/javascript">
                    <?php
                    echo $jsArray;
                    ?>

                    function changeValue(id_akse) {
                      document.getElementById('tipe_akse').value = dtBrg[id_akse].tipe_akse;
                      document.getElementById('merk_akse').value = dtBrg[id_akse].merk_akse;
                      document.getElementById('no_akse').value = dtBrg[id_akse].no_akse;

                    };
                  </script>
                  <script type="text/javascript">
                    <?php
                    echo $jsArray2;
                    ?>

                    function changeValue(nama_set) {
                      document.getElementById('stok_set').value = dtBrg2[nama_set].qty;
                      document.getElementById('harga_satuan').value = dtBrg2[nama_set].harga_satuan;
                    };
                  </script>
                  <?php

                  $no = 0;
                  $q_akse = mysqli_query($koneksi, "select *,barang_dijual_qty_set_hash.id as idd from barang_dijual_qty_set_hash, barang_gudang_set where barang_gudang_set.id = barang_dijual_qty_set_hash.barang_gudang_set_id and akun_id = " . $_SESSION['id'] . "");
                  $jm = mysqli_num_rows($q_akse);
                  if ($jm != 0) {
                    while ($data_akse = mysqli_fetch_array($q_akse)) {
                      $no++;
                  ?>
                      <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $data_akse['nama_brg']; ?>
                        </td>
                        <td align="center"><?php echo $data_akse['tipe_brg']; ?></td>
                        <td align="center"><?php echo $data_akse['merk_brg']; ?></td>
                        <td align="center">
                          <?php echo $data_akse['qty_set']; ?>
                        </td>
                        <td align="center">
                          <small class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-lihat<?php echo $data_akse['idd'] ?>">
                            <i class="fa fa-eye"></i>&nbsp;
                            <?php
                            $jml_brg_dlm_set = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_gudang_set_detail where barang_gudang_set_id = " . $data_akse['barang_gudang_set_id'] . ""));
                            echo $jml_brg_dlm_set; ?>
                          </small>
                        </td>
                        <td align="right">
                          <?php
                          $total = mysqli_fetch_array(mysqli_query($koneksi, "select sum(qty_barang_gudang*harga_satuan) AS total_harga from barang_dijual_qty_set_detail_hash, barang_gudang where barang_gudang.id = barang_dijual_qty_set_detail_hash.barang_gudang_id AND barang_dijual_qty_set_hash_id = " . $data_akse['idd'] . ""));
                          echo "Rp" . number_format($total['total_harga'], 2, ',', '.');
                          ?>
                        </td>
                        <td align="center">
                          <a href="index.php?page=simpan_jual_barang_set2&id_hapus=<?php echo $data_akse['idd']; ?>" onclick="return confirm('Yakin Akan Menghapus Item Ini ?')"><span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span></a>
                        </td>
                      </tr>
                      <div class="modal fade" id="modal-lihat<?php echo $data_akse['idd'] ?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Rincian Barang Satuan</h4>
      </div>
        <div class="modal-body">
          <div class="box-title"><?php echo $data_akse['nama_brg']; ?><div class="pull pull-right">Jumlah Set : <?php echo $data_akse['qty_set']; ?></div></div>
          <div class="box box-body col-lg-10">
          <div class="row">
          <div class="col-lg-8 bg-info" style="padding:5px; border:1px solid;"><strong>Nama Barang<br />Satuan</strong></div>
          <div align="center" class="col-lg-2 bg-info" style="padding:5px; border:1px solid"><strong>Jumlah (Satuan)</strong></div>
          <div align="center" class="col-lg-2 bg-info" style="padding:5px; border:1px solid"><strong>Total (Satuan*Set)</strong></div>
          </div>
          <?php
          $q_satuan = mysqli_query($koneksi, "select * from barang_dijual_qty_set_detail_hash, barang_gudang where barang_gudang.id=barang_dijual_qty_set_detail_hash.barang_gudang_id and barang_dijual_qty_set_hash_id = ".$data_akse['idd']."");
		  while ($dt = mysqli_fetch_array($q_satuan)) {
		  ?>
          <div class="row">
          <div class="col-lg-8" style="padding:5px; border:1px solid"><?php echo $dt['nama_brg'] ?></div>
          <div align="center" class="col-lg-2" style="padding:5px; border:1px solid"><?php echo $dt['qty_barang_gudang'] ?></div>
          <div align="center" class="col-lg-2" style="padding:5px; border:1px solid"><?php echo $dt['qty_barang_gudang']*$data_akse['qty_set'] ?></div>
          </div>
          <?php } ?>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          
        </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
                  <?php }
                  } else {
                    echo "<tr><td colspan='8' align='center'>Tidak Ada Data</td></tr>";
                  } ?>
                  <tr>
                    <td colspan="8" align="right" bgcolor="#00CC66"></td>
                  </tr>
                  <tr>
                    <td colspan="6" align="right"><strong>Sub Total</strong></td>
                    <td align="right">
                      <?php
                          $se = mysqli_fetch_array(mysqli_query($koneksi, "select sum(qty_barang_gudang*harga_satuan) AS sub_total from barang_dijual_qty_set_detail_hash, barang_gudang, barang_dijual_qty_set_hash where barang_dijual_qty_set_hash.id=barang_dijual_qty_set_detail_hash.barang_dijual_qty_set_hash_id and barang_gudang.id = barang_dijual_qty_set_detail_hash.barang_gudang_id and akun_id = " . $_SESSION['id'] . ""));
                          ?>
                      <?php
                      $total = $se['sub_total'];
                      echo number_format($se['sub_total'], 2, ',', '.'); ?></td>
                    <td align="center">&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="6" align="right">PPn (<?php echo $_SESSION['ppn'] . " %"; ?>)</td>
                    <td align="right"><?php
                                      $total3 = $se['sub_total'] * $_SESSION['ppn'] / 100;
                                      echo "(+) " . number_format($se['sub_total'] * $_SESSION['ppn'] / 100, 2, ',', '.'); ?></td>
                    <td align="center">&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="6" align="right">Disc (<?php echo $_SESSION['diskon'] . " %"; ?>)</td>
                    <td align="right"><?php
                                      $total2 = $se['sub_total'] * $_SESSION['diskon'] / 100;
                                      echo "(-) " . number_format($se['sub_total'] * $_SESSION['diskon'] / 100, 2, ',', '.'); ?></td>
                    <td align="center">&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="6" align="right" valign="bottom"><h4><strong>Total Keseluruhan</strong></h4></td>
                    <td align="right">
                      <h4><?php echo "Rp".number_format($total - $total2 + $total3, 2, ',', '.'); ?></h4></td>
                    <td align="center"></td>
                  </tr>
                  <tr>
                    <td colspan="10" align="right" valign="bottom">
                      <center><a data-toggle="modal" data-target="#modal-piutang"><button name="simpan_barang" class="btn btn-success" type="submit" <?php if ($jm==0) { echo "disabled";} ?>><span class="fa fa-plus"></span> Simpan</button></a>&nbsp;&nbsp;<a href="index.php?page=penjualan_barang_set"><button name="batal" class="btn btn-success" type="button"><span class="fa fa-times-circle"></span> Batal</button></a></center>
                    </td>
                  </tr>

                </table>
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
$data = mysqli_fetch_array(mysqli_query($koneksi, "select * from barang_dijual_qty_set_hash where id=" . $_GET['id_ubah'] . ""));
if (isset($_POST['ubah_qty'])) {
  $sell = mysqli_fetch_array(mysqli_query($koneksi, "select * from barang_gudang_set_2 where id=" . $data['barang_gudang_set2_id'] . ""));
  if ($sell['qty'] >= $_POST['qty']) {
    $Result = mysqli_query($koneksi, "update barang_dijual_qty_set_hash set qty_jual=" . $_POST['qty'] . " where id=" . $_GET['id_ubah'] . "");
    if ($Result) {
      echo "<script type='text/javascript'>	window.location='index.php?page=simpan_jual_barang_set2';
		</script>";
    }
  } else {
    echo "<script type='text/javascript'>
		alert('Stok tidak cukup !');
		
		</script>";
  }
}
?>
<div id="openUbah" class="modalDialog">
  <div>
    <a href="#" title="Close" class="close">X</a>
    <h3 align="center">Ubah Qty</h3>
    <form method="post">
      <label>Qty</label>
      <input name="qty" class="form-control" type="text" placeholder="" value="<?php echo $data['qty_jual']; ?>"><br />
      <button name="ubah_qty" class="btn btn-success" type="submit"><span class="fa fa-check"></span> Simpan</button>
    </form>
  </div>
</div>
<div id="open_piutang" class="modalDialog">
  <div>
    <a href="#" title="Close" class="close">X</a>
    <h3 align="center">Tambah Piutang Baru</h3>
    <script type="text/javascript">
      function yesnoCheck() {
        if (document.getElementById('yesCheck').checked) {
          document.getElementById('ifYes').style.display = 'block';
        } else document.getElementById('ifYes').style.display = 'none';
      }
    </script>
    <form method="post">
      <label>No Faktur</label>
      <input name="no_faktur" class="form-control" type="text" placeholder="" value="<?php echo $_SESSION['no_faktur']; ?>" disabled="disabled"><br />
      <label>Tanggal</label>
      <input name="tgl_input" class="form-control" type="date" placeholder="" required="required" value="<?php echo $_SESSION['tgl_jual']; ?>"><br />
      <input type="radio" onclick="javascript:yesnoCheck();" name="yesno" id="noCheck" style="height:20px; width:20px" checked="checked"><label>Tidak Ada Jatuh Tempo</label><br /><input type="radio" onclick="javascript:yesnoCheck();" name="yesno" id="yesCheck" style="height:20px; width:20px"><label>Jatuh Tempo</label>
      <br />
      <div id="ifYes" style="display:none">
        <label>Tanggal Jatuh Tempo</label>
        <input name="jatuh_tempo" type="date" class="form-control" placeholder="" value=""><br />
      </div>

      <label>Nominal</label>
      <input name="nominal" class="form-control" type="text" placeholder="" value="<?php echo $total - $total2 + $total3; ?>" required="required"><br />
      <label>Klien</label>
      <input name="klien" class="form-control" type="text" placeholder="" value="<?php echo $sel['nama_pembeli'];  ?>" required="required"><br />
      <label>Deskripsi</label>
      <textarea name="deskripsi" class="form-control" rows="4" required="required"></textarea>
      <br />
      <br />
      <button name="tambah_header" class="btn btn-success" type="submit"><span class="fa fa-check"></span> Simpan</button>
    </form>

  </div>
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

<div class="modal fade" id="modal-tambah">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" align="center"><strong>Tambah Data</strong></h4>
      </div>
      <form method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <label>Nama Set</label>
          <select name="id_akse" id="id_akse" class="form-control select2" autofocus="autofocus" required onchange="changeValue(this.value)" style="width:100%">
            <option value="">...</option>
            <?php
            $q = mysqli_query($koneksi, "select * from barang_gudang_set order by nama_brg ASC");
            $jsArray2 = "var dtBrg = new Array();
";
            while ($d = mysqli_fetch_array($q)) { ?>
              <option value="<?php echo $d['id']; ?>"><?php echo $d['nama_brg']; ?></option>
            <?php
              $jml_brg = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_gudang_set_detail where barang_gudang_set_id = " . $d['id'] . ""));
              $jsArray2 .= "dtBrg['" . $d['id'] . "'] = {tipe_akse:'" . addslashes($d['tipe_brg']) . "',
						merk_akse:'" . addslashes($d['merk_brg']) . "',
						jumlah_brg:'" . addslashes($jml_brg) . "'
						};";
            } ?>
          </select>
          <br /><br />
          <label>Jumlah Barang Dalam 1 Set</label>
          <input id="stok_total" name="stok_total" class="form-control" type="text" placeholder="" disabled="disabled" size="4" />
          <br />
          <label>Tipe</label>
          <input id="tipe_akse" name="tipe_akse" class="form-control" type="text" placeholder="" disabled="disabled" size="15" />
          <br />
          <label>Merk</label>
          <input id="merk_akse" name="merk_akse" class="form-control" type="text" placeholder="" disabled="disabled" size="15" />
          <br />
          <label>Qty Jual (Set)</label>
          <input id="qty" name="qty" class="form-control" type="number" placeholder="" size="2" />
          <br />
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <button name="simpan_tambah_aksesoris" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Tambah</button>
        </div>
        <script type="text/javascript">
          <?php
          echo $jsArray2;
          ?>

          function changeValue(id_akse) {
            document.getElementById('stok_total').value = dtBrg[id_akse].jumlah_brg;
            document.getElementById('tipe_akse').value = dtBrg[id_akse].tipe_akse;
            document.getElementById('merk_akse').value = dtBrg[id_akse].merk_akse;
          };
        </script>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal-piutang">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
              <script type="text/javascript">
function yesnoCheck() {
    if (document.getElementById('yesCheck').checked) {
        document.getElementById('ifYes').style.display = 'block';
    }
    else document.getElementById('ifYes').style.display = 'none';
}
</script>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Masukkan Piutang Baru</h4>
              </div>
              <form method="post" enctype="multipart/form-data">
              <div class="modal-body">
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
               
              <label>Nominal <font color="#FF0000">(*Akan bernilai 0 Jika Status PO Belum Deal)</font></label>
              <input name="nominal" class="form-control" type="text" placeholder="" value="<?php echo number_format($total - $total2 + $total3,0,',','.'); ?>" required="required" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);"><br />
              <label>Klien</label>
              <input name="klien" class="form-control" type="text" placeholder="" value="<?php echo $sel['nama_pembeli'];  ?>" required="required"><br />
              <label>Deskripsi</label>
              <textarea name="deskripsi" class="form-control" rows="4" ></textarea>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button name="tambah_header" class="btn btn-success" type="submit"><span class="fa fa-check"></span> Simpan</button>
              </div>
              </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>