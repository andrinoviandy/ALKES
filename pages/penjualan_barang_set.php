<?php
if (isset($_GET['id_batal'])) {
  $sql = mysqli_fetch_array(mysqli_query($koneksi, "select *,utang_piutang_set.id as id_up from barang_dijual_set,utang_piutang_set where barang_dijual_set.no_faktur_jual = utang_piutang_set.no_faktur_no_po_set and barang_dijual_set.id=".$_GET['id_batal'].""));
  //while ($da = mysqli_fetch_array($sql)) {
  //$update=mysqli_query($koneksi, "update barang_gudang_set_2 set qty=qty+$da[qty_jual] where id=".$da['barang_gudang_set2_id']."");
  //}
  $sql2 = mysqli_num_rows(mysqli_query($koneksi, "select * from utang_piutang_set_bayar where utang_piutang_set_id = ".$sql['id_up'].""));
  if ($sql2 != 0) {
	  echo "<script type='text/javascript'>alert('Maaf Sudah Ada Transaksi Pembayaran !');
		history.back();
		</script>";
  } else {
  $del0 = mysqli_query($koneksi, "delete from utang_piutang_set where id = ".$sql['id_up']."");
  $del1 = mysqli_query($koneksi, "delete from barang_dijual_qty_set,barang_dijual_qty_set_detail where barang_dijual_qty_set.id = barang_dijual_qty_set_detail.barang_dijual_qty_set_id and barang_dijual_set_id=" . $_GET['id_batal'] . "");
  $del2 = mysqli_query($koneksi, "delete from barang_dijual_set where id=" . $_GET['id_batal'] . "");

  if ($del1 and $del2) {
    echo "<script>window.location='index.php?page=penjualan_barang_set;</script>";
  } else {
    echo "<script type='text/javascript'>alert('Maaf Data Tidak Dapat DI Hapus !');
		history.back();
		</script>";
  }
  } 
  /*$se = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_dijual_detail where status_kirim=1 and barang_dijual_id=".$_GET['id_batal'].""));
	if ($se!=0) {
		echo "<script>alert('Data tidak dapat dibatalkan karena sudah dikirim ! Silakan batalkan proses kirim terlebih dahulu !');
		window.location='index.php?page=jual_barang';
		</script>";
		}
	else {
		$sd = mysqli_query($koneksi, "select * from barang_dijual_detail where status_kirim=0 and barang_dijual_id=".$_GET['id_batal']."");
		while ($da = mysqli_fetch_array($sd)) {
			$upp=mysqli_query($koneksi, "update barang_gudang_detail,barang_gudang set stok_total=stok_total+1, status_terjual=0 where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=".$da['barang_gudang_detail_id']."");
			}
		if ($upp) {
			mysqli_query($koneksi, "delete from barang_dijual_detail where barang_dijual_id=".$_GET['id_batal']."");
			mysqli_query($koneksi, "delete from barang_dijual where id=".$_GET['id_batal']."");
			echo "<script>alert('Pembatalan berhasil !');
		window.location='index.php?page=jual_barang';
		</script>";
			}
			else {
				echo "<script>alert('Pembatalan Gagal !');
		window.location='index.php?page=jual_barang';
		</script>";
				}
		}*/
}
?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Penjualan Barang Set
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Jual Alkes</li>
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
        <div class="box box-info">
          <!-- /.chat -->
          <div class="box-footer">
            <div class="box-body table-responsive no-padding">
              <div class="">
                <!--<a href="index.php?page=tambah_barang_jual">
              <button name="tambah_laporan" class="btn btn-info" type="submit"><span class="fa fa-plus"></span> Jual Alkes</button>
              </a>-->
                <?php if (isset($_SESSION['user_administrator']) or isset($_SESSION['user_admin_keuangan']) or isset($_SESSION['user_admin_gudang']) or isset($_SESSION['adminpoluar'])) { ?>
                  <div class="input-group pull pull-left col-xs-1" style="padding-right:10px">
                    <!--<a href="index.php?page=penjualan_barang_set#openPilihan">-->
                    <a href="index.php?page=jual_barang_set2">
                      <button name="tambah_laporan" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Tambah</button></a>

                  </div>
                  <!--
              <form method="post" action="cetak_marketing.php" target="_blank">
              <div class="input-group pull pull-left col-xs-3">  
                <select class="form-control" name="marketing" style="margin-right:40px">
                <option value="all">All Marketing</option>
                <?php
                  $q = mysqli_query($koneksi, "select marketing,subdis from barang_dijual_set group by marketing order by marketing ASC");
                  while ($d = mysqli_fetch_array($q)) {
                ?>
                <option value="<?php echo $d['marketing']; ?>"><?php echo $d['marketing'] . " / SubDis : " . $d['subdis']; ?></option>
                <?php } ?>
                </select>
                
                <span class="input-group-btn">
                      <button type="submit" name="button_urut" class="btn btn-warning">Cetak</button>
                    </span>
                
              </div>
              </form>
              -->
                <?php } ?>
                <span class="pull pull-right">
                  <!--
              <table>
  <tr>
    <td><strong style="color:#F00">Keterangan</strong> : &nbsp;&nbsp;&nbsp;</td>
    <td valign="top">1. </td>
    <td valign="top">Tanda &quot;<span class="fa fa-plane"></span>&quot; menandakan barang sudah di kirim</td>
  </tr>
</table>-->
                </span>
                <br /><br /><br />

                <!--
              <form method="post" class="">
              <div class="input-group input-group-md col-xs-4 pull pull-right">
                <input type="text" name="cari" placeholder="Keyword....." class="form-control">
                    <span class="input-group-btn">
                      <button type="submit" name="button_cari" class="btn btn-info btn-flat"><i class="fa fa-search"></i> Cari </button>
                    </span>
              </div>
              </form>
              -->


                <table width="100%" id="example1" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th align="center">#</th>
                      <th align="center"><strong>Tanggal Jual</strong></th>
                      <th align="center">No Faktur</th>
                      <th align="center"><strong>Nama Brg<span class="pull pull-right">Qty Jual (Set)</span></strong></th>
                      <th align="center"><strong>Dinas/RS/Puskemas/Klinik</strong></th>
                      <th align="center">Nama Pemakai</th>

                      <th align="center">Diskon</th>
                      <th align="center">PPN</th>
                      <th align="center">Marketing</th>
                      <th align="center">SubDis</th>
                      <th align="center"><strong>Aksi</strong></th>
                    </tr>
                  </thead>
                  <?php

                  // membuka file JSON
                  $file = file_get_contents("http://localhost/ALKES/json/penjualan_barang_set.php");
                  $json = json_decode($file, true);
                  $jml = count($json);
                  for ($i = 0; $i < $jml; $i++) {
                    //echo "Nama Barang ke-".$i." : " . $json[$i]['nama_brg'] . "<br />";
                    //echo 'Nama Anggota ke-3 : ' . $json['2']['nama_brg'];
                  ?>
                    <tr>
                      <td align="center"><?php echo $i + 1; ?></td>
                      <td>
                        <?php if ($json[$i]['tgl_jual'] != '0000-00-00') {
                          echo date("d F Y", strtotime($json[$i]['tgl_jual']));
                        }
                        ?>
                      </td>
                      <td><?php echo $json[$i]['no_faktur_jual'];
                          ?></td>
                      <td>
                        <table width="100%" class="table">
                          <?php
                          $q2 = mysqli_query($koneksi, "select * from barang_dijual_qty_set,barang_gudang_set where barang_gudang_set.id=barang_dijual_qty_set.barang_gudang_set_id and barang_dijual_set_id=" . $json[$i]['idd'] . "");
                          $n = 0;
                          while ($d1 = mysqli_fetch_array($q2)) {
                            $n++;
                            if ($n % 2 == 0) {
                               $col = "bg-white";
                            } else {
                                $col = "bg-gray";
                            }
                          ?>
                            <tr class="<?php echo $col; ?>">
                              <td align="left"><?php echo $d1['nama_brg']; ?></td>
                              <td align="left"><?php echo $d1['qty_set']; ?></td>
                            </tr>
                          <?php } ?>
                        </table>
                      </td>
                      <td><a href="#" data-toggle="modal" data-target="#modal-pembeli<?php echo $json[$i]['idd']; ?>" style="color:#060" title="Klik Untuk Lebih Lengkap"><?php
                                                                                                                                                                          $data_pem = mysqli_fetch_array(mysqli_query($koneksi, "select * from barang_dijual_set,pembeli,pemakai where pembeli.id=barang_dijual_set.pembeli_id and pemakai.id=barang_dijual_set.pemakai_id and barang_dijual_set.id=" . $json[$i]['idd'] . ""));
                                                                                                                                                                          echo $data_pem['nama_pembeli']; ?></a></td>
                      <td><?php echo $data_pem['nama_pemakai']; ?></td>

                      <td align="center"><?php echo $json[$i]['diskon_jual'] . " %"; ?></td>
                      <td align="center"><?php echo $json[$i]['ppn_jual'] . " %"; ?></td>
                      <td align="center"><?php echo $json[$i]['marketing']; ?></td>
                      <td align="center"><?php echo $json[$i]['subdis']; ?></td>
                      <td align="center">
                        <?php
                        if (!isset($_SESSION['user_admin_keuangan'])) { ?>
                          <!-- <a href="index.php?page=penjualan_barang_set&id=<?php echo $json[$i]['idd']; ?>#openKirim"> -->
                          <a data-toggle="modal" data-target="#modal-kirim<?php echo $json[$i]['idd']; ?>">
                            <button data-toggle=" tooltip" title="Kirim Alkes" class="label bg-blue">Kirim</button>
                          </a>
                          <a href="index.php?page=detail_jual_barang_set&id=<?php echo $json[$i]['idd']; ?>"><small data-toggle="tooltip" title="Detail Kirim" class="label bg-yellow">Lihat</small></a><br />
                        <?php } ?>
                        <?php if (isset($_SESSION['user_administrator']) && isset($_SESSION['pass_administrator']) or isset($_SESSION['user_admin_keuangan']) && isset($_SESSION['pass_admin_keuangan'])) { ?>
                          <!--<a href="pages/delete_barang_jual.php?id_hapus=<?php echo $json[$i]['idd']; ?>" onclick="return confirm('Anda Yakin Akan Menghapus Item Ini ?')"><span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span></a>&nbsp;-->
                          <a href="index.php?page=ubah_barang_jual_set&id=<?php echo $json[$i]['idd']; ?>"><span data-toggle="tooltip" title="Ubah" class="fa fa-edit"></span></a>&nbsp;<a href="index.php?page=penjualan_barang_set&id_batal=<?php echo $json[$i]['idd']; ?>" onclick="return confirm('Yakin Akan Membatalkan Penjualan Item Ini ? . Proses ini akan berhasil jika barang belum dikirim !')"><span data-toggle="tooltip" title="Batalkan Penjualan" class="fa fa-close"></span></a><br /><?php } ?><?php if (!isset($_SESSION['user_admin_gudang'])) { ?><a target="blank" href="cetak_faktur_penjualan_set.php?id=<?php echo $json[$i]['idd']; ?>"><span data-toggle="tooltip" title="Cetak Faktur Penjualan" class="glyphicon glyphicon-print"></span></a><?php } ?>

                      </td>
                    </tr>
                    <div class="modal fade" id="modal-pembeli<?php echo $json[$i]['idd']; ?>">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" align="center">Data RS/Dinas/Klinik/Dll</h4>
                          </div>
                          <form method="post">
                            <div class="modal-body">
                              <p align="justify">
                                <?php
                                echo "<b>Nama RS/Dinas/Klinik/Dll :</b> <br/>" . $data_pem['nama_pembeli']; ?>
                                <hr />
                                <?php echo "<b>Alamat :</b> <br/>" . str_replace("<br>", "", $data_pem['jalan']); ?>
                                <hr />
                                <?php echo "<b>Kontak :</b> <br/>" . $data_pem['kontak_rs']; ?>

                              </p>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                            </div>
                          </form>
                        </div>
                        <!-- /.modal-content -->
                      </div>
                      <!-- /.modal-dialog -->
                    </div>
                    <div class="modal fade" id="modal-kirim<?php echo $json[$i]['idd']; ?>">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" align="center">Pengiriman Barang</h4>
                          </div>
                          <form method="post">
                          <input type="hidden" name="id_ubah" value="<?php echo $json[$i]['idd']; ?>"/>
                            <div class="modal-body">
                              <?php
                              $q5 = mysqli_query($koneksi, "select * from barang_dijual_set where id=" . $_GET['id'] . "");
                              $d4 = mysqli_num_rows($q4);
                              ?>
                              <label>Nama Paket</label>
                              <input id="input" type="text" placeholder="" name="nama_paket" required>
                              <label>No. Pengiriman</label>
                              <input id="input" type="text" placeholder="" name="no_peng" required>
                              <label>Tanggal Pengiriman</label>
                              <input id="input" type="date" placeholder="" name="tgl_kirim" required>
                              <label>No. Faktur</label>
                              <input id="input" type="text" placeholder="" readonly="readonly" name="no_po" value="<?php echo $json[$i]['no_faktur_jual'] ?>">
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                              <button class="btn btn-success" name="kirim_barang" type="submit">Next</button>
                            </div>
                          </form>
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
if (isset($_POST['kirim_barang'])) {
  mysqli_query($koneksi, "delete from barang_dikirim_detail_set_hash where akun_id=" . $_SESSION['id'] . "");
  $_SESSION['nama_paket'] = $_POST['nama_paket'];
  $_SESSION['no_pengiriman'] = $_POST['no_peng'];
  $_SESSION['tgl_pengiriman'] = $_POST['tgl_kirim'];
  $_SESSION['no_po'] = $_POST['no_po'];
  echo "<script type='text/javascript'>
		window.location='index.php?page=simpan_kirim_barang_set&id=" . $_POST['id_ubah'] . "';
		</script>";
}
if (isset($_POST['kirim2_barang'])) {
  if ($_POST['id_alkes'] == 'all') {
    $update = mysqli_query($koneksi, "insert into barang_dikirim values('','" . $_POST['nama_paket'] . "','" . $_POST['no_peng'] . "','" . $_POST['tgl_kirim'] . "','" . $_POST['no_po'] . "','0000-00-00')");
    $max = mysqli_fetch_array(mysqli_query($koneksi, "select max(id) as id_kirim from barang_dikirim"));
    $sel = mysqli_query($koneksi, "select * from barang_dijual_detail where barang_dijual_id=" . $_GET['id'] . "");
    $tot_sel = mysqli_num_rows($sel);
    while ($data_sel = mysqli_fetch_array($sel)) {
      $ins = mysqli_query($koneksi, "insert into barang_dikirim_detail values('','" . $max['id_kirim'] . "','" . $data_sel['id'] . "')");
    }

    if ($update and $ins) {
      mysqli_query($koneksi, "update barang_dijual_detail set status_kirim=1 where barang_dijual_id=" . $_GET['id'] . "");

      echo "<script type='text/javascript'>
		alert('Data Berhasil Di Simpan !');
		window.location='index.php?page=kirim_barang&id_krm=" . $_GET['id'] . "';
		</script>";
    } else {
      echo "<script type='text/javascript'>
		alert('Gagal Disimpan');
		</script>";
    }
  } else {
    $update = mysqli_query($koneksi, "insert into barang_dikirim values('','" . $_POST['nama_paket'] . "','" . $_POST['no_peng'] . "','" . $_POST['tgl_kirim'] . "','" . $_POST['no_po'] . "','0000-00-00')");
    $max = mysqli_fetch_array(mysqli_query($koneksi, "select max(id) as id_kirim from barang_dikirim"));
    $ins = mysqli_query($koneksi, "insert into barang_dikirim_detail values('','" . $max['id_kirim'] . "','" . $_POST['id_alkes'] . "')");
    if ($update and $ins) {
      mysqli_query($koneksi, "update barang_dijual_detail set status_kirim=1 where id=" . $_POST['id_alkes'] . "");
      echo "<script type='text/javascript'>
		alert('Data Berhasil Di Simpan !');
		window.location='index.php?page=kirim_barang&id_krm=" . $_GET['id'] . "';
		</script>";
    } else {
      echo "<script type='text/javascript'>
		alert('Gagal Disimpan');
		</script>";
    }
  }
}
?>