<?php
for ($i=1; $i<=$j; $i++) {
		?>
        <li>
        <?php
        if (isset($_GET['tgl1']) and isset($_GET['tgl2'])) {
		?>
        <a class="<?php if ($_GET['paging']==$i){echo "btn bg-olive";} ?>" href="<?php if (isset($_GET['paging'])) {echo str_replace("&paging=".$_GET['paging'],"",$_SERVER['REQUEST_URI']);} else {echo $_SERVER['REQUEST_URI'];} ?>&paging=<?php echo $i ?>"><?php echo $i; ?></a>
        <?php
		} elseif (isset($_GET['kunci']) and isset($_GET['pilihan'])) {
		?>
        <a class="<?php if ($_GET['paging']==$i){echo "btn bg-olive";} ?>" href="<?php if (isset($_GET['paging'])) {echo str_replace("&paging=".$_GET['paging'],"",$_SERVER['REQUEST_URI']);} else {echo $_SERVER['REQUEST_URI'];} ?>&paging=<?php echo $i ?>"><?php echo $i; ?></a>
        <?php
		} else {
		?>
        <a class="<?php if ($_GET['paging']==$i){echo "btn bg-olive";} ?>" href="<?php if (isset($_GET['paging'])) {echo str_replace("&paging=".$_GET['paging'],"",$_SERVER['REQUEST_URI']);} else {echo $_SERVER['REQUEST_URI'];} ?>&paging=<?php echo $i ?>"><?php echo $i; ?></a>
        <?php
		}
		?>
        </li>    	
    <?php } ?>