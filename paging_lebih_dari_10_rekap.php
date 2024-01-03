<?php
if ($_GET['paging']<5) {
	for ($i=1; $i<=5; $i++) {
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
        <?php
		}
		?>
        <?php
		}
		?>