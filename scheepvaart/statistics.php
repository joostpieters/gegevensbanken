<?php
	// Dit is de titel die op de pagina en in de menubalk
	// zal verschijnen.
	$title = "Statistics";

	// Voer de inhoud van "top.inc.php" uit. Deze verzorgt de
	// algemene pagina lay-out en het menu.
	require("template/top.tpl.php");
	//include the chart drawing classes
	include "libchart-1.3\libchart\libchart\classes\libchart.php";
?>
<form name ="form 1"method="post">
    <?php //Display the drop down menu?>
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
				<option value="5">City of the ship broker</options>
				<option value="6">Used ships</options>
				<option value="7">The amount of income</options>
					
            </select>
        </td>
        <td style="width: 10%"><input type="submit" value="Select" name="submit"></td>
        <td style="width: 30%"></td>
		
	</form>
		


<?php
if(isset($_POST['submit']))
{
	$search = $_POST['searchCriterium'];


//Check if the first option was selected	
if($search=='1'){
//Create a list of the amount of clients of each ship broker.
$mapper = new gb\mapper\StatisticsMapper();
$result = $mapper->getNumberOfCustomers();
	//Create a bar chart
	$chart = new HorizontalBarChart(1200, 500);
	$dataSet = new XYDataSet();
//Add all bars to the chart
foreach($result as $revenue){
	$dataSet->addPoint(new Point($revenue['shipbroker_name'],$revenue['number_unique_clients'] ));
	}
	//create a .png image of the chart
	$chart->setDataSet($dataSet);
	$chart->getPlot()->setGraphPadding(new Padding(5, 30, 20, 170));
	$chart->setTitle("Amount of clients of each ship broker");
	$chart->render("generated/NumberClients.png");
?>
<?php//display the chart?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Barchart number of clients</title>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-15" />
</head>
<body>
	<img alt="Horizontal bars chart"  src="generated/NumberClients.png" style="border: 1px solid gray;"/>
</body>
</html>
<?php        
	}


//Check if the second option was selected	
if($search=='2'){
//Create a list of the amount of orders made at each ship broker
$mapper = new gb\mapper\StatisticsMapper();
$result = $mapper->getNumberOfOrders();
	//Create a bar chart
	$chart = new HorizontalBarChart(1200, 500);
	$dataSet = new XYDataSet();
//Add all bars to the chart
foreach($result as $revenue){
	$dataSet->addPoint(new Point($revenue['shipbroker_name'],$revenue['number_of_orders'] ));
	}
	//create a .png image of the chart
	$chart->setDataSet($dataSet);
	$chart->getPlot()->setGraphPadding(new Padding(5, 30, 20, 170));
	$chart->setTitle("Amount of orders made at each ship broker");
	$chart->render("generated/NumberOrders.png");
?>
<?php//display the chart?>
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


//Check if the third option was selected	
if($search=='3'){
//Create a list of the amount of time between order and arrival
$mapper = new gb\mapper\StatisticsMapper();
$result = $mapper->getUnderwayTime();
	//Create a bar chart
	$chart = new HorizontalBarChart(1200, 500);
	$dataSet = new XYDataSet();
//Add all bars to the chart
foreach($result as $revenue){
	$dataSet->addPoint(new Point($revenue['shipbroker_name'],$revenue['average_total_time'] ));
	}
	//create a .png image of the chart
	$chart->setDataSet($dataSet);
	$chart->getPlot()->setGraphPadding(new Padding(5, 30, 20, 170));
	$chart->setTitle("Amount of time between order and arrival (in days)");
	$chart->render("generated/UnderwayTime.png");
?>
<?php//display the chart?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Barchart Duration Order Arrival </title>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-15" />
</head>
<body>
	<img alt="Horizontal bars chart"  src="generated/UnderwayTime.png" style="border: 1px solid gray;"/>
</body>
</html>
<?php
	}	


//Check if the fourth option was selected	
if($search=='4'){
	//Go to the orders_to_port section
	header('Location: orders_to_port.php');  
}


//Check if the fifth option was selected	          
if($search=='5'){
?>
<table style="width: 100%" border="1">
<tr>
        <th>Ship broker name</th>
        <th>Street</th>
		<th>Number</th>
		<th>Bus</th>
		<th>Postal Code</th>
		<th>City</th>
    </tr>
<?php
//Create a list of the addresses of each ship broker
$mapper = new gb\mapper\StatisticsMapper();
$result = $mapper->getShipBrokerAdress();
//Return the list of all addresses of each ship broker
foreach($result as $revenue){	
	?>
       <tr>
		<td><?php echo $revenue['name']; ?></td>	
		<td><?php echo $revenue['street_of_shipbroker']; ?></td>
		<td><?php echo $revenue['number_of_shipbroker']; ?></td>
		<td><?php echo $revenue['bus_of_shipbroker']; ?></td>
		<td><?php echo $revenue['postal_code_of_shipbroker']; ?></td>			
		<td><?php echo $revenue['city_of_shipbroker']; ?></td>
	</tr>     
<?php        
	}
}


//Check if the sixth option was selected	
if($search=='6'){
//Create a list of the amount of ships in use by the ship broker
$mapper = new gb\mapper\StatisticsMapper();
$result = $mapper->getShips();
	//Create a bar chart
	$chart = new HorizontalBarChart(1200, 500);
	$dataSet = new XYDataSet();
//Add all bars to the chart	
foreach($result as $revenue){
	$dataSet->addPoint(new Point($revenue['shipbroker_name'],$revenue['number_of_ships'] ));
	}
	//create a .png image of the chart
	$chart->setDataSet($dataSet);
	$chart->getPlot()->setGraphPadding(new Padding(5, 30, 20, 170));
	$chart->setTitle("Amount of ships in use by the ship broker");
	$chart->render("generated/ShipsInUse.png");
?>
<?php//display the chart?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Barchart Duration Order Arrival </title>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-15" />
</head>
<body>
	<img alt="Horizontal bars chart"  src="generated/ShipsInUse.png" style="border: 1px solid gray;"/>
</body>
</html>
<?php
	}


//Check if the seventh option was selected	
if($search=='7'){
//Create a list of the amount of income acquired by the ship broker
$mapper = new gb\mapper\StatisticsMapper();
$result = $mapper->getTotalPrice();
	//Create a bar chart
	$chart = new HorizontalBarChart(1200, 500);
	$dataSet = new XYDataSet();
//Add all bars to the chart
foreach($result as $revenue){
	$dataSet->addPoint(new Point($revenue['shipbroker_name'],$revenue['totalPrice'] ));
	}
	//create a .png image of the chart	
	$chart->setDataSet($dataSet);
	$chart->getPlot()->setGraphPadding(new Padding(5, 30, 20, 170));
	$chart->setTitle("Amount of income acquired by the ship broker");
	$chart->render("generated/MoneyAmount.png");
?>
<?php//display the chart?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Barchart Duration Order Arrival </title>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-15" />
</head>
<body>
	<img alt="Horizontal bars chart"  src="generated/MoneyAmount.png" style="border: 1px solid gray;"/>
</body>
</html>
<?php
	}
}

?>



</table>
<?php

	require("template/bottom.tpl.php");
?>
