<?php
function export_from_csv($conn, $target_file, $tab)
{
	if (file_exists($target_file))
	{
		// Read file
		$file = fopen($target_file, "r");
		$row = 0;
		$importData_arr = array();

		// Convert to arrays
		while (($data = fgetcsv($file, 1000, ",")) !== FALSE)
		{
			$n = count($data);

			for ($col = 0; $col < $n; $col++)
			{
				$importData_arr[$row][] = $data[$col];
			}
			$row++;
		}
		fclose($file);

		$brand = "";
		
	}
	else {
		echo "Products file not found";
		header("Location: sondag_product_manager.html");
	}
}
?>
