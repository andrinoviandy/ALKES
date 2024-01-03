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
                        
        <!--<li class="<?php echo $po_set; ?>"><a href="index.php?page=pembelian_alkes2_set" class=""><i class="fa fa-circle-o"></i> Alkes Ber Set</a></li>-->
                </ul>
                </li>
                <!--
                <li class="<?php echo $admin_jual_alkes; ?>"><a href="index.php?page=admin_jual_alkes"><i class="fa fa-circle-o"></i> Admin Jual Alkes</a></li>-->
                
              </ul>
            </li>
            <li class="treeview <?php echo $po_aksesoris; ?>">
              <a href="#"><i class="fa fa-cube"></i> <span class="">Pemesanan Aksesoris</span>
              <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
              </span>
              </a>
              <ul class="treeview-menu">
                <li class="<?php echo $po_aksesoris1; ?>">
                  <a href="index.php?page=pembelian_akse" class=""><i class="fa fa-circle-o"></i> PO Dalam Negeri</a>
                </li>
                <li class="<?php echo $po_aksesoris2; ?>">
                  <a href="index.php?page=pembelian_akse2" class=""><i class="fa fa-circle-o"></i> PO Luar Negeri</a>
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
            <li class="treeview <?php echo $list_barang; ?>">
              <a href="#"><i class="fa fa-cube"></i> <span class="">List Barang</span>
              <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
              </span>
              </a>
              <ul class="treeview-menu">
                <li class="<?php echo $list_barang1; ?>">
                  <a href="index.php?page=barang_masuk" class=""><i class="fa fa-circle-o"></i> Alkes Ber No Seri</a>
                </li>
                <li class="<?php echo $list_barang1_1; ?>">
                  <a href="index.php?page=barang_set" class=""><i class="fa fa-circle-o"></i> Alkes Ber Set</a>
                </li>
                <li class="<?php echo $list_barang2; ?>">
                  <a href="index.php?page=aksesoris" class=""><i class="fa fa-circle-o"></i> Aksesoris</a>
                </li>
                <li class="<?php echo $list_barang3; ?>">
                  <a href="index.php?page=barang_inventory" class=""><i class="fa fa-circle-o"></i> Barang Inventory</a>
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
          <?php if (isset($_SESSION['adminpodalam'])) { ?>
                <li class="<?php echo $dalam_negeri; ?>"><a href="index.php?page=laporan_pembelian_alkes1"><i class="fa fa-circle-o"></i> Dalam Negeri</a></li>
                <?php } ?>
               <?php if (isset($_SESSION['adminpoluar'])) { ?>
                <li class="<?php echo $luar_negeri; ?>"><a href="index.php?page=laporan_pembelian_alkes2"><i class="fa fa-circle-o"></i> Luar Negeri</a></li>
                <?php } ?>
          </ul>
          </li>
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