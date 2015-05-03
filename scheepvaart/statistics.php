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
				<option value="5">City of the ShipBroker</options>
				<option value="6">Used ships</options>
					
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
		<td><?php echo $revenue['shipbroker_name']; ?></td>		
		<td><?php echo $revenue['number_unique_clients']; ?></td>
	</tr>     
<?php        
	}
}

if($search=='2'){
?>
<?php

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
    }
    </script>
  </head>

  <body>
<!--Div that will hold the pie chart-->
    <div id="chart_div" style="width:400; height:300"></div>
  </body>
</html>

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
		<td><?php echo $revenue['shipbroker_name']; ?></td>	
		<td><?php echo $revenue['street_of_shipbroker']; ?></td>
		<td><?php echo $revenue['number_of_shipbroker']; ?></td>
		<td><?php echo $revenue['bus_of_shipbroker']; ?></td>
		<td><?php echo $revenue['postal_code_of_shipbroker']; ?></td>			
		<td><?php echo $revenue['city_of_shipbroker']; ?></td>
	</tr>     
<?php        
	}
}
if($search=='6'){
?>
<tr>
        <td>Ship broker name</td>
        <td>Ship Name</td>
    </tr>
<?php

$mapper = new gb\mapper\StatisticsMapper();
$result = $mapper->getShips();

foreach($result as $revenue){	
	?>
    <tr>
		<td><?php echo $revenue['shipbroker_name']; ?></td>	
		<td><?php echo $revenue['shipName']; ?></td>
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
