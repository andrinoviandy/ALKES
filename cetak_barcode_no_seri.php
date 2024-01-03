<?php
//header("Content-type: application/vnd.ms-word");

$id=$_GET['id'];
require("config/koneksi.php");
if ($_GET['pilihan']=='tersedia') {
$sql = mysqli_query($koneksi, "select * from barang_gudang_detail where barang_gudang_id=$id and status_kirim=0 and status_kerusakan=0 order by no_seri_brg ASC");
}
elseif ($_GET['pilihan']=='rusak') {
$sql = mysqli_query($koneksi, "select * from barang_gudang_detail where barang_gudang_id=$id and status_kerusakan=1 order by no_seri_brg ASC");
}
elseif ($_GET['pilihan']=='tidak_layak') {
$sql = mysqli_query($koneksi, "select * from barang_gudang_detail where barang_gudang_id=$id and status_kerusakan=2 order by no_seri_brg ASC");
}
elseif ($_GET['pilihan']=='terjual') {
$sql = mysqli_query($koneksi, "select * from barang_gudang_detail where barang_gudang_id=$id and status_kirim=1 order by no_seri_brg ASC");
}
else {
$sql = mysqli_query($koneksi, "select * from barang_gudang_detail where barang_gudang_id=$id order by no_seri_brg ASC");
}
?>
<html>
    <head>
        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">
        <title>Cetak Barcode</title>
        <style>
		html,
body {
   margin:0;
   padding:0;
   height:100%;
}
#container {
   min-height:100%;
   position:relative;
}
#header {
   background:#ff0;
   padding:10px;
}
#body {
   padding:10px;
   padding-bottom:60px;   /* sesuaikan dengan tinggi footer */
}
#footer {
   position:absolute;
   bottom:0;
   width:100%;
   height:60px;
   font-size:13px;   /* tinggi dari footer */
   
}
         .mytable{
                border:1px solid black; 
            }
            .mytable tr th, .mytable tr td{
                border:1px solid black; 
                padding: 5px 5px;
            }
        </style>
        <link href='logo.png' rel='icon'>
    </head>
    <body onLoad="window.print();" style="font:Arial">
    <div id="container">
    <div id="body">
<?php while ($data = mysqli_fetch_array($sql)) { ?>
<font>
    <img src="php-barcode-master/barcode.php?text=<?php echo $data['no_seri_brg']; ?>&print=true&size=45" />
</font>
<?php } ?>
<br>
    </div>
    </div>
    </body>
</html>