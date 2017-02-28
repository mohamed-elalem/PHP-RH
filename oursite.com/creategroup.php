<?php
//include('check_request.php');

if(isset($_POST['create']) && isset($_POST['group_name_f']) && isset($_POST['group_id_f'])){
    $group_Name= $_POST['group_name_f'];
    $group_id= $_POST['group_id_f'];
    if(!empty($group_Name) && !empty($group_id)){
        $result  = explode(PHP_EOL, shell_exec("cat /etc/group | grep '$group_Name' "));
        echo "hi";
        print_r($result);
        if(empty($result)){
            if(empty($result)){
                exec("sudo groupadd -g $group_Name $group_id ");
                //header('Location: groups.php');
            }else{
                echo "group ID  $group_id already exists";
            }
        }else{
            echo "group $group_Name already exists";
        }
    }else{
        echo "Please Enter required data";
    }
}

 ?>
<html>
    <header>
        <title> create_group </title>
    </header>
    <body>
        <form action="creategroup.php" method="POST">
            <label> Enter group name : </label>
            <input type="text" name="group_name_f"><br>
            <label> Enter group id : </label>
            <input type="text" name="group_id_f">
            <button type="submit" name="create">Create</button>
        </form>
    </body>
</html>
