<?php
	session_start();
	require_once('../models/data_access_helper.php');

	// Create an instance of data access helper
	$db = new DataAccessHelper();

	// Connect to database
	$db->connect();

	if(isset($_GET["sdt"]) && isset($_GET["fb"])){
		$sdt = $_GET["sdt"];
		$fb = $_GET["fb"];

		$sql = "UPDATE user SET LinkFB = '". $fb ."' WHERE SDT = '". $sdt . "';";
		$check = $db->executeNonQuery($sql);

		if($check == true) echo "1";
		else echo "0";
	}

	$db->close();
?>