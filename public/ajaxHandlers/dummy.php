<?php
	require_once '../../include/constants.php';
	$conn = mysql_connect(DB_SERVER, DB_USER, DB_PASS);
	if(!$conn){
		die(mysql_error());
	}
	
	$db = mysql_select_db(DB_NAME, $conn);
	if(!$db){
		die(mysql_error());
	}
	
	if(isset($_GET['city_name']) && trim($_GET['city_name']!='')){
		$city_name = trim($_GET['city_name']);
		$query = "select city_id from city where city_name='{$city_name}'";
		$result = mysql_query($query, $conn);
		while ($row = mysql_fetch_array($result)){
			$city_id = $row['city_id'];
		}
		$query = "select locality_name from locality where city_id='{$city_id}'";
		$result = mysql_query($query, $conn);
		$localities = array();
		while($row = mysql_fetch_array($result)){
			$localities [] = $row['locality_name'];
		}
		
		//echo result
		echo json_encode(array("localities"=>$localities));
	}
	
	//close connection
	mysql_close($conn);