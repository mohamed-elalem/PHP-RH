<?php
include(check_request.php);
session_start();
$group_name= $_POST['group_name'];
if(isset($_POST['delete'])){
exec("sudo groupdel '$group_name'");
}
?>
<html>
<head>
</head>
<body>
  <form method="POST" action="delete.php">
    <input type="text" name="group_name" placeholder="groupname" />
    <button type="submit" value="delete_group" name="delete">delete group </button>
  </form>
</body>
</html>
