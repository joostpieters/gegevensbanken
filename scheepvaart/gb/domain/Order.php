<?php
namespace gb\domain;

require_once( "gb/domain/DomainObject.php" );

class Order extends DomainObject {    
      
    private $shipment_id;
    private $customer_name;
    private $ship_broker_name;
    private $price;
    private $order_date;

    function __construct( $id=null ) {
        //$this->name = $name;
        parent::__construct( $id );
    }
    
    function setShipmentId( $shipment_id ) {
        $this->shipment_id = $shipment_id;        
    }

    function getSsn( ) {
        return $this->shipment_id;
    }
    
    function setCustomerName ( $customer_name ) {
        $this->customer_name = $customer_name;        
    }
    
    function getCustomerName () {
        return $this->customer_name;
    }
    
    function setShipBrokerName ($ship_broker_name ) {
        $this->ship_broker_name = $ship_broker_name;
    }
    
    function getShipBrokerName () {
        return $this->ship_broker_name;
    }
    
    function setPrice ($price) {
        $this->price = $price;
    }
    
    function getPrice () {
        return $this->price;
    }
    
    function setOrderDate ($order_date) {
        $this->order_date = $order_date;
    }
    function getOrderDate() {
        return $this->order_date;
    }
    
    

}

?>
