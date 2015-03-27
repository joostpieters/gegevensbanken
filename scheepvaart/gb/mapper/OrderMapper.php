<?php
namespace gb\mapper;

$EG_DISABLE_INCLUDES=true;
require_once( "gb/mapper/Mapper.php" );
require_once( "gb/domain/Orders.php" );


class OrderMapper extends Mapper {

    function __construct() {
        parent::__construct();
        $this->selectStmt = "SELECT * FROM ORDERS where shipment_id = ?";
        $this->selectAllStmt = "SELECT * FROM ORDERS ";        
    } 
    
    function getCollection( array $raw ) {
        
        $orderCollection = array();
        foreach($raw as $row) {
            array_push($orderCollection, $this->doCreateObject($row));
        }
        
        return $orderCollection;
    }

    protected function doCreateObject( array $array ) {
        
        $obj = null;        
        if (count($array) > 0) {
            $obj = new \gb\domain\Orders( $array['shipment_id'] );

            $obj->setShipmentId($array['shipment_id']);
            $obj->setSsn($array["ssn"]);
            $obj->setShipBrokerName($array['ship_broker_name']);
            $obj->setPrice($array['price']);
            $obj->setOrderDate($array['order_date']);
        } 
        
        return $obj;
    }

    protected function doInsert( \gb\domain\DomainObject $object ) {
        /*$values = array( $object->getName() ); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );*/
    }
    
    function update( \gb\domain\DomainObject $object ) {
        //$values = array( $object->getName(), $object->getId(), $object->getId() ); 
        //$this->updateStmt->execute( $values );
    }

    function selectStmt() {
        return $this->selectStmt;
    }
    
    function selectAllStmt() {
        return $this->selectAllStmt;
    }
    
   
}


?>
