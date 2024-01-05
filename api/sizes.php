<?php

include_once("../includes/conn.php");

if($conn){
	
	$sizes = array();
	
	$sql = "SELECT * FROM sizes";
	
	$query = mysqli_query($conn, $sql);
	
	while($result = mysqli_fetch_array($query)){
		
		$size = array(
		'sizeID' => $result["sizeid"],
		'sizeName' => $result["name"]
		);
	
		$sizes[] = $size;
	
	}
	
	echo json_encode($sizes);
	
}

?>