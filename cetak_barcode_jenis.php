<?php
//header("Content-type: application/vnd.ms-word");


?>
<html>
    <head>
        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">
        <title>Cetak Barcode</title>
        <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="plugins/iCheck/all.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="plugins/timepicker/bootstrap-timepicker.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="bower_components/select2/dist/css/select2.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
        <link href='logo.png' rel='icon'>
    </head>
    <body onLoad="window.print();" style="font:Arial">
    <?php
require_once('qrcode/qrlib.php');
QRcode::png("$_POST[kode_barcode]","scan_qrcode/"."kode.png","M", 2,2);
for ($i=1; $i<=$_POST['jml']; $i++) { ?>
    <table width="100%">
    <tr>
      <td>&nbsp;</td>
      <td></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
    	<td><img src="scan_qrcode/kode.png" alt="" width="100%"/></td>
        <td width="30%"></td>
        <td><img src="scan_qrcode/kode.png" alt="" width="100%"/></td>
    </tr>
    <tr>
      <td align="center" style="font-size:12px"><?php echo $_POST['nie_brg'] ?></td>
      <td></td>
      <td align="center" style="font-size:12px"><?php echo $_POST['nie_brg'] ?></td>
    </tr>
    <tr>
    	<td align="center" style="font-size:14px"><?php echo $_POST['no_seri'] ?></td>
        <td></td>
        <td align="center" style="font-size:14px"><?php echo $_POST['no_seri'] ?></td>
    </tr>
    </table>
              
            
<?php } ?>

<br>
    
    </body>
</html>