<?php
if (isset($_POST['pencarian'])) {
		if ($_POST['pilihan']=='tgl_jual') {
		echo "<script>window.location='index.php?page=detail_jual_barang&id=$_GET[id]&tgl1=$_POST[tgl1]&tgl2=$_POST[tgl2]'</script>";
		} else {
		echo "<script>window.location='index.php?page=detail_jual_barang&id=$_GET[id]&pilihan=$_POST[pilihan]&kunci=$_POST[kata_kunci]'</script>";
		}
	}
 
if (isset($_GET['id_b_s'])) {
	$q=mysqli_query($koneksi, "update barang_dikirim set tgl_sampai='' where id=".$_GET['id_b_s']."");
	if ($q) {
		echo "<script>window.location='index.php?page=kirim_barang'</script>";
		}
	}
if (isset($_GET['id_hapus'])) {
	$q1 = mysqli_query($koneksi, "update barang_dikirim,barang_dikirm_detail,barang_gudang_detail set barang_gudang_detail.status_kirim=0 where barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dikirim.id=".$_GET['id_hapus']."");
	//$q2 = mysqli_query($koneksi, "select * from barang_dikirim,barang_dikirm_detail,barang_gudang_detail,barang_gudang where barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dikirim.id=".$_GET['id_hapus']."");
	}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Detail Pengiriman Alkes
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Detail Pengiriman Alkes</li>
      </ol>
    </section>


    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) --><!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
          <!-- Custom tabs (Charts with tabs)--><!-- /.nav-tabs-custom -->

          <!-- Chat box -->
          <div class="box box-warning"><!-- /.chat -->
            <div class="box-footer">
              <div class="box-body">
              <div class="">
              <!--<a href="index.php?page=tambah_barang_kirim">
              <button name="tambah_laporan" class="btn btn-warning" type="submit"><span class="fa fa-plus"></span> Kirim Alkes</button></a><br /><br />-->
              <button class="btn btn-warning pull pull-left" onclick="history.back();"><span class="fa fa-arrow-left"></span> Kembali</button>
			  <?php if (isset($_GET['kunci']) or isset($_GET['tgl1'])) { ?>
              <a href="?page=detail_jual_barang&id=<?php echo $_GET['id'] ?>"><button class="btn btn-info pull pull-right"><span class="fa fa-refresh"></span> Reset</button></a>&nbsp;&nbsp;
              <?php } ?>
              <button class="btn btn-success pull pull-right" data-toggle="modal" data-target="#modal-pencarian"><span class="fa fa-search"></span> Pencarian</button>
              <?php if (isset($_GET['kunci']) or isset($_GET['tgl1'])) { ?>
              <br /><br />
              <div class="pull pull-left">Data Berdasarkan : <?php 
			  if ($_GET['pilihan']=='no_pengiriman') {echo "<u><em>Nomor Pengiriman</em></u>, Kata Kunci : ";}
			  elseif ($_GET['pilihan']=='nama_pembeli') {echo "<u><em>Nama Pembeli/Tempat Tujuan</em></u>, Kata Kunci : ";}
			  elseif ($_GET['pilihan']=='nama_brg') {echo "<u><em>Nama Barang</em></u>, Kata Kunci : ";}
			  elseif ($_GET['pilihan']=='no_seri_brg') {echo "<u><em>No Seri Barang</em></u>, Kata Kunci : ";}
			  elseif ($_GET['pilihan']=='no_po_jual') {echo "<u><em>No PO</em></u>, Kata Kunci : ";}
			  echo "<u><em>".$_GET['kunci']."</em></u>"; ?></div>
              <?php } ?>
              <br /><br />
                <div class="table-responsive no-padding">
                <table width="100%" id="<?php if (isset($_GET['pilihan'])){echo "example1";} else {echo "example3";} ?>" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th align="center">No</th>
        
        <th bgcolor="#99FFCC">Tanggal Kirim</th>
        <th>Nama Paket</th>
        
        <th>No Pengiriman</th>
        <th>No PO</th>
      <th><strong>Barang<span class="pull pull-right"></span></strong></th>
      <th><strong>Tempat Tujuan</strong></th>
      <th bgcolor="#99FFCC"><strong>Tanggal Sampai</strong></th>
      
        </tr>
  </thead>
  <?php
// membuka file JSON
if (isset($_GET['pilihan']) and isset($_GET['kunci'])) {
	$file = file_get_contents("http://localhost/ALKES/json/kirim_barang.php?id=$_GET[id]&pilihan=$_GET[pilihan]&kunci=".str_replace(" ","%20",$_GET['kunci'])."");
}
else {
$file = file_get_contents("http://localhost/ALKES/json/kirim_barang.php?id=$_GET[id]");
}
$json = json_decode($file, true);
$jml=count($json); 
for ($i=0; $i<$jml; $i++) {
//echo "Nama Barang ke-".$i." : " . $json[$i]['nama_brg'] . "<br />";
//echo 'Nama Anggota ke-3 : ' . $json['2']['nama_brg'];
?>
  <tr>
    <td align="center"><?php echo $i+1; ?></td>
    <td bgcolor="#99FFCC"><?php echo date("d/M/Y",strtotime($json[$i]['tgl_kirim'])); ?></td>
    <td><?php echo $json[$i]['nama_paket']; ?></td>
    
    <td><?php echo $json[$i]['no_pengiriman']; ?></td>
    <td><?php echo $json[$i]['no_po_jual']; ?></td>
    <td>
    <a href="#" data-toggle="modal" data-target="#modal-detailbarang<?php echo $json[$i]['idd']; ?>"><small data-toggle="tooltip" title="Detail Barang" class="label bg-primary"><span class="fa fa-folder-open"></span></small></a>
    </td>
    <td><?php 
	$data3=mysqli_fetch_array(mysqli_query($koneksi, "select nama_pembeli from pembeli,barang_dijual,barang_dikirim where pembeli.id=barang_dijual.pembeli_id and barang_dijual.id=barang_dikirim.barang_dijual_id and barang_dikirim.id=".$json[$i]['idd'].""));
	echo $data3['nama_pembeli']; ?></td>
    
    <?php 
	if ($json[$i]['tgl_sampai']!=0000-00-00) {
		$bg="#99FFCC";
		}
		else {
			$bg="red";
			}
	?>
    <td bgcolor=<?php echo $bg; ?>>
		<?php
		if ($json[$i]['tgl_sampai']!=0000-00-00) {
	echo date("d/M/Y", strtotime($json[$i]['tgl_sampai'])); } else {
		echo "-";
		} ?>
    </td>
    
  </tr>
  <div class="modal fade" id="modal-detailbarang<?php echo $json[$i]['idd']; ?>">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" align="center">Detail Barang</h4>
              </div>
              <form method="post">
              <div class="modal-body">
              <p align="justify">
              
      <?php 
	  $q=mysqli_query($koneksi, "select nama_brg,no_seri_brg from barang_gudang,barang_gudang_detail,barang_dikirim_detail where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dikirim_id=".$json[$i]['idd']."");
	  $n=0;
	  while ($d1=mysqli_fetch_array($q)) {
	  $n++;
	  ?>
      <?php if ($d1['status_kembali_ke_gudang']==1) { ?>
        <font class="pull pull-right" size="+1">Kembali Ke Gudang</font>
        <?php } ?>
        <font class="pull pull-right" size="+2">
        <?php
		if($d1['status_spi']==1) {
			echo "(<span class='fa fa-sticky-note-o'></span>)";
			}
			?>
            </font>
      <?php echo $n.". ".$d1['nama_brg']."     |    "; ?></td>
      <?php echo $d1['no_seri_brg']; ?></td>
      <hr />
      <?php } ?>
    
              </p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                
              </div>
              </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
  <?php } ?>
</table>
                </div>
</div>
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

<div class="modal fade" id="modal-pencarian">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
              <script type="text/javascript">
			  function yesnoCheck() {
				  if (document.getElementById('yesCheck').value=='tgl_jual') {
					  document.getElementById('ifYes').style.display = 'block';
					  document.getElementById('kata_kunci').style.display = 'none';
					  }
					  else 
					  { document.getElementById('ifYes').style.display = 'none';
					  document.getElementById('kata_kunci').style.display = 'block';
					  }
					  }

 

</script>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Pencarian</h4>
              </div>
              <form method="post" enctype="multipart/form-data">
              <div class="modal-body">
                <select class="form-control select2" name="pilihan" required style="width:100%" onchange="javascript:yesnoCheck();" id="yesCheck">
                <option value="">...</option>
                <option value="no_pengiriman">Berdasarkan Nomor Pengiriman</option>
                <option value="no_po_jual">Berdasarkan Nomor PO</option>
                <option value="nama_pembeli">Berdasarkan Nama RS/Dinas/Klink/Dll</option>
                <option value="nama_brg">Berdasarkan Nama Barang</option>
                <option value="no_seri_brg">Berdasarkan No Seri Barang</option>
                
                </select>
                <br /><br />
                <div id="kata_kunci" style="display:block">
                <input type="text" class="form-control" name="kata_kunci" placeholder="Kata Kunci"/>
                </div>
                <div id="ifYes" style="display:none">
              <label>Dari Tanggal</label>
              <input name="tgl1" type="date" class="form-control" placeholder="" value=""><br />
              <label>Sampai Tanggal</label>
              <input name="tgl2" type="date" class="form-control" placeholder="" value="">
              </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success" name="pencarian">Cari</button>
              </div>
              </form>
            </div>
            <!-- /.modal-content -->
  </div>
          <!-- /.modal-dialog -->
</div>