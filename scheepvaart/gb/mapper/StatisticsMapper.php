<?php
namespace gb\mapper;

$EG_DISABLE_INCLUDES=true;
require_once( "gb/mapper/Mapper.php" );
require_once( "gb/domain/ShipBroker.php" );


class StatisticsMapper extends Mapper {

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
	
	function getNumberOfCustomers() {
		"create view ordersships(shipment_id, ssn, shipbroker_name, price, order_date, route_id, ship_id, departure_date) as select shipment_id, ssn, ship_broker_name, price, order_date, o.route_id, ship_id, departure_date from orders o natural join ships s";
		"create view routeships(shipment_id, ssn, shipbroker_name, price, order_date, route_id,ship_id, departure_date, to_port_code) as select shipment_id, ssn, shipbroker_name, price, order_date, o.route_id, ship_id, departure_date, to_port_code from ordersships o natural join route r";
		"create view routetrip(shipment_id, ssn, shipbroker_name, price, order_date, route_id, departure_date, arrival_date, to_port_code) as select shipment_id, ssn, shipbroker_name, price, order_date, r.route_id, r.departure_date, arrival_date, to_port_code from routeships r join trip t on (r.route_id=t.route_id and r.ship_id = t.ship_id and r.departure_date=t.departure_date)";
		"create view portroute (shipment_id, ssn, shipbroker_name, price, order_date, route_id, departure_date, arrival_date, to_port_code, country_id) as select shipment_id, ssn, shipbroker_name, price, order_date, route_id, departure_date, arrival_date, to_port_code, country_id from routetrip r join port p on port_code=to_port_code";
		"create view portcountry (shipment_id, ssn, shipbroker_name, price, order_date, route_id, departure_date, arrival_date, to_port_code, country_name) as select shipment_id, ssn, shipbroker_name, price, order_date, route_id, departure_date, arrival_date, to_port_code, country_name from portroute natural join country";
		$con = $this->getConnectionManager();
		$selectStmt = "select count(distinct ssn) as number_unique_clients, shipbroker_name from portcountry group by shipbroker_name order by number_unique_clients desc";
		$numbers = $con->executeSelectStatement($selectStmt, array());        
        return $numbers;
	}
	function getNumberOfOrders(){
		"create view ordersships(shipment_id, ssn, shipbroker_name, price, order_date, route_id, ship_id, departure_date) as select shipment_id, ssn, ship_broker_name, price, order_date, o.route_id, ship_id, departure_date from orders o natural join ships s";
		"create view routeships(shipment_id, ssn, shipbroker_name, price, order_date, route_id,ship_id, departure_date, to_port_code) as select shipment_id, ssn, shipbroker_name, price, order_date, o.route_id, ship_id, departure_date, to_port_code from ordersships o natural join route r";
		"create view routetrip(shipment_id, ssn, shipbroker_name, price, order_date, route_id, departure_date, arrival_date, to_port_code) as select shipment_id, ssn, shipbroker_name, price, order_date, r.route_id, r.departure_date, arrival_date, to_port_code from routeships r join trip t on (r.route_id=t.route_id and r.ship_id = t.ship_id and r.departure_date=t.departure_date)";
		"create view portroute (shipment_id, ssn, shipbroker_name, price, order_date, route_id, departure_date, arrival_date, to_port_code, country_id) as select shipment_id, ssn, shipbroker_name, price, order_date, route_id, departure_date, arrival_date, to_port_code, country_id from routetrip r join port p on port_code=to_port_code";
		"create view portcountry (shipment_id, ssn, shipbroker_name, price, order_date, route_id, departure_date, arrival_date, to_port_code, country_name) as select shipment_id, ssn, shipbroker_name, price, order_date, route_id, departure_date, arrival_date, to_port_code, country_name from portroute natural join country";
		$con = $this->getConnectionManager();
		$selectStmt = "select count(distinct shipment_id) as number_of_orders, shipbroker_name from portcountry group by shipbroker_name order by number_of_orders desc";
		$numbers = $con->executeSelectStatement($selectStmt, array());        
        return $numbers;
	}
	
	function getUnderwayTime(){
		"create view ordersships(shipment_id, ssn, shipbroker_name, price, order_date, route_id, ship_id, departure_date) as select shipment_id, ssn, ship_broker_name, price, order_date, o.route_id, ship_id, departure_date from orders o natural join ships s";
		"create view routeships(shipment_id, ssn, shipbroker_name, price, order_date, route_id,ship_id, departure_date, to_port_code) as select shipment_id, ssn, shipbroker_name, price, order_date, o.route_id, ship_id, departure_date, to_port_code from ordersships o natural join route r";
		"create view routetrip(shipment_id, ssn, shipbroker_name, price, order_date, route_id, departure_date, arrival_date, to_port_code) as select shipment_id, ssn, shipbroker_name, price, order_date, r.route_id, r.departure_date, arrival_date, to_port_code from routeships r join trip t on (r.route_id=t.route_id and r.ship_id = t.ship_id and r.departure_date=t.departure_date)";
		"create view portroute (shipment_id, ssn, shipbroker_name, price, order_date, route_id, departure_date, arrival_date, to_port_code, country_id) as select shipment_id, ssn, shipbroker_name, price, order_date, route_id, departure_date, arrival_date, to_port_code, country_id from routetrip r join port p on port_code=to_port_code";
		"create view portcountry (shipment_id, ssn, shipbroker_name, price, order_date, route_id, departure_date, arrival_date, to_port_code, country_name) as select shipment_id, ssn, shipbroker_name, price, order_date, route_id, departure_date, arrival_date, to_port_code, country_name from portroute natural join country";
		$con = $this->getConnectionManager();
		$selectStmt = "select DATEDIFF(arrival_date, order_date) as average_total_time, shipbroker_name from portcountry group by shipbroker_name order by average_total_time asc";
		$numbers = $con->executeSelectStatement($selectStmt, array());        
        return $numbers;
	}
	
	

}


?>
