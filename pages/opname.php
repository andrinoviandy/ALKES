<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Stok Opname - Scan Barang</h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Stok Opname</li>
    </ol>
  </section>


  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->
    <!-- /.row -->
    <!-- Main row -->
    <div class="row">
      <!-- Left col -->
      <section class="col-lg-6">
        <?php
        $do = mysqli_fetch_array(mysqli_query($koneksi, "select * from stok_opname where id=" . $_GET['id'] . ""));
        ?>
        <section class="col-lg-4">
          <div class="box box-default">
            <div class="box-header">
              <center>Tanggal Pengecekan</center>
            </div>
            <div class="box-footer btn-default">
              <div align="center" class="box-body">
                <font size=""><strong><?php echo date("d F Y", strtotime($do['tgl_cek'])); ?></strong></font>
              </div>
            </div>
          </div>
        </section>
        <section class="col-lg-8">
          <div class="box box-default">
            <div class="box-header">
              <center>Keterangan</center>
            </div>
            <div class="box-footer btn-default">
              <div align="center" class="box-body">
                <font align="justify"><?php echo $do['keterangan']; ?></font>
              </div>
            </div>
          </div>
        </section>
      </section>
      <section class="col-lg-2">
        <div class="box box-default">
          <div class="box-header">
            <center>Barang Discan</center>
          </div>
          <div class="box-footer btn-default">
            <div align="center" class="box-body">
              <div id="barang_discan"></div>
            </div>
          </div>
        </div>
      </section>
      <section class="col-lg-2">
        <div class="box box-success">
          <div class="box-header">
            <center>Ditemukan</center>
          </div>
          <div class="box-footer btn-success">
            <div align="center" class="box-body">
              <div id="barang_ditemukan"></div>
            </div>
          </div>
        </div>
      </section>
      <section class="col-lg-2">
        <div class="box box-danger">
          <div class="box-header">
            <center>Tidak Ditemukan</center>
          </div>
          <div class="box-footer btn-danger">
            <div align="center" class="box-body">
              <div id="barang_tidakditemukan"></div>
            </div>
          </div>
        </div>
      </section>
      <script src="js/getBarangScan.js"></script>

      <section class="col-lg-12">
        <!-- Custom tabs (Charts with tabs)-->
        <!-- /.nav-tabs-custom -->

        <!-- Chat box -->

        <div class="box box-default">
          <!-- /.chat -->
          <div class="box-footer">
            <div class="box-body table-responsive no-padding">
              <section class="col-lg-6">
                  <input required id="kode" name="kode" class="form-control" placeholder="Masukkan QRCode Atau Klik disini untuk menggunakan scanner, lalu arahkan scanner ke QRCode" type="text" />
                
                <script type="text/javascript">
                  function SetFocus() {
                    var input = document.getElementById("kode");
                    input.focus();
                  }
                </script>
              </section>
              <section class="col-lg-6">
                <button type="button" onClick="document.location.reload(true); alert('Silakan Gunakan Scanner Lagi Setelah tekan OK !')" class="btn btn-warning"><i class="fa fa-refresh"></i> &nbsp;Tekan Ini Jika Tidak Bisa Scanner</button>
                <a href="?page=opname_awal"><button type="button" class="btn btn-danger"><i class="fa fa-calendar"></i> &nbsp;Buat Pengecekan Baru</button></a>
              </section>
            </div>
          </div>
        </div>
        <!-- /.box (chat box) -->

        <!-- TO DO List -->
        <!-- /.box -->

        <!-- quick email widget -->
      </section>
      <div id="data">
      </div>
      <script src="js/getStok.js"></script>
    </div>
    <!-- /.row (main row) -->

  </section>

  <!-- /.content -->
</div>