<?php
include "create_table.php";
include "connect.php";

$conn = connect();
if (!$conn) {
	die("ERROR: (" . $conn->connect_errno . ") " . $conn->connect_error);
}
$query = create_products_table();
$res = mysqli_query($conn, $query);
if (!$res) {
	die("Error when initializing products table");
export_from_csv($conn, "tuotteet.csv", "products");
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
</head>
<body>
	<table>
		<th><?php echo </th>
	</table>
</body>
</html>
