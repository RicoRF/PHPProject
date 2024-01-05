<?php

include_once("header.php");
include_once("functions.php");
include_once("includes/pizza.php");
include_once("includes/customer.php");
include_once("includes/order.php");
include_once("includes/conn.php");
//session_start();

?>

<?php

if(isset($_GET["id"])){
	
	$sql = "SELECT * FROM orders WHERE orderId = ".$_GET["id"]."";
	
	$query = mysqli_query($conn, $sql);
	
	if($query){
		
		$result = mysqli_fetch_assoc($query);
		
		$sql_customer = "SELECT * FROM customer WHERE customerid = ".$result["customerId"]."";
		
		$query_customer = mysqli_query($conn, $sql_customer);
		
		$customer_result = mysqli_fetch_assoc($query_customer);
		
		if($query_customer){
			
			$sql_pizzas = "SELECT * FROM pizza WHERE orderId = ".$result["orderId"]."";
			
			$query_pizzas = mysqli_query($conn, $sql_pizzas);
			
			if($query_pizzas){
				
				?>
				
				<div class="container">
				
					<div class="row">
					
						<div class="col-md-6">
						
							<h3>Customer</h3>
							
							<?php echo $customer_result["firstName"]." ".$customer_result["lastName"]."<br>".
										$customer_result["phoneNumber"]."<br>".$customer_result["email"]."<br>".
										$customer_result["houseNumber"]." ".$customer_result["street"]."<br>".
										$customer_result["province"]." ".$customer_result["postalCode"]
							;?>
						
						</div>
						
						<div class="col-md-6">
						
							<h3>Order</h3>
							Order status: 
							<?php
							
								if($result["orderStatus"] == 0){
									
									echo "Pending";
									
								}
								
								else {
									
									echo "Finished";
									
								}
							
							?>
							
							<?php
							
								echo '<table border="1">
										<tr>
											<th>Crust</th>
											<th>Size</th>
											<th>Toppings</th>
											<th>Price</th>
											<!--<th>Ready?</th>-->
										</tr>';
							
								while($result_pizzas = mysqli_fetch_array($query_pizzas)){
									
									$sql_size = "SELECT * FROM sizes WHERE sizeid = ".$result_pizzas["sizeId"]."";
									$query_size = mysqli_query($conn,$sql_size);
									$result_size = mysqli_fetch_assoc($query_size);
									
									$sql_crust = "SELECT * FROM crusttypes WHERE crustTypeId = ".$result_pizzas["crustTypeId"]."";
									$query_crust = mysqli_query($conn,$sql_crust);
									$result_crust = mysqli_fetch_assoc($query_crust);
									
									if($result_pizzas["isFinished"] == 0){
										
										$isFinished = "no";
										
									}
									
									else {
										
										$isFinished = "yes";
										
									}
																		
									echo '<tr>';
									echo '<td>' . $result_crust["name"] . '</td>';
									echo '<td>' . $result_size["name"] . '</td>';
									echo '<td>' . $result_pizzas["toppings"] . '</td>';
									echo '<td>' . $result_pizzas["price"] . '</td>';
									//echo '<td>' . $isFinished . '</td>';
									echo '</tr>';
									
								}
								
								echo '</table>';
							
							?>
							
							<h3>Payment Method</h3>
							
								<?php
								
									//$result_order = mysqli_fetch_assoc($query);
									
									if($result["payment_method"] == "COD"){
										
										echo 'Cash on Delivery';
										
									}
									
									else {
										
										echo '<a href="https://paypal.com/">PayPal - Click and Pay</a>';
										
									}
								
								?>
							
							<h3>Delivery Option</h3>
							
								<?php
								
									$originalDateTime = $result["deliveryDateTime"];

									// Extract date and time parts
									$datePart = date('Y-m-d', strtotime($originalDateTime));
									$timePart = date('H:i', strtotime($originalDateTime));
								
									if($result["delivery_method"] == "HD"){
										
										echo 'Home Delivery';
										
										echo '<br> Delivery Time: '.$timePart;
										
									}
									
									else {
										
										echo 'Pickup Time: ';
										
										

echo $timePart = date('H:i', strtotime($originalDateTime));

echo '<form name="delivery_time" action="change_time.php" method="POST">
	<input type="hidden" name="orderId" value="'.$_GET["id"].'">
    <input type="hidden" name="datePU" value="' . $datePart . '">
    <input type="time" name="timePU" value="' . $timePart . '"> 
    <input type="submit" name="changeTime" value="Change">
</form>';

										
									}
								
								?>
						
						</div>
					
					</div>
				
				</div>
				
				<?php
				
			}
			
			else {
				
				header("Location: cart.php?msg=Error retrieving order");
				
			}
			
		}
		
		else {
			
				header("Location: cart.php?msg=Error retrieving order");
						
		}
		
	}
	
	else {
	
			header("Location: cart.php?msg=Error retrieving order");
		
	}
	
}

else {
	
	header("Location: cart.php");
	
}

?>

<?php

include_once("footer.php");

?>