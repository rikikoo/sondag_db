<?php
function connect()
{
	$pw = preg_replace("/\n/s", "", file_get_contents("private/passwd"));
	$mysqli = mysqli_connect("127.0.0.1", "root", $pw, "sondag");
	if (!$mysqli) {
	    die("Failed to connect to MySQL");
	}
	echo mysqli_get_host_info($mysqli) . "\n";

	return ($mysqli);
}
?>
