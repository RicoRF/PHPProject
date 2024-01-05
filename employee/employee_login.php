<?php

	session_start();

	include_once("../includes/conn.php");

	include_once("../includes/employee.php");

	if(isset($_POST["btnLogin"])){
		
		$employee = new Employee($_POST["userName"], $_POST["password"]);
		if($employee->Login($conn)){
			
			$_SESSION["loggedInEmployee"] = $employee->getUserName();
			header("Location: ../login.php");
			die();
			
		}
		
		else {
			
			header("Location: ../login.php?msg=Error trying to login. Please try again.");
			die();
			
		}
		
	}

?>