<?php
$username=$_POST['username'];
$line=explode(":", exec('grep '.$username.' /etc/passwd'));
//print_r($line);
$passwd=$line[1];
$uid=$line[2];
$gid=$line[3];
$primary_group=exec('getent group '.$gid.' | cut -f1 -d:');
$secondary_groups=explode(" ", trim(shell_exec('groups '.$username.' | cut -f2 -d:')));
//print_r( $secondary_groups);
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
<div >

<table class="table table-responsive table-bordered table-hover">
	<tr class="bg-info">
		<th>username</th><td><?= $username ?></td>

	</tr>
	<tr class="bg-danger">
		<th>password</th><td><?= $passwd ?></td>

	</tr>
	<tr class="bg-primary">
		<th>uid</th><td><?= $uid ?></td>

	</tr>
	<tr class="bg-warning">
		<th>group</th><td><?= $primary_group ?></td>

	</tr>
	<tr class="bg-info">
		<th>comment</th><td><?= $comment ?></td>

	</tr>
	<tr class="bg-success">
		<th>home</th><td><?= $home ?></td>

	</tr>
	<tr class="bg-success">
		<th>default shell</th><td><?= $default_shell ?></td>
	</tr>


</table> <br>
<form class="" action="deleteuser.php" method="post">
		<button type="submit" name="delete_user" value="<?=$username?>">Delete User</button>
</form>


</div>
<div>
<table class="table table-responsive table-bordered table-hover">
	<tr>
		<th>Secondary groups</th>
		<?php
			foreach ($secondary_groups as $grp ) {
				if($grp != $primary_group){
				?>
				<td>
					<?= $grp ?>
				</td>
				<?php
				}
			}
		?>
	</tr>
</table>
</div>
</body>
</html>
