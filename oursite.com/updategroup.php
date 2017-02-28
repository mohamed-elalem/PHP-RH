<?php
include('check_request.php');
session_start();
$old_gName= $_POST['group_name'];

if(isset($_POST['edit']) && isset($_POST['group_name_f'])){
    $new_gName= $_POST['group_name_f'];
    if(!empty($new_gName)){
        $group_update  = explode(PHP_EOL, shell_exec("sudo groupmod -n $new_gName $old_gName "));
        header('Location: groups.php');
    }else{
        echo "Please Enter Group Name";
    }
}

 ?>
<html>
    <header>
        <title> update_group </title>
    </header>
    <body>
        <form action="updategroup.php" method="POST">
            <label> Enter new group name : </label>
            <input type="text" name="group_name_f">
            <button type="submit" name="edit">Edit</button>
        </form>
    </body>
</html>
