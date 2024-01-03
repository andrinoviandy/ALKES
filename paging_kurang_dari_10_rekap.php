<?php
for ($i=1; $i<=$j; $i++) {
		?>
        <li>
        <?php
        if (isset($_GET['tgl1']) and isset($_GET['tgl2'])) {
		?>
        <a class="<?php if ($_GET['paging']==$i){echo "btn bg-olive";} ?>" href="?page=<?php echo $_GET['page'] ?>&tgl1=<?php echo $_GET['tgl1']; ?>&tgl2=<?php echo $_GET['tgl2']; ?>&paging=<?php echo $i ?>"><?php echo $i; ?></a>
        <?php
		} elseif (isset($_GET['kunci']) and isset($_GET['pilihan'])) {
		?>
        <a class="<?php if ($_GET['paging']==$i){echo "btn bg-olive";} ?>" href="?page=<?php echo $_GET['page'] ?>&pilihan=<?php echo $_GET['pilihan']; ?>&kunci=<?php echo $_GET['kunci']; ?>&paging=<?php echo $i ?>"><?php echo $i; ?></a>
        <?php
		} else {
		?>
        <a class="<?php if ($_GET['paging']==$i){echo "btn bg-olive";} ?>" href="?page=<?php echo $_GET['page'] ?>&paging=<?php echo $i ?>"><?php echo $i; ?></a>
        <?php
		}
		?>
        </li>    	
    <?php } ?>