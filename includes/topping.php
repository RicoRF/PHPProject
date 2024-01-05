<?php

class Topping {

	private $id;
    private $name;
    private $price;
    private $createDate;
    private $isActive;

    public function __construct($name, $price, $isActive) {
		$this->name = $name;
        $this->price = $price;
        $this->isActive = $isActive;
    }

    // Getter methods
	
	public function getId() {
        return $this->id;
    }
	
    public function getName() {
        return $this->name;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getCreateDate() {
        return $this->createDate;
    }

    public function getIsActive() {
        return $this->isActive;
    }

    // Setter methods
	
	public function setId($id) {
        $this->id = $id;
    }
	
    public function setName($name) {
        $this->name = $name;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function setCreateDate($createDate) {
        $this->createDate = $createDate;
    }

    public function setIsActive($isActive) {
        $this->isActive = $isActive;
    }
	
	public static function getToppingById($conn, $toppingId){
		
		if($conn){
		
		$sql = "SELECT * FROM toppings WHERE toppingid = ".$toppingId."";
		
		$query = mysqli_query($conn, $sql);
		
		$result = mysqli_fetch_assoc($query);
		//$returning = new Topping($result["toppingId"], $result["name"], $result["price"], $result["createdate"], $result["isActive"]);
		
		$returning = new Topping($result["name"], $result["price"], $result["isActive"]);
		
		return $returning;
		
		}
		
		else {
			
			return null;
			
		}
		
	}
	
	public static function getToppingsForEmployee($conn){
		
		$sql = "SELECT * FROM toppings";
		
		$query = mysqli_query($conn, $sql);
		
		while($result = mysqli_fetch_array($query)){
			
			echo $result["name"]. ' <a href="includes/delete_topping.php?id='.$result["toppingId"].'">Delete</a> ';
			
			if($result["isActive"] == 1){
				
				echo '<a href="includes/d_topping.php?id='.$result["toppingId"].'">Deactivate</a>';
				
			}
			
			else {
				
				echo '<a href="includes/a_topping.php?id='.$result["toppingId"].'">Activate</a>';
				
			}
			
			echo '<br>';
			
		}
		
	}
	
	public function AddTopping($conn, $empId){
		
		$sql = "INSERT INTO toppings (name, price, empAddedBy, isActive) VALUES('".$this->name."', ".$this->price.", ".$empId.",".$this->isActive.")";
		if(mysqli_query($conn, $sql)){
			
			return true;
			
		}
		
		else {
			
			return false;
			
		}
		
	}
	
}
	
?>
