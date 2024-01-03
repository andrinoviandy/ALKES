<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="kharisma.png" class="" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Customer Service</p>
          <a href="#"><i class="fa fa-circle text-success"></i> <?php
          $sel = mysqli_fetch_array(mysqli_query($koneksi, "select * from akun_cs where id=".$_SESSION['id'].""));
		  echo $sel['nama'];
		  ?></a>
        </div>
      </div>
      <!-- search form -->
      
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <?php include "active.php"; ?>
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header"><strong><em>NAVIGASI</em></strong></li>
        <li class="<?php echo $act1; ?>">
          <a href="index.php?page=beranda">
            <i class="fa fa-dashboard"></i> <span>Beranda</span>
            <span class="pull-right-container">
              
            </span>
          </a>
        </li>
		<!--<li class="treeview <?php echo $bagian_teknisi; ?>"><a href="#"><i>(T)</i> <span><strong style="color:#F90"><em> TEKNISI</em></strong></span><span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span></a>
        <ul class="treeview-menu">
        <li class="<?php echo $kirim_teknisi; ?>">
          <a href="index.php?page=kirim_barang_teknisi">
            <i class="fa fa-cube"></i> <span>Lokasi Alkes</span>
            <span class="pull-right-container">
              
            </span>
          </a></li>
        <li class="<?php echo $act_spk_masuk; ?>">
          <a href="index.php?page=spk_masuk">
            <i class="fa fa-cube"></i> <span>Rencana Instalasi</span>
            <span class="pull-right-container">
              
            </span>
          </a></li>
        <li class="<?php echo $act3; ?>">
          <a href="index.php?page=uji_fungsi_instalasi">
            <i class="fa fa-cube"></i> <span>Instalasi & Uji Fungsi</span>
            <span class="pull-right-container">
              
            </span>
          </a></li>
        
        <li class="<?php echo $act4; ?>">
          <a href="index.php?page=pelatihan_alat">
        <i class="fa fa-cube"></i> <span>Pelatihan Alat</span></a></li>
        
        <li class="header"><strong style="color:#F90"><em>KERUSAKAN ALKES (SERVICE)</em></strong></li>
        <li class="header"><strong style="color:#F90"><center><em>- Belum Terjual (Masih Di Gudang)</em></center></strong></li>
        <li class="<?php echo $barang_gudang_rusak; ?>">
         <a href="index.php?page=barang_rusak"><i class="fa fa-cube"></i> <span class="">Data Alkes Rusak</span>
            <span class="pull-right-container">
              
            </span>
          </a>
        </li>
        <li class="<?php echo $progress_dalam; ?>">
          <a href="index.php?page=progress_rusak_dalam">
            <i class="fa fa-archive"></i> <span>Progress Pengerjaan</span>
        </a></li>
        <li class="header"><center><strong style="color:#F90"><em>- Sudah Terjual</em></strong></center></li>
        
        <li class="<?php echo $act6; ?>">
          <a href="index.php?page=laporan_kerusakan">
            <i class="fa fa-indent"></i>
            <span>Laporan Kerusakan Alkes</span>
</a>
<?php 
			  $data1 = mysqli_num_rows(mysqli_query($koneksi, "select * from tb_laporan_kerusakan where exp=0"));
			  if ($data1==0) { ?>
            <?php } else { ?>
            <span class="pull-right-container">
            <span class="label label-primary pull-right">
		    <?php
			  echo "".$data1;
			  ?></span>
          </span>
          <?php } ?>
        </a>
          
        </li>
        <li class="<?php echo $act7; ?>">
          <a href="index.php?page=pembuatan_spk">
            <i class="fa fa-outdent"></i> <span> Service Kerusakan</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green">
              <?php $total11=mysqli_num_rows(mysqli_query($koneksi, "select * from tb_maintenance_detail"));
			  echo $total11;
			   ?>
              </small>
            </span>
          </a>
        </li>
        <li class="<?php echo $act8; ?>">
          <a href="index.php?page=progress_pengerjaan">
            <i class="fa fa-archive"></i> <span>Progress Pengerjaan</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-red">
              <?php $total1=mysqli_num_rows(mysqli_query($koneksi, "select * from tb_maintenance_detail where status_proses=0"));
			  echo $total1; ?>
              </small><small class="label pull-right bg-yellow"><?php $total2=mysqli_num_rows(mysqli_query($koneksi, "select * from tb_maintenance_detail where status_proses=1"));
			  echo $total2; ?>
              </small>
            </span>
        </a></li>
        
        <li class="header"><center><strong style="color:#F90"><em>- Barang Yg Dikembalikan Karena Rusak</em></strong></center></li>
        <li class="<?php echo $barang_kembali_teknisi; ?>">
         <a href="index.php?page=barang_kembali_teknisi"><i class="fa fa-cube"></i> <span class="">Data Alkes Rusak</span>
            <span class="pull-right-container">
              
            </span>
          </a>
        </li>
        <li class="<?php echo $progress_barang_kembali; ?>">
          <a href="index.php?page=progress_barang_kembali">
            <i class="fa fa-archive"></i> <span>Progress Pengerjaan</span>
        </a></li>
        </ul>
        </li>
        -->
        <li class="header"><strong style="color:#0C0"><em>BAGIAN CUSTOMER SERVICE</em></strong></li>
          <li class="<?php echo $akun_user; ?>">
            <a href="index.php?page=akun_user">
          <i class="fa fa-cube"></i> <span class="">Customer</span></a></li>
          <li class="<?php echo $kirim_barang_cs; ?>">
            <a href="index.php?page=kirim_barang">
          <i class="fa fa-cube"></i> <span class="">Data Klien</span></a>
          </li>
          <li class="<?php echo $riwayat_kirim_barang_cs; ?>">
            <a href="index.php?page=data_riwayat_panggilan">
          <i class="fa fa-phone"></i> <span class="">Riwayat Panggilan</span></a>
          </li>
          <li class="<?php echo $laporan_kerusakan_cs; ?>">
          <a href="index.php?page=laporan_kerusakan_cs">
            <i class="fa fa-indent"></i>
            <span>Laporan Kerusakan Alkes</span>
</a>
<?php 
			  $data1 = mysqli_num_rows(mysqli_query($koneksi, "select * from tb_laporan_kerusakan where exp=0"));
			  if ($data1==0) { ?>
            <?php } else { ?>
            <span class="pull-right-container">
            <span class="label label-primary pull-right">
		    <?php
			  echo "".$data1;
			  ?></span>
          </span>
          <?php } ?>
        </a>
          
        </li>
         <li class="header"><strong><em>LAPORAN</em></strong></li>
        <li><a href="proses_logout.php" onclick="return confirm('Yakin Akan Keluar Dari Aplikasi ?')"><i class="fa fa-close"></i> <span>Logout</span></a></li>
       
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>