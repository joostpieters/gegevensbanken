<?php
namespace gb\domain;

require_once( "gb/domain/DomainObject.php" );

class Customer extends DomainObject {    
      
    private $name;
    private $depart_port_name;
    private $arrival_port_name;
    private $revenue;
    private $date;
    

    function __construct( $id=null ) {
        //$this->name = $name;
        parent::__construct( $id );
    }
    
    function setName( $name ) {
        $this->name = $name;        
    }

    function getName( ) {
        return $this->name;
    }
    
    function setDepartPortName ( $depart_port_name ) {
        $this->depart_port_name = $depart_port_name;        
    }
    
    function getArrivalPortName () {
        return $this->arrival_port_name;
    }
    
    function setArrivalPortName ( $arrival_port_name ) {
        $this->arrival_port_name = $arrival_port_name;        
    }
    
    function getDepartPortName () {
        return $this->depart_port_name;
    }
    
    function setRevenue($revenue) {
        $this->revenue = $revenue;
    }
    
    function getRevenue () {
        return $this->revenue;
    }
    
   
    
    function setDate ($date) {
        $this->date = $date;
    }
    function getDate() {
        return $this->date;
    }
    
    
}

?>