<?php
	include('check_request.php');
	session_start();
	$group_name= $_POST['group_name'];
	exec("sudo groupdel '$group_name'");
?>

