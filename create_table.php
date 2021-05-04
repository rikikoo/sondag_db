<?php
function create_products_table()
{
	$table = "CREATE TABLE IF NOT EXISTS products (
	id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	brand VARCHAR(32) NOT NULL,
	name VARCHAR(32) NOT NULL,
	size VARCHAR(16) NOT NULL,
	price VARCHAR(16) NOT NULL,
	description VARCHAR(1024),
	main_category VARCHAR(16)
	)";

	return ($table);
}
?>
