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
	include "libchart-1.3\libchart\libchart\classes\libchart.php";
?>
<form name ="form 1"method="post">
    
<table style="width: 100%">
    <tr>
        <td style="width: 20%"></td>
        <td style="width: 20%">Ship broker comparison</td>
        <td style="width: 40%">
            <select style="width: 100%" name="searchCriterium">
				<option value="1">Number of clients</options>
				<option value="2">Number of delivered orders</options>
				<option value="3">The time from order to arrival</options>
				<option value="4">Number of delivered orders to a city</options>
				<option value="5">City of the ShipBroker</options>
				<option value="6">Used ships</options>
				<option value="7">The amount of recieved money</options>
					
            </select>
        </td>
        <td style="width: 10%"><input type="submit" value="Select" name="submit"></td>
        <td style="width: 30%"></td>
		
	</form>
		


<?php
if(isset($_POST['submit']))
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
	$chart = new HorizontalBarChart(1200, 500);
	$dataSet = new XYDataSet();
	
foreach($result as $revenue){
	$dataSet->addPoint(new Point($revenue['shipbroker_name'],$revenue['number_of_orders'] ));
	}
	$chart->setDataSet($dataSet);
	$chart->getPlot()->setGraphPadding(new Padding(5, 30, 20, 170));

	$chart->setTitle("Amount of orders made by each shipbroker");
	$chart->render("generated/NumberOrders.png");
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Barchart number of orders</title>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-15" />
</head>
<body>
	<img alt="Horizontal bars chart"  src="generated/NumberOrders.png" style="border: 1px solid gray;"/>
</body>
</html>
<?php
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
		<th><?php echo $revenue['shipbroker_name']; ?></th>		
		<th><?php echo $revenue['average_total_time']; ?></th>
	</tr>     
<?php        
	}
}	

if($search=='4'){
	header('Location: orders_to_port.php');  
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
