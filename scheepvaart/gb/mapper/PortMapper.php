<?php
namespace gb\mapper;

$EG_DISABLE_INCLUDES=true;
require_once( "gb/mapper/Mapper.php" );
require_once( "gb/domain/Port.php" );
require_once( "gb/connection/ConnectionManager.php");

class PortMapper extends Mapper {

    function __construct() {
        parent::__construct();
		$this->selectStmt = "SELECT * FROM port where port_code = ?";
        $this->selectAllStmt = "SELECT * FROM PORT ";
    } 
    protected function doCreateObject( array $array ) {
        
        $obj = null;        
        if (count($array) > 0) {
            $obj = new \gb\domain\Port( $array['port_code'] );

            $obj->setPortCode($array['port_code']);
            $obj->setPortName($array["port_name"]);
            $obj->setTax($array['tax']);
            $obj->setLongitude($array['longitude']);
            $obj->setLatitude($array['latilude']);
            $obj->setTimeZone($array['time_zone']);
            $obj->setDstZone($array['dst_zone']);
            $obj->setCountryId($array['country_id']);
        } 
        
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
    function getCollection( array $raw ) {
        
        $customerCollection = array();
        foreach($raw as $row) {
            array_push($customerCollection, $this->doCreateObject($row));
        }
        
        return $customerCollection;
    }
    
    
    
}


?>