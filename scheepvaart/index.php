<?php
	
	// Dit is de titel die op de pagina en in de menubalk
	
// zal verschijnen.
	$title = "Shipping database";

	
// Voer de inhoud van "top.inc.php" uit. Deze verzorgt de
	
// algemene pagina lay-out en het menu.
	
require("template/top.tpl.php");
$date=date("d-m-Y");
print 'Welcome to the shipping web application!  ';
print "Today is $date";
?>



