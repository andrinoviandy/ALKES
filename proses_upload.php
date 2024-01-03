<?php
include "import_excel/excel_reader.php";

require("config/koneksi.php");

	// membaca file excel yang diupload
$data = new Spreadsheet_Excel_Reader($_FILES['userfile']['tmp_name']);

// membaca jumlah baris dari data excel
$baris = $data->rowcount($sheet_index=0);

// import data excel mulai baris ke-2
// (karena baris pertama adalah nama kolom)
for ($i=2; $i <=$baris; $i++){
 $nama_brg = $data->val($i, 1);
 $tipe_brg = $data->val($i, 2);
 $merk_brg = $data->val($i, 3);
 $nie_brg = $data->val($i, 4);
 $no_bath = $data->val($i, 5);
 $no_lot = $data->val($i, 6);
 $negara_asal = $data->val($i, 7);
 $stok = $data->val($i, 8);
 $deskripsi_alat = $data->val($i, 9);
 $harga_satuan = $data->val($i, 10);
 $status_cek = $data->val($i, 11);


  // setelah data dibaca, sisipkan ke dalam tabel tsukses
  $hasil = mysqli_query($koneksi ,"INSERT INTO barang_gudang VALUES('','$nama_brg','$tipe_brg','$merk_brg','$nie_brg','$no_bath','$no_lot','$negara_asal','$stok','$deskripsi_alat','$harga_satuan','$status_cek')");
}
	
	if ($hasil) {
		echo "<script type='text/javascript'>
		alert('Data Berhasil Di Upload !');
		window.location='index.php?page=import_data';
		</script>";
		}
	else {
		echo "<script type='text/javascript'>
		alert('Data Gagal Di Upload !');
		window.location='index.php?page=import_data';
		</script>";
			}

?>