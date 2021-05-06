<?php
include "create_table.php";
include "connect.php";

$conn = connect();
if (!$conn) {
	die("ERROR: $conn->connect_error");
}
$prods = create_products_table($conn);
$sku = create_sku_table($conn);
if (!$prods || !$sku) {
	die("Error when initializing product tables");
}
$ret = csv_to_db($conn, "tuotteet.csv");
if (!$ret) {
	echo "ERROR";
}
?>
