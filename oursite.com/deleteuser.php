<?php
    //include('check_request.php');
    session_start();
    $user_name= $_POST['delete_user'];
    echo " $user_name";
    exec("sudo userdel '$user_name'");
    header('Location: index.php');
 ?>
