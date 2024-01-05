<?php

class Customer {
    private $firstName;
    private $lastName;
    private $phoneNumber;
    private $email;
    private $houseNumber;
    private $street;
    private $province;
    private $postalCode;
    private $memberName;
	private $id;

    public function __construct($firstName, $lastName, $phoneNumber, $email, $houseNumber, $street, $province, $postalCode, $memberName) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->phoneNumber = $phoneNumber;
        $this->email = $email;
        $this->houseNumber = $houseNumber;
        $this->street = $street;
        $this->province = $province;
        $this->postalCode = $postalCode;
        $this->memberName = $memberName;
    }

    // Getter methods
	
	public function getId() {
        return $this->id;
    }
	
    public function getFirstName() {
        return $this->firstName;
    }

    public function getLastName() {
        return $this->lastName;
    }

    public function getPhoneNumber() {
        return $this->phoneNumber;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getHouseNumber() {
        return $this->houseNumber;
    }

    public function getStreet() {
        return $this->street;
    }

    public function getProvince() {
        return $this->province;
    }

    public function getPostalCode() {
        return $this->postalCode;
    }

    public function getMemberName() {
        return $this->memberName;
    }

    // Setter methods
    public function setFirstName($firstName) {
        $this->firstName = $firstName;
    }

    public function setLastName($lastName) {
        $this->lastName = $lastName;
    }

    public function setPhoneNumber($phoneNumber) {
        $this->phoneNumber = $phoneNumber;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setHouseNumber($houseNumber) {
        $this->houseNumber = $houseNumber;
    }

    public function setStreet($street) {
        $this->street = $street;
    }

    public function setProvince($province) {
        $this->province = $province;
    }

    public function setPostalCode($postalCode) {
        $this->postalCode = $postalCode;
    }

    public function setMemberName($memberName) {
        $this->memberName = $memberName;
    }
	
	public function setId($id) {
        $this->id = $id;
    }
	
	public function InsertCustomer($con){
		
		$sql = "INSERT INTO `customer`(`firstName`, `lastName`, `phoneNumber`, `email`, `houseNumber`, `street`, `province`, `postalCode`) VALUES ('".$this->firstName."',
		'".$this->lastName."','".$this->phoneNumber."','".$this->email."','".$this->houseNumber."','".$this->street."','".$this->province."','".$this->postalCode."')";
		
		$sql = "INSERT INTO `customer`(`firstName`, `lastName`, `phoneNumber`, `email`, `houseNumber`, `street`, `province`, `postalCode`) VALUES ('".$this->firstName."','".$this->lastName."','".$this->phoneNumber."','".$this->email."','".$this->houseNumber."','".$this->street."','".$this->province."','".$this->postalCode."')";

		if(mysqli_query($con, $sql)){
			// Retrieve the customer ID after the insertion
			$customerId = mysqli_insert_id($con);
			$this->id = $customerId;
			return true;
		} else {
			return false;
		}
		
	}
}

?>
