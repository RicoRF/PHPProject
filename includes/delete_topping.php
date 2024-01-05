<?php

session_start();

	if(isset($_SESSION["loggedInEmployee"]) && isset($_GET["id"])){
		
		$sql = "DELETE from toppings WHERE toppingId = ".$_GET["id"]."";
		
		include_once("conn.php");
		
		mysqli_query($conn, $sql);
		
		header("Location: ../login.php");
		
	}
	
	else {
		
		header("Location: index.php");
		
	}

?>