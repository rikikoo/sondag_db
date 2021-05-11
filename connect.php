<?php
function connect()
{
	$pw = preg_replace("/\n/s", "", file_get_contents("private/passwd"));
	return (mysqli_connect("127.0.0.1", "root", $pw, "sondag"));
}
?>
