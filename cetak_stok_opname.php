<?php
include "config/koneksi.php";
$data = mysqli_fetch_array(mysqli_query($koneksi, "select * from stok_opname where id= $_GET[id]"));
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Stok Opname (" . date("d/m/Y", strtotime($data['tgl_cek'])) . ").xls");
?>
<?php require("config/koneksi.php"); ?>
<table style="width: 100%;">
  <tr>
    <td colspan="6">
      <h3 align="center">
        <strong>PT. CIPTA VARIA KHARISMA UTAMA</strong>
      </h3>
    </td>
  </tr>
  <tr>
    <td colspan="6">
      <strong><?php echo date("d/m/Y", strtotime($data['tgl_cek'])) ?></strong>
    </td>
  </tr>
</table>

<p><b>Stok Opname</b></p>
<table border="1" class="table table-bordered table-hover" id="example1">
  <thead>
    <tr>
      <th rowspan="2">No</th>
      <th rowspan="2">Merk/Brand</th>
      <th rowspan="2">Nama Barang</th>
      <th colspan="2">Tahun
        <?php $tahun = getdate();
        echo $tahun['year']; ?>
      </th>
      <th rowspan="2">Selisih</th>
    </tr>
    <tr>
      <th>Jumlah Fisik</th>
      <th>Ditemukan</th>
    </tr>
  </thead>
  <?php
  $query = mysqli_query($koneksi, "select * from barang_gudang group by merk_brg order by merk_brg ASC");
  $jml = mysqli_num_rows($query);
  if ($jml != 0) {
    $no = 0;
    while ($dt = mysqli_fetch_array($query)) {
      $no++;
  ?>
      <tr>
        <td align="center" valign="top"><?php echo $no; ?></td>
        <td align="left" valign="top"><?php echo $dt['merk_brg']; ?></td>
        <td valign="top">
          <table width="100%" border="1">
            <?php
            $sel = mysqli_query($koneksi, "select * from barang_gudang where merk_brg='" . $dt['merk_brg'] . "' order by nama_brg ASC");
            while ($data_sel = mysqli_fetch_array($sel)) {
            ?>
              <tr>
                <td align="left"><?php echo $data_sel['nama_brg']; ?></td>
                <td align="left"><?php echo $data_sel['tipe_brg']; ?></td>
              </tr>
            <?php } ?>
          </table>
        </td>
        <td>
          <table width="100%" border="1">
            <?php
            $sel2 = mysqli_query($koneksi, "select * from barang_gudang where merk_brg='" . $dt['merk_brg'] . "' order by nama_brg ASC");
            while ($data_sel2 = mysqli_fetch_array($sel2)) {
            ?>
              <?php
              $jml_fisik = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_gudang_detail where barang_gudang_id= " . $data_sel2['id'] . ""));

              ?>
              <tr>
                <td align="center"><?php echo $jml_fisik; ?></td>
              </tr>
            <?php } ?>
          </table>
        </td>
        <td>
          <table width="100%" border="1">
            <?php
            $sel3 = mysqli_query($koneksi, "select * from barang_gudang where merk_brg='" . $dt['merk_brg'] . "' order by nama_brg ASC");
            while ($data_sel3 = mysqli_fetch_array($sel3)) {
            ?>
              <?php
              $jml_ditemukan = mysqli_num_rows(mysqli_query($koneksi, "select * from stok_opname_detail,barang_gudang_detail,barang_gudang where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=stok_opname_detail.barang_gudang_detail_id and barang_gudang.id= " . $data_sel3['id'] . " and stok_opname_id=" . $_GET['id'] . ""));
              ?>
              <tr>
                <td align="center"><?php echo $jml_ditemukan; ?></td>
              </tr>
            <?php } ?>
          </table>
        </td>
        <td>
          <table width="100%" border="1">
            <?php
            $sel4 = mysqli_query($koneksi, "select * from barang_gudang where merk_brg='" . $dt['merk_brg'] . "' order by nama_brg ASC");
            while ($data_sel4 = mysqli_fetch_array($sel4)) {
            ?>
              <?php
              $jml_fisik = mysqli_num_rows(mysqli_query($koneksi, "select * from barang_gudang_detail where barang_gudang_id= " . $data_sel4['id'] . ""));
              $jml_ditemukan = mysqli_num_rows(mysqli_query($koneksi, "select * from stok_opname_detail,barang_gudang_detail,barang_gudang where barang_gudang.id=barang_gudang_detail.barang_gudang_id and barang_gudang_detail.id=stok_opname_detail.barang_gudang_detail_id and barang_gudang.id= " . $data_sel4['id'] . " and stok_opname_id=" . $_GET['id'] . ""));
              if ($jml_fisik - $jml_ditemukan <= 0) {
                $bgcolor = "#00CC66";
              }
              ?>
              <tr bgcolor="<?php echo $bgcolor; ?>">
                <td align="center"><?php echo $jml_fisik - $jml_ditemukan; ?></td>
              </tr>
            <?php } ?>
          </table>

        </td>
      </tr>
    <?php } ?>
  <?php } else { ?>
    <tr>
      <td colspan="6" align="center">Data Kosong</td>
    </tr>
  <?php } ?>
</table>