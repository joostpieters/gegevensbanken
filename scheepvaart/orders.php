<?php
	// Dit is de titel die op de pagina en in de menubalk
	// zal verschijnen.
	$title = "List of orders";

	// Voer de inhoud van "top.inc.php" uit. Deze verzorgt de
	// algemene pagina lay-out en het menu.
	require("template/top.tpl.php");
	
	require_once( "gb/mapper/OrderMapper.php" );
    $mapper = new gb\mapper\OrderMapper();
	// $allOrders contains every order in the database
    $allOrders = $mapper->findAll();
?>
<table>
    <tr>
        <td>Shipment id</td>
        <td>Ssn</td>
        <td>Ship broker name</td>
        <td>Price</td>
        <td>Order date</td>
    </tr>
<?php
    foreach($allOrders as $order) {
 ?>
       <tr>
	   <!-- for every order we place shipment_id, ssn, shipBrokerName, price and the orderDate in a table using getters-->
		<td><?php echo $order->getShipmentId(); ?></td>
		<td><?php echo $order->getSsn(); ?></td>
		<td><?php echo $order->getShipBrokerName(); ?></td>
		<td><?php echo $order->getPrice(); ?></td>
		<td><?php echo $order->getOrderDate(); ?></td>
	</tr>     
<?php        
}
?>
</table>
<?php
	require("template/bottom.tpl.php");
?>