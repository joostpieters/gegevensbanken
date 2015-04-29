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

	<table>
		<tr>
			<td>Shipment id</td>
			<td>Volume</td>
			<td>Weight</td>        
		</tr>
   
<?php
	foreach($allShipments as $shipment){
?>
	   <tr>
	   <!-- for every shipment we place the shipment_id, volume and the weight in a table using getters-->
		<td><?php echo $shipment->getShipmentId(); ?></td>
		<td><?php echo $shipment->getVolume(); ?></td>
		<td><?php echo $shipment->getWeight(); ?></td>
      
	</tr>	
<?php        
}
?>
</table>
<?php
	require("template/bottom.tpl.php");
?>

