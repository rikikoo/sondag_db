<html>
	<head>
		<meta charset="utf-8" />
		<title>Tuotteiden hallinta - Söndag</title>
		<link rel="stylesheet" href="manager.css" />
	</head>

<?php
include("connect.php");
$conn = connect();
$query = "SELECT
		products.product_id, products.brand, products.name,
		sku_products.size, sku_products.price,
		products.description, products.main_category
		FROM products
		LEFT JOIN sku_products
		ON products.product_id = sku_products.product_id";
$prod = mysqli_query($conn, $query, MYSQLI_USE_RESULT);
?>

	<body>
		<div class="container">
			<div class="menu">

			</div>
			<div class="prodTab">
				<table id="products">
					<thead>
						<td>ID</td>
						<td>Brand</td>
						<td>Name</td>
						<td>Size</td>
						<td>Price</td>
						<td>Description</td>
						<td>Category</td>
					</thead>
					<?php while ($row = mysqli_fetch_array($prod, MYSQLI_ASSOC)) : ?>
						<tr>
							<td><?php echo $row["product_id"] ?></td>
							<td><?php echo $row["brand"] ?></td>
							<td><?php echo $row["name"] ?></td>
							<td><?php echo $row["size"] ?></td>
							<td><?php echo $row["price"] ?></td>
							<td><?php echo $row["description"] ?></td>
							<td><?php echo $row["main_category"] ?></td>
						</tr>
					<?php endwhile; ?>
				</table>
			</div>
		</div>
	</body>
</html>
