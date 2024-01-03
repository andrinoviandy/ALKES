<?php require("config/koneksi.php"); ?>
<?php session_start(); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 align="center">
        Laporan Alkes
     Masuk</h1>
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
              <div class="box-body table-responsive no-padding">
              <div class="">
              <br />
              <?php 
			  if (isset($_SESSION['id'])) {
				  echo "User : ".$_SESSION['user_a']."<br>";
				  }
			  echo "<strong>Form</strong> <i>".date("d F Y",strtotime($tgl1))."</i> <strong>To</strong> <i>".date("d F Y",strtotime($tgl2))."</i>"; ?>
              
                <table border="1" class="table table-bordered table-hover" id="example1">
  <thead>
    <tr>
      <td align="left"><strong>No</strong></th>
        
        <th align="left"><strong>Nama Alkes</strong></th>
      <th align="left"><strong>Merk</strong></th>
      <th align="left"><strong>Tipe</strong></th>
      <th align="left"><strong>No Seri</strong></th>
      <th align="left">NIE</th>
      <th align="left"><strong>Negara Asal</strong></th>
      <td align="left"><strong>Stok    
        
        </strong>
        
        </tr>
  </thead>
  <?php
  
	  $query = mysqli_query($koneksi, "select *,master_barang.id as idd from master_barang order by id DESC");
  
  $no=0;
  while ($data = mysqli_fetch_assoc($query)) { 
  $no++;
  ?>
  <tr>
    <td align="left"><?php echo $no; ?></td>
    <td align="left"><?php echo $data['nama_brg']; ?>
    </td>
      <td align="left"><?php echo $data['merk_brg']; ?></td>
    <td align="left"><?php echo $data['tipe_brg']; ?></td>
    <td align="left"><?php echo $data['no_seri_brg']; ?></td>
    <td align="left"><?php echo $data['nie_brg']; ?></td>
    <td align="left"><?php echo $data['negara_asal']; ?></td>
    <td align="left"><?php echo $data['stok']; ?></td>
    
  </tr>
  <?php } ?>
</table>
</div>
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