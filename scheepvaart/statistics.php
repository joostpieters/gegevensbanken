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
        <td>Shipbroker name</td>
        <td>Number of clients</td>
    </tr>
<!--	
<tr>
        <td colspan="6">Shipbroker information</td>
</tr>
<tr>
    <td colspan="6">
    <table style="width: 100%">
        <tr>
            <td style="width: 15%">Broker name</td>
            <td colspan="5" style="width: 85%">
                <select style="width: 50%" name="searchShipBroker">
                    <?php
                    /*foreach($allShipBroker as $broker) {
                        echo "<option value=\"", $broker->getName(), "\">", $broker->getName(), "</option>" ;
                    }*/
                    ?>
                </select>
            </td>            
        </tr>        
    </table>
    </td>    
</tr>
<tr>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td><input type ="submit" name="searchShipBroker" value="searchShipBroker" ></td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
</tr>
-->
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
?>

</table>
<?php

	require("template/bottom.tpl.php");
?>
