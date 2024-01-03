<?php 
if (isset($_GET['kunci']) or isset($_GET['tgl1']) and isset($_GET['tgl2']))  {
?>
<section class="col-lg-8">
        	
        		<div class="alert box alert-dismissible">
                <a onclick="history.back();" type="button" class="close" data-dismiss="alert" aria-hidden="true"><button>&times;</button></a>
                <h4><i class="icon fa fa-search"></i>Pencarian</h4>
                <h4>
				<?php
                if (isset($_GET['kunci'])) {
					echo "Kode QR '".$_SESSION['qrcode']."'";
					}
				else {
					echo "Dari Tanggal '".tgl_indo($_GET['tgl1'])." Sampai ".tgl_indo($_GET['tgl2'])."'";
					}
				?></h4>
                </div>
            
        </section>
        <?php if ($_SESSION['status']=='1') { ?>
		<section class="col-lg-4">
        	
        		<div class="alert btn-success alert-dismissible" align="center">
                <font style="font-size:300%">DITEMUKAN</font>
                </div>
            
        </section>
        <?php } else { ?>
        <section class="col-lg-4">
        	
        		<div class="alert btn-danger alert-dismissible" align="center">
                <font style="font-size:300%">TIDAK DITEMUKAN</font>
                </div>
            
        </section>
		<?php } ?>
<?php } ?>