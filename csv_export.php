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

	$data = array_merge($data, $split_product);

	foreach ($data as $key => $value) {
		$product_query = "INSERT INTO `products` (
			name,
			description,
		)
		VALUES (
			$value[0],
			$value[3]
		)";
		$ret = mysqli_query($conn, $product_query);
		if (!$ret) {
			echo ("SQL query failed\n");
			return (false);
		}
	}
}
?>
