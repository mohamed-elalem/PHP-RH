<?php 
	include('check_request.php');
	if(isset($_POST['add'])) {
		$group_user = explode('s3pudZsGN4GQc5iQC0FE', $_POST['info']);
		exec("sudo usermod -a -G ".$group_user[0]." ".$group_user[1]);
	}
	else if(isset($_POST['delete'])) {
		$group_user = explode('s3pudZsGN4GQc5iQC0FE', $_POST['info']);
		exec("sudo gpasswd -d ".$group_user[1]." ".$group_user[0]);
	}
?>
