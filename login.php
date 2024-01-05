<?php

include_once("header.php");
include_once("functions.php");
include_once("includes/employee.php");
include_once("includes/topping.php");
include_once("includes/conn.php");
session_start();
?>

<div class="container">

	<div class="col-md-12">

		<h1 style="">Welcome to RicoPizza!</h1>

	</div>
	
	<div class="row">
	
	
	
	<?php
	
		if(isset($_GET["msg"])) { echo $_GET["msg"]; }
	
		if(!isset($_SESSION["loggedInEmployee"])){
	
	?>
<div class="col-md-12">
			<form action="employee/employee_login.php" method="POST">
			<!--<img class="mb-4" src="../assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">-->
			<h1 class="h3 mb-3 fw-normal">Please sign in</h1>

			<div class="form-floating">
			  <input type="text" class="form-control" name="userName" id="floatingInput" placeholder="John">
			  <label for="floatingInput">Username</label>
			</div>
			<div class="form-floating">
			  <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="Password">
			  <label for="floatingPassword">Password</label>
			</div>
<br>
			<button class="btn btn-primary w-100 py-2" name="btnLogin" type="submit">Sign in</button>
			<br>
		   </form>
		   </div>
		   <?php
		   
		   }
		   
		   else {
			   
			   ?>
			   
				<div class="col-md-2">
				
					<h3>Manage Toppings</h3>
					
					<form name="addTopping" method="POST" action="includes/add_topping.php">
					
						<input type="text" name="name" placeholder="Add topping">
						<input type="text" name="price" placeholder="1.99">
						<select name="isActive">
						
						<option value="1">Active</option>
						<option value="0">Not Active</option>
						
						</select> <input type="submit" value="Add" name="btnAddTopping">
					
					</form>
					
					<?php Topping::getToppingsForEmployee($conn); ?>
				
				</div>
				
				<div class="col-md-6">
				
					<h3>Pending Orders</h3>
					
					<?php
					
						$sql_pending = "SELECT * FROM orders WHERE orderStatus = 0";
						
						$query_pending = mysqli_query($conn, $sql_pending);
						
									
							echo '<table border="1">
    <tr>
        <th>Order ID</th>
        <th>Delivery Date and Time</th>
        <th>Payment Method</th>
        <th>Delivery Method</th>
        <th>Action</th>
    </tr>';
						
						while($result_pending = mysqli_fetch_array($query_pending)){
				
				if($result_pending["payment_method"] == "COD"){
					
					$pm = "Cash on Delivery";
					
				}
				
				else {
					
					$pm = $result_pending["payment_method"];
					
				}
				
				if($result_pending["delivery_method"] == "HD"){
					
					$dl = "Home Delivery";
					
				}
				
				else {
					
					$dl = "Pick Up";
					
				}
				

echo '<tr>';
echo '<td>' . $result_pending["orderId"] . '</td>';
echo '<td>' . $result_pending["deliveryDateTime"] . '</td>';
echo '<td>' . $pm . '</td>';
echo '<td>' . $dl . '</td>';
echo '<td><a href="order_summary.php?id='.$result_pending["orderId"].'">View</a> <a href="complete_order.php?id=' . $result_pending["orderId"] . '">Complete</a></td>';
echo '</tr>';

							
						}
						
						
echo '</table>';

					
					?>
				
				</div>
				
				<div class="col-md-4">
				
					<h3>Completed Orders</h3>
					
					<?php
					
						$sql_completed = "SELECT * FROM orders WHERE orderStatus = 1";
						
						$query_completed = mysqli_query($conn, $sql_completed);
								
							echo '<table border="1">
								<tr>
									<th>Order ID</th>
									<th>Delivery Date and Time</th>
									<th>Payment Method</th>
									<th>Delivery Method</th>
									<th>Action</th>
								</tr>';
													
							while($result_completed = mysqli_fetch_array($query_completed)){

								echo '<tr>';
								echo '<td>' . $result_completed["orderId"] . '</td>';
								echo '<td>' . $result_completed["deliveryDateTime"] . '</td>';
								echo '<td>' . $result_completed["payment_method"] . '</td>';
								echo '<td>' . $result_completed["delivery_method"] . '</td>';
								echo '<td><a href="order_summary.php?id='.$result_completed["orderId"].'">View</a></td>';
								echo '</tr>';
														
							}		
													
							echo '</table>';
					
					?>
				
				</div>
			   
			   <?php
			   
		   }
		   
		   ?>
		
		
			
	</div>
	
	

</div>

<?php
include_once("footer.php");

?>