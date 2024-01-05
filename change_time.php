<?php

	if(isset($_POST["changeTime"])){

		include_once("includes/conn.php");
	
		$orderID = $_POST["orderId"];
		$newTime = $_POST["timePU"];
		
		$sql = "SELECT * FROM orders WHERE orderId = ".$orderID."";
		$query = mysqli_query($conn, $sql);
		
		$result = mysqli_fetch_assoc($query);
		
		$currentTime = $result["deliveryDateTime"];
		
		$newTime = $_POST["datePU"] ." ".$newTime.":00";
		
		$sql_update = "UPDATE orders SET deliveryDateTime = '".$newTime."' WHERE orderId = ".$orderID."";
		
		mysqli_query($conn, $sql_update);
		
	}
	
	header("Location: order_summary.php?id=".$orderID."");

?>