<?php
include_once("includes/pizza.php");
session_start();

include_once("includes/topping.php");
include_once("includes/conn.php");
include_once("functions.php");

if (isset($_POST["btnAddToCart"])) {

    addToCart($conn);
	
	header("Location: /finalproject/?msg=Pizza added to the cart successfully");
	die();
}

if (isset($_POST["btnBuyNow"])) {

    buyNow($conn);
	
	header("Location: cart.php");
	die();
}

?>
