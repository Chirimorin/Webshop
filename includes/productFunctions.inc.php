<?php
function showProductBox($product)
{
	if (is_a($product, "Product"))
	{
		echo("<div class=\"col-sm-4\">
				<div class=\"panel panel-info product-info\">
				<div class=\"panel-heading\">
				<h3 class=\"panel-title item-title ".$product->get('rarity')."\">".$product->get('name')."</h3>
				</div>
				<div class=\"panel-body\">
				<div class=\"product-container\">");
		if(file_exists("images/thumbs/".$product->get('image')))
		{
			echo("<img class=\"thumb\" src=\"images/thumbs/".$product->get('image')."\" alt=\"".$product->get('name')."\" />");
		}
		else
		{
			echo("<img class=\"thumb\" src=\"images/thumbs/NoImage.jpg\" alt=\"".$product->get('name')."\" />");
		}
		echo("<div class=\"description\">".$product->get('description')."<br /><br /><a href=\"index.php?page=product&amp;productid=".$product->get('id')."\">More Info</a></div>
				</div>
				<div class=\"price\">Price: &euro;".$product->get('price')."</div>
				<div class=\"cart\"><input class=\"amount\" name=\"".$product->get('name')." amount\" type=\"number\" value=\"1\" />&nbsp;
				<button type=\"button\" class=\"btn btn-xs btn-default add-to-cart\">Add to cart</button></div>
				</div>
				</div>
				</div>");
	}
}

function showProductDetail($product)
{
	if (is_a($product, "Product"))
	{
		$longdescription = $product->get('longdescription');
		//$longdescription = nl2br($longdescription); //doesn't work, mysql doesn't give the line breaks? 
		
		echo("<div class=\"panel panel-info\">
				<div class=\"panel-heading\">
				<h3 class=\"panel-title item-title ".$product->get('rarity')."\">".$product->get('name')."</h3>
				</div>
				<div class=\"panel-body\">
				<div class=\"product-container\">");
		if(file_exists("images/".$product->get('image')))
		{
			echo("<img class=\"product-image\" src=\"images/".$product->get('image')."\" alt=\"".$product->get('name')."\" />");
		}
		else
		{
			echo("<img class=\"product-image\" src=\"images/NoImage.jpg\" alt=\"".$product->get('name')."\" />");
		}
		echo("<div class=\"description\">".$product->get('longdescription')."</div>
				</div>
				<div class=\"price\">Price: &euro;".$product->get('price')."</div>
				<div class=\"cart\"><input class=\"amount\" name=\"".$product->get('name')." amount\" type=\"number\" value=\"1\" />&nbsp;
				<button type=\"button\" class=\"btn btn-xs btn-default add-to-cart\">Add to cart</button></div>
				</div>
				</div>");
	}
}
?>
