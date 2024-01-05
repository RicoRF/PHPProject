<?php

class Pizza {

    private $crustType;
    private $isFinished;
    private $size;
    private $price;
    private $toppings;
	private $quantity;

    public function __construct($crustType, $isFinished, $size, $price, $toppings, $quantity) {
        $this->crustType = $crustType;
        $this->isFinished = $isFinished;
        $this->size = $size;
        $this->price = $price;
        $this->toppings = $toppings;
		$this->quantity = $quantity;
    }

    // Getter methods
    public function getCrustType() {
        return $this->crustType;
    }
	
	public function getQuantity() {
        return $this->quantity;
    }

    public function getIsFinished() {
        return $this->isFinished;
    }

    public function getSize() {
        return $this->size;
    }

    public function getPrice() {
        return $this->price * $this->quantity;
    }

    public function getToppings() {
        return $this->toppings;
    }

    // Setter methods
    public function setCrustType($crustType) {
        $this->crustType = $crustType;
    }
	
	public function setQuantity($quantity) {
        $this->quantity = $quantity;
    }

    public function setIsFinished($isFinished) {
        $this->isFinished = $isFinished;
    }

    public function setSize($size) {
        $this->size = $size;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function setToppings($toppings) {
        $this->toppings = $toppings;
    }
	
	public function addPizzaToOrder($conn, $orderId){
		
		//$this->size = 0;
		$sql_size = "SELECT sizeid FROM sizes WHERE name = '".$this->size."'";
		$size_query = mysqli_query($conn, $sql_size);
		$result = mysqli_fetch_assoc($size_query);
		if($result){
			
			$this->size = $result["sizeid"];
			
		}
		
		//$this->crustType = 0;
		$sql_crust = "SELECT crustTypeId FROM crusttypes WHERE name = '".$this->crustType."'";
		$crust_query = mysqli_query($conn, $sql_crust);
		$resultCrust = mysqli_fetch_assoc($crust_query);
		if($resultCrust){
			
			$this->crustType = $resultCrust["crustTypeId"];
			
		}
		
		$sql = "INSERT INTO `pizza`(`sizeId`, `isFinished`, `crustTypeId`, `price`, `orderId`, `toppings`)
		VALUES (".$this->size.",".$this->isFinished.",'".$this->crustType."',".$this->price.",".$orderId.", '".$this->toppings."')";
		
		if(mysqli_query($conn, $sql)){
			// Retrieve the customer ID after the insertion
			$orderId = mysqli_insert_id($conn);
			$this->id = $orderId;
			return true;
		} else {
			return false;
		}
		
	}
}
?>
