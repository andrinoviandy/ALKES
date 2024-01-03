<?php
if (isset($_GET['id_b_s'])) {
  $q = mysqli_query($koneksi, "update barang_dikirim_set set tgl_sampai='' where id=" . $_GET['id_b_s'] . "");
  if ($q) {
    echo "<script>window.location='index.php?page=pengiriman_barang_set'</script>";
  }
}
if (isset($_GET['id_hapus'])) {
	$q = mysqli_query($koneksi, "select * from barang_dikirim_set_detail where barang_dikirim_set_id = ".$_GET['id_hapus']."");
	while ($d = mysqli_fetch_array($q)) {
		$up = mysqli_query($koneksi, "update barang_gudang_detail,barang_gudang set stok_total=stok_total+1,barang_gudang_detail.status_kirim=0 where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=" . $d['barang_gudang_detail_id'] . "");
		$up2 = mysqli_query($koneksi, "update barang_dijual_qty_set set barang_dijual_qty_set.status_kirim=0 where id=" . $d['barang_dijual_qty_set_id'] . "");
		}
  $del1 = mysqli_query($koneksi, "delete from barang_dikirim_set_detail where barang_dikirim_set_id=" . $_GET['id_hapus'] . "");
  $del2 = mysqli_query($koneksi, "delete from barang_dikirim_set where id=" . $_GET['id_hapus'] . "");
  if ($up and $up2 and $del1 and $del2) {
    echo "<script>
alert('Data berhasil di hapus !');		window.location='index.php?page=pengiriman_barang_set'</script>";
  } else {
    echo "<script>
		alert('Data Gagal di hapus !');
		window.location='index.php?page=pengiriman_barang_set'</script>";
  }
  //$q2 = mysqli_query($koneksi, "select * from barang_dikirim,barang_dikirm_detail,barang_gudang_detail,barang_gudang where barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dikirim.id=".$_GET['id_hapus']."");
}
?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Pengiriman Alkes
    (Set)</h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Kirim Alkes</li>
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
        <div class="box box-warning">
          <!-- /.chat -->
          <div class="box-footer">
            <div class="box-body table-responsive no-padding">
              <div class="">
                </span>
                <br />
                <table width="100%" id="example1" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th width="4%" align="center">&nbsp;</th>

                      <th width="12%" bgcolor="#99FFCC">Tanggal Kirim</th>
                      <th width="11%">Nama Paket</th>

                      <th width="16%">No Surat Jalan</th>
                      <th width="8%">No PO</th>
                      <th width="9%"><strong>Barang</strong></th>
                      <th width="11%"><strong>Tempat Tujuan</strong></th>
                      <th width="10%">Kontak</th>
                      <th width="12%" bgcolor="#99FFCC"><strong>Tanggal Sampai</strong></th>
                      <th width="7%" align="center"><strong>Aksi</strong></th>
                    </tr>
                  </thead>
                  <?php
                  // membuka file JSON
                  $file = file_get_contents("http://localhost/ALKES/json/kirim_barang_set.php");
                  $json = json_decode($file, true);
                  $jml = count($json);
                  for ($i = 0; $i < $jml; $i++) {
                    //echo "Nama Barang ke-".$i." : " . $json[$i]['nama_brg'] . "<br />";
                    //echo 'Nama Anggota ke-3 : ' . $json['2']['nama_brg'];
                  ?>
                    <tr>
                      <td align="center"><?php echo $i + 1; ?></td>
                      <td bgcolor="#99FFCC"><?php echo date("d M Y", strtotime($json[$i]['tgl_kirim'])); ?></td>
                      <td><?php echo $json[$i]['nama_paket']; ?></td>

                      <td><?php echo $json[$i]['no_pengiriman']; ?></td>
                      <td><?php echo $json[$i]['po_no']; ?></td>
                      <td>
                        <a href="#" data-toggle="modal" data-target="#modal-detailbarang<?php echo $json[$i]['idd']; ?>"><small data-toggle="tooltip" title="Detail Barang" class="label bg-primary"><span class="fa fa-folder-open"></span></small></a>
                      </td>
                      <td><?php
                          $data3 = mysqli_fetch_array(mysqli_query($koneksi, "select nama_pembeli,kontak_rs from pembeli,barang_dijual_set,barang_dikirim_set where pembeli.id=barang_dijual_set.pembeli_id and barang_dijual_set.id=barang_dikirim_set.barang_dijual_set_id and barang_dikirim_set.id=" . $json[$i]['idd'] . ""));
                          echo $data3['nama_pembeli']; ?></td>
                      <td><?php echo $data3['kontak_rs']; ?></td>

                      <?php
                      if ($json[$i]['tgl_sampai'] != 0000 - 00 - 00) {
                        $bg = "#99FFCC";
                      } else {
                        $bg = "red";
                      }
                      ?>
                      <td bgcolor=<?php echo $bg; ?>>
                        <?php
                        if ($json[$i]['tgl_sampai'] != 0000 - 00 - 00) {
                          echo date("d M Y", strtotime($json[$i]['tgl_sampai']));
                        } else {
                          echo "-";
                        } ?>
                      </td>
                      <td align="center">
                        <?php if (!isset($_SESSION['user_cs'])) { ?>
                          <?php if (isset($_SESSION['user_administrator']) && isset($_SESSION['pass_administrator']) or isset($_SESSION['user_admin_gudang'])) { ?>
                            <a href="index.php?page=pengiriman_barang_set&id_hapus=<?php echo $json[$i]['idd']; ?>" onclick="return confirm('Anda Yakin Akan Menghapus Item Ini ?')"><span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span></a>&nbsp;&nbsp;<a href="index.php?page=riwayat_panggilan_set&id=<?php echo $json[$i]['idd']; ?>">
                              <span class="fa fa-phone-square"></span>
                            </a>&nbsp;
                          <?php } ?>
                          <a href="index.php?page=ubah_barang_kirim_set&id=<?php echo $json[$i]['idd']; ?>"><span data-toggle="tooltip" title="Ubah" class="fa fa-edit"></span></a><br />

                          <a href="index.php?page=pengiriman_barang_set&id=<?php echo $json[$i]['idd']; ?>#openSampai">
                            <span data-toggle="tooltip" title="Status : Sudah Sampai" class="fa fa-calendar-check-o"></span>
                          </a>&nbsp;&nbsp;

                          <a href="index.php?page=pengiriman_barang_set&id_b_s=<?php echo $json[$i]['idd']; ?>" onclick="return confirm('Yakin Akan Membatalkan Tanggal Sampai Barang !')">
                            <span data-toggle="tooltip" title="Status : Belum Sampai" class="fa fa-calendar-times-o"></span>
                          </a><br />
                          <a href="cetak_surat_jalan_set.php?id=<?php echo $json[$i]['idd']; ?>" target="_blank"><span data-toggle="tooltip" title="Cetak Surat Jalan" class="fa fa-print"></span></a> <?php } else { ?>
                          <a href="index.php?page=riwayat_panggilan&id=<?php echo $json[$i]['idd']; ?>">
                            <span class="fa fa-phone-square"></span>
                          </a>
                        <?php } ?>
                      </td>
                    </tr>
                    <div class="modal fade" id="modal-detailbarang<?php echo $json[$i]['idd'] ?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Rincian Barang Satuan</h4>
      </div>
        <div class="modal-body">
          <div class="box-title">
		  No.SJ : <?php echo $json[$i]['no_pengiriman']; ?><div class="pull pull-right">No.PO : <?php echo $json[$i]['po_no']; ?></div></div>
          <div class="box box-body col-lg-12">
          <div class="row">
          <div class="col-lg-4 bg-info" style="padding:5px; border:1px solid;"><strong>Nama Barang (Set)</strong></div>
          <div align="center" class="col-lg-4 bg-info" style="padding:5px; border:1px solid"><strong>Barang (Satuan)</strong></div>
          <div align="center" class="col-lg-4 bg-info" style="padding:5px; border:1px solid"><strong>No. Seri</strong></div>
          </div>
          <?php
          $q_satuan = mysqli_query($koneksi, "select *, barang_gudang_set.nama_brg as nama_set, barang_gudang.nama_brg as nama_brg_satuan from barang_dikirim_set_detail, barang_gudang_set, barang_gudang, barang_gudang_detail, barang_dijual_qty_set where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dikirim_set_detail.barang_gudang_detail_id and barang_gudang_set.id=barang_dijual_qty_set.barang_gudang_set_id and barang_dikirim_set_id= ".$json[$i]['idd']."");
		  while ($dt = mysqli_fetch_array($q_satuan)) {
		  ?>
          <div class="row">
          <div class="col-lg-4" style="padding:5px; border:1px solid"><?php echo $dt['nama_set'] ?>&nbsp;</div>
          <div align="center" class="col-lg-4" style="padding:5px; border:1px solid"><?php echo $dt['nama_brg_satuan'] ?>&nbsp;</div>
          <div align="center" class="col-lg-4" style="padding:5px; border:1px solid"><?php echo $dt['no_seri_brg'] ?>&nbsp;</div>
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
if (isset($_POST['sampai_barang'])) {
  $tgl_k = mysqli_fetch_array(mysqli_query($koneksi, "select * from barang_dikirim_set where id=" . $_GET['id'] . ""));
  if ($_POST['tgl_sampai'] >= $tgl_k['tgl_kirim']) {
    $que = mysqli_query($koneksi, "update barang_dikirim_set set tgl_sampai='" . $_POST['tgl_sampai'] . "' where id=" . $_GET['id'] . "");
    if ($que) {
      //mysqli_query($koneksi, "insert into uji_f_i values('','".$_GET['id']."','0','0','')");
      echo "<script type='text/javascript'>
		  window.location='index.php?page=pengiriman_barang_set'
		  </script>";
    }
  } else {
    echo "<script type='text/javascript'>alert('Tanggal Sampai Tidak Boleh Kurang Dari Tanggal Pengiriman !');
		  </script>";
  }
}
?>
<div id="openSampai" class="modalDialog">
  <div>
    <a href="#" title="Close" class="close">X</a>
    <h3 align="center">Status Alkes</h3>
    <?php $d = mysqli_fetch_array(mysqli_query($koneksi, "select * from barang_dikirim_set where id=" . $_GET['id'] . "")); ?>
    <form method="post">
      <label>Tanggal Sampai</label>
      <input id="input" type="date" placeholder="" name="tgl_sampai" required value="<?php echo $d['tgl_sampai']; ?>">
      <!--<label>Keterangan</label>
     <textarea rows="4" id="input" type="text" placeholder="Keterangan" name="keterangan"><?php echo $d['ket_brg']; ?></textarea>-->
      <button id="buttonn" name="sampai_barang" type="submit">Simpan</button>
    </form>
  </div>
</div>
<?php
$q = mysqli_fetch_array(mysqli_query($koneksi, "select * from pembeli,alamat_provinsi,alamat_kabupaten,alamat_kecamatan where alamat_provinsi.id=pembeli.provinsi_id and alamat_kabupaten.id=pembeli.kabupaten_id and alamat_kecamatan.id=pembeli.kecamatan_id and pembeli.id=" . $_GET['id'] . ""))
?>
<div id="openDetailPembeli" class="modalDialog">
  <div>
    <a href="#" title="Close" class="close">X</a>
    <h3 align="center">Detail RS/Dinas/Klinik/Dll</h3>
    <form method="post">
      <label>Nama RS/Dinas/Puskesmas/Klinik/Dll</label>
      <input id="input" type="text" placeholder="" name="no_peng" readonly="readonly" disabled value="<?php echo $q['nama_pembeli']; ?>">
      <label>Alamat</label>
      <textarea rows="4" id="input" placeholder="" name="no_peng" readonly="readonly" disabled><?php echo "Kelurahan " . $q['kelurahan_id'] . "\nKecamatan " . $q['nama_kecamatan'] . " \nKabupaten " . $q['nama_kabupaten'] . "\nProvinsi " . $q['nama_provinsi']; ?></textarea>
      <label>Kontak</label>
      <input id="input" type="text" placeholder="" name="no_po" readonly="readonly" disabled value="<?php echo $q['kontak_rs']; ?>">
      <br /><br />
    </form>
  </div>
</div>