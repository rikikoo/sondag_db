<?php
include "create_table.php";
include "connect.php";
include "csv_export.php";

$conn = connect();
if (!$conn) {
	die("ERROR: $conn->connect_error");
}
$prods = create_products_table($conn);
$sku = create_sku_table($conn);
if (!$prods || !$sku) {
	die("Error when initializing product tables");
}
$data = get_csv_data("data/tuotteet.csv");
$ret = csv_to_db($conn, $data);
?>
