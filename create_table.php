<?php
function create_products_table($conn)
{
	$table = "CREATE TABLE IF NOT EXISTS products (
		product_id INT AUTO_INCREMENT PRIMARY KEY,
		brand VARCHAR(32),
		name VARCHAR(32) NOT NULL,
		description VARCHAR(1024) NOT NULL,
		main_category VARCHAR(16)
	)";

	$ret = mysqli_query($conn, $table);
	return ($ret);
}

function create_sku_table($conn)
{
	$table = "CREATE TABLE IF NOT EXISTS sku_products (
		sku_id INT AUTO_INCREMENT PRIMARY KEY,
		product_id INT,
		size VARCHAR(16),
		price FLOAT,
		image VARCHAR(64),
		FOREIGN KEY (product_id) REFERENCES products(product_id)
	)";

	$ret = mysqli_query($conn, $table);
	return ($ret);
}
?>
