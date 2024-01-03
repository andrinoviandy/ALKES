<?php
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

    $total1 = mysqli_fetch_array(mysqli_query($koneksi, "select sum(qty*harga_satuan) as total1 from barang_gudang,barang_dijual_qty_hash where barang_gudang.id=barang_dijual_qty_hash.barang_gudang_id and akun_id=" . $_SESSION['id'] . ""));

    $simpan1 = mysqli_query($koneksi, "insert into barang_dijual values('','" . $_SESSION['tgl_jual'] . "','" . $_SESSION['no_faktur'] . "','" . $_SESSION['no_kontrak'] . "','$id_pembeli','$id_pemakai','" . $_SESSION['marketing'] . "','" . $_SESSION['subdis'] . "','" . $_SESSION['ongkir'] . "','" . $_SESSION['diskon'] . "','" . $total1['total1'] . "','" . $_SESSION['ppn'] . "','" . $_SESSION['pph'] . "','" . $_SESSION['zakat'] . "','" . $_SESSION['biaya_bank'] . "','" . str_replace(".", "", $_POST['nominal']) . "','1','" . $_SESSION['status_po'] . "')");

    $d1 = mysqli_fetch_array(mysqli_query($koneksi, "select max(id) as id_jual from barang_dijual"));
    $id_jual = $d1['id_jual'];
    //simpan barang pesan detail
    $q2 = mysqli_query($koneksi, "select * from barang_dijual_qty_hash where akun_id=" . $_SESSION['id'] . "");
    while ($d2 = mysqli_fetch_array($q2)) {
      $simpan2 = mysqli_query($koneksi, "insert into barang_dijual_qty values('','$id_jual','" . $d2['barang_gudang_id'] . "','" . $d2['harga_jual_saat_itu'] . "','" . $d2['qty'] . "','" . $d2['okr'] . "','0')");
      //$up=mysqli_query($koneksi, "update barang_gudang_detail set status_terjual=1 where id=".$d2['barang_gudang_detail_id']."");
      //$up2=mysqli_query($koneksi, "update barang_gudang,barang_gudang_detail set stok_total=stok_total-1 where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=".$d2['barang_gudang_detail_id']."");
    }
    if ($simpan1 and $simpan2) {
      if ($_SESSION['status_po'] == 1) {
        $Result = mysqli_query($koneksi, "insert into utang_piutang values('','Piutang','" . $_SESSION['no_faktur'] . "','" . $_POST['tgl_input'] . "','" . $_POST['jatuh_tempo'] . "','" . str_replace(".", "", $_POST['nominal']) . "','" . $_POST['klien'] . "','" . $_POST['deskripsi'] . "','0')");
      } elseif ($_SESSION['status_po'] == 0) {
        $Result = mysqli_query($koneksi, "insert into utang_piutang values('','Piutang','" . $_SESSION['no_faktur'] . "','" . $_POST['tgl_input'] . "','" . $_POST['jatuh_tempo'] . "','0','" . $_POST['klien'] . "','" . $_POST['deskripsi'] . "','0')");
      }
      mysqli_query($koneksi, "delete from barang_dijual_qty_hash where akun_id=" . $_SESSION['id'] . "");
      echo "<script type='text/javascript'>
	alert('Data Berhasil Di Simpan !');
	window.location='index.php?page=jual_barang_uang'</script>";
      unset($_SESSION['tgl_jual']);
      unset($_SESSION['pembeli']);
      unset($_SESSION['provinsi']);
      unset($_SESSION['kecamatan']);
      unset($_SESSION['kabupaten']);
      unset($_SESSION['kelurahan']);
      unset($_SESSION['alamat']);
      unset($_SESSION['kontak_rs']);
      unset($_SESSION['pemakai']);
      unset($_SESSION['kontak1']);
      unset($_SESSION['kontak2']);
      unset($_SESSION['email']);
      unset($_SESSION['marketing']);
      unset($_SESSION['subdis']);
      unset($_SESSION['no_faktur']);
      unset($_SESSION['no_kontrak']);
      unset($_SESSION['diskon']);
      unset($_SESSION['ppn']);
      unset($_SESSION['ongkir']);
      unset($_SESSION['pph']);
      unset($_SESSION['status_po']);
    }
  } else {
    echo "<script type='text/javascript'>
	alert('Data tidak boleh kosong , silakan tambah terlebih dahulu ! !');
	window.location='index.php?page=simpan_jual_alkes2'</script>";
  }
}

if (isset($_POST['input_ongkir'])) {
  $_SESSION['ongkir'] = str_replace(".", "", $_POST['ongkir']);
  $_SESSION['diskon'] = $_POST['diskon'];
  $_SESSION['ppn'] = $_POST['ppn'];
  $_SESSION['pph'] = $_POST['pph'];
  $_SESSION['zakat'] = $_POST['zakat'];
  $_SESSION['biaya_bank'] = str_replace(".", "", $_POST['biaya_bank']);
  echo "<script>window.location='index.php?page=simpan_jual_alkes2'</script>";
}

if (isset($_POST['input_diskon'])) {
  echo "<script>window.location='index.php?page=simpan_jual_alkes2'</script>";
}

if (isset($_POST['input_ppn'])) {
  echo "<script>window.location='index.php?page=simpan_jual_alkes2'</script>";
}

if (isset($_POST['input_pph'])) {
  echo "<script>window.location='index.php?page=simpan_jual_alkes2'</script>";
}
?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Jual Alkes</h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active"> Jual Alkes</li>
    </ol>
  </section>


  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) --><!-- /.row -->
    <!-- Main row -->
    <div class="row">
      <!-- Left col -->
      <section class="col-lg-12 connectedSortable">
        <!-- Custom tabs (Charts with tabs)--><!-- /.nav-tabs-custom -->

        <!-- Chat box -->
        <div class="box box-success"><!-- /.chat -->
          <div class="box-footer">
            <div class="box-body">
              <div class="">
                <!--<a href="index.php?page=tambah_barang_masuk"><button name="tambah_laporan" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Tambah Barang</button></a>-->
                <div class="table-responsive no-padding">
                  <table width="100%" id="" class="table table-responsive">
                    <thead>
                      <tr>
                        <th colspan="10" align="left">
                          <table width="">
                            <tr valign="top">
                              <td><strong>Marketing </strong></td>
                              <td><strong>&nbsp;:&nbsp;</strong></td>
                              <td><strong><?php echo $_SESSION['marketing']; ?></strong></td>
                              <td><strong> &nbsp;&nbsp;,&nbsp;&nbsp; </strong></td>
                              <td><strong>Sub Distributor </strong></td>
                              <td><strong> &nbsp;:&nbsp; </strong></td>
                              <td><strong><?php echo $_SESSION['subdis']; ?></strong></td>
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
                        <th valign="bottom">&nbsp;</th>
                        <th valign="bottom">&nbsp;</th>
                        <th valign="bottom">&nbsp;</th>
                      </tr>
                      <tr>
                        <th valign="bottom"><strong>Tgl Jual</strong></th>
                        <th valign="bottom">No PO</th>
                        <th valign="bottom">No. Kontrak</th>
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
                      <td><?php echo $_SESSION['no_kontrak']; ?></td>
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
                  </table>
                </div>
                <br />

                <!--<font color="#FF0000">* Jika Ingin Menambah Data Aksesoris Yang Baru ! Klik Disini <a href="index.php?page=simpan_tambah_aksesoris&id=<?php //echo $_GET['id']; 
                                                                                                                                                          ?>#openAkse"><small data-toggle="tooltip" title="Tambah Aksesoris Baru" class="label bg-blue">+ New Accessories</small></a></font>-->
                <button name="tambah" class="btn btn-success" type="submit" data-toggle="modal" data-target="#modal-tambah"><span class="fa fa-plus"></span> Tambah</button>
                <button class="btn btn-info pull pull-right" data-toggle="modal" data-target="#modal-ubah-harga"><i class="fa fa-edit"></i> Perubahan Harga Jual</button>
                <br />
                <div class="table-responsive no-padding">
                  <div id="content-data"></div>
                </div>
                <center><!--<a href="index.php?page=simpan_jual_alkes2&simpan_barang=1"><button name="simpan_barang" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Simpan</button></a>--><a href="#" data-toggle="modal" data-target="#modal-piutang"><button name="simpa" class="btn btn-success" type="submit" <?php if ($jm == 0) {
                                                                                                                                                                                                                                                                                                                                            echo "disabled";
                                                                                                                                                                                                                                                                                                                                          } ?>><span class="fa fa-plus"></span> Simpan</button></a>&nbsp;&nbsp;<a href="index.php?page=jual_barang_uang"><button name="batal" class="btn btn-success" type="button"><span class="fa  fa-times-circle"></span> Batal</button></a></center>
              </div>
            </div>
          </div>
        </div>
        <!-- /.box (chat box) -->

        <!-- TO DO List --><!-- /.box -->

        <!-- quick email widget -->
      </section>
      <!-- /.Left col -->
      <!-- right col (We are only adding the ID to make the widgets sortable)-->
      <section class="col-lg-5 connectedSortable">

        <!-- Map box --><!-- /.box -->

        <!-- solid sales graph --><!-- /.box -->

        <!-- Calendar --><!-- /.box -->

      </section>
      <!-- right col -->
    </div>
    <!-- /.row (main row) -->

  </section>
  <!-- /.content -->
</div>
<?php
if (isset($_POST['tambah_laporan'])) {
  $Result = mysqli_query($koneksi, "insert into aksesoris values('','" . $_POST['nama_akse'] . "','" . $_POST['merk'] . "','" . $_POST['tipe'] . "','" . $_POST['no_seri'] . "','" . $_POST['stok'] . "', '" . $_POST['deskripsi'] . "','" . $_POST['harga_satuan'] . "')");
  if ($Result) {
    echo "<script type='text/javascript'>
		alert('Data Berhasil Di Tambah !');
		window.location='index.php?page=simpan_tambah_aksesoris&id=$_GET[id]';
		</script>";
  }
}
?>

<div class="modal fade" id="modal-piutang">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <script type="text/javascript">
          function yesnoCheck() {
            if (document.getElementById('yesCheck').checked) {
              document.getElementById('ifYes').style.display = 'block';
            } else document.getElementById('ifYes').style.display = 'none';
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
          <input name="nominal" class="form-control" type="text" placeholder="" value="<?php if ($_SESSION['status_po'] == 1) {
                                                                                          echo number_format($total2, 0, ',', '.');
                                                                                        } else {
                                                                                          echo "0";
                                                                                        }; ?>" required="required" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);"><br />
          <label>Klien</label>
          <input name="klien" class="form-control" type="text" placeholder="" value="<?php echo $sel['nama_pembeli'];  ?>" required="required"><br />
          <label>Deskripsi</label>
          <textarea name="deskripsi" class="form-control" rows="4"></textarea>
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

<div class="modal fade" id="modal-tambah">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" align="center"><strong>Tambah Data</strong></h4>
      </div>
      <form method="post" class="form-user">
        <div class="modal-body">
          <label>Barang Satuan / Set</label>
          <select id="pilih_jenis" name="pilih_jenis" class="form-control select2" onchange="pilihJenis(this.value)" style="width:100%" required>
            <option value="">...</option>
            <option value="1">Satuan</option>
            <option value="2">Set</option>
          </select>
          <div id="display_satuan" style="display : none">
            <br />
            <label>Nama Barang</label>
            <select name="id_akse" id="id_akse" class="form-control select2" autofocus="autofocus" onchange="changeValue(this.value)" style="width:100%">
              <option value="">...</option>
              <?php
              $q5 = mysqli_query($koneksi, "select * from barang_gudang order by nama_brg ASC");
              $jsArray25 = "var dtBrg25 = new Array();";
              while ($d = mysqli_fetch_array($q5)) { ?>
                <option value="<?php echo $d['id']; ?>"><?php echo $d['nama_brg'] . " - " . $d['tipe_brg']; ?></option>
              <?php
                $stok_po1 = mysqli_fetch_array(mysqli_query($koneksi, "select sum(qty_jual) as stok_po from barang_dijual_qty where barang_gudang_id=" . $d['id'] . ""));
                $stok_po2 = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_dikirim_detail,barang_gudang_detail,barang_dijual_qty where barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dijual_qty.id=barang_dikirim_detail.barang_dijual_qty_id and barang_dijual_qty.barang_gudang_id=" . $d['id'] . ""));

                $jsArray25 .= "dtBrg25['" . $d['id'] . "'] = {tipe_akse:'" . addslashes($d['tipe_brg']) . "',
						merk_akse:'" . addslashes($d['merk_brg']) . "',
						stok_total_satuan:'" . addslashes($d['stok_total'] - ($stok_po1['stok_po'] - $stok_po2)) . "',
						harga_satuan:'" . addslashes("Rp " . number_format($d['harga_satuan'], 2, ',', '.')) . "',
						harga:'" . addslashes($d['harga_satuan']) . "',
						no_akse_satuan:'" . addslashes($d['nie_brg']) . "'
						};";
              } ?>
            </select>
            <br /><br />
            <label>Stok Total</label>
            <input id="stok_total" name="stok_total" class="form-control" type="text" placeholder="Stok" disabled="disabled" size="4" />
            <br />
            <label>Harga (<font size="-2" color="#FF0000">Harga tidak boleh 0</font>)</label>
            <input id="harga2" name="harga2" class="form-control" type="text" placeholder="Harga" disabled="disabled" size="8" />
            <input id="harga" name="harga" class="form-control" type="hidden" placeholder="Harga" size="8" />
            <br />
            <label>Tipe</label>
            <input id="tipe_akse" name="tipe_akse" class="form-control" type="text" placeholder="Tipe" disabled="disabled" size="15" />
            <br />
            <label>Merk</label>
            <input id="merk_akse" name="merk_akse" class="form-control" type="text" placeholder="Merk" disabled="disabled" size="15" />
            <br />
            <label>Qty</label>
            <input id="qty" name="qty" class="form-control" type="number" placeholder="" size="2" />
            <br />
            <label>Ongkir</label>
            <input id="ongkirr" name="ongkirr" class="form-control" type="text" placeholder="" size="2" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" />
            <br />
            <label>Total</label>
            <input id="" name="total" class="form-control" type="text" placeholder="" size="" value="Auto" disabled="disabled" />
          </div>
          <div id="display_set" style="display : none">
            <br />
            <label>Nama Set</label>
            <select name="id_set" id="id_set" class="form-control select2" autofocus="autofocus" onchange="changeValue3(this.value)" style="width:100%">
              <option value="">...</option>
              <?php
              $q = mysqli_query($koneksi, "select * from barang_gudang_set order by nama_brg ASC");
              $jsArray3 = "var dtBrg3 = new Array();
";
              while ($d = mysqli_fetch_array($q)) { ?>
                <option value="<?php echo $d['id']; ?>"><?php echo $d['nama_brg']; ?></option>
              <?php
                $jml_brg = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_gudang_set_detail where barang_gudang_set_id = " . $d['id'] . ""));
                $jsArray3 .= "dtBrg3['" . $d['id'] . "'] = {tipe_akse:'" . addslashes($d['tipe_brg']) . "',
						merk_akse:'" . addslashes($d['merk_brg']) . "',
						jumlah_brg:'" . addslashes($jml_brg) . "'
						};";
              } ?>
            </select>
            <br /><br />
            <label>Jumlah Barang Dalam 1 Set</label>
            <input id="stok_total3" name="stok_total" class="form-control" type="text" placeholder="" disabled="disabled" size="4" />
            <br />
            <label>Tipe</label>
            <input id="tipe_akse3" name="tipe_akse" class="form-control" type="text" placeholder="" disabled="disabled" size="15" />
            <br />
            <label>Merk</label>
            <input id="merk_akse3" name="merk_akse" class="form-control" type="text" placeholder="" disabled="disabled" size="15" />
            <br />
            <label>Qty Jual (Set)</label>
            <input id="qty_set" name="qty_set" class="form-control" type="number" placeholder="" size="2" />
            <br />
            <label>Ongkir</label>
            <input id="ongkirr" name="ongkirr" class="form-control" type="text" placeholder="" size="2" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" />
            <br />
            <label>Total</label>
            <input id="" name="total" class="form-control" type="text" placeholder="" size="" value="Auto" disabled="disabled" />
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-success" id="simpan_data"><span class="fa fa-plus"></span> Tambah</button>
        </div>
      </form>
      <script type="text/javascript">
        $(document).ready(function() {
          $('#content-data').load('master_view/' + GetURLParameter('page') + '.php')
          $('#simpan_data').click(function() {
            // e.preventDefault();
            var data = $('.form-user').serialize();
            $.ajax({
              type: 'POST',
              url: "master_create/" + GetURLParameter('page') + ".php",
              data: data,
              success: function() {
                $('#modal-tambah').modal('hide');
                $('#content-data').load('master_view/' + GetURLParameter('page') + '.php')
                $('.form-user')[0].reset();
                pilihJenis('');
                // $('#pilih_jenis').prop("selectedIndex", 0);
                // $('#pilih_jenis option:first').prop("selected", true);
                // $('#id_akse').prop('selectedIndex', 0);
                // alert(GetURLParameter('page'));
              }
            })
          })
        })
      </script>
      <script>
        function pilihJenis(pilih_jenis) {
          var pilih_jenis = document.getElementById("pilih_jenis");
          var id_akse = document.getElementById("id_akse");
          var id_set = document.getElementById("id_set");
          var qty = document.getElementById("qty");
          var qty_set = document.getElementById("qty_set");
          var satuan = document.getElementById("display_satuan");
          var set = document.getElementById("display_set");
          if (pilih_jenis.value == 1) {
            satuan.style.display = "block";
            set.style.display = "none";
            // id_set.required = "false";
            // qty_set.required = "false";
            // id_akse.required = "true";
            // qty.required = "true";
          } else if (pilih_jenis.value == 2) {
            satuan.style.display = "none";
            set.style.display = "block";
            // id_akse.required = "false";
            // qty.required = "false";
            // id_set.required = "true";
            // qty_set.required = "true";
          } else {
            satuan.style.display = "none";
            set.style.display = "none";
            // id_akse.required = "true";
            // qty.required = "true";
            // id_set.required = "true";
            // qty_set.required = "true";
          }
        }
      </script>
      <script type="text/javascript">
        <?php
        echo $jsArray3;
        ?>

        function changeValue3(id_set) {
          document.getElementById('stok_total3').value = dtBrg3[id_set].jumlah_brg;
          document.getElementById('tipe_akse3').value = dtBrg3[id_set].tipe_akse;
          document.getElementById('merk_akse3').value = dtBrg3[id_set].merk_akse;
        };
        <?php
        echo $jsArray25;
        ?>

        function changeValue(id_akse) {
          document.getElementById('harga2').value = dtBrg25[id_akse].harga_satuan;
          document.getElementById('harga').value = dtBrg25[id_akse].harga;
          document.getElementById('stok_total').value = dtBrg25[id_akse].stok_total_satuan;
          document.getElementById('tipe_akse').value = dtBrg25[id_akse].tipe_akse;
          document.getElementById('merk_akse').value = dtBrg25[id_akse].merk_akse;
          document.getElementById('no_akse').value = dtBrg25[id_akse].no_akse_satuan;

        };
      </script>
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
      <form method="post" enctype="multipart/form-data" class="form-ubah-harga">
        <div class="modal-body">
          <label>Nama Barang</label>
          <select name="barang_id" id="barang_id" class="form-control select2" autofocus="autofocus" required onchange="ubahHarga(this.value)" style="width:100%">
            <option value="">...</option>
            <?php
            $qq22 = mysqli_query($koneksi, "select * from barang_gudang order by nama_brg ASC");
            $jsArray52 = "var dtBrg52 = new Array();
";
            while ($d = mysqli_fetch_array($qq22)) { ?>
              <option value="<?php echo $d['id']; ?>"><?php echo $d['nama_brg'] . " - " . $d['tipe_brg']; ?></option>
            <?php
              $stok_po1 = mysqli_fetch_array(mysqli_query($koneksi, "select sum(qty_jual) as stok_po from barang_dijual_qty where barang_gudang_id=" . $d['id'] . ""));
              $stok_po2 = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_dikirim_detail,barang_gudang_detail,barang_dijual_qty where barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dijual_qty.id=barang_dikirim_detail.barang_dijual_qty_id and barang_dijual_qty.barang_gudang_id=" . $d['id'] . ""));

              $jsArray52 .= "dtBrg52['" . $d['id'] . "'] = {harga:'" . addslashes(number_format($d['harga_satuan'], 0, ',', '.')) . "'
						};";
            } ?>
          </select>
          <br /><br />
          <label>Harga Barang</label>
          <input id="nominal" name="nominal" class="form-control" type="text" placeholder="" value="" required="required" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);"><br />

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <button name="ubah_harga" id="ubah_harga" class="btn btn-info" type="button"><span class="fa fa-check"></span> Simpan Perubahan</button>
        </div>
      </form>
      <script type="text/javascript">
        $('#ubah_harga').click(function() {
          // e.preventDefault();
          var data = $('.form-ubah-harga').serialize();
          $.ajax({
            type: 'POST',
            url: "master_update/" + GetURLParameter('page') + ".php",
            data: data,
            success: function() {
              $('#modal-ubah-harga').modal('hide');
              $('.form-ubah-harga')[0].reset();
              alert('Berhasil Di Ubah !')
              // $('#pilih_jenis').prop("selectedIndex", 0);
              // $('#pilih_jenis option:first').prop("selected", true);
              // $('#id_akse').prop('selectedIndex', 0);
              // alert(GetURLParameter('page'));
            }
          })
        })
      </script>
      <script type="text/javascript">
        <?php
        echo $jsArray52;
        ?>

        function ubahHarga(barang_id) {
          document.getElementById('nominal').value = dtBrg52[barang_id].harga;
        };
      </script>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal-ongkir1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Nilai Ongkir, Diskon, PPN, PPh, Lain-lain</h4>
      </div>
      <form method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <label>Ongkir</label>
          <input id="" name="ongkir" class="form-control" type="text" placeholder="" value="<?php if (isset($_SESSION['ongkir'])) {
                                                                                              echo number_format($_SESSION['ongkir'], 0, ',', '.');
                                                                                            } ?>" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" style="border-color:#F00">
          <br />
          <label>Diskon</label>
          <input id="" name="diskon" class="form-control" type="text" placeholder="Gunakan Tanda '.' Untuk Koma" value="<?php if (isset($_SESSION['diskon'])) {
                                                                                                                          echo $_SESSION['diskon'];
                                                                                                                        } ?>">
          <br />
          <label>PPN (%)</label>
          <input id="" name="ppn" class="form-control" type="text" placeholder="Gunakan Tanda '.' Untuk Koma" value="<?php if (isset($_SESSION['ppn'])) {
                                                                                                                        echo $_SESSION['ppn'];
                                                                                                                      } ?>" <?php echo $focus_ppn; ?>>
          <br />
          <label>PPh (%)</label>
          <input id="" name="pph" class="form-control" type="text" placeholder="Gunakan Tanda '.' Untuk Koma" value="<?php if (isset($_SESSION['pph'])) {
                                                                                                                        echo $_SESSION['pph'];
                                                                                                                      } ?>" <?php echo $focus_pph; ?>>
          <br />
          <label>Zakat (%)</label>
          <input name="zakat" class="form-control" type="text" placeholder="Gunakan Tanda '.' Untuk Koma" value="<?php if (isset($_SESSION['zakat'])) {
                                                                                                                    echo $_SESSION['zakat'];
                                                                                                                  } ?>">
          <br />
          <label>Biaya Bank</label>
          <input id="" name="biaya_bank" class="form-control" type="text" placeholder="" value="<?php if (isset($_SESSION['biaya_bank'])) {
                                                                                                  echo number_format($_SESSION['biaya_bank'], 0, ',', '.');
                                                                                                } ?>" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" <?php echo $focus_biaya_bank; ?>>
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

<div class="modal fade" id="modal-ongkir2">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Nilai Ongkir, Diskon, PPN, PPh, Lain-lain</h4>
      </div>
      <form method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <label>Ongkir</label>
          <input id="" name="ongkir" class="form-control" type="text" placeholder="" value="<?php if (isset($_SESSION['ongkir'])) {
                                                                                              echo number_format($_SESSION['ongkir'], 0, ',', '.');
                                                                                            } ?>" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);">
          <br />
          <label>Diskon</label>
          <input id="" name="diskon" class="form-control" type="text" placeholder="Gunakan Tanda '.' Untuk Koma" value="<?php if (isset($_SESSION['diskon'])) {
                                                                                                                          echo $_SESSION['diskon'];
                                                                                                                        } ?>" style="border-color:#F00">
          <br />
          <label>PPN (%)</label>
          <input id="" name="ppn" class="form-control" type="text" placeholder="Gunakan Tanda '.' Untuk Koma" value="<?php if (isset($_SESSION['ppn'])) {
                                                                                                                        echo $_SESSION['ppn'];
                                                                                                                      } ?>" <?php echo $focus_ppn; ?>>
          <br />
          <label>PPh (%)</label>
          <input id="" name="pph" class="form-control" type="text" placeholder="Gunakan Tanda '.' Untuk Koma" value="<?php if (isset($_SESSION['pph'])) {
                                                                                                                        echo $_SESSION['pph'];
                                                                                                                      } ?>" <?php echo $focus_pph; ?>>
          <br />
          <label>Zakat (%)</label>
          <input name="zakat" class="form-control" type="text" placeholder="Gunakan Tanda '.' Untuk Koma" value="<?php if (isset($_SESSION['zakat'])) {
                                                                                                                    echo $_SESSION['zakat'];
                                                                                                                  } ?>">
          <br />
          <label>Biaya Bank</label>
          <input id="" name="biaya_bank" class="form-control" type="text" placeholder="" value="<?php if (isset($_SESSION['biaya_bank'])) {
                                                                                                  echo number_format($_SESSION['biaya_bank'], 0, ',', '.');
                                                                                                } ?>" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" <?php echo $focus_biaya_bank; ?>>
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

<div class="modal fade" id="modal-ongkir3">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Nilai Ongkir, Diskon, PPN, PPh, Lain-lain</h4>
      </div>
      <form method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <label>Ongkir</label>
          <input id="" name="ongkir" class="form-control" type="text" placeholder="" value="<?php if (isset($_SESSION['ongkir'])) {
                                                                                              echo number_format($_SESSION['ongkir'], 0, ',', '.');
                                                                                            } ?>" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);">
          <br />
          <label>Diskon</label>
          <input id="" name="diskon" class="form-control" type="text" placeholder="Gunakan Tanda '.' Untuk Koma" value="<?php if (isset($_SESSION['diskon'])) {
                                                                                                                          echo $_SESSION['diskon'];
                                                                                                                        } ?>">
          <br />
          <label>PPN (%)</label>
          <input id="" name="ppn" class="form-control" type="text" placeholder="Gunakan Tanda '.' Untuk Koma" value="<?php if (isset($_SESSION['ppn'])) {
                                                                                                                        echo $_SESSION['ppn'];
                                                                                                                      } ?>" style="border-color:#F00">
          <br />
          <label>PPh (%)</label>
          <input id="" name="pph" class="form-control" type="text" placeholder="Gunakan Tanda '.' Untuk Koma" value="<?php if (isset($_SESSION['pph'])) {
                                                                                                                        echo $_SESSION['pph'];
                                                                                                                      } ?>">
          <br />
          <label>Zakat (%)</label>
          <input name="zakat" class="form-control" type="text" placeholder="Gunakan Tanda '.' Untuk Koma" value="<?php if (isset($_SESSION['zakat'])) {
                                                                                                                    echo $_SESSION['zakat'];
                                                                                                                  } ?>">
          <br />
          <label>Biaya Bank</label>
          <input id="" name="biaya_bank" class="form-control" type="text" placeholder="" value="<?php if (isset($_SESSION['biaya_bank'])) {
                                                                                                  echo number_format($_SESSION['biaya_bank'], 0, ',', '.');
                                                                                                } ?>" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);">
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

<div class="modal fade" id="modal-ongkir4">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Nilai Ongkir, Diskon, PPN, PPh, Lain-lain</h4>
      </div>
      <form method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <label>Ongkir</label>
          <input id="" name="ongkir" class="form-control" type="text" placeholder="" value="<?php if (isset($_SESSION['ongkir'])) {
                                                                                              echo number_format($_SESSION['ongkir'], 0, ',', '.');
                                                                                            } ?>" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);">
          <br />
          <label>Diskon</label>
          <input id="" name="diskon" class="form-control" type="text" placeholder="Gunakan Tanda '.' Untuk Koma" value="<?php if (isset($_SESSION['diskon'])) {
                                                                                                                          echo $_SESSION['diskon'];
                                                                                                                        } ?>">
          <br />
          <label>PPN (%)</label>
          <input id="" name="ppn" class="form-control" type="text" placeholder="Gunakan Tanda '.' Untuk Koma" value="<?php if (isset($_SESSION['ppn'])) {
                                                                                                                        echo $_SESSION['ppn'];
                                                                                                                      } ?>">
          <br />
          <label>PPh (%)</label>
          <input id="" name="pph" class="form-control" type="text" placeholder="Gunakan Tanda '.' Untuk Koma" value="<?php if (isset($_SESSION['pph'])) {
                                                                                                                        echo $_SESSION['pph'];
                                                                                                                      } ?>" style="border-color:#F00">
          <br />
          <label>Zakat (%)</label>
          <input name="zakat" class="form-control" type="text" placeholder="Gunakan Tanda '.' Untuk Koma" value="<?php if (isset($_SESSION['zakat'])) {
                                                                                                                    echo $_SESSION['zakat'];
                                                                                                                  } ?>">
          <br />
          <label>Biaya Bank</label>
          <input id="" name="biaya_bank" class="form-control" type="text" placeholder="" value="<?php if (isset($_SESSION['biaya_bank'])) {
                                                                                                  echo number_format($_SESSION['biaya_bank'], 0, ',', '.');
                                                                                                } ?>" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);">
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


<div class="modal fade" id="modal-ongkir5">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Nilai Ongkir, Diskon, PPN, PPh, Lain-lain</h4>
      </div>
      <form method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <label>Ongkir</label>
          <input id="" name="ongkir" class="form-control" type="text" placeholder="" value="<?php if (isset($_SESSION['ongkir'])) {
                                                                                              echo number_format($_SESSION['ongkir'], 0, ',', '.');
                                                                                            } ?>" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);">
          <br />
          <label>Diskon</label>
          <input id="" name="diskon" class="form-control" type="text" placeholder="Gunakan Tanda '.' Untuk Koma" value="<?php if (isset($_SESSION['diskon'])) {
                                                                                                                          echo $_SESSION['diskon'];
                                                                                                                        } ?>">
          <br />
          <label>PPN (%)</label>
          <input id="" name="ppn" class="form-control" type="text" placeholder="Gunakan Tanda '.' Untuk Koma" value="<?php if (isset($_SESSION['ppn'])) {
                                                                                                                        echo $_SESSION['ppn'];
                                                                                                                      } ?>">
          <br />
          <label>PPh (%)</label>
          <input id="" name="pph" class="form-control" type="text" placeholder="Gunakan Tanda '.' Untuk Koma" value="<?php if (isset($_SESSION['pph'])) {
                                                                                                                        echo $_SESSION['pph'];
                                                                                                                      } ?>">
          <br />
          <label>Zakat (%)</label>
          <input name="zakat" class="form-control" type="text" placeholder="Gunakan Tanda '.' Untuk Koma" value="<?php if (isset($_SESSION['zakat'])) {
                                                                                                                    echo $_SESSION['zakat'];
                                                                                                                  } ?>">
          <br />
          <label>Biaya Bank</label>
          <input id="" name="biaya_bank" class="form-control" type="text" placeholder="" value="<?php if (isset($_SESSION['biaya_bank'])) {
                                                                                                  echo number_format($_SESSION['biaya_bank'], 0, ',', '.');
                                                                                                } ?>" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);">
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


<div class="modal fade" id="modal-ongkir6">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Nilai Ongkir, Diskon, PPN, PPh, Lain-lain</h4>
      </div>
      <form method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <label>Ongkir</label>
          <input id="" name="ongkir" class="form-control" type="text" placeholder="" value="<?php if (isset($_SESSION['ongkir'])) {
                                                                                              echo number_format($_SESSION['ongkir'], 0, ',', '.');
                                                                                            } ?>" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);">
          <br />
          <label>Diskon</label>
          <input id="" name="diskon" class="form-control" type="text" placeholder="Gunakan Tanda '.' Untuk Koma" value="<?php if (isset($_SESSION['diskon'])) {
                                                                                                                          echo $_SESSION['diskon'];
                                                                                                                        } ?>">
          <br />
          <label>PPN (%)</label>
          <input id="" name="ppn" class="form-control" type="text" placeholder="Gunakan Tanda '.' Untuk Koma" value="<?php if (isset($_SESSION['ppn'])) {
                                                                                                                        echo $_SESSION['ppn'];
                                                                                                                      } ?>">
          <br />
          <label>PPh (%)</label>
          <input id="" name="pph" class="form-control" type="text" placeholder="Gunakan Tanda '.' Untuk Koma" value="<?php if (isset($_SESSION['pph'])) {
                                                                                                                        echo $_SESSION['pph'];
                                                                                                                      } ?>">
          <br />
          <label>Zakat (%)</label>
          <input name="zakat" class="form-control" type="text" placeholder="Gunakan Tanda '.' Untuk Koma" value="<?php if (isset($_SESSION['zakat'])) {
                                                                                                                    echo $_SESSION['zakat'];
                                                                                                                  } ?>">
          <br />
          <label>Biaya Bank</label>
          <input id="" name="biaya_bank" class="form-control" type="text" placeholder="" value="<?php if (isset($_SESSION['biaya_bank'])) {
                                                                                                  echo number_format($_SESSION['biaya_bank'], 0, ',', '.');
                                                                                                } ?>" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" style="border-color:#F00" autofocus>
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