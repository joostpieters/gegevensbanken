<?php
	
	// Dit is de titel die op de pagina en in de menubalk
	// zal verschijnen.
	$title = "Customers in city";

	// Voer de inhoud van "top.inc.php" uit. Deze verzorgt de
	// algemene pagina lay-out en het menu.
	require("template/top.tpl.php");
    require_once( "gb/controller/ListCustomerInCityController.php" );
	require_once( "gb/mapper/CustomerMapper.php" );
	require_once( "gb/mapper/Mapper.php" );
	

    $filterController = new gb\controller\ListCustomerInCityController();
    $filterController->process();
	$mapper = new \gb\mapper\CustomerMapper();
    $allCustomers = $mapper->findAll();        
    
	?>

<form method="post">
    
<table style="width: 100%">
    <tr>
        <td style="width: 10%"></td>
        <td style="width: 10%">City</td>
        <td style="width: 40%">
            <select style="width: 100%" name="citi">
			<?php
					$cities = array();
                    foreach($allCustomers as $customer) {
						if(!in_array($customer->getCity(), $cities)){
							array_push($cities, $customer->getCity() );
							echo "<option value=\"", $customer->getCity(), "\">", $customer->getCity(), "</option>" ;
						}
                    }
                    
                    ?> 
		


					
            </select>
        </td>
        <td style="width: 10%"><input type="submit" value="List customers in the city" name="formSubmit"></td>
        <td style="width: 30%"></td>
    </tr>
</table>    
	<table>
            <tr>
                <td>Ssn</td>
                <td>First name</td>
                <td>Last name</td>
                <td>Address</td>
                <td>City</td>
            </tr>
			<?php
 
if(isset($_POST['formSubmit']) )
{
  $varCity = $_POST['citi'];
  
 
}
	
	$filterController = new gb\controller\ListCustomerInCityController();
    $filterController->process();
	$mapper = new gb\mapper\CustomerMapper();
    $allCustomersInCity = $mapper->getCustomersInCity($varCity);       
   foreach($allCustomersInCity as $customer) {
 ?>
       <tr>
		<td><?php echo $customer->getSsn(); ?></td>
		<td><?php echo $customer->getFirstName(); ?></td>
		<td><?php echo $customer->getLastName(); ?></td>
                <td><?php echo $customer->getAddress(); ?></td>
                <td><?php echo $customer->getCity(); ?></td>
	</tr>     
<?php        
}
?>
</table>	
      
	


    
</form>    
<?php
	require("template/bottom.tpl.php");
?>