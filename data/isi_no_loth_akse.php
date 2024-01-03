<?php
// include("../config/koneksi.php");
include("../include/API.php");
session_start();
error_reporting(0);
?>
<?php

$file = file_get_contents($API . "json/isi_no_loth_akse.php?id=$_GET[id]");

$json = json_decode($file, true);
$jml = count($json);
?>
<option value="">...</option>
<?php
for ($i = 0; $i < $jml; $i++) {
?>
    <option value="<?php echo $json[$i]['idd']; ?>"><?php echo $json[$i]['no_lot_akse']; ?></option>
<?php } ?>