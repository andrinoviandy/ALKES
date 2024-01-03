<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="kharisma.png" class="" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Admin Marketing</p>
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
        <li class="treeview <?php echo $sub_act2_1; ?>">
            <a href="#"><i class="fa fa-cube"></i> <span class="">Persediaan</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
          <li class="treeview <?php echo $sub_act2_1_1; ?>">
         <a href="#"><i class="fa fa-cube"></i> <span class="">Alkes</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
                <li class="<?php echo $sub_act2_1_1_0; ?>"><a href="index.php?page=barang_masuk" class=""><i class="fa fa-circle-o"></i> Alkes Ber No Seri</a></li>
                        
        <li class="<?php echo $ber_set; ?>"><a href="index.php?page=barang_set" class=""><i class="fa fa-circle-o"></i> Alkes Ber Set</a></li>
                </ul>
        </li>          
            
            <li class="<?php echo $sub_act2_1_2; ?>"> <a href="index.php?page=aksesoris"> <i class="fa fa-cube"></i> <span class="">Aksesoris</span> <span class="pull-right-container"> </span> </a> </li>
            <li class="<?php echo $sub_act2_1_3; ?>"> <a href="index.php?page=barang_inventory"> <i class="fa fa-cube"></i> <span class="">Barang Inventory</span> <span class="pull-right-container"> </span> </a> </li>
            <!--
            <li class="<?php echo $sub_act2_1_3; ?>"> <a href="index.php?page=barang_set"> <i class="fa fa-cube"></i> <span class="">Barang Set</span> <span class="pull-right-container"> </span> </a> </li>
            -->
          </ul>
          </li>
        <li class="<?php echo $act_penyebaran_alkes; ?>">
          <a href="index.php?page=penyebaran_alkes">
            <i class="fa fa-wifi"></i> <span>Penyebaran Alkes</span>
            <span class="pull-right-container">
              
            </span>
          </a></li>
        <li class="treeview <?php echo $act2_2; ?>"><a href="#">
        <i class="fa fa-cart-plus"></i>
        <span>Penjualan</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
          <ul class="treeview-menu">
          
            <li class="treeview <?php echo $sub_act2_2; ?>"> <a href="#"> <i class="fa fa-circle-o"></i> <span class="">Penjualan Alkes</span> <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span> </a> 
            <ul class="treeview-menu">
                <li class="<?php echo $sub_act2_2_1; ?>"><a href="index.php?page=jual_barang_uang" class=""><i class="fa fa-circle-o"></i> Alkes Ber No Seri</a></li>
             <!--           
        <li class="<?php echo $sub_act2_2_2; ?>"><a href="index.php?page=penjualan_barang_set" class=""><i class="fa fa-circle-o"></i> Alkes Ber Set</a></li>-->
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
        <li><a href="proses_logout.php" onclick="return confirm('Yakin Akan Keluar Dari Aplikasi ?')"><i class="fa fa-close"></i><span> Logout</span></a></li>
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>