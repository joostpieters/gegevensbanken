<?php
	// Dit is de titel die op de pagina en in de menubalk
	// zal verschijnen.
	$title = "List of orders";

	// Voer de inhoud van "top.inc.php" uit. Deze verzorgt de
	// algemene pagina lay-out en het menu.
	require("template/top.tpl.php");
	
	require_once( "gb/mapper/OrderMapper.php" );
    $mapper = new gb\mapper\OrderMapper();
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