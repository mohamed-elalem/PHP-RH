<?php
	if($_SERVER['REQUEST_METHOD'] != 'POST') {
		header("HTTP/1.0 403 Forbidden");
		echo "403 Access Forbidden";
	}
?>
