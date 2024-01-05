<?php 

//include_once("includes/employee.php");

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RicoPizza</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	<link href="styles/custom.css" rel="stylesheet">
	<script src="includes/js.js"></script>
  </head>
  <body>
   
   <div class="container">
    <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
      <a href="/finalproject/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
        <img src="images/favicon.png" style="max-height: 40px;">
        <span class="fs-4">RicoPizza</span>
      </a>

      <ul class="nav nav-pills">
        <li class="nav-item"><a href="#" class="nav-link active" aria-current="page">Home</a></li>
        <li class="nav-item"><a href="cart.php" class="nav-link">Cart</a></li>
		<?php
		
			//session_start();
			
			include_once("includes/pizza.php");
			include_once("includes/topping.php"); 
		
			if(isset($_SESSION["loggedInEmployee"])){
				
				echo '<li class="nav-item"><a href="login.php" class="nav-link">Dashboard</a></li>';
				echo '<li class="nav-item"><a href="logout.php" class="nav-link">Logout</a></li>';
				
			}
			
			else {
				
				echo '<li class="nav-item"><a href="login.php" class="nav-link">Employee</a></li>';
				
			}
		
		?>
        
      </ul>
    </header>
  </div>