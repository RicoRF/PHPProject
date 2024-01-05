<?php

class Employee {
    private $userName;
    private $password;

    public function __construct($userName, $password) {
        $this->userName = $userName;
        $this->password = $password;
    }

    // Getter methods
    public function getUserName() {
        return $this->userName;
    }

    public function getPassword() {
        return $this->password;
    }

    // Setter methods
    public function setUserName($userName) {
        $this->userName = $userName;
    }

    public function setPassword($password) {
        $this->password = $password;
    }
	
	public function Login($conn){
		
		$sql = "SELECT * FROM employee WHERE username = '".$this->userName."' AND password = '".$this->password."'";
		
		$query = mysqli_query($conn, $sql);
		
		if(mysqli_num_rows($query) > 0){
			
			return true;
			
		}
		
		else {
			
			return false;
			
		}
		
	}
	
	public static function getId($un, $conn){
		
		$sql = "SELECT * FROM employee WHERE username = '".$un."'";
		
		$query = mysqli_query($conn, $sql);
		
		if(mysqli_num_rows($query) > 0){
			
			$result = mysqli_fetch_assoc($query);
			
			return $result["employeeid"];
			
		}
		
		else {
			
			return 0;
			
		}
		
	}
}

?>
