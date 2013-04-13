<?php
	require_once '../../include/db_functions.php';
	
	$connection = dbConnect();
	if($_REQUEST['name']=='uname'){
		$uname = $_REQUEST['value'];
		$query = "select * from user where username='$uname'";
		$result = mysql_query($query,$connection);
		if(mysql_num_rows($result) == 1){
			echo json_encode(array(
				"value" => $_REQUEST['value'],
				"valid" => 0,
				"message" => 'username already taken'
			));
		}
	}
	connectionClose($connection);