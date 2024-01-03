<?php
$query = mysqli_query($koneksi, "select *,principle.id as id_principle from barang_pesan,principle where principle.id=barang_pesan.principle_id and barang_pesan.id='" . $_GET['id'] . "'");
$data = mysqli_fetch_array($query);

if (isset($_GET['id_hapus']) and isset($_GET['id_po'])) {
  $del = mysqli_query($koneksi, "delete from barang_gudang_detail where id=" . $_GET['id_hapus'] . "");
  if ($del) {
    $jml = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_gudang_detail where barang_gudang_id=" . $_GET['id'] . " and status_terjual=0"));
    $up = mysqli_query($koneksi, "update barang_gudang set stok_total=$jml where id=" . $_GET['id'] . "");

    $lihat_stok = mysqli_fetch_array(mysqli_query($koneksi, "select * from barang_gudang_po where id=" . $_GET['id_po'] . ""));
    if ($lihat_stok['stok'] < 2) {
      $upd = mysqli_query($koneksi, "delete from barang_gudang_po where id=" . $_GET['id_po'] . "");
    } else {
      $upd = mysqli_query($koneksi, "update barang_gudang_po set stok=stok-1 where id=" . $_GET['id_po'] . "");
    }
    if ($up and $upd) {
      echo "<script type='text/javascript'>
		window.location='index.php?page=ubah_barang_masuk&id=$_GET[id]'
		</script>";
    }
  }
}

if (isset($_GET['batal_mutasi'])) {
  $sel1 = mysqli_fetch_array(mysqli_query($koneksi, "select *,barang_pesan_detail.id as idd from barang_pesan,barang_pesan_detail,barang_gudang where barang_gudang.id=barang_pesan_detail.barang_gudang_id and barang_pesan.id=barang_pesan_detail.barang_pesan_id and barang_pesan_detail.id=" . $_GET['id_pesan_detail'] . ""));
  $sel2 = mysqli_fetch_array(mysqli_query($koneksi, "select * from barang_gudang_po where no_po_gudang='" . $sel1['no_po_pesan'] . "' and barang_gudang_id=" . $_GET['id_gudang'] . " and stok=" . $_GET['stok'] . ""));
  $sel3 = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_gudang_detail where barang_gudang_po_id=" . $sel2['id'] . " and status_kirim=1"));
  $sel5 = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_gudang_detail where barang_gudang_po_id=" . $sel2['id'] . " and status_demo=1"));
  if ($sel3 != 0 or $sel5 != 0) {
    echo "<script type='text/javascript'>
		alert('Pembatalan Mutasi Barang GAGAL ! Barang Dengan No Po Ini Sudah Ada Yang Terjual atau Sedang Didemokan !');
		window.location='index.php?page=mutasi&id=$_GET[id]';
		</script>";
  } else {
    $sel4 = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_gudang_detail where barang_gudang_po_id=" . $sel2['id'] . ""));
    $del1 = mysqli_query($koneksi, "delete from barang_gudang_detail where barang_gudang_po_id=$sel2[id]");
    $del2 = mysqli_query($koneksi, "delete from barang_gudang_po where id=$sel2[id]");
    $del3 = mysqli_query($koneksi, "update barang_gudang set stok_total=stok_total-$sel4 where id=$_GET[id_gudang]");
    if ($del1 and $del2 and $del3) {
      echo "<script type='text/javascript'>
		alert('Pembatalan Mutasi Barang BERHASIL !');
		window.location='index.php?page=mutasi&id=$_GET[id]';
		</script>";
    }
  }
}

if (isset($_POST['simpan_perubahan'])) {
  $Result = mysqli_query($koneksi, "update barang_pesan set tgl_po_pesan='" . $_POST['tgl_po'] . "',no_po_pesan='" . $_POST['no_po'] . "',ppn='" . $_POST['ppn'] . "',cara_pembayaran='" . $_POST['cara_pembayaran'] . "',alamat_pengiriman='" . str_replace("\n", "<br>", $_POST['alamat_pengiriman']) . "',jalur_pengiriman='" . $_POST['jalur_pengiriman'] . "', catatan='" . $_POST['catatan'] . "' where id=" . $_GET['id'] . "");
  if ($Result) {
    echo "<script type='text/javascript'>
		alert('Data Berhasil Diubah !');
		window.location='index.php?page=pembelian_alkes'
		</script>";
  }
}


?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Mutasi Alkes</h1>
    <ol class="breadcrumb">
      <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active"><a href="index.php?page=barang_masuk">Pemesanan</a></li>
      <li class="active">Mutasi Alkes</li>
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
            <div class="box-header with-border">
              <div class="table-responsive">
                <table width="100%" class="table table-bordered table-hover">
                  <thead>
                    <tr>

                      <th valign="top">Tgl PO</th>
                      <th valign="top">No PO</th>
                      <th valign="top">Jenis PO</th>
                      <th valign="top">Nama Principle</th>


                    </tr>
                  </thead>
                  <?php
                  $d0 = mysqli_fetch_array(mysqli_query($koneksi, "select *,barang_pesan_detail.id as idd from barang_gudang,barang_pesan_detail,barang_pesan,principle where barang_gudang.id=barang_pesan_detail.barang_gudang_id and barang_pesan.id=barang_pesan_detail.barang_pesan_id and principle.id=barang_pesan.principle_id and barang_pesan.id=" . $_GET['id'] . ""));
                  ?>
                  <tr>
                    <td><?php echo date("d/m/Y", strtotime($d0['tgl_po_pesan'])); ?></td>
                    <td><?php echo $d0['no_po_pesan']; ?></td>
                    <td><?php echo $d0['jenis_po']; ?></td>
                    <td><?php echo $d0['nama_principle']; ?></td>

                  </tr>
                </table>
              </div>
              <br />
              <div class="table-responsive">
                <table width="100%" id="example1" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th><strong>Nama Alkes</strong></th>
                      <th>Merk</th>

                      <th><strong>Tipe</strong></th>
                      <th><strong>Belum Mutasi</strong></th>
                      <th>Sudah Mutasi</th>
                      <th><strong>Harga</strong></th>
                      <th>Diskon</th>
                      <th><strong>Total</strong></th>
                      <th>#</th>
                    </tr>
                  </thead>
                  <?php
                  $q = mysqli_query($koneksi, "select *,barang_pesan_detail.id as idd from barang_gudang,barang_pesan_detail,barang_pesan where barang_gudang.id=barang_pesan_detail.barang_gudang_id and barang_pesan.id=barang_pesan_detail.barang_pesan_id and barang_pesan.id=" . $_GET['id'] . "");
                  $no = 0;
                  while ($d = mysqli_fetch_array($q)) {
                    $no++;
                  ?>
                    <tr>
                      <td><?php echo $d['nama_brg']; ?></td>
                      <td><?php echo $d['merk_brg']; ?></td>
                      <td><?php echo $d['tipe_brg']; ?></td>
                      <td><?php
                          $stok_sudah_mutasi = mysqli_fetch_array(mysqli_query($koneksi, "select sum(stok) as stok_sudah from barang_gudang_po where no_po_gudang='" . $d['no_po_pesan'] . "' and barang_gudang_id=" . $d['barang_gudang_id'] . ""));
                          echo $d['qty'] - $stok_sudah_mutasi['stok_sudah']; ?></td>
                      <td><?php echo $stok_sudah_mutasi['stok_sudah']; ?></td>
                      <td><?php
                      $simbol = mysqli_fetch_array(mysqli_query($koneksi, "select jenis_mu,simbol from mata_uang where id=".$d['mata_uang_id'].""));
                      echo $simbol['simbol']." ".number_format($d['harga_perunit'], 0, ',', ',') . ".00"; ?></td>
                      <td align="center"><?php echo $d['diskon'] . " %"; ?></td>
                      <td><?php echo $simbol['simbol']." ".number_format($d['harga_total'], 0, ',', ',') . ".00"; ?></td>
                      <td align="center">
                        <?php

                        if ($d['qty'] - $stok_sudah_mutasi['stok_sudah'] > 0) { ?>
                          <a href="index.php?page=simpan_tambah_ke_stok&id_pesan=<?php echo $_GET['id']; ?>&id=<?php echo $d['barang_gudang_id']; ?>&id_detail=<?php echo $d['idd']; ?>&stok=<?php echo $d['qty'] - $stok_sudah_mutasi['stok_sudah'] ?>"><small data-toggle="tooltip" title="Mutasi & Tambah Ke Stok" class="label bg-green"><span class="fa fa-share"></span>Masukkan Stok</small></a>
                        <?php } else {
                          echo "Sudah Masuk Stok"; ?>
                          <!--<br />
    <a href="index.php?page=mutasi&batal_mutasi=1&id=<?php echo $_GET['id']; ?>&id_gudang=<?php echo $d['barang_gudang_id']; ?>&id_pesan_detail=<?php echo $d['idd']; ?>&stok=<?php echo $stok_sudah_mutasi['stok_sudah']; ?>" onclick="return confirm('Anda Yakin Ingin Membatalkan Mutasi Barang Ini ?')"><small data-toggle="tooltip" title="Batalkan Mutasi" class="label bg-red"><span class="fa fa-close"></span> Batalkan Mutasi</small></a>
    -->
                        <?php
                        }
                        ?>
                        <?php if ($stok_sudah_mutasi['stok_sudah'] != '') { ?>
                          <br />
                          <a href="index.php?page=detail_mutasi&id=<?php echo $_GET['id']; ?>&id_gudang=<?php echo $d['barang_gudang_id']; ?>&id_detail=<?php echo $d['idd']; ?>"><small data-toggle="tooltip" title="Riwayat Mutasi" class="label bg-blue"><span class="fa fa-calendar"></span> &nbsp;Riwayat Mutasi</small></a>
                        <?php } ?>
                      </td>
                    </tr>
                  <?php } ?>
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
      <section class="col-lg-6 connectedSortable">
        <!-- Custom tabs (Charts with tabs)-->
        <!-- /.nav-tabs-custom -->

        <!-- Chat box -->
        <!-- /.box (chat box) -->

        <!-- TO DO List -->
        <!-- /.box -->

        <!-- quick email widget -->
      </section>
      <!-- /.Left col -->
      <!-- right col (We are only adding the ID to make the widgets sortable)-->
      <section class="col-lg-6 connectedSortable">
        <!-- Custom tabs (Charts with tabs)-->
        <!-- /.nav-tabs-custom -->

        <!-- Chat box -->
        <!-- /.box (chat box) -->

        <!-- TO DO List -->
        <!-- /.box -->

        <!-- quick email widget -->
      </section>
      <!-- right col -->
    </div>
    <!-- /.row (main row) -->

  </section>
  <!-- /.content -->
</div>
<?php
$d_1 = mysqli_fetch_array(mysqli_query($koneksi, "select * from barang_gudang_detail,barang_gudang_po where barang_gudang_po.id=barang_gudang_detail.barang_gudang_po_id and barang_gudang_detail.id=" . $_GET['detail'] . ""));

if (isset($_POST['ubah_detail'])) {
  $u = mysqli_query($koneksi, "update barang_gudang_detail set no_bath='" . $_POST['no_bath'] . "', no_lot='" . $_POST['no_lot'] . "', no_seri_brg='" . $_POST['no_seri'] . "' where id=" . $_GET['detail'] . "");
  if ($u) {
    echo "<script type='text/javascript'>
		  window.location='index.php?page=ubah_barang_masuk&id=$_GET[id]'
		</script>";
  }
}
?>
<div id="open_detail" class="modalDialog">
  <div>
    <a href="#" title="Close" class="close">X</a>
    <br />
    <form method="post">
      <label>No. Bath</label>
      <input name="no_bath" class="form-control" type="text" placeholder="" value="<?php echo $d_1['no_bath']; ?>"><br />
      <label>No. Lot</label>
      <input name="no_lot" class="form-control" type="text" placeholder="" value="<?php echo $d_1['no_lot']; ?>"><br />
      <label>No. Seri</label>
      <input name="no_seri" class="form-control" type="text" placeholder="" value="<?php echo $d_1['no_seri_brg']; ?>"><br />
      <input id="buttonn" name="ubah_detail" type="submit" value="Ubah" />
    </form>
  </div>
</div>
<?php
if (isset($_POST['tambah_detail'])) {
  $tmbh = mysqli_query($koneksi, "insert into barang_gudang_detail values('','" . $_GET['id'] . "','" . $_POST['no_bath_t'] . "','" . $_POST['no_lot_t'] . "','" . $_POST['no_seri_t'] . "','0')");
  if ($tmbh) {
    mysqli_query($koneksi, "update barang_gudang set stok=stok+1 where id=" . $_GET['id'] . "");
    echo "<script type='text/javascript'>
		  window.location='index.php?page=ubah_barang_masuk&id=$_GET[id]'
		</script>";
  }
}
?>
<div id="open_tambah_detail" class="modalDialog">
  <div>
    <a href="#" title="Close" class="close">X</a>
    <br />
    <form method="post">

      <label>No. Bath</label>
      <input name="no_bath_t" class="form-control" type="text" placeholder="" value=""><br />
      <label>No. Lot</label>
      <input name="no_lot_t" class="form-control" type="text" placeholder="" value=""><br />
      <label>No. Seri</label>
      <input name="no_seri_t" class="form-control" type="text" placeholder="" value=""><br />
      <input id="buttonn" name="tambah_detail" type="submit" value="Tambah" />
    </form>
  </div>
</div>

<?php
if (isset($_POST['simpan_ubah_baru'])) {
  $sel = mysqli_query($koneksi, "insert into principle values('','" . $_POST['nama_princ'] . "','" . $_POST['alamat_princ'] . "','" . $_POST['telp_princ'] . "','" . $_POST['fax_princ'] . "','" . $_POST['attn_princ'] . "')");
  $max = mysqli_fetch_array(mysqli_query($koneksi, "select max(id) as id_max from principle"));
  $nilai_m = $max['id_max'];
  if ($sel) {
    $upd_brg_pesan = mysqli_query($koneksi, "update barang_pesan set principle_id=$nilai_m where id=$_GET[id]");
    echo "<script type='text/javascript'>
		 window.location='index.php?page=ubah_pembelian_alkes&id=$_GET[id]'
		</script>";
  }
}
?>
<div id="openBaru" class="modalDialog">
  <div>
    <a href="#" title="Close" class="close">X</a>
    <br />
    <form method="post">

      <label>Nama Principle</label><input name="nama_princ" type="text" class="form-control" placeholder="" value="">

      <label>Alamat Principle</label>
      <textarea name="alamat_princ" rows="6" class="form-control" placeholder=""></textarea>

      <label>Telp. Principle</label>
      <input name="telp_princ" type="text" class="form-control" placeholder="" value="">

      <label>Fax. Principle</label>
      <input name="fax_princ" type="text" class="form-control" placeholder="" value="">
      <label>Attn</label>
      <input name="attn_princ" type="text" class="form-control" placeholder="" value="">

      <input id="buttonn" name="simpan_ubah_baru" type="submit" value="Simpan" />
    </form>
  </div>
</div>

<?php
if (isset($_POST['simpan_ubah_sudah_ada'])) {
  $upd_brg_pesan = mysqli_query($koneksi, "update barang_pesan set principle_id=" . $_POST['id_akse'] . " where id=$_GET[id]");
  if ($upd_brg_pesan) {

    echo "<script type='text/javascript'>
		 window.location='index.php?page=ubah_pembelian_alkes&id=$_GET[id]'
		</script>";
  }
}
?>
<div id="openSudahAda" class="modalDialog">
  <div>
    <a href="#" title="Close" class="close">X</a>
    <br />
    <form method="post">

      Nama Principle
      <select name="id_akse" id="id_akse" class="form-control" required onchange="changeValue(this.value)">
        <option>-- Pilih Principle</option>
        <?php
        $q = mysqli_query($koneksi, "select * from principle group by nama_principle order by nama_principle ASC");
        $jsArray = "var dtBrg = new Array();
";
        while ($d = mysqli_fetch_array($q)) { ?>
          <option value="<?php echo $d['id']; ?>" <?php if ($d['id'] == $data['id_principle']) {
                                                    echo "selected";
                                                  } ?>><?php echo $d['nama_principle']; ?></option>
        <?php
          $jsArray .= "dtBrg['" . $d['id'] . "'] = {alamat_princ:'" . addslashes($d['alamat_principle']) . "',
						telp_princ:'" . addslashes($d['telp_principle']) . "',
						fax_princ:'" . addslashes($d['fax_principle']) . "',
						attn_princ:'" . addslashes($d['attn_principle']) . "'
						};";
        } ?>

      </select>
      Alamat Principle
      <textarea name="alamat_princ" rows="4" disabled="disabled" class="form-control" id="alamat_princ" placeholder=""><?php echo $data['alamat_principle']; ?></textarea>
      Telp. Principle
      <input name="telp_princ" type="text" disabled="disabled" class="form-control" id="telp_princ" placeholder="" value="<?php echo $data['telp_principle']; ?>">
      Fax. Principle
      <input name="fax_princ" type="text" disabled="disabled" class="form-control" id="fax_princ" placeholder="" value="<?php echo $data['fax_principle']; ?>">
      Attn Principle
      <input name="attn_princ" type="text" disabled="disabled" class="form-control" id="attn_princ" placeholder="" value="<?php echo $data['attn_principle']; ?>">
      <script type="text/javascript">
        <?php
        echo $jsArray;
        ?>

        function changeValue(id_akse) {
          document.getElementById('alamat_princ').value = dtBrg[id_akse].alamat_princ;
          document.getElementById('telp_princ').value = dtBrg[id_akse].telp_princ;
          document.getElementById('fax_princ').value = dtBrg[id_akse].fax_princ;
          document.getElementById('attn_princ').value = dtBrg[id_akse].attn_princ;
        };
      </script>

      <input id="buttonn" name="simpan_ubah_sudah_ada" type="submit" value="Simpan" />
    </form>
  </div>
</div>