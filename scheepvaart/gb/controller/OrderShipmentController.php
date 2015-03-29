<?php
namespace gb\controller;
$EG_DISABLE_INCLUDES=true;
require_once( "gb/mapper/Mapper.php" );
require_once( "gb/domain/ShipBroker.php" );
//require_once( "gb/mapper/Mapper.php" );
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
		// we use $_POST to get the values the user has given us on the html form
		$shipment_id = $_POST['shipment_id'];
		$ssn = $_POST['ssn'];
		$ship_broker = $_POST['ship_broker'];
		$price = $_POST['price'];
		$date = $_POST['date'];
		$volume = $_POST['volume'];
		$weight = $_POST['weight'];
		
		$con = $this->getConnectionManager();
		// we use executeInsertStatement (from connectionmanager) to insert the new data into orders
        $insertStmt1 = "INSERT INTO orders (shipment_id, ssn, ship_broker_name, price, order_date)
				VALUES ($shipment_id,$ssn,$ship_broker,$price,$order_date)";
        $results1 = $con->executeInsertStatement($insertStmt1, array()); 
		$insertStmt2 = "INSERT INTO shipment (shipment_id, volume, weight)
				VALUES ($shipment_id,$volume,$weight)";
		$results2 = $con->executeInsertStatement($insertStmt2, array()); 
		return $results1;
		return $results2;
        
	}
}


?>