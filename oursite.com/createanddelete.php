<?php
session_start();
$show_shell=explode(PHP_EOL, shell_exec('cat /etc/shells'));
$shell_len=count($show_shell) -1;

$user_name = $_POST['user_name'];
$user_pass = $_POST['password'];
$conf_pass=$_POST['conpasswd'];
$first_name=$_POST['first_name'];
$last_name=$_POST['last_name'];
$shell=$_POST['shell'];
$ret_useradd = 0;
$ret_passwd = 0;

if(isset($_POST['create'])){
        exec('sudo useradd -m -p '.$user_pass." -c '".$first_name." ".$last_name."' -s ".$shell." ".$user_name,$ret_useradd);

if($ret_useradd) {
        printf("Something wrong with useradd, code: %d\n", $ret_useradd);
        exit();
  }


if($ret_passwd) {
          printf("Something wrong with chpasswd, code: %d\n", $ret_passwd);
          echo exec('userdel '.$user_name);
          exit();
  }



  printf("All done!\n");
}

?>
<html>
<head>
</head>
<body>
  <form method="POST" action="createanddelete.php">
    <input type="text" name="user_name" placeholder="username" />
    <input type="text" name="first_name" placeholder="first name" />
    <input type="text" name="last_name" placeholder="last name" />
    <input type="password" name="password" placeholder="password" />
    <input type="passowrd" name="conpasswd" placeholder="confermation passowrd"/>
<select>
<?php
echo $shell_len;
for($i=1;$i<$shell_len;$i++)
{
  echo "<option>".$show_shell[$i]."</option>";
}
  ?>
</select>

    <!--<input type="text" name="shell" placeholder="shell" />-->
    <button type="submit" value="show_all_user" name="create">create user </button>
  </form>
</body>
</html>
