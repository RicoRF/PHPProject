<?php

include_once("includes/conn.php");
include_once("includes/pizza.php");
include_once("includes/topping.php"); 

function getCrustList(){
	
	// Initialize cURL session
	$ch = curl_init();

	// Set cURL options
	curl_setopt($ch, CURLOPT_URL, 'http://localhost/finalproject/api/crust.php'); // Specify the URL
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // Return the response instead of outputting it

	// Execute cURL session and fetch the response
	$response = curl_exec($ch);

	// Check for cURL errors
	if (curl_errno($ch)) {
		echo 'Curl error: ' . curl_error($ch);
	}

	// Close cURL session
	curl_close($ch);

	// Output the response
	
	$decoded = json_decode($response, true);
	
	if($decoded == null){
		
		echo 'There are no crusts to select.';
		
	}
	
	else {
	
		echo '<select name="crust" onclick="updateSelectedCrust()" id="crustSelect" required>';
		echo '<option></option>';
		foreach ($decoded as $crust) {
			
			echo '<option value="' . $crust['crustName'] . '">' . $crust['crustName'] . '</option>';
		
		}
		
		echo '</select>';
		
	}
	
}

function getToppings(){
	
	// Initialize cURL session
	$ch = curl_init();

	// Set cURL options
	curl_setopt($ch, CURLOPT_URL, 'http://localhost/finalproject/api/toppings.php'); // Specify the URL
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // Return the response instead of outputting it

	// Execute cURL session and fetch the response
	$response = curl_exec($ch);

	// Check for cURL errors
	if (curl_errno($ch)) {
		echo 'Curl error: ' . curl_error($ch);
	}

	// Close cURL session
	curl_close($ch);

	// Output the response
	
	$decoded = json_decode($response, true);
	
	if($decoded == null){
		
		echo 'There are no toppings to select.';
		
	}
	
	else {
	
		echo '<fieldset>';
		
        //following foreach is from chatGPT
		
        foreach ($decoded as $topping) {
            $isActive = ($topping['isToppingActive'] == 1) ? '' : 'disabled';
            echo '<input type="checkbox"name="toppings[]" id="'.$topping['toppingID'].'" value="' . $topping['toppingID'] . '" ' . $isActive . ' onchange="updateSelectedToppings()">';
            echo '<label for="'.$topping['toppingID'].'">'.$topping['toppingName'] . ' - $' . $topping['toppingPrice'] . '</label><br>';
        }
        
        echo '</fieldset>';
		
	}
	
}

function getSizes(){
	
	// Initialize cURL session
	$ch = curl_init();

	// Set cURL options
	curl_setopt($ch, CURLOPT_URL, 'http://localhost/finalproject/api/sizes.php'); // Specify the URL
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // Return the response instead of outputting it

	// Execute cURL session and fetch the response
	$response = curl_exec($ch);

	// Check for cURL errors
	if (curl_errno($ch)) {
		echo 'Curl error: ' . curl_error($ch);
	}

	// Close cURL session
	curl_close($ch);

	// Output the response
	
	$decoded = json_decode($response, true);
	
	if($decoded == null){
		
		echo 'There are no sizes to select.';
		
	}
	
	else {
	
		echo '<select name="size" onclick="updateSelectedSize()" id="sizeSelect" required>';
		echo '<option></option>';
		foreach ($decoded as $size) {
			
			echo '<option value="' . $size['sizeName'] . '">' . $size['sizeName'] . '</option>';
		
		}
		
		echo '</select>';
		
	}
	
}

function showCart(){
    if (isset($_SESSION["PizzasAddedToCart"]) && is_array($_SESSION["PizzasAddedToCart"])) {

        echo '<table border="1">';
        echo '<tr><th>Crust</th><th>Size</th><th>Toppings</th><th>Quantity</th><th>Price</th></tr>';

		$subtotal = 0;
		$tax = 15;
	
        foreach ($_SESSION["PizzasAddedToCart"] as $pizzaDetails) {
            
			//print_r($_SESSION["PizzasAddedToCart"]);
			
            if (is_a($pizzaDetails, 'Pizza')) {
				$subtotal = $subtotal + $pizzaDetails->getPrice();
                echo '<tr>';
                echo '<td>' . $pizzaDetails->getCrustType() . '</td>';
                echo '<td>' . $pizzaDetails->getSize() . '</td>';
                echo '<td>' . $pizzaDetails->getToppings() . '</td>';
				echo '<td>' . $pizzaDetails->getQuantity() . '</td>';
				echo '<td>' . $pizzaDetails->getPrice() . '</td>';
                echo '</tr>';
            } else {
                echo '<tr><td colspan="3">Invalid pizza data</td></tr>';
            }
									
        }
		
		echo '<tr>
			
				<td></td>
				<td></td>
				<td></td>
				<td><b>Subtotal:</b></td>
				<td>'.$subtotal.'</td>
			
			</tr>';
			
		echo '<tr>
		
			<td></td>
			<td></td>
			<td></td>
			<td><b>Tax:</b></td>
			<td>'.$tax.'%</td>
		
		</tr>';
		
		echo '<tr>
		
			<td></td>
			<td></td>
			<td></td>
			<td><b>Total:</b></td>
			<td>'.number_format(($subtotal + ($subtotal * $tax / 100)), 2, '.', '').'</td>
		
		</tr>';
		
		$_SESSION["total_price"] = number_format(($subtotal + ($subtotal * $tax / 100)), 2, '.', '');

        echo '</table>';
    } else {
        echo 'There are no items in the cart.';
    }
}

function addToCart($conn){
	
		$price = 0;
		$toppingsName = "";
		
		$toppings = isset($_POST["toppings"]) ? $_POST["toppings"] : array();

		// Iterate through each topping and perform some action
		foreach ($toppings as $topping) {
			
			$value = Topping::getToppingById($conn, $topping);
			
			$price = $price + $value->getPrice();
			$toppingsName = $toppingsName.', '.$value->getName();
			
		}
		
		
		
		
		$firstCommaPosition = strpos($toppingsName, ',');

		if ($firstCommaPosition !== false) {
			$toppingsName = substr_replace($toppingsName, '', $firstCommaPosition, 1);
		}

		$newPizza = new Pizza($_POST["crust"], 0, $_POST["size"], $price,$toppingsName, $_POST["quantity"] );

		//print_r($newPizza);
		
        // Session is set, add values to the existing array
        $pizzaDetails = $newPizza;
				
        // Add the pizza details to the existing array
		
        $_SESSION["PizzasAddedToCart"][] = $pizzaDetails;
		//echo '<br>';
		//print_r($_SESSION["PizzasAddedToCart"]);
		
    
	
}

function buyNow($conn){
	
	/*if (isset($_SESSION["PizzasAddedToCart"])) {*/

		$_SESSION["PizzasAddedToCart"] = null;

		$price = 0;
		$toppingsName = "";
		
		$toppings = isset($_POST["toppings"]) ? $_POST["toppings"] : array();

		// Iterate through each topping and perform some action
		foreach ($toppings as $topping) {
			
			$value = Topping::getToppingById($conn, $topping);
			$price = $price + $value->getPrice();
			$toppingsName = $toppingsName.', '.$value->getName();
			
		}
		
		
		$firstCommaPosition = strpos($toppingsName, ',');

		if ($firstCommaPosition !== false) {
			$toppingsName = substr_replace($toppingsName, '', $firstCommaPosition, 1);
		}


		$newPizza = new Pizza($_POST["crust"], 0, $_POST["size"], $price,$toppingsName, $_POST["quantity"] );

        // Session is set, add values to the existing array
        $pizzaDetails = $newPizza;
				
        // Add the pizza details to the existing array
        $_SESSION["PizzasAddedToCart"][] = $pizzaDetails;
		

    /*} else {

		$_SESSION["PizzasAddedToCart"] = null;

        $price = 0;
		$toppingsName = "";
		
		$toppings = isset($_POST["toppings"]) ? $_POST["toppings"] : array();

		// Iterate through each topping and perform some action
		foreach ($toppings as $topping) {
			
			$value = Topping::getToppingById($conn, $topping);
			$price = $price + $value->getPrice();
			$toppingsName = $toppingsName.', '.$value->getName();
			
		}
		
		
		$firstCommaPosition = strpos($toppingsName, ',');

		if ($firstCommaPosition !== false) {
			$toppingsName = substr_replace($toppingsName, '', $firstCommaPosition, 1);
		}


		$newPizza = new Pizza($_POST["crust"], 0, $_POST["size"], $price,$toppingsName, $_POST["quantity"] );

        // Session is set, add values to the existing array
        $pizzaDetails = $newPizza;
				
        // Add the pizza details to the existing array
        $_SESSION["PizzasAddedToCart"][] = $pizzaDetails;
				
    }*/
	
}

?>