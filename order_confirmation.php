<?php

include_once("header.php");
include_once("functions.php");
include_once("includes/pizza.php");
include_once("includes/customer.php");
include_once("includes/order.php");
include_once("includes/conn.php");
session_start();

?>

<?php

if(isset($_POST["btnPlaceOrder"])){
	
	$fName = htmlspecialchars($_POST["fName"]);
	$lName = htmlspecialchars($_POST["lName"]);
	$phone = htmlspecialchars($_POST["phone"]);
	$email = htmlspecialchars($_POST["email"]);
	$houseNumber = htmlspecialchars($_POST["houseNumber"]);
	$street = htmlspecialchars($_POST["street"]);
	$province = htmlspecialchars($_POST["province"]);
	$postalCode = htmlspecialchars($_POST["postalCode"]);
	
	$payment = htmlspecialchars($_POST["payment"]);
	$delivery = htmlspecialchars($_POST["delivery"]);
	
	$isValid = true;
	$error_message = "";
	
	 // Validation done with chatGPT
    if (!preg_match('/^[a-zA-Z\s\'-]{2,}$/', $fName)) {
        $isValid = false;
        $error_message .= "Invalid first name. <br>";
    }
    if (!preg_match('/^[a-zA-Z\s\'-]{2,}$/', $lName)) {
        $isValid = false;
        $error_message .= "Invalid last name. <br>";
    }
    if (!preg_match('/^\(?\d{3}\)?[-.\s]?\d{3}[-.\s]?\d{4}$/', $phone)) {
        $isValid = false;
        $error_message .= "Invalid phone number. <br>";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $isValid = false;
        $error_message .= "Invalid email address. <br>";
    }
    if (!is_numeric($houseNumber)) {
        $isValid = false;
        $error_message .= "Invalid house number. <br>";
    }
    if (!preg_match('/^[a-zA-Z0-9\s\'-]{2,}$/', $street)) {
        $isValid = false;
        $error_message .= "Invalid street name. <br>";
    }
    if (!preg_match('/^[a-zA-Z\s\'-]{2,}$/', $province)) {
        $isValid = false;
        $error_message .= "Invalid province. <br>";
    }
    if (!preg_match('/^[A-Za-z]\d[A-Za-z][ -]?\d[A-Za-z]\d$/', $postalCode)) {
        $isValid = false;
        $error_message .= "Invalid postal code. <br>";
    }

    // Check validation status
    if ($isValid) {
        // All input is valid
        // Continue with processing the order
		
		//Get everything and process order
		
		$mmName = $fName.$lName;
		
		$customer = new Customer($fName, $lName, $phone, $email, $houseNumber, $street, $province, $postalCode, $mmName);
		
		$addCustomer = $customer->InsertCustomer($conn);
		
		if(!$addCustomer){
			
			header("Location: cart.php?msg=Error adding customer");
	
		}
			
		else {
				
			date_default_timezone_set('America/Halifax');
			$currentDateTime = new DateTime(date('Y-m-d H:i:s'));
			$modifiedDateTimeString = $currentDateTime->modify('+30 minutes')->format('Y-m-d H:i:s');

			//echo $_SESSION["total_price"];
			$order = new Order($_SESSION["total_price"], 0, $modifiedDateTimeString, $payment, $delivery);
			
			$addOrder = $order->AddOrder($conn, $customer->getId());
			
			if(!$addOrder){
				
				header("Location: cart.php?msg=Error adding order");
				
			}
			
			else {

				foreach ($_SESSION["PizzasAddedToCart"] as $pizzaDetails) {
								
					if (is_a($pizzaDetails, 'Pizza')) {
						
						$pizza = new Pizza($pizzaDetails->getCrustType(), 0, $pizzaDetails-> getSize(), $pizzaDetails->getPrice(), $pizzaDetails->getToppings() ,$pizzaDetails->getQuantity());
												
						if($pizzaDetails->getQuantity() == 1){
							
							$addPizza = $pizza->AddPizzaToOrder($conn, $order->getId());
							
						}
						
						else {
							
							$i = 1;
							
							while($pizzaDetails->getQuantity() > $i){
								$addPizza = $pizza->AddPizzaToOrder($conn, $order->getId());
								$i++;
							}
									
						}
																			
						
						
						if(!$addPizza){
							
							header("Location: cart.php?msg=Error adding pizzas");
							die();
							
						}
											
					}
				
				}
				
				session_destroy();
				
				header("Location: order_summary.php?id=".$order->getId()."");

			}
	
		}
	
	}
	
	else {
        // Redirect with error message
        $redirectUrl = "cart.php?msg=" . urlencode($error_message) .
        "&fName=" . urlencode($fName) .
        "&lName=" . urlencode($lName) .
        "&phone=" . urlencode($phone) .
        "&email=" . urlencode($email) .
        "&houseNumber=" . urlencode($houseNumber) .
        "&street=" . urlencode($street) .
        "&province=" . urlencode($province) .
        "&postalCode=" . urlencode($postalCode) .
		"&delivery=" .urlencode($delivery) .
		"&payment=" .urlencode($payment);

    header("Location: $redirectUrl");
        exit();
    }
	
}

else {
	
	header("Location: cart.php");
	
}

?>

<?php

include_once("footer.php");

?>