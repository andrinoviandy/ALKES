<?php
include("config/koneksi.php");
$start = mysqli_real_escape_string($koneksi, $_POST['start']);
$query = mysqli_query($koneksi, "select * from riwayat_admin LIMIT $start, 20");
  $no = $_POST['start'];
  while ($data = mysqli_fetch_assoc($query)) { 
  $no++;
  ?>
  <tr>
    <td align='center'><?php echo $no ?></td>
    <td><?php echo $data['username'] ?></td>
    <td><?php echo $data['tgl_jam_masuk'] ?></td>
    <td><?php echo $data['tgl_jam_keluar'] ?></td>
    </tr>
    <?php
	}
	?>