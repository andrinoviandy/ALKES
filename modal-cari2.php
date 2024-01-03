<?php
if (isset($_POST['pencarian'])) {
		if ($_POST['pilihan']=='tgl') {
		echo "<script>window.location='index.php?page=$_GET[page]&tgl1=$_POST[tgl1]&tgl2=$_POST[tgl2]'</script>";
		} else {
		echo "<script>window.location='index.php?page=$_GET[page]&kunci=$_POST[kata_kunci]'</script>";
		}
		
	}
?>
<div class="modal fade" id="modal-cari">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
              <script type="text/javascript">
			  function yesnoCheck() {
				  if (document.getElementById('yesCheck').value=='tgl') {
					  document.getElementById('ifYes').style.display = 'block';
					  document.getElementById('kata_kunci').style.display = 'none';
					  }
					  else if (document.getElementById('yesCheck').value=='') {
					  document.getElementById('ifYes').style.display = 'none';
					  document.getElementById('kata_kunci').style.display = 'none';
					  }
					  else 
					  { document.getElementById('ifYes').style.display = 'none';
					  document.getElementById('kata_kunci').style.display = 'block';
					  }
					  }

 

</script>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Pencarian</h4>
              </div>
              <form method="post" enctype="multipart/form-data">
              <div class="modal-body">
                <select class="form-control select2" name="pilihan" required style="width:100%" onchange="javascript:yesnoCheck();" id="yesCheck">
                <option value="">...</option>
                <option value="tgl">Berdasarkan Rentang Tanggal</option>
                <option value="no_po_pesan">Berdasarkan Kata Kunci (Selain Tanggal)</option>
                </select>
                <div id="kata_kunci" style="display:none">
                <br />
                <input type="text" class="form-control" name="kata_kunci" placeholder="Kata Kunci"/>
                </div>
                <div id="ifYes" style="display:none">
                <br />
              <label>Dari Tanggal</label>
              <input name="tgl1" type="date" class="form-control" placeholder="" value=""><br />
              <label>Sampai Tanggal</label>
              <input name="tgl2" type="date" class="form-control" placeholder="" value="">
              </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-info" name="pencarian">Cari</button>
              </div>
              </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>