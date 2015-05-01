<?php
namespace gb\mapper;

$EG_DISABLE_INCLUDES=true;
require_once( "gb/mapper/Mapper.php" );
require_once( "gb/domain/ShipBroker.php" );


class ShipBrokerMapper extends Mapper {

    function __construct() {
        parent::__construct();
        $this->selectStmt = "SELECT * FROM CUSTOMER where ssn = ?";
        $this->selectAllStmt = "SELECT * FROM SHIP_BROKER ";       
    } 
    
    function getCollection( array $raw ) {
        
        $customerCollection = array();
        foreach($raw as $row) {
            array_push($customerCollection, $this->doCreateObject($row));
        }
        
        return $customerCollection;
    }

    protected function doCreateObject( array $array ) {
        $obj = new \gb\domain\ShipBroker( $array['name'] );
        
        $obj->setName($array['name']);
        $obj->setNumber($array['number']);
        $obj->setStreet($array['street']);
        $obj->setBus($array['bus']);
        $obj->setPostalCode($array['postal_code']);
        $obj->setCity($array['city']);
        
        return $obj;
    }

    protected function doInsert( \gb\domain\DomainObject $object ) {
        
    }
    
    function update( \gb\domain\DomainObject $object ) {
       
    }

    function selectStmt() {
        return $this->selectStmt;
    }
    
    function selectAllStmt() {
        return $this->selectAllStmt;
    }
    
   
		
       
	function getShipBrokerRevenues() {
        "CREATE VIEW view_a (name, id, price, date) AS SELECT name, shipment_id, price, order_date FROM ORDERS JOIN ship_broker ON ship_broker_name=name";
		"CREATE VIEW view_b (name, shipment_id, price, date, route_id) AS SELECT name, id, price, date, route_id FROM VIEW_A JOIN ships ON id=shipment_id";
		"CREATE VIEW view_c (name, price, date, from_port, to_port, route_id) AS SELECT name, price, date, from_port_code, to_port_code, b.route_id FROM view_b b JOIN route r ON b.route_id = r.route_id";
        $con = $this->getConnectionManager();
        $selectStmt = "SELECT name, F.port_name AS depart, T.port_name AS arrival, SUM(price) AS revenue, date_format(`date`, '%m/%Y') AS date FROM view_c, port F, port T WHERE F.port_code=from_port and T.port_code=to_port and date > DATE_ADD(NOW(), INTERVAL -1 MONTH) group by route_id, name";
        $results = $con->executeSelectStatement($selectStmt, array()); 
		return $results;
		
		
        
    }
}


?>
