<?php

include_once("header.php");
include_once("functions.php");
?>

<div class="container">

	<div class="col-md-12">

		<h1 style="">Welcome to RicoPizza!</h1>

	</div>
		
	<form name="build_pizza_form" method="POST" action="add_to_cart.php">
	
	<div class="row">
			
		<div class="col-md-4">
		
			<h3>Select Quantity, Crust and Size</h3>
			
			<select name="quantity" id="quantity" onclick="updateSelectedToppings()" required>
			
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
			
			</option>
			
			</select>
			
			<?php
			
			getCrustList();

			getSizes();
			
			?>
		
		</div>
		
		<div class="col-md-4">
		
			<h3>Select Toppings</h3>
			
			<?php
			
			getToppings();
			
			?>
		
		</div>
		
		<div class="col-md-4">
		
			<h3>Review</h3>
			
			<ul>
			
				<li>Selected Quantity: <span id="selectedQuantity"></span></li>
			
				<li>Selected Crust: <span id="selectedCrust"></span></li>
				
				<li>Selected Size: <span id="selectedSize"></span></li>
				
				<li>Selected Toppings:  <ul>
										<span id="selectedToppings"></span>
										</ul>
				</li>
				
				<li>Subtotal: <span id="selectedSubtotal">$0.00</span></li>
			
			</ul>
			
			<input type="submit" name="btnBuyNow" value="Buy Now">
			
			or
			
			<input type="submit" name="btnAddToCart" value="Add to Cart">
			
			<span id="result"></span>
			
			<?php
			
				if(isset($_GET["msg"])){
					
					echo '<div class="alert alert-success" role="alert">'.$_GET["msg"].'</div>';
					
				}
			
			?>
		
		</div>
			
	</div>
	
	</form>

</div>

<?php
include_once("footer.php");

?>