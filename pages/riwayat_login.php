<?php
if (isset($_GET['id_hapus'])) {
  $delete = mysqli_query($koneksi, "delete from mata_uang where id=" . $_GET['id_hapus'] . "");
  if ($delete) {
    echo "<script>window.location='index.php?page=mata_uang'</script>";
  } else {
    echo "<script type='text/javascript'>alert('Tidak Dapat Dihapus !');
		window.location='index.php?page=mata_uang';
		</script>";
  }
}
?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Riwayat Login

    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Pengaturan</li>
      <li class="active">Riwayat Login</li>
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