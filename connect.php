<?php
function connect()
{
	$pw = file_get_contents("private/passwd");
	$mysqli = mysqli_connect("127.0.0.1", "root", $pw);
	if (!$mysqli) {
	    die("Failed to connect to MySQL: (" . $mysqli_connect_errno() . ") " . $mysqli->connect_error);
	}
	echo mysqli_get_host_info($mysqli) . "\n";

	$query = "CREATE DATABASE IF NOT EXISTS sondag";
	mysqli_query($mysqli, $query);
	return ($mysqli);
}
?>
