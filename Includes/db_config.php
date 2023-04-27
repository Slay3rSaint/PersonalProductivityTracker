<?php
	// Create a new MySQLi object
	$conn = new mysqli("localhost", "root", "", "ppt");
	
	// Check for connection errors
	if(!$conn){
		die("Error: Cannot connect to the database");
	}
	#alternative
	// if ($mysqli->connect_errno) {
	// 	die("Failed to connect to MySQL: " . $mysqli->connect_error);
	// }
?>