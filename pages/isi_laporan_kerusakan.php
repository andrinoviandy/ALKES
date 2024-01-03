<?php require("config/koneksi.php"); ?>
<?php session_start(); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 align="center">
        Laporan Kerusakan Barang</h1>
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
              <div class="input-group col-lg-12">
              <br />
              <?php 
			  if (isset($_SESSION['user_customer'])) {
				  echo "User : ".$_SESSION['user_customer']."<br>";
				  }
			  echo "<strong>Form</strong> <i>".date("d F Y",strtotime($tgl1))."</i> <strong>To</strong> <i>".date("d F Y",strtotime($tgl2))."</i>"; ?>
                <table border="1" class="table table-bordered table-hover" id="example2">
  <thead>
    <tr>
      <td align="left"><strong>No</strong></td>
      <td align="left"><strong>Tanggal Lapor</strong></td>
      <td align="left"><strong>Laporan Dari</strong></td>
      <td align="left"><strong>Nama / No Seri Alat</strong></td>
      <td align="left"><strong>Garansi</strong></td>
      <td align="left"><strong>Kerusakan</strong></td>
      <td align="left"><strong>Lokasi</strong></td>
      <td align="left"><strong>Kontak</strong></td>
      
      </tr>
  </thead>
  <?php
  
	  $query = mysqli_query($koneksi, "select *,alat_pelatihan.id as idd,pembeli_id as id_rumkit from barang_teknisi,barang_teknisi_detail, barang_dikirim,barang_dikirim_detail, barang_dijual, barang_gudang, barang_gudang_detail,pembeli, tb_teknisi,alat_uji_detail,alat_pelatihan,akun_customer,tb_laporan_kerusakan,tb_laporan_kerusakan_detail where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dijual.id=barang_dikirim.barang_dijual_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and pembeli.id=barang_dijual.pembeli_id and barang_dikirim_detail.id=barang_teknisi_detail.barang_dikirim_detail_id and barang_teknisi.id=barang_teknisi_detail.barang_teknisi_id and tb_teknisi.id=barang_teknisi.teknisi_id and barang_teknisi_detail.id=alat_uji_detail.barang_teknisi_detail_id and alat_uji_detail.id=alat_pelatihan.alat_uji_detail_id and tb_laporan_kerusakan.id=tb_laporan_kerusakan_detail.tb_laporan_kerusakan_id and alat_pelatihan.id=tb_laporan_kerusakan_detail.alat_pelatihan_id and tb_laporan_kerusakan.tgl_lapor between '$tgl1' and '$tgl2' order by tb_laporan_kerusakan.tgl_lapor DESC");	  
  
  $no=0;
  while ($data = mysqli_fetch_array($query)) { 
  $no++;
  ?>
  <tr>
    <td align="left"><?php echo $no; ?></td>
    <td align="left"><font color=""><?php echo date("d F Y",strtotime($data['tgl_lapor'])); ?></font></td>
    <td align="left"><?php echo $data['nama_user']; ?></td>
    <td align="left"><?php echo $data['nama_brg']." / ".$data['no_seri_brg']; ?></td>
    <td align="left"><?php echo $data['status_garansi']; ?></td>
    <td align="left"><?php echo $data['problem']; ?></td>
    <td align="left"><?php echo $data['lokasi_alat']; ?></td>
    <td align="left"><?php echo $data['telp_user']; ?></td>
    
  </tr>
  <?php } ?>
</table>
              </div>
            </div>
          </div>
          <!-- /.box (chat box) -->

          <!-- TO DO List --><!-- /.box -->

        <!-- quick email widget --></section>
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