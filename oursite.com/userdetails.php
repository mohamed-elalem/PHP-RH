<?php
$username=$_POST['username'];
$line=explode(":", exec('grep '.$username.' /etc/passwd'));
//print_r($line);
$passwd=$line[1];
$uid=$line[2];
$gid=$line[3];
$comment=$line[4];
$home=$line[5];
$default_shell=$line[6];
//add back button
?>
<!DOCTYPE html>
<html>
<head>
	<title><?= $username ?></title>
	<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="style.css" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
</head>
<body>
<div class="table-responsive">

<table class="table">
	<tr class="bg-info">
		<td>username</td><td><?= $username ?></td>

	</tr>
	<tr class="bg-danger">
		<td>passwd</td><td><?= $passwd ?></td>

	</tr>
	<tr class="bg-primary">
		<td>uid</td><td><?= $uid ?></td>

	</tr>
	<tr class="bg-warning">
		<td>gid</td><td><?= $gid ?></td>

	</tr>
	<tr class="bg-info">
		<td>comment</td><td><?= $comment ?></td>

	</tr>
	<tr class="bg-success">
		<td>home</td><td><?= $home ?></td>

	</tr>
	<tr class="bg-success">
		<td>default shell</td><td><?= $default_shell ?></td>
	</tr>


</table> <br>
<form class="" action="deleteuser.php" method="post">
		<button type="submit" name="delete_user" value="<?=$username?>">Delete User</button>
</form>


</div>
</body>
</html>
