<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="kharisma.png" class="" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Admin Gudang</p>
          <a href="#"><i class="fa fa-circle text-success"></i> <?php
          $sel = mysqli_fetch_array(mysqli_query($koneksi, "select * from akun_admin_gudang where id=".$_SESSION['id'].""));
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
        <li class="header"><span><strong style="color:#0C0"><em>GUDANG</em></strong></span></li>
        <li class="treeview <?php echo $act2; ?>">
        <a href="#">
            <i class="fa fa-cubes"></i> <span>Master Alkes</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        <ul class="treeview-menu">
        
        <!---
        <li class="<?php echo $sub_act2_1; ?>">
         <a href="index.php?page=barang_masuk_0"><i class="fa fa-cube text-green"></i> <span class="text-green">Alkes Gudang 1</span>
            <span class="pull-right-container">
              
            </span>
            </a>
        </li>-->
        <li class="treeview <?php echo $pemesanan; ?>">
          <a href="#">
            <i class="fa fa-cube"></i> <span class="">Pemesanan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
                <li class="<?php echo $pemesanan1; ?>"><a href="index.php?page=barang_gudang1" class=""><i class="fa fa-circle-o"></i> Alkes (Gudang 1)</a></li>
                
                
            </ul>
        </li>
        
        <!--
        <li class="<?php echo $gudang_set; ?>">
         <a href="index.php?page=barang_gudang1_set"><i class="fa fa-cube"></i> <span class="">Barang Set</span>
            <span class="pull-right-container">
              
            </span>
            </a>
        </li>-->
        <li class="<?php echo $sub_act2_1; ?>">
         <a href="index.php?page=barang_masuk"><i class="fa fa-cube"></i> <span class="">Gudang 2 (Utama)</span>
            <span class="pull-right-container">
              
            </span>
            </a>
        </li>
        <li class="<?php echo $opname; ?>">
         <a href="index.php?page=opname_awal"><i class="fa fa-cube"></i> <span class="">Stok OPNAME</span>
            <span class="pull-right-container">
              
            </span>
            </a>
        </li>
        <li class="treeview <?php echo $barang_demo; ?>">
          <a href="#">
            <i class="fa fa-cube"></i> <span class="">Barang Demo </span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
                <li class="<?php echo $barang_demo1; ?>"><a href="index.php?page=barang_demo" class=""><i class="fa fa-circle-o"></i> Rencana Bar. Demo</a></li>
                <li class="<?php echo $barang_demo2; ?>">
                <a href="index.php?page=kirim_barang_demo" class=""><i class="fa fa-circle-o"></i> Pengiriman Barang</a>
                </li>
                <li class="<?php echo $barang_demo3; ?>">
                <a href="index.php?page=kembali_barang_demo" class=""><i class="fa fa-circle-o"></i> Pengembalian Barang</a>
                </li>
                <!--
                <li class="<?php echo $admin_jual_alkes; ?>"><a href="index.php?page=admin_jual_alkes"><i class="fa fa-circle-o"></i> Admin Jual Alkes</a></li>-->
                
            </ul>
        </li>
        <!--
        <li class="<?php echo $barang_gudang_rusak; ?>">
         <a href="index.php?page=barang_rusak"><i class="fa fa-cube"></i> <span class="">Alkes Rusak</span>
            <span class="pull-right-container">
              
            </span>
            </a>
        </li>
        -->
        <li class="<?php echo $sub_act2_2; ?>">
          <a href="index.php?page=jual_barang">
            <i class="fa fa-cube"></i> <span class="">Pengiriman Alkes</span>
            <span class="pull-right-container">
              
            </span>
            </a>
        </li>
        <li class="<?php echo $sub_act2_3; ?>">
          <a href="index.php?page=kirim_barang">
            <i class="fa fa-cube"></i> <span class="">Data Alkes Terkirim</span>
            <span class="pull-right-container">
              
            </span>
            </a>
        </li>
        <li class="<?php echo $sub_act2_3_3; ?>">
          <a href="index.php?page=spi">
            <i class="fa fa-cube"></i> <span class="">Buat SPI </span>
            <span class="pull-right-container">
              
            </span>
            </a>
        </li>
        <li class="treeview <?php echo $pengembalian_barang; ?>">
          <a href="#">
            <i class="fa fa-cube"></i> <span class="">Pengembalian Barang </span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
                <li class="treeview <?php echo $rusak; ?>"><a href="#" class=""><i class="fa fa-circle-o"></i> Rusak <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span></a>
                <ul class="treeview-menu">
                <li class="<?php echo $belum_terjual; ?>">
                <a href="index.php?page=barang_rusak" class=""><i class="fa fa-circle-o"></i> Belum Terjual</a>
                </li>
                <li class="<?php echo $sudah_terjual; ?>">
                <a href="index.php?page=barang_kembali" class=""><i class="fa fa-circle-o"></i> Sudah Terjual</a>
                </li>
                </ul>
                </li>
                <li class="treeview <?php echo $tidak_rusak; ?>"><a href="#" class=""><i class="fa fa-circle-o"></i> Tidak Rusak <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span></a>
                  <ul class="treeview-menu">
                <li class="<?php echo $sudah_terjual2; ?>">
                <a href="index.php?page=barang_kembali_tidak_rusak" class=""><i class="fa fa-circle-o"></i> Sudah Terjual</a>
                </li>
                </ul>
                </li>
                <!--
                <li class="<?php echo $admin_jual_alkes; ?>"><a href="index.php?page=admin_jual_alkes"><i class="fa fa-circle-o"></i> Admin Jual Alkes</a></li>-->
                
            </ul>
        </li>
        <li class="treeview <?php echo $peminjaman_barang; ?>">
          <a href="#">
            <i class="fa fa-cube"></i> <span class="">Peminjaman Barang</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
                <li class="<?php echo $peminjaman_barang1; ?>"><a href="index.php?page=peminjaman_barang" class=""><i class="fa fa-circle-o"></i> Data Barang</a></li>
                <li class="<?php echo $peminjaman_barang2; ?>">
                <a href="index.php?page=kirim_pinjam_barang" class=""><i class="fa fa-circle-o"></i> Pengiriman Barang</a>
                </li>
                <li class="<?php echo $peminjaman_barang3; ?>">
                <a href="index.php?page=kembali_pinjam_barang" class=""><i class="fa fa-circle-o"></i> Pengembalian Barang</a>
                </li>
                <!--
                <li class="<?php echo $admin_jual_alkes; ?>"><a href="index.php?page=admin_jual_alkes"><i class="fa fa-circle-o"></i> Admin Jual Alkes</a></li>-->
                
            </ul>
        </li>
        
        </ul>
        
        </li>
        <!--
        <li class="<?php echo $act_aksesoris_alkes; ?>">
          <a href="index.php?page=aksesoris_alkes">
            <i class="fa fa-gears"></i> <span>Spare Part Alkes</span>
            <span class="pull-right-container">
              
            </span>
          </a></li>-->
        
        <li class="treeview <?php echo $barang_set; ?>">
         <a href="#"><i class="fa fa-cubes"></i> <span class="">Master Barang Set</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
            <ul class="treeview-menu">
                <li class="<?php echo $barang_set1; ?>"><a href="index.php?page=barang_set" class=""><i class="fa fa-circle-o"></i> Data Master Barang</a></li>
                <li class="<?php echo $barang_set2; ?>">
                <a href="index.php?page=penjualan_barang_set" class=""><i class="fa fa-circle-o"></i> Pengiriman Barang</a>
                </li>
                <li class="<?php echo $barang_set3; ?>">
                <a href="index.php?page=pengiriman_barang_set" class=""><i class="fa fa-circle-o"></i> Data Pengiriman Barang</a>
                </li>
          </ul>
        </li>
        <li class="treeview <?php echo $akse; ?>">
         <a href="#"><i class="fa fa-gears"></i> <span class="">Master Aksesoris</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
            <ul class="treeview-menu">
            	<li class="<?php echo $akse0; ?>"><a href="index.php?page=aksesoris1" class=""><i class="fa fa-circle-o"></i>Pemesanan Aksesoris</a></li>
                <li class="<?php echo $akse1; ?>"><a href="index.php?page=aksesoris" class=""><i class="fa fa-circle-o"></i>Data Aksesoris</a></li>
                <li class="<?php echo $akse2; ?>"><!--<a href="index.php?page=jual_akse" class="text-green"><i class="fa fa-circle-o text-green"></i> Penjualan Aksesoris</a>-->
                <a href="index.php?page=penjualan_aksesoris" class=""><i class="fa fa-circle-o"></i>Pengiriman Aksesoris</a>
                </li>
                <li class="<?php echo $akse3; ?>"><!--<a href="index.php?page=jual_akse" class="text-green"><i class="fa fa-circle-o text-green"></i> Penjualan Aksesoris</a>-->
                <a href="index.php?page=pengiriman_aksesoris" class=""><i class="fa fa-circle-o"></i>Data Pengiriman Aksesoris</a>
                </li>
                <!--
                <li class="<?php echo $admin_jual_alkes; ?>"><a href="index.php?page=admin_jual_alkes"><i class="fa fa-circle-o"></i> Admin Jual Alkes</a></li>-->
                
          </ul>
        </li>

        <li class="treeview <?php echo $inventory; ?>">
         <a href="#"><i class="fa fa-gears"></i> <span class="">Master Inventory</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
            <ul class="treeview-menu">
            	<li class="<?php echo $inven1; ?>"><a href="index.php?page=barang_inventory1" class=""><i class="fa fa-circle-o"></i> Pemesanan Barang</a></li>
                <li class="<?php echo $inven2; ?>"><a href="index.php?page=barang_inventory" class=""><i class="fa fa-circle-o"></i> Data Barang</a></li>
                <li class="<?php echo $inven3; ?>">
                <a href="index.php?page=penjualan_inventory_kirim" class=""><i class="fa fa-circle-o"></i> Pengiriman Barang</a>
                </li>
                <li class="<?php echo $inven4; ?>">
                <a href="index.php?page=kirim_inventory" class=""><i class="fa fa-circle-o"></i> Data Pengiriman Barang</a>
                </li>
                <!--
                <li class="<?php echo $admin_jual_alkes; ?>"><a href="index.php?page=admin_jual_alkes"><i class="fa fa-circle-o"></i> Admin Jual Alkes</a></li>-->
                
          </ul>
        </li>
        <li class="<?php echo $act_penyebaran_alkes; ?>">
          <a href="index.php?page=penyebaran_alkes">
            <i class="fa fa-wifi"></i> <span>Penyebaran Alkes</span>
            <span class="pull-right-container">
              
            </span>
          </a></li>
          
        <li class="treeview <?php echo $pengaturan_gudang; ?>">
          <a href="#">
            <i class="fa fa-adjust"></i> <span>Pengaturan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          <li class="<?php echo $pengaturan_pembeli; ?>"><a href="index.php?page=pembeli">
          <i class="fa fa-circle-o"></i>Pembeli </a></li>
          </ul>
          </li>
           <!--<li class="<?php echo $act_import_alkes; ?>">
          <a href="index.php?page=import_data">
            <i class="fa fa-upload"></i> <span>Import Data Gudang</span>
            <span class="pull-right-container">
              
            </span>
          </a></li>-->
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
          <li class="treeview <?php echo $act_lap_beli_akes; ?>"><a href="#"><i class="fa fa-circle-o"></i><span> Pembelian Alkes</span><span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span></a>
          <ul class="treeview-menu">
                <li class="<?php echo $dalam_negeri; ?>"><a href="index.php?page=laporan_pembelian_alkes1"><i class="fa fa-circle-o"></i> Dalam Negeri</a></li>
                <li class="<?php echo $luar_negeri; ?>"><a href="index.php?page=laporan_pembelian_alkes2"><i class="fa fa-circle-o"></i> Luar Negeri</a></li>
                <!--
                <li class="<?php echo $admin_jual_alkes; ?>"><a href="index.php?page=admin_jual_alkes"><i class="fa fa-circle-o"></i> Admin Jual Alkes</a></li>-->
                
              </ul>
          </li>
          <!--<li class=<?php echo $act_lap_akes; ?>><a href="index.php?page=laporan_penjualan_alkes"><i class="fa fa-circle-o"></i> Penjualan Alkes </a></li>
          -->
          
            <!--<li class=<?php //echo $act12_5; ?>><a href="index.php?page=laporan_teknisi"><i class="fa fa-circle-o"></i> Teknisi </a></li>-->
          </ul>
        </li>
        
        <li><a href="proses_logout.php" onclick="return confirm('Yakin Akan Keluar Dari Aplikasi ?')"><i class="fa fa-close"></i> <span>Logout</span></a></li>
       
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>