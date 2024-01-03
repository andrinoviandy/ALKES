<?php
if ($_GET['paging']<5) {
	for ($i=1; $i<=5; $i++) {
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
        <?php
		}
		?>
        <li class="disabled"><a href="#">...</a></li>
        <?php
		for ($i=$j; $i<=$j; $i++) {
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
        <?php
			}
		}
		//lebih dari 4 dan kurang dari $j-4
elseif ($_GET['paging']>=4 and $_GET['paging']<=($j-4)) {
        for ($i=1; $i<=1; $i++) {
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
        <?php
		}
		?>
        <li class="disabled"><a href="#">...</a></li>
        <?php
		for ($i=($_GET['paging']-1); $i<=($_GET['paging']+1); $i++) {
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
        <?php
		}
		?>
        <li class="disabled"><a href="#">...</a></li>
        <?php
		for ($i=$j; $i<=$j; $i++) {
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
        <?php
			}
		}
		//lebih dari $j-4
elseif ($_GET['paging']>=($j-4)) {
        for ($i=1; $i<=1; $i++) {
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
        <?php
		}
		?>
        <li class="disabled"><a href="#">...</a></li>
        <?php
		for ($i=($j-4); $i<=$j; $i++) {
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
        <?php
		}
		?>
        <?php
		}
		?>