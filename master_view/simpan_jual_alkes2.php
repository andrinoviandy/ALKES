<?php require('../config/koneksi.php');
session_start(); ?>
<table width="100%" id="example1" class="table table-bordered table-hover" style="background-position:center; background-repeat:no-repeat; background-size:10%; <?php if ($_SESSION['status_po'] == 0) { ?>background-image:url(img/belum%20deal.png);<?php } else { ?>background-image:url(img/sudah%20deal.png);<?php } ?>">
    <thead>
        <tr>
            <th valign="bottom">No</th>
            <th valign="bottom"><strong>Nama Alkes</strong></th>

            <th align="center" valign="bottom"><strong>Harga
                    Jual</strong></th>
            <th align="center" valign="bottom"><strong>Tipe
                </strong></th>
            <th align="center" valign="bottom"><strong>Merk
                </strong></th>
            <th align="center" valign="bottom"><strong>Qty</strong></th>
            <td align="right" valign="bottom"><strong>Total (Harga Jual * Qty)</strong></td>
            <td align="right" valign="bottom"><strong>Ongkir Per Barang</strong></td>
            <th align="center" valign="bottom"><strong>Aksi</strong></th>
        </tr>
    </thead>
    <?php

    $no = 0;
    $q_akse = mysqli_query($koneksi, "select *,barang_dijual_qty_hash.id as idd from barang_dijual_qty_hash,barang_gudang where barang_gudang.id=barang_dijual_qty_hash.barang_gudang_id and barang_dijual_qty_hash.akun_id=" . $_SESSION['id'] . "");
    $jm = mysqli_num_rows($q_akse);
    if ($jm != 0) {
        while ($data_akse = mysqli_fetch_array($q_akse)) {
            $no++;
    ?>
            <tr>
                <td><?php echo $no; ?></td>
                <td align="left"><?php echo $data_akse['nama_brg']; ?>
                </td>

                <td align="left"><?php echo "Rp" . number_format($data_akse['harga_jual_saat_itu'], 2, ',', '.'); ?></td>
                <td align="left"><?php echo $data_akse['tipe_brg']; ?></td>
                <td align="left"><?php echo $data_akse['merk_brg']; ?></td>
                <td align="center"><?php echo $data_akse['qty']; ?></td>
                <td align="right"><?php echo number_format($data_akse['harga_satuan'] * $data_akse['qty'], 2, ',', '.'); ?></td>
                <td align="right" bgcolor="#FFFF00"><?php echo "Rp" . number_format($data_akse['okr'], 2, ',', '.'); ?></td>
                <td align="center"><a onclick="hapusData(<?php echo $data_akse['idd']; ?>);"><span data-toggle="tooltip" title="Hapus" class="ion-android-delete"></span></a></td>
            </tr>
    <?php }
    } else {
        echo "<tr><td colspan='9' align='center'>Tidak Ada Data</td></tr>";
    } ?>
    <tr bgcolor="#009900">
        <td colspan="9"></td>
    </tr>
    <tr>
        <td colspan="6" align="right"><strong> Total</strong></td>
        <td align="right"><?php
                            $total1 = mysqli_fetch_array(mysqli_query($koneksi, "select sum(qty*harga_satuan) as total1 from barang_gudang,barang_dijual_qty_hash where barang_gudang.id=barang_dijual_qty_hash.barang_gudang_id and akun_id=" . $_SESSION['id'] . ""));
                            echo number_format($total1['total1'], 2, ',', '.');
                            ?></td>
        <td align="center" bgcolor="#FFFF00"></td>
        <td align="center"></td>
    </tr>
    <tr>
        <td colspan="6" align="right">Total Ongkir
            <button type="button" data-toggle="modal" data-target="#modal-ongkir1" class="btn btn-info btn-xs"><span class="fa fa-edit"></span></button>
        </td>
        <td align="right" bgcolor="#FFFF00">
            <?php
            if (isset($_SESSION['ongkir'])) {
                $ongkir = $_SESSION['ongkir'];
                echo number_format($_SESSION['ongkir'], 2, ',', '.');
            } elseif ($_SESSION['ongkir'] == '') {
                $ongkir = 0;
                echo $ongkir;
            }
            ?>
        </td>
        <td align="center" bgcolor="#FFFF00"></td>
        <td align="center"></td>
    </tr>
    <!--
    <tr>
      <td colspan="6" align="right"><strong>DPP (Total+Ongkir)</strong></td>
      <td align="right">
        <?php
        if (isset($_SESSION['ongkir'])) {
            $dpp = $total1['total1'] + $_SESSION['ongkir'];
            echo number_format($total1['total1'] + $_SESSION['ongkir'], 2, ',', '.');
        } else {
            echo "...";
        }
        ?>
        </td>
      <td align="center"></td>
    </tr>
    -->
    <tr>
        <td colspan="6" align="right">DPP ((Total + Ongkir) /1.1)</td>
        <td align="right">
            <?php
            if (isset($_SESSION['ongkir'])) {
                $dpp = ($_SESSION['ongkir'] + $total1['total1']) / 1.1;
                echo number_format($dpp, 2, ',', '.');
            } else {
                echo "....";
            }
            ?>
        </td>
        <td align="center"></td>
        <td align="center"></td>
    </tr>
    <tr>
        <td colspan="6" align="right">Diskon (
            <?php
            if (isset($_SESSION['diskon']) and $_SESSION['diskon'] != '') {
                echo $_SESSION['diskon'];
            } else {
                echo "...";
            }
            ?>
            %)
            <button type="button" data-toggle="modal" data-target="#modal-ongkir2" class="btn btn-info btn-xs"><span class="fa fa-edit"></span></button>
        </td>
        <td align="right"><?php
                            if (isset($_SESSION['diskon'])) {
                                $diskon = $_SESSION['diskon'];
                                echo $diskon . "%";
                            } else {
                                echo "....";
                            }
                            ?></td>
        <td align="center"></td>
        <td align="center"></td>
    </tr>
    <tr>
        <td colspan="6" align="right">PPN (<?php
                                            if (isset($_SESSION['ppn']) and $_SESSION['ppn'] != '') {
                                                echo $_SESSION['ppn'];
                                            } else {
                                                echo "...";
                                            }
                                            ?> %) <button type="button" data-toggle="modal" data-target="#modal-ongkir3" class="btn btn-info btn-xs"><span class="fa fa-edit"></span></button></td>
        <td align="right">
            <?php
            if (isset($_SESSION['ppn'])) {
                $ppn = $_SESSION['ppn'] / 100 * ($dpp);
                echo number_format($ppn, 2, ',', '.');
            } else {
                echo "....";
            }
            ?>
        </td>
        <td align="center"></td>
        <td align="center"></td>
    </tr>
    <tr>
        <td colspan="6" align="right">PPh (<?php
                                            if (isset($_SESSION['pph']) and $_SESSION['pph'] != '') {
                                                echo $_SESSION['pph'];
                                            } else {
                                                echo "...";
                                            }
                                            ?> %) <button type="button" data-toggle="modal" data-target="#modal-ongkir4" class="btn btn-info btn-xs"><span class="fa fa-edit"></span></button></td>
        <td align="right"><?php
                            if (isset($_SESSION['pph'])) {
                                $pph = $_SESSION['pph'] / 100 * ($dpp);
                                echo number_format($pph, 2, ',', '.');
                            } else {
                                echo "....";
                            }
                            ?></td>
        <td align="center"></td>
        <td align="center"></td>
    </tr>

    <tr>
        <td colspan="6" align="right" valign="bottom">Zakat (<?php
                                                                if ($_SESSION['zakat'] != '') {
                                                                    echo $_SESSION['zakat'];
                                                                } else {
                                                                    echo "...";
                                                                }
                                                                ?> %)<button type="button" data-toggle="modal" data-target="#modal-ongkir5" class="btn btn-info btn-xs"><span class="fa fa-edit"></span></button></td>
        <td align="right" valign="bottom"><?php
                                            if (isset($_SESSION['zakat'])) {
                                                $zakat = $_SESSION['zakat'] / 100 * ($dpp);
                                                echo number_format($zakat, 2, ',', '.');
                                            } else {
                                                echo "....";
                                            }
                                            ?></td>
        <td align="center"></td>
        <td align="center"></td>
    </tr>
    <tr>
        <td colspan="6" align="right" valign="bottom">Biaya Bank <button type="button" data-toggle="modal" data-target="#modal-ongkir6" class="btn btn-info btn-xs"><span class="fa fa-edit"></span></button></td>
        <td align="right" valign="bottom"><?php
                                            if (isset($_SESSION['biaya_bank'])) {
                                                $biaya_bank = $_SESSION['biaya_bank'];
                                                echo number_format($_SESSION['biaya_bank'], 2, ',', '.');
                                            } else {
                                                echo "....";
                                            }
                                            ?></td>
        <td align="center"></td>
        <td align="center"></td>
    </tr>
    <tr>
        <td colspan="6" align="right" valign="bottom">
            <h4><strong>Neto (DPP(Dengan Ongkir)-(PPN dari DPP(Dengan Ongkir)+PPh dari DPP(Dengan Ongkir)+Zakat dari DPP(Dengan Ongkir)+Biaya Bank)</strong>)</h4>
        </td>
        <td align="right" valign="bottom">
            <h4><strong>
                    <?php
                    $total2 = $dpp - ($ppn + $pph + $zakat + $biaya_bank);
                    echo "Rp" . number_format($total2, 2, ',', '.'); ?>
                </strong></h4>
        </td>
        <td align="center"></td>
        <td align="center"></td>
    </tr>
    <tr>
        <td colspan="6" align="right" valign="bottom"><strong>Fee Supplier (DPP(Tanpa Ongkir)-(PPN dari DPP(Tanpa Ongkir)+PPh dari DPP(Tanpa Ongkir)+Zakat dari DPP(Dengan Ongkir)+Biaya Bank)</strong>)<strong>*Diskon</strong></td>
        <td align="right" valign="bottom">
            <strong>
                <?php
                $dpp_m = ($total1['total1'] / 1.1);
                //$ppn_m = $dpp_m*$_SESSION['ppn']/100;
                $pph_m = $dpp_m * $_SESSION['pph'] / 100;
                $zakat_m = $dpp_m * $_SESSION['zakat'] / 100;
                $biaya_bank_m = $biaya_bank;
                $fee_marketing = ($dpp_m - ($pph_m + $zakat_m + $biaya_bank_m)) * ($diskon / 100);
                echo "Rp" . number_format($fee_marketing, 2, ',', '.'); ?>
            </strong>
        </td>
        <td align="center"></td>
        <td align="center"></td>
    </tr>
</table>
<script>
    function hapusData(id) {
        // alert('Tes' + id)
        $.ajax({
            type: "POST",
            url: "master_delete/" + GetURLParameter('page') + ".php?id_hapus= " + id,
            success: function() {
                $('#content-data').load('master_view/' + GetURLParameter('page') + '.php')
            }
        });
    }
</script>