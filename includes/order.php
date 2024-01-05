<?php

class Order {
    private $totalPrice;
    private $orderStatus;
    private $deliveryDateTime;
    private $placeDateTime;
	private $payment_method;
	private $delivery_method;
	private $id;

    /*public function __construct($totalPrice, $orderStatus, $deliveryDateTime, $placeDateTime, $payment_method, $delivery_method) {
        $this->totalPrice = $totalPrice;
        $this->orderStatus = $orderStatus;
        $this->deliveryDateTime = new DateTime($deliveryDateTime); // Assuming $deliveryDateTime is a valid date/time string
        $this->placeDateTime = new DateTime($placeDateTime); // Assuming $placeDateTime is a valid date/time string
		$this->payment_method = $payment_method;
		$this->delivery_method = $delivery_method;
    }*/
	
	public function __construct($totalPrice, $orderStatus, $deliveryDateTime, $payment_method, $delivery_method) {
        $this->totalPrice = $totalPrice;
        $this->orderStatus = $orderStatus;
        $this->deliveryDateTime = $deliveryDateTime;
		$this->payment_method = $payment_method;
		$this->delivery_method = $delivery_method;
    }

    // Getter methods
    public function getTotalPrice() {
        return $this->totalPrice;
    }
	
	public function getId() {
        return $this->id;
    }

    public function getOrderStatus() {
        return $this->orderStatus;
    }

    public function getDeliveryDateTime() {
        return $this->deliveryDateTime;
    }

    public function getPlaceDateTime() {
        return $this->placeDateTime;
    }
	
	public function getPaymentMethod() {
        return $this->payment_method;
    }

    public function getDeliveryMethod() {
        return $this->delivery_method;
    }

    // Setter methods
    public function setTotalPrice($totalPrice) {
        $this->totalPrice = $totalPrice;
    }

    public function setOrderStatus($orderStatus) {
        $this->orderStatus = $orderStatus;
    }

    public function setDeliveryDateTime($deliveryDateTime) {
        $this->deliveryDateTime = $deliveryDateTime;
    }

    public function setPlaceDateTime($placeDateTime) {
        $this->placeDateTime = new DateTime($placeDateTime);
    }
	
	public function setPaymentMethod($paymentMethod) {
        $this->payment_method = $paymentMethod;
    }

    public function setDeliveryMethod($deliveryMethod) {
        $this->delivery_method = $deliveryMethod;
    }
	
	public function setId($id) {
        $this->id = $id;
    }
	
	public function addOrder($con, $customerId){
		//echo $this->deliveryDateTime;
		$sql = "INSERT INTO `orders`(`totalPrice`, `deliveryDateTime`, `customerId`, `orderStatus`, `payment_method`, `delivery_method`)
		VALUES ('".$this->totalPrice."','".$this->deliveryDateTime."','".$customerId."',0,'".$this->payment_method."','".$this->delivery_method."')";
		
		if(mysqli_query($con, $sql)){
			// Retrieve the customer ID after the insertion
			$orderId = mysqli_insert_id($con);
			$this->id = $orderId;
			return true;
		} else {
			return false;
		}
		
	}
}

?>
