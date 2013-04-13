<?php
	// databse abstraction functions + some databse utility functions
	require_once 'constants.php';
	
	function dbConnect() {
		$connection = mysql_connect(DB_SERVER, DB_USER, DB_PASS);
		if(!$connection){
			die(mysql_error());
		}

		$db = mysql_select_db(DB_NAME, $connection);
		if(!$db){
			die(mysql_error());
		}
		return $connection;
	}
	
	function getAllCities($connection){
		$query = "select * from city";
		$resultSet = mysql_query($query, $connection);
		confirmQuery($resultSet);
		return $resultSet;
	}
	
	function confirmQuery($result_set){
		if (!$result_set) {
			die("Database query failed: " . mysql_error());
		}
	}
	
	
	function connectionClose($connection){
		if(isset($connection)){
			mysql_close($connection);
			unset($connection);
		}
	}