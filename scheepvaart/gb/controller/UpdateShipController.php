<?php
namespace gb\controller;

require_once("gb/controller/PageController.php");
require_once("gb/mapper/ShipMapper.php" );

class UpdateShipController extends PageController {
	
    function process() {
		if (isset($_POST["update_ship"])) {
		//$this->update(\gb\domain\Ship array(ship_id)); 
		/* unable to connect the update function to the given ship
		because it does not recognize the given ship as an object */
		}
    }
}