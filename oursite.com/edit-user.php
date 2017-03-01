<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Test</title>
  </head>
  <body>
    <?php
    $show_shell = explode(PHP_EOL, shell_exec('cat /etc/shells'));
    $shell_len = count($show_shell)-1;
    $show_group = explode(PHP_EOL, shell_exec('cat /etc/group|cut -d: -f1'));
    array_pop($show_group);

    echo exec("sudo tail /etc/passwd")."<br>";
    $user=exec("sudo tail -n+42 /etc/passwd|cut -f1 -d:");
    $exec_string="";
    $success_str="";
    $str_prefix="sudo usermod ";
    $str_suffix="$user";

    if(isset($_POST['login'])){
      exec("sudo pkill -u ".$user);
      exec("sudo pkill -9 -u ".$user);
      if (!empty($_POST['login'])) {
        $exec_string.="-l ".$_POST['login']." ";
      }
      echo $exec_string."<br>";
      $success_str.="Login-";
      if (!empty($_POST['fname'])) {
        $fname = $_POST['fname'];
        if (!empty($_POST['lname'])) {
          $lname = $_POST['lname'];
          $exec_string.="-c '".$fname." ".$lname."' ";
        }
        else {
          $exec_string.="-c '".$fname."' ";
        }
      }
      if (!empty($_POST['shell'])) {
        $shell=$_POST['shell'];
        $exec_string .= "-s '".$shell."' ";
      }
      if (!empty($_POST['passwd'])) {
        $passwd=$_POST['passwd'];
        $username="Mahdy";
        $pass_string="echo '".$username.":'".$passwd."''|sudo chpasswd -c SHA512";
        exec($pass_string);
      }
      if (!empty($_POST['prigroup'])) {
        $prigroup=$_POST['prigroup'];
        $exec_string .= "-g '".$prigroup."' ";
      }
      if (!empty($_POST['$secgroup'])) {
        $secgroup=$_POST['$secgroup'];
        $exec_string .= "-G '".$secgroup."' ";
      }

    }
    $exec_string=$str_prefix.$exec_string.$str_suffix;
    echo $exec_string."<br>";
    exec($exec_string);
     ?>
    <form class="" action="index.php" method="post">
      <table width=70% align="center">
      <tr><td width=25%>Login-Name:</td><td width=75%><input type="text" name="login"></td><tr>
      <tr><td width=25%>UID</td><td width=75%><input type="text" name="uid"></td><tr>
      <tr><td width=25%>First Name</td><td width=75%><input type="text" name="fname"></td><tr>
      <tr><td width=25%>Last Name</td><td width=75%><input type="text" name="lname"></td><tr>
      <tr><td width=25%>Shell</td><td width=75%>
        <select class="" name="shell">
          <?php
          for($i=1;$i<$shell_len;$i++){
            echo "<option>".$show_shell[$i]."</option>";
          }
           ?>
        </select>
      </td><tr>
      <tr><td width=25%>Password</td><td width=75%><input type="text" name="passwd"></td><tr>
      <tr><td width=25%>Primary Group</td><td width=75%>
        <select class="" name="prigroup">
          <?php
          foreach ($show_group as $gname)
          {
            echo "<option>".$gname."</option>";//check for currently active group
          }
           ?>
        </select>
      </td></tr>
<!--       <tr><td width=25%>Secondary Group</td><td width=75%></td><tr>
 -->      <tr><td width=25%><input type="submit"></td></tr>
    </table>
    </form>
  </body>
</html>


     </form>
   </body>
 </html>
