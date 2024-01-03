<?php
	if (isset($_GET['paging'])) {
		if ($_GET['paging']==1) {
		$first = "disabled";
		$first_2 = "disabled";
		}
		else {
		$first = "enabled";
		$first_2 = "enabled";
			}
	} else {
		$first = "disabled";
		$first_2 = "disabled";
		}
	?>
    <li class="<?php echo $first; ?>"><a href="
    <?php 
	if (isset($_GET['paging'])) {
		if ($_GET['paging']==1) {
		echo "#";
		}
		else {
			if (isset($_GET['tgl1']) and isset($_GET['tgl2'])) {
				if (isset($_GET['paging'])) {
					echo str_replace("&paging=".$_GET['paging'],"",$_SERVER['REQUEST_URI'])."&paging=1";
					} 
				else {
					echo $_SERVER['REQUEST_URI']."&paging=1";
					}
			} elseif (isset($_GET['kunci']) and isset($_GET['pilihan'])) {
				if (isset($_GET['paging'])) {
					echo str_replace("&paging=".$_GET['paging'],"",$_SERVER['REQUEST_URI'])."&paging=1";
					} 
				else {
					echo $_SERVER['REQUEST_URI']."&paging=1";
					}
			} else {
				if (isset($_GET['paging'])) {
					echo str_replace("&paging=".$_GET['paging'],"",$_SERVER['REQUEST_URI'])."&paging=1";
					} 
				else {
					echo $_SERVER['REQUEST_URI']."&paging=1";
					}
			}
		}
	} else {
		echo "#";
		}
	?>
    "><i class="fa fa-angle-double-left"></i></a></li>
    <li class="<?php echo $first_2; ?>"><a href="
    <?php 
	if (isset($_GET['paging'])) {
		if ($_GET['paging']==1) {
		echo "#";
		}
		else {
		$pg = $_GET['paging']-1;
			if (isset($_GET['tgl1']) and isset($_GET['tgl2'])) {
				if (isset($_GET['paging'])) {
					echo str_replace("&paging=".$_GET['paging'],"",$_SERVER['REQUEST_URI'])."&paging=$pg";
					} 
				else {
					echo $_SERVER['REQUEST_URI']."&paging=$pg";
					}
			} elseif (isset($_GET['kunci']) and isset($_GET['pilihan'])) {
				if (isset($_GET['paging'])) {
					echo str_replace("&paging=".$_GET['paging'],"",$_SERVER['REQUEST_URI'])."&paging=$pg";
					} 
				else {
					echo $_SERVER['REQUEST_URI']."&paging=$pg";
					}
			} else {
				if (isset($_GET['paging'])) {
					echo str_replace("&paging=".$_GET['paging'],"",$_SERVER['REQUEST_URI'])."&paging=$pg";
					} 
				else {
					echo $_SERVER['REQUEST_URI']."&paging=$pg";
					}
			}
		}
	} else {
		echo "#";
		}
	?>
    "><i class="fa fa-angle-left"></i></a></li>
    