<?php

session_start();
include_once("topping.php");
include_once("conn.php");
include_once("employee.php");

	if(isset($_SESSION["loggedInEmployee"]) && isset($_GET["id"])){
		
		$sql = "UPDATE toppings SET isActive = 1 WHERE toppingId = ".$_GET["id"]."";
		
		mysqli_query($conn, $sql);
		
		header("Location: ../login.php");
		
	}
	
	else {
		
		header("Location: index.php");
		
	}

?>