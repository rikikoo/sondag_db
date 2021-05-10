<?php
function get_csv_data($target_file)
{
	if (file_exists($target_file)) {
		# open file
		$file = fopen($target_file, "r");

		# initialize variables
		$product = 0;
		$data = array();

		# copy content
		while (($csv_row = fgetcsv($file, 1000, ",")) !== FALSE)
		{
			foreach ($csv_row as $col) {
				$data[$product][] = $col;
			}
			$product++;
		}
		fclose($file);

		return ($data);
	}
	else {
		echo "Products file not found";
		return (false);
	}
}

function csv_to_db($conn, $data)
{
	if (!$data) {
		return (false);
	}

	$i = 0;
	$split_product = array();

	# split different sized/priced products
	foreach ($data as $key => $value) {
		$sizes = explode('/', $value[1]);
		$prices = explode('/', $value[2]);
		if (count($sizes) == 2 && count($prices) == 2) {
			$split_product[$i] = $data[$key];
			$data[$key][1] = $sizes[0];
			$data[$key][2] = $prices[0];
			$split_product[$i][1] = $sizes[1];
			$split_product[$i][2] = $prices[1];
			$i++;
		}
	}

	# add unique product names and descriptions to products table
	foreach ($data as $key => $value) {
		$name = mysqli_real_escape_string($conn, $value[0]);
		$desc = mysqli_real_escape_string($conn, $value[3]);
		$product_query = "INSERT INTO `products` (name, description)
			VALUES ('$name', '$desc')";
		$ret = mysqli_query($conn, $product_query);
		if (!$ret) {
			if (preg_match("/Duplicate entry/", mysqli_error($conn)) === false) {
				echo "SQL query #1 failed\n" . mysqli_error($conn) . PHP_EOL;
				return (false);
			}
		}
	}

	$data = array_merge($data, $split_product);
	# add sizes and prices to sku_products
	foreach ($data as $key => $value) {
		$name = mysqli_real_escape_string($conn, $value[0]);
		$size = mysqli_real_escape_string($conn, $value[1]);
		$price = preg_replace("/,/s", ".", $value[2]);
		$price = (float)preg_replace("/€/s", "", $price);
		$sku_query = "INSERT INTO `sku_products` (size, price, product_id)
			VALUES ('$size', $price, (SELECT product_id
									FROM `products`
									WHERE name LIKE '$name')
			)";
		$ret = mysqli_query($conn, $sku_query);
		if (!$ret) {
			if (preg_match("/Duplicate entry/", mysqli_error($conn)) === false) {
				echo "SQL query #2 failed\n" . mysqli_error($conn) . PHP_EOL;
				return (false);
			}
		}
	}
	return (true);
}
?>
