<?php
namespace gb\domain;

require_once( "gb/domain/DomainObject.php" );

class Shipment extends DomainObject {    
      
    private $shipment_id;
    private $volume;
    private $weight;
    
    function __construct( $id=null ) {
        //$this->name = $name;
        parent::__construct( $id );
    }
    
    function setShipmentId( $shipment_id ) {
        $this->shipment_id = $shipment_id;        
    }

    function getShipmentId( ) {
        return $this->shipment_id;
    }
    
    function setVolume ( $volume ) {
        $this->volume = $volume;        
    }
    
    function getVolume () {
        return $this->volume;
    }
    
    function setWeight ($weight ) {
        $this->weight = $weight;
    }
    
    function getWeight () {
        return $this->weight;
    }
    
    

}

?>
