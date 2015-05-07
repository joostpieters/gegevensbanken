<?php
	// Dit is de titel die op de pagina en in de menubalk
	// zal verschijnen.
	$title = "Statistics";

	// Voer de inhoud van "top.inc.php" uit. Deze verzorgt de
	// algemene pagina lay-out en het menu.
	require("template/top.tpl.php");
	
	require_once( "gb/mapper/StatisticsMapper.php" );
	$mapper = new gb\mapper\StatisticsMapper();
	$allShipments = $mapper->findAll();
	require_once("phpChart_Lite\conf.php");
?>
<form method="post">
    
<table style="width: 100%">
    <tr>
        <td style="width: 20%"></td>
        <td style="width: 20%">Ship broker comparison</td>
        <td style="width: 40%">
            <select style="width: 100%" name="searchCriterium">
				<option value="1">Number of clients</options>
				<option value="2">Number of delivered orders</options>
				<option value="3">The time from order to arrival</options>
				<option value="4">Number of delivered orders to a country</options>
				<option value="5">City of the ShipBroker</options>
				<option value="6">Used ships</options>
				<option value="7">The amount of recieved money</options>
					
            </select>
        </td>
        <td style="width: 10%"><input type="submit" value="Select" name="formSubmit"></td>
        <td style="width: 30%"></td>
    </tr>

<?php
if(isset($_POST['formSubmit']))
{
	$search = $_POST['searchCriterium'];
if($search=='1'){
?>
<tr>
        <td>Ship broker name</td>
        <td>Number of clients</td>
    </tr>
<?php

$mapper = new gb\mapper\StatisticsMapper();
$result = $mapper->getNumberOfCustomers();


foreach($result as $revenue){
	
	?>
       <tr>
		<th><?php echo $revenue['shipbroker_name']; ?></th>		
		<th><?php echo $revenue['number_unique_clients']; ?></th>
	</tr>     
<?php        
	}
}

if($search=='2'){


$mapper = new gb\mapper\StatisticsMapper();
$result = $mapper->getNumberOfOrders();

?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>phpChart - Basic Chart</title>
</head>
<body>
    
<?php
$pc = new C_PhpChartX(array(array(11, 9, 5, 12, 14)),'basic_chart');
$pc->draw();
?>

</body>
</html>
<?php
	}
?>
<?php
if($search=='3'){
?>
<tr>
        <td>Ship broker name</td>
        <td>Time (in days)</td>
    </tr>
<?php

$mapper = new gb\mapper\StatisticsMapper();
$result = $mapper->getUnderwayTime();


foreach($result as $revenue){
	
	?>
       <tr>
		<th><?php echo $revenue['shipbroker_name']; ?></th>		
		<th><?php echo $revenue['average_total_time']; ?></th>
	</tr>     
<?php        
	}
}
if($search=='4'){
	require_once( "gb/mapper/CustomerMapper.php" );
	$mapper = new gb\mapper\CustomerMapper();
    $allCustomers = $mapper->findAll();
?>
<select style="width: 100%" name="country">
				<?php
					$countries = array();
                    foreach($allCustomers as $customer) {
						if(!in_array($customer->getCity(), $countries)){
							array_push($countries, $customer->getCity() );
							echo "<option value=\"", $customer->getCity(), "\">", $customer->getCity(), "</option>" ;
						}
                    }
                    
                    ?>
		


					
            </select>
<tr>
        <td>Ship broker name</td>
        <td>Number of orders to this city</td>
    </tr>
<?php

$mapper = new gb\mapper\StatisticsMapper();
$result = $mapper->getO();


foreach($result as $revenue){
	
	?>
       <tr>
		<th><?php echo $revenue['shipbroker_name']; ?></th>		
		<th><?php echo $revenue['average_total_time']; ?></th>
	</tr>     
<?php        
	}
}

if($search=='5'){
?>
<tr>
        <td>Ship broker name</td>
        <td>Street</td>
		<td>Number</td>
		<td>Bus</td>
		<td>Postal Code</td>
		<td>City</td>
    </tr>
<?php

$mapper = new gb\mapper\StatisticsMapper();
$result = $mapper->getShipBrokerAdress();

foreach($result as $revenue){	
	?>
       <tr>
		<th><?php echo $revenue['name']; ?></th>	
		<th><?php echo $revenue['street_of_shipbroker']; ?></th>
		<th><?php echo $revenue['number_of_shipbroker']; ?></th>
		<th><?php echo $revenue['bus_of_shipbroker']; ?></th>
		<th><?php echo $revenue['postal_code_of_shipbroker']; ?></th>			
		<th><?php echo $revenue['city_of_shipbroker']; ?></th>
	</tr>     
<?php        
	}
}
if($search=='6'){
?>
<tr>
        <td>Ship broker name</td>
        <td>Number of used ships</td>
    </tr>
<?php

$mapper = new gb\mapper\StatisticsMapper();
$result = $mapper->getShips();

foreach($result as $revenue){	
	?>
    <tr>
		<th><?php echo $revenue['shipbroker_name']; ?></th>	
		<th><?php echo $revenue['number_of_ships']; ?></th>
	</tr>     
<?php        
	}
}

if($search=='7'){
?>
<tr>
        <td>Ship broker name</td>
        <td>Amount of money</td>
    </tr>
<?php

$mapper = new gb\mapper\StatisticsMapper();
$result = $mapper->getTotalPrice();

foreach($result as $revenue){	
	?>
    <tr>
		<th><?php echo $revenue['shipbroker_name']; ?></th>	
		<th><?php echo $revenue['totalPrice']; ?></th>
	</tr>     
<?php        
	}
}
}

?>



</table>
<?php

	require("template/bottom.tpl.php");
?>
