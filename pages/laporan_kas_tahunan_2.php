<?php 
if (isset($_POST['button_urut'])) {
	echo "<script>window.location='cetak_stok_alkes.php?merk=$_POST[merk]'</script>";
	}
?>
<?php 
if (isset($_GET['id_hapus'])) {
	$del = mysqli_query($koneksi, "delete from coa_detail where coa_id=".$_GET['id_hapus']."");
	$del2 = mysqli_query($koneksi, "delete from coa where id=".$_GET['id_hapus']."");
	}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Laporan Kas Tahunan</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Laporan Kas Tahunan</li>
      </ol>
    </section>


    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) --><!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-6 connectedSortable">
          <!-- Custom tabs (Charts with tabs)--><!-- /.nav-tabs-custom -->

          <!-- Chat box -->
          <div class="box box-success"><!-- /.chat -->
            <div class="box-footer">
              <div class="box-body table-responsive no-padding">
              <span class="pul pull-left">
              <table>
              <tr>
                <td><select class="form-control" name="akun2">
                  <option value="">2016</option>
                  <option value="">2017</option>
                  <option value="">2018</option>
                  <option value="">2019</option>
                </select></td>
                  <td>
                  <select class="form-control" name="akun">
                  <option value="">All</option>
                  </select>
                  </td>
              <td><button class="btn btn-success">Lihat</button></td>
              </tr>
              </table>
              </span>
              <span class="pull pull-right"><button data-toggle="tooltip" title="Cetak Excel" class="btn btn-success"><span class="fa fa-file-excel-o"></span></button></span>
              <span class="pull pull-right">&nbsp;<button data-toggle="tooltip" title="Cetak PDF" class="btn btn-success"><span class="fa fa-file-pdf-o"></span></button></span>
              <br /><br /><br />
              <table width="100%" class="table no-border">
                <tr>
                  <td width="51%">Saldo Awal</td>
                  <td width="12%">&nbsp;</td>
                  <td width="6%">Rp</td>
                  <td width="31%" align="right">30.000.000,00</td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td align="right">&nbsp;</td>
                </tr>
                <tr>
                  <td>Semua Pemasukan</td>
                  <td>(+)</td>
                  <td>Rp</td>
                  <td align="right">10.000.000.00</td>
                </tr>
                <tr>
                  <td>Semua Pengeluaran</td>
                  <td>(-)</td>
                  <td>Rp</td>
                  <td align="right">5.500.000,00</td>
                </tr>
                <tr>
                  <td align="right"><strong>Akumulasi</strong></td>
                  <td>&nbsp;</td>
                  <td><strong>Rp</strong></td>
                  <td align="right">+ 4.500.000,00</td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td align="right">&nbsp;</td>
                </tr>
                <tr>
                  <td>Saldo Akhir</td>
                  <td>&nbsp;</td>
                  <td>Rp</td>
                  <td align="right">&nbsp;</td>
                </tr>
              </table>
              <br />

              </div>
            </div>
          </div>
          <!-- /.box (chat box) -->

          <!-- TO DO List --><!-- /.box -->

        <!-- quick email widget --></section>
        <section class="col-lg-6 connectedSortable">
          <div class="box box-success"><!-- /.chat -->
            <div class="box-header">
              TES BAR
              </div>
            <div class="box-footer">
              <div class="box-body table-responsive no-padding">
              //ssd	
              </div>
            </div>
          </div>
          </section>
          
      </div>
      <div class="row">
          <section class="col-lg-6 connectedSortable">
          <div class="box box-success"><!-- /.chat -->
            <div class="box-header">
              Pemasukan
              </div>
            <div class="box-footer">
              <div class="box-body table-responsive no-padding">
              //ssd	
              </div>
            </div>
          </div>
          </section>
          <section class="col-lg-6 connectedSortable">
          <div class="box box-success"><!-- /.chat -->
            <div class="box-header">
              Pengeluaran
              </div>
            <div class="box-footer">
              <div class="box-body table-responsive no-padding">
              //ssd	
              </div>
            </div>
          </div>
          </section>
          </div>
      <!-- /.row (main row) -->

  </section>
    <!-- /.content -->
  </div>
 

<div id="openPilihan" class="modalDialog">
     <div>
        <a href="#" title="Close" class="close">X</a>
        <br />
        <a href="index.php?page=jual_barang2&id=<?php echo $_GET['id']; ?>"><button id="buttonn">Data Dinas/RS/Puskesmas/Klinik Baru</button></a>
        <a href="index.php?page=jual_barang3&id=<?php echo $_GET['id']; ?>"><button id="buttonn">Dari Data Dinas/RS/Puskesmas/Klinik<br />Yang Sudah Terinput</button></a>
    </div>
</div>


