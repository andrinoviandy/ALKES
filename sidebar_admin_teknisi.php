<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="kharisma.png" class="" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Manajemen Teknisi</p>
          <a href="#"><i class="fa fa-circle text-success"></i> <?php
          $sel = mysqli_fetch_array(mysqli_query($koneksi, "select * from akun_admin_teknisi where id=".$_SESSION['id'].""));
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
        </a></li>
        <!--<li class="header">INVOICE</li>
        <li class="<?php //echo $act3; ?>">
          <a href="index.php?page=uji_fungsi_instalasi">
            <i class="fa fa-sticky-note-o"></i> <span>Invoice Barang</span>
            <span class="pull-right-container">
              
            </span>
          </a></li>-->
        <!--<li class="header">ALKES (MASUK - JUAL - KIRIM)</li>
        <li class="treeview <?php //echo $act2; ?>">
        <a href="#">
            <i class="fa fa-adjust"></i> <span>Master Alkes</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        <ul class="treeview-menu">
        <li class="<?php //echo $sub_act2_1; ?>">
         <a href="index.php?page=barang_masuk"><i class="fa fa-cube text-green"></i> <span class="text-green">Alkes Masuk</span>
            <span class="pull-right-container">
              
            </span>
            </a>
        </li>
        <li class="<?php //echo //$sub_act2_2; ?>">
          <a href="index.php?page=jual_barang">
            <i class="fa fa-cube text-aqua"></i> <span class="text-aqua">Jual Alkes </span>
            <span class="pull-right-container">
              
            </span>
            </a>
        </li>
        <li class="<?php //echo $sub_act2_3; ?>">
          <a href="index.php?page=kirim_barang">
            <i class="fa fa-cube text-yellow"></i> <span class="text-yellow">Pengiriman Alkes </span>
            <span class="pull-right-container">
              
            </span>
            </a>
        </li>
        </ul>
        </li>-->
        <li class="header"><strong style="color:#F90"><em>BAGIAN TEKNISI</em></strong></li>
        <li class="<?php echo $kirim_teknisi; ?>">
          <a href="index.php?page=kirim_barang">
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
        <li class="treeview <?php echo $kasbon; ?>">
          <a href="#">
            <i class="fa fa-money"></i> <span>Kasbon</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          <li class="<?php echo $kasbon_perjalanan_dinas; ?>"><a href="index.php?page=kasbon_perjalanan_dinas">
          <i class="fa fa-circle-o"></i>Perjalanan Dinas </a></li>
          <li class="<?php echo $kasbon_pembelian; ?>"><a href="index.php?page=kasbon_pembelian">
          <i class="fa fa-circle-o"></i>Pembelian </a></li>
          </ul>
        </li>
        <li class="<?php echo $act3; ?>">
          <a href="index.php?page=uji_fungsi_instalasi">
            <i class="fa fa-cube"></i> <span>Instalasi & Uji Fungsi</span>
            <span class="pull-right-container">
              
            </span>
          </a></li>
        
        <li class="<?php echo $act4; ?>">
          <a href="index.php?page=pelatihan_alat">
        <i class="fa fa-cube"></i> <span>Pelatihan Alat</span></a></li>
        <li class="<?php echo $rekapan_instalasi; ?>">
          <a href="index.php?page=rekapan_instalasi">
        <i class="fa fa-calendar"></i> <span>Rekapan Instalasi</span></a></li>
        <li class="header"><strong style="color:#F90"><em>KERUSAKAN ALKES (SERVICE)</em></strong></li>
        <li class="header"><strong style="color:#F90"><em>- BELUM TERJUAL</em></strong></li>
        <li class="<?php echo $barang_gudang_rusak; ?>">
         <a href="index.php?page=barang_rusak"><i class="fa fa-cube"></i> <span class="">Alkes Rusak</span>
            <span class="pull-right-container">
              
            </span>
          </a>
        </li>
        <li class="<?php echo $progress_dalam; ?>">
          <a href="index.php?page=progress_rusak_dalam">
            <i class="fa fa-archive"></i> <span>Progress Pengerjaan</span>
        </a></li>
        <li class="header"><strong style="color:#F90"><em>- SUDAH TERJUAL</em></strong></li>
        
        <li class="<?php echo $act_user; ?>">
          <a href="index.php?page=akun_user">
          <i class="fa fa-user"></i> <span>Customer</span></a>
            <span class="pull-right-container">
              
            </span>
          </a>
        </li>
        <!--<li class="<?php echo $act5; ?>">
          <a href="index.php?page=barang">
          <i class="fa fa-clipboard"></i> <span>Kerusakan  Alkes</span></a>
            <span class="pull-right-container">
              
            </span>
          </a>
        </li>-->
        <li class="<?php echo $act6; ?>">
          <a href="index.php?page=laporan_kerusakan">
            <i class="fa fa-indent"></i>
            <span>Laporan - Pilih Teknisi/No Seri</span>
</a>
<?php 
			  $data1 = mysqli_num_rows(mysqli_query($koneksi, "select * from tb_laporan_kerusakan where exp=0"));
			  if ($data1==0) { ?>
            <?php } else { ?>
            <span class="pull-right-container">
            <span class="label label-primary pull-right">
		    <?php
			  echo "".$data1; }
			  ?></span>
          </span>
        </a>
          
        </li>
        <li class="<?php echo $act7; ?>">
          <a href="index.php?page=pembuatan_spk">
            <i class="fa fa-outdent"></i> <span> Teknisi Yang Menangani</span>
            <span class="pull-right-container">
              <!--<small class="label pull-right bg-green">
              <?php $total11=mysqli_num_rows(mysqli_query($koneksi, "select * from tb_maintenance_detail"));
			  echo $total11;
			   ?>
              </small>-->
            </span>
          </a>
        </li>
        <li class="<?php echo $act8; ?>">
          <a href="index.php?page=progress_pengerjaan">
            <i class="fa fa-archive"></i> <span>Progress Perbaikan</span>
            <span class="pull-right-container">
              <!--<small class="label pull-right bg-red">
              <?php $total1=mysqli_num_rows(mysqli_query($koneksi, "select * from tb_maintenance_detail where status_proses=0"));
			  echo $total1; ?>
              </small><small class="label pull-right bg-yellow"><?php $total2=mysqli_num_rows(mysqli_query($koneksi, "select * from tb_maintenance where status_proses=1"));
			  echo $total2; ?>
              </small>-->
            </span>
        </a></li>
        
        <li class="header"><strong style="color:#F90"><em>- Barang Yg Dikembalikan Karena Rusak</em></strong></li>
        <li class="<?php echo $barang_kembali_teknisi; ?>">
         <a href="index.php?page=barang_kembali_teknisi"><i class="fa fa-cube"></i> <span class="">Data Alkes</span>
            <span class="pull-right-container">
              
            </span>
          </a>
        </li>
        <li class="<?php echo $progress_barang_kembali; ?>">
          <a href="index.php?page=progress_barang_kembali">
            <i class="fa fa-archive"></i> <span>Progress Pengerjaan</span>
        </a></li>
        <li class="header"><strong><em>LAPORAN</em></strong></li>
        <li class="treeview <?php echo $act12; ?>">
          <a href="#">
            <i class="fa fa-edit"></i> <span>Laporan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          
          <!--<li><a href="index.php?page=pic"><i class="fa fa-circle-o"></i> PIC </a></li>-->
          <li class=<?php echo $act12_3; ?>><a href="index.php?page=laporan_kerusakan_barang"><i class="fa fa-circle-o"></i> Kerusakan Alkes </a></li>
          
            <!--<li class=<?php //echo $act12_5; ?>><a href="index.php?page=laporan_teknisi"><i class="fa fa-circle-o"></i> Teknisi </a></li>-->
          </ul>
        </li>
        <!--
        <li class="header">PENGATURAN TEKNISI, PIC, & AKUN</li>
        <li class="treeview <?php echo $act10; ?>">
          <a href="#">
          <i class="fa fa-adjust"></i> <span>Pengaturan</span><span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span></a>
          <ul class="treeview-menu">
          <li class="<?php //echo $sub_act10_3; ?>"><a href="index.php?page=pic"><i class="fa fa-circle-o"></i>PIC </a></li>
            <li class="treeview <?php echo $akun; ?>"><a href="#"><i class="fa fa-circle-o"></i> <span>Akun</span><span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span></a>
            <ul class="treeview-menu">
                
                <li class="<?php echo $teknisi; ?>"><a href="index.php?page=teknisi"><i class="fa fa-circle-o"></i> User Teknisi</a></li>
                
              </ul>
            </li>
            
          </ul>
        </li>
        -->
        <li class="header"><strong><em>PENGATURAN TEKNISI, PIC, & AKUN</em></strong></li>
        <li class="treeview <?php echo $act10; ?>">
          <a href="#">
            <i class="fa fa-adjust"></i> <span>Pengaturan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          <li class="<?php echo $teknisi; ?>"><a href="index.php?page=teknisi">
          <i class="fa fa-circle-o"></i>Teknisi </a></li>
          <!--<li class="<?php //echo $sub_act10_3; ?>"><a href="index.php?page=pic"><i class="fa fa-circle-o"></i>PIC </a></li>-->
            
            
          </ul>
        </li>
        <li><a href="proses_logout.php" onclick="return confirm('Yakin Akan Keluar Dari Aplikasi ?')"><i class="fa fa-close"></i> <span>Logout</span></a></li>
        <li class="header"><strong><em>KETERANGAN</em></strong></li>
        <li><a><i class="fa fa-circle-o text-aqua"></i> <span>Kerusakan Belum SPK</span></a></li>
        <li><a><i class="fa fa-circle-o text-green"></i> <span>Jumlah SPK</span></a></li>
        <li><a><i class="fa fa-circle-o text-yellow"></i> <span>Sedang Dikerjakan</span></a></li>
        <li><a><i class="fa fa-circle-o text-red"></i> <span>Belum Dikerjakan</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
