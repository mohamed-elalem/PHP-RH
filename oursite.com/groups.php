<?php
	$group_names = explode(PHP_EOL, shell_exec("cut -f1 -d: /etc/group"));
	$group_names_count = count($group_names) - 1;
	$all_users = explode(PHP_EOL, shell_exec("cut -f1 -d: /etc/passwd"));
	$all_users_count = count($all_users);
	unset($all_users[$all_users_count - 1]);
	$all_users_count -= 1;
	$group_and_members = array();
	
	for($i = 0; $i < $group_names_count; $i++) {
		$group_names[$i] = trim($group_names[$i]);
	}
	
	for($i = 0; $i < $all_users_count; $i++) {
		$all_users[$i] = trim($all_users[$i]);
	}
	
	for($i = 0; $i < $group_names_count; $i++) {
		$members = explode(" ", shell_exec("members ".$group_names[$i]));
		$members_count = count($members);
		if(!empty($members[0])) {				
			for($j = 0; $j < $members_count; $j++) {
				$group_and_members[$group_names[$i]][trim($members[$j])] = 1;
			}
		}
		else {
			$group_and_members[$group_names[$i]] = array();
		}
	}
	
	function addUserToGroup($user_group) {
		$user_group = (string)$user_group;
		echo gettype($user_group);
		echo $user_group."<br>";
		$group_user = preg_split("/[\s:]+/", $user_group);
		echo $group_user[0]." ".$group_user[1]." aaa<br>";
		echo "adding ".$user_group."<br>";
	}

	function deleteUserFromGroup($user_group) {
		$user_group = (string)$user_group;
		$group_user = explode(':', $user_group);
		echo "deleting ".$user_group;
	}
?>
<html>
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="node_modules/bootstrap/dist/css/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="node_modules/bootstrap/dist/css/bootstrap-theme.min.css" />
		<script src="node_modules/tether/dist/js/tether.min.js"></script>
		<script src="node_modules/jquery/dist/jquery.min.js"></script>
		<script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
		<script src="node_modules/jquery/external/jquery.redirect.js"></script>
		<link rel="stylesheet" type="text/css" href="style.css" />
	</head>
	<body>
		<div class="jumbotron">
			<div class="container">
				<h1>Groups & Members</h1>
			</div>
		</div>
		<div>
			<div class="row">
				
			</div>
			<div class="container">
				<div class="row">
					<div class="col-md-3">
						<ul class="nav navbar-inverse nav-tabs nav-stacked" role="tab-list">
							<?php
								for($i = 0; $i < $group_names_count; $i++) {
									echo "<li role='presentation'><a id='group-".$group_names[$i]."' href='#".$group_names[$i]."' onclick='addEditDeleteGroupOption(id)' aria-controls='profile' role='tab' data-toggle='tab'>".$group_names[$i]."</a></li>";
								}
							?>
						</ul>
						<a class='btn btn-lg btn-primary btn-block' href='create_group.php' style='margin-top: 5px'>
							<span class='glyphicon glyphicon-plus'></span> Create new group
						</a>
					</div>
					<div class="col-md-9">
						<div class="tab-content">
							<?php
								for($i = 0; $i < $group_names_count; $i++) {
									echo "<div role='tabpanel' class='tab-pane' id='".$group_names[$i]."'>";
									echo "<ul class='nav navbar nav-stacked'>";									
									for($j = 0; $j < $all_users_count; $j++) {
										$exist = isset($group_and_members[$group_names[$i]][$all_users[$j]]);										
										//echo $exist." ".$group_names[$i]." ".$all_users[$j]." ".$group_and_members[]." ".$i." ".$j."<br>";
										echo "<li role='presentation'><a href='#' id='".$group_names[$i]."-".$all_users[$j]."' onclick='".($exist == 1 ? "deleteFromGroup(id)" : "addToGroup(id)")."'>".$all_users[$j]."<span class='pull-right ".($exist == 1 ? "glyphicon glyphicon-minus text-danger" : "glyphicon glyphicon-plus text-primary")."'></span><li>";
									}
									echo "</ul>";
									echo "</div>";
								}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script>
			function addToGroup(id) {
				$.ajax({
					type: 'POST',
					url: 'action.php',
					data: {
						'add': ' ',
						'info': id
					},
					success: function(msg) {
						$("#" + id + " span").removeClass("glyphicon glyphicon-plus text-primary");
						$("#" + id + " span").addClass("glyphicon glyphicon-minus text-danger");
						$("#" + id).attr("onclick", "deleteFromGroup(id)");
					}
				});
			}
			
			function deleteFromGroup(id) {
				$.ajax({
					type: 'POST',
					url: 'action.php',
					data: {
						'delete': ' ',
						'info': id
					},
					success: function(msg) {
						$("#" + id + " span").removeClass("glyphicon glyphicon-minus text-danger");
						$("#" + id + " span").addClass("glyphicon glyphicon-plus text-primary");
						$("#" + id).attr("onclick", "addToGroup(id)");
					}
				});
			}
			
			function addEditDeleteGroupOption(id) {
				var groupName = id.split("-")[1];
				$(".group-option").remove();
				$("#" + id).append("<div class='group-option btn-group pull-right'><button class='traverse' onclick='editThisGroup(\"" + groupName + "\")'><span class=' glyphicon glyphicon-edit text-primary'></span></button><button class='traverse' onclick='deleteThisGroup(\"" + groupName + "\")'><span class=' glyphicon glyphicon-minus text-danger'></span></button></div>");           
			}
			
			function deleteThisGroup(group) {
				$.ajax( {
					type: 'POST',
					url: 'delete.php',
					data: {
						'group_name': group
					},
					success: function(msg) {
						$("#group-" + group).remove();
						$("#" + group).remove();
					}
				});
			}

			function editThisGroup(group) {
				$.redirect('edit_group.php', {'group': group});
			}
		</script>
	</body>
</html>
