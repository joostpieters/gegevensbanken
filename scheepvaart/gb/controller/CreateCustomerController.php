<?php
namespace gb\controller;

require_once("gb/controller/PageController.php");
require_once("gb/mapper/CustomerMapper.php" );

class CreateCustomerController extends PageController {
    function process() {
        if (isset($_POST["create_customer"])) {
           // $this->insert( \gb\domain\Customer array(ssn) );
		   	/* unable to connect the update function to the given customer
			because it does not recognize the given customer as an object */
        }
    }
	
	}


?>