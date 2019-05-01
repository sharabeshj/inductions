<?php
ob_start();
session_start();

function logged_in_session() {
	if(isset($_SESSION['SPIDERTRONIX_USER_ID']) && !empty($_SESSION['SPIDERTRONIX_USER_ID'])) {
		return true;
	}
	else {
		return false;
	}
}

function grab_data($head) {
	require 'database.php';
	$sql = "SELECT $head FROM user_basic_data WHERE ID='".$_SESSION['SPIDERTRONIX_USER_ID']."'";
	if($result = $connection->query($sql)) {
		$row=$result->fetch_array();
		if($query_output=$row[$head]) {
			return $query_output;
		}
	}
}

?>