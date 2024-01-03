<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Beranda
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Beranda</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <?php 
	  if (isset($_SESSION['user_administrator'])) {
		  ?>
          <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php 
			   $data1 = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_gudang"));
			   $data1_1 = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_gudang_detail"));
			  if ($data1==0) { echo "0";}
			  else { echo $data1."/<font style='font-size:16px'>".$data1_1."</font>"; }
			  ?></h3>

              <p>Jenis Alkes / Jumlah Alkes</p>
            </div>
            <div class="icon">
              <i class="fa fa-cubes"></i>
            </div>
            <a href="index.php?page=barang_masuk" class="small-box-footer">Info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php 
			   $data2 = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_dikirim_detail"));
			  if ($data2==0) { echo "0";}
			  else { echo ($data2); }
			  ?></h3>

              <p>Penjualan Alkes</p>
            </div>
            <div class="icon">
              <i class="fa fa-sign-out"></i>
            </div>
            <a href="index.php?page=jual_barang" class="small-box-footer">Info	 <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php 
			  $data3 = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_gudang_detail_rusak"));
			  echo $data3;
			  ?></h3>

              <p>Alkes Rusak Belum Terjual</p></div><div class="icon">
              <i class="fa fa-remove"></i>
            </div>
            <a href="index.php?page=barang_rusak" class="small-box-footer">Info<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php 
			  $data4 = mysqli_num_rows(mysqli_query($koneksi, "select * from pembeli group by nama_pembeli"));
			  echo $data4;
			  ?></h3>

              <p>Jumlah Customer</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="index.php?page=akun_user" class="small-box-footer">Info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-purple">
            <div class="inner">
              <h3><?php 
			  $data5 = mysqli_fetch_array(mysqli_query($koneksi, "select sum(qty) as totall from barang_pesan_detail,barang_pesan where barang_pesan.id=barang_pesan_detail.barang_pesan_id and jenis_po='Dalam Negeri'"));
			  if ($data5['totall']==0) {
				  echo "0";
				  }
				  else {
			  echo $data5['totall']; }
			  ?></h3>

              <p>Pembelian Alkes Dalam Negeri</p>
            </div>
            <div class="icon">
              <i class="fa fa-sign-in"></i>
            </div>
            <a href="index.php?page=pembelian_alkes" class="small-box-footer">Info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php 
			  $data6 = mysqli_fetch_array(mysqli_query($koneksi, "select sum(qty) as totall from barang_pesan_detail,barang_pesan where barang_pesan.id=barang_pesan_detail.barang_pesan_id and jenis_po='Luar Negeri'"));
			  if ($data6['totall']==0) {
				  echo "0";
				  }
				  else {
			  echo $data6['totall']; }
			  ?></h3>

              <p>Pembelian Alkes Luar Negeri</p>
            </div>
            <div class="icon">
              <i class="fa fa-sign-in"></i>
            </div>
            <a href="index.php?page=pembelian_alkes2" class="small-box-footer">Info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-light-blue">
            <div class="inner">
              <h3><?php 
			  $data7 = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_kembali_detail"));
			  echo $data7;
			  ?></h3>

              <p>Alkes Rusak Sudah Terjual</p>
            </div>
            <div class="icon">
              <i class="fa fa-remove"></i>
            </div>
            <a href="index.php?page=barang_kembali_teknisi" class="small-box-footer">Info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-gray">
            <div class="inner">
              <h3><?php 
			  echo "-";//$data8 = mysqli_num_rows(mysqli_query($koneksi, "select * from pembeli group by nama_pembeli"));
			  //echo $data8;
			  ?></h3>

              <p>Pengembalian Alkes</p>
            </div>
            <div class="icon">
              <i class="fa fa-download"></i>
            </div>
            <a href="#" class="small-box-footer">Info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
          <?php
		  }
	  ?>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <!--<section class="col-lg-12 connectedSortable">
		
		<marquee scrollamount="20"><h1>Selamat Datang Di Aplikasi ALKES <em>TEREGISTRASI</em></h1></marquee>
        </section>
        -->
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  
  <!--<div id="openPesan" class="modalDialog2">
     <div>
     <a href="#" title="Close" class="close2">X</a>
     <br />
     <p style="font-weight:bold">Tata Cara Penggunaan Aplikasi :</p>
<p align="justify">Aplikasi ini digunakan untuk mengelola data alkes . Mulai dari Alkes yang masuk , terjual hingga ke Uji Fungsi &amp; Instalasi Alkes serta pelatihan Alkes. Aplikasi ini juga mengelola data alkes yang rusak baik dari sisi internal maupun external.</p>
<ol style="padding-left:20px">
<li align="justify">
Setiap Menu mempunyai tabel yang berisikan data-data dari menu tersebut. Dan Didalam Tabel terdapat link untuk menghubungkan ke proses selanjutnya. (Baca Keterangan Diatas Tabel).
</li>
<br />
<li align="justify">Data-data yang telah masuk tidak akan masuk ke menu dibawah nya jika proses menu diatas nya belum selesai. Pengerjaan selalu bertahap dari atas hingga ke bawah.</li>
<br />
<li align="justify">Untuk menu yang mempunyai judul &quot;Alkes (Masuk-Terjual-Kirim)&quot;, ini digunakan untuk mengelola data alkes. Sedangkan untuk menu yang mempunyai judul &quot;Alkes Rusak&quot; ini digunakan untuk mengelola data alkes yang rusak baik internal maupun eksternal. Data kedua ini tidak saling terhubung.</li>
<br />
<li align="justify">Setiap halaman mempunyai button yang digunakan untuk menambah, menghapus, dll. Dan ada button yang berisikan simbol , tetapi akan ada  notif yang muncul diatas simbol tersebut saat mengarahkan kursor ke simbol, yang menandakan kegunaan dari simbol tersebut.</li>
<li align="justify">Untuk <strong>menambah</strong> data alkes yang rusak , kita harus membuat akun user terlebih dahulu , agar user/pelanggan dapat melihat proses perbaikan alkes tersebut. Cara menambah user ada di "Pengaturan->Akun->User"</li>
</ol>


     </div>
     </div>-->