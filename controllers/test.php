<?php 
	include('classes/product.class.php');
	$product = new Product(2);
	
	echo("name: ".$product->get('name')."<br />");
	
	
?>