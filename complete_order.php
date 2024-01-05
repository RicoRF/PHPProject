<?php

session_start();
include_once("includes/order.php");
include_once("includes/conn.php");

	if(isset($_SESSION["loggedInEmployee"]) && isset($_GET["id"])){
		
		$sql = "UPDATE orders SET OrderStatus = 1 WHERE orderId = ".$_GET["id"]."";
		
		mysqli_query($conn, $sql);
		
		header("Location: login.php");
		
	}
	
	else {
		
		header("Location: index.php");
		
	}

?>