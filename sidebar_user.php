<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="kharisma.png" class="" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Customer</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <?php 
	  if (isset($_GET['page'])) {
		  if($_GET['page']=='beranda') { $act1="active"; }
		  else if ($_GET['page']=='barang_masuk') { $act2="active"; $sub_act2_1="active"; }
		  else if ($_GET['page']=='ubah_barang_masuk') { $act2="active"; $sub_act2_1="active"; }
		  else if ($_GET['page']=='tambah_barang_masuk') { $act2="active"; $sub_act2_1="active"; }
		  else if ($_GET['page']=='jual_barang3') { $act2="active"; $sub_act2_1="active"; }
		  else if ($_GET['page']=='jual_barang2') { $act2="active"; $sub_act2_1="active"; }
		  else if ($_GET['page']=='jual_barang') { $act2="active"; $sub_act2_2="active"; }
		  else if ($_GET['page']=='ubah_barang_jual2') { $act2="active"; $sub_act2_2="active"; }
		  else if ($_GET['page']=='tambah_barang_jual') { $act2="active"; $sub_act2_2="active"; }
		  else if ($_GET['page']=='tambah_barang_jual_banyak') { $act2="active"; $sub_act2_2="active"; }
		  else if ($_GET['page']=='kirim_barang') { $act2="active"; $sub_act2_3="active"; }
		  else if ($_GET['page']=='ubah_barang_kirim') { $act2="active"; $sub_act2_3="active"; }
		  else if ($_GET['page']=='tambah_barang_kirim') { $act2="active"; $sub_act2_3="active"; }
		  
		  else if ($_GET['page']=='uji_fungsi_instalasi') { $act3="active"; }
		  else if ($_GET['page']=='tambah_uji') { $act3="active"; }
		  else if ($_GET['page']=='ubah_uji') { $act3="active"; }
		  else if ($_GET['page']=='pelatihan_alat') { $act4="active"; }
		  else if ($_GET['page']=='tambah_pelatihan') { $act4="active"; }
		  else if ($_GET['page']=='ubah_latih') { $act4="active"; }
		  else if ($_GET['page']=='tambah_peserta_pelatihan') { $act4="active"; }
		  else if ($_GET['page']=='sertifikat') { $act4="active"; }
		  
		  else if ($_GET['page']=='barang') { $act5="active"; }
		  else if ($_GET['page']=='tambah_barang') { $act5="active"; }
		  else if ($_GET['page']=='ubah_barang') { $act5="active"; }
		  
		  else if ($_GET['page']=='laporan_kerusakan') { $act6="active"; }
		  else if ($_GET['page']=='tambah_laporan') { $act6="active"; }
		  else if ($_GET['page']=='ubah_laporan') { $act6="active"; }
		  
		  else if ($_GET['page']=='pembuatan_spk') { $act7="active"; }
		  else if ($_GET['page']=='buat_spk') { $act7="active"; }
		  else if ($_GET['page']=='tambah_spk') { $act7="active"; }
		  else if ($_GET['page']=='ubah_spk') { $act7="active"; }
		  
		  else if ($_GET['page']=='progress_pengerjaan') { $act8="active"; }
		  else if ($_GET['page']=='detail_progress') { $act8="active"; }
		  else if ($_GET['page']=='tambah_progress') { $act8="active"; }
		  else if ($_GET['page']=='replacement') { $act8="active"; }
		  
		  else if ($_GET['page']=='') { $act9="active"; $sub_act9_1="active"; }
		  
		  else if ($_GET['page']=='teknisi') { $act10="active"; $akun="active"; $teknisi="active"; }
		  else if ($_GET['page']=='tambah_teknisi') { $act10="active"; $akun="active"; $teknisi="active"; }
		  else if ($_GET['page']=='ubah_teknisi') { $act10="active"; $akun="active"; $teknisi="active"; }
		  else if ($_GET['page']=='akun_admin') { $act10="active"; $administrator="active"; }
		  else if ($_GET['page']=='akun_admin_gudang') { $act10="active"; $akun="active"; $admin_gudang="active"; }
		  else if ($_GET['page']=='akun_admin_teknisi') { $act10="active"; $akun="active"; $admin_teknisi="active"; }
		  else if ($_GET['page']=='akun_admin') { $act10="active"; $administrator="active"; }
		  else if ($_GET['page']=='akun_admin') { $act10="active"; $administrator="active"; }
		  
		  else if ($_GET['page']=='akun_user') { $act_user="active"; }
		  else if ($_GET['page']=='tambah_user') { $act_user="active"; }
		  else if ($_GET['page']=='ubah_user') { $act_user="active"; }
		  else if ($_GET['page']=='pemusnahan_alkes') { $act11="active"; }
		  
		  else if ($_GET['page']=='laporan_barang_masuk') { $act12="active"; $act12_1="active"; }
		  else if ($_GET['page']=='laporan_jual_barang') { $act12="active"; $act12_2="active"; }
		  else if ($_GET['page']=='laporan_kerusakan_barang') { $act12="active"; $act12_3="active"; }
		  else if ($_GET['page']=='laporan_penjualan_alkes') { $act12="active"; $act_lap_akes="active"; }
		  else if ($_GET['page']=='laporan_spk') { $act12="active"; $act12_4="active"; }
		  else if ($_GET['page']=='laporan_teknisi') { $act12="active"; $act12_5="active"; }
		  
		  else if ($_GET['page']=='spk_masuk') { $act_spk_masuk="active"; }
		  else if ($_GET['page']=='tambah_spk_masuk') { $act_spk_masuk="active"; }
		  else if ($_GET['page']=='ubah_spk_masuk') { $act_spk_masuk="active"; }
		  else if ($_GET['page']=='penyebaran_alkes') { $act_penyebaran_alkes="active"; }
		  else if ($_GET['page']=='aksesoris_alkes') { $act_aksesoris_alkes="active"; }
		  else if ($_GET['page']=='ubah_aksesoris') { $act_aksesoris_alkes="active"; }
		  else if ($_GET['page']=='tambah_aksesoris') { $act_aksesoris_alkes="active"; }
		  else if ($_GET['page']=='import_data') { $act_import_alkes="active"; }
		  
		  
		  else { $act1="active"; }
		  }
	  ?>
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">NAVIGASI</li>
        <li class="<?php echo $act1; ?>">
          <a href="index.php?page=beranda">
        <i class="fa fa-dashboard"></i> <span>Beranda</span></a></li>
        
        <li class="header">KERUSAKAN ALKES (SERVICE)<span class="pull-right-container">
              
        </span>
          </a>        </li>
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
              <?php $total11=mysqli_num_rows(mysqli_query($koneksi, "select * from tb_maintenance"));
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
              <?php $total1=mysqli_num_rows(mysqli_query($koneksi, "select * from tb_maintenance where status_proses=0"));
			  echo $total1; ?>
              </small><small class="label pull-right bg-yellow"><?php $total2=mysqli_num_rows(mysqli_query($koneksi, "select * from tb_maintenance where status_proses=1"));
			  echo $total2; ?>
              </small>
            </span>
        </a></li>
        <li class="header">LAPORAN</li>
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
          </ul>
        </li>
        
        <li><a href="proses_logout.php" onclick="return confirm('Yakin Akan Keluar Dari Aplikasi ?')"><i class="fa fa-close"></i> <span>Logout</span></a></li>
        <li class="header">KETERANGAN</li>
        <!--<li><a><i class="fa fa-circle-o text-aqua"></i> <span>Kerusakan Belum SPK</span></a></li>-->
        <li><a><i class="fa fa-circle-o text-green"></i> <span>Jumlah Maintenance</span></a></li>
        <li><a><i class="fa fa-circle-o text-yellow"></i> <span>Sedang Dikerjakan</span></a></li>
        <li><a><i class="fa fa-circle-o text-red"></i> <span>Belum Dikerjakan</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>