<?php
include_once("includes/pizza.php");
include_once("header.php");
include_once("functions.php");

include_once("includes/topping.php"); 
session_start();
?>

<div class="container">

	<div class="col-md-12">

		<h1 style="">Cart</h1>

	</div>
		
	<form name="build_pizza_form" method="POST" action="order_confirmation.php">
	
	<div class="row">
	
		<div class="col-md-6">
		
			<h3>Review</h3>
		
			<?php
			
				showCart();
			
			?>
		
		</div>
		
		<div class="col-md-6">
		
			<h3>Payment Information</h3>
			
			<?php
			
				if(isset($_GET["msg"])){
					
					echo '<div class="alert alert-danger" role="alert">'.$_GET["msg"].'</div>';
					
				}
			
			?>
			
			<form name="payOrder" method="post">
			
				<label for="payment">How would you like to pay?</label>
			
				<select name="payment" id="payment" required>
					<option value="" <?= (!isset($_GET['payment'])) ? 'selected' : ''; ?>></option>
					<option value="PayPal" <?= (isset($_GET['payment']) && $_GET['payment'] === 'PayPal') ? 'selected' : ''; ?>>PayPal</option>
					<option value="COD" <?= (isset($_GET['payment']) && $_GET['payment'] === 'COD') ? 'selected' : ''; ?>>Cash on Delivery</option>
				</select>

				<!-- Select for Delivery -->
				<label for="delivery">How would you like to receive your order?</label>
				<select name="delivery" id="delivery" required>
					<option value="" <?= (!isset($_GET['delivery'])) ? 'selected' : ''; ?>></option>
					<option value="HD" <?= (isset($_GET['delivery']) && $_GET['delivery'] === 'HD') ? 'selected' : ''; ?>>Home Delivery</option>
					<option value="PU" <?= (isset($_GET['delivery']) && $_GET['delivery'] === 'PU') ? 'selected' : ''; ?>>Pick Up</option>
				</select><br>
				
				<label for="fName">First Name:</label>
				
				<input type="text" name="fName" id="fName" value="<?= isset($_GET["fName"]) ? $_GET["fName"] : '' ?>" required><br>
				
				<label for="lName">Last Name:</label>
				
				<input type="text" name="lName" id="lName" value="<?= isset($_GET["lName"]) ? $_GET["lName"] : '' ?>" required><br>
				
				<label for="phone">Phone Number:</label>
				
				<input type="tel" name="phone" id="phone" value="<?= isset($_GET["phone"]) ? $_GET["phone"] : '' ?>" required><br>
				
				<label for="email">Email Addres:</label>
				
				<input type="email" name="email" id="email" value="<?= isset($_GET["email"]) ? $_GET["email"] : '' ?>" required><br>
				
				<label for="houseNumber">House Number:</label>
				
				<input type="text" name="houseNumber" id="houseNumber" value="<?= isset($_GET["houseNumber"]) ? $_GET["houseNumber"] : '' ?>" required><br>
				
				<label for="street">Street:</label>
				
				<input type="text" name="street" id="street" value="<?= isset($_GET["street"]) ? $_GET["street"] : '' ?>" required><br>
				
				<label for="province">Province:</label>
				
				<input type="text" name="province" id="province" value="<?= isset($_GET["province"]) ? $_GET["province"] : '' ?>" required><br>
				
				<label for="postalCode">Postal Code:</label>
				
				<input type="text" name="postalCode" id="postalCode" value="<?= isset($_GET["postalCode"]) ? $_GET["postalCode"] : '' ?>" required><br>
				
				<input type="submit" name="btnPlaceOrder" value="Place Order">
			
			</form>
		
		</div>
						
	</div>
	
	</form>

</div>

<?php
include_once("footer.php");

?>