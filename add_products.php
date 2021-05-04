<?php
include("install.php");

if ($_POST) {
	$brand = $_POST['brand'];
	$name = $_POST['name'];
	$size = $_POST['size'];
	$price = preg_replace('/,/s', '.', $_POST['price']);
	$description = $_POST['description'];
	$category = $_POST['main_category'];

	$sql = "INSERT INTO products ('brand', 'name', 'size', 'price', 'description', 'main_category')
			VALUES (?, ?, ?, ?, ?, ?)";

	$stmt = mysqli_prepare($conn, $sql);
	mysqli_stmt_bind_param($stmt, "sssdss", $brand, $name, $size, (float)$price, $description, $category);
	$ret = mysqli_stmt_excute($stmt);
	if (!$ret) {
		echo "Error in SQL statement execution: " . mysqli_stmt_error($stmt) . PHP_EOL;
		header("Location: sondag_product_manager.html");
	}
	else {
		echo "Product added successfully";
		header("Location: sondag_product_manager.html");
	}
}
?>
