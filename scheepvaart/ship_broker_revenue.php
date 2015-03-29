<?php
	$title = "Ship broker revenues";

	// Voer de inhoud van "top.inc.php" uit. Deze verzorgt de
	// algemene pagina lay-out en het menu.
	require("template/top.tpl.php");
	require_once( "gb/mapper/ShipBrokerMapper.php" );
    $mapper = new gb\mapper\ShipBrokerMapper();
	
 ?>
<table>
    <tr>
        <td>Ship broker name</td>
        <td>From port</td>
        <td>To port</td>
        <td>Revenue</td>
        <td>Date (mm/yyyy)</td>
    </tr>

<?php


$mapper = new gb\mapper\ShipBrokerMapper();
$result = $mapper->getShipBrokerRevenues();


foreach($result as $revenue){
	
	?>
       <tr>
		<td><?php echo $revenue['name']; ?></td>		
		<td><?php echo $revenue['depart']; ?></td>
        <td><?php echo $revenue['arrival']; ?></td>
        <td><?php echo $revenue['revenue']; ?></td>
		<td><?php echo $revenue['date']; ?></td>
	</tr>     
<?php        
	}
?>

</table>
<?php

	require("template/bottom.tpl.php");
?>