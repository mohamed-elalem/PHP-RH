
<?php
session_start();
$show_shell=explode(PHP_EOL, shell_exec('cat /etc/shells'));
$shell_len=count($show_shell) -1;
$code = 1;
$user_name = $_POST['user_name'];
$user_pass = $_POST['password'];
$conf_pass=$_POST['conpasswd'];
$first_name=$_POST['first_name'];
$last_name=$_POST['last_name'];
$shell=$_POST['shell'];
$ret_useradd = 0;
$ret_passwd = 0;

if(isset($_POST['create'])){
        exec('sudo useradd -m -p '.$user_pass." -c '".$first_name." ".$last_name."' -s ".$shell." ".$user_name,$ret_useradd,$code);

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
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

  <script type="text/javascript">
     function Validate() {
         var password = document.getElementById("txtPassword").value;
         var confirmPassword = document.getElementById("txtConfirmPassword").value;
         if (password != confirmPassword) {
             alert("Passwords do not match.");
             return false;
         }
         return true;
     }
 </script>
</head>
<body  onsubmit="Validate();">
  <div class="container">
  <div class="jumbotron">
    <h1>Creating User</h1>
    <?php
      if($code != 1) {
        ?>
        <h3 class='text-danger'>Error occured</h3>
        <?php
      }
    ?>
  </div>

</div>


<div class="container">
  <div class="row">
    <div class="col-md-4">
    </div>
    <div class='col-md-4'>
  <h2>Welcome</h2>
  <form method="POST" action="createanddelete.php">
    <div class="form-group">
      <label class="control-label" for="user_name">UserName:</label>
      <input type="text" class="form-control" id="user_name" name="user_name" placeholder="UserName">
    <div class="form-group">
      <label class="control-label" for="user_name">First Name:</label>
        <input type="text" name="first_name" class="form-control" placeholder="first name" />

        <div class="form-group">
          <label class="control-label" for="user_name">Last Name:</label>
        <input type="text" name="last_name" class="form-control" placeholder="last name" />

    </div>
    <div class="form-group">
      <label class="control-label" for="pwd">Password:</label>
        <input type="password" name="password" class="form-control" id="txtPassword" placeholder="Enter password">
<div class="form-group">
  <label class="control-label" for="pwd">Repaet Password:</label>
        <input type="password" name="conpasswd" class="form-control" id="txtConfirmPassword" placeholder="Repeat password">
           <p id="password_status"> <p>
    </div>

<div class="form-group">
      <label class='control-label' for="sel1">Select Your Shell:</label>
      <select name="shell" class="form-control" id="sel1">
<?php
        for($i=1;$i<$shell_len;$i++)
        {
          echo "<option>".$show_shell[$i]."</option>";
        }
          ?>
      </select>
  </div>
</div>

        <button type="submit" id="submit" class="btn btn-primary btn-block" name="create">CreateUser</button>
      </form>
</div>
</div>
</div>

</body>
</html>
