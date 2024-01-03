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
          </a>
        </li>
        <li class="treeview <?php echo $po; ?>"><a href="#"><strong style="color:#09F"><em>PURCHASE ORDER</em></strong>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
        </a>
          <ul class="treeview-menu">
            <li class="treeview <?php echo $sub_act2_pesan; ?>">
              <a href="#"><i class="fa fa-cube"></i> <span class="">Pemesanan Alkes</span>
              <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
              </span>
              </a>
              <ul class="treeview-menu">
                <li class="<?php echo $pil1; ?>"><a href="index.php?page=pembelian_alkes" class=""><i class="fa fa-circle-o"></i> PO Dalam Negeri</a></li>
                <li class="treeview <?php echo $pil2; ?>"><!--<a href="index.php?page=jual_akse" class="text-green"><i class="fa fa-circle-o text-green"></i> Penjualan Aksesoris</a>-->
                  <a href="#" class=""><i class="fa fa-circle-o"></i> PO Luar Negeri
                  <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
              </span>
                  </a>
                <ul class="treeview-menu">
                <li class="<?php echo $po_no_seri; ?>"><a href="index.php?page=pembelian_alkes2" class=""><i class="fa fa-circle-o"></i> Alkes Ber No Seri</a></li>
                        <!--
        <li class="<?php echo $po_set; ?>"><a href="index.php?page=pembelian_alkes2_set" class=""><i class="fa fa-circle-o"></i> Alkes Ber Set</a></li>-->
                </ul>
                </li>
                <!--
                <li class="<?php echo $admin_jual_alkes; ?>"><a href="index.php?page=admin_jual_alkes"><i class="fa fa-circle-o"></i> Admin Jual Alkes</a></li>-->
                
              </ul>
            </li>
            <li class="treeview <?php echo $po_inventory; ?>">
              <a href="#"><i class="fa fa-cube"></i> <span class="">Pemesanan Inventory</span>
              <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
              </span>
              </a>
              <ul class="treeview-menu">
                <li class="<?php echo $po_inventory1; ?>">
                  <a href="index.php?page=pembelian_inventory" class=""><i class="fa fa-circle-o"></i> PO Dalam Negeri</a>
                </li>
                <li class="<?php echo $po_inventory2; ?>">
                  <a href="index.php?page=pembelian_inventory2" class=""><i class="fa fa-circle-o"></i> PO Luar Negeri</a>
                </li>
                <!--
                <li class="<?php echo $admin_jual_alkes; ?>"><a href="index.php?page=admin_jual_alkes"><i class="fa fa-circle-o"></i> Admin Jual Alkes</a></li>-->
                
              </ul>
            </li>
            <!---
        <li class="<?php echo $sub_act2_1; ?>">
         <a href="index.php?page=barang_masuk_0"><i class="fa fa-cube text-green"></i> <span class="text-green">Alkes Gudang 1</span>
            <span class="pull-right-container">
              
            </span>
            </a>
        </li>-->
            
          </ul>
</li>
        <li class="treeview <?php echo $gudang; ?>"><a href="#"><strong style="color:#0C0"><em>BAGIAN GUDANG</em></strong><span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span></a>
        <ul class="treeview-menu">
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
        <li class="<?php echo $gudang1; ?>">
         <a href="index.php?page=barang_gudang1"><i class="fa fa-cube"></i> <span class="">Gudang 1</span>
            <span class="pull-right-container">
              
            </span>
            </a>
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
        <li class="<?php echo $barang_demo; ?>">
         <a href="index.php?page=barang_demo"><i class="fa fa-cube"></i> <span class="">Barang Demo</span>
            <span class="pull-right-container">
              
            </span>
            </a>
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
            <i class="fa fa-cube"></i> <span class="">Penj. Alkes (PO Masuk)</span>
            <span class="pull-right-container">
              
            </span>
            </a>
        </li>
        <li class="<?php echo $sub_act2_3; ?>">
          <a href="index.php?page=kirim_barang">
            <i class="fa fa-cube"></i> <span class="">Pengiriman Alkes </span>
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
        <li class="treeview <?php echo $barang_kembali1; ?>">
          <a href="#">
            <i class="fa fa-cube"></i> <span class="">Alkes Rusak </span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
                <li class="<?php echo $barang_rusak; ?>"><a href="index.php?page=barang_rusak" class=""><i class="fa fa-circle-o"></i> Belum Terjual</a></li>
                <li class="<?php echo $barang_kembali; ?>"><!--<a href="index.php?page=jual_akse" class="text-green"><i class="fa fa-circle-o text-green"></i> Penjualan Aksesoris</a>-->
                <a href="index.php?page=barang_kembali" class=""><i class="fa fa-circle-o"></i> Sudah Terjual</a>
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
        <!--
        <li class="treeview <?php echo $barang_set; ?>">
         <a href="#"><i class="fa fa-cubes"></i> <span class="">Master Barang Set</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
            <ul class="treeview-menu">
                <li class="<?php echo $barang_set1; ?>"><a href="index.php?page=barang_set" class=""><i class="fa fa-circle-o"></i> Data Barang</a></li>
                <li class="<?php echo $barang_set2; ?>">
                <a href="index.php?page=penjualan_barang_set" class=""><i class="fa fa-circle-o"></i> Penjualan Barang</a>
                </li>
                <li class="<?php echo $barang_set3; ?>">
                <a href="index.php?page=pengiriman_barang_set" class=""><i class="fa fa-circle-o"></i> Pengiriman Barang</a>
                </li>
                <!--
                <li class="<?php echo $admin_jual_alkes; ?>"><a href="index.php?page=admin_jual_alkes"><i class="fa fa-circle-o"></i> Admin Jual Alkes</a></li>
                
          </ul>
        </li>-->
        <li class="treeview <?php echo $akse; ?>">
         <a href="#"><i class="fa fa-gears"></i> <span class="">Master Aksesoris</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
            <ul class="treeview-menu">
                <li class="<?php echo $akse1; ?>"><a href="index.php?page=aksesoris" class=""><i class="fa fa-circle-o"></i> Data Aksesoris</a></li>
                <li class="<?php echo $akse2; ?>"><!--<a href="index.php?page=jual_akse" class="text-green"><i class="fa fa-circle-o text-green"></i> Penjualan Aksesoris</a>-->
                <a href="index.php?page=penjualan_aksesoris" class=""><i class="fa fa-circle-o"></i> Penjualan Aksesoris</a>
                </li>
                <li class="<?php echo $akse3; ?>"><!--<a href="index.php?page=jual_akse" class="text-green"><i class="fa fa-circle-o text-green"></i> Penjualan Aksesoris</a>-->
                <a href="index.php?page=pengiriman_aksesoris" class=""><i class="fa fa-circle-o"></i> Pengiriman Aksesoris</a>
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
        <li class="treeview <?php echo $bagian_teknisi; ?>"><a href="#"><strong style="color:#F90"><em>BAGIAN TEKNISI</em></strong><span class="pull-right-container">
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
            <i class="fa fa-cube"></i> <span>Surat Perintah Instalasi</span>
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
         <a href="index.php?page=barang_rusak"><i class="fa fa-cube"></i> <span class="">Alkes Rusak</span>
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
         <a href="index.php?page=barang_kembali_teknisi"><i class="fa fa-cube"></i> <span class="">Data Alkes</span>
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
        
        <li class="treeview <?php echo $bagian_keuangan; ?>"><a href="#"><strong style="color:#CC0"><em>BAGIAN KEUANGAN</em></strong><span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span></a>
        <ul class="treeview-menu">
        
        
          <li class="<?php echo $buku_kas; ?>">
          <a href="index.php?page=buku_kas">
            <i class="fa fa-book"></i> <span>Buku Besar</span>
            <span class="pull-right-container">
              
            </span>
          </a></li>
          <!--
          <li class="treeview <?php echo $utang_piutang; ?>">
          <a href="#">
            <i class="fa fa-bank"></i> <span>Kas Bank</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
                <li class="<?php echo $utang; ?>"><a href="index.php?page=utang" class=""><i class="fa fa-circle-o"></i> Pembayaran</a></li>
                <li class="<?php echo $piutang; ?>">
                <a href="index.php?page=piutang" class=""><i class="fa fa-circle-o"></i> Penerimaan</a>
                </li>
          </ul>
          </li>-->
          <li class="treeview <?php echo $sub_act2_1; ?>">
            <a href="#"><i class="fa fa-cube"></i> <span class="">Persediaan</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
          <li class="<?php echo $sub_act2_1_1; ?>">
         <a href="index.php?page=barang_masuk"><i class="fa fa-cube"></i> <span class="">Alkes</span>
            <span class="pull-right-container">
              
            </span>
            </a>
        </li>          
            
            <li class="<?php echo $sub_act2_1_2; ?>"> <a href="index.php?page=aksesoris"> <i class="fa fa-cube"></i> <span class="">Aksesoris</span> <span class="pull-right-container"> </span> </a> </li>
            <!--
            <li class="<?php echo $sub_act2_1_3; ?>"> <a href="index.php?page=barang_set"> <i class="fa fa-cube"></i> <span class="">Barang Set</span> <span class="pull-right-container"> </span> </a> </li>
            -->
          </ul>
          </li>
        <li class="treeview <?php echo $act2_2; ?>"><a href="#">
        <i class="fa fa-cart-plus"></i>
        <span>Penjualan</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
          <ul class="treeview-menu">
          
            <li class="<?php echo $sub_act2_2; ?>"> <a href="index.php?page=jual_barang_uang"> <i class="fa fa-circle-o"></i> <span class="">Penjualan Alkes</span> <span class="pull-right-container"> </span> </a> </li>
            <li class="<?php echo $sub_act2_3; ?>"><!--<a href="index.php?page=jual_akse" class="text-green"><i class="fa fa-circle-o text-green"></i> Penjualan Aksesoris</a>-->
                <a href="index.php?page=penjualan_aksesoris_uang" class=""><i class="fa fa-circle-o"></i> Penjualan Aksesoris</a>
                </li>
                <!--
                <li class="<?php echo $sub_act2_4; ?>">
                <a href="index.php?page=penjualan_barang_set" class=""><i class="fa fa-circle-o"></i> Penjualan Barang Set</a>
                </li>-->
          </ul>
        </li>
        <li class="treeview <?php echo $kirim_barang_uang; ?>">
          <a href="#">
            <i class="fa fa-upload"></i> <span>Pengiriman</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          
            <li class="<?php echo $kirim_barang_uang1; ?>"> <a href="index.php?page=kirim_barang_uang"> <i class="fa fa-circle-o"></i> <span class="">Pengiriman Alkes</span> <span class="pull-right-container"> </span> </a> </li>
            <li class="<?php echo $kirim_barang_uang2; ?>"><!--<a href="index.php?page=jual_akse" class="text-green"><i class="fa fa-circle-o text-green"></i> Penjualan Aksesoris</a>-->
                <a href="index.php?page=pengiriman_aksesoris_uang" class=""><i class="fa fa-circle-o"></i> Pengiriman Aksesoris</a>
                </li>
                <!--
                <li class="<?php echo $kirim_barang_uang3; ?>"><a href="index.php?page=pengiriman_barang_set" class=""><i class="fa fa-circle-o"></i> Pengiriman Barang Set</a>
                </li>-->
          </ul>
          </li>
            <li class="<?php echo $pembelian; ?>">
          <a href="index.php?page=barang_gudang1">
            <i class="fa fa-upload"></i> <span>Pembelian</span>
            <span class="pull-right-container">
              
            </span>
          </a></li>
          
           <li class="<?php echo $deposit; ?>">
          <a href="index.php?page=deposit">
            <i class="fa fa-upload"></i> <span>Deposit</span>
            <span class="pull-right-container">
              
            </span>
          </a></li>
          <li class="treeview <?php echo $utang_piutang; ?>">
          <a href="#">
            <i class="fa fa-bank"></i> <span>Hutang / Piutang</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
                <li class="<?php echo $utang; ?>"><a href="index.php?page=utang" class=""><i class="fa fa-circle-o"></i> Hutang</a></li>
                <li class="<?php echo $piutang; ?>">
                <a href="index.php?page=piutang" class=""><i class="fa fa-circle-o"></i> Piutang</a>
                </li>
          </ul>
          </li>
          <li class="treeview <?php echo $laporan_kas; ?>">
          <a href="#">
            <i class="fa fa-bar-chart"></i> <span>Laporan Kas</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
                <li class="<?php echo $harian; ?>"><a href="index.php?page=laporan_kas_harian" class=""><i class="fa fa-circle-o"></i> Harian</a></li>
                <li class="<?php echo $bulanan; ?>">
                <a href="index.php?page=laporan_kas_bulanan" class=""><i class="fa fa-circle-o"></i> Bulanan</a>
                </li>
                <li class="<?php echo $tahunan; ?>">
                <a href="index.php?page=laporan_kas_tahunan" class=""><i class="fa fa-circle-o"></i> Tahunan</a>
                </li>
          </ul>
          </li>
          <li class="treeview <?php echo $pengaturan_akun; ?>">
          <a href="#">
            <i class="fa fa-cog"></i> <span>Pengaturan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
                <!--<li class="<?php echo $kategori; ?>"><a href="index.php?page=kategori" class=""><i class="fa fa-circle-o"></i> Kategori</a></li>-->
              <li class="<?php echo $mata_uang; ?>"><a href="index.php?page=mata_uang" class=""><i class="fa fa-bitcoin"></i> Mata Uang</a></li>
                <li class="<?php echo $riwayat_pemasukan; ?>">
                <a href="index.php?page=riwayat_pemasukan" class=""><i class="fa fa-circle-o"></i> Riwayat Pemasukan</a>
                </li>
                <li class="<?php echo $riwayat_pengeluaran; ?>">
                <a href="index.php?page=riwayat_pengeluaran" class=""><i class="fa fa-circle-o"></i> Riwayat Pengeluaran</a>
                </li>
          </ul>
          </li>
          </ul>
          </li>
          <li class="treeview <?php echo $bagian_cs; ?>"><a href="#"><strong style="color:#F90"><em>BAGIAN CUSTOMER SERVICE</em></strong><span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span></a>
        <ul class="treeview-menu">
        <li class="<?php echo $akun_user; ?>">
            <a href="index.php?page=akun_user">
          <i class="fa fa-cube"></i> <span class="">Customer</span></a></li>
          <li class="<?php echo $kirim_barang_cs; ?>">
            <a href="index.php?page=kirim_barang_cs">
          <i class="fa fa-cube"></i> <span class="">Pengiriman Alkes</span></a>
          </li>
        </ul>
        </li>
          
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
          <li class=<?php echo $act_lap_akes; ?>><a href="index.php?page=laporan_penjualan_alkes"><i class="fa fa-circle-o"></i> Penjualan Alkes </a></li>
          <li class=<?php echo $act12_3; ?>><a href="index.php?page=laporan_kerusakan_barang"><i class="fa fa-circle-o"></i> Kerusakan Alkes </a></li>
          
            <!--<li class=<?php //echo $act12_5; ?>><a href="index.php?page=laporan_teknisi"><i class="fa fa-circle-o"></i> Teknisi </a></li>-->
          </ul>
        </li>
        <li class="header"><strong><em>PENGATURAN TEKNISI, PIC, AKUN & Dll</em></strong></li>
        <li class="treeview <?php echo $act10; ?>">
          <a href="#">
            <i class="fa fa-adjust"></i> <span>Pengaturan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          <li class="<?php echo $administrator; ?>"><a href="index.php?page=akun_admin">
          <i class="fa fa-circle-o"></i>Administrator </a></li>
          <!--<li class="<?php //echo $sub_act10_3; ?>"><a href="index.php?page=pic"><i class="fa fa-circle-o"></i>PIC </a></li>-->
            <li class="treeview <?php echo $manajer; ?>"><a href="#"><i class="fa fa-circle-o"></i><span>Manajer</span><span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span></a>
            <ul class="treeview-menu">
            <li class="<?php echo $manajer_gudang; ?>"><a href="index.php?page=akun_manajer_gudang"><i class="fa fa-circle-o"></i> Gudang</a></li>
            <li class="<?php echo $manajer_teknisi; ?>"><a href="index.php?page=akun_manajer_teknisi"><i class="fa fa-circle-o"></i> Teknisi</a></li>
                <li class="<?php echo $manajer_keuangan; ?>"><a href="index.php?page=akun_manajer_keuangan"><i class="fa fa-circle-o"></i> Keuangan</a></li>
                
              </ul>
            </li>
            <li class="treeview <?php echo $akun; ?>"><a href="#"><i class="fa fa-circle-o"></i><span>Akun</span><span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span></a>
            <ul class="treeview-menu">
            <li class="<?php echo $admin_po_dalam; ?>"><a href="index.php?page=akun_admin_po_dalam"><i class="fa fa-circle-o"></i> Admin PO Dalam</a></li>
            <li class="<?php echo $admin_po_luar; ?>"><a href="index.php?page=akun_admin_po_luar"><i class="fa fa-circle-o"></i> Admin PO Luar</a></li>
                <li class="<?php echo $admin_gudang; ?>"><a href="index.php?page=akun_admin_gudang"><i class="fa fa-circle-o"></i> Admin Gudang</a></li>
                <li class="<?php echo $admin_teknisi; ?>"><a href="index.php?page=akun_admin_teknisi"><i class="fa fa-circle-o"></i> Admin Teknisi</a></li>
                <li class="<?php echo $teknisi; ?>"><a href="index.php?page=teknisi">
          <i class="fa fa-circle-o"></i> Teknisi</a></li>
                <!--
                <li class="<?php echo $teknisi; ?>"><a href="index.php?page=teknisi"><i class="fa fa-circle-o"></i> Teknisi</a></li>-->
                <li class="<?php echo $admin_keuangan; ?>"><a href="index.php?page=akun_admin_keuangan"><i class="fa fa-circle-o"></i> Admin Keuangan</a></li>
                <li class="<?php echo $cs; ?>"><a href="index.php?page=akun_cs"><i class="fa fa-circle-o"></i> Customer Service</a></li>
                
                <!--
                <li class="<?php echo $admin_jual_alkes; ?>"><a href="index.php?page=admin_jual_alkes"><i class="fa fa-circle-o"></i> Admin Jual Alkes</a></li>-->
                
              </ul>
            </li>
            <li class="<?php echo $mata_uang; ?>"><a href="index.php?page=mata_uang">
          <i class="fa fa-circle-o"></i>Mata Uang </a></li>
          <li class="<?php echo $riwayat_login; ?>"><a href="index.php?page=riwayat_login">
          <i class="fa fa-circle-o"></i>Riwayat Login/Logout </a></li>
          </ul>
        </li>
        
        <li><a href="proses_logout.php" onclick="return confirm('Yakin Akan Keluar Dari Aplikasi ?')"><i class="fa fa-close"></i> <span>Logout</span></a></li>
        <li class="header"><strong><em>KETERANGAN</em></strong></li>
        <!--<li><a><i class="fa fa-circle-o text-aqua"></i> <span>Kerusakan Belum SPK</span></a></li>-->
        <li><a><i class="fa fa-circle-o text-green"></i> <span>Jumlah Maintenance</span></a></li>
        <li><a><i class="fa fa-circle-o text-yellow"></i> <span>Sedang Dikerjakan</span></a></li>
        <li><a><i class="fa fa-circle-o text-red"></i> <span>Belum Dikerjakan</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>