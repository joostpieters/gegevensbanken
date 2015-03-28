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
/* // create a PDO object
include('configuration.php');
$PDO = new \PDO( $config["dsn"], $config["username"], $config["password"] );
$PDO->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
// execute a query using PDO
$stmt = $PDO->prepare("Create view VIEW_A (name, id, price, date) as select name, shipment_id, price, order_date FROM ORDERS join ship_broker on ship_broker_name=name");
$stmt->execute();
//$rows = $stmt->fetchAll ( \PDO::FETCH_ASSOC );


// create a PDO object
include('configuration.php');
$PDO = new \PDO( $config["dsn"], $config["username"], $config["password"] );
$PDO->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
// execute a query using PDO
$stmt = $PDO->prepare("Create view VIEW_B (name, shipment_id, price, date, route_id) as select name, id, price, date, route_id FROM VIEW_A join ships on id=shipment_id");
$stmt->execute();
//$rows = $stmt->fetchAll ( \PDO::FETCH_ASSOC );

// create a PDO object
include('configuration.php');
$PDO = new \PDO( $config["dsn"], $config["username"], $config["password"] );
$PDO->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
// execute a query using PDO
$stmt = $PDO->prepare("Create view VIEW_C (name, price, date, from_port, to_port, route_id) as select name, price, date, from_port_code, to_port_code, b.route_id FROM view_b b join route r on b.route_id = r.route_id");
$stmt->execute();
//$rows = $stmt->fetchAll ( \PDO::FETCH_ASSOC );

// create a PDO object
include('configuration.php');
$PDO = new \PDO( $config["dsn"], $config["username"], $config["password"] );
$PDO->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
// execute a query using PDO
$stmt = $PDO->prepare("SELECT name, F.port_name, T.port_name, SUM(price), date_format(`date`, '%m/%Y') FROM view_c, port F, port T WHERE F.port_code=from_port and T.port_code=to_port and date > DATE_ADD(NOW(), INTERVAL -1 MONTH) group by name, route_id");
$stmt->execute(array());
$rows = $stmt->fetchAll ( \PDO::FETCH_ASSOC ); */

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