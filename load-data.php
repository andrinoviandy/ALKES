<?php
// memanggil file config.php
require 'config/koneksi.php';

/*
 * DataTables example server-side processing script.
 *
 * Please note that this script is intentionally extremely simply to show how
 * server-side processing can be implemented, and probably shouldn't be used as
 * the basis for a large complex system. It is suitable for simple use cases as
 * for learning.
 *
 * See http://datatables.net/usage/server-side for full details on the server-
 * side processing requirements of DataTables.
 *
 * @license MIT - http://datatables.net/license_mit
 */

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */

// DB table to use
$table = 'barang_gudang';

// Table's primary key
$primaryKey = 'id';

// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case object
// parameter names
$columns = array(
	array( 'db' => 'nama_brg', 'dt' => 1 ),
	array( 'db' => 'tipe_brg',  'dt' => 2 ),
	array( 'db' => 'merk_brg',  'dt' => 3 ),
	array( 'db' => 'nie_brg',  'dt' => 4 ),
	array( 'db' => 'no_bath',  'dt' => 5 ),
	array( 'db' => 'no_lot',  'dt' => 6 ),
	array( 'db' => 'negara_asal',  'dt' => 7 ),
	array( 'db' => 'stok',  'dt' => 8 ),
	array( 'db' => 'deskripsi_alat',  'dt' => 9 ),
	array( 'db' => 'harga_satuan',  'dt' => 10 )
	
);

// SQL server connection information
$sql_details = array(
	'user' => $username_koneksi,
	'pass' => $password_koneksi,
	'db'   => $database_koneksi,
	'host' => $hostname_koneksi
);


/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */

require( 'includes/scripts/ssp.class.php' );

echo json_encode(
	SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
);

