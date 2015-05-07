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
if($search=='4'){
		?>
		
	<?php
		}
		
	
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
  <html>
  <head>
    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
    
      // Load the Visualization API and the barchart package.
	  google.load('visualization', '1', {packages: ['corechart', 'bar']});
	
      // Set a callback to run when the Google Visualization API is loaded.
      google.setOnLoadCallback(drawBasic);


      // Callback that creates and populates a data table, 
      // instantiates the barchart, passes in the data and
      // draws it.
      function drawBasic() {

      // Create the data table.
      var data = google.visualization.arrayToDataTable(<?php $result?>) //OFZOIETS, geen idee wat ik doe, tkan zijn da da ni in php moe

      // Set chart options
      var options = {title: 'Number of customers for each shipbroker',				
					chartArea: {width: '50%'},
					hAxis: {
					title: 'Number of customers',
					minValue: 0
					},
					vAxis: {
					title: 'shipbroker'
					}};

      // Instantiate and draw our chart, passing in some options.
      var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
      chart.draw(data, options); 
	  <?php 
    }


<<<<<<< HEAD
=======

$chart = new HorizontalBarChart(500, 170);

	$dataSet = new XYDataSet();
	$dataSet->addPoint(new Point("/wiki/Instant_messenger", 50));
	$dataSet->addPoint(new Point("/wiki/Web_Browser", 83));
	$dataSet->addPoint(new Point("/wiki/World_Wide_Web", 142));
	$chart->setDataSet($dataSet);

	$chart->setTitle("The number of orders made at every ");
	$chart->render("generated/numberOrders.png");
	}
>>>>>>> origin/master
?>
    </script>
  </head>

  <body>
<!--Div that will hold the pie chart-->
    <div id="chart_div" style="width:400; height:300"></div>
  </body>
</html>
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

<<<<<<< HEAD
if($search=='4'){
	header('Location: orders_to_port.php');  
=======

					
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
>>>>>>> origin/master
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
