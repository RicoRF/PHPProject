<?php

include_once("../includes/conn.php");

if($conn){
	
	$toppings = array();
	
	$sql = "SELECT * FROM toppings";
	
	$query = mysqli_query($conn, $sql);
	
	while($result = mysqli_fetch_array($query)){
		
		$topping = array(
		'toppingID' => $result["toppingId"],
		'toppingName' => $result["name"],
		'toppingPrice' => $result["price"],
		'isToppingActive' => $result["isActive"]
		);
	
		$toppings[] = $topping;
	
	}
	
	echo json_encode($toppings);
	
}

?>