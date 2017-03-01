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
        <head>
         <title> update_group </title>
         <meta charset="utf-8">
         <meta name="viewport" content="width=device-width, initial-scale=1">
         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
         <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        </head>
    </header>
    <body>
      <div class="jumbotron">
        <h1>Updating Group</h1>
      </div>
      <div class="container">
        <div class="row">
          <div class="col-md-4">

          </div>
          <div class="col-md-4">
        <form action="updategroup.php" method="POST">
          <div class="form-group">
            <label> Enter new group name : </label>
            <input class="form-control" type="text" name="group_name_f">
          </div>
            <button type="submit" name="edit" class="btn btn-primary pull-right">Edit</button>
        </form>
      </div>
    </div>
  </div>
    </div>
    </body>
</html>
