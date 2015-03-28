<?php
namespace gb\controller;

require_once("gb/controller/PageController.php");
require_once("gb/mapper/CustomerMapper.php" );

class OrderShipmentController extends PageController {
    private $customer;
    
    function process() {
        
        if (!$this->isSsnNull()) {
            $this->customer = $this->lookupCustomer($_POST["ssn"]);
        } 
        
        if (isset($_POST["order_shipment"])){
            $this->placeShipmentOrder();
        }
                
    }
    
    function isSsnNull() {
        return !(isset ($_POST['ssn']));
    }
    
    function isOrderShipmentDisabled() {
        return is_null($this->customer);
    }
    
    function isOrderShipmentEnabled() {
        return (isset($_POST["order_shipment"]));
    }
            
    function lookupCustomer ($ssn) {
        //$this->customer = null;
        $mapper = new \gb\mapper\CustomerMapper();//
        return $mapper->find($ssn);
    }
    
    function getCustomerSsn() {
        if (!is_null($this->customer)) {
            return $this->customer->getSsn();
        } else {
            return '';
        }
    }
    
    function getCustomerFirstName() {
        if (!is_null($this->customer)) {
            return $this->customer->getFirstName();
        } else {
            return '';
        }
    }
    
    function getCustomerLastName() {
        if (!is_null($this->customer)) {
            return $this->customer->getLastName();
        } else {
            return '';
        }
    }
    
    function getCustomerCity() {
        if (!is_null($this->customer)) {
            return $this->customer->getCity();
        } else {
            return '';
        }
    }
    
    function getCustomerStreet() {
        if (!is_null($this->customer)) {
            return $this->customer->getStreet();
        } else {
            return '';
        }
    }
    
    function getCustomerNumber() {
        if (!is_null($this->customer)) {
            return $this->customer->getNumber();
        } else {
            return '';
        }
    }
    
    function getCustomerBus() {
        if (!is_null($this->customer)) {
            return $this->customer->getBus();
        } else {
            return '';
        }
    }
    
    function getCustomerPostalCode () {
        if (!is_null($this->customer)) {
            return $this->customer->getPostalCode();
        } else {
            return '';
        }
    }
    
    function placeShipmentOrder() {
		//use Mysqli;
		$shipment_id = $_POST['shipment_id'];
		$ssn = $_POST['ssn'];
		$ship_broker = $_POST['ship_broker'];
		$price = $_POST['price'];
		$date = $_POST['date'];
		$volume = $_POST['volume'];
		$weight = $_POST['weight'];
		
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "shipping";
		
		$conn = new Mysqli($servername,$username,$password,$dbname);
		if ($conn->connect_error) {
			die("connection failed: " .$conn->connect_error);
		}
        $sql1 = "INSERT INTO orders (shipment_id, ssn, ship_broker_name, price, order_date)
				VALUES ($shipment_id,$ssn,$ship_broker,$price,$order_date)";
		$sql2 = "INSERT INTO shipment (shipment_id, volume, weight)
				VALUES ($shipment_id,$volume,$weight)";
		
		if (($conn->query($sql1) === TRUE) AND ($conn->query($sql1)) {
			echo "succes";
		}
		else {
			echo "error: " .$sql1 . "<br>" .$conn->error;
			echo "error: " .$sql2 . "<br>" .$conn->error;
		}
	}
}


?>