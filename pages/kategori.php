<?php
$data=mysqli_fetch_array(mysqli_query($koneksi, "select *,alat_pelatihan.id as idd,pembeli.id as id_rumkit from barang_teknisi,barang_teknisi_detail,barang_teknisi_detail_teknisi, barang_dikirim,barang_dikirim_detail, barang_dijual, barang_gudang, barang_gudang_detail,pembeli, tb_teknisi,alat_uji_detail,alat_pelatihan where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=barang_dikirim_detail.barang_gudang_detail_id and barang_dijual.id=barang_dikirim.barang_dijual_id and barang_dikirim.id=barang_dikirim_detail.barang_dikirim_id and pembeli.id=barang_dijual.pembeli_id and barang_dikirim_detail.id=barang_teknisi_detail.barang_dikirim_detail_id and barang_teknisi.id=barang_teknisi_detail.barang_teknisi_id and barang_teknisi_detail.id=barang_teknisi_detail_teknisi.barang_teknisi_detail_id and tb_teknisi.id=barang_teknisi_detail_teknisi.teknisi_id and barang_teknisi_detail.id=alat_uji_detail.barang_teknisi_detail_id and alat_uji_detail.id=alat_pelatihan.alat_uji_detail_id and alat_pelatihan.id=".$_GET['id'].""));

if (isset($_POST['tambah_spk_masuk'])) {
	$Result = mysqli_query($koneksi, "update alat_pelatihan set banyak_peserta='".$_POST['peserta']."', pelatih='".$_POST['pelatih']."', tgl_pelatihan='".$_POST['tgl_pelatihan']."', pelatihan_oleh='".$_POST['pelatihan_oleh']."' where id=".$_GET['id']."");
	
	if ($Result) {
				
		echo "<script type='text/javascript'>
		alert('Silakan Update Data Peserta !');
		window.location='index.php?page=tambah_peserta_pelatihan&id=$_GET[id]';
		</script>";
		
		}
	}

if (isset($_GET['hapus_aset'])) {
	$q_sub = mysqli_query($koneksi, "delete from coa_sub_akun where coa_sub_id=".$_GET['hapus_aset']."");
	$q = mysqli_query($koneksi, "delete from coa_sub where id=".$_GET['hapus_aset']."");
}

if (isset($_GET['hapus_sub_akun'])) {
	$q_sub = mysqli_query($koneksi, "delete from coa_sub_akun where id=".$_GET['hapus_sub_akun']."");
}
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Akun COA
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">COAs</li></ol></section>


    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) --><!-- /.row -->
      <!-- Main row -->
      <form method="post" enctype="multipart/form-data">
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-6 connectedSortable">
          <!-- Custom tabs (Charts with tabs)--><!-- /.nav-tabs-custom -->

          <!-- Chat box -->
          <div class="box box-success"><!-- /.chat -->
            <h3 align="center">Neraca &nbsp;&nbsp;<a href="index.php?page=kategori#tambah_grup_neraca">
              <button name="tambah_laporan" class="btn btn-success" type="button"><span class="fa fa-plus"></span> Tambah Grup</button></a> <a href="index.php?page=kategori#tambah_akun_neraca">
              <button name="tambah_laporan2" class="btn btn-success" type="button"><span class="fa fa-plus"></span> Tambah Akun</button></a></h3>
            <div class="box-footer">
            <div class="box-header with-border" style="background-color:#FC9">
              <h3 class="box-title"><strong>Aset</strong></h3>
              <h3 class="box-title pull pull-right">&nbsp;</h3>
            </div>
              <div class="box-body">
              <table id="example1" class="table table-responsive">
              <tr>
    <td>Kas di BANK</td>
    <td width="10%"><span class="fa fa-times-circle"></span></td>
  </tr>
  <tr>
    <td>Kas di TANGAN</td>
    <td><span class="fa fa-times-circle"></span></td>
  </tr>
  <?php
  $q_aset = mysqli_query($koneksi, "select * from coa_sub where coa_id=1");
  $no=0;
  while ($d_aset = mysqli_fetch_array($q_aset)) {
  ?>
  <tr>
    <td><?php echo $d_aset['nama_sub_grup']; ?></td>
    <td><?php if ($d_aset['id']!=2){ ?><a href="index.php?page=kategori&hapus_aset=<?php echo $d_aset['id']; ?>" onclick="return confirm('Anda Yakin Akan Menghapus Akun Ini ?')"><span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span></a><?php } else { ?><span class="fa fa-times-circle"></span><?php } ?></td>
  </tr>
  <?php 
  $cek_sub = mysqli_num_rows(mysqli_query($koneksi, "select * from coa_sub_akun where coa_sub_id=$d_aset[id]"));
  if ($cek_sub!=0) { ?>
  <tr>
    <td colspan="2"><table id="example2" class="table table-responsive" style="padding:0px; margin:0px">
    <?php 
	$q_sub_akun = mysqli_query($koneksi, "select * from coa_sub_akun where coa_sub_id=$d_aset[id]");
	while ($d_sub_akun = mysqli_fetch_array($q_sub_akun)) {
	?>
      <tr>
      	<td width="5%"></td>
        <td><?php echo $d_sub_akun['nama_akun']; ?></td>
        <td width="5%"><?php if ($d_sub_akun['coa_sub_id']!=2){ ?><a href="index.php?page=kategori&hapus_sub_akun=<?php echo $d_sub_akun['id']; ?>" onclick="return confirm('Anda Yakin Akan Menghapus Item Ini ?')"><span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span></a><?php } else { ?><span class="fa fa-times-circle"></span><?php } ?></td>
      </tr>
      <?php } ?>
    </table></td>
    </tr>
  <?php }} ?>
</table>
                             
              </div>
              <div class="box-header with-border" style="background-color:#FC9">
              <h3 class="box-title"><strong>Dikurangi Kewajiban</strong></h3>
            </div>
              <div class="box-body">
              <table id="example1" class="table table-responsive">
  <?php
  $q_aset2 = mysqli_query($koneksi, "select * from coa_sub where coa_id=2");
  $no=0;
  while ($d_aset2 = mysqli_fetch_array($q_aset2)) {
  ?>
  <tr>
    <td><?php echo $d_aset2['nama_sub_grup']; ?></td>
    <td width="10%"><?php if ($d_aset2['id']!=9){ ?><a href="index.php?page=kategori&hapus_aset=<?php echo $d_aset2['id']; ?>" onclick="return confirm('Anda Yakin Akan Menghapus Akun Ini ?')"><span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span></a><?php } else { ?><span class="fa fa-times-circle"></span><?php } ?></td>
  </tr>
  <?php 
  $cek_sub2 = mysqli_num_rows(mysqli_query($koneksi, "select * from coa_sub_akun where coa_sub_id=$d_aset2[id]"));
  if ($cek_sub2!=0) { ?>
  <tr>
    <td colspan="2"><table id="example1" class="table table-responsive" style="padding:0px; margin:0px">
    <?php 
	$q_sub_akun2 = mysqli_query($koneksi, "select * from coa_sub_akun where coa_sub_id=$d_aset2[id]");
	while ($d_sub_akun2 = mysqli_fetch_array($q_sub_akun2)) {
	?>
      <tr>
      	<td width="5%"></td>
        <td><?php echo $d_sub_akun2['nama_akun']; ?></td>
        <td width="5%"><?php if ($d_sub_akun2['id']!=45 and $d_sub_akun2['id']!=46){ ?><a href="index.php?page=kategori&hapus_sub_akun=<?php echo $d_sub_akun2['id']; ?>" onclick="return confirm('Anda Yakin Akan Menghapus Item Ini ?')"><span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span></a><?php } else { ?><span class="fa fa-times-circle"></span><?php } ?></td>
      </tr>
      <?php } ?>
    </table></td>
    </tr>
  <?php }} ?>
</table>                                
              </div>
              <div class="box-header with-border" style="background-color:#FC9">
              <h3 class="box-title"><strong>Ekuitas</strong></h3>
            </div>
              <div class="box-body">
              <table id="example1" class="table table-responsive">
  <?php
  $q_aset3 = mysqli_query($koneksi, "select * from coa_sub where coa_id=3");
  $no=0;
  while ($d_aset3 = mysqli_fetch_array($q_aset3)) {
  ?>
  <tr>
    <td><?php echo $d_aset3['nama_sub_grup']; ?></td>
    <td width="10%">
    <?php if ($d_aset3['id']!=31 and $d_aset3['id']!=32) { ?>
    <a href="index.php?page=kategori&hapus_aset=<?php echo $d_aset3['id']; ?>" onclick="return confirm('Anda Yakin Akan Menghapus Akun Ini ?')"><span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span></a>
    <?php } else { ?>
    <span class="fa fa-times-circle"></span>
    <?php } ?>
    </td>
  </tr>
  <?php 
  $cek_sub3 = mysqli_num_rows(mysqli_query($koneksi, "select * from coa_sub_akun where coa_sub_id=$d_aset3[id]"));
  if ($cek_sub3!=0) { ?>
  <tr>
    <td colspan="3"><table id="example1" class="table table-responsive" style="padding:0px; margin:0px">
    <?php 
	$q_sub_akun3 = mysqli_query($koneksi, "select * from coa_sub_akun where coa_sub_id=$d_aset3[id]");
	while ($d_sub_akun3 = mysqli_fetch_array($q_sub_akun3)) {
	?>
      <tr>
      	<td width="5%"></td>
        <td><?php echo $d_sub_akun3['nama_akun']; ?></td>
        <td width="5%"><a href="index.php?page=kategori&hapus_sub_akun=<?php echo $d_sub_akun3['id']; ?>" onclick="return confirm('Anda Yakin Akan Menghapus Item Ini ?')"><span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span></a></td>
      </tr>
      <?php } ?>
    </table></td>
    </tr>
  <?php }} ?>
</table>                               
              </div>
            </div>
          </div>
          </section>
        <section class="col-lg-6 connectedSortable">
          <!-- Custom tabs (Charts with tabs)--><!-- /.nav-tabs-custom -->

          <!-- Chat box -->
          <div class="box box-success"><!-- /.chat -->
            <h3 align="center">Laporan Laba Rugi &nbsp;&nbsp;<a href="index.php?page=kategori#tambah_grup_laba_rugi">
              <button name="tambah_grup_labarugi" class="btn btn-success" type="button"><span class="fa fa-plus"></span> Tambah Grup</button></a> <a href="index.php?page=kategori#tambah_akun_laba_rugi">
              <button name="tambah_akun_labarugi" class="btn btn-success" type="button"><span class="fa fa-plus"></span> Tambah Akun</button></a></h3>
            <div class="box-footer">
            <div class="box-header with-border" style="background-color:#FC9">
              <h3 class="box-title"><strong>Pemasukan</strong></h3>
            </div>
              <div class="box-body">
              <table id="example1" class="table table-responsive">
  <?php
  $q_aset4 = mysqli_query($koneksi, "select * from coa_sub where coa_id=4");
  $no=0;
  while ($d_aset4 = mysqli_fetch_array($q_aset4)) {
  ?>
  <tr>
    <td><?php echo $d_aset4['nama_sub_grup']; ?></td>
    <td width="10%"><a href="index.php?page=kategori&hapus_aset=<?php echo $d_aset4['id']; ?>" onclick="return confirm('Anda Yakin Akan Menghapus Akun Ini ?')"><span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span></a></td>
  </tr>
  <?php 
  $cek_sub4 = mysqli_num_rows(mysqli_query($koneksi, "select * from coa_sub_akun where coa_sub_id=$d_aset4[id]"));
  if ($cek_sub4!=0) { ?>
  <tr>
    <td colspan="4">
    <table id="example1" class="table table-responsive" style="padding:0px; margin:0px">
    <?php 
	$q_sub_akun4 = mysqli_query($koneksi, "select * from coa_sub_akun where coa_sub_id=$d_aset4[id]");
	while ($d_sub_akun4 = mysqli_fetch_array($q_sub_akun4)) {
	?>
      <tr>
      	<td width="5%"></td>
        <td><?php echo $d_sub_akun4['nama_akun']; ?></td>
        <td width="5%"><a href="index.php?page=kategori&hapus_sub_akun=<?php echo $d_sub_akun4['id']; ?>" onclick="return confirm('Anda Yakin Akan Menghapus Item Ini ?')"><span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span></a></td>
      </tr>
      <?php } ?>
    </table></td>
    </tr>
  <?php }} ?>
</table>                                 
              </div>
              <div class="box-header with-border" style="background-color:#FC9">
              <h3 class="box-title"><strong>Dikurangi Pengeluaran</strong></h3>
            </div>
              <div class="box-body">
              <table id="example1" class="table table-responsive">
  <?php
  $q_aset5 = mysqli_query($koneksi, "select * from coa_sub where coa_id=5");
  $no=0;
  while ($d_aset5 = mysqli_fetch_array($q_aset5)) {
  ?>
  <tr>
    <td><?php echo $d_aset5['nama_sub_grup']; ?></td>
    <td width="10%"><a href="index.php?page=kategori&hapus_aset=<?php echo $d_aset5['id']; ?>" onclick="return confirm('Anda Yakin Akan Menghapus Akun Ini ?')"><span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span></a></td>
  </tr>
  <?php 
  $cek_sub5 = mysqli_num_rows(mysqli_query($koneksi, "select * from coa_sub_akun where coa_sub_id=$d_aset5[id]"));
  if ($cek_sub5!=0) { ?>
  <tr>
    <td colspan="5"><table id="example1" class="table table-responsive" style="padding:0px; margin:0px">
    <?php 
	$q_sub_akun5 = mysqli_query($koneksi, "select * from coa_sub_akun where coa_sub_id=$d_aset5[id]");
	while ($d_sub_akun5 = mysqli_fetch_array($q_sub_akun5)) {
	?>
      <tr>
      	<td width="5%"></td>
        <td><?php echo $d_sub_akun5['nama_akun']; ?></td>
        <td width="5%"><a href="index.php?page=kategori&hapus_sub_akun=<?php echo $d_sub_akun5['id']; ?>" onclick="return confirm('Anda Yakin Akan Menghapus Item Ini ?')"><span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span></a></td>
      </tr>
      <?php } ?>
    </table></td>
    </tr>
  <?php }} ?>
</table>                                 
              </div>
              <div class="box-header with-border" style="background-color:#FC9">
              <h3 class="box-title"><strong>Laba Bersih</strong></h3>
            </div>
            </div>
          </div>
          </section>
        <!-- right col -->
      </div>
      </form>
      <!-- /.row (main row) -->

  </section>
  <select>
  <option></option>
  </select>
    <!-- /.content -->
  </div>
  <?php
if (isset($_POST['simpan_grup_neraca'])) {
	  $R = mysqli_query($koneksi, "insert into coa_sub values('','".$_POST['coa_id']."','".$_POST['nama_sub_grup']."')");
	  if ($R) {
		  echo "<script type='text/javascript'>
		  window.location='index.php?page=kategori';
		</script>";
		  }
	  }
	  
if (isset($_POST['simpan_akun_neraca'])) {
	  $R = mysqli_query($koneksi, "insert into coa_sub_akun values('','".$_POST['coa_id']."','".$_POST['nama_sub_grup']."')");
	  if ($R) {
		  echo "<script type='text/javascript'>
		  window.location='index.php?page=kategori';
		</script>";
		  }
	  }
  ?>
  <div id="tambah_grup_neraca" class="modalDialog">
     <div>
        <a href="#" title="Close" class="close">X</a>
        <h3 align="center">Tambah Grup - Neraca</h3> 
     <form method="post">
     <label>Nama</label>
     <input name="nama_sub_grup" type="text" class="form-control"/>
     <label>Grup</label>
     <select name="coa_id" required class="form-control" style="width:100%">
     <option value="">-- Pilih --</option>
     <?php 
	 $q_coa = mysqli_query($koneksi, "select * from coa where id between 1 and 3 order by nama_grup ASC");
	 while ($d_coa = mysqli_fetch_array($q_coa)){
	 ?>
     <option value="<?php echo $d_coa['id']; ?>"><?php echo $d_coa['nama_grup']; ?></option>
     <?php 
	 }
	 ?>
     </select>
        <button id="buttonn" name="simpan_grup_neraca" type="submit">Simpan</button>
    </form>
    </div>
</div>
<div id="tambah_grup_laba_rugi" class="modalDialog">
     <div>
        <a href="#" title="Close" class="close">X</a>
        <h3 align="center">Tambah Grup - Laba Rugi</h3> 
     <form method="post">
     <label>Nama</label>
     <input name="nama_sub_grup" type="text" class="form-control"/>
     <label>Grup</label>
     <select name="coa_id" required class="form-control" style="width:100%">
     <option value="">-- Pilih --</option>
     <?php 
	 $q_coa2 = mysqli_query($koneksi, "select * from coa where id between 4 and 5 order by nama_grup ASC");
	 while ($d_coa = mysqli_fetch_array($q_coa2)){
	 ?>
     <option value="<?php echo $d_coa['id']; ?>"><?php echo $d_coa['nama_grup']; ?></option>
     <?php 
	 }
	 ?>
     </select>
        <button id="buttonn" name="simpan_grup_neraca" type="submit">Simpan</button>
    </form>
    </div>
</div>

<div id="tambah_akun_neraca" class="modalDialog">
     <div>
        <a href="#" title="Close" class="close">X</a>
        <h3 align="center">Tambah Akun - Neraca</h3> 
     <form method="post">
     <label>Nama</label>
     <input name="nama_sub_grup" type="text" class="form-control"/>
     <label>Grup</label>
     <select name="coa_id" required class="form-control" style="width:100%">
     <option value="">-- Pilih --</option>
     <?php 
	 $q_akun_neraca = mysqli_query($koneksi, "select *,coa_sub.id as idd from coa,coa_sub where coa.id=coa_sub.coa_id and coa.id between 1 and 3 order by nama_grup ASC");
	 while ($d_coa = mysqli_fetch_array($q_akun_neraca)){
	 ?>
     <option value="<?php echo $d_coa['idd']; ?>"><?php echo $d_coa['nama_grup']." - ".$d_coa['nama_sub_grup']; ?></option>
     <?php 
	 }
	 ?>
     </select>
        <button id="buttonn" name="simpan_akun_neraca" type="submit">Simpan</button>
    </form>
    </div>
</div>

<div id="tambah_akun_laba_rugi" class="modalDialog">
     <div>
        <a href="#" title="Close" class="close">X</a>
        <h3 align="center">Tambah Akun - Neraca</h3> 
     <form method="post">
     <label>Nama</label>
     <input name="nama_sub_grup" type="text" class="form-control"/>
     <label>Grup</label>
     <select name="coa_id" required class="form-control" style="width:100%">
     <option value="">-- Pilih --</option>
     <?php 
	 $q_akun_neraca = mysqli_query($koneksi, "select *,coa_sub.id as idd from coa,coa_sub where coa.id=coa_sub.coa_id and coa.id between 4 and 5 order by nama_grup ASC");
	 while ($d_coa = mysqli_fetch_array($q_akun_neraca)){
	 ?>
     <option value="<?php echo $d_coa['idd']; ?>"><?php echo $d_coa['nama_grup']." - ".$d_coa['nama_sub_grup']; ?></option>
     <?php 
	 }
	 ?>
     </select>
        <button id="buttonn" name="simpan_akun_neraca" type="submit">Simpan</button>
    </form>
    </div>
</div>
  
  