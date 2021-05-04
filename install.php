<?php
import("create_table.php");
import("connect.php");

$conn = connect();
if (!$conn) {
	die("ERROR: (" . $conn->connect_errno . ") " . $conn->connect_error);
}
$tab = create_products_table();
$res = mysqli_query($conn, $tab);
if (!$res) {
	die("Error when initializing products table");
}
?>
