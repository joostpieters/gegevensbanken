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
?>
<form method="post">
    
<table style="width: 100%">
    <tr>
        <td style="width: 10%"></td>
        <td style="width: 10%">Ship broker comparison</td>
        <td style="width: 40%">
            <select style="width: 100%" name="searchCriterium">
				<option value="1">Number of clients</options>
				<option value="2">Number of delivered orders</options>
				<option value="3">The time from order to arrival</options>
				<option value="4">Number of delivered orders to a country</options>
		


					
            </select>
        </td>
        <td style="width: 10%"><input type="submit" value="List customers in the city" name="formSubmit"></td>
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
		<td><?php echo $revenue['shipbroker_name']; ?></td>		
		<td><?php echo $revenue['number_unique_clients']; ?></td>
	</tr>     
<?php        
	}
}

if($search=='2'){
?>
<tr>
        <td>Ship broker name</td>
        <td>Number of orders</td>
    </tr>
<?php

$mapper = new gb\mapper\StatisticsMapper();
$result = $mapper->getNumberOfOrders();


foreach($result as $revenue){
	
	?>
       <tr>
		<td><?php echo $revenue['shipbroker_name']; ?></td>		
		<td><?php echo $revenue['number_of_orders']; ?></td>
	</tr>     
<?php        
	}
}
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
		<td><?php echo $revenue['shipbroker_name']; ?></td>		
		<td><?php echo $revenue['average_total_time']; ?></td>
	</tr>     
<?php        
	}
}
if($search=='4'){
?>
<select style="width: 100%" name="country">
				<?php
					$countries = array();
                    foreach($allCustomers as $customer) {
						if(!in_array($customer->getCity(), $cities)){
							array_push($cities, $customer->getCity() );
							echo "<option value=\"", $customer->getCity(), "\">", $customer->getCity(), "</option>" ;
						}
                    }
                    
                    ?>
		


					
            </select>
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
		<td><?php echo $revenue['shipbroker_name']; ?></td>		
		<td><?php echo $revenue['average_total_time']; ?></td>
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
