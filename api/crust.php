<?php

include_once("../includes/conn.php");

if($conn){
	
	$crusts = array();
	
	$sql = "SELECT * FROM crusttypes";
	
	$query = mysqli_query($conn, $sql);
	
	while($result = mysqli_fetch_array($query)){
		
		$crust = array('crustID' => $result["crustTypeId"],
		'crustName' => $result["name"]);
	
		$crusts[] = $crust;
	
	}
	
	echo json_encode($crusts);
	
}

?>