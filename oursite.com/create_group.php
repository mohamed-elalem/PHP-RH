<?php

  session_start();
  $group_name= $_POST['group_name'];
  if(isset($_POST['create_group'])){
  exec("sudo groupadd '$group_name'",$output,$ret);
  if($ret==0)
  {
    header('Location: groups.php');
  }
  
}

?>
<html>
<head>
  <title>Bootstrap Example</title>
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
  <body>

<div class="jumbotron">
  <h1>Creating Group</h1>
</div>
<div class="container">
  <div class="row">
    <div class="col-md-4">

    </div>
    <div class="col-md-4">
      <form method="POST" action="create_group.php">

          <div class="form-group">
                <label for="ex3">Creating Group</label>
                <input class="form-control" id="ex3" name="group_name" type="text">
            </div>
              <input type="submit" name="create_group" class="btn btn-primary pull-right" value="Create Group">

          </form>

    </div>
  </div>
</div>
  </div>
  </body>

</html>
