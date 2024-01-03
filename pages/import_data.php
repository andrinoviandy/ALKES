<div class="content-wrapper">
    <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
        Import Data Form Excel
        
    </h1>
    <ol class="breadcrumb">
      <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active"><a href="index.php?page=barang_masuk">Import Data</a></li></ol></section>


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
            <div class="box-header with-border">
              <h3 class="box-title">Import Excel</h3>
            </div>
            <div class="box-body">
              <form method="post" action="proses_upload.php" enctype="multipart/form-data">
              Pilih File Excel (.xls)
              <font color="#FF0000" class="pull pull-right">* File Harus terdiri dari 11 Kolom</font>
              <input name="userfile" class="form-control" type="file" required><br />              
              <button name="import" class="btn btn-success" type="submit"><span class="fa fa-plus"></span> Import</button>
              </form>
              <a class="pull pull-right" href="download_template.php">* Download Contoh Template</a>
              <br /><br />
              Baris Pertama Merupakan Nama Field Dari Tabel<br /><br />
              Kolom 1(A)  : Nama Barang<br />
              Kolom 2(B)  : Tipe Barang<br />
              Kolom 3(C)  : Merk Barang<br />
              Kolom 4(D)  : NIE Barang<br />
              Kolom 5(E)  : No Bath<br />
              Kolom 6(F)  : No Lot<br />
              Kolom 7(G)  : Negara Asal<br />
              Kolom 8(H)  : Stok<br />
              Kolom 9(I)  : Deskripsi Alat<br />
              Kolom 10(J)  : Harga Satuan<br />
              Kolom 11(K)  : Status Cek<br />
              <br /><br />
              
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
  