<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Surat Perintah Instalasi</h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Surat Perintah Instalasi</li>
    </ol>
  </section>


  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->
    <!-- /.row -->
    <!-- Main row -->
    <div class="row">
      <!-- Left col -->
      <section class="col-lg-12">
        <!-- Custom tabs (Charts with tabs)-->
        <!-- /.nav-tabs-custom -->

        <!-- Chat box -->
        <div class="box box-default">
          <!-- /.chat -->
          <div class="box-footer">
            <div class="box-body table-responsive no-padding">
              <div class="">
                <?php if (!isset($_SESSION['id_b'])) { ?>
                  <a href="index.php?page=tambah_spk_masuk">
                    <button name="tambah_laporan" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Tambah </button></a>
                <?php } ?>
                <span class="pull pull-right">
                  <table>
                    <tr>
                      <td valign="top"><strong style="color:#F00">Keterangan</strong> : &nbsp;&nbsp;&nbsp;</td>
                      <td valign="top">1. </td>
                      <td valign="top">Jika <strong>Box</strong> Di <strong>Nama Alkes</strong> Berwarna <strong style="color:#F00">Merah</strong> , Itu menandakan<br />
                        barang telah dikembalikan karena mengalami kerusakan</td>
                    </tr>
                  </table>
                </span>
                <br /><br />
                <div class="pull pull-right">
                  <button class="btn btn-success" data-toggle="modal" data-target="#modal-pencarian"><span class="fa fa-search"></span> Pencarian</button>&nbsp;&nbsp;
                  <?php if (isset($_GET['kunci']) or isset($_GET['tgl1'])) { ?>
                    <a href="?page=<?php echo $_GET['page'] ?>"><button class="btn btn-info"><span class="fa fa-refresh"></span> Reset</button></a>&nbsp;&nbsp;
                  <?php } ?>
                  <a data-toggle="tooltip" data-title="Jumlah Data Yang Ditampilkan Per Halaman"><button data-toggle="modal" data-target="#modal-atur" name="limit" class="btn btn-default" type="button"><span class="fa fa-cog"></span></button></a>
                </div>


              </div>
            </div>
          </div>
        </div>
        <!-- /.box (chat box) -->

        <!-- TO DO List -->
        <!-- /.box -->

        <!-- quick email widget -->
      </section>
      <section class="col-lg-12 connectedSortable">
        <!-- Custom tabs (Charts with tabs)-->
        <!-- /.nav-tabs-custom -->

        <!-- Chat box -->
        <div class="box box-success">
          <div class="box-footer">
            <div class="box-body table-responsive no-padding">
              <div class="">
                <input type="text" class="form-control" name="keyword" id="keyword" placeholder="Enter the keyword you want to search..."/>
                <div id="table" style="margin-top: 10px;">
                </div>
                <script src="js/getData.js"></script>
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
$d_t = mysqli_fetch_array(mysqli_query($koneksi, "select * from tb_teknisi where id=$_GET[id_tek]"));
?>
<div id="open_teknisi" class="modalDialog">
  <div>
    <a href="#" title="Close" class="close">X</a>
    <h3 align="center">Detail Teknisi</h3>
    <form method="post">
      <strong>Nama</strong>
      <input id="input" type="text" readonly="readonly" value="<?php echo $d_t['nama_teknisi']; ?>" />
      <strong>Kompetensi</strong>
      <input id="input" type="text" readonly="readonly" value="<?php echo $d_t['bidang']; ?>" />
      <strong>No HP</strong>
      <input id="input" type="text" readonly="readonly" value="<?php echo $d_t['no_hp']; ?>" />
      <strong>No STR</strong>
      <input id="input" type="text" readonly="readonly" value="<?php echo $d_t['no_str']; ?>" />
      <table width="100%">
        <tr>
          <td align="center"><strong>Ijazah</strong></td>
          <td align="center"><strong>Sertifikat</strong></td>
        </tr>
        <tr>
          <td align="center"><a href="ijazah_teknisi/<?php echo $d_t['ijazah']; ?>" target="_blank"><img src="ijazah_teknisi/<?php echo $d_t['ijazah']; ?>" width="50px" /></a></td>
          <td align="center"><a href="ijazah_teknisi/sertifikat/<?php echo $d_t['sertifikat']; ?>" target="_blank"><img src="ijazah_teknisi/sertifikat/<?php echo $d_t['sertifikat']; ?>" width="50px" /></a></td>
        </tr>
      </table>

    </form>
  </div>
</div>

<div id="openUji" class="modalDialog">
  <div>
    <a href="#" title="Close" class="close">X</a>
    <h3 align="center">Uji Fungsi & Instalasi</h3>
    <form method="post">
      <input name="nama_teknisi" id="input" type="text" required placeholder="Nama Teknisi"><br />

      <input name="bidang" id="input" type="text" placeholder="Bidang" required><br />
      <input name="no_str" id="input" placeholder="No STR" required><br />
      <input name="no_hp" id="input" type="text" placeholder="No HP" required><br />
      <input name="username" id="input" type="text" placeholder="Username" required><br />
      <input name="password" id="input" type="password" placeholder="Password" required><br />
      Ijazah
      <input name="ijazah" style="background-color:#FFF" id="input" type="file" /><br />
      Sertifikat
      <input name="sertifikat" id="input" type="file" style="background-color:#FFF" /><br />
      <button id="buttonn" name="tambahteknisibaru" type="submit">Jual Alkes</button>
    </form>
  </div>
</div>

<div class="modal fade" id="modal-pencarian">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <script type="text/javascript">
          function yesnoCheck() {
            if (document.getElementById('yesCheck').value == 'tgl_spk') {
              document.getElementById('ifYes').style.display = 'block';
              document.getElementById('kata_kunci').style.display = 'none';
            } else {
              document.getElementById('ifYes').style.display = 'none';
              document.getElementById('kata_kunci').style.display = 'block';
            }
          }
        </script>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Pencarian</h4>
      </div>
      <form method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <select class="form-control select2" name="pilihan" required style="width:100%" onchange="javascript:yesnoCheck();" id="yesCheck">
            <option value="">...</option>
            <option value="tgl_spk">Berdasarkan Rentang Tanggal SPI</option>
            <option value="no_spk">Berdasarkan Nomor SPI</option>
            <option value="no_pengiriman">Berdasarkan Nomor Surat Jalan</option>
            <option value="barang_dijual.no_po_jual">Berdasarkan Nomor PO</option>
            <option value="nama_pembeli">Berdasarkan RS/Dinas/Puskesmas/Dll</option>
            <option value="nama_brg">Berdasarkan Nama Barang</option>
            <option value="tipe_brg">Berdasarkan Tipe Barang</option>
            <option value="no_seri_brg">Berdasarkan No Seri Barang</option>
          </select>
          <br /><br />
          <div id="kata_kunci" style="display:block">
            <input type="text" class="form-control" name="kata_kunci" placeholder="Kata Kunci" />
          </div>
          <div id="ifYes" style="display:none">
            <label>Dari Tanggal</label>
            <input name="tgl1" type="date" class="form-control" placeholder="" value=""><br />
            <label>Sampai Tanggal</label>
            <input name="tgl2" type="date" class="form-control" placeholder="" value="">
          </div>
          <br />
          <select name="tampil" class="form-control select2" style="width:100%">
            <option value="">...</option>
            <option value="1">Tampilkan Detail Barang</option>
            <option value="0">Jangan Tampilkan Detail Barang</option>
          </select>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success" name="pencarian">Cari</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>