<?php
	// Dit is de titel die op de pagina en in de menubalk
	// zal verschijnen.
	$title = "The number of orders to a port";

	// Voer de inhoud van "top.inc.php" uit. Deze verzorgt de
	// algemene pagina lay-out en het menu.
	require("template/top.tpl.php");
	
?>

<form name ="form2" method="post">
	<td style="width: 10%"><input type="submit" value="Select" name="lalSubmit"></td>
        <td style="width: 30%"></td>
		<table style="width: 100%">
    <tr>
        <td style="width: 10%"></td>
        <td style="width: 10%">Type the name of a port</td>
        <td style="width: 40%">
            <TEXTAREA NAME="tekstvak" ROWS="1" COLS="50"></TEXTAREA>
			
			
        </td>
        
    </tr>
	</form>
	<?php
if(isset($_POST['lalSubmit']) )
{
if(isset($_POST['tekstvak']))
{
	?>
	<table>
<tr>
        <td>Ship broker name</td>
        <td>Number of orders to this city</td>
    </tr>
	<?php
	$varCity = $_POST['tekstvak'];
	$mapper = new gb\mapper\StatisticsMapper();
	$result = $mapper->getOrdersToPort($varCity);


foreach($result as $revenue){
	
	?>
       <tr>
		<td><?php echo $revenue['shipbroker_name']; ?></td>		
		<td><?php echo $revenue['number_of_orders']; ?></td>
	</tr>     
<?php        
	}
}
}

