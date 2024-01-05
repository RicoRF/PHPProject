<?php

session_start();
include_once("topping.php");
include_once("conn.php");
include_once("employee.php");

	if(isset($_SESSION["loggedInEmployee"]) && isset($_POST["btnAddTopping"])){
		
		$topping = new Topping($_POST["name"], $_POST["price"], $_POST["isActive"]);
						
		$topping->AddTopping($conn, Employee::getId($_SESSION["loggedInEmployee"],$conn));
		
		header("Location: ../login.php");
		
	}
	
	else {
		
		//header("Location: index.php");
		
	}

?>