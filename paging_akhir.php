<?php
    if (isset($_GET['paging'])) {
		if ($_GET['paging']==$j) {
		$end = "disabled";
		$end_2 = "disabled";
		}
		else {
		$end = "enabled";
		$end_2 = "enabled";
			}
	} else {
		$end = "enabled";
		$end_2 = "enabled";
		}
	?>
    <li class="<?php echo $end; ?>"><a href="
    <?php 
	if (isset($_GET['paging'])) {
		if ($_GET['paging']==$j) {
		echo "#";
		}
		else {
		$pg = $_GET['paging']+1;
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
		$pg = $_GET['paging']+1;
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
	?>
    "><i class="fa fa-angle-right"></i></a></li>
    <li class="<?php echo $end_2; ?>"><a href="
    <?php 
	if (isset($_GET['paging'])) {
		if ($_GET['paging']==$j) {
		echo "#";
		}
		else {
			if (isset($_GET['tgl1']) and isset($_GET['tgl2'])) {
				if (isset($_GET['paging'])) {
					echo str_replace("&paging=".$_GET['paging'],"",$_SERVER['REQUEST_URI'])."&paging=$j";
					} 
				else {
					echo $_SERVER['REQUEST_URI']."&paging=$j";
					}
			
			} elseif (isset($_GET['kunci']) and isset($_GET['pilihan'])) {
				if (isset($_GET['paging'])) {
					echo str_replace("&paging=".$_GET['paging'],"",$_SERVER['REQUEST_URI'])."&paging=$j";
					} 
				else {
					echo $_SERVER['REQUEST_URI']."&paging=$j";
					}
			} else {
				if (isset($_GET['paging'])) {
					echo str_replace("&paging=".$_GET['paging'],"",$_SERVER['REQUEST_URI'])."&paging=$j";
					} 
				else {
					echo $_SERVER['REQUEST_URI']."&paging=$j";
					}
			}
		}
	} else {
		if (isset($_GET['tgl1']) and isset($_GET['tgl2'])) {
			if (isset($_GET['paging'])) {
					echo str_replace("&paging=".$_GET['paging'],"",$_SERVER['REQUEST_URI'])."&paging=$j";
					} 
				else {
					echo $_SERVER['REQUEST_URI']."&paging=$j";
					}
			
			} 
		elseif (isset($_GET['kunci']) and isset($_GET['pilihan'])) {
			if (isset($_GET['paging'])) {
					echo str_replace("&paging=".$_GET['paging'],"",$_SERVER['REQUEST_URI'])."&paging=$j";
					} 
				else {
					echo $_SERVER['REQUEST_URI']."&paging=$j";
					}
			} 
		else {
			if (isset($_GET['paging'])) {
					echo str_replace("&paging=".$_GET['paging'],"",$_SERVER['REQUEST_URI'])."&paging=$j";
					} 
				else {
					echo $_SERVER['REQUEST_URI']."&paging=$j";
					}
			}
		}
	?>
    "><i class="fa fa-angle-double-right"></i></a></li>