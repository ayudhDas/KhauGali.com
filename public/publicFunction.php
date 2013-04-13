<?php
	require_once '../include/util_functions.php';
	require_once '../include/db_functions.php';
	
	function showAuth(){
			if(!chkLogin()){
				echo '<div id="auth" class="span6">';
				echo '<a class="pull-right btn btn-success btnauth" href="signup.php">sign up</a>';
				echo '<a class="pull-right btn btn-success btnauth" href="login.php">log in</a>';
				echo '</div>';
			}
			else{
				echo '<div id="auth" class="span6" style="padding-left: 20%;padding-top: 25px;">';
				echo '<a href="profile.php"><i class="icon-user"></i></a>';
				echo $_SESSION['username'];
				//echo '<a href="logout.php"><button class="btn "><i class="icon-arrow-down"></i></button></a>';
				echo '<div class="dropdown">';
				echo '<a class="dropdown-toggle" data-toggle="dropdown" data-target="#" href=""><button class="btn "><i class="icon-arrow-down"></i></button></a>';
				echo '<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">';
				echo '<li role="presentation"><a role="menuitem" tabindex="-1" href="profile.php">Profile</a></li>';
				echo '<li role="presentation"><a role="menuitem" tabindex="-1" href="editprofile.php">Edit Profile</a></li>';
				echo '<li role="presentation"><a role="menuitem" tabindex="-1" href="changePassword.php">Change Password</a></li>';
				echo '<li role="presentation" class="divider"></li>';
				echo '<li role="presentation"><a role="menuitem" tabindex="-1" href="logout.php">Logout</a></li>';
				echo '</ul>';
				echo '</div>';
				echo '</div>';
			}
	}
	
	function getAvgRating($resid, $connection){
		$query = "select * from rating where rest_id=$resid";
		$res = mysql_query($query, $connection);
		confirmQuery($res);
		$count = 0;
		$total = 0;
		if(mysql_num_rows($res) == 0){
			return 0;
		}
		while($row = mysql_fetch_array($res)){
			$total =  $total + ($row['taste'] + $row['ambience'] + $row['value_for_money'] + $row['service'] + $row['hygiene'])/5.0;
			$count++;
		}
		return ceil($total / $count);
	}
	
	function getUserAvgRating($uname, $resid, $connection){
		$query = "select * from rating where rest_id=$resid and username='$uname'";
		$res = mysql_query($query, $connection);
		confirmQuery($res);
		if(mysql_num_rows($res) == 0){
			return 0;
		}
		while($row = mysql_fetch_array($res)){
			$total = ($row['taste'] + $row['ambience'] + $row['value_for_money'] + $row['service'] + $row['hygiene'])/5.0;
		}
		return ceil($total);
	}