<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="kharisma.png" class="" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Administrator</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <?php include "active.php"; ?>
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header"><em><strong>NAVIGASI</strong></em></li>
<li class="<?php echo $act1; ?>">
          <a href="index.php?page=beranda">
            <i class="fa fa-dashboard"></i> <span>Beranda</span>
            <span class="pull-right-container">
              
            </span>
          </a><!---
        <li class="<?php echo $sub_act2_1; ?>">
         <a href="index.php?page=barang_masuk_0"><i class="fa fa-cube text-green"></i> <span class="text-green">Alkes Gudang 1</span>
            <span class="pull-right-container">
              
            </span>
            </a>
        </li>-->        </li>
        <li class="treeview active"><a href="#"><i>(G)</i> <span><strong style="color:#0C0"><em>GUDANG</em></strong></span><span class="pull-right-container">
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
        <li class="treeview <?php echo $act2; ?>">
        <a href="#">
            <i class="fa fa-cubes"></i> <span>Master Alkes</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        <ul class="treeview-menu">
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
              </a><!--
                <li class="<?php echo $admin_jual_alkes; ?>"><a href="index.php?page=admin_jual_alkes"><i class="fa fa-circle-o"></i> Admin Jual Alkes</a></li>-->         </li>
                <li class="<?php echo $sub_act2_3; ?>">
          <a href="index.php?page=kirim_barang">
            <i class="fa fa-cube"></i> <span class="">Data Pengiriman Alkes</span>
            <span class="pull-right-container">
              
            </span>
            </a>
        </li>
        <li class="<?php echo $sub_act2_3_3; ?>">
          <a href="index.php?page=spi">
            <i class="fa fa-cube"></i> <span class="">Surat Perintah Instalasi</span>
            <span class="pull-right-container">
              
            </span>
            </a>
        </li>
                </ul>
                </li>
                <li class="treeview <?php echo $barang_set; ?>">
         <a href="#"><i class="fa fa-cubes"></i> <span class="">Master Barang Set</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
            <ul class="treeview-menu">
                <!--<li class="<?php echo $barang_set0; ?>"><a href="index.php?page=barang_set1" class=""><i class="fa fa-circle-o"></i> Pemesanan Barang</a></li>-->
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
            	
                <li class="<?php echo $akse1; ?>"><a href="index.php?page=aksesoris" class=""><i class="fa fa-circle-o"></i>Data Aksesoris</a></li>
                
                <!--
                <li class="<?php echo $admin_jual_alkes; ?>"><a href="index.php?page=admin_jual_alkes"><i class="fa fa-circle-o"></i> Admin Jual Alkes</a></li>-->
                
          </ul>
        </li>
        <!--
        <li class="<?php echo $act_aksesoris_alkes; ?>">
          <a href="index.php?page=aksesoris_alkes">
            <i class="fa fa-gears"></i> <span>Spare Part Alkes</span>
            <span class="pull-right-container">
              
            </span>
          </a></li>-->
          </ul>
        </li>
          
          
          <!--
          <li class="<?php echo $act_deposit; ?>"> <a href="index.php?page=deposit_ke_gudang"> <i class="fa fa-upload"></i> <span>Deposit Ke Gudang</span></a></li>
        
        <li class="<?php echo $act_pengeluaran; ?>"> <a href="index.php?page=pengeluaran"> <i class="fa fa-calculator"></i> <span>Pengeluaran</span></a></li>-->
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
        
        <li class="treeview active"><a href="#"><i>(T)</i> <span><strong style="color:#F90"><em> TEKNISI</em></strong></span><span class="pull-right-container">
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
        <!--
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
        </li>
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
        -->
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
        <!--
                <li class="<?php echo $riwayat_pemasukan; ?>">
                <a href="index.php?page=riwayat_pemasukan" class=""><i class="fa fa-circle-o"></i> Riwayat Pemasukan</a>
                </li>
                <li class="<?php echo $riwayat_pengeluaran; ?>">
                <a href="index.php?page=riwayat_pengeluaran" class=""><i class="fa fa-circle-o"></i> Riwayat Pengeluaran</a>
                </li>-->          </li>
          <li class="treeview active"><a href="#"><i>(C)</i> <span><strong style="color:#C6C"><em>CUSTOMER SERVICE</em></strong></span><span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span></a>
        <ul class="treeview-menu">
        <li class="<?php echo $akun_user; ?>">
            <a href="index.php?page=akun_user">
          <i class="fa fa-cube"></i> <span class="">Customer</span></a></li>
          <li class="<?php echo $kirim_barang_cs; ?>">
            <a href="index.php?page=kirim_barang_cs">
          <i class="fa fa-cube"></i> <span class="">Data Klien</span></a>
          </li>
          <li class="<?php echo $riwayat_kirim_barang_cs; ?>">
            <a href="index.php?page=data_riwayat_panggilan">
          <i class="fa fa-cube"></i> <span class="">Riwayat Panggilan</span></a>
          </li>
        </ul>
        </li>
        <li class="treeview active"><a href="#"><i>(K)</i> <span><strong style="color:#CC0"><em> KEUANGAN</em></strong></span><span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span></a>
        <ul class="treeview-menu">
        	
        <li class="treeview <?php echo $act2_2; ?>"><a href="#">
        <i class="fa fa-cart-plus"></i>
        <span>Penjualan</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
          <ul class="treeview-menu">
          
            <li class="treeview <?php echo $sub_act2_2; ?>"> <a href="#"> <i class="fa fa-circle-o"></i> <span class="">Penjualan Alkes</span> <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span> </a> 
            <ul class="treeview-menu">
                <li class="<?php echo $sub_act2_2_1; ?>"><a href="index.php?page=jual_barang_uang" class=""><i class="fa fa-circle-o"></i> Alkes Ber No Seri</a></li>
                        
        <li class="<?php echo $sub_act2_2_2; ?>"><a href="index.php?page=penjualan_barang_set" class=""><i class="fa fa-circle-o"></i> Alkes Ber Set</a></li>
                </ul>
            </li>
            <li class="<?php echo $sub_act2_3; ?>"><!--<a href="index.php?page=jual_akse" class="text-green"><i class="fa fa-circle-o text-green"></i> Penjualan Aksesoris</a>-->
                <a href="index.php?page=penjualan_aksesoris_uang" class=""><i class="fa fa-circle-o"></i> Penjualan Aksesoris</a>
                </li>
                <li class="<?php echo $sub_act2_4; ?>">
                <a href="index.php?page=penjualan_inventory" class=""><i class="fa fa-circle-o"></i> Penjualan Bar. Inventory</a>
                </li>
                <!--
                <li class="<?php echo $sub_act2_4; ?>">
                <a href="index.php?page=penjualan_barang_set" class=""><i class="fa fa-circle-o"></i> Penjualan Barang Set</a>
                </li>-->
          </ul>
        </li>
        
          </ul>
          </li>
        <li><a href="proses_logout.php" onclick="return confirm('Yakin Akan Keluar Dari Aplikasi ?')"><i class="fa fa-close"></i> <span>Logout</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>